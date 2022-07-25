<?php  
session_start();
require('config.php'); 
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
//echo $_SESSION['razorpay_order_id'];
//echo "<br>";
//echo $_POST['razorpay_payment_id'];
//echo "<br>";
//echo $_POST['razorpay_signature']; 
$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        echo $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{ 
    ?>
    <script>
        window.location = "https://localhost/project/shopurneeds/ccresponse.php?payids=<?php echo $_POST['razorpay_payment_id']; ?>";

    </script>
    <?php
}
else
{ 
   ?>
    <script>
        window.location = "https://localhost/project/shopurneeds/orderfail";

    </script>
   <?php
}
 
