<?php

header("Content-Type: application/json; charset=UTF-8");

/*
 * Aiven / Faable Database Configuration
 * Values are provided through Faable Secrets.
 */

$host = getenv("DB_HOST") ?: "localhost";
$port = intval(getenv("DB_PORT") ?: "3306");
$user = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD") ?: "";
$database = getenv("DB_NAME") ?: "my_store";

try {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $conn = mysqli_init();

    /*
     * SSL certificate
     * In Faable, ca.pem will be placed beside this PHP file.
     */
    $caFile = __DIR__ . "/ca.pem";

    if (file_exists($caFile)) {
        mysqli_ssl_set(
            $conn,
            null,
            null,
            $caFile,
            null,
            null
        );

        mysqli_real_connect(
            $conn,
            $host,
            $user,
            $password,
            $database,
            $port,
            null,
            MYSQLI_CLIENT_SSL
        );
    } else {

        // Local development fallback
        mysqli_real_connect(
            $conn,
            $host,
            $user,
            $password,
            $database,
            $port
        );
    }

    $conn->set_charset("utf8mb4");

} catch (Throwable $e) {

    http_response_code(500);

    echo json_encode([
        "success" => false,
        "message" => "تعذر الاتصال بقاعدة البيانات"
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!is_array($data)) {

    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "بيانات الطلب غير صحيحة"
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


$name = trim($data["customer_name"] ?? "");
$phone = trim($data["phone"] ?? "");
$address = trim($data["address"] ?? "");
$cart = $data["cart"] ?? [];


if ($name === "" || $phone === "" || $address === "") {

    echo json_encode([
        "success" => false,
        "message" => "أكمل بيانات العميل"
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


if (!is_array($cart) || count($cart) === 0) {

    echo json_encode([
        "success" => false,
        "message" => "السلة فارغة"
    ], JSON_UNESCAPED_UNICODE);

    exit;
}


$conn->begin_transaction();


try {

    /* إضافة العميل */

    $stmt = $conn->prepare(
        "INSERT INTO customers
        (customer_name, phone, address)
        VALUES (?, ?, ?)"
    );

    $stmt->bind_param(
        "sss",
        $name,
        $phone,
        $address
    );

    $stmt->execute();

    $customer_id = $conn->insert_id;

    $total = 0;
    $items = [];


    /* التحقق من المنتجات */

    foreach ($cart as $item) {

        $product_id = intval($item["id"]);
        $quantity = intval($item["quantity"]);

        if ($quantity < 1) {
            throw new Exception("الكمية غير صحيحة");
        }


        $stmt = $conn->prepare(
            "SELECT
                product_id,
                product_name,
                price,
                quantity
             FROM products
             WHERE product_id = ?"
        );

        $stmt->bind_param(
            "i",
            $product_id
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $product = $result->fetch_assoc();


        if (!$product) {
            throw new Exception("المنتج غير موجود");
        }


        if ($product["quantity"] < $quantity) {

            throw new Exception(
                "الكمية غير متوفرة للمنتج: " .
                $product["product_name"]
            );
        }


        $price = floatval($product["price"]);

        $total += $price * $quantity;


        $items[] = [
            "product_id" => $product_id,
            "quantity" => $quantity,
            "price" => $price
        ];
    }


    /* إنشاء الفاتورة */

    $stmt = $conn->prepare(
        "INSERT INTO sales
        (customer_id, total_amount)
        VALUES (?, ?)"
    );

    $stmt->bind_param(
        "id",
        $customer_id,
        $total
    );

    $stmt->execute();

    $sale_id = $conn->insert_id;


    /* تفاصيل الفاتورة وتقليل المخزون */

    foreach ($items as $item) {

        $product_id = $item["product_id"];
        $quantity = $item["quantity"];
        $price = $item["price"];


        $stmt = $conn->prepare(
            "INSERT INTO sale_details
            (sale_id, product_id, quantity, unit_price)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "iiid",
            $sale_id,
            $product_id,
            $quantity,
            $price
        );

        $stmt->execute();


        $stmt = $conn->prepare(
            "UPDATE products
             SET quantity = quantity - ?
             WHERE product_id = ?"
        );

        $stmt->bind_param(
            "ii",
            $quantity,
            $product_id
        );

        $stmt->execute();
    }


    $conn->commit();


    echo json_encode([
        "success" => true,
        "sale_id" => $sale_id,
        "customer_id" => $customer_id,
        "total" => round($total, 2)
    ], JSON_UNESCAPED_UNICODE);


} catch (Throwable $e) {

    $conn->rollback();

    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}


$conn->close();

?>
