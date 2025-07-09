<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){

  $product_title= $_POST['product_title'];
  $description= $_POST['description'];
  $product_keywords= $_POST['product_keywords'];
  $product_category= $_POST['product_category'];
  $product_price= $_POST['product_price']; 

  // Image 1
  $product_image1 = $_FILES['product_image1']['name'];

  // Image Temp Name
  $temp_image1 = $_FILES['product_image1']['tmp_name'];

  // Checking empty conditions
  if($product_title=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_price=='' 
  or $product_image1==''){
    echo "<script>alert('Please fill all the fields')</script>";
    exit();
  } else {
    move_uploaded_file($temp_image1, "./product_images/$product_image1");

    // Insert query
    $inser_products="INSERT INTO `products` (product_title, product_description, product_keywords,
    category_id, product_image1, product_price) values ('$product_title', '$description', '$product_keywords',
    '$product_category', '$product_image1', '$product_price')";
    $result_query = mysqli_query($con, $inser_products);
    if($result_query){
      echo "<script>alert('Product has been inserted successfully')</script>";
    }
  }
}
?> 
<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Products - Admin Dashboard</title>
    <!-- bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- css file -->
  <link rel="stylesheet" href="../styles.css">
</head>
<body class="bg-light">
  <div class="container mt-3">
    <h1 class="text-center">Insert Products</h1>
    <!-- Insert Product Form -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- Title -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_title" class="form-label">Product Title</label>
        <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title"
        autocomplete="off" required="required">
      </div>
      <!-- Description -->
        <div class="form-outline mb-4 w-50 m-auto">
      <label for="description" class="form-label">Product Description</label>
      <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description"
      autocomplete="off" required="required">
      </div>
      <!-- Keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_keywords" class="form-label">Product Keywords</label>
        <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords"
        autocomplete="off" required="required">
      </div>
      <!-- Category -->
            <div class="form-outline mb-4 w-50 m-auto">
          <select name="product_category" id="" class="form-select">
            <option value="">Select a Category</option>
            <?php
            $select_query = "SELECT * FROM `categories`";
            $result_query = mysqli_query($con, $select_query);
            while($row = mysqli_fetch_assoc($result_query)){
              $category_title = $row['category_title'];
              $category_id = $row['category_id'];
              echo "<option value='$category_id'>$category_title</option>";
            }
          ?>
          </select>
      </div>
      <!-- Image 1 -->
          <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image1" class="form-label">Product Image 1</label>
        <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
      </div>
      <!-- Price -->
          <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_price" class="form-label">Product Price</label>
        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price"
        autocomplete="off" required="required">
      </div>
      <!-- Submit Button -->
      <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" name="insert_product" value="Insert Product" class="btn btn-dark mb-3 px-3" value="Insert Products">
    </form>
  </div>
  
</body>
</html>