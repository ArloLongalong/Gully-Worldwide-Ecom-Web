<?php

// Connect File
//include('./includes/connect.php');

// Getting Products
function getproducts(){
  global $con;
  
  // Condition to check isset or not
  if (!isset($_GET['category'])){
  $select_query = "SELECT * FROM `products` ORDER BY rand() LIMIT 0,3";
$result_query = mysqli_query($con, $select_query);
while($row = mysqli_fetch_assoc($result_query)){
  $product_id = $row['product_id'];
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_image1 = $row['product_image1'];
  $product_price = $row['product_price'];
  $category_id = $row['category_id'];
  echo "<div class ='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'><strong>Price: ₱$product_price</strong></p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
    </div>
    </div>
    </div>";
}
}
}

// Getting All Products
  function get_all_products(){
  global $con;
  // Condition to check isset or not
  if (!isset($_GET['category'])){
  $select_query = "SELECT * FROM `products`";
$result_query = mysqli_query($con, $select_query);
$num_of_rows = mysqli_num_rows($result_query);
if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'>No products available</h2>";
  } else {
while($row = mysqli_fetch_assoc($result_query)){
  $product_id = $row['product_id'];
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_image1 = $row['product_image1'];
  $product_price = $row['product_price'];
  $category_id = $row['category_id'];
  echo "<div class ='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'><strong>Price: ₱$product_price</strong></p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
    </div>
    </div>
    </div>";
}
}
}
}

// Getting Unique Categories
    function get_unique_categories(){
  global $con;
  // Condition to check isset or not
  if (isset($_GET['category'])){
  $category_id = $_GET['category'];
  $select_query = "SELECT * FROM `products` WHERE category_id=$category_id";
$result_query = mysqli_query($con, $select_query);
$num_of_rows = mysqli_num_rows($result_query);
if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
  }
while($row = mysqli_fetch_assoc($result_query)){
  $product_id = $row['product_id'];
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_image1 = $row['product_image1'];
  $product_price = $row['product_price'];
  $category_id = $row['category_id'];
  echo "<div class ='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'><strong>Price: ₱$product_price</strong></p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
    </div>
    </div>
    </div>";
}
}
}
// Displaying categories
function getcategories(){
    global $con;
    $select_categories = "SELECT * FROM `categories`";
    $result_categories = mysqli_query($con, $select_categories);
    while($row_data = mysqli_fetch_assoc($result_categories)){
      $category_title = $row_data['category_title'];
      $category_id = $row_data['category_id'];
      echo " <li class='nav-item'>
      <a href='index.php?category=$category_id' class='nav-link text-light text-center'>$category_title</a>
      </li>";
    }
}

// Function to search products 
function search_product(){
  global $con;
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];
  $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%' OR product_title LIKE '%$search_data_value%'";
$result_query = mysqli_query($con, $search_query);
$num_of_rows = mysqli_num_rows($result_query);

if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'>No products found matching your search</h2>";
}

while($row = mysqli_fetch_assoc($result_query)){
  $product_id = $row['product_id'];
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_image1 = $row['product_image1'];
  $product_price = $row['product_price'];
  $category_id = $row['category_id'];
  echo "<div class ='col-md-4 mb-2'>
          <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
    <p class='card-text'><strong>Price: ₱$product_price</strong></p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>View More</a>
    </div>
    </div>
    </div>";
}
} 
}

