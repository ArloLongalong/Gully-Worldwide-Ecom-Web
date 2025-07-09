<!-- Connect to the database -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gully Worldwide</title>
  <!-- bootstrap CSS link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- css file -->
  <link rel="stylesheet" href="../styles.css">
  <style>
    .profile_img{
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin: auto;
      display: block;
      border: 3px solid #fff;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg bg-gray">
  <div class="container-fluid">
    <img src="../images/gully-logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
                <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
                <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
                <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-plus"></i><sup>
<?php
// Calling the function to get cart item count
cart_item();
?></sup></a> 
        </li>
                <li class="nav-item">
          <a class="nav-link" href="#">Total Price: ₱<?php echo total_cart_price(); ?></a>
        </li>
      </ul>
      <form class="d-flex" action ="../search_products.php " method="get">
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

<!-- fourth child -->
  <div class="row">
    <div class="col-md-2">
      <ul class="navbar-nav bg-dark text-center" style="height: 100vh;">
        <li class="nav-item">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
        </li>

        <?php
        $username = $_SESSION['username'];
        $user_image_query = "SELECT * FROM `user_table` WHERE username='$username'";
        $result = mysqli_query($con, $user_image_query);
        $row = mysqli_fetch_array($result);
        $user_image = $row['user_image'];
        
        // Check if user has uploaded an image, otherwise use default
        if(!empty($user_image) && file_exists("./user_images/$user_image")) {
            echo "<li class='nav-item'>
              <img src='./user_images/$user_image' class='profile_img my-4' alt='User Profile'>
            </li>";
        } else {
            echo "<li class='nav-item'>
              <img src='../images/Guly-avatar.jpg' class='profile_img my-4' alt='Default Profile'>
            </li>";
        }
        ?> 
                <li class="nav-item">
          <a class="nav-link text-light" href="profile.php">Pending Orders</a>
        </li>
                <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
        </li>
                <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?my_orders">My orders</a>
        </li>
                <li class="nav-item">
          <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
        </li>
                <li class="nav-item">
          <a class="nav-link text-light" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
    <div class="col-md-10">
      <?php get_user_order_details();
      if (isset($_GET['edit_account'])) {
        include('edit_account.php');
      }
      ?>
    </div>
  </div>

<!-- Footer -->
<?php include("../includes/footer.php"); 
?>
</div>

<!-- bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>