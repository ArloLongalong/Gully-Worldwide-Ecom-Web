<style>
.product_img {
    width: 80px;
    height: 80px;
    object-fit: contain;
}
.table th, .table td {
    text-align: center;
    vertical-align: middle;
}
</style>

<h3 class="text-center text-success">All Products</h3> 
<table class="table table-bordered mt-5">
<thead class="bg-info">
  <tr class="text-center">
    <th>Product ID</th>
    <th>Product Title</th>
    <th>Product Image</th>
    <th>Product Price</th>
    <th>Total Sold </th>
    <th>Status</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
</thead>
<tbody class="bg-dark text-light">
  <?php
  // Include database connection
  include('../includes/connect.php'); // Adjust the path as needed
  if (!isset($con) || !$con) {
      die('Database connection failed.');
  }
  $get_products = "SELECT * FROM `products`";
  $result_products = mysqli_query($con, $get_products);
  if (!$result_products) {
      die('Query failed: ' . mysqli_error($con));
  }
  $number = 0;
  while($row = $result_products ? mysqli_fetch_assoc($result_products) : false){
    $product_id = isset($row['product_id']) ? $row['product_id'] : '';
    $product_title = isset($row['product_title']) ? $row['product_title'] : '';
    $product_image1 = isset($row['product_image1']) ? $row['product_image1'] : '';
    $product_price = isset($row['product_price']) ? $row['product_price'] : '';
    $number++;
    
    // Calculate total sold (you'll need to create this query based on your order tables)
    $get_count = "SELECT * FROM `orders_pending` WHERE product_id=" . intval($product_id);
    $result_count = mysqli_query($con, $get_count);
    $rows_count = $result_count ? mysqli_num_rows($result_count) : 0;
    
    echo "<tr>
    <td>$product_id</td>
    <td>$product_title</td>
    <td><img src='./product_images/$product_image1' alt='$product_title' class='product_img'></td>
    <td>₱$product_price</td>
    <td>$rows_count</td>
    <td>Active</td>
    <td><a href='index.php?edit_products=$product_id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
    <td><a href='index.php?delete_product=$product_id' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
</tr>";
  }
  ?>
</tbody>
</table>