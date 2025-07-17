<?php
// First, get the product data when the page loads
if (isset($_GET['edit_products'])) {
  $edit_id = $_GET['edit_products'];
  $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
  $result_data = mysqli_query($con, $get_data);
  $row = mysqli_fetch_assoc($result_data);
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_keywords = $row['product_keywords'];
  $category_id = $row['category_id'];
  $product_image1 = $row['product_image1']; 
  $product_price = $row['product_price'];
}

// Handle form submission for updating
if (isset($_POST['edit_product'])) {
  $edit_id = $_GET['edit_products'];
  $product_title = $_POST['product_name'];
  $product_description = $_POST['product_description'];
  $product_keywords = $_POST['product_keywords'];
  $product_category = $_POST['product_category'];
  $product_price = $_POST['product_price'];
  
  // Handle file upload if new image is provided
  if (!empty($_FILES['product_image1']['name'])) {
    $product_image1 = $_FILES['product_image1']['name'];
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    move_uploaded_file($temp_image1, "./product_images/$product_image1");
  } else {
    // Keep the existing image if no new image is uploaded
    $get_image = "SELECT product_image1 FROM `products` WHERE product_id=$edit_id";
    $result_image = mysqli_query($con, $get_image);
    $row_image = mysqli_fetch_assoc($result_image);
    $product_image1 = $row_image['product_image1'];
  }
  
  // Update the product
  $update_query = "UPDATE `products` SET 
    product_title='$product_title',
    product_description='$product_description', 
    product_keywords='$product_keywords',
    category_id='$product_category',
    product_image1='$product_image1',
    product_price='$product_price' 
    WHERE product_id=$edit_id";
  
  $result_update = mysqli_query($con, $update_query);
  if ($result_update) {
    echo "<script>alert('Product updated successfully!')</script>";
    echo "<script>window.open('index.php?view_products', '_self')</script>";
  }
}
?>
<div class="container mt-5">
  <h1 class="text-center">Edit Product</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_title" class="form-label">Product Title</label>
      <input type="text" id="product_title" value="<?php echo isset($product_title) ? $product_title : ''; ?>" class="form-control" name="product_name" required>
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_description" class="form-label">Product Description</label>
      <input type="text" id="product_description" value="<?php echo isset($product_description) ? $product_description : ''; ?>" class="form-control" name="product_description" required>
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_keywords" class="form-label">Product Keywords</label>
      <input type="text" id="product_keywords" value="<?php echo isset($product_keywords) ? $product_keywords : ''; ?>" class="form-control" name="product_keywords" required>
    </div>
  <div class="form-outline w-50 m-auto mb-4">
  <label for="product_category" class="form-label">Product Categories</label>
    <select name="product_category" class="form-select">
      <?php
      $select_categories = "SELECT * FROM `categories`";
      $result_categories = mysqli_query($con, $select_categories);
      while ($row_categories = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_categories['category_title'];
        $category_id_option = $row_categories['category_id'];
        $selected = (isset($category_id) && $category_id == $category_id_option) ? 'selected' : '';
        echo "<option value='$category_id_option' $selected>$category_title</option>";
      }
      ?>
    </select>
  </div>
      <div class="form-outline w-50 m-auto mb-4">
      <label for="product_image1" class="form-label">Product Image</label>
      <div class="d-flex">
        <input type="file" id="product_image1" class="form-control" name="product_image1">
        <img src="./product_images/<?php echo isset($product_image1) ? $product_image1 : 'default.png'; ?>" alt="Product Image" class="product_image ms-3" style="max-width: 120px; max-height: 120px; object-fit: cover; border-radius: 8px;">
      </div> 
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_price" class="form-label">Product Price</label>
      <input type="text" id="product_price" value="<?php echo isset($product_price) ? $product_price : ''; ?>" class="form-control" name="product_price" required>
    </div>
    <div class="text-center">
      <input type="submit" name="edit_product" value="Update Product" class="btn btn-dark text-light px-3 mb-3">
    </div>
  </form>
</div>