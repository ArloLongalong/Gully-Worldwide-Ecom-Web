<?php
// First, get the category data when the page loads
if (isset($_GET['edit_category'])) {
  $edit_id = $_GET['edit_category'];
  $get_data = "SELECT * FROM `categories` WHERE category_id=$edit_id";
  $result_data = mysqli_query($con, $get_data);
  $row = mysqli_fetch_assoc($result_data);
  $category_title = $row['category_title'];
}

// Handle form submission for updating
if (isset($_POST['edit_category'])) {
  $edit_id = $_GET['edit_category'];
  $category_title = $_POST['category_title'];
  
  // Update the category
  $update_query = "UPDATE `categories` SET 
    category_title='$category_title'
    WHERE category_id=$edit_id";
  
  $result_update = mysqli_query($con, $update_query);
  if ($result_update) {
    echo "<script>alert('Category updated successfully!')</script>";
    echo "<script>window.open('index.php?view_categories', '_self')</script>";
  } else {
    echo "<script>alert('Error updating category!')</script>";
  }
}
?>

<div class="container mt-5">
  <h1 class="text-center">Edit Category</h1>
  <form action="" method="post">
    <div class="form-outline w-50 m-auto mb-4">
      <label for="category_title" class="form-label">Category Title</label>
      <input type="text" id="category_title" value="<?php echo isset($category_title) ? $category_title : ''; ?>" class="form-control" name="category_title" required>
    </div>
    <div class="text-center">
      <input type="submit" name="edit_category" value="Update Category" class="btn btn-dark text-light px-3 mb-3">
      <a href="index.php?view_categories" class="btn btn-secondary px-3 mb-3 ms-2">Cancel</a>
    </div>
  </form>
</div>
