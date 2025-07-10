<?php
if(isset($_GET['edit_account'])) {
  include('../includes/connect.php');
  
  $user_session_name = $_SESSION['username'];
  $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
  $result_query = mysqli_query($con, $select_query);
  $row_fetch = mysqli_fetch_array($result_query);

  $user_id = $row_fetch['user_id'];
  $user_username = $row_fetch['username'];
  $user_email = $row_fetch['user_email'];
  $user_image = $row_fetch['user_image'];
  $user_address = $row_fetch['user_address'];
  $user_contact = $row_fetch['user_contact']; 

  if(isset($_POST['user_update'])) {
    $update_id = $user_id; 
    $updated_username = $_POST['user_username'];
    $updated_email = $_POST['user_email'];
    $updated_address = $_POST['user_address'];
    $updated_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'] ?? ''; 
    $user_image_tmp = $_FILES['user_image']['tmp_name'] ?? '';
    move_uploaded_file($user_image_tmp, "./user_images/$user_image");
    
    // Handle image upload
    $updated_image = $user_image; 
    if(isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
      $image_name = $_FILES['user_image']['name'];
      $image_tmp = $_FILES['user_image']['tmp_name'];
      $image_size = $_FILES['user_image']['size'];
      
      // Validate image
      $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
      $file_type = $_FILES['user_image']['type'];
      
      if(in_array($file_type, $allowed_types) && $image_size < 5000000) { // 5MB limit
        $updated_image = time() . '_' . $image_name;
        move_uploaded_file($image_tmp, "./user_images/$updated_image");
      } else {
        echo "<script>alert('Invalid image file. Please upload JPG, PNG, or GIF files under 5MB.')</script>";
      }
    }
    
    // Update database
    $update_query = "UPDATE `user_table` SET 
                    username='$updated_username', 
                    user_email='$updated_email', 
                    user_image='$updated_image', 
                    user_address='$updated_address', 
                    user_contact='$updated_contact' 
                    WHERE user_id=$user_id";
    
    $result_update = mysqli_query($con, $update_query);
    
    if($result_update) {
      // Update session username if it was changed
      $_SESSION['username'] = $updated_username;
      echo "<script>alert('Account updated successfully!')</script>";
      echo "<script>window.open('profile.php', '_self')</script>";
    } else {
      echo "<script>alert('Error updating account. Please try again.')</script>";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Account</title>
  <!-- bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <style>
    .profile_img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h3 class="text-center text-success mb-4">
      Edit Account
    </h3>
  <form action="" method="post" enctype="multipart/form-data" class="text-center">
    <div class="form-outline mb-4">
      <label for="user_username" class="form-label">Username</label>
      <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_username?>"
      id="user_username" name="user_username" placeholder="Enter your username">
    </div>
    <div class="form-outline mb-4">
      <label for="user_email" class="form-label">Email</label>
      <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email?>"
      id="user_email" name="user_email" placeholder="Enter your email">
    </div>
    <div class="form-outline mb-4">
      <label for="user_image" class="form-label">Profile Image</label>
      <input type="file" class="form-control w-50 m-auto" 
      id="user_image" name="user_image" accept="image/*">
      <img src="./user_images/<?php echo $user_image?>" alt="" class="profile_img mt-3 mb-1">
    </div>
    <div class="form-outline mb-4">
      <label for="user_address" class="form-label">Address</label>
      <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address?>"
      id="user_address" name="user_address" placeholder="Enter your address">
    </div>
    <div class="form-outline mb-4">
      <label for="user_contact" class="form-label">Mobile Number</label>
      <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_contact?>"
      id="user_contact" name="user_contact" placeholder="Enter your mobile number">
    </div>
    <input type="submit" value="Update" class="btn btn-dark py-2 px-4 my-3" 
      name="user_update">
  </form>
  </div>
  
  <!-- bootstrap JS link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>