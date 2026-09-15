<?php
session_start();

/* =========================
   ADMIN LOGIN
========================= */

$admin_password = getenv("ADMIN_PASSWORD") ?: "";

if (isset($_POST["login"])) {

    $entered_password = $_POST["password"] ?? "";

    if (hash_equals($admin_password, $entered_password)) {
        $_SESSION["admin_logged_in"] = true;
    } else {
        $error = "كلمة المرور غير صحيحة";
    }
}


/* =========================
   LOGOUT
========================= */

if (isset($_GET["logout"])) {

    session_destroy();

    header("Location: admin.php");
    exit;
}


/* =========================
   LOGIN PAGE
========================= */

if (!isset($_SESSION["admin_logged_in"])) {
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width,initial-scale=1"
>

<title>حليم - لوحة الإدارة</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f5f5f5;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.box{
    background:#fff;
    padding:35px;
    border-radius:15px;
    width:330px;
    text-align:center;
    box-shadow:0 5px 20px #ccc;
}

input,
button{
    width:100%;
    padding:12px;
    margin-top:12px;
    box-sizing:border-box;
}

input{
    border:1px solid #ddd;
    border-radius:8px;
}

button{
    background:#111;
    color:#fff;
    border:0;
    border-radius:8px;
    cursor:pointer;
}

.error{
    color:#d00;
}

</style>

</head>

<body>

<div class="box">

<h2>لوحة إدارة حليم</h2>

<form method="post">

<input
    type="password"
    name="password"
    placeholder="كلمة مرور الإدارة"
    required
>

<button type="submit" name="login">
دخول
</button>

</form>

<?php if (isset($error)): ?>

<p class="error">
<?= htmlspecialchars($error) ?>
</p>

<?php endif; ?>

</div>

</body>

</html>

<?php
exit;
}


/* =========================
   DATABASE CONNECTION
========================= */

$host = getenv("DB_HOST") ?: "localhost";
$port = intval(getenv("DB_PORT") ?: "3306");
$user = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD") ?: "";
$database = getenv("DB_NAME") ?: "my_store";

mysqli_report(
    MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT
);

try {

    $conn = new mysqli(
        $host,
        $user,
        $password,
        $database,
        $port
    );

    $conn->set_charset("utf8mb4");

} catch (Throwable $e) {

    die("تعذر الاتصال بقاعدة البيانات");

}


/* =========================
   ADD PRODUCT
========================= */

if (isset($_POST["add_product"])) {

    $name = trim($_POST["product_name"] ?? "");

    $category_id = intval(
        $_POST["category_id"] ?? 0
    );

    $price = floatval(
        $_POST["price"] ?? 0
    );

    $quantity = intval(
        $_POST["quantity"] ?? 0
    );

    $image = trim(
        $_POST["image"] ?? ""
    );


    if (
        $name === "" ||
        $category_id <= 0 ||
        $price < 0 ||
        $quantity < 0
    ) {

        $add_error =
            "أكمل بيانات المنتج بشكل صحيح";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO products
            (
                category_id,
                product_name,
                price,
                quantity,
                image
            )
            VALUES (?, ?, ?, ?, ?)"
        );


        /*
           i = integer
           s = string
           d = double
           i = integer
           s = string
        */

        $stmt->bind_param(
            "isdis",
            $category_id,
            $name,
            $price,
            $quantity,
            $image
        );


        $stmt->execute();

        $stmt->close();


        header(
            "Location: admin.php?added=1"
        );

        exit;
    }
}


/* =========================
   UPDATE PRODUCT
========================= */

