<?php
session_start();
include("../includes/libraries/mailfunction.php");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
$alletoidapi = $_SESSION['walletoidapi'];
$amount = $_SESSION['walletordertotalcost'];
$email = $_SESSION['walletapiemail'];
	$sql=mysql_query("select * from buyde_user_registration where id='".$_SESSION['walletuserid']."'") or die(mysql_error());
	$rowuser=mysql_fetch_array($sql);
$sqluser=mysql_query("select * from buyde_wallet_transaction where id='".$alletoidapi."'");
	 $numuser=mysql_num_rows($sqluser);

$upsatewallet=mysql_query("update buyde_wallet_transaction set status='1' where id='".$alletoidapi."'");
$wallinsert=mysql_query("insert into buyde_user_wallet(user_id,orderid,`type`,credit,adddate) values('".$_SESSION['walletuserid']."','".$alletoidapi."','Add to Account','".$amount."',NOW())");
   $upsatewalletss=mysql_query("update buyde_user_registration set wallet=wallet+ $amount where emailid='".$email."'");
   if($amount  >= 2000)
   {
       $wallinsert=mysql_query("insert into buyde_user_wallet(user_id,orderid,`type`,credit,adddate) values('".$_SESSION['walletuserid']."','".$alletoidapi."','Cashback Received for Wallet Recharge','350',NOW())");
   $upsatewalletss=mysql_query("update buyde_user_registration set wallet=wallet+ 350 where emailid='".$email."'");
   }
   else if($amount  >=1000) 
   {
       $wallinsert=mysql_query("insert into buyde_user_wallet(user_id,orderid,`type`,credit,adddate) values('".$_SESSION['walletuserid']."','".$alletoidapi."','Cashback Received for Wallet Recharge','150',NOW())");
   $upsatewalletss=mysql_query("update buyde_user_registration set wallet=wallet+ 150 where emailid='".$email."'");
   }
   else 
   {
       
   }
///////////Send Order SMS////////////
	$str="Hi ".$rowuser['fname']." ".$rowuser['lname'].", Rs. ".$amount.". added to you account successfully on keramicfresh.com.";
	
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
      <h2>Thank you for adding money in your kemarmicfresh.com wallet.</h2>
      <div class="clearfix"></div>
  <div class="col-sm-3"></div>  <div class="col-sm-6">  <hr /></div>
        <div class="clearfix"></div>
      
        <div class="clearfix"></div>
       <div class="col-sm-3"></div>  <div class="col-sm-6">  <hr /></div>
        <div class="clearfix"></div>
           
            <div class="col-sm-4"></div>
      <div class="order_detail col-sm-6">
      
      <span>Wallet Order Number</span><span><?php echo $_SESSION['walletoidapi']; ?></span>
       
       <span>Total</span><span>Rs. <?php echo $amount; ?></span>
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
	 unset($_SESSION['walletoidapi']);	
	 	 unset($_SESSION['walletordertotalcost']);	
	 unset($_SESSION['walletapiemail']);	


?>