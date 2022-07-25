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
<div class="da_body"  style="width:100%; padding:10px;" >
  <div class="da_dashboard"> 
    <!--left dashboard sidebar starts here-->
    <?php include("includes/left_account.php"); ?>
    <!--left dashboard sidebar ends here--> 
    <!--right dashboard starts here-->
    <div class="da_right_board fleft">
      <h1><img src="images/fav-showroom.png"> My Orders
        <p class="pull-right"> 
           
        </p>
      </h1>
      <?php echo session_msg(); ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border_left border_right border_top border_bottom order_listing">
        <tr>
          <td height="10"></td>
        </tr>
        <?php
			 		include_once('includes/classes/paging.inc.php');
					include("admin/pagingconfig.php");
					$sql2="select * from `".$sufix."order`  where oid in (SELECT oid FROM `".$sufix."order_seller` where emailid='".$_SESSION['emailid']."' and approve_status!='Order Pending' ) order by oid desc";
					$sql=mysqli_query($conn,$sql2);
					$numorder=mysqli_num_rows($sql);
					if($numorder > 0)
					{
					$no_page = max(1,ceil($numorder/$offset));
				    $pager=$pager->getPagerData($no_page, $display_range, $page, $offset);	 
					$result=mysqli_query($conn,$sql2." LIMIT 0,15");	
					while($rows = mysqli_fetch_assoc($result))
					{   
					    $sql_order = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(quantity2) as totalitems FROM `".$sufix."order_seller` where oid='".$rows['oid']."'"));
			 ?>
        <tr>
          <td align="center" style="border-bottom:#999999 dotted 1px;"><table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="50%" class="left_order " height="100" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="42%" height="30" class="product-txt3">Order ID</td>
                            <td width="2%" class="product-txt3"><strong>:</strong></td>
                            <td width="56%" class="product-txt2"><?php echo $rows['oid'];?></td>
                          </tr>
                          <tr>
                            <td height="20"  width="42%" class="product-txt3">Placed On</td>
                            <td width="2%" class="product-txt3"><strong>:</strong></td>
                            <td width="56%" class="product-txt2"><?php echo $rows['orderdate'];?></td>
                          </tr>
                          <tr>
                            <td height="20" width="42%" class="product-txt3">Order Type</td>
                            <td width="2%" class="product-txt3"><strong>:</strong></td>
                            <td width="56%" class="product-txt2"><?php echo $rows['paytype'];?></td>
                          </tr>
                          <tr>
                            <td width="42%" height="20" class="product-txt3">No. of Items</td>
                            <td width="2%" class="product-txt3"><strong>:</strong></td>
                            <td width="56%" class="product-txt2"><?php echo $sql_order['totalitems'];?></td>
                          </tr>
                          
                        </table></td>
                      <td width="40%" class="right_order" height="100" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <!--<tr>
                                  <td height="20" class="product-txt3">Shipping Method</td>
                                  <td class="product-txt3"><strong>:</strong></td>
                                  <td class="product-txt2"><?php echo $rows['shippingmethod'];?></td>
                                </tr>-->
                            <tr>
                            <td width="42%" height="20" class="product-txt3">Order Amount</td>
                            <td width="2%"  class="product-txt3"><strong>:</strong></td>
                            <td  width="56%" class="product-txt2"><?php echo Currency; ?>&nbsp;<?php echo $rows['totalcost'];?></td>
                          </tr>
                          <tr>
                            <td width="42%"  height="20" class="product-txt3">Wallet Used</td>
                            <td width="2%"  class="product-txt3"><strong>:</strong></td>
                            <td  width="56%" class="product-txt2"><?php echo Currency; ?>&nbsp;<?php echo $rows['walletused'];?></td>
                          </tr>
                          <tr>
                            <td  width="42%" height="20" class="product-txt3">Payble Amount</td>
                            <td width="2%"  class="product-txt3"><strong>:</strong></td>
                            <td  width="56%" class="product-txt2"><?php echo Currency; ?>&nbsp;<?php echo $rows['totalcost'] - $rows['walletused'];?></td>
                          </tr>
                          <tr>
                            <td  width="42%" height="20" class="product-txt3">Order Status</td>
                            <td width="2%"  class="product-txt3"><strong>:</strong></td>
                            <td   width="56%" class="product-txt2"><?php echo $rows['approve_status'];?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="40" align="right" valign="middle" class="link">
                          <?php if($rows['invoiceno']!="") { ?>
                        <button type="button" title="Proceed to Checkout" class="btn btn-primary " onClick="PopupCenter('<?php echo URL; ?>/order_invoice.php?oid=<?php echo $rows['oid']; ?>&bid=<?php echo $rows['bid']; ?>','myPop1',700,600); "><span>Print</span></button>
                        <?php } ?>
                        <button onclick="location.href='orderdetails.php?oid=<?php echo $rows['oid'];?>';" type="button" title="Proceed to Checkout" class="btn btn-primary "><span>Order Details</span></button>
                        <?php if($rows['approve_status'] == 'Order Placed' or $rows['approve_status'] == 'Order Approved' ) { ?>
                        <button class="btn btn-primary cancelorder "   href="javascript:void(0);" data-toggle="modal" data-target="#myModalt123" orderids="<?php echo $rows['oid'];?>" checkstatus="cancelorder">Cancel Order</button>
                        <?php } ?>
                        </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td colspan="2"><div name="newboxes-2" id="newboxes<?php echo $rows['oid']; ?>-2" style="border: 0px solid black; display:none;padding: 5px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="rightareaheading" bgcolor="#e3e3e3" colspan="12" align="left" valign="middle" height="30" style="border-left:#999999 solid 1px; border-right:#999999 solid 1px; border-top:#999999 solid 1px;"><strong><font color="#303030" style="padding-left:5px;">Order Item</font></strong></td>
                      </tr>
                      <tr>
                        <td colspan="12" valign="top"  align="center" ><table width="100%" cellpadding="1" cellspacing="0" border="0" class="table-border">
                            <tr bgcolor="#ffffff">
                              <td align="left" class="pad_1 border_left border_right border_top border_bottom product-txt3"><strong>Product Image</strong></td>
                              <td align="left" class="pad_1 border_right border_top border_bottom product-txt3"><strong>Product Name</strong></td>
                              <td align="right" class="pad_1 border_right border_top border_bottom product-txt3"><strong>Qty</strong></td>
                              <td align="right" class="pad_1 border_right border_top border_bottom product-txt3"><strong>Unit Price</strong></td>
                              <!--<td width="10%" align="right" class="pad_1 border_right border_top border_bottom product-txt3"><strong>Vat 1111 <br />
													    (In %)</strong></td>
														<td width="10%" align="right" class="pad_1 border_right border_top border_bottom product-txt3"><strong>Unit Price  1111<br />
														(Exclusive Vat)</strong></td>-->
                              <td align="right" class="pad_1 border_right border_top border_bottom product-txt3"><strong>Total Price</strong></td>
                            </tr>
                            <?php	  
                            $sql2=mysqli_query($conn,"select * from `".$sufix."basket` where bid='".$rows['bid']."'");		
                            $totalval=0;
                            $totalcost=0;
                            while($row=mysqli_fetch_array($sql2))
                            {
                            print_r($row);	
                            $pwieght=$pwieght + $row['totalweight'];
                            $totalweight=$totalweight + $row['totalweight'];
                            $totalcost=$totalcost + $row['subtotal'];
                            ?>
                            <tr>
                                <td align="center" valign="top" bgcolor="#FFFFFF" class="txt border_left border_right  border_bottom" style="width: 16%;" ><?php 
                                if($row['productimage'])
                                {
                                echo '<img src="'.URL.'/uploads/productimage/thumb/'.$row['productimage'].'" width="80" />';
                                } else {
                                echo '<img src="'.URL.'/uploads/productimage/default.jpg" width="80" height="80"  />';
                                }
                                ?>
                                </td>
                              <td align="left" valign="top" bgcolor="#FFFFFF" class="txt pad_1 border_right  border_bottom"  ><p style="margin-top:20px;"><a href="<?php echo URL;?>/<?php echo $row['slug'];?>"><?php echo $row['productname']; ?></a></p>
                                <?php if($row['sku']!='') { ?>
                                <p>Sku:<a href="<?php echo URL;?>/<?php echo $row['slug'];?>"><?php echo $row['sku'];?></a></p>
                                <?php }?>
                                <p>Seller:
                                <?php
                                $sellername = mysqli_query($conn,"select * from ".$sufix."suppliers where id='".$row['seller_id']."'"); 
                                $selllernamerows = mysqli_fetch_assoc($sellername); 
                                ?>
                                <a href="<?php echo URL;?>/<?php echo $selllernamerows['suppliername'];?>">
                                <?php
                                echo $selllernamerows['suppliername'];?>
                                </a></p></td>
                                <td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" ><p style="margin-top:20px;"><?php echo $row['quantity']; ?></p></td>
                                <td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" ><p style="margin-top:20px;"><?php echo Currency; ?><?php echo $row['sellingprice']; ?></p></td>
                                <!--<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="10%"><?php echo $row['vat']; ?></td>
                                <td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="10%"><?php echo $row['sellpricevat']; ?></td>-->
                                <?php
                                $productid = $row['productid'];
                                $productbid = $row['bid'];
                                $sellerid = $row['seller_id'];
                                ?>
                              <td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom"><font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold;">
                                <p style="margin-top:20px;"><?php echo Currency; ?></font>&nbsp;<?php echo $row['subtotal']; ?></p></td>
                              <!--<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="10%">
<form action="<?php echo URL;?>/ajax_reason.php" name="form1" class="reasonform" id="reasonform" method="post">
<input type="hidden" name="product_id" value="<?php echo $productid;?>" />
<input type="hidden" name="product_bid" value="<?php echo $productbid;?>" />
<input type="hidden" name="seller_id" value="<?php echo $sellerid;?>" />
<input type="hidden" name="user_id" value="<?php echo $_SESSION['useridse'];?>" />
<input type="hidden" name="status" value="Return" />
<input type="hidden" name="type" value="product" />
<select name="reason" class="f" required>
<option value="">--Select--</option>
<option value="The customer ordered incorrect product or size">The customer ordered incorrect product or size </option>
<option value="The customer decided the product was not needed or wanted">The customer decided the product was not needed or wanted</option>
<option value="No reason for return given">No reason for return given</option>
<option value="The product did not match the description on the Website or in the catalog">The product did not match the description on the Website or in the catalog</option>
<option value="The product did not fit the customer’s expectations">The product did not fit the customer&#44;s expectations</option>
<option value="The company shipped the incorrect product or size">The company shipped the incorrect product or size</option></select>
<input type="submit" value="submit" class="form-control" id="submit_form"  />
</form></td>--> 
                            </tr>
                            <?php
														  } // 
														?>
                            <tr>
                              <td class="txt pad_1 border_left border_right  border_bottom" align="right" colspan="4" ><strong>Total Price: </strong></td>
                              <td class="pad_1 txt border_right  border_bottom" align="right"><font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold; text-align:left;"><?php echo Currency; ?>&nbsp;</font><?php echo number_format($totalcost,2); ?></td>
                            </tr>
                            <tr>
                              <td  class="txt pad_1 border_left border_right border_bottom" align="right" colspan="4"><strong>Shipping Charges: </strong></td>
                              <td class="txt pad_1 border_right  border_bottom" align="right"><?php $shipcharge=$shipcharge1; ?>
                                <font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold; text-align:left;"><?php echo Currency; ?></font>&nbsp;<?php echo $rows['shipcharge'];?></td>
                            </tr>
                            <tr>
                              <td  class="txt pad_1 border_left border_right border_bottom" align="right" colspan="4"><strong>Grand Total: </strong></td>
                              <td class="txt pad_1 border_right border_bottom" align="right"><?php $gtotal=($totalcost + $shipcharge); ?>
                                <font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold; text-align:left;"><?php echo Currency; ?></font>&nbsp;<?php echo number_format($gtotal,2); ?></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
            </table></td>
        </tr>
					<?php } } ?>
        <tr>
          <td><?php pagingall($offset,$numorder,'myorders.php',$page,$no_page,$display_range); ?></td>
        </tr>
      </table>
      <div> </div>
    </div>
    <!--right dashboard ends here-->
    <div class="clear"></div>
  </div>
