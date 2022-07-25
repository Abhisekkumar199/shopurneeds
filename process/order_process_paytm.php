<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
session_start();
include("includes/chklogin.php");
include("../includes/libraries/mailfunction.php");
include("../configuration.php");	

$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName; 
$URL=URL;
$basketpid=$_SESSION['shopid'];
$emailid=$_SESSION['emailid'];
$qty=$_SESSION['qty'];
$price=$_SESSION['price'];
$shipprice=$_SESSION['shipprice'];
$shipprice23=$_REQUEST['shipping']; 
$discvalue=$_SESSION['discvalue'];
$vouchervalue=$_SESSION['vouchervalue'];
$pweight=$_SESSION['pweight'];
$ccvalue123=$_REQUEST['ccvalue123'];
$remainccvalue=$_REQUEST['remainccvalue'];
$tax = $_REQUEST['tax'];
$cod_charges = $_REQUEST['cod_charges'];
$coupon_discount = $_REQUEST['coupon_discount'];
$ipaddress=$_SERVER['REMOTE_ADDR'];
$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'") ;
$rowuser=mysqli_fetch_assoc($sql);
$sqlcou=mysqli_query($conn,"select countryname from shopurneeds_country where countrycode='".$rowuser['deliver_country']."'");  
$countrssss=mysqli_fetch_array($sqlcou,0);

$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$_SESSION['selected_address']."'");
$rowaddress = mysqli_fetch_array($sqladdress); 

mysqli_query($conn,"insert into ".$sufix."order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,`paytype`,`ipaddress`, `orderinistatus`, `ordermode`,`paymentmodetype`,currency,conration) values ('".$basketpid."', '".$qty."', '".$price."', '".$shipprice."', '".$discvalue."', '".$vouchervalue."', '".$pweight."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Pending','0','0','0', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['city']."', '".$rowaddress['state']."', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '', '','Paytm','$ipaddress', 'Order pending', 'Paytm Payment','1','".$_SESSION['currencycode']."','".$_SESSION['conratio']."')") ;	
$orderid=mysqli_insert_id($conn);
$_SESSION['oid']=$orderid;
$_SESSION['paytype']="Ccavenue";
include("ccavenueValidate.php");
$ccavenuemerchantId= "131927";//This id (also User Id)  available at "Generate Working Key" of "Settings & Options"
$Amount = $price;//your script should substitute the amount in the quotes provided here
$orderId123= $orderid;//your script should substitute the order description in the quotes provided here
$WorkingKey = "2C8601388DEC3548636467724665E02B";//Given to merchant by ccavenue
$returnUrl ="https://localhost/project/shopurneeds/ccresponse"; //url of your successpage
$Checksum = getCheckSum($ccavenuemerchantId,$Amount,$orderId123,$returnUrl,$WorkingKey); // Validate All value

?>
<script>

   $(document).ready(function() {
		$("#payuForm").submit();
	});
    </script>
<form action="https://localhost/project/shopurneeds/pgRedirect.php" method="post" name="payuForm" id="payuForm">
     <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"	name="ORDER_ID" autocomplete="off"	value="<?php echo $_SESSION['oid']; ?>">
    <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $rowuser['id']; ?>">
    <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail109">
    <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
    <input type="hidden" title="TXN_AMOUNT" tabindex="10" name="TXN_AMOUNT" value="<?php echo floor($Amount*$_SESSION['conratio']); ?>">
    
</form>
