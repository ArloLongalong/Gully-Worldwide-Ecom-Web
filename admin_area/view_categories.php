<style>
.table th, .table td {
    text-align: center;
    vertical-align: middle;
}
</style>

<?php
// Display session messages
if (isset($_SESSION['message'])) {
    $message_type = $_SESSION['message_type'] == 'success' ? 'success' : 'danger';
    echo "<div class='alert alert-{$message_type} alert-dismissible fade show' role='alert'>
            {$_SESSION['message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
          </div>";
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
  <tr class="text-center">
    <th>Category ID</th>
    <th>Category Title</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
</thead>
<tbody class="bg-dark text-light">
  <?php
  $get_categories = "SELECT * FROM `categories`";
  $result_categories = mysqli_query($con, $get_categories);
  while($row = mysqli_fetch_assoc($result_categories)){
    $category_id = $row['category_id'];
    $category_title = $row['category_title'];
    echo "<tr>
            <td>$category_id</td>
            <td>$category_title</td>
            <td><a href='index.php?edit_category=$category_id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_category=$category_id' class='text-dark' onclick='return confirm(\"Are you sure you want to delete this category?\")'><i class='fa-solid fa-trash'></i></a></td>
          </tr>";
  }
  ?>
</tbody>
</table>