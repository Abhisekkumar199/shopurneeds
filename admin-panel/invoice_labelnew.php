<?php 
session_start(); 
include("include/configurationadmin.php"); 
$oid=$_REQUEST['id'];
	
$weight=$_POST['weight'];
$length=$_POST['length'];
$width=$_POST['width'];
$height=$_POST['height'];
if($_POST['submit'])
{
    $taxs = $_POST['taxs'];
    $proidu = $_POST['pids'];
    foreach ($proidu  as $key => $value) 
    {
		$query11 = mysqli_query($conn,"update `".$sufix."product` set tax='".$taxs[$key]."'  WHERE id = '".$proidu[$key]."'");
    }
    $query12 = mysqli_query($conn,"update `".$sufix."order_seller` set invoicedate=NOW()  WHERE id = '".$oid."'");
    $query13=mysqli_query($conn,"update `".$sufix."product` (weight,length,width,height)VALUES('$weight','$length','$width','$height')");
}
$query12 = mysqli_query($conn,"update `".$sufix."order_seller` set invoicedate=NOW()  WHERE id = '".$oid."'");
$page=$_REQUEST['page'];
 


?>

<?php
 
$option="View";
?>


<?php   
$rows = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."order` where oid='".$oid."'")); 


$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$rows['address_id']."'");
$rowaddress = mysqli_fetch_array($sqladdress);
if($rows['invoiceno']=='')
{
    $rowsinvoice = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."invoice` order by id desc limit 1")); 
    $datetoday = date('Y-m-d');

   if( $rowsinvoice['adddate']==$datetoday)
   {
       $invoiceid=$rowsinvoice['iid']+1;
   }
else
{
           $invoiceid=1;

}

	$sqlsa=mysqli_query($conn,"insert into shopurneeds_invoice(orderid,adddate,iid) values ('".$oid."',NOW(),'".$invoiceid."')");
	$inserid=mysqli_insert_id($conn);
	    $rowsifdfd = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."invoice` where id='".$inserid."'")); 

	$finalinvoiceformat="ML | ".date('ymd')." | ".$rowsifdfd['iid'];
	$updares=mysqli_query($conn,"update `".$sufix."order` set invoiceno='".$finalinvoiceformat."',invoicedate=NOW() where oid='".$oid."'");
} 
$rowuser = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$rows['emailid']."'")); 
$rows = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."order` where oid='".$oid."'")); 

