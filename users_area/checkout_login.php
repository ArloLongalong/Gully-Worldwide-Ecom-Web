<?php
// Handle login form submission for checkout
if(isset($_POST['user_login'])){
    // Getting the form data
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    // Query to check if the user exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['user_password'];
        
        // Verify the password
        if(password_verify($user_password, $hashed_password)){
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login successful!')</script>";
            echo "<script>window.location.reload();</script>";
        } else {
            echo "<script>alert('Incorrect password!')</script>";
        }
    } else {
        echo "<script>alert('User does not exist!')</script>";
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center mb-0">Login to Continue Checkout</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" 
                            placeholder="Enter your username" autocomplete="off" name="user_username" required>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" 
                            placeholder="Enter your password" autocomplete="off" name="user_password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <input type="submit" value="Login" class="btn btn-dark btn-lg" name="user_login">
                        </div>
                        <div class="text-center mt-3">
                            <p class="mb-0">Don't have an account? 
                            <a href="user_registration.php" class="text-danger">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
