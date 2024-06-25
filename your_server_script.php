<?php
require_once 'vendor/autoload.php'; // Include Stripe PHP library
require_once "stripe-php-master/init.php";

\Stripe\Stripe::setApiKey('sk_test_51Oex8wSCd5OBxwrK4gRvqtgqCKTE3VZsAjx5YCXphVP3YdoJxj4G2mXz5l0PNVd9KEOpXJ94cG5wzmxjBhwESmYp00re42Hdz1');

// Retrieve total amount from the URL parameter
$totalAmount = $_GET['total'];

// Create a Checkout session
$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [
        [
            'price_data' => [
                'currency' => 'lkr',
                'product_data' => [
                    'name' => 'Your Product',
                ],
                'unit_amount' => $totalAmount * 100, // Convert to cents
            ],
            'quantity' => 1,
        ],
    ],
    'mode' => 'payment',
    'success_url' => 'http://localhost/culture/', // Redirect URL after successful payment
    'cancel_url' => 'http://localhost/culture/', // Redirect URL after canceled payment
]);

echo json_encode(['sessionId' => $checkout_session->id]);
?>

<!-- Include Stripe.js library -->
<script src="https://js.stripe.com/v3/"></script>

<script>
  var stripe = Stripe('pk_test_51Oex8wSCd5OBxwrK8ZM2iUtc8KpPuse5BV3HY2XxOcEIitnjMaQfhIcPm5UTsTQqiFTv5GtWYydE60Bkx2j2iajv007Hk8ldMK'); // Replace with your actual Stripe public key
  var sessionId = <?php echo json_encode($checkout_session->id); ?>;
  var totalAmount = <?php echo $totalAmount; ?>;

  // Initialize Stripe Checkout
  stripe.redirectToCheckout({
    sessionId: sessionId
  }).then(function (result) {
    // If `redirectToCheckout` fails, display an error to your customer.
    if (result.error) {
      alert(result.error.message);
    }
  });

  // You can use the following event listener to handle successful payment
  // and execute the AJAX call with the total amount.
  stripe.redirectToCheckout({
    sessionId: sessionId
  }).then(function (result) {
    if (result.error) {
      // Handle any errors during the redirect to Checkout
      alert(result.error.message);
    } else if (result.paymentIntent.status === 'succeeded') {
      // Payment succeeded, execute your AJAX call
      $.ajax({
        url: "admin/ajax.php?action=save_culture_order",
        method: 'POST',
        data: { totalAmount: totalAmount },
        success: function (resp) {
          if (resp == 1) {
            swal({
              title: "Order is confirmed",
              icon: "success",
              button: "Ok!",
              customClass: {
                content: 'text-center',
              },
            }).then(function () {
              location.replace('index.php?page=home');
            });
          }
        }
      });
    }
  });

</script>
