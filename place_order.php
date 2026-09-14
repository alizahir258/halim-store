<?php

header("Content-Type: application/json; charset=UTF-8");

$host = "localhost";
$user = "root";
$password = "2003";
$database = "my_store";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "فشل الاتصال بقاعدة البيانات"
    ]);
    exit;
}

$conn->set_charset("utf8mb4");

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data["customer_name"] ?? "");
$phone = trim($data["phone"] ?? "");
$address = trim($data["address"] ?? "");
$cart = $data["cart"] ?? [];

if ($name === "" || $phone === "" || $address === "") {
    echo json_encode([
        "success" => false,
        "message" => "أكمل بيانات العميل"
    ]);
    exit;
}

if (!is_array($cart) || count($cart) === 0) {
    echo json_encode([
        "success" => false,
        "message" => "السلة فارغة"
    ]);
    exit;
}

$conn->begin_transaction();

try {

    /* إضافة العميل */

    $stmt = $conn->prepare(
        "INSERT INTO customers (customer_name, phone, address)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sss", $name, $phone, $address);
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
            "SELECT product_id, product_name, price, quantity
             FROM products
             WHERE product_id = ?"
        );

        $stmt->bind_param("i", $product_id);
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
        "INSERT INTO sales (customer_id, total_amount)
         VALUES (?, ?)"
    );

    $stmt->bind_param("id", $customer_id, $total);
    $stmt->execute();

    $sale_id = $conn->insert_id;

    /* تفاصيل الفاتورة */

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

        /* تقليل المخزون */

        $stmt = $conn->prepare(
            "UPDATE products
             SET quantity = quantity - ?
             WHERE product_id = ?"
        );

        $stmt->bind_param("ii", $quantity, $product_id);
        $stmt->execute();
    }

    $conn->commit();

    echo json_encode([
        "success" => true,
        "sale_id" => $sale_id,
        "customer_id" => $customer_id,
        "total" => round($total, 2)
    ]);

} catch (Exception $e) {

    $conn->rollback();

    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

$conn->close();
?>