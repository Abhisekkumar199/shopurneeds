<?php
session_start();
include("../includes/libraries/mailfunction.php");
date_default_timezone_set('Asia/Calcutta');

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $orderid = $_REQUEST['orderid'];
	 	 $user_id = $_REQUEST['userId'];

	 $paymentid = $_REQUEST['paymentid'];
	 $pstatus = $_REQUEST['pstatus'];

	 	 if($pstatus=="success")
	 	 {



$sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
$rowuser = mysql_fetch_array($sqluser);
	$userwallet=	$rowuser['wallet'];

$sqlorder=mysql_query("select * from shopurneeds_order where oid='".$orderid."'");
$roworder = mysql_fetch_array($sqlorder);
	 $cartid = $roworder['bid'];

$sqladdress=mysql_query("select * from shopurneeds_customer_address where id='".$roworder['address_id']."'");
$rowaddress= mysql_fetch_array($sqladdress);

$walletused=$roworder['walletused'];
if($walletused>0){
		    	$basketstatsuderrrrr=mysql_query("insert into shopurneeds_user_wallet (user_id, orderid,`type`,debit,adddate) values('".$rowuser['id']."','".$orderid."','Paid for order','".$walletused."',NOW())");
	    	$basketstatsurrrr=mysql_query("update shopurneeds_user_registration set wallet=wallet-$walletused where id='".$rowuser['id']."'");
	
    
}
    $saveorder=mysql_query("update shopurneeds_order set `approve_status`='Order Approved', razorpayid='".$paymentid."' where oid='".$orderid."'");


	$basketstatsu=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Approved','".date('Y-m-d')."', '".date("H:m")."', '1')");	
	
	$str="Hi, Your order no $orderid placed successfully.It will be delivered on ".date("d-M-Y",strtotime($roworder['delivery_date'])).".";
		$usersss = $db->sendordermsg($roworder['deliver_phone'],$str);

$emailid=$rowuser['emailid'];
$paytpemail="Online";

	                 include("app_order_mail.php"); 
                        send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
 

	 $response["status"] = "200";
			$response["msg"] = "Thank you for placing order with Shopurneeds.";
					
			echo json_encode($response);
}
else
{
    $saveorder=mysql_query("update shopurneeds_order set `approve_status`='Order Pending' where oid='".$orderid."'");
    $response["status"] = "400";
			$response["msg"] = "Payment Failed, Please try again";
					
			echo json_encode($response);
}

   


?>