</div>


<div class="modal fade" id="myModalt123" role="dialog" style="margin-top:5%;">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order Status</h4>
      </div>
      <div class="modal-body"> <span class="trackingdetailresponse" style="color:#006600;"></span>
        <form action="" method="post">
          <p> 
            <script>
		  $(document).ready(function(){
		  	$('.return_item_but').click(function(){
				var orderids = $(this).attr('orderids');
				var checkstatus = $(this).attr('checkstatus');
				//alert(orderids+"===="+orderstatus);
				$.post("ajax_order_status.php", {orderids: orderids, checkstatus : checkstatus},function(data){
				$('.commission_results').html(data);
				});
			});
		  });
		  </script> 
            <span class="commission_results"></span> </p>
          <!--<input type="text" name="orderid" id="orderid" class="orderid" value="<?php echo $row['oid']; ?>" />-->
          
          <div class="control-group"> 
            <!-- Username -->
            
            <select name="reason_status" id="reason_status" class="form-control reason_status" required >
              <option value="">Select</option>
              <option value="Not Required">Not Required</option>
            </select>
          </div>
          <p></p>
          <div class="control-group"> 
            <!-- Username -->
            
            <input type="button" id="ordertrackingbutton1" name="submit" value="Submit" class="btn btn-success ordertrackingbutton">
          </div>
        </form>
      </div>
      <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>--> 
    </div>
  </div>
