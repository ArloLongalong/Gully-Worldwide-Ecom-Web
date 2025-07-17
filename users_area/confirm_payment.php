<?php
include('../includes/connect.php');
session_start();
if (isset($_GET ['order_id'])){
    $order_id = $_GET['order_id'];
    //echo $order_id;
    $select_data = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_array($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amount_due = $row_fetch['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode)
    VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
    $result_query = mysqli_query($con, $insert_query);
    if ($result_query) {
        echo "<h3 class='text-center text-light'>Payment confirmed successfully!</h3>";
        echo "<script>window.open('profile.php?my_orders', '_self')</script>"; 
    }
    $update_order = "UPDATE `user_orders` SET order_status='Complete' WHERE order_id=$order_id";
    $result_update = mysqli_query($con, $update_order);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
  <!-- bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body class="bg-secondary">
  <div class="container my-5">
      <h1 class="text-center text-light">Confirm Your Payment</h1>
    <form action="" method = "post">
      <div class="form-outline my-4 text-center w-50 m-auto">
        <input type="text" class="form-control w-50 m-auto" name="invoice_number" placeholder="Enter Invoice Number" value="<?php echo $invoice_number; ?>" required>
      </div>
      <div class="form-outline my-4 text-center w-50 m-auto">
        <input type="text" class="form-control w-50 m-auto" name="amount" placeholder="Enter Amount Due" value="<?php echo $amount_due; ?>" required>
      </div>
      <div class="form-outline my-4 text-center w-50 m-auto">
        <select class="form-control w-50 m-auto" name="payment_mode" required>
          <option value="" disabled selected>Select Payment Method</option>
          <option value="gcash">Gcash</option>
          <option value="paypal">Cash on Delivery</option>
        </select>
      </div>
      <div class="form-outline my-4 text-center w-50 m-auto">
        <input type="submit" class="bg-dark text-light py-2 px-3 border-0" name="confirm_payment" value="Confirm Payment">
      </div>
    </form>
  </div>
</body>
</html>