<?php
session_start();

$admin_password = getenv("ADMIN_PASSWORD") ?: "";

if (isset($_POST["login"])) {
    if (hash_equals($admin_password, $_POST["password"] ?? "")) {
        $_SESSION["admin_logged_in"] = true;
    } else {
        $error = "كلمة المرور غير صحيحة";
    }
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

if (!isset($_SESSION["admin_logged_in"])) {
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>حليم - لوحة الإدارة</title>
<style>
body{
    font-family:Arial;
    background:#f5f5f5;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh
}
.box{
    background:white;
    padding:35px;
    border-radius:15px;
    width:330px;
    text-align:center;
    box-shadow:0 5px 20px #ccc
}
input,button{
    width:100%;
    padding:12px;
    margin-top:12px;
    box-sizing:border-box
}
button{
    background:#111;
    color:white;
    border:0;
    border-radius:8px;
    cursor:pointer
}
.error{color:red}
</style>
</head>

<body>
<div class="box">
<h2>لوحة إدارة حليم</h2>

<form method="post">
<input type="password" name="password" placeholder="كلمة مرور الإدارة" required>
<button name="login">دخول</button>
</form>

<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

</div>
</body>
</html>

<?php
exit;
}

$host = getenv("DB_HOST") ?: "localhost";
$port = intval(getenv("DB_PORT") ?: "3306");
$user = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD") ?: "";
$database = getenv("DB_NAME") ?: "my_store";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $conn = new mysqli(
        $host,
        $user,
        $password,
        $database,
        $port
    );

    $conn->set_charset("utf8mb4");

    /* العملاء */
    $customers = $conn->query("
        SELECT
            customer_id,
            customer_name,
            phone,
            address
        FROM customers
        ORDER BY customer_id DESC
    ");

    /* الطلبات */
    $sales = $conn->query("
        SELECT
            s.sale_id,
            c.customer_name,
            c.phone,
            c.address,
            s.sale_date,
            s.total_amount
        FROM sales s
        LEFT JOIN customers c
            ON s.customer_id = c.customer_id
        ORDER BY s.sale_id DESC
    ");

    /* تفاصيل الطلبات */
    $details_result = $conn->query("
        SELECT
            sd.sale_id,
            p.product_name,
            sd.quantity,
            sd.unit_price,
            (sd.quantity * sd.unit_price) AS item_total
        FROM sale_details sd
        LEFT JOIN products p
            ON sd.product_id = p.product_id
        ORDER BY sd.sale_id DESC, sd.detail_id ASC
    ");

    $order_details = [];

    while ($detail = $details_result->fetch_assoc()) {
        $order_details[$detail["sale_id"]][] = $detail;
    }

    /* المنتجات والمخزون */
    $products = $conn->query("
        SELECT
            product_id,
            product_name,
            price,
            quantity
        FROM products
        ORDER BY product_id
    ");

} catch (Throwable $e) {
    die("تعذر الاتصال بقاعدة البيانات");
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width,initial-scale=1">

<title>لوحة إدارة حليم</title>

<style>

body{
    font-family:Arial;
    margin:0;
    background:#f5f5f5;
    color:#222
}

header{
    background:#111;
    color:white;
    padding:20px
}

header h1{
    display:inline-block;
    margin:0
}

.logout{
    float:left;
    color:white;
    text-decoration:none
}

.container{
    padding:25px;
    max-width:1200px;
    margin:auto
}

.card{
    background:white;
    padding:20px;
    margin-bottom:25px;
    border-radius:12px;
    box-shadow:0 2px 10px #ddd
}

h2{
    margin-top:0
}

.table{
    width:100%;
    border-collapse:collapse
}

.table th,
.table td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:right
}

.table th{
    background:#eee
}

.low{
    color:red;
    font-weight:bold
}

.details-btn{
    background:#111;
    color:white;
    border:0;
    padding:8px 14px;
    border-radius:7px;
    cursor:pointer
}

.details{
    margin-top:10px;
    background:#f8f8f8;
    padding:15px;
    border-radius:10px
}

.customer-info{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:10px;
    margin-bottom:15px
}

.info-box{
    background:white;
    padding:10px;
    border-radius:8px
}

.details-table{
    width:100%;
    border-collapse:collapse;
    background:white
}

.details-table th,
.details-table td{
    padding:9px;
    border-bottom:1px solid #ddd;
    text-align:right
}

.details-table th{
    background:#eee
}

.total-row{
    font-weight:bold;
    font-size:16px
}

@media(max-width:700px){

    .table{
        font-size:13px
    }

    .table th,
    .table td{
        padding:7px
    }

    .customer-info{
        grid-template-columns:1fr
    }

}

</style>

</head>

<body>

<header>

<h1>لوحة إدارة حليم</h1>

<a class="logout" href="?logout=1">
تسجيل خروج
</a>

</header>


<div class="container">


<!-- العملاء -->

<div class="card">

<h2>👥 العملاء</h2>

<table class="table">

<tr>
<th>الرقم</th>
<th>الاسم</th>
<th>الهاتف</th>
<th>العنوان</th>
</tr>

<?php while($row = $customers->fetch_assoc()): ?>

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


<!-- الطلبات -->

<div class="card">

<h2>📦 الطلبات</h2>

<table class="table">

<tr>

<th>رقم الطلب</th>
<th>العميل</th>
<th>الهاتف</th>
<th>التاريخ</th>
<th>الإجمالي</th>
<th>التفاصيل</th>

</tr>


<?php while($row = $sales->fetch_assoc()): ?>

<tr>

<td>
<strong>
HALIM-<?= htmlspecialchars($row["sale_id"]) ?>
</strong>
</td>

<td>
<?= htmlspecialchars($row["customer_name"] ?? "") ?>
</td>

<td>
<?= htmlspecialchars($row["phone"] ?? "") ?>
</td>

<td>
<?= htmlspecialchars($row["sale_date"]) ?>
</td>

<td>
<?= htmlspecialchars($row["total_amount"]) ?> جنيه
</td>

<td>

<button
class="details-btn"
onclick="toggleDetails('order<?= $row["sale_id"] ?>')">

عرض التفاصيل

</button>

</td>

</tr>


<!-- تفاصيل الطلب -->

<tr
id="order<?= $row["sale_id"] ?>"
style="display:none">

<td colspan="6">

<div class="details">


<div class="customer-info">

<div class="info-box">
<strong>👤 العميل:</strong><br>
<?= htmlspecialchars($row["customer_name"] ?? "") ?>
</div>

<div class="info-box">
<strong>📞 الهاتف:</strong><br>
<?= htmlspecialchars($row["phone"] ?? "") ?>
</div>

<div class="info-box">
<strong>📍 العنوان:</strong><br>
<?= htmlspecialchars($row["address"] ?? "") ?>
</div>

</div>


<h3>
🛍️ المنتجات في الطلب
</h3>


<table class="details-table">

<tr>

<th>المنتج</th>
<th>الكمية</th>
<th>سعر الوحدة</th>
<th>الإجمالي</th>

</tr>


<?php if(isset($order_details[$row["sale_id"]])): ?>

<?php foreach($order_details[$row["sale_id"]] as $item): ?>

<tr>

<td>
<?= htmlspecialchars($item["product_name"] ?? "منتج") ?>
</td>

<td>
<?= htmlspecialchars($item["quantity"]) ?>
</td>

<td>
<?= htmlspecialchars($item["unit_price"]) ?> جنيه
</td>

<td>
<?= htmlspecialchars($item["item_total"]) ?> جنيه
</td>

</tr>

<?php endforeach; ?>

<tr class="total-row">

<td colspan="3">
إجمالي الطلب
</td>

<td>
<?= htmlspecialchars($row["total_amount"]) ?> جنيه
</td>

</tr>

<?php else: ?>

<tr>

<td colspan="4">
لا توجد تفاصيل لهذا الطلب
</td>

</tr>

<?php endif; ?>

</table>


</div>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>


<!-- المنتجات والمخزون -->

<div class="card">

<h2>🛍️ المنتجات والمخزون</h2>

<table class="table">

<tr>

<th>رقم</th>
<th>المنتج</th>
<th>السعر</th>
<th>المخزون</th>

</tr>


<?php while($row = $products->fetch_assoc()): ?>

<tr>

<td>
<?= htmlspecialchars($row["product_id"]) ?>
</td>

<td>
<?= htmlspecialchars($row["product_name"]) ?>
</td>

<td>
<?= htmlspecialchars($row["price"]) ?> جنيه
</td>

<td class="<?= $row["quantity"] <= 5 ? 'low' : '' ?>">

<?= htmlspecialchars($row["quantity"]) ?>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>


</div>


<script>

function toggleDetails(id){

    const row = document.getElementById(id);

    if(row.style.display === "none"){
        row.style.display = "table-row";
    }else{
        row.style.display = "none";
    }

}

</script>

</body>

</html>
