<!-- Connect to the database -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Compare (AI)Gully Worldwide</title>
  <!-- bootstrap CSS link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- css file -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Navigation Bar -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg bg-gray">
  <div class="container-fluid">
    <img src="./images/gully-logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ai-product-compare.php">Product Compare (AI)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
                <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
                <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
                <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup>
<?php
// Calling the function to get cart item count
cart_item();
?></sup></a> 
        </li>
                <li class="nav-item">
          <a class="nav-link" href="#">Total Price: ₱<?php echo total_cart_price(); ?></a>
        </li>
      </ul>
      <form class="d-flex" action ="search_products.php " method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" autocomplete="off">
      <input type="submit" value="Search" class="btn btn-outline-black search-btn" style="border: 1px solid black;" name="search_data_product">
      <style>
        .search-btn:hover {
          background-color: black !important;
          color: white !important;
        }
        .search-btn:active {
          opacity: 0.7;
        }
      </style>
    </div>
  </div>
</nav>
<!-- Calling Cart Function -->
<?php
cart();
?>
<!-- second child -->
<nav class="navbar navbar-expand-lg ps-2" style="background-color: black;">
  <ul class="navbar-nav me-auto">
<?php
if(!isset($_SESSION['username'])) {
  echo " <li class='nav-item'>
      <a class='nav-link text-white' href='#'>Welcome Guest</a>
    </li>";
} else {
  echo "<li class='nav-item'>
          <a class='nav-link text-white' href='#'>Welcome ".$_SESSION['username']."</a>
        </li>";
}
if(!isset($_SESSION['username'])) {
  echo "<li class='nav-item'>
          <a class='nav-link text-white' href='./users_area/user_login.php'>Login</a>
        </li>";
} else {
  echo "<li class='nav-item'>
          <a class='nav-link text-white' href='./users_area/logout.php'>Logout</a>
        </li>";
}
?>
  </ul>
</nav>

<!-- third child -->
<div class="bg-light">
  <h3 class="text-center">Gully Worldwide</h3>
  <p class="text-center">Your one-stop shop</p>
</div>


<div class="bg-light main-content py-5">
  <div class="container">
    <h2 class="text-center mb-4">Compare Products</h2>
    <div class="row justify-content-center">
      <!-- Product 1 Column -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-bottom-0">
            <label for="product1" class="form-label fw-bold">Select Product 1</label>
            <select id="product1" class="form-select mb-2" onchange="updateProductCard(1)">
              <option value="" selected>Select a product</option>
              <option value="Fear The Dessert">Fear The Dessert</option>
              <option value="Frank Ocean">Frank Ocean</option>
              <option value="Gully Infantry">Gully Infantry</option>
              <option value="Gully Tough Boyz">Gully Tough Boyz</option>
            </select>
          </div>
          <div class="card-body text-center" id="product1-card">
            <div class="text-muted py-5">
              <i class="fa fa-box-open fa-3x mb-3"></i>
              <div>No product selected</div>
            </div>
          </div>
        </div>
      </div>
      <!-- Product 2 Column -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-bottom-0">
            <label for="product2" class="form-label fw-bold">Select Product 2</label>
            <select id="product2" class="form-select mb-2" onchange="updateProductCard(2)">
              <option value="" selected>Select a product</option>
              <option value="Fear The Dessert">Fear The Dessert</option>
              <option value="Frank Ocean">Frank Ocean</option>
              <option value="Gully Infantry">Gully Infantry</option>
              <option value="Gully Tough Boyz">Gully Tough Boyz</option>
            </select>
          </div>
          <div class="card-body text-center" id="product2-card">
            <div class="text-muted py-5">
              <i class="fa fa-box-open fa-3x mb-3"></i>
              <div>No product selected</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
const productData = {
  "Fear The Dessert": {
    img: "./admin_area/product_images/Fear-the-dessert.png",
    title: "Fear The Dessert",
    desc: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tincidunt turpis a ultricies vestibulum.",
    price: "₱600"
  },
  "Frank Ocean": {
    img: "./admin_area/product_images/Frank-ocean.png",
    title: "Frank Ocean",
    desc: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam finibus sem justo, aliquet posuere sem luctus quis.",
    price: "₱600"
  },
  "Gully Infantry": {
    img: "./admin_area/product_images/Gully-infantry.png",
    title: "Gully Infantry",
    desc: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum nisl vitae efficitur ullamcorper.",
    price: "₱600"
  },
  "Gully Tough Boyz": {
    img: "./admin_area/product_images/Gully-tough-boyz.png",
    title: "Gully Tough Boyz",
    desc: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in eros rhoncus magna condimentum fermentum tempus ut ante.",
    price: "₱600"
  }
};
function updateProductCard(num) {
  const select = document.getElementById(`product${num}`);
  const card = document.getElementById(`product${num}-card`);
  const value = select.value;
  if (!value) {
    card.innerHTML = `<div class=\"text-muted py-5\"><i class=\"fa fa-box-open fa-3x mb-3\"></i><div>No product selected</div></div>`;
    return;
  }
  const p = productData[value];
  card.innerHTML = `
    <img src="${p.img}" alt="${p.title}" class="img-fluid mb-3" style="max-height: 180px; object-fit: contain;">
    <h5 class="card-title">${p.title}</h5>
    <p class="card-text">${p.desc}</p>
    <p class="fw-bold">Price: ${p.price}</p>
  `;
}
</script>

<!-- Footer -->
<?php include("./includes/footer.php"); 
?>
</div>

<!-- bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>