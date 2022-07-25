<?php
session_start();
include("../includes/libraries/mailfunction.php");

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $amount = $_REQUEST['amount'];
	 
	 $sqluser=mysql_query("select * from buyde_user_registration where id='".$user_id."'");
	  $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
	 	$rows = mysql_fetch_array($sqluser);
 $totalcost=$amount;
$walletinset=mysql_query("insert into buyde_wallet_transaction(user_id,amount,adddate) values('".$user_id."','".$amount."',NOW())"); 
$orderid=mysql_insert_id();


    $_SESSION['walletuserid']=$user_id;

    $_SESSION['walletoidapi']=$orderid;
	$_SESSION['walletapiemail']=$rows['emailid'];
	$_SESSION['walletordertotalcost']=$totalcost;
	$_SESSION['walletorderfirstname']=$rows['fname'];
	$_SESSION['walletorderlastname']=$rows['lname'];
    $_SESSION['walletordermobilenumber']=$rows['billing_mobile'];

?>
<script type="text/javascript">
<!--
window.location = "https://www.keramicfresh.com/webservices1/payu-wallet-redirect.php"
//-->
</script>
<?php } 

else {
			echo "Customer do not exist.";
		}