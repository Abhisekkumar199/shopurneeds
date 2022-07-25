<?php
session_start();
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="rcrHVQ29aZ";
If (isset($_POST["additionalCharges"])) {
$additionalCharges=$_POST["additionalCharges"];
$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
} else {
$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}
$hash = hash("sha512", $retHashSeq);
if ($hash != $posted_hash) {
?>
			<script>window.location.href='https://localhost/project/shopurneeds/webservices1/order_success.php';</script>
<?php
    
} else {
   

			?>
			<script>window.location.href='https://localhost/project/shopurneeds/webservices1/order_success.php';</script>
<?php
}
?>

