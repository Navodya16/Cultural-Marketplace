<?php

require_once "stripe-php-master/init.php";

$stripeDetails = array(
    "publishableKey" => "pk_test_51Oex8wSCd5OBxwrK8ZM2iUtc8KpPuse5BV3HY2XxOcEIitnjMaQfhIcPm5UTsTQqiFTv5GtWYydE60Bkx2j2iajv007Hk8ldMK",
    "secretKey" => "sk_test_51Oex8wSCd5OBxwrK4gRvqtgqCKTE3VZsAjx5YCXphVP3YdoJxj4G2mXz5l0PNVd9KEOpXJ94cG5wzmxjBhwESmYp00re42Hdz1"
);

\Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);

?>
