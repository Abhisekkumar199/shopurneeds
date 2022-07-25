<?php
/* CREATED BY     : Pavan Kumar
CREATED ON        : 05-04-2013 
DESCRIPTION       : Order View Process	
ORGANIZATION NAME : EXi Solutions Pvt. Ltd.
*/
session_start();
include("includes/chklogin.php");
include("includes/configuration.php");
include "Barcode39.php";
include("includes/currency_display.php");
$oid=$_REQUEST['oid'];
if($_GET['oid']=="")
{
?>
<script language="javascript">
</script>
<?php } 
else
{
	
	$page=$_REQUEST['page'];
	mysqli_query($conn,"select * from `".$sufix."order` where oid='".$_REQUEST['oid']."'") ;
	$num=$db->numRows();
	$rows = mysqli_fetch_assoc();
if($num>0)
{	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
.style3 {
	color: #666666;
	font-size: xx-small;
}
.style4 {
	color: #999999
}
.style5 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<link rel="stylesheet" href="css/printstylesheet.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>System Generated</title>
<script language="Javascript1.2">
  <!--
  function printpage() {
 window.print();
}
  //-->
</script>
</head>
<!--"--><!--onLoad="printpage()"-->
<body  style="width:670px; height:380px;">
<table height="380" width="670">
  <tr>
    <td width="48%"  valign="top" class="heading"><table width="100%" height="58" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="48%" class="text4" align="left"  valign="top" colspan="3"><table width="100%" border="0" align="left" cellspacing="2" style="padding:10px;">
              <tr>
                <td width="60%" height="40" align="left" class="txt"><img src="https://localhost/project/shopurneeds/039_HOME%20PAGE-07_files/logo-00a19fb10a.png" style="max-width:200px;" border="0" /></td>
                <td width="40%" height="40" align="right" class="txt"><?php
					$bc = new Barcode39($_REQUEST['oid']); 
					$bc->barcode_text_size = 5; 
					$bc->barcode_bar_thick = 5; 
					$bc->barcode_bar_thin = 2; 
					$bc->draw("barcode/".$_REQUEST['oid'].".gif");
				?>
                  
                  <!--<img src="barcode/<?php echo $_REQUEST['oid']; ?>.gif" /><br />-->
                  
                  <?php //echo $_REQUEST['oid']; ?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="5" colspan="3"><hr size="1" color="#EAEAEA" /></td>
  </tr>
  <tr>
    <td colspan="3"><table align="center" border="0" width="100%" cellspacing="3" cellpadding="0"  style="line-height:20px;">
        <?php
			
			mysqli_query($conn,"select * from `".$sufix."order` where oid='".$_REQUEST['oid']."'");
			$rows=mysqli_fetch_assoc();
			$option="View";
			?>
        <tr>
          <td width="50%" align="right" valign="top" colspan="2"><table width="99%" align="right">
              <tr>
                <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <?php
												mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$rows['emailid']."'") ;																	
												?>
                    <?php if($rowuser = mysqli_fetch_assoc())
														{
														?>
                    <tr>
                      <td width=35% valign="top"><strong>Invoice for</strong></td>
                      <td width=33% valign="top"><strong>Billing Address:</strong></td>
                      <td width=32% valign="top"><strong>Delivery Address:</strong></td>
                    </tr>
                    <tr>
                      <td width=35% class="txt" valign="top"> Your Order <?php echo $rows['orderdate']; ?><br />
                        Order ID <?php echo $rows['oid']; ?><br />
                        
                        <!--Invoice Number <?php //$basket->invoice($sufix); ?>--></td>
                      <td width=33% class="txt" valign="top"><?php echo $rowuser['fname']; ?>&nbsp;<?php echo $rowuser['lname']; ?><br />
                        <?php echo $rowuser['billing_address']; ?>, <?php echo $rowuser['billing_city']; ?>-<?php echo $rowuser['billing_zip']; ?> <?php echo $rowuser['billing_country']; ?><br />
                        Contact No: <?php echo $rowuser['billing_phone']; ?>, <?php echo $rowuser['billing_mobile']; ?><br /></td>
                      <td width=32% class="txt" valign="top"><?php echo $rowuser['dfname']; ?>&nbsp;<?php echo $rowuser['dlname']; ?><br />
                        <?php echo $rowuser['deliver_address']; ?>, <?php echo $rowuser['deliver_city']; ?>-<?php echo $rowuser['deliver_zip']; ?> <?php echo $rowuser['deliver_country']; ?><br />
                        Contact No: <?php echo $rowuser['deliver_phone']; ?>, <?php echo $rowuser['deliver_mobile']; ?></td>
                    </tr>
                    <?php } ?>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><hr size="1" color="#2C2C2C"></td>
        </tr>
        <tr>
          <td colspan="12" valign="top"  align="center"><table width="100%" cellpadding="0" cellspacing="2" border="0" class="table-border">
              <tr style="border-bottom:#333333 1px solid;">
                <td width="43%" align="left" class="txt"><strong>Product</strong></td>
                <td width="11%" align="left" class="txt"><strong>Qty</strong></td>
                <td width="28%" align="left" class="txt"><strong>Unit Price </strong></td>
                <td width="18%" align="left" class="txt"><strong>Total Price </strong></td>
              </tr>
              <?php
												mysqli_query($conn,"select * from ".$sufix."basket where bid='".$rows['bid']."'") ;
												$option="View";
								$count=1;
												$total=0;
												$subtotal=0;
												while($row=mysqli_fetch_assoc())
												{
													 if($row['variantname']!='')
													   {
															$variantvalue2=explode("~",$row['variantvalue']);					
															$variantcolor=$variantvalue2[0];
															$variantsize=$variantvalue2[1];	
													   }
													     elseif($row['variantvalue']!='')
													   {
															$variantsize=$row['variantvalue'];	
													   }
													   else
													   {
															$variantcolor="";
															$variantsize="";
													   }
													   $pwieght=$pwieght + $row['totalweight'];
													   $totalweight=$totalweight + $row['totalweight'];
											//$roworder=mysqli_fetch_array(mysqli_query($conn,"select * from order_basket where obid='".$row['id']."'"));
										?>
              <tr style="border-bottom:#333333 1px solid; height:20px;">
                <td align="left" valign="top" bgcolor="#FFFFFF" class="txt" width="43%"><?php echo $row['productname']; ?>
                  <?php if($variantsize!='') 
						{ ?>
                  <br />
                  Size: <?php echo $variantsize; ?>
                  <?php }   ?></td>
                <td align="left" valign="top" bgcolor="#FFFFFF" class="txt" width="11%"><?php echo $row['quantity']; ?></td>
                <td align="left" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency; ?>&nbsp;<?php echo $row['sellingprice']; ?><br /></td>
                <td align="left" valign="top" bgcolor="#FFFFFF" class="txt" width="18%"><?php echo Currency; ?>&nbsp;<?php echo $row['subtotal']; ?>
                  <?php $totalcost=$totalcost + $row['subtotal']; ?></td>
              </tr>
              <tr>
                <td height="1" colspan="4"><hr size="1" color="#2C2C2C" /></td>
              </tr>
              <?php 
							  $count++; //
							  } ?>
              <tr>
                <td height="1" colspan="3" class="txt" align="right"><strong>SubTotal:</strong></td>
                <td height="1" align="right" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format($totalcost,2); ?></td>
              </tr>
              <tr>
                <td height="1" colspan="3" class="txt" align="right"><strong>Shipping:</strong></td>
                <td height="1" align="right" class="txt"><?php echo Currency; ?>&nbsp;
                  <?php $shipcharge=$basket->shipcharge($sufix,$pwieght,$rowuser['deliver_city']); ?>
                  <?php echo number_format($shipcharge,2); ?></td>
              </tr>
              <tr>
                <td height="1" colspan="3" class="txt" align="right"><strong>Total:</strong></td>
                <td height="1" align="right" class="txt"><?php echo Currency; ?>&nbsp;<?php echo number_format(($totalcost + $shipcharge),2); ?></td>
              </tr>
              <tr>
                <td height="1" colspan="3" class="txt" align="right"><strong>Order Notes:</strong></td>
                <td height="1" class="txt" align="left">None</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="3" class="txt"><b>*For return or exchange, Please contact our Customer Support!</b></td>
  </tr>
</table>
</body>
</html>
<?php } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor='White'>
    <td colspan='5' class='error-message'><div align='center'>NO RECORD FOUNDS HERE!!!</div></td>
  </tr>
</table>
<?php } 
}
?>