?>
<html xmlns="http://www.w3.org/1999/xhtml"><head><style type="text/css">
.style3 {
	color: #666666;
	font-size: xx-small;
}
.style4 {color: #999999}
.style5 {
	font-size: 12px;
	font-weight: bold;
}
</style>
<style>
	.txt { font-size:12px !important; }
	</style>
	<script language="Javascript1.2">
    function printpage() {
    window.print();
    }
    </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>System Generated</title>
</head>
<!--"-->
<body  onLoad="printpage()" style="width:100%; height:380px; font-family:arial; "   >
    <table width="100%">
        <tbody>
        <tr style="background-color:#fff;">
            <td style="text-align:center; color:#fcd3c1; padding: 10px 30px;">&nbsp;&nbsp;<img src="https://localhost/project/shopurneeds/assets/images/logo.png" style="width:150px; ">&nbsp;&nbsp;</td> 
        </tr>
        <tr>
            <td colspan="3" class="txt" height="0"><hr style="margin:0;"></td>
        </tr>
        <tr><td class="txt" align="center">TAX INVOICE<br></td></tr>
        <tr> <td colspan="3" class="txt" height="0"><hr style="margin:0;"></td> </tr>
        </tbody>
    </table>
    <table height="380" width="670">
        <tbody>
        <tr>
            <td width="48%" valign="top" class="heading">
            <table width="100%" height="58" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                <td width="48%" class="text4" align="left" valign="top" colspan="3">
                    <table width="100%" border="0" align="left" cellspacing="2">
                        <tbody> 
            			    <tr><td colspan="3" >&nbsp;</td></tr>
            			    <tr>
            			        <td width="40%" height="40" align="left" class="txt">  
                                <table width="100%" border="0" style="text-align:left; font-size:12px;" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>CUSTOMER&nbsp;NAME:&nbsp;</strong> </td><td style="padding-bottom:7px;"><?php echo ucfirst($rows['deliver_fname']); ?>&nbsp;<?php echo ucfirst($rows['deliver_lname']); ?></td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:37px;"><strong>SHIIPPING&nbsp;ADDRESS:&nbsp;</strong> </td><td style="padding-bottom:7px; ">                        <?php echo $rows['deliver_address']; ?>, <?php echo $rows['deliver_city']; ?>-<?php echo $rows['deliver_zip']; ?><br><?php echo $rows['deliver_state']; ?>,<?php echo $rows['deliver_country']; ?> <br />
                                    </td>
                                    </tr>
                                    <tr>
                                    <td style="padding-bottom:17px; "><strong>Mobile&nbsp;Number:&nbsp;</strong> </td><td style=" padding-bottom:7px;">                        <?php echo $rows['deliver_phone']; ?> <br />
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </td>
                            <td width="5%" height="40" align="left" class="txt"></td>             
        			        <td width="55%" height="40" align="left" class="txt">  
                            <table width="100%" border="0" style="text-align:left; font-size:12px;" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <?php 
                                        $rowse = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."suppliers` where id='".$rows['seller_id']."'")); 
                                    ?>
                                    <tr>
                                        <td style=" padding-bottom:7px; valigh:top;padding-bottom:32px;"><strong>SUPPLIER&nbsp;DETAILS&nbsp;</strong> </td><td style=" padding-bottom:7px;">SHOP UR NEEDS<br>Pole No. 98, H.No. 588/589<br>