if (isset($_POST["update_product"])) {

    $product_id = intval(
        $_POST["product_id"] ?? 0
    );

    $name = trim(
        $_POST["product_name"] ?? ""
    );

    $category_id = intval(
        $_POST["category_id"] ?? 0
    );

    $price = floatval(
        $_POST["price"] ?? 0
    );

    $quantity = intval(
        $_POST["quantity"] ?? 0
    );

    $image = trim(
        $_POST["image"] ?? ""
    );


    if (
        $product_id <= 0 ||
        $name === "" ||
        $category_id <= 0 ||
        $price < 0 ||
        $quantity < 0
    ) {

        $edit_error =
            "بيانات المنتج غير صحيحة";

    } else {

        $stmt = $conn->prepare(
            "UPDATE products
             SET
                category_id = ?,
                product_name = ?,
                price = ?,
                quantity = ?,
                image = ?
             WHERE product_id = ?"
        );


        $stmt->bind_param(
            "isdisi",
            $category_id,
            $name,
            $price,
            $quantity,
            $image,
            $product_id
        );


        $stmt->execute();

        $stmt->close();


        header(
            "Location: admin.php?updated=1"
        );

        exit;
    }
}


/* =========================
   DELETE PRODUCT
========================= */

if (isset($_POST["delete_product"])) {

    $product_id = intval(
        $_POST["product_id"] ?? 0
    );


    if ($product_id > 0) {

        /*
           نتأكد إن المنتج غير موجود
           في طلبات سابقة.
        */

        $stmt = $conn->prepare(
            "SELECT COUNT(*) AS total
             FROM sale_details
             WHERE product_id = ?"
        );


        $stmt->bind_param(
            "i",
            $product_id
        );


        $stmt->execute();


        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();


        if (intval($row["total"]) > 0) {

            $delete_error =
                "لا يمكن حذف هذا المنتج لأنه موجود في طلب سابق.";

        } else {

            $stmt = $conn->prepare(
                "DELETE FROM products
                 WHERE product_id = ?"
            );


            $stmt->bind_param(
                "i",
                $product_id
            );


            $stmt->execute();

            $stmt->close();


            header(
                "Location: admin.php?deleted=1"
            );

            exit;
        }
    }
}


/* =========================
   CUSTOMERS
========================= */

$customers = $conn->query(
    "SELECT
        customer_id,
        customer_name,
        phone,
        address
     FROM customers
     ORDER BY customer_id DESC"
);


/* =========================
   ORDERS
========================= */

$sales = $conn->query(
    "SELECT
        s.sale_id,
        c.customer_name,
        c.phone,
        c.address,
        s.sale_date,
        s.total_amount
     FROM sales s
     LEFT JOIN customers c
        ON s.customer_id = c.customer_id
     ORDER BY s.sale_id DESC"
);


/* =========================
   PRODUCTS
========================= */

$products = $conn->query(
    "SELECT
        product_id,
        category_id,
        product_name,
        price,
        quantity,
        image
     FROM products
     ORDER BY product_id DESC"
);

?>

<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width,initial-scale=1"
>

<title>لوحة إدارة حليم</title>

<style>

*{
    box-sizing:border-box;
}

body{
    font-family:Arial,sans-serif;
    margin:0;
    background:#f5f5f5;
    color:#222;
}

header{
    background:#111;
    color:#fff;
    padding:20px;
}

header h1{
    display:inline-block;
    margin:0;
}

.logout{
    float:left;
    color:#fff;
    text-decoration:none;
    margin-top:5px;
}

.container{
    padding:25px;
    max-width:1250px;
    margin:auto;
}

.card{
    background:#fff;
    padding:20px;
    margin-bottom:25px;
    border-radius:12px;
    box-shadow:0 2px 10px #ddd;
}

h2{
    margin-top:0;
}

.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
}

.form-grid input,
.form-grid select{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:7px;
}

.add-btn{
    background:#111;
    color:#fff;
    border:0;
    padding:12px 20px;
    border-radius:7px;
    cursor:pointer;
    margin-top:12px;
}

