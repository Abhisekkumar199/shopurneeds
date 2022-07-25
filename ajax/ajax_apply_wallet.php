<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php");  

$totalamt = $_REQUEST['total_order_amount'];
$is_apply_wallet = $_REQUEST['is_apply_wallet'];
$status = $_REQUEST['status'];
if($is_apply_wallet == 1)
{ 
    $sql_user=mysqli_fetch_assoc(mysqli_query($conn,"select wallet from `".$sufix."user_registration` where id='".$_SESSION['useridse']."'"));
    $_SESSION['user_wallet_amount'] = $sql_user['wallet'];
    if($_SESSION['user_wallet_amount'] > $totalamt)
    {
        $_SESSION['totalpaybleamount'] = 0 ;
        $_SESSION['remainingwalletamount'] =  $_SESSION['user_wallet_amount'] - $totalamt;
        $_SESSION['walletamounttobeuse'] = $totalamt;
    }
    else if($_SESSION['user_wallet_amount'] == $totalamt)
    {
        $_SESSION['totalpaybleamount'] = 0 ;
        $_SESSION['remainingwalletamount'] =  0;
        $_SESSION['walletamounttobeuse'] = $totalamt; 
    } 
    
    else if($_SESSION['user_wallet_amount'] < $totalamt)
    {
        $_SESSION['totalpaybleamount'] = $totalamt - $_SESSION['user_wallet_amount'];
        $_SESSION['remainingwalletamount'] =  0;
        $_SESSION['walletamounttobeuse'] = $_SESSION['user_wallet_amount']; 
    }  
    $_SESSION['is_wallet_applied'] = 1; 
}
else
{
    $_SESSION['totalpaybleamount'] = $totalamt;
    $_SESSION['remainingwalletamount'] =  $_SESSION['user_wallet_amount'];
    $_SESSION['walletamounttobeuse'] = 0; 
    $_SESSION['is_wallet_applied'] = 0;
} 
 ?>