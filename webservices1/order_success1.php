<?php session_start();
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
$sql2=mysql_query("select * from buyde_order where oid ='".$_SESSION['oidapi']."'");
$roworder=mysql_fetch_array($sql2);

	$sql=mysql_query("select * from buyde_user_registration where emailid='".$roworder['emailid']."'") or die(mysql_error());
	$rowuser=mysql_fetch_array($sql);
		$regwallet=	$rowuser['regwallet'];
		$userwallet=	$rowuser['wallet'];
		$sqlcart=mysql_query("select * from buyde_basket where bid='".$roworder['bid']."'");
while($rowcart = mysql_fetch_array($sqlcart))
{
   $qty=$qty+$rowcart['quantity'];
   $subtotal=$subtotal+$rowcart['subtotal'];

    
}
	if($regwallet>0)
		{
		   $regprocost= ($subtotal*25)/100;
		   $regprocost=number_format($regprocost);
		   if($regprocost > $regwallet)
		   {
		       $walletregdis=$regwallet;
		   }
		   else
		   {
		       $walletregdis=$regprocost;
		   }
		   
		}
		$resultship11 = mysql_query("select * from buyde_shipping_type where id='".$_SESSION['shipidship']."'");
		$shiprows11 = mysql_fetch_assoc($resultship11);
		if($subtotal>200) { $shipcharge='0';if($_SESSION['shipidship']=="5") { $shipcharge='30';} } else {$shipcharge='30';}
$totalcost=($subtotal+$shipcharge)-($coupondiscount+$walletregdis); 
if($userwallet>0)
		{
		   if($totalcost > $userwallet)
		   {
		       		       $walletused=$userwallet;

		       $totalcost=$totalcost-$userwallet;
		       $userwalletremain=0;
		   }
		   else if($totalcost == $userwallet)
		   {
		       $totalcost=0;
		       $userwalletremain=0;
		       		       $walletused=$userwallet;

		   }
		   else
		   {
		       $walletused=$totalcost;
		       $userwalletremain=$userwallet-$totalcost;
		       $totalcost=0;
		       
		   }
		   
		}
		
	$orderid=$_SESSION['oidapi'];	
			$basketu=mysql_query("update buyde_order set approve_status='Order Placed' where oid='".$orderid."'");		
			$basketos=mysql_query("insert into buyde_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Placed','".date('Y-m-d')."', '".date("H:m")."', '1')");		

		$subtotalremaining=($subtotal*8/100);
		if($walletused>0){
		    	$basketstatsude=mysql_query("insert into buyde_user_wallet (user_id, orderid,`type`,debit,adddate) values('".$rowuser['id']."','".$orderid."','Paid for order','".$walletused."',NOW())");
		}
		    	$basketstatsucr=mysql_query("insert into buyde_user_wallet(user_id, orderid,`type`,credit,adddate) values('".$rowuser['id']."','".$orderid."','Cashback Received','".$subtotalremaining."',NOW())");
		$totalwalletpoint=$userwalletremain+$subtotalremaining;
    	$basketstatsu=mysql_query("update buyde_user_registration set wallet='$totalwalletpoint' where id='".$rowuser['id']."'");
    	

  $regremainwallet=$regwallet-$walletregdis;
	if($regwallet>0)
{
    	$basketstatsu=mysql_query("update buyde_user_registration set regwallet='$regremainwallet' where id='".$rowuser['id']."'");	
}

///////////Send Order SMS////////////
	$str="Hi ".$rowuser['fname']." ".$rowuser['lname'].", Thank you for your order No. ".$orderid." at Donex of amount Rs. ".$roworder['totalcost'].". We will deliver the order asap.";
	
	$message=urlencode($str);

$username="KFRESH";

$password="vikash646";

$senderid="KFRESH";

$numbers=$rowuser['billing_mobile'];

$url="http://priority.muzztech.in/sms_api/sendsms.php?username=$username&password=$password&message=$message&sendername=$senderid&mobile=$numbers"; $ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $response = curl_exec($ch);
	
	
	//////////Send Order SMS////////////

?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 thankyou_page">
      <center><img src="https://www.keramicfresh.com/assets/images/thankyou.png" /></center>
      <div class="clearfix"></div>
      <h2>Thank you for placing order</h2>
      <div class="clearfix"></div>
  <div class="col-sm-3"></div>  <div class="col-sm-6">  <hr /></div>
        <div class="clearfix"></div>
      <h2><i class="fa fa-check-circle-o" aria-hidden="true"></i>
 Your order has been placed successfully</h2>
        <div class="clearfix"></div>
       <div class="col-sm-3"></div>  <div class="col-sm-6">  <hr /></div>
        <div class="clearfix"></div>
            <p>We send a confirmation mail to <?php echo $roworder['emailid']; ?></p>
            <div class="col-sm-4"></div>
      <div class="order_detail col-sm-6">
      
      <span>Order Number</span><span><?php echo $_SESSION['oidapi']; ?></span>
       <span>Shipping Charges</span><span>Rs. <?php echo $roworder['shipcharge'];?></span>
       <span>Total</span><span>Rs. <?php echo $roworder['totalcost']; ?></span>
      </div>
      </div>
      
    </div>
  
  </div>
</div>
<style>
.thankyou_page img {
    text-align: center;
    width: 20%;
    float: none;
    margin: 0 auto;
}

.thankyou_page{ padding:100px 0}
.thankyou_page h2 .fa{color: #00a249;
font-size: 26px;}
.thankyou_page h2 {
    width: 100%;
    float: left;
    text-align: center;
    font-size: 25px; margin:10px 0
}

.thankyou_page hr{border-top: 1px solid #e1d7d7 !important;}
.thankyou_page p {
    width: 100%;
    float: left;
    text-align: center;
    font-size: 14px; margin-bottom:30px;}
.order_detail span{ float:left; width:50%; line-height:25px;}
</style>
<?php
	 unset($_SESSION['oidapi']);	

?>