.success{
    background:#e8f8ed;
    color:#16733a;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}

.error{
    background:#ffecec;
    color:#b00000;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
}

.table-wrap{
    overflow-x:auto;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th,
.table td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:right;
    vertical-align:middle;
}

.table th{
    background:#eee;
}

.product-img{
    width:70px;
    height:80px;
    object-fit:cover;
    border-radius:7px;
}

.low{
    color:red;
    font-weight:bold;
}

.edit-box{
    background:#fafafa;
    padding:15px;
    border-radius:8px;
    min-width:300px;
}

.edit-box input,
.edit-box select{
    padding:8px;
    margin:3px;
    border:1px solid #ddd;
    border-radius:5px;
}

.edit-btn{
    background:#111;
    color:#fff;
    border:0;
    padding:8px 12px;
    border-radius:5px;
    cursor:pointer;
}

.delete-btn{
    background:#c62828;
    color:#fff;
    border:0;
    padding:8px 12px;
    border-radius:5px;
    cursor:pointer;
}

summary{
    cursor:pointer;
    font-weight:bold;
}

@media(max-width:700px){

    .container{
        padding:12px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .table{
        font-size:12px;
    }

    .table th,
    .table td{
        padding:7px;
    }

    .edit-box{
        min-width:250px;
    }
}

</style>

</head>

<body>


<header>

<h1>
لوحة إدارة حليم
</h1>

<a
    class="logout"
    href="?logout=1"
>
تسجيل خروج
</a>

</header>


<div class="container">


<?php if (isset($_GET["added"])): ?>

<div class="success">
✅ تم إضافة المنتج بنجاح
</div>

<?php endif; ?>


<?php if (isset($_GET["updated"])): ?>

<div class="success">
✅ تم تعديل المنتج بنجاح
</div>

<?php endif; ?>


<?php if (isset($_GET["deleted"])): ?>

<div class="success">
✅ تم حذف المنتج بنجاح
</div>

<?php endif; ?>


<?php if (isset($add_error)): ?>

<div class="error">
<?= htmlspecialchars($add_error) ?>
</div>

<?php endif; ?>


<?php if (isset($edit_error)): ?>

<div class="error">
<?= htmlspecialchars($edit_error) ?>
</div>

<?php endif; ?>


<?php if (isset($delete_error)): ?>

<div class="error">
<?= htmlspecialchars($delete_error) ?>
</div>

<?php endif; ?>


<!-- =========================
     ADD PRODUCT
========================= -->

<div class="card">

<h2>
➕ إضافة منتج جديد
</h2>

<form method="post">

<div class="form-grid">


<input
    type="text"
    name="product_name"
    placeholder="اسم المنتج"
    required
>


<select
    name="category_id"
    required
>

<option value="">
اختر الفئة
</option>

<option value="2">
قمصان وتيشيرتات
</option>

<option value="3">
أحذية
</option>

<option value="4">
بناطيل
</option>

</select>


<input
    type="number"
    name="price"
    placeholder="السعر"
    min="0"
    step="0.01"
    required
>


<input
    type="number"
    name="quantity"
    placeholder="المخزون"
    min="0"
    required
>


<input
    type="url"
    name="image"
    placeholder="رابط صورة المنتج"
>

</div>


<button
    type="submit"
    class="add-btn"
    name="add_product"
>
إضافة المنتج
</button>

</form>

</div>


<!-- =========================
     PRODUCTS
========================= -->

<div class="card">

<h2>
🛍️ المنتجات والمخزون
</h2>


<div class="table-wrap">

<table class="table">

<tr>

<th>
الصورة
</th>

<th>
المنتج
</th>

<th>
السعر
</th>

<th>
المخزون
</th>

<th>
الإجراءات
</th>

</tr>


<?php while ($row = $products->fetch_assoc()): ?>

<tr>


<td>

<?php if (!empty($row["image"])): ?>

<img
    class="product-img"
    src="<?= htmlspecialchars($row["image"]) ?>"
    alt="<?= htmlspecialchars($row["product_name"]) ?>"
    onerror="this.src='https://placehold.co/300x300?text=Halim'"
>

<?php else: ?>

<img
    class="product-img"
    src="https://placehold.co/300x300?text=Halim"
    alt="Halim"
>

<?php endif; ?>

</td>


<td>

<?= htmlspecialchars(
    $row["product_name"]
) ?>

</td>


<td>

<?= htmlspecialchars(
    $row["price"]
) ?>

جنيه

</td>


<td
    class="<?= intval($row["quantity"]) <= 5 ? 'low' : '' ?>"
>

<?= htmlspecialchars(
    $row["quantity"]
) ?>

</td>


<td>


<details>

<summary>
✏️ تعديل
</summary>


<div class="edit-box">


<form method="post">


<input
    type="hidden"
    name="product_id"
    value="<?= intval($row["product_id"]) ?>"
>


<input
    type="text"
    name="product_name"
    value="<?= htmlspecialchars($row["product_name"]) ?>"
    placeholder="اسم المنتج"
    required
>


<select
    name="category_id"
    required
>

<option
    value="2"
    <?= intval($row["category_id"]) === 2 ? "selected" : "" ?>
>
قمصان وتيشيرتات
</option>

<option
    value="3"
    <?= intval($row["category_id"]) === 3 ? "selected" : "" ?>
>
أحذية
</option>

<option
    value="4"
    <?= intval($row["category_id"]) === 4 ? "selected" : "" ?>
>
بناطيل
</option>

</select>


<input
    type="number"
    name="price"
    value="<?= htmlspecialchars($row["price"]) ?>"
    min="0"
    step="0.01"
    required
>


<input
    type="number"
    name="quantity"
    value="<?= htmlspecialchars($row["quantity"]) ?>"
    min="0"
    required
>


<input
    type="url"
    name="image"
    value="<?= htmlspecialchars($row["image"] ?? "") ?>"
    placeholder="رابط الصورة"
>


<br>


<button
    type="submit"
    class="edit-btn"
    name="update_product"
>
💾 حفظ التعديل
</button>


</form>


<br>


<form
    method="post"
    onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟');"
>


<input
    type="hidden"
    name="product_id"
    value="<?= intval($row["product_id"]) ?>"
>


<button
    type="submit"
    class="delete-btn"
    name="delete_product"
>
🗑️ حذف المنتج
</button>


</form>


</div>

</details>


</td>


</tr>

<?php endwhile; ?>

</table>

</div>

</div>


<!-- =========================
     CUSTOMERS
========================= -->

<div class="card">

<h2>
👥 العملاء
</h2>


<div class="table-wrap">

<table class="table">

<tr>

<th>الرقم</th>
<th>الاسم</th>
<th>الهاتف</th>
<th>العنوان</th>

</tr>


<?php while ($row = $customers->fetch_assoc()): ?>

<tr>

<td>
<?= htmlspecialchars($row["customer_id"]) ?>
</td>

<td>
<?= htmlspecialchars($row["customer_name"]) ?>
</td>

<td>
<?= htmlspecialchars($row["phone"]) ?>
</td>

<td>
<?= htmlspecialchars($row["address"]) ?>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>


<!-- =========================
     ORDERS
========================= -->

<div class="card">

<h2>
📦 الطلبات
</h2>


<div class="table-wrap">

<table class="table">

<tr>

<th>
رقم الطلب
</th>

<th>
العميل
</th>

<th>
الهاتف
</th>

<th>
العنوان
</th>

<th>
التاريخ
</th>

<th>
الإجمالي
</th>

</tr>


<?php while ($row = $sales->fetch_assoc()): ?>

<tr>

<td>
#<?= htmlspecialchars($row["sale_id"]) ?>
</td>

<td>
<?= htmlspecialchars(
    $row["customer_name"] ?? ""
) ?>
</td>

<td>
<?= htmlspecialchars(
    $row["phone"] ?? ""
) ?>
</td>

<td>
<?= htmlspecialchars(
    $row["address"] ?? ""
) ?>
</td>

<td>
<?= htmlspecialchars(
    $row["sale_date"]
) ?>
</td>

<td>
<?= htmlspecialchars(
    $row["total_amount"]
) ?>
جنيه
</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>


</div>

</body>

</html>
