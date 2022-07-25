<?php
session_start(); 
include("include/configurationadmin.php"); 
include("include/mailfunction.php"); 

$orderidssa=$_POST['orderidssa'];
$walletreturn=$_POST['walletreturn'];  
for($i=0;$i<count($_POST['basketpids12']); $i++)
{
    if($_POST['basketpids12'][$i]!='')
    { 
        if($_POST['basketcancel'][$i] == 1)
        { 
            $diamondsql = mysqli_query($conn,"update ".$sufix."basket set iscancel='".$_POST['basketcancel'][$i]."' where id='".$_POST['basketpids12'][$i]."'");
        }
    }
}

$sqlorder=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."order where oid='".$orderidssa."'"));
$sqluser=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$sqlorder['emailid']."'"));

$orderupdate=mysqli_query($conn,"update ".$sufix."order set totalcost=totalcost-$walletreturn, walletreturn=walletreturn+'".$walletreturn."' where oid='".$orderidssa."'");
if($sqlorder['paytype']=="online")
{
$orderupdate=mysqli_query($conn,"update ".$sufix."user_registration set wallet=wallet+$walletreturn where id='".$sqluser['id']."'");
$basketstatsude=mysqli_query($conn,"insert into ".$sufix."user_wallet(user_id, orderid,`type`,credit,adddate) values('".$sqluser['id']."','".$orderidssa."','Return for order','".$walletreturn."',NOW())");
  
}
?>	

 <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script>