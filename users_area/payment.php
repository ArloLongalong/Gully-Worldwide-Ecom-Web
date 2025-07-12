<?php
// Check if user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>window.open('users_area/user_login.php', '_self')</script>";
    exit();
}
?>

<div class="container">
    <h2 class="text-center mb-4">Payment Options</h2>
    
    <!-- Order Summary -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            global $con;
                            $get_ip_address = getIPAddress();
                            $total_cart_price = 0;
                            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                            $result_query = mysqli_query($con, $cart_query);
                            
                            while ($row = mysqli_fetch_array($result_query)) {
                                $product_id = $row['product_id'];
                                $quantity = $row['quantity'];
                                
                                if ($quantity <= 0) {
                                    $quantity = 1;
                                }
                                
                                $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
                                $result_products = mysqli_query($con, $select_products);
                                
                                while ($row_product = mysqli_fetch_array($result_products)) {
                                    $product_title = $row_product['product_title'];
                                    $product_price = $row_product['product_price'];
                                    $item_total = $product_price * $quantity;
                                    $total_cart_price += $item_total;
                                    
                                    echo "<tr>
                                        <td>$product_title</td>
                                        <td>$quantity</td>
                                        <td>₱$product_price</td>
                                        <td>₱$item_total</td>
                                    </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-end">
                        <h4>Total: ₱<?php echo $total_cart_price; ?></h4>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Payment Method</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="radio" id="offline" name="payment_mode" value="cash_on_delivery" required>
                            <label for="offline" class="form-label">Offline Payment</label>
                        </div>
                        <div class="mb-3">
                            <input type="radio" id="online" name="payment_mode" value="gcash" required>
                            <label for="online" class="form-label">Pay Online (GCash)</label>
                        </div>
                        <input type="submit" value="Continue" name="continue" class="btn btn-dark w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['continue'])) {
    $payment_mode = $_POST['payment_mode'];
    
    if ($payment_mode == 'cash_on_delivery') {
        echo "<script>alert('Your order has been submitted successfully! Pay when your order arrives.')</script>";
        echo "<script>window.open('order.php', '_self')</script>";
    } else {
        echo "<script>alert('Redirecting to GCash payment...')</script>";
        echo "<script>window.open('https://www.gcash.com', '_self')</script>";
    }
}
?>