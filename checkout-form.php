<?php
    include("configStripe.php");

    $token = $_POST["stripeToken"];
    $contact_name = $_POST["c_name"];
    $token_card_type = $_POST["stripeTokenType"];
    $phone           = $_POST["phone"];
    $email           = $_POST["stripeEmail"];
    $address         = $_POST["address"];
    $amount          = $_POST["amount"]; 
    $desc            = $_POST["product_name"];
    $charge = \Stripe\Charge::create([
      "amount" => str_replace(",","",$amount) * 100,
      "currency" => 'inr',
      "description"=>$desc,
      "source"=> $token,
    ]);

    if($charge){
      header("Location:success.php?amount=$amount");
    }
?>

<!--<form id="checkout-form">
    Your other checkout fields go here
    <div id="card-element">
        A Stripe Element will be inserted here. 
    </div>

    Used to display form errors.
    <div id="card-errors" role="alert"></div>

    <button type="submit">Submit Payment</button>
</form>-->