</div>
<input type="hidden" class="orderid" value="" />
<input type="hidden" class="checkstatus" value="" />
<script>
		$(document).ready(function(){
			$("#ordertrackingbutton1").click(function(){ 
			    var orderid = $(".orderid").val(); 
			    var reason_status = $(".reason_status").val();
			    var checkstatus = $(".checkstatus").val();   
				$.ajax({
					type: 'POST',
					url: '<?php echo URL;?>/ajax/ajax_cancel.php',
					data: {reason_status : reason_status, orderid : orderid, checkstatus : checkstatus},
					success: function( response ) {
					  $(".trackingdetailresponse").html(response);
					}
				  });
			});
			$(".cancelorder").click(function(){
			    var orderid = $(this).attr('orderids'); 
			     $(".orderid").val(orderid); 
			     $(".checkstatus").val('cancelorder'); 
			});
		});
		</script> 
<script>
   $(function () { $('#myModalt123').on('hide.bs.modal', function () {
	  window.parent.location.reload();
	  });
   });
</script>

<style>
@media (max-width: 640px) {
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
.fix_height_tab{ height:auto !important; overflow:hidden !important}
.fix_height_tab .det{ margin:5px 0 !important;}
.fix_height_tab .btn.btn-success.det{ width:100%;}
.fix_height_tab .fav_items_dash > li {
    float: left;
    text-align: center;
    width: 100%;
}
.fix_height_tab ul.fav_items_dash img{ float:none !important}
.left_order, .right_order{ float: left;
    height: auto;
    margin-bottom: 10px;
    margin-top: 10px;
    width: 100%;}
	.link {
    padding-bottom: 10px;
}

.link button:first-child{ float:left;}
.link button:last-child{ float:right;}
	}

</style>