Nasirpur Extn, Dwarka, South West<br>New Delhi - 110045 </td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>PAN NO.</strong> </td><td style=" padding-bottom:7px;">AVZPV0995R</td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>GSTIN NO.</strong> </td><td style=" padding-bottom:7px;">07AVZPV0995R1ZX</td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>ORDER DATE </strong></td><td style=" padding-bottom:7px;"><?php echo $rows['orderdate']; ?></td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>INVOICE DATE </strong></td><td style=" padding-bottom:7px;"><?php echo $rows['invoicedate']; ?></td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>INVOICE NO. </strong></td><td style=" padding-bottom:7px;"><?php echo $rows['invoiceno']; ?></td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>ORDER NO. </strong></td><td style=" padding-bottom:7px;"><?php echo $rows['oid']; ?></td>
                                    </tr>
                                    <tr>
                                    <td style=" padding-bottom:7px;"><strong>PAYMENT MODE</strong></td><td style=" padding-bottom:7px;"><?php echo $rows['paytype']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                </tr>
            </tbody>
            </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" height="5"><hr size="1" color="#EAEAEA"></td>
        </tr> 
        <tr>
        <td colspan="3">
        <table align="center" border="0" width="100%" cellspacing="3" cellpadding="0" style="line-height:20px;">
        <tbody>
        <tr>
          <td colspan="12" valign="top" align="center"> 
		  <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-border">
            <tbody>
                <tr style="border-bottom:#333333 1px solid; background:#ddd;">
                    <td width="10%" height="50px" align="center" class="txt"><strong>S.No.</strong></td>
                    <td width="29%"  height="50px" align="center" class="txt"><strong>Product Description</strong></td>
    				 <td width="10%"  height="50px" align="center" class="txt"><strong>HSN&nbsp;CODE</strong></td>
                    <td width="10%"  height="50px" align="center" class="txt"><strong>Qty</strong></td>
                    <td width="15%" height="50px"  align="center" class="txt"><strong>MRP</strong></td>
                    <td width="15%"  height="50px" align="center" class="txt"><strong>Discount</strong></td>
                    <td width="21%" height="50px"  align="center" class="txt"><strong>Taxable&nbsp;Amount</strong></td>
                    <?php
                    if($rows['deliver_state']=="Delhi")
                    {
                    ?>
                    <td width="21%" align="center" class="txt"><strong>SGST</strong></td>
                    <td width="21%" align="center" class="txt"><strong>CGST</strong></td>
                    <?php 
                    } 
                    else { ?>
                    <td width="21%" align="center" class="txt"><strong>IGST</strong></td>
                    <?php } ?>
                    <td width="21%" align="center" class="txt"><strong>Total&nbsp;Amount</strong></td>
                </tr>
                <?php
                $sql_basket = mysqli_query($conn,"select * from ".$sufix."basket where bid='".$rows['bid']."' and iscancel=0") or die(mysql_error());
                $option="View"; 
                $sr=1;
                $subtotal1=0;
                $submrp = ''; 
                while($row=mysqli_fetch_assoc($sql_basket))
                { 
                    $subtotal1 = $subtotal1 + floor($row['subtotal']*$_SESSION['conratio']);
                    $submrp = $submrp + floor($row['submrp']*$_SESSION['conratio']);  
                     
                    $pwith= $row['subtotal'];
                    $sqlpt=mysqli_fetch_assoc(mysqli_query($conn,"select gst,hsncode from ".$sufix."product where id='".$row['productid']."'"));
                    $tax=$sqlpt['gst'];
                    $pwithout=$pwith/(1+($tax/100));
                    $ptax=$pwith-$pwithout;
                    
                    $costprice = $row['costprice'];
                    $sellingprice = $row['sellingprice']; 
                    $quantity = $row['quantity']; 
                    $discount = $costprice - $sellingprice ;
                      
                    $coupan_discount1 = $row['coupan_discount']*$row['quantity'];
                    $subtotal =$row['subtotal'];
                    if($rows['deliver_state']=="Delhi")
                    {
                        $gsttax =$tax;
                        $pwithout=$subtotal/(1+($gsttax/100));
                        $gstvalues=$subtotal-$pwithout;
                    }
                    
                    else
                    {
                        $gsttax = $tax;
                        $pwithout=$subtotal/(1+($gsttax/100));
                        $gstvalues=$subtotal-$pwithout;
                    }
                    ?>

                    <tr style="border-bottom:#333333 1px solid; height:20px;">
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo $sr; ?> </td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo $row['productname']; ?><br>Size:<?php echo $row['size']; ?><br><?php if($rowuser['deliver_country']=="IND") { ?>GST:<?php echo $row['gst']; ?><?php } ?> </td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo $sqlpt['hsncode']; ?></td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo $row['quantity']; ?> </td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($costprice,2); ?> </td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($discount,2); ?> </td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($pwithout,2); ?> </td>
                        <?php
                        if($rows['deliver_state']=="Delhi")
                        {
                        $colss1="10"
                        ?>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($gstvalues/2,2); ?> </td>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($gstvalues/2,2); ?> </td>
                        <?php 
                        }  
                        else { 
                        $colss1="9"
                        ?>
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($gstvalues,2); ?> </td>
                        <?php } ?>     
                        <td align="center" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($subtotal,2); ?> </td>
                    </tr>
              
                    <?php  
                    $sr++;
                } $totalsaving = $submrp - $subtotal1; ?>
             
			  
                <tr>
                    <td  colspan="<?php echo $colss1; ?>">
                    <table  width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tbody> 
 
                            <?php if($totalsaving > 0) { ?>
                            <tr>
                            <td colspan="8" class="txt" align="right" height="5px">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td  class="txt" align="right" style="padding-right:20px"><strong>Total Saving : </strong><?php echo Currency; ?> &nbsp;<?php echo $totalsaving; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <tr>
                            <td colspan="8" class="txt" align="right" height="5px">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td  class="txt" align="right" style="padding-right:20px"><strong>Shipping : </strong><?php echo Currency; ?> &nbsp;<?php echo number_format($rows['shipcharge']); ?></td>
                            </tr>
                            
                            <?php if($rows['coupondiscount'] > 0) { ?>
                            <tr>
                            <td colspan="8" class="txt" align="right" height="5px">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td  class="txt" align="right" style="padding-right:20px"><strong>Coupon Discount : </strong><?php echo Currency; ?> &nbsp;<?php echo $rows['coupondiscount']; ?></td>
                            </tr>
                            <?php } ?>
                            
                           
                            <tr>
                                <td colspan="8" class="txt" align="right" height="5px">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td  class="txt" align="right" style="padding-right:20px"><strong>Wallet Used : </strong><?php echo Currency; ?> &nbsp;<?php echo $rows['walletused']; ?></td>
                            </tr>
                            <tr>
                            <td colspan="8" class="txt" align="right" height="5px">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td  class="txt" align="right" style="padding-right:20px"><strong>Total Payble Amount : </strong><?php echo Currency; ?> &nbsp;<?php echo $rows['totalcost'] - $rows['walletused']; ?></td>
                            </tr> 
                        </tbody> 
                    </table>  
                    </td>
                </tr>
                    </tbody></table></td>
                    </tr>
                    </tbody></table></td>
                    
                    </tr>
                    <?php
                    
                        $sqlcancelds=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$rows['bid']."' and iscancel='1'");
                        if(mysqli_num_rows($sqlcancelds) > 0)
                        {
                    ?>
                    <tr>
                        <td colspan="3" class="txt" height="10" align="left"> <table width="80%" border="1" cellspacing="0" cellpadding="0">
                        <tr> <td height="25" colspan="2">&nbsp;<b>Cancelled Product</b></td> </tr>
                        <tr><td><b>&nbsp;Productname</b></td><td><b>&nbsp;Cost</b></td></tr> 
                        <?php  	
                        while($rowcanes=mysqli_fetch_array($sqlcancelds))
                        {
                        ?>
                        <tr><td>&nbsp;<?php echo $rowcanes['productname']; ?></td><td><?php echo Currency; ?>&nbsp;<?php echo $rowcanes['sellingprice']*$rowcanes['quantity']; ?></td></tr>
                        <?php } ?>
                        </table>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td colspan="3" class="txt" height="10" align="center">Not for Resale
                    </td>
                    </tr>
                    <tr>
                    <td colspan="3" class="txt" height="20"><hr></td>
                    </tr>
                    <tr>
                    <td colspan="3" class="txt" style="text-align:justify;"><strong>Terms and Conditions :</strong><br>
                    1. Goods once sold are not returnable.<br>
                    3. This is an electronic generated invoice. Does not require Signature or Stamp.
                    </td>
                    </tr>
                    <tr>
                    <td colspan="3" class="txt" height="30"><hr></td>
                    </tr>
                    <tr>
                    <td colspan="3" class="txt"><strong>Registered Office:</strong><?php echo $rowse['paddress1']; ?><br>
                    <?php echo $rowse['pcity']; ?>, <?php echo $rowse['pstate']; ?>
                    <?php if($rowse['ppincode']>0) { ?>
                    -<?php echo $rowse['ppincode']; ?>
                    <?php } ?></td>
                    </tr>
</tbody></table>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
	function chk(){
var weight=document.getElementById('weight').value;
var lenght=document.getElementById('length').value;
var breath=document.getElementById('width').value;
var hight=document.getElementById('height').value;
$.ajax({
type:"POST",
url:"volume.php",
data:{
weight:weight,
lenght:lenght,
breath:breath,
hight:hight
},
cache:false,
success:function(html){
	$('#msg').html(html);
}
});
		return false;
	}
</script>
</body></html>





















 