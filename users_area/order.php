<?php
session_start();
include('../includes/connect.php');
include('../functions/common_function.php');

// Check if user is logged in
if(!isset($_SESSION['username'])){
    echo "<script>window.open('user_login.php', '_self')</script>";
    exit();
}

// Get user ID from session
$username = $_SESSION['username'];
$get_user = "SELECT * FROM `user_table` WHERE username='$username'";
$result_user = mysqli_query($con, $get_user);
$row_user = mysqli_fetch_assoc($result_user);
$user_id = $row_user['user_id'];

$get_ip_address = getIPAddress(); // Function to get user IP address
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);
$invoice_number = mt_rand();
$status = 'Pending';
$count_products = mysqli_num_rows($result_cart_price);

// Calculate total price correctly
while ($row_cart_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_cart_price['product_id'];
    $quantity = $row_cart_price['quantity'];
    $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_products);
    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = $row_product_price['product_price'];
        $total_price += ($product_price * $quantity);
    }
}

// Insert order into database
$insert_orders = "INSERT INTO `user_orders` 
(user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ('$user_id', '$total_price', '$invoice_number', '$count_products', NOW(), '$status')";
$result_query = mysqli_query($con, $insert_orders);

if($result_query){
    echo "<h3 class='text-center text-success'>Order Placed Successfully!</h3>";
    echo "<script>window.open('profile.php','_self')</script>";
    
    // Clear the cart after successful order
    $clear_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
    mysqli_query($con, $clear_cart);
    
    echo "<script>setTimeout(function(){window.open('../index.php', '_self')}, 3000)</script>";
} else { 
    echo "<h3 class='text-center text-danger'>Error!</h3>";
    echo "<p class='text-center'>There was an issue placing your order. Please try again.</p>";
    echo "<script>setTimeout(function(){window.open('checkout.php', '_self')}, 3000)</script>";
}

    // Orders Pending
    $insert_pending_orders = "INSERT INTO `orders_pending`
    (user_id, invoice_number, product_id, quantity, order_status)
    VALUES ('$user_id', '$invoice_number', '$product_id', '$quantity', '$status')";
    $result_pending_orders = mysqli_query($con, $insert_pending_orders);  

    // Delete items from cart
    $empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
    $result_delete = mysqli_query($con, $empty_cart);


?>