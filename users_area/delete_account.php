  <?php
// Only include these if they haven't been included already
if (!isset($con)) {
    include('../includes/connect.php');
}
if (!isset($_SESSION)) {
    session_start();
}
?>

<h3 class="text-danger text-center mb-4">
    Delete Account
  </h3>
  <div class="text-center">
    <div class="form-outline mb-4">
      <a href="profile.php?delete_account=1&confirm_delete=yes" class="btn btn-danger w-50" 
         onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone!')">Delete Account</a>
    </div>
    <div class="form-outline mb-4">
      <a href="profile.php" class="btn btn-secondary w-50">Don't Delete Account</a>
    </div>
  </div>

  <?php
  // Handle deletion via GET parameter to avoid form interference
  if (isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'yes') {
      $username_session = $_SESSION['username'];
      
      // First check if user exists
      $check_query = "SELECT * FROM `user_table` WHERE username='$username_session'";
      $check_result = mysqli_query($con, $check_query);
      
      if (mysqli_num_rows($check_result) > 0) {
          // Delete the user
          $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
          $result_delete = mysqli_query($con, $delete_query);
          
          if ($result_delete && mysqli_affected_rows($con) > 0) {
              session_destroy();
              echo "<script>alert('Account deleted successfully!')</script>";
              echo "<script>window.open('../index.php', '_self')</script>";
          } else {
              echo "<script>alert('Error: Could not delete account - " . mysqli_error($con) . "')</script>";
          }
      } else {
          echo "<script>alert('Error: User not found!')</script>";
      }
  }
  
  // Handle POST deletion (backup method)
  if (isset($_POST['delete'])) {
      $username_session = $_SESSION['username'];
      
      // First check if user exists
      $check_query = "SELECT * FROM `user_table` WHERE username='$username_session'";
      $check_result = mysqli_query($con, $check_query);
      
      if (mysqli_num_rows($check_result) > 0) {
          // Delete the user
          $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
          $result_delete = mysqli_query($con, $delete_query);
          
          if ($result_delete && mysqli_affected_rows($con) > 0) {
              session_destroy();
              echo "<script>alert('Account deleted successfully!')</script>";
              echo "<script>window.open('../index.php', '_self')</script>";
          } else {
              echo "<script>alert('Error: Could not delete account!')</script>";
          }
      } else {
          echo "<script>alert('Error: User not found!')</script>";
      }
  }
  ?>