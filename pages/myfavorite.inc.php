<link href="<?php echo $url; ?>/css/styledashboard.css" rel="stylesheet">
<script language="javascript"> 
function showonlyonev2(thechosenone) {
  var newboxes = document.getElementsByTagName("div");
  for(var x=0; x<newboxes.length; x++) {
		name = newboxes[x].getAttribute("name");
		if (name == 'newboxes-2') {
			  if (newboxes[x].id == thechosenone) {
					if (newboxes[x].style.display == 'block') {
						  newboxes[x].style.display = 'none';
					}
					else {
						  newboxes[x].style.display = 'block';
					}
			  }else {
					newboxes[x].style.display = 'none';
			  }
		}
  }
}
function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);
} //
</script>
<script language="JavaScript">
function checkall(objForm){
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
}
function ena(enable2)
{
	document.wsh.action='<?php echo URL; ?>/checkout/whishlist';
	document.wsh.submit(); //
}
</script>
<div class="da_body"  style="width:100%; padding:10px;" >
  <?php 
 if($_REQUEST['proid']!='' && $_REQUEST['id']!='' && $_REQUEST['uid']) {
 $del = mysqli_query($conn,"delete from ".$sufix."favorite_product where product_id='".$_REQUEST['proid']."' and user_id='".$_REQUEST['uid']."' and id='".$_REQUEST['id']."'");
 ?>

 <script type="text/javascript">
<!--
window.location = "https://localhost/project/shopurneeds/myfavorite"
//-->
</script>
 <?php
 }


$sql=mysqli_query($conn,"select * from `".$sufix."user_registration` where emailid='".$_SESSION['emailid']."'") or die(mysql_error());
if($rows = mysqli_fetch_assoc($sql))
{
 ?>
  <div class="da_dashboard"> 
    <!--left dashboard sidebar starts here-->
    <?php include("includes/left_account.php"); ?>
    <!--right dashboard starts here-->
    <div class="da_right_board fleft">
      <h1><i class="fa fa-heart" aria-hidden="true"></i> My Favorite Product
        <p class="pull-right">Welcome :
          <?php if($_SESSION['fnamenew']!='') { echo $_SESSION['fnamenew']; } else { echo "GUEST"; } ?>
        </p>
      </h1>
      <!--Fav Stores Starts here-->
      <div class="da_dashboard_cont table-responsive"> 
        <!--more info starts here-->
        <fieldset class="">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table body-txt">
                                          <tr>
                                            <td colspan="12" valign="top"  align="center"><form name="wsh" method="post" action="#">
                                                <table width="100%" cellpadding="1" cellspacing="0" border="0" class="table-border table">
                                                  <tr bgcolor="#ffffff">
                                                    <td width="16%" align="left" class="pad_1 border_left border_right border_top border_bottom">Product Image</td>
                                                    <td width="32%" align="left" class="pad_1 border_right border_top border_bottom">Product Name</td>
                                                    <td width="6%" align="left" class="pad_1 border_right border_top border_bottom">Qty</td>
                                                    <td width="12%" align="left" class="pad_1 border_right border_top border_bottom">Unit price</td>
                                                    <td width="13%" align="left" class="pad_1 border_right border_top border_bottom">Total Price</td>
                                                    <td width="12%" align="left" class="pad_1 border_right border_top border_bottom">Buy</td>
                                                    <td width="9%" align="center" class="pad_1 border_right border_top border_bottom">Delete</td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="7"><hr style="margin:0"></td>
                                                  </tr>
                                                  <?php	
															$sql2=mysqli_query($conn,"select * from `".$sufix."favorite_product` where user_id='".$_SESSION['useridse']."' order by id desc") or die(mysql_error());	
															$numw=mysqli_num_rows($sql2);	
														if($numw > 0)
															{
															$totalcost=0;
															while($row1=mysqli_fetch_array($sql2))
															{	
															$fprosql = mysqli_query($conn,"select * from ".$sufix."product where id =  '".$row1['product_id']."' and displayflag='1'") or die(mysql_error());
$row = mysqli_fetch_assoc($fprosql);
$row['sellingprice'] = $row['sellingprice'];

//print_r($fprorows['id']);
																	$pwieght=$pwieght + $row['totalweight'];
																    $totalweight=$totalweight + $row['totalweight'];
																    $totalcost=$totalcost + $row['subtotal'];
if(mysqli_num_rows($fprosql)>0) { 
													?>
                                                  <tr>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="txt border_left border_right  border_bottom"><?php 
$sql4="select * from ".$sufix."imageupload where displayflag='1' and pid='".$row['id']."' order by mainimage desc Limit 1";
				 $sqlimage=mysqli_query($conn,$sql4); 
 							$countimage=1;
 							while($rowimage=mysqli_fetch_assoc($sqlimage))
							{
													if($rowimage['productimage']!='')															{
														echo '<img src="'.URL.'/uploads/productimage/thumb/'.$rowimage['productimage'].'" height="80"/>';
														} else {
															echo '<img src="'.URL.'/productimage/noproductimage.png"  height="80" />';
														}
}
$row['qty']=1;
														?></td>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="txt pad_1 border_right  border_bottom" ><a href="<?php echo URL;?>/<?php echo $row['slug'];?>"><?php echo $row['productname']; ?></a><br>
                                                      <?php if($row['sku']!='') { ?>
                                                      <p>Sku:<a href="<?php echo URL;?>/<?php echo $row['slug'];?>"><?php echo $row['sku'];?></a></p>
                                                      <?php }?>
                                                      <p>Seller:
                                                        <?php
							 $sellername = mysqli_query($conn,"select * from ".$sufix."suppliers where id='".$row['seller_id']."'"); 
							 $selllernamerows = mysqli_fetch_assoc($sellername);
							 //print_r($selllernamerows['suppliername']);
							 ?>
                                                        <a href="<?php echo URL;?>/<?php echo $selllernamerows['seller_slug'];?>">
                                                        <?php
							   echo $selllernamerows['suppliername'];?>
                                                        </a></p></td>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" ><?php echo $row['qty']; ?></td>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom"><?php echo Currency; ?><?php echo number_format($row['sellingprice']); ?></td>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom"><?php echo Currency; ?><?php echo number_format($row['sellingprice']*$row['qty']); ?></td>
                                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom"><a href="<?php echo URL;?>/<?php echo $row['slug'];?>">Buy Now</a></td>
                                                    <td align="center" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom"><a href="myfavorite?proid=<?php echo $row1['product_id'];?>&uid=<?php echo $row1['user_id'];?>&id=<?php echo $row1['id'];?>" onclick="return confirm('Are you sure delete fav product?')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                    <?php $grandtotal = $grandtotal+$row['sellingprice']*$row['qty'];?>
                                                  </tr>
                                                  <tr>
                                                    <td colspan="7"><hr  /></td>
                                                  </tr>
                                                  <?php
}
														  	} 
														?>
                                                  <!--<tr>
                                                  <td class="txt pad_1 border_left border_right  border_bottom" align="right" colspan="4" >Total Price: &nbsp;&nbsp;</td>
                                                  <td class="pad_1 txt border_right  border_bottom" align="left"><font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold; text-align:left;"><?php echo Currency; ?>&nbsp;</font><?php echo number_format($grandtotal); ?> </td>
                                                </tr>-->
                                                  <tr> </tr>
                                                  <?php } else { ?>
                                                  <tr>
                                                    <td colspan="6" class="alert" align="center"><p style="font-size:22px; color:green;">No records in whishlist.</p></td>
                                                  </tr>
                                                  <?php } ?>
                                                </table>
                                              </form></td>
                                          </tr>
                                        </table>
                       
        </fieldset>
        <!--more info ends here--> 
      </div>
      <!--Fav Stores ends here--> 
    </div>
    <!--right dashboard ends here-->
    <div class="clear"></div>
  </div>
  <?php } ?>
</div>
<style>
@media (max-width: 640px) {
    .table{    width: 800px;}
	.da_dashboard{ width:100%; padding:0; margin-top:10px;}
	.da_left_dash {
    border-right: 0 none;
    padding-right: 0;
    width: 100%;
}
.da_left_dash ul li a{ text-align:center;}
.da_right_board {
    padding: 0 15px;
    width: 100%;
}
.da_dashboard_cont {
    float: left;
    width: 100%;
}	
	.da_right_board h1 p {
    float: left;
    margin-top: 20px;
    width: 100%;
}
.da_more_info_container .da_onehalf.fleft {
    float: left;
    width: 100%;
}
table td {
    border: 0 none !important;
}
.table-responsive{ border:0 !important}
	}
	table td {
    border: 0 none !important;
}
</style>
