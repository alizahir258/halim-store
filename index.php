<!DOCTYPE html>

<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>حليم | متجر الأزياء</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}

:root{
  --black:#111;
  --gold:#b08d57;
  --bg:#f5f4f0;
  --white:#fff;
  --muted:#777;
  --border:#e5e2da;
  --green:#218838;
  --danger:#c62828;
}

body{
  font-family:Arial,Tahoma,sans-serif;
  background:var(--bg);
  color:#181818;
}

button,input{
  font-family:inherit;
}

button{cursor:pointer}

img{max-width:100%}

.offer{
  background:#111;
  color:#fff;
  text-align:center;
  padding:10px;
  font-size:13px;
}

.offer b{color:#dfbc70}

header{
  background:#fff;
  min-height:76px;
  padding:12px 5%;
  display:flex;
  align-items:center;
  gap:20px;
  border-bottom:1px solid var(--border);
  position:sticky;
  top:0;
  z-index:1000;
}

.logo{
  font-size:29px;
  font-weight:900;
  cursor:pointer;
}

.logo span{color:var(--gold)}

.search{
  flex:1;
  max-width:650px;
  height:43px;
  display:flex;
  border:1px solid #ddd;
}

.search input{
  flex:1;
  border:0;
  outline:0;
  padding:12px;
}

.search button{
  width:55px;
  border:0;
  background:var(--gold);
  color:#fff;
  font-size:20px;
}

.account-btn,
.cart-btn{
  background:none;
  border:0;
}

.cart-btn{
  font-size:23px;
  position:relative;
}

.cart-number{
  position:absolute;
  top:-8px;
  right:-8px;
  background:#c62828;
  color:#fff;
  width:20px;
  height:20px;
  border-radius:50%;
  font-size:11px;
  display:flex;
  justify-content:center;
  align-items:center;
}

nav{
  background:#fff;
  border-bottom:1px solid var(--border);
  display:flex;
  justify-content:center;
  overflow-x:auto;
}

nav button{
  background:#fff;
  border:0;
  padding:17px 22px;
  white-space:nowrap;
  border-bottom:2px solid transparent;
}

nav button:hover,
nav button.active{
  color:var(--gold);
  border-bottom-color:var(--gold);
}

.page{display:none;min-height:500px}
.page.active{display:block}

.hero{
  min-height:510px;
  background:
  linear-gradient(90deg,rgba(0,0,0,.85),rgba(0,0,0,.12)),
  url("https://images.pexels.com/photos/996329/pexels-photo-996329.jpeg?auto=compress&cs=tinysrgb&w=1600")
  center/cover;
  display:flex;
  align-items:center;
  color:#fff;
  padding:60px 8%;
}

.hero-content{max-width:620px}

.hero small{letter-spacing:3px}

.hero h1{
  font-size:60px;
  line-height:1.05;
  margin:20px 0;
}

.hero p{
  color:#eee;
  line-height:1.9;
  margin-bottom:25px;
}

.hero button{
  border:0;
  background:#fff;
  padding:14px 30px;
  font-weight:bold;
}

.container{
  max-width:1400px;
  margin:auto;
  padding:45px 25px;
}

.section-title{margin-bottom:25px}

.section-title h2{margin-bottom:8px}

.section-title p{color:var(--muted)}

.categories{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:20px;
  margin-bottom:55px;
}

.category-card{
  height:320px;
  overflow:hidden;
  position:relative;
  cursor:pointer;
}

.category-card img{
  width:100%;
  height:100%;
  object-fit:cover;
  transition:.4s;
}

.category-card:hover img{transform:scale(1.06)}

.category-card div{
  position:absolute;
  inset:0;
  background:linear-gradient(transparent,rgba(0,0,0,.75));
  display:flex;
  align-items:flex-end;
  padding:25px;
  color:#fff;
  font-size:25px;
  font-weight:bold;
}

.products{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
}

.product{
  background:#fff;
  overflow:hidden;
  position:relative;
  transition:.25s;
  cursor:pointer;
}

.product:hover{
  transform:translateY(-4px);
  box-shadow:0 12px 30px #0001;
}

.product-image{
  height:300px;
  background:#eee;
  overflow:hidden;
}

.product-image img{
  width:100%;
  height:100%;
  object-fit:cover;
  transition:.4s;
}

.product:hover .product-image img{
  transform:scale(1.05);
}

.badge{
  position:absolute;
  top:12px;
  right:12px;
  z-index:2;
  background:#111;
  color:#fff;
  padding:6px 9px;
  font-size:10px;
}

.product-info{padding:15px}

.brand{
  color:#999;
  font-size:11px;
  margin-bottom:6px;
}

.product-name{
  min-height:40px;
  line-height:1.5;
}

.rating{
  color:#e2a719;
  font-size:13px;
  margin:7px 0;
}

.rating span{color:#777}

.price{font-weight:bold}

.old-price{
  color:#999;
  text-decoration:line-through;
  font-size:12px;
  margin-right:7px;
}

.add{
  width:100%;
  margin-top:12px;
  padding:12px;
  background:#111;
  color:#fff;
  border:0;
}

.add:hover{background:var(--gold)}

.deal{
  background:#171717;
  color:#fff;
  padding:40px;
  margin:55px 0;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:20px;
}

.deal button{
  background:#d7b66f;
  border:0;
  padding:13px 25px;
}

.coupon{
  background:#fff5df;
  border:1px solid #ead6ac;
  padding:25px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin:50px 0;
  gap:20px;
}

.coupon-code{
  background:#fff;
  border:1px dashed var(--gold);
  padding:10px 18px;
  font-weight:bold;
  text-align:center;
}

.coupon button{
  border:0;
  background:#111;
  color:#fff;
  padding:8px 15px;
  margin-top:8px;
}

.newsletter{
  background:#171717;
  color:#fff;
  text-align:center;
  padding:55px 20px;
}

.newsletter p{
  color:#aaa;
  margin:10px 0 22px;
}

.newsletter form{
  max-width:550px;
  margin:auto;
  display:flex;
}

.newsletter input{
  flex:1;
  border:0;
  padding:15px;
  outline:0;
}

.newsletter button{
  border:0;
  background:var(--gold);
  color:#fff;
  padding:0 25px;
}

.category-head{
  background:#fff;
  padding:35px;
  margin-bottom:25px;
}

.category-head h1{font-size:38px}

.category-head p{
  color:#777;
  margin-top:8px;
}

/* CHOOSE */

.choose-page{
  background:
  radial-gradient(circle at 90% 10%,#efe1c4 0,transparent 28%),
  radial-gradient(circle at 10% 90%,#dedbd2 0,transparent 25%),
  #f7f6f2;
}

.choose-hero{
  text-align:center;
  padding:60px 20px 35px;
}

.magic{
  display:inline-flex;
  width:62px;
  height:62px;
  border-radius:50%;
  align-items:center;
  justify-content:center;
  background:#111;
  color:#fff;
  font-size:27px;
  margin-bottom:15px;
}

.choose-hero h1{
  font-size:43px;
  margin-bottom:10px;
}

.choose-hero p{
  color:#777;
  max-width:650px;
  margin:auto;
  line-height:1.8;
}

.choose-box{
  max-width:1000px;
  margin:auto;
  background:#fff;
  padding:30px;
  box-shadow:0 15px 45px #00000010;
}

.choose-box>p{
  color:#777;
  margin:10px 0 25px;
}

.choose-options{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:20px;
}

.choose-option{
  border:1px solid #ddd;
  padding:25px;
  text-align:center;
}

.choose-option p{
  color:#777;
  font-size:13px;
  margin:8px 0 18px;
}

.color-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:10px;
}

.color-btn{
  border:1px solid #ddd;
  background:#fff;
  padding:12px 6px;
  display:flex;
  flex-direction:column;
  align-items:center;
  gap:7px;
}

.color-btn.selected{
  border:2px solid #111;
}

.color-circle{
  width:32px;
  height:32px;
  border-radius:50%;
  border:1px solid #ddd;
}

.black{background:#111}
.white{background:#fff}
.beige{background:#d9c3a5}
.gray{background:#888}
.blue{background:#315c91}
.lightblue{background:#9bc7e8}
.brown{background:#70452b}
.green{background:#55745b}

.upload-area{
  border:2px dashed #ccc;
  padding:35px 15px;
  cursor:pointer;
}

.upload-area input{display:none}

.preview{
  display:none;
  margin-top:15px;
}

.preview.show{display:block}

.preview img{
  max-width:180px;
  max-height:180px;
}

.analyze{
  width:100%;
  margin-top:25px;
  padding:16px;
  background:#111;
  color:#fff;
  border:0;
  font-weight:bold;
}

.choose-result{
  display:none;
  max-width:1100px;
  margin:30px auto 60px;
}

.choose-result.show{display:block}

.result-header{
  background:#111;
  color:#fff;
  padding:28px;
  display:flex;
  align-items:center;
  justify-content:space-between;
}

.result-header p{
  color:#ccc;
  margin-top:8px;
}

.match-score{
  min-width:100px;
  height:100px;
  border-radius:50%;
  border:5px solid #d6b56b;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
}

.match-score b{font-size:25px}

.recommendations{
  background:#fff;
  padding:25px;
}

.look-products{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:15px;
}

.look-card{
  border:1px solid #eee;
  background:#fff;
  overflow:hidden;
}

.look-card img{
  width:100%;
  height:230px;
  object-fit:cover;
}

.look-info{padding:14px}

.match{
  color:var(--green);
  font-weight:bold;
  font-size:12px;
  margin-bottom:6px;
}

.look-info h3{
  font-size:14px;
  margin-bottom:7px;
}

.look-info p{
  color:#777;
  font-size:12px;
}

.look-add{
  width:100%;
  border:0;
  background:#111;
  color:#fff;
  padding:10px;
  margin-top:10px;
}

.complete-look{
  width:100%;
  margin-top:20px;
  padding:15px;
  background:var(--gold);
  color:#fff;
  border:0;
  font-weight:bold;
}

/* ACCOUNT */

.account-page{
  max-width:500px;
  margin:60px auto;
}

.account-box{
  background:#fff;
  padding:35px;
  box-shadow:0 10px 35px #0001;
}

.account-box p{
  color:#777;
  margin:8px 0 25px;
}

.account-box label{
  display:block;
  font-size:13px;
  font-weight:bold;
  margin:14px 0 7px;
}

.account-box input{
  width:100%;
  padding:13px;
  border:1px solid #ddd;
  outline:0;
}

.login,
.register{
  width:100%;
  padding:14px;
  margin-top:12px;
}

.login{
  border:0;
  background:#111;
  color:#fff;
}

.register{
  border:1px solid #111;
  background:#fff;
}

/* CHECKOUT */

.checkout-page{
  max-width:1100px;
  margin:auto;
  padding:45px 25px;
  display:grid;
  grid-template-columns:1.2fr .8fr;
  gap:25px;
}

.checkout-box,
.order-box{
  background:#fff;
  padding:28px;
}

.checkout-box label{
  display:block;
  margin:14px 0 7px;
  font-size:13px;
  font-weight:bold;
}

.checkout-box input{
  width:100%;
  padding:13px;
  border:1px solid #ddd;
  outline:0;
}

.payment-methods{
  display:flex;
  gap:8px;
  margin:15px 0;
}

.payment-methods button{
  flex:1;
  padding:13px;
  background:#fff;
  border:1px solid #ddd;
}

.payment-methods button.active{
  background:#111;
  color:#fff;
}

.card-row{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:10px;
}

.pay{
  width:100%;
  margin-top:20px;
  padding:15px;
  background:var(--gold);
  color:#fff;
  border:0;
  font-weight:bold;
}

.success{
  display:none;
  text-align:center;
  padding:80px 20px;
}

.success.show{display:block}

.success-icon{
  width:75px;
  height:75px;
  border-radius:50%;
  background:#e7f7e9;
  color:#29983a;
  display:flex;
  align-items:center;
  justify-content:center;
  margin:auto auto 20px;
  font-size:40px;
}

/* PRODUCT DETAILS MODAL */

.modal{
  display:none;
  position:fixed;
  inset:0;
  background:#0009;
  z-index:5000;
  overflow-y:auto;
  padding:35px 15px;
}

.modal.show{
  display:flex;
  align-items:flex-start;
  justify-content:center;
}

.product-modal{
  width:100%;
  max-width:1000px;
  background:#fff;
  margin:auto;
  position:relative;
}

.close-modal{
  position:absolute;
  top:15px;
  left:15px;
  z-index:5;
  width:40px;
  height:40px;
  border-radius:50%;
  border:0;
  background:#111;
  color:#fff;
  font-size:24px;
}

.product-detail{
  display:grid;
  grid-template-columns:1fr 1fr;
}

.detail-gallery{
  background:#f2f1ed;
  min-height:600px;
}

.detail-main-image{
  width:100%;
  height:600px;
  object-fit:cover;
}

.detail-info{
  padding:45px 35px;
}

.detail-brand{
  color:#999;
  font-size:12px;
  margin-bottom:10px;
}

.detail-info h1{
  font-size:32px;
  margin-bottom:12px;
}

.detail-rating{
  color:#e2a719;
  margin-bottom:18px;
}

.detail-price{
  font-size:25px;
  font-weight:bold;
}

.detail-old{
  color:#999;
  text-decoration:line-through;
  margin-right:10px;
  font-size:14px;
}

.detail-description{
  color:#666;
  line-height:1.8;
  margin:22px 0;
}

.option-title{
  font-weight:bold;
  margin:20px 0 10px;
}

.selected-value{
  color:#777;
  font-weight:normal;
}

.color-options,
.size-options{
  display:flex;
  flex-wrap:wrap;
  gap:9px;
}

.detail-color{
  min-width:70px;
  padding:10px;
  background:#fff;
  border:1px solid #ddd;
}

.detail-color.selected,
.detail-size.selected{
  border:2px solid #111;
}

.detail-size{
  min-width:55px;
  padding:12px;
  background:#fff;
  border:1px solid #ddd;
}

.quantity-detail{
  display:flex;
  align-items:center;
  gap:12px;
  margin-top:20px;
}

.quantity-detail button{
  width:35px;
  height:35px;
  border:1px solid #ddd;
  background:#fff;
}

.detail-add{
  width:100%;
  margin-top:25px;
  padding:16px;
  border:0;
  background:#111;
  color:#fff;
  font-size:16px;
  font-weight:bold;
}

.detail-add:hover{background:var(--gold)}

.stock{
  color:var(--green);
  font-size:13px;
  margin-top:12px;
}

/* CART */

.overlay{
  display:none;
  position:fixed;
  inset:0;
  background:#0008;
  z-index:3000;
}

.overlay.show{display:block}

.cart{
  position:fixed;
  top:0;
  left:-440px;
  width:420px;
  max-width:92%;
  height:100vh;
  background:#fff;
  z-index:4000;
  transition:.3s;
  display:flex;
  flex-direction:column;
}

.cart.open{left:0}

.cart-head{
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:20px;
  border-bottom:1px solid #eee;
}

.cart-head button{
  background:none;
  border:0;
  font-size:28px;
}

.cart-items{
  flex:1;
  overflow:auto;
  padding:15px;
}

.cart-item{
  display:flex;
  gap:10px;
  padding:13px 0;
  border-bottom:1px solid #eee;
}

.cart-item img{
  width:70px;
  height:80px;
  object-fit:cover;
}

.cart-item-info{flex:1}

.cart-item-info h4{
  font-size:13px;
  margin-bottom:7px;
}

.cart-meta{
  color:#777;
  font-size:11px;
  margin:4px 0;
}

.quantity{
  display:flex;
  align-items:center;
  gap:8px;
  margin-top:8px;
}

.quantity button{
  width:25px;
  height:25px;
  border:1px solid #ddd;
  background:#fff;
}

.remove{
  color:#c22;
}

.cart-footer{
  padding:20px;
  border-top:1px solid #eee;
}

.total{
  display:flex;
  justify-content:space-between;
  margin-bottom:15px;
  font-size:19px;
}

.checkout-btn{
  width:100%;
  padding:14px;
  background:#111;
  color:#fff;
  border:0;
}

/* TOAST */

.toast{
  position:fixed;
  bottom:25px;
  right:25px;
  z-index:9999;
  background:#111;
  color:#fff;
  padding:14px 20px;
  opacity:0;
  transform:translateY(20px);
  transition:.3s;
}

.toast.show{
  opacity:1;
  transform:translateY(0);
}

footer{
  background:#111;
  color:#fff;
  padding:45px 8%;
  display:grid;
  grid-template-columns:2fr 1fr 1fr;
  gap:50px;
}

footer p,
footer button{
  display:block;
  color:#aaa;
  margin-top:10px;
}

footer button{
  background:none;
  border:0;
  padding:0;
}

@media(max-width:900px){

.products{grid-template-columns:repeat(2,1fr)}

.categories{grid-template-columns:1fr}

.checkout-page{grid-template-columns:1fr}

footer{grid-template-columns:1fr}

.look-products{grid-template-columns:repeat(2,1fr)}

.product-detail{grid-template-columns:1fr}

.detail-gallery{min-height:400px}

.detail-main-image{height:400px}

}

@media(max-width:600px){

header{
  flex-wrap:wrap;
  padding:12px;
}

.logo{font-size:23px}

.search{
  order:5;
  flex-basis:100%;
}

nav{justify-content:flex-start}

nav button{padding:15px 16px}

.hero{
  min-height:420px;
  padding:30px 20px;
}

.hero h1{font-size:40px}

.products{
  grid-template-columns:repeat(2,1fr);
  gap:9px;
}

.product-image{height:220px}

.deal,
.coupon{
  flex-direction:column;
  align-items:flex-start;
}

.newsletter form{
  flex-direction:column;
  gap:8px;
}

.newsletter button{padding:13px}

.choose-options{grid-template-columns:1fr}

.color-grid{grid-template-columns:repeat(3,1fr)}

.choose-hero h1{font-size:34px}

.choose-box{
  margin:0 12px;
  padding:20px;
}

.result-header{
  flex-direction:column;
  align-items:flex-start;
  gap:20px;
}

.look-products{grid-template-columns:1fr 1fr}

footer{
  padding:35px 25px;
}

.detail-info{
  padding:35px 20px;
}

.detail-info h1{
  font-size:25px;
}

}

/* PRINT */
@media print{
  body>*{display:none!important}
}
</style>

</head>

<body>

<div class="offer">
🔥 خصم 15% على أول طلب — استخدم الكود <b>WELCOME15</b>
</div>

<header>

<div class="logo" onclick="showPage('home')">
حليم<span>.</span>
</div>

<div class="search">

<input
id="searchInput"
placeholder="ابحث عن قميص، حذاء، بنطلون..."
onkeydown="if(event.key==='Enter')searchProducts()">

<button onclick="searchProducts()">⌕</button>

</div>

<button class="account-btn" onclick="showPage('account')">
👤 حسابي
</button>

<button class="cart-btn" onclick="openCart()">
🛒
<span class="cart-number" id="cartCount">0</span>
</button>

</header>

<nav>

<button data-page="home" onclick="showPage('home')">الرئيسية</button>

<button data-page="choose" onclick="showPage('choose')">✨ اختار لي</button>

<button data-page="shirts" onclick="showPage('shirts')">👕 القمصان</button>

<button data-page="shoes" onclick="showPage('shoes')">👟 الأحذية</button>

<button data-page="pants" onclick="showPage('pants')">👖 البناطيل</button>

<button data-page="account" onclick="showPage('account')">👤 الحساب</button>

</nav>

<!-- HOME -->

<section id="home" class="page active">

<div class="hero">

<div class="hero-content">

<small>HALIM COLLECTION</small>

<h1>أناقتك تبدأ<br>من هنا.</h1>

<p>
اكتشف تشكيلة حليم من القمصان والأحذية والبناطيل،
أو دعنا نختار لك اللوك المناسب.
</p>

<button onclick="showPage('choose')">
✨ اختار لي لوك
</button>

</div>

</div>

<div class="container">

<div class="section-title">
<h2>تسوق حسب الفئة</h2>
<p>اختر القسم الذي تريد التسوق منه</p>
</div>

<div class="categories">

<div class="category-card" onclick="showPage('shirts')">
<img src="https://images.pexels.com/photos/8532616/pexels-photo-8532616.jpeg?auto=compress&cs=tinysrgb&w=900">
<div>👕 القمصان</div>
</div>

<div class="category-card" onclick="showPage('shoes')">
<img src="https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg?auto=compress&cs=tinysrgb&w=900">
<div>👟 الأحذية</div>
</div>

<div class="category-card" onclick="showPage('pants')">
<img src="https://images.pexels.com/photos/1082529/pexels-photo-1082529.jpeg?auto=compress&cs=tinysrgb&w=900">
<div>👖 البناطيل</div>
</div>

</div>

<div class="section-title">
<h2>🔥 الأكثر مبيعاً</h2>
<p>اضغط على أي منتج لرؤية المقاسات والألوان والتفاصيل</p>
</div>

<div class="products" id="homeProducts"></div>

<div class="deal">

<div>
<h2>✨ مش عارف تلبس إيه؟</h2>
<p>خلّي حليم يختار لك اللوك المناسب.</p>
</div>

<button onclick="showPage('choose')">
اختار لي
</button>

</div>

<div class="section-title">
<h2>✨ People may also like</h2>
<p>منتجات قد تعجبك أيضاً</p>
</div>

<div class="products" id="recommended"></div>

<div class="coupon">

<div>
<h2>🎁 خصم 15% لأول طلب</h2>
<p>استخدم الكود عند إتمام الطلب.</p>
</div>

<div>
<div class="coupon-code">WELCOME15</div>
<button onclick="copyCoupon()">نسخ الكود</button>
</div>

</div>

</div>

<div class="newsletter">

<h2>كن أول من يعرف</h2>

<p>سجل بريدك ليصلك أحدث المنتجات والعروض.</p>

<form onsubmit="subscribe(event)">

<input
id="email"
type="email"
required
placeholder="البريد الإلكتروني">

<button>اشترك الآن</button>

</form>

</div>

</section>

<!-- CHOOSE -->

<section id="choose" class="page choose-page">

<div class="choose-hero">

<div class="magic">✨</div>

<h1>اختار لي</h1>

<p>
عندك بنطلون ومش عارف تلبس عليه إيه؟
اختر اللون أو ارفع صورة، وحليم يقترح لك
ألوان وقطع مناسبة لعمل لوك كامل.
</p>

</div>

<div class="choose-box">

<h2>👖 أولاً، ورّينا البنطلون</h2>

<p>اختر لون البنطلون أو ارفع صورة له.</p>

<div class="choose-options">

<div class="choose-option">

<h3>🎨 اختر اللون</h3>

<p>اختر أقرب لون لبنطلونك.</p>

<div class="color-grid">

<button class="color-btn" onclick="selectColor('black',this)">
<span class="color-circle black"></span>
أسود
</button>

<button class="color-btn" onclick="selectColor('blue',this)">
<span class="color-circle blue"></span>
أزرق
</button>

<button class="color-btn" onclick="selectColor('lightblue',this)">
<span class="color-circle lightblue"></span>
أزرق فاتح
</button>

<button class="color-btn" onclick="selectColor('beige',this)">
<span class="color-circle beige"></span>
بيج
</button>

<button class="color-btn" onclick="selectColor('gray',this)">
<span class="color-circle gray"></span>
رمادي
</button>

<button class="color-btn" onclick="selectColor('brown',this)">
<span class="color-circle brown"></span>
بني
</button>

<button class="color-btn" onclick="selectColor('green',this)">
<span class="color-circle green"></span>
أخضر
</button>

<button class="color-btn" onclick="selectColor('white',this)">
<span class="color-circle white"></span>
أبيض
</button>

</div>

</div>

<div class="choose-option">

<h3>📷 عندك صورة؟</h3>

<p>ارفع صورة البنطلون.</p>

<label class="upload-area">

<div style="font-size:40px">📸</div>

<strong>اضغط لاختيار صورة</strong>

<p style="margin-top:8px">JPG / PNG</p>

<input
type="file"
id="pantsImage"
accept="image/*"
onchange="previewPants(event)">

</label>

<div id="preview" class="preview">
<img id="previewImage">
<p style="margin-top:8px;color:#777">تم اختيار الصورة ✓</p>
</div>

</div>

</div>

<button class="analyze" onclick="generateLook()">
✨ اقترح لي اللوك المناسب
</button>

</div>

<div id="chooseResult" class="choose-result">

<div class="result-header">

<div>
<h2 id="resultTitle">اختيار حليم لك ✨</h2>
<p id="resultDescription">اقتراحات متناسقة مع اختيارك.</p>
</div>

<div class="match-score">
<b id="score">96%</b>
<span>توافق</span>
</div>

</div>

<div class="recommendations">

<h2 style="margin-bottom:20px">القطع المقترحة لك</h2>

<div id="lookProducts" class="look-products"></div>

<button
class="complete-look"
onclick="addRecommendedLook()">
🛍️ أضف اللوك المقترح للسلة </button>

</div>

</div>

</section>

<!-- SHIRTS -->

<section id="shirts" class="page">

<div class="container">

<div class="category-head">

<h1>👕 القمصان</h1>

<p>اضغط على أي قميص لمعرفة الألوان والمقاسات المتوفرة.</p>

</div>

<div class="products" id="shirtsProducts"></div>

</div>

</section>

<!-- SHOES -->

<section id="shoes" class="page">

<div class="container">

<div class="category-head">

<h1>👟 الأحذية</h1>

<p>اختر اللون والمقاس المناسب قبل الإضافة للسلة.</p>

</div>

<div class="products" id="shoesProducts"></div>

</div>

</section>

<!-- PANTS -->

<section id="pants" class="page">

<div class="container">

<div class="category-head">

<h1>👖 البناطيل</h1>

<p>اختر المقاس واللون المناسب.</p>

</div>

<div class="products" id="pantsProducts"></div>

</div>

</section>

<!-- ACCOUNT -->

<section id="account" class="page">

<div class="account-page">

<div class="account-box">

<div style="font-size:45px">👤</div>

<h1>حسابي</h1>

<p>سجل الدخول لمتابعة طلباتك.</p>

<label>البريد الإلكتروني</label>

<input id="loginEmail" type="email" placeholder="example@email.com">

<label>كلمة المرور</label>

<input id="loginPassword" type="password" placeholder="••••••••">

<button class="login" onclick="login()">تسجيل الدخول</button>

<button class="register" onclick="register()">إنشاء حساب جديد</button>

</div>

</div>

</section>

<!-- CHECKOUT -->

<section id="checkout" class="page">

<div id="checkoutContent">

<div class="checkout-page">

<div class="checkout-box">

<h1>إتمام الطلب</h1>

<label>الاسم الكامل</label> <input id="customerName" placeholder="اسم المستلم">

<label>رقم الهاتف</label> <input id="customerPhone" placeholder="01xxxxxxxxx">

<label>العنوان</label> <input id="customerAddress" placeholder="المحافظة، المدينة، الشارع">

<label>طريقة الدفع</label>

<div class="payment-methods">

<button id="cardMethod" class="active" onclick="selectPayment('card')">
💳 بطاقة
</button>

<button id="cashMethod" onclick="selectPayment('cash')">
🚚 عند الاستلام
</button>

</div>

<div id="cardFields">

<label>اسم صاحب البطاقة</label> <input id="cardName" placeholder="الاسم على البطاقة">

<label>رقم البطاقة</label> <input id="cardNumber" maxlength="19" inputmode="numeric" placeholder="0000 0000 0000 0000">

<div class="card-row">

<div>
<label>تاريخ الانتهاء</label>
<input id="expiry" maxlength="5" placeholder="MM/YY">
</div>

<div>
<label>CVV</label>
<input id="cvv" maxlength="4" type="password" placeholder="123">
</div>

</div>

</div>

<button class="pay" onclick="placeOrder()">
🔒 تأكيد الطلب
</button>

<p style="font-size:11px;color:#999;margin-top:12px;text-align:center">
الدفع هنا تجريبي فقط — لا تدخل بيانات بطاقة حقيقية.
</p>

</div>

<div class="order-box">

<h2>ملخص الطلب</h2>

<div id="orderItems"></div>

<div class="total">
<span>الإجمالي</span>
<span><b id="orderTotal">0</b> جنيه</span>
</div>

</div>

</div>

</div>

<div id="success" class="success">

<div class="success-icon">✓</div>

<h1>تم الطلب بنجاح 🎉</h1>

<p>رقم الطلب</p>

<h2 id="orderNumber"></h2>

<br>

<button
onclick="showPage('home')"
style="padding:13px 25px;background:#111;color:#fff;border:0">
العودة للمتجر </button>

</div>

</section>

<!-- PRODUCT MODAL -->

<div id="productModal" class="modal">

<div class="product-modal">

<button class="close-modal" onclick="closeProductModal()">×</button>

<div class="product-detail">

<div class="detail-gallery">

<img
id="detailImage"
class="detail-main-image"
src=""
alt="">

</div>

<div class="detail-info">

<div class="detail-brand">حليم | HALIM</div>

<h1 id="detailName"></h1>

<div class="detail-rating">
★★★★★ <span id="detailRating"></span>
</div>

<div>

<span id="detailPrice" class="detail-price"></span>

<span id="detailOld" class="detail-old"></span>

</div>

<p id="detailDescription" class="detail-description"></p>

<div class="stock">
✓ متوفر في المخزون
</div>

<div class="option-title">
اللون:
<span id="selectedColorText" class="selected-value">
اختر لوناً
</span>
</div>

<div id="detailColors" class="color-options"></div>

<div class="option-title">
المقاس:
<span id="selectedSizeText" class="selected-value">
اختر مقاساً
</span>
</div>

<div id="detailSizes" class="size-options"></div>

<div class="quantity-detail">

<strong>الكمية</strong>

<button onclick="changeDetailQuantity(-1)">−</button>

<span id="detailQuantity">1</span>

<button onclick="changeDetailQuantity(1)">+</button>

</div>

<button class="detail-add" onclick="addDetailProduct()">
أضف إلى السلة
</button>

</div>

</div>

</div>

</div>

<!-- CART -->

<div id="overlay" class="overlay" onclick="closeCart()"></div>

<aside id="cart" class="cart">

<div class="cart-head">

<h2>سلة التسوق</h2>

<button onclick="closeCart()">×</button>

</div>

<div id="cartItems" class="cart-items"></div>

<div class="cart-footer">

<div class="total">

<span>الإجمالي</span>

<b><span id="cartTotal">0</span> جنيه</b>

</div>

<button class="checkout-btn" onclick="checkout()">
متابعة للدفع
</button>

</div>

</aside>

<div id="toast" class="toast"></div>

<footer>

<div>

<h2>حليم.</h2>

<p>متجر متخصص في القمصان والأحذية والبناطيل.</p>

</div>

<div>

<h3>التسوق</h3>

<p><button onclick="showPage('choose')">✨ اختار لي</button></p>
<p><button onclick="showPage('shirts')">القمصان</button></p>
<p><button onclick="showPage('shoes')">الأحذية</button></p>
<p><button onclick="showPage('pants')">البناطيل</button></p>

</div>

<div>

<h3>خدمة العملاء</h3>

<p>الشحن والتوصيل</p>
<p>الإرجاع والاستبدال</p>
<p>الدعم والمساعدة</p>

</div>

</footer>

<script>

/* =========================
   PRODUCTS
========================= */

const products=[

{
id:1,
category:"shirts",
name:"تيشيرت أبيض كلاسيك",
price:299,
old:399,
rating:"4.9",
badge:"الأكثر مبيعاً",
description:"تيشيرت قطني مريح بتصميم كلاسيكي، مناسب للستايل اليومي والكاجوال.",
colors:["أبيض","أسود","رمادي"],
colorCodes:["white","black","gray"],
sizes:["S","M","L","XL","XXL"],
image:"https://images.pexels.com/photos/8532616/pexels-photo-8532616.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:2,
category:"shirts",
name:"تيشيرت بيج كاجوال",
price:349,
old:449,
rating:"4.8",
badge:"جديد",
description:"تيشيرت بيج ناعم بتصميم بسيط يناسب الجينز والبناطيل الكاجوال.",
colors:["بيج","أبيض","بني"],
colorCodes:["beige","white","brown"],
sizes:["S","M","L","XL"],
image:"https://images.pexels.com/photos/6311392/pexels-photo-6311392.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:3,
category:"shirts",
name:"قميص أزرق فاتح أنيق",
price:449,
old:599,
rating:"4.7",
badge:"",
description:"قميص أنيق مناسب للعمل والمناسبات، بقصة عصرية وخامة مريحة.",
colors:["أزرق فاتح","أبيض","كحلي"],
colorCodes:["lightblue","white","navy"],
sizes:["M","L","XL","XXL"],
image:"https://images.pexels.com/photos/1043474/pexels-photo-1043474.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:4,
category:"shirts",
name:"قميص أبيض رسمي",
price:499,
old:650,
rating:"4.9",
badge:"محدود",
description:"قميص أبيض أنيق بتصميم رسمي، مناسب للعمل والمناسبات.",
colors:["أبيض","أزرق","أسود"],
colorCodes:["white","blue","black"],
sizes:["M","L","XL","XXL"],
image:"https://images.pexels.com/photos/297933/pexels-photo-297933.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:5,
category:"shirts",
name:"تيشيرت رمادي Premium",
price:379,
old:470,
rating:"4.8",
badge:"",
description:"تيشيرت رمادي بخامة Premium وقصة مريحة للارتداء اليومي.",
colors:["رمادي","أسود","أبيض"],
colorCodes:["gray","black","white"],
sizes:["S","M","L","XL"],
image:"https://images.pexels.com/photos/6311613/pexels-photo-6311613.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:6,
category:"shirts",
name:"تيشيرت كحلي أنيق",
price:359,
old:450,
rating:"4.7",
badge:"",
description:"تيشيرت كحلي متعدد الاستخدامات يناسب أغلب ألوان البناطيل.",
colors:["كحلي","أبيض","رمادي"],
colorCodes:["navy","white","gray"],
sizes:["S","M","L","XL","XXL"],
image:"https://images.pexels.com/photos/6311654/pexels-photo-6311654.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:7,
category:"shoes",
name:"حذاء رياضي أبيض",
price:999,
old:1250,
rating:"4.9",
badge:"الأكثر مبيعاً",
description:"حذاء رياضي أبيض بتصميم عصري ومناسب للاستخدام اليومي.",
colors:["أبيض","أسود","رمادي"],
colorCodes:["white","black","gray"],
sizes:["39","40","41","42","43","44","45"],
image:"https://images.pexels.com/photos/1464625/pexels-photo-1464625.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:8,
category:"shoes",
name:"حذاء رياضي أسود",
price:899,
old:1100,
rating:"4.9",
badge:"رائج",
description:"حذاء أسود رياضي بتصميم عملي يناسب الجينز والبناطيل اليومية.",
colors:["أسود","أبيض","رمادي"],
colorCodes:["black","white","gray"],
sizes:["39","40","41","42","43","44","45"],
image:"https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:9,
category:"shoes",
name:"حذاء كاجوال بني",
price:799,
old:950,
rating:"4.7",
badge:"",
description:"حذاء بني أنيق مناسب للستايل الكاجوال وشبه الرسمي.",
colors:["بني","أسود"],
colorCodes:["brown","black"],
sizes:["40","41","42","43","44"],
image:"https://images.pexels.com/photos/11559288/pexels-photo-11559288.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:10,
category:"shoes",
name:"حذاء أبيض عصري",
price:899,
old:1050,
rating:"4.8",
badge:"جديد",
description:"حذاء أبيض خفيف بتصميم عصري مناسب للإطلالات اليومية.",
colors:["أبيض","بيج"],
colorCodes:["white","beige"],
sizes:["39","40","41","42","43","44"],
image:"https://images.pexels.com/photos/19090/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=900"
},

{
id:11,
category:"pants",
name:"جينز أزرق فاتح",
price:599,
old:750,
rating:"4.8",
badge:"الأكثر مبيعاً",
description:"جينز أزرق فاتح بقصة عصرية، مناسب للقمصان والتيشيرتات.",
colors:["أزرق فاتح","أزرق","أسود"],
colorCodes:["lightblue","blue","black"],
sizes:["28","30","32","34","36","38"],
image:"https://images.pexels.com/photos/1082529/pexels-photo-1082529.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:12,
category:"pants",
name:"جينز أزرق كلاسيك",
price:649,
old:800,
rating:"4.9",
badge:"جديد",
description:"جينز أزرق كلاسيكي بقصة مريحة يناسب الإطلالات اليومية.",
colors:["أزرق","أزرق فاتح","أسود"],
colorCodes:["blue","lightblue","black"],
sizes:["28","30","32","34","36","38","40"],
image:"https://images.pexels.com/photos/298863/pexels-photo-298863.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:13,
category:"pants",
name:"جينز أسود داكن",
price:699,
old:850,
rating:"4.7",
badge:"",
description:"جينز أسود أنيق يمكن تنسيقه مع الألوان الفاتحة والغامقة.",
colors:["أسود","رمادي","أزرق"],
colorCodes:["black","gray","blue"],
sizes:["28","30","32","34","36","38"],
image:"https://images.pexels.com/photos/7679720/pexels-photo-7679720.jpeg?auto=compress&cs=tinysrgb&w=900"
},

{
id:14,
category:"pants",
name:"بنطلون جينز عصري",
price:599,
old:720,
rating:"4.8",
badge:"محدود",
description:"بنطلون جينز بقصة عصرية ومريحة للاستخدام اليومي.",
colors:["أزرق","أسود"],
colorCodes:["blue","black"],
sizes:["30","32","34","36","38"],
image:"https://images.pexels.com/photos/1598507/pexels-photo-1598507.jpeg?auto=compress&cs=tinysrgb&w=900"
}

];


/* =========================
   STATE
========================= */

let cart=JSON.parse(
localStorage.getItem("halimCart")||"[]"
);

let detailProduct=null;
let detailColor=null;
let detailSize=null;
let detailQuantity=1;

let selectedColor=null;
let selectedRecommendations=[];

let payment="card";


/* =========================
   PRODUCT CARD
========================= */

function productCard(product){

return `

<article
class="product"
onclick="openProduct(${product.id})">

${
product.badge
?
`<span class="badge">${product.badge}</span>`
:
""
}

<div class="product-image">

<img
src="${product.image}"
alt="${product.name}"
onerror="this.src='https://placehold.co/600x700?text=Halim'">

</div>

<div class="product-info">

<div class="brand">حليم</div>

<div class="product-name">
${product.name}
</div>

<div class="rating">
★★★★★ <span>${product.rating}</span>
</div>

<div>

<span class="price">${product.price} جنيه</span>

<span class="old-price">${product.old} جنيه</span>

</div>

<button
class="add"
onclick="event.stopPropagation();openProduct(${product.id})">
اختيار اللون والمقاس
</button>

</div>

</article>

`;
}


/* =========================
   RENDER
========================= */

function renderProducts(){

document.getElementById("homeProducts").innerHTML=
products.slice(0,8).map(productCard).join("");

document.getElementById("shirtsProducts").innerHTML=
products.filter(p=>p.category==="shirts").map(productCard).join("");

document.getElementById("shoesProducts").innerHTML=
products.filter(p=>p.category==="shoes").map(productCard).join("");

document.getElementById("pantsProducts").innerHTML=
products.filter(p=>p.category==="pants").map(productCard).join("");

document.getElementById("recommended").innerHTML=
[
products[0],
products[7],
products[11],
products[2]
].map(productCard).join("");

}


/* =========================
   PRODUCT DETAILS
========================= */

function openProduct(id){

detailProduct=
products.find(p=>p.id===id);

if(!detailProduct)return;

detailColor=null;
detailSize=null;
detailQuantity=1;

document.getElementById("detailImage").src=
detailProduct.image;

document.getElementById("detailName").textContent=
detailProduct.name;

document.getElementById("detailRating").textContent=
detailProduct.rating;

document.getElementById("detailPrice").textContent=
detailProduct.price+" جنيه";

document.getElementById("detailOld").textContent=
detailProduct.old+" جنيه";

document.getElementById("detailDescription").textContent=
detailProduct.description;

document.getElementById("detailQuantity").textContent="1";

document.getElementById("selectedColorText").textContent=
"اختر لوناً";

document.getElementById("selectedSizeText").textContent=
"اختر مقاساً";


/* COLORS */

const colorBox=
document.getElementById("detailColors");

colorBox.innerHTML=
detailProduct.colors.map((color,index)=>`

<button
class="detail-color"
onclick="selectDetailColor('${color}',this)">

<span
style="
display:inline-block;
width:18px;
height:18px;
border-radius:50%;
vertical-align:middle;
margin-left:5px;
background:${getColorCSS(detailProduct.colorCodes[index])};
border:1px solid #ddd">
</span>

${color}

</button>

`).join("");


/* SIZES */

const sizeBox=
document.getElementById("detailSizes");

sizeBox.innerHTML=
detailProduct.sizes.map(size=>`

<button
class="detail-size"
onclick="selectDetailSize('${size}',this)">
${size}
</button>

`).join("");


document
.getElementById("productModal")
.classList.add("show");

document.body.style.overflow="hidden";

}


function getColorCSS(color){

const colors={
white:"#fff",
black:"#111",
gray:"#888",
beige:"#d9c3a5",
blue:"#315c91",
lightblue:"#9bc7e8",
brown:"#70452b",
green:"#55745b",
navy:"#172b4d"
};

return colors[color]||"#ddd";

}


function selectDetailColor(color,button){

detailColor=color;

document
.querySelectorAll(".detail-color")
.forEach(x=>x.classList.remove("selected"));

button.classList.add("selected");

document.getElementById("selectedColorText")
.textContent=color;

}


function selectDetailSize(size,button){

detailSize=size;

document
.querySelectorAll(".detail-size")
.forEach(x=>x.classList.remove("selected"));

button.classList.add("selected");

document.getElementById("selectedSizeText")
.textContent=size;

}


function changeDetailQuantity(amount){

detailQuantity+=amount;

if(detailQuantity<1)
detailQuantity=1;

if(detailQuantity>10)
detailQuantity=10;

document.getElementById("detailQuantity")
.textContent=detailQuantity;

}


function addDetailProduct(){

if(!detailProduct)return;

if(!detailColor){

showToast("اختار اللون أولاً 🎨");

return;

}

if(!detailSize){

showToast("اختار المقاس أولاً 📏");

return;

}


const existing=
cart.find(item=>
item.id===detailProduct.id &&
item.color===detailColor &&
item.size===detailSize
);


if(existing){

existing.quantity+=detailQuantity;

}else{

cart.push({

id:detailProduct.id,

name:detailProduct.name,

price:detailProduct.price,

image:detailProduct.image,

color:detailColor,

size:detailSize,

quantity:detailQuantity

});

}

saveCart();
updateCart();

closeProductModal();

showToast(
"تمت إضافة المنتج بالمقاس واللون المحددين ✓"
);

}


function closeProductModal(){

document
.getElementById("productModal")
.classList.remove("show");

document.body.style.overflow="";

}


/* =========================
   CART
========================= */

function saveCart(){

localStorage.setItem(
"halimCart",
JSON.stringify(cart)
);

}


function updateCart(){

const count=
cart.reduce(
(sum,item)=>sum+item.quantity,
0
);

document.getElementById("cartCount").textContent=count;

const box=document.getElementById("cartItems");

if(!cart.length){

box.innerHTML=`

<div style="text-align:center;padding:70px 10px;color:#777">

<div style="font-size:45px">🛍️</div>

<h3>السلة فارغة</h3>

<p style="margin-top:8px">
أضف بعض المنتجات أولاً.
</p>

</div>

`;

document.getElementById("cartTotal").textContent="0";

return;

}


box.innerHTML=
cart.map((item,index)=>`

<div class="cart-item">

<img
src="${item.image}"
onerror="this.src='https://placehold.co/300x300?text=Halim'">

<div class="cart-item-info">

<h4>${item.name}</h4>

<strong>${item.price} جنيه</strong>

<div class="cart-meta">
🎨 اللون: ${item.color}
</div>

<div class="cart-meta">
📏 المقاس: ${item.size}
</div>

<div class="quantity">

<button onclick="changeQuantity(${index},-1)">
−
</button>

<span>${item.quantity}</span>

<button onclick="changeQuantity(${index},1)">
+
</button>

<button
class="remove"
onclick="removeItem(${index})">
×
</button>

</div>

</div>

</div>

`).join("");


const total=
cart.reduce(
(sum,item)=>
sum+(item.price*item.quantity),
0
);

document.getElementById("cartTotal")
.textContent=
total.toLocaleString("ar-EG");

}


function changeQuantity(index,amount){

if(!cart[index])return;

cart[index].quantity+=amount;

if(cart[index].quantity<=0){

cart.splice(index,1);

}

saveCart();
updateCart();

}


function removeItem(index){

cart.splice(index,1);

saveCart();
updateCart();

}


function openCart(){

document.getElementById("cart").classList.add("open");

document.getElementById("overlay").classList.add("show");

}


function closeCart(){

document.getElementById("cart").classList.remove("open");

document.getElementById("overlay").classList.remove("show");

}


/* =========================
   NAVIGATION
========================= */

function showPage(page){

document
.querySelectorAll(".page")
.forEach(p=>p.classList.remove("active"));

const selected=
document.getElementById(page);

if(selected){
selected.classList.add("active");
}

document
.querySelectorAll("nav button")
.forEach(btn=>{
btn.classList.remove("active");

if(btn.dataset.page===page){
btn.classList.add("active");
}
});

window.scrollTo({
top:0,
behavior:"smooth"
});

if(page==="checkout"){
// Reset checkout view so a new order can be made without reopening the site.
document.getElementById("checkoutContent").style.display="block";
document.getElementById("success").classList.remove("show");
renderCheckout();
}

}


/* =========================
   SEARCH
========================= */

function searchProducts(){

const rawQuery=
document.getElementById("searchInput").value.trim().toLowerCase();

const box=document.getElementById("homeProducts");

if(!rawQuery){
box.innerHTML=products.slice(0,8).map(productCard).join("");
showPage("home");
return;
}

// Normalize common Arabic letter variations for easier searching.
const normalizeText=text=>String(text||"")
.toLowerCase()
.replace(/[أإآ]/g,"ا")
.replace(/ى/g,"ي")
.replace(/ة/g,"ه")
.replace(/ـ/g,"");

const query=normalizeText(rawQuery);

const categoryNames={
shirts:"قمصان",
shoes:"احذيه",
pants:"بناطيل"
};

const results=products.filter(p=>{
const searchable=[
 p.name,
 p.description,
 p.category,
 categoryNames[p.category],
 ...(p.colors||[])
].map(normalizeText).join(" ");
return searchable.includes(query);
});

showPage("home");

if(!results.length){
box.innerHTML=`
<div style="grid-column:1/-1;padding:60px;text-align:center">
<h2>لا توجد نتائج</h2>
<p style="color:#777;margin-top:10px">
جرّب البحث باسم المنتج أو الفئة أو اللون.
</p>
</div>`;
return;
}

box.innerHTML=results.map(productCard).join("");

}


/* =========================
   CHOOSE ME
========================= */

const colorNames={
black:"الأسود",
blue:"الأزرق",
lightblue:"الأزرق الفاتح",
beige:"البيج",
gray:"الرمادي",
brown:"البني",
green:"الأخضر",
white:"الأبيض"
};

const styleRules={

black:{
shirts:["white","beige","gray","lightblue"],
shoes:["white","brown","black"],
score:97,
style:"ستايل عصري وأنيق"
},

blue:{
shirts:["white","beige","lightblue","gray"],
shoes:["white","brown","black"],
score:96,
style:"ستايل كاجوال متوازن"
},

lightblue:{
shirts:["white","beige","gray","navy"],
shoes:["white","brown"],
score:95,
style:"ستايل صيفي هادئ"
},

beige:{
shirts:["white","black","navy","green"],
shoes:["white","brown","black"],
score:98,
style:"ستايل راقي ودافئ"
},

gray:{
shirts:["white","black","lightblue","navy"],
shoes:["white","black"],
score:96,
style:"ستايل Minimal أنيق"
},

brown:{
shirts:["white","beige","green"],
shoes:["brown","white"],
score:94,
style:"ستايل دافئ وكاجوال"
},

green:{
shirts:["white","beige","black"],
shoes:["white","brown"],
score:93,
style:"ستايل طبيعي ومميز"
},

white:{
shirts:["black","blue","beige","gray"],
shoes:["white","black","brown"],
score:98,
style:"ستايل نظيف ومتعدد الخيارات"
}

};


function selectColor(color,button){

selectedColor=color;

document
.querySelectorAll(".color-btn")
.forEach(btn=>btn.classList.remove("selected"));

button.classList.add("selected");

showToast(
"تم اختيار البنطلون: "+
colorNames[color]
);

}


function previewPants(event){

const file=event.target.files[0];

if(!file)return;

const reader=new FileReader();

reader.onload=function(e){

document.getElementById("previewImage").src=e.target.result;

document.getElementById("preview").classList.add("show");

showToast("تم تحميل الصورة ✓");

};

reader.readAsDataURL(file);

}


function generateLook(){

if(!selectedColor){

const image=
document.getElementById("pantsImage");

if(image.files.length){

selectedColor="blue";

}else{

showToast(
"اختر لون البنطلون أو ارفع صورة أولاً"
);

return;

}

}

const rule=styleRules[selectedColor];

const shirts=
products.filter(p=>
p.category==="shirts" &&
rule.shirts.some(c=>p.colorCodes.includes(c))
);

const shoes=
products.filter(p=>
p.category==="shoes" &&
rule.shoes.some(c=>p.colorCodes.includes(c))
);

selectedRecommendations=[
...shirts.slice(0,3),
...shoes.slice(0,1)
];

document.getElementById("chooseResult").classList.add("show");

document.getElementById("resultTitle").textContent=
`اختيار حليم للبنطلون ${colorNames[selectedColor]} ✨`;

document.getElementById("resultDescription").textContent=
`اخترنا لك قطعاً تتناسق مع ${colorNames[selectedColor]} — ${rule.style}.`;

document.getElementById("score").textContent=
rule.score+"%";

document.getElementById("lookProducts").innerHTML=
selectedRecommendations.map(lookCard).join("");

setTimeout(()=>{
document.getElementById("chooseResult").scrollIntoView({
behavior:"smooth"
});
},100);

}


function lookCard(product)
{

return `

<div class="look-card">

<img src="${product.image}">

<div class="look-info">

<div class="match">✓ مناسب جداً</div>

<h3>${product.name}</h3>

<p>اضغط لاختيار اللون والمقاس.</p>

<strong>${product.price} جنيه</strong>

<button
class="look-add"
onclick="openProduct(${product.id})">
اختيار اللون والمقاس
</button>

</div>

</div>

`;

}


function addRecommendedLook(){

if(!selectedRecommendations.length){

showToast("قم بعمل اقتراح أولاً");

return;

}

showToast(
"اختَر اللون والمقاس لكل قطعة لإضافتها للسلة."
);

openProduct(selectedRecommendations[0].id);

}


/* =========================
   CHECKOUT
========================= */

function checkout(){

if(!cart.length){

showToast("السلة فارغة");

return;

}

closeCart();

showPage("checkout");

}


function renderCheckout(){

const box=document.getElementById("orderItems");

if(!cart.length){

box.innerHTML="<p>السلة فارغة.</p>";

document.getElementById("orderTotal").textContent="0";

return;

}

box.innerHTML=
cart.map(item=>`

<div
style="
padding:12px 0;
border-bottom:1px solid #eee;
font-size:13px">

<strong>${item.name}</strong>

<br>

<span style="color:#777">
اللون: ${item.color} — المقاس: ${item.size}
</span>

<br>

× ${item.quantity}

<span style="float:left">
${(item.price*item.quantity).toLocaleString("ar-EG")} جنيه
</span>

</div>

`).join("");

const total=
cart.reduce(
(sum,item)=>
sum+(item.price*item.quantity),
0
);

document.getElementById("orderTotal")
.textContent=
total.toLocaleString("ar-EG");

}


function selectPayment(type){

payment=type;

document.getElementById("cardFields").style.display=
type==="card"?"block":"none";

document.getElementById("cardMethod").classList.toggle(
"active",
type==="card"
);

document.getElementById("cashMethod").classList.toggle(
"active",
type==="cash"
);

}


/* =========================
   CARD FORMATTING
========================= */

document.addEventListener("input",function(e){

if(e.target.id==="cardNumber"){

let value=
e.target.value
.replace(/\D/g,"")
.substring(0,16);

e.target.value=
value.match(/.{1,4}/g)?.join(" ")||"";

}

if(e.target.id==="expiry"){

let value=
e.target.value
.replace(/\D/g,"")
.substring(0,4);

if(value.length>2){

value=
value.substring(0,2)+
"/"+
value.substring(2);

}

e.target.value=value;

}

});
async function placeOrder()
{

const name =
document.getElementById("customerName").value.trim();

const phone =
document.getElementById("customerPhone").value.trim();

const address =
document.getElementById("customerAddress").value.trim();

if(!name || !phone || !address){

showToast("أكمل بيانات التوصيل أولاً");

return;

}

if(!cart.length){

showToast("السلة فارغة");

return;

}

if(payment === "card"){

const card =
document.getElementById("cardNumber")
.value.replace(/\s/g,"");

const expiry =
document.getElementById("expiry").value;

const cvv =
document.getElementById("cvv").value;

if(card.length !== 16){

showToast("أدخل 16 رقماً للبطاقة التجريبية");

return;

}

if(!/^\d{2}\/\d{2}$/.test(expiry)){

showToast("أدخل التاريخ بصيغة MM/YY");

return;

}

if(!/^\d{3,4}$/.test(cvv)){

showToast("أدخل CVV تجريبي صحيح");

return;

}

}

try{

showToast("جاري حفظ الطلب...");

const response = await fetch("place_order.php",{

method:"POST",

headers:{
"Content-Type":"application/json"
},

body:JSON.stringify({

customer_name:name,

phone:phone,

address:address,

cart:cart

})

});

const data = await response.json();

if(!response.ok || !data.success){

throw new Error(
data.message || "فشل حفظ الطلب"
);

}

document.getElementById("orderNumber")
.textContent =
"HALIM-" + data.sale_id;

cart = [];

saveCart();

updateCart();

document.getElementById("checkoutContent")
.style.display = "none";

document.getElementById("success")
.classList.add("show");

showToast("تم حفظ الطلب بنجاح ✓");

}catch(error){

console.error(error);

showToast(
"خطأ في حفظ الطلب: " + error.message
);

}

}


/* =========================
   ACCOUNT
========================= */

function login(){

const email=
document.getElementById("loginEmail").value.trim();

const password=
document.getElementById("loginPassword").value;

if(!email||!password){

showToast("أدخل البريد وكلمة المرور");

return;

}

localStorage.setItem("halimUser",email);

showToast("تم تسجيل الدخول بنجاح ✓");

}


function register(){

showToast(
"التسجيل حالياً تجريبي — يحتاج Backend لحفظ الحسابات."
);

}


/* =========================
   NEWSLETTER
========================= */

function subscribe(event){

event.preventDefault();

const email=document.getElementById("email").value;

localStorage.setItem("halimNewsletter",email);

event.target.reset();

showToast("تم الاشتراك بنجاح 🎉");

}


/* =========================
   COUPON
========================= */

function copyCoupon(){

if(navigator.clipboard){
navigator.clipboard.writeText("WELCOME15");
}

showToast("تم نسخ كود WELCOME15 ✓");

}


/* =========================
   TOAST
========================= */

let toastTimer;

function showToast(message){

const toast=document.getElementById("toast");

toast.textContent=message;

toast.classList.add("show");

clearTimeout(toastTimer);

toastTimer=setTimeout(()=>{
toast.classList.remove("show");
},2500);

}


/* =========================
   START
========================= */

renderProducts();

updateCart();

document
.querySelector('nav button[data-page="home"]')
.classList.add("active");

</script>

</body>
</html>
