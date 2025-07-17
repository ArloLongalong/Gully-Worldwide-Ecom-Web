<?php
include('../includes/connect.php');

if (isset($_GET['delete_category'])) {
    $delete_category = $_GET['delete_category'];
    
    // Check if category is being used by any products
    $check_products = "SELECT * FROM `products` WHERE category_id = '$delete_category'";
    $result_check = mysqli_query($con, $check_products);
    $count_products = mysqli_num_rows($result_check);
    
    if ($count_products > 0) {
        echo "<script>alert('Cannot delete category! It is being used by $count_products product(s).')</script>";
        echo "<script>window.open('index.php?view_categories', '_self')</script>";
    } else {
        $delete_query = "DELETE FROM `categories` WHERE category_id = '$delete_category'";
        $result = mysqli_query($con, $delete_query);
        
        if ($result) {
            echo "<script>alert('Category deleted successfully!')</script>";
            echo "<script>window.open('index.php?view_categories', '_self')</script>";
        } else {
            echo "<script>alert('Error deleting category!')</script>";
            echo "<script>window.open('index.php?view_categories', '_self')</script>";
        }
    }
}
?>

<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background-color: #f8f9fa;
}
.container {
    text-align: center;
    max-width: 500px;
}
</style>

<div class="container">
    <h3 class="text-danger mb-4">Deleting Category...</h3>
    <p class="text-muted">Please wait while we process your request.</p>
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