// Function to get product details
function get_product_details(){
  global $con;
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $select_query = "SELECT * FROM `products` WHERE product_id=$product_id";
    $result_query = mysqli_query($con, $select_query);
    
    if ($row = mysqli_fetch_assoc($result_query)) {
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      
      echo "<div class='col-md-4 mb-2'>
              <div class='card'>
                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                  <h5 class='card-title'>$product_title</h5>
                  <p class='card-text'>$product_description</p>
                  <p class='card-text'><strong>Price: ₱$product_price</strong></p>
                  <a href='index.php?add_to_cart=$product_id' class='btn btn-warning'>Add to Cart</a>
                  <a href='display_all.php' class='btn btn-secondary'>Back to Products</a>
                </div>
              </div>
            </div>";
            
      echo "<div class='col-md-8'>
              <div class='card'>
                <div class='card-body'>
                  <h3 class='card-title'>$product_title</h3>
                  <p class='card-text'>$product_description</p>
                  <h4 class='text-success'>Price: ₱$product_price</h4>
                  <div class='mt-3'>
                    <a href='#' class='btn btn-warning btn-lg'>Add to Cart</a>
                    <a href='display_all.php' class='btn btn-secondary btn-lg'>Continue Shopping</a>
                  </div>
                </div>
              </div>
            </div>";
    } else {
      echo "<div class='col-12'>
              <h2 class='text-center text-danger'>Product not found</h2>
              <div class='text-center'>
                <a href='display_all.php' class='btn btn-primary'>Back to Products</a>
              </div>
            </div>";
    }
  }
}

// Get IP Address Function
function getIPAddress() {
  // Wheter the user is from shared internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Whether the user is using a proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Whether the user is from the remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
/* $ip = getIPAddress();
echo 'User Real IP Address - '.$ip; */

// Cart Function
function cart(){
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_address = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address' AND product_id=$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    
    if ($num_of_rows > 0) {
      echo "<script>alert('This item is already in the cart')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
    } else {
      $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_address', 1)";
      $result_query = mysqli_query($con, $insert_query);
      echo "<script>alert('Item added to cart successfully')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
      
    } 
  }
}

// Function to get cart item numbers
function cart_item(){
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip_address = getIPAddress();
    
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
  } else {
    global $con;
    $get_ip_address = getIPAddress();
    
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
  }
  echo $count_cart_items;
}

// Total Price Function
function total_cart_price(){
  global $con;
  $get_ip_address = getIPAddress();
  $total_cart_price = 0;
  $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
  $result_query = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result_query)) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    if ($quantity <= 0) {
      $quantity = 1;
    }
    $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
    $result_products = mysqli_query($con, $select_products); 
    while ($row_product_price = mysqli_fetch_array($result_products)) {
      $product_price = $row_product_price['product_price'];
      $total_cart_price += ($product_price * $quantity);
    }
  }
  return $total_cart_price;
}


// Get User Order Details
function get_user_order_details(){
  global $con;
  
  // Check if user is logged in
  if(!isset($_SESSION['username'])) {
    echo "<h3 class='text-center text-danger'>Please log in to view your orders</h3>
    <p class='text-center'><a href='user_login.php' class='btn btn-dark text-light mt-3 mb-2'>Login</a></p>";
    return;
  }
  
  $username = $_SESSION['username'];
  $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
  $result_query = mysqli_query($con, $get_details);
  
  if($result_query && mysqli_num_rows($result_query) > 0) {
    while($row_query = mysqli_fetch_assoc($result_query)){
      $user_id = $row_query['user_id'];
      if(!isset($_GET['edit_account'])){
        if(!isset($_GET['my_orders'])){
          if(!isset($_GET['delete_account'])){
            $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='Pending'";
            $result_orders_query = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result_orders_query);
            if($row_count > 0){
              echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
              <p class= 'text-center'><a href='profile.php?my_orders' class='btn btn-dark text-light mt-3 mb-2'>View My Orders</a></p>";
            } else {
              echo "<h3 class='text-center text-danger'>You have no pending orders</h3>
              <p class='text-center'><a href='../index.php' class='btn btn-dark text-light mt-3 mb-2'>Continue Shopping</a></p>";
            }
          }
        }
      }
    }
  } else {
    echo "<h3 class='text-center text-danger'>User not found</h3>
    <p class='text-center'><a href='user_login.php' class='btn btn-dark text-light mt-3 mb-2'>Login</a></p>";
  }
}  