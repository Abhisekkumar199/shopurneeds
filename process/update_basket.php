<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 

//echo "select * from ".$sufix."basket where id='".$_REQUEST['id']."' and bid='".$_SESSION['shopid']."' and productid='".$_REQUEST['pid']."'";
$sql=mysqli_query($conn,"select * from ".$sufix."basket where id='".$_REQUEST['id']."' and bid='".$_SESSION['shopid']."' and productid='".$_REQUEST['pid']."'");
while($rows = mysqli_fetch_assoc($sql))
{
	$sellingprice=$rows['sellingprice'];
	$qty=$rows['quantity'];	
	$pweight2=$rows['pweight'];
	$shipprice=$rows['shipprice'];
	
	$costprice=$rows['costprice'];
    $subdiscount=$rows['subdiscount'];
	
}
if($_REQUEST['option']=='add')
{
	$qty2=$qty + 1;
}
else
{
	$qty2=$qty - 1;

}	

if($qty2<1)
{	
	$qty2=1;
}

 $subtotal=$sellingprice*$qty2;
 $pweight= $pweight2*$qty2;
 
  $submrpnew=$costprice*$qty2;
    $subdiscountnew = $subdiscount*$qty2;
 
	mysqli_query($conn,"update `".$sufix."basket` set `quantity`='".$qty2."', `subtotal`='".$subtotal."',submrp='".$submrpnew."',subdiscount='".$subdiscountnew."', `totalweight`='".$pweight."' where id='".$_REQUEST['id']."' and bid='".$_SESSION['shopid']."' and productid='".$_REQUEST['pid']."'") ;
//	header("Location:".$_SERVER['HTTP_REFERER']); 
?>	

        <script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script>