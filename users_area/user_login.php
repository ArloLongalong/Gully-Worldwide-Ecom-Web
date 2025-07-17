<?php
session_start();
include('../includes/connect.php');
include('../functions/common_function.php');

// Handle login form submission
if(isset($_POST['user_login'])){
    // Getting the form data
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    // Query to check if the user exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    
    if($row_count > 0){
        $row_data = mysqli_fetch_assoc($result);
        $user_ip = getIPAddress(); // Function to get user IP address

        // Cart Item
        $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
        $select_cart = mysqli_query($con, $select_query_cart);
        $row_count_cart = mysqli_num_rows($select_cart);
        
        // Verify the password
        if(password_verify($user_password, $row_data['user_password'])){
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login successful!')</script>";
            
            // Check if user has items in cart
            if($row_count_cart == 0){
                echo "<script>window.open('profile.php', '_self')</script>";
            } else {
                echo "<script>window.open('payment.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Incorrect password!')</script>";
        }
    } else {
        echo "<script>alert('User does not exist!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
    <!-- bootstrap CSS link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
      body{
        overflow-x: hidden;
      }
    </style>
</head>
<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">User Login</h2>
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="post">
          <div class="form-outline mb-4">
            <!-- User Field -->
            <label for="user_username" class="form-label">Username</label>
            <input type="text" id="user_username" class="form-control" 
            placeholder="Enter your username" autocomplete="off" name="user_username" required>
          </div>
            <!-- Password Field -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" id="user_password" class="form-control" 
            placeholder="Enter your password" autocomplete="off" name="user_password" required>
          </div>
          <div class="mt-4 pt-2">
            <input type="submit" value="Login" class="bg-dark text-light py-2 px-3 border-0"
                        name="user_login">
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
            <a href="user_registration.php" class="text-danger">Register</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>