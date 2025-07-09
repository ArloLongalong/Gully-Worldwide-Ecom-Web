<!-- Connect to the database -->
<?php
session_start();
include('includes/connect.php');
include('functions/common_function.php');

// Handle cart updates
if (isset($_POST['update_cart'])) {
    if (isset($_POST['qty']) && isset($_POST['product_id'])) {
        $quantities = $_POST['qty'];
        $product_ids = $_POST['product_id'];
        $get_ip_address = getIPAddress();
        
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $quantity = $quantities[$i];
            $update_cart = "UPDATE `cart_details` SET quantity='$quantity' WHERE ip_address='$get_ip_address' AND product_id='$product_id'";
            $result_update = mysqli_query($con, $update_cart);
        }
        
        if ($result_update) {
            echo "<script>alert('Cart updated successfully!')</script>";
            echo "<script>window.open('cart.php', '_self')</script>";
        }
    }
}

// Handle item removal
if (isset($_POST['remove_cart'])) {
    if (isset($_POST['remove_item'])) {
        foreach ($_POST['remove_item'] as $remove_id) {
            $delete_query = "DELETE FROM `cart_details` WHERE product_id='$remove_id'";
            $run_delete = mysqli_query($con, $delete_query);
            if ($run_delete) {
                echo "<script>alert('Item has been removed from the cart')</script>";
                echo "<script>window.open('cart.php', '_self')</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gully Worldwide - Cart Details</title>
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
      </ul>
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
<div class="container">
  <div class="row">
    <form action="" method="post">
      <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove</th>
            <th colspan='2'>Operations</th>
          </tr>
        </thead>
        <tbody>
        <!-- PHP code to Display Dynamic Data -->
        <?php
        global $con;
        $get_ip_address = getIPAddress();
        $total_cart_price = 0;
        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
        $result_query = mysqli_query($con, $cart_query);
        $result_count = mysqli_num_rows($result_query);
        
        if ($result_count > 0) {
          $index = 0;
          while ($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
            $result_products = mysqli_query($con, $select_products); 
            while ($row_product_price = mysqli_fetch_array($result_products)) {
              $product_price = array($row_product_price['product_price']);
              $price_table = $row_product_price['product_price'];
              $product_title = $row_product_price['product_title'];
              $product_image1 = $row_product_price['product_image1'];
              $product_values = array_sum($product_price);
              $total_cart_price += ($product_values * $quantity);
              ?>
              <tr>
                <td><?php echo $product_title?></td>
                <td><img src = "./admin_area/product_images/<?php echo $product_image1?>" alt = "" style="width: 80px; height: 80px; object-fit: contain;"></td>
                <td>
                  <input type="hidden" name="product_id[]" value="<?php echo $product_id?>">
                  <input type="number" class="form-control w-50 mx-auto" name="qty[]" value="<?php echo $quantity?>" min="1">
                </td>
                <td>₱<?php echo $price_table * $quantity?></td>
                <td><input type="checkbox" name="remove_item[]" value="<?php echo $product_id?>"></td>
                <td><input type="submit" value="Update Cart" name="update_cart" class="bg-dark text-light px-3 py-2 border-0 mx-1"></td>
                <td><input type="submit" value="Remove Cart" name="remove_cart" class="bg-danger text-light px-3 py-2 border-0 mx-1"></td>
              </tr>
              <?php
              $index++;
            }
          }
        } else {
          echo "<tr><td colspan='7' class='text-center'><h4>Your cart is empty</h4><p><a href='index.php' class='btn btn-dark'>Continue Shopping</a></p></td></tr>";
        }
        ?>
        </tbody>
      </table>
      
      <!-- Subtotal -->
      <?php if ($result_count > 0) { ?>
      <div class='d-flex mb-5'>
        <h4 class='px-3'>Subtotal:<strong>₱<?php echo $total_cart_price?></strong></h4>
        <a href='index.php'><button type='button' class='bg-secondary text-light px-3 py-2 border-0 mx-3'>Continue Shopping</button></a>
        <a href='./users_area/checkout.php'><button type='button' class='bg-dark text-light p-3 py-2 border-0'>Proceed to Checkout</button></a>
      </div>
      <?php } ?>
    </form>
  </div>
</div>

<!-- Footer -->
<?php include("./includes/footer.php"); 
?>

<!-- bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>