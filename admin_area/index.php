<!-- Connect to the database -->
<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- css file -->
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <!-- Navigation Bar -->
    <div class="container-fluid p-0">
      <!-- First Child -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <img src="../images/gully-logo.png" alt="" class="logo">
            <nav class="navbar navbar-expand-lg">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="" class="nav-link">Welcome Guest</a>
                </li>
              </ul>
          </nav>
        </div>
      </nav>
      <!-- Second Child -->
      <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
      </div>
      <!-- Third Child -->
<div class="row">
  <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
    <div class="me-2 text-center p-4">
      <a href="#"><img src="../images/Guly-avatar.jpg" alt="" class="admin_image"></a>
      <p class="text-light text-center mb-0">Admin Name</p>
    </div>
    <div class="flex-grow-1 d-flex justify-content-center">
      <div class="button text-center">
        <a href="insert_product.php" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">Insert Products</a>
        <a href="#" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">View Products</a>
        <a href="index.php?insert_category" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">Insert Categories</a>
        <a href="#" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">View Categories</a>
        <a href="#" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">All Orders</a>
        <a href="#" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">All Payments</a>
        <a href="#" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">List Users</a>
        <a href="#" class="nav-link text-light bg-dark my-1 px-3 py-2 d-inline-block">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Fourth Child -->
  <div class="container my-3">
    <?php 
    if (isset($_GET['insert_category'])) {
        include('insert_categories.php');
    }
    ?>
  </div>


<!-- last child -->
<div class="bg-black text-white p-3 text-center">
  <p>Hope you enjoyed our products, Check out our Facebook Page!</p>
  <a href="https://www.facebook.com/GullyWorldwide" target="_blank" class="text-white">Facebook</a>


  <!-- bootstrap js link -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>