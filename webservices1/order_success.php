<?php session_start();
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
$sql2=mysql_query("select * from shopurneeds_order where oid ='".$_SESSION['oidapi']."'");
$roworder=mysql_fetch_array($sql2);

	$sql=mysql_query("select * from shopurneeds_user_registration where emailid='".$roworder['emailid']."'") or die(mysql_error());
	$rowuser=mysql_fetch_array($sql);
	$userwallet=	$rowuser['wallet'];
		$userwallet232=	$rowuser['wallet'];
		$sqlcart=mysql_query("select * from shopurneeds_basket where bid='".$roworder['bid']."'");
while($rowcart = mysql_fetch_array($sqlcart))
{
    			       $sellerId=$rowcart['seller_id'];

   $qty=$qty+$rowcart['quantity'];
   $subtotal=$subtotal+$rowcart['subtotal'];

    
}

		$resultship11 = mysql_query("select * from shopurneeds_shipping_type where id='".$_SESSION['shipidship']."'");
		$shiprows11 = mysql_fetch_assoc($resultship11);
	$shippingprice=10;
$totalcost=($subtotal+$shippingprice)-($coupondiscount+$walletregdis); 

	if($userwallet>0)
{
if($totalcost > $userwallet)
{
$walletused=$userwallet;
$totalcost=$totalcost-$walletused;
$userwalletremain=$userwallet-$walletused;
}
else if($totalcost == $userwallet)
{
$walletused=$userwallet;
$totalcost=$totalcost-$walletused;
$userwalletremain=$userwallet-$walletused;

}
else
{
$walletused=$totalcost;
$userwalletremain=$userwallet-$walletused;
$totalcost=$totalcost-$walletused;


}

}
	

	$orderid=$_SESSION['oidapi'];	
			$basketu=mysql_query("update shopurneeds_order set approve_status='Order Placed' where oid='".$orderid."'");		
			$basketos=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Placed','".date('Y-m-d')."', '".date("H:m")."', '1')");		

		$subtotalremaining=($subtotal*8/100);
		if($walletused>0){
		    	$basketstatsude=mysql_query("insert into shopurneeds_user_wallet (user_id, orderid,`type`,debit,adddate) values('".$rowuser['id']."','".$orderid."','Paid for order','".$walletused."',NOW())");
		}
		    	//$basketstatsucr=mysql_query("insert into shopurneeds_user_wallet(user_id, orderid,`type`,credit,adddate) values('".$rowuser['id']."','".$orderid."','Cashback Received','".$subtotalremaining."',NOW())");
		$totalwalletpoint=$userwalletremain;
    	$basketstatsu=mysql_query("update shopurneeds_user_registration set wallet='$totalwalletpoint' where id='".$rowuser['id']."'");
    	

  
///////////Send Order SMS////////////
		$timestampssss = strtotime($roworder['deliverydate']);
    $newdlDate = date('d F Y', $timestampssss); 
		//$str="Hi ".$rowuser['fname']." ".$rowuser['lname'].", Thank you for your order No. MB/DEL/".$orderid." at harianafresh.com of amount Rs. ".$roworder['totalcost'].". We will deliver your order on ".$newdlDate." between ".$roworder['shippingmethod'];
 $str="Hi ".$rowuser['fname']." ".$rowuser['lname'].", Thank you for your order No. ".$orderid." at harianafresh of amount Rs. ".$roworder['totalcost'].". We will deliver the order asap.";

	
	$message=urlencode($str);

$username="phalanjjjjjxtrans";

$password="mfePrKjjjj1z";

$senderid="oxyge333333n";

$numbers=$rowuser['billing_mobile'];

$url="https://sms.shinenetcore.com/vendorsms/pushsms.aspx?clientid=71b4afac-c8b5-4b30-8df8-8ba03a95b1b5&apikey=d7f7231d-621e-4471-af3d-61181f46941a&sid=HFRESH&fl=0&gwid=2&msisdn=$numbers&msg=$message"; 

$ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $response = curl_exec($ch);	


	//////////Send Order SMS////////////

?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 thankyou_page">
      <center><img src="https://localhost/project/shopurneeds/assets/images/thankyou.png" /></center>
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
      <span>Discount</span><span><?php echo $roworder['discountvalue']; ?></span>
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

     include("../includes/libraries/mailfunction.php");
    
    // payment method
    $paytype=$roworder["payby"];
    
    include("../order_mail.php");
    send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
    
	 unset($_SESSION['oidapi']);	

?>