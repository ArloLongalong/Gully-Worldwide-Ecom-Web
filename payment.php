<?php
require_once 'vendor/autoload.php';
use Xendit\Invoice\InvoiceApi;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;

function createPayment($amount, $payerEmail = null)
{
  $secretKey = 'xnd_development_MVwLxfrpQS9EJMwewIXTMkY4x69QcjZAUmdqgjH18CT0eywhzXAxzDAbNFog';

  try
  {
    $currentDateTime = date('h:i A m/d/Y');
    $amount = (int) $amount;
    $description = 'Payment for cart checkout @GullyWorldwide';
    $currency = 'PHP';

    Configuration::setXenditKey($secretKey);
    $apiInstance = new InvoiceApi();

    $createInvoiceRequest = new CreateInvoiceRequest([
      'external_id' => $currentDateTime,
      'amount' => $amount,
      'description' => $description,
      'currency' => $currency,
      'payer_email' => $payerEmail,
        'reminder_time' => 1,
        'success_redirect_url' => 'http://localhost/gully-app/checkout/payment-status.php?status=success&orderId=',
        'failure_redirect_url' => 'http://localhost/gully-app/checkout/payment-status.php?status=failed&orderId=',
        'items' => [
          [
            'name' => 'test-product',
            'quantity' => 1,
            'price' => $amount,
            'category' => 'Products'
          ]
        ]
    ]);

    $paymentResponse = $apiInstance->createInvoice($createInvoiceRequest);
    $invoiceUrl = $paymentResponse['invoice_url'];

    $response = [
      'success'     => true,
      'message'     => 'Payment data',
      'data'        => $paymentResponse,
      'invoice_url' => $invoiceUrl,
    ];

    return $response;
  } catch (Exception $e)
  {
    $response = [
      'success' => false,
      'message' => 'Internal error, Failed to process payment: ' . $e->getMessage()
    ];

    return $response;
  }
}

// createPayment(1000, 'customer@example.com');