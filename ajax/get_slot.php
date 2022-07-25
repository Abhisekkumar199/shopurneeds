<?php 
session_start(); 
include("../configuration.php");  
include('../includes/currency_display.php');
date_default_timezone_set('Asia/Calcutta'); 
$todaytime = date("His"); 

$datetime = new DateTime('tomorrow');
$tomorrow_date =  strtotime($datetime->format('Y-m-d'));

$date1 = date("Y-m-d",strtotime($_REQUEST['date']));

$date=  strtotime(date("Y-m-d",strtotime($_REQUEST['date']))); 
$currentdate =  strtotime(date("Y-m-d"));    

if($date==$currentdate)
{
    
    $sql_slot = mysqli_query($conn,"select * from shopurneeds_shipping_slot where displayflag='1'"); 
    while($rows_slot = mysqli_fetch_assoc($sql_slot))
    {  
        $message = '';
        $slotid=$rows_slot['id'];
        $slotnooforder=$rows_slot['nooforder'];
        $dtimesing=$rows_slot['delivery_timing'];
        $sqlorderdinal=mysqli_query($conn,"select * from shopurneeds_order where cdate='".$date1."' and shippingslot='".$slotid."'");
        $sqlsslotnumorder=mysqli_num_rows($sqlorderdinal);
        if($slotnooforder>$sqlsslotnumorder)
        {
            if($todaytime > $dtimesing)
            { 
                $dslotflag="0";
                $message = "Time is over for this slot";
            }
            else
            { 
                $dslotflag="0";
                $message = "Time is over for this slot";
            }
        }
        else
        {
            $message = "Slot is Full";
            $dslotflag="0";
        }
        
    ?> 
        <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio">
            <input name="slot" type="radio" value="<?php echo $rows_slot['id']; ?>" <?php if($dslotflag == '0'){ echo "disabled ";   ?> style="color:#d4d4d4;"  <?php } ?> required=""    >
            <span class="checkmark"></span>
            <span style="padding-left:7%;<?php if($dslotflag == '0'){    ?>color:#d4d4d4;   <?php } ?>" ><?php echo $rows_slot['delivery_slot']; ?> <?php if($message != '')  { echo "(".$message.")"; } ?></span>
        </label>
    <?php }  
}
else if($date==$tomorrow_date)
{
    
    $sql_slot = mysqli_query($conn,"select * from shopurneeds_shipping_slot where displayflag='1'"); 
    while($rows_slot = mysqli_fetch_assoc($sql_slot))
    {  
        $message = '';
        $slotid=$rows_slot['id'];
        $slotnooforder=$rows_slot['nooforder'];
        $dtimesing=$rows_slot['delivery_timing'];
        $sqlorderdinal=mysqli_query($conn,"select * from shopurneeds_order where cdate='".$date1."' and shippingslot='".$slotid."'");
        $sqlsslotnumorder=mysqli_num_rows($sqlorderdinal);
        if($slotnooforder>$sqlsslotnumorder)
        {
            if($rows_slot['delivery_slot'] == "6 pm to 9 pm")
            {  
                $dslotflag="1";
                $message = "";
            }
            else
            { 
                $dslotflag="0";
                $message = "";
            }
        }
        else
        {
            $message = "Slot is Full";
            $dslotflag="0";
        }
        
    ?> 
        <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio">
            <input name="slot" type="radio" value="<?php echo $rows_slot['id']; ?>" <?php if($dslotflag == '0'){ echo "disabled ";   ?> style="color:#d4d4d4;"  <?php } ?> required=""    >
            <span class="checkmark"></span>
            <span style="padding-left:7%;<?php if($dslotflag == '0'){    ?>color:#d4d4d4;   <?php } ?>" ><?php echo $rows_slot['delivery_slot']; ?> <?php if($message != '')  { echo "(".$message.")"; } ?></span>
        </label>
    <?php }  
}

else
{
    $sql_slot = mysqli_query($conn,"select * from shopurneeds_shipping_slot where displayflag='1'"); 
    while($rows_slot = mysqli_fetch_assoc($sql_slot))
    {  
        $message = '';
        $slotid=$rows_slot['id'];
        $slotnooforder=$rows_slot['nooforder'];
        $dtimesing=$rows_slot['delivery_timing'];
        $sqlorderdinal=mysqli_query($conn,"select * from shopurneeds_order where cdate='".$date."' and shippingslot='".$slotid."'");
        $sqlsslotnumorder=mysqli_num_rows($sqlorderdinal);
        if($slotnooforder>$sqlsslotnumorder)
        {
            $dslotflag="1";
            $message = '';
        } 
        else
        {
            $message = "Slot is Full";
            $dslotflag="0";
        }
        
    ?> 
        <label class="col-sm-12 col-xs-12 pull-left payment-icon1 container-radio">
            <input name="slot" type="radio" value="<?php echo $rows_slot['id']; ?>"  <?php if($dslotflag == '0'){ echo "disabled ";   ?> style="color:#d4d4d4;"  <?php } ?> required=""    >
            <span class="checkmark"></span>
            <span style="padding-left:7%; <?php if($dslotflag == '0'){    ?>color:#d4d4d4;   <?php } ?>"   ><?php echo $rows_slot['delivery_slot']; ?>  <?php if($message != '')  { echo "(".$message.")"; } ?></span>
        </label>
    <?php }  
}
?>    
							
	 