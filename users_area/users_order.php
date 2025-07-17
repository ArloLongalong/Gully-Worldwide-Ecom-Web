<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
$username = $_SESSION['username'];
$get_user = "SELECT * FROM `user_table` WHERE username='$username'";
$result = mysqli_query($con, $get_user);
$row_fetch = mysqli_fetch_array($result);
$user_id = $row_fetch['user_id'];
echo $user_id;
?>

  <h3 class="text-center"> All my Orders </h3>
  <table class="table table-bordered mt-5">
    <thead class="bg-dark text-light text-center">
    <tr>
      <th>Sl no</th>
      <th>Amount Due</th>
      <th>Invoice Number</th>
      <th>Order Date</th>
      <th>Complete/Incomplete</th>
      <th>Status</th>
    </tr>
    </thead>
    <tbody class="text-center">
      <?php
      $get_order_details = "SELECT * FROM `user_orders` WHERE user_id='$user_id'";
      $result_orders = mysqli_query($con, $get_order_details);
                $number = 1;
      while ($row_orders = mysqli_fetch_array($result_orders)) {
          $order_id = $row_orders['order_id'];
          $amount_due = $row_orders['amount_due'];
          $total_products = $row_orders['total_products'];
          $invoice_number = $row_orders['invoice_number'];
          $order_status = $row_orders['order_status'];
          if (strtolower($order_status) == 'pending') {
              $order_status = 'Incomplete';
          } else {
              $order_status = 'Complete';
          }
          $order_date = $row_orders['order_date'];
          echo " <tr>
        <td>$number</td>
        <td>₱$amount_due</td>
        <td>$total_products</td>
        <td>$invoice_number</td>
        <td>$order_date</td>
        <td>$order_status</td>";
        ?>
        <?php
        if ($order_status == 'Complete') {
            echo "<td class='text-success'>Paid</td>";
        } else {
          echo "<td><a href='confirm_payment.php?order_id=$order_id' class='btn btn-success'>Confirm Payment</a></td>
          </tr>";
        }
        $number++;
      }
      ?>
</tbody>
</table>
</body>
</html>