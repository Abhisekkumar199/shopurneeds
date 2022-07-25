<?php 
session_start();
include("includes/configuration.php");

$ordersql = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."order_seller where id='".$_REQUEST['orderids']."'"));
$basketsql = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."basket where oid_seller='".$_REQUEST['orderids']."'"));
?>
<input type="hidden" name="checkstatus" id="checkstatus" class="checkstatus" value="<?php echo $_REQUEST['checkstatus'];?>" />
<input type="hidden" name="orderid" id="orderid" class="orderid" value="<?php echo $_REQUEST['orderids'];?>" />
<input type="hidden" name="orderstatus" class="orderstatus" id="orderstatus" value="<?php echo $ordersql['approve_status'];?>" />
<input type="hidden" name="seller_id" class="seller_id" id="seller_id" value="<?php echo $ordersql['seller_id'];?>" />
<input type="hidden" name="user_id" class="user_id" id="user_id" value="<?php echo $ordersql['userid'];?>" />
<input type="hidden" name="bid" class="bid" id="bid" value="<?php echo $ordersql['bid'];?>" />
<input type="hidden" name="pid" class="pid" id="pid" value="<?php echo $basketsql['productid'];?>" />