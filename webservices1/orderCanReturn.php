<?php
    header("Content-type:application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	$sufix="shopurneeds_";

	$userid= isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";

	$orderid=isset($_REQUEST["orderId"])?$_REQUEST["orderId"]:"";

	$orderCanReturn=isset($_REQUEST["orderCanReturn"])?$_REQUEST["orderCanReturn"]:"";

	$reason =$_REQUEST["reason"];

	

		$response["status"]="200";

		$ordersql = mysql_fetch_assoc(mysql_query("select * from ".$sufix."order where oid='".$orderid."'"));


if($ordersql['approve_status']=="Order Approved")
{
		if($orderCanReturn==0){

		

			$reason1 = mysql_query("insert into ".$sufix."cancel (pid,bid,seller_id,user_id,status,reason,adddate,type,return_status,oid_seller) values('".$basketsql['productid']."','".$ordersql['bid']."','".$ordersql['seller_id']."','".$ordersql['userid']."', 'Cancel','".$reason."',NOW(),'product','Close','".$orderid."')") or die(mysql_error());

			$update = mysql_query("update ".$sufix."basket set status = 'Cancel', reason = '".$reason."' where bid = '".$ordersql['bid']."'") or die(mysql_error());


			$update =mysql_query("update ".$sufix."order set approve_status='Cancelled' where oid='".$orderid."'");
			
			 $sqlorder=mysql_fetch_array(mysql_query("select *  from ".$sufix."order where oid = '".$orderid."'"));
     if($sqlorder['walletused']>0)
     {
         $sqluser=mysql_fetch_array(mysql_query("select *  from ".$sufix."user_registration where emailid = '".$sqlorder['emailid']."'"));

         $walleramount=$sqlorder['walletused'];
         	$query = mysql_query("update `".$sufix."user_registration` set `wallet`=wallet+$walleramount where id='".$sqluser['id']."'");

	mysql_query("insert into `".$sufix."user_wallet` (user_id,orderid,type,credit,adddate) values('".$sqluser['id']."','".$orderid."','Cancelled Order','".$walleramount."',NOW())");

     }

			$response["msg"]="order cancelled successfully.";

		}else if ($orderCanReturn==1) {

			$reason = mysql_query("insert into ".$sufix."reason (`pid`,`bid`,`seller_id`,`user_id`,`status`,`reason`,`adddate`,`type`,`oid_seller`) values('".$basketsql['productid']."', '".$ordersql['bid']."', '".$ordersql['seller_id']."', '".$ordersql['userid']."', 'Return', '".$reason."', NOW(),'product', '".$orderid."')");

	        $update = mysql_query("update ".$sufix."basket set status = 'Return', reason = '".$reason."' where bid = '".$ordersql['bid']."'");
	        
	        $update =mysql_query("update ".$sufix."order set approve_status='Return' where oid='".$orderid."'");

		/*
			 $to = 'info@obeymart.com';
	         $subject = "Return request by customer";
	         
	         $message = "<b>Seller Id :  ".$ordersql['seller_id']."<br>";
	         $message .= "<b>Product Id : ".$basketsql['productid']."<br>";

	         
	         $header = "From:info@obeymart.com \r\n";
	         $header .= "MIME-Version: 1.0\r\n";
	         $header .= "Content-type: text/html\r\n";
	         
	         $retval = mail ($to,$subject,$message,$header);
*/
			$response["msg"]="order returned successfully.";
		}
		


	}else{

		$response["status"]="404";
		$response["msg"]="some parameter missing";

	}


	echo json_encode($response);
	die;
?>