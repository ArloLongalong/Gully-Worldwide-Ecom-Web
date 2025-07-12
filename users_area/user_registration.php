<?php
include('../includes/connect.php');
include('../functions/common_function.php');

// Check database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user_table exists
$table_check = "SHOW TABLES LIKE 'user_table'";
$table_result = mysqli_query($con, $table_check);
if (mysqli_num_rows($table_result) == 0) {
    // Create user_table if it doesn't exist
    $create_table = "CREATE TABLE `user_table` (
        `user_id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(100) NOT NULL,
        `user_email` varchar(100) NOT NULL,
        `user_password` varchar(255) NOT NULL,
        `user_image` varchar(255) NOT NULL,
        `user_ip` varchar(100) NOT NULL,
        `user_address` text NOT NULL,
        `user_contact` varchar(20) NOT NULL,
        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`user_id`)
    )";
    
    if (mysqli_query($con, $create_table)) {
        echo "<script>alert('User table created successfully')</script>";
    } else {
        echo "<script>alert('Error creating table: " . mysqli_error($con) . "')</script>";
    }
} else {
    // Check if user_contact column exists, if not add it
    $column_check = "SHOW COLUMNS FROM `user_table` LIKE 'user_contact'";
    $column_result = mysqli_query($con, $column_check);
    if (mysqli_num_rows($column_result) == 0) {
        $add_column = "ALTER TABLE `user_table` ADD `user_contact` varchar(20) NOT NULL";
        if (mysqli_query($con, $add_column)) {
            echo "<script>alert('User contact column added successfully')</script>";
        } else {
            echo "<script>alert('Error adding column: " . mysqli_error($con) . "')</script>";
        }
    }
    
    // Check if user_address column exists, if not add it
    $address_check = "SHOW COLUMNS FROM `user_table` LIKE 'user_address'";
    $address_result = mysqli_query($con, $address_check);
    if (mysqli_num_rows($address_result) == 0) {
        $add_address = "ALTER TABLE `user_table` ADD `user_address` text NOT NULL";
        if (mysqli_query($con, $add_address)) {
            echo "<script>alert('User address column added successfully')</script>";
        } else {
            echo "<script>alert('Error adding address column: " . mysqli_error($con) . "')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
    <!-- bootstrap CSS link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-outline mb-4">
            <!-- User Field -->
            <label for="user_username" class="form-label">Username</label>
            <input type="text" id="user_username" class="form-control" 
            placeholder="Enter your username" autocomplete="off" name="user_username" required>
          </div>
          <div class="form-outline mb-4">
            <!-- Email Field -->
            <label for="user_email" class="form-label">Email</label>
            <input type="email" id="user_email" class="form-control" 
            placeholder="Enter your email" autocomplete="off" name="user_email" required>
          </div>
                    <div class="form-outline mb-4">
            <!-- Image Field -->
            <label for="user_image" class="form-label">Profile Image</label>
            <input type="file" id="user_image" class="form-control" 
            name="user_image" required>
          </div>
            <!-- Password Field -->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" id="user_password" class="form-control" 
            placeholder="Enter your password" autocomplete="off" name="user_password" required>
          </div>
            <!-- Confirm Password Field -->
          <div class="form-outline mb-4">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" id="conf_user_password" class="form-control" 
            placeholder="Confirm your password" autocomplete="off" name="conf_user_password" required>
          </div>
            <!-- Address Field -->
          <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" id="user_address" class="form-control" 
            placeholder="Enter your address" autocomplete="off" name="user_address" required>
          </div>
            <!-- Contact Field -->
          <div class="form-outline mb-4">
            <label for="user_contact" class="form-label">Contact</label>
            <input type="text" id="user_contact" class="form-control" 
            placeholder="Enter your contact number" autocomplete="off" name="user_contact" required>
          </div>
          <div class="mt-4 pt-2">
            <input type="submit" value="Register" class="bg-dark text-light py-2 px-3 border-0"
            name="user_register">
            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?
            <a href="user_login.php" class="text-danger">Login here</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<!-- PHP Code to handle user registration -->
<?php
if(isset($_POST['user_register'])) {
  $user_username = $_POST['user_username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $conf_user_password = $_POST['conf_user_password'];
  $user_address = $_POST['user_address'];
  $user_contact = $_POST['user_contact'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_tmp = $_FILES['user_image']['tmp_name'];
  $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
  $user_ip = getIPAddress(); // Function to get user IP address 

  // Check if passwords match
  if($user_password != $conf_user_password) {
    echo "<script>alert('Passwords do not match. Please try again.')</script>";
    exit();
  }

  // Check if username or email already exists
  $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
  $result = mysqli_query($con, $select_query);
  $rows_count = mysqli_num_rows($result);
  
  if($rows_count > 0) {
    echo "<script>alert('Username or Email already exists. Please choose different ones.')</script>";
  } else {
    // Hash the password for security
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    
    // Move the uploaded image to the desired directory
    if(move_uploaded_file($user_image_tmp, "./user_images/$user_image")) {
      // Insert user data into the database
      $insert_query = "INSERT INTO `user_table` 
      (username, user_email, user_password, user_image, user_ip, user_address, user_contact, user_mobile) 
      VALUES ('$user_username', '$user_email', '$hashed_password', '$user_image', '$user_ip', '$user_address', '$user_contact', '$user_mobile')";
      $sql_execute = mysqli_query($con, $insert_query);

      if($sql_execute) {
        echo "<script>alert('Registration successful! You can now login.')</script>";
        echo "<script>window.open('user_login.php', '_self')</script>";
      } else {
        echo "<script>alert('Registration failed: " . mysqli_error($con) . "')</script>";
      }
    } else {
      echo "<script>alert('Failed to upload image. Please try again.')</script>";
    }
  }
// Selecting Cart Items
$select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
  $result_cart = mysqli_query($con, $select_cart_items);
  $rows_count = mysqli_num_rows($result_cart);

  if($rows_count > 0) {
    $_SESSION['username'] = $user_username; // Set session variable for username
    echo "<script>alert('You have items in your cart. Please proceed to checkout.')</script>";
    echo "<script>window.open('checkout.php', '_self')</script>";
  } else {
    echo "<script>alert('No items in cart. You can continue shopping.')</script>";
    echo "<script>window.open('../index.php', '_self')</script>";
  }
}
?> 