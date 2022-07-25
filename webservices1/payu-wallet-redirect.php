<?php
session_start();
  require_once 'payu-wallet.php';
/* Payments made easy. */

pay_page( array (	'key' => 'WhuukL', 'txnid' => $_SESSION['walletoidapi'], 'amount' => $_SESSION['walletordertotalcost'],
			'firstname' => $_SESSION['walletorderfirstname'], 'email' => $_SESSION['walletapiemail'], 'phone' => $_SESSION['walletordermobilenumber'],
			'productinfo' => 'Add money to account', 'surl' => 'payment_success', 'furl' => 'payment_failure'), 'B8Y1V6T1' );

/* And we are done. */ 
			


function payment_success() {
	/* Payment success logic goes here. */
	echo "Payment Success" . "<pre>" . print_r( $_POST, true ) . "</pre>";
}

function payment_failure() {
	/* Payment failure logic goes here. */
	echo "Payment Failure" . "<pre>" . print_r( $_POST, true ) . "</pre>";
}
?>