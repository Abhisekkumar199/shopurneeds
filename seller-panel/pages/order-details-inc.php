<?php
$oid = $_REQUEST['id']; 
$sql_order=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."order where oid='".$oid."'")); 
$sql_slot = mysqli_fetch_assoc(mysqli_query($conn,"select delivery_slot from ".$sufix."shipping_slot where id='".$sql_order['delivery_slot']."'")); 
$sql_customer=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$sql_order['emailid']."'")); 

$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$sql_order['address_id']."'");
$rowaddress = mysqli_fetch_array($sqladdress);

?>
<script>
function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);
}
</script> 
 
    
        <!-- ############ Content START-->
        <div id="content" class="flex">
            <!-- ############ Main START-->
            <div>
                <div class="page-hero page-container" id="page-hero">
                    <div class="padding d-flex">
                        <div class="page-title">
                            <h2 class="text-md text-highlight">ORDER ID : <?php echo $sql_order['oid'] ?></h2><small class="text-muted"></small></div>
                        <div class="flex"></div>
                        <div><a href="#" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"></span> <i data-feather="arrow-right"></i></a></div>
                    </div>
                </div>
                
              
                
                
                
                <div class="page-content page-container" id="page-content">
                    <div class="padding sr">
                    <div class="card">
                      
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class=" col-form-label">Order Summary</label>
                                    <p>
                                    Order Date: <?php echo $sql_order['orderdate']; ?><br>
                                    Order Id: <?php echo $sql_order['oid']; ?> <br> 
                                    Items Qty: <?php echo $sql_order['quantity2']; ?> <br> 
                                    Shipping: <?php echo $sql_order['shipcharge']; ?><br>
                                    Payment: <?php echo $sql_order['paytype']; ?> </p> 
                                    <button class="btn btn-raised btn-wave mb-2 w-xm cyan text-white" onclick="PopupCenter('invoice_labelnew.php?id=<?php echo $sql_order['oid'];?>','myPop1',700,600); "> Print Invoice</button> 
                                </div>
                                
                                 
                                <div class="col-sm-3">
                                    <label class=" col-form-label">User  Details:</label>
                                    <p><?php echo $sql_customer['fname']." ".$sql_customer['lname']; ?> <br> E: <?php echo $sql_customer['emailid']; ?><br>M:+91 <?php echo $rowaddress['mobileno']; ?></p> 
                                    
                                </div>
                                <div class="col-sm-3">
                                    <label class=" col-form-label">Shipping Address:</label>
                                    <p><?php echo $rowaddress['address'];?><br>
                                        <?php echo $rowaddress['city'];?><br>
                                        Pin Code - <?php echo $rowaddress['zipcode'];?> </p> 
                                </div>
                                <div class="col-sm-3">
                                    <!--<label class=" col-form-label">Change Seller</label> 
                                    <div class="input-group mb-3"><input type="text" class="form-control" placeholder="Change Seller" aria-label="Change Seller" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-raised btn-wave mb-2 w-xs cyan text-white">Change</button></div></div>
                                    <br> -->
                                    <label class=" col-form-label">Delivery Date & Slot : <br> <font color="#00bcd4;"><?php echo $sql_order['delivery_date']; ?> | <?php echo $sql_slot['delivery_slot']; ?></font></label>
                                    <br>
                                    <label class=" col-form-label">Current Status : <font color="#00bcd4;"><?php echo $sql_order['approve_status']; ?></font></label>
                                    <br> 
                                    <?php if($sql_order['approve_status'] == 'Cancelled') { } else { ?>
                                    <label class=" col-form-label">Update Status</label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="status" >
                                            <option value="Order Placed"  >Placed Order</option>
                                            <option value="Order Approved" <?php if($sql_order['approve_status'] == "Order Placed") { echo "selected"; } ?> <?php if($sql_order['approve_status'] == "Order Placed") {  } else {} ?> >Approve Order</option>
                                            <option value="Order Packed" <?php if($sql_order['approve_status'] == "Order Approved") { echo "selected"; } ?> <?php if($sql_order['approve_status'] == "Order Placed") {  } else {} ?> >Pack Order</option>
                                            <option value="Order Shipped" <?php if($sql_order['approve_status'] == "Order Packed") { echo "selected"; } ?>   >Ship Order</option>
                                            <option value="Delivered" <?php if($sql_order['approve_status'] == "Order Shipped") { echo "selected"; } ?> <?php if($sql_order['approve_status'] == "Order Placed" or $sql_order['approve_status'] == "Order Approved"    ) { echo "disabled"; } ?>> Deliver Order</option>
                                            <?php if($sql_order['approve_status'] == 'Order Placed' or $sql_order['approve_status'] == 'Order Approved') { ?>
                                            <option value="Cancelled"  >Cancel Order</option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-raised btn-wave mb-2 w-xs cyan text-white" onclick="updatestatus(<?php echo $oid; ?>);">Update</button>
                                        </div> 
                                        <div class="clearfix"></div>
                                        <span class="statusmessage"></span>
                                    </div>
                                    <?php } ?>
                                </div> 
                                 
                            </div>              
                        </div> 
                    </div> 
                    </div>
                </div> 
            </div>
            <!-- ############ Main END-->
        </div>
        <!-- ############ Content END-->
        <div class="page-content page-container" style="margin-bottom:50px;" id="page-content">
            <div class="padding">
                <div class="row"> 
                <div class="rt-20">
                <div class="tl-item active">
                    <div class="tl-dot b-warning"></div>
                    <div class="tl-content"> 
                        <div style="background: #ffff;width: 950px;">
                            <div> 
                                <div class="table-responsive">
                                    <form name="orderpage1" id="orderpage1" action="order-update-process.php" method="POST">
                                    <table class="table table-theme table-row v-middle gaj">
                                        <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                            <tr> 
                                                <th class="text-muted">ORDER</th>
                                                <th class="text-muted sortable" data-toggle-class="asc">PRODUCT</th>
                                                <th class="text-muted sortable" data-toggle-class="asc">PRODUCT DETAILS</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">WEIGHT</span></th> 
                                                <th class="text-muted sortable" data-toggle-class="asc">QUANTITY</th>
                                                <th class="text-muted  " data-toggle-class="asc">STATUS</th>
                                                <th class="text-muted sortable">AMOUNT </th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_order_seller=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$sql_order['bid']."' and iscancel = 0");
                                            $grand_total = 0;
                                            $submrp = '';
                                            $subtotal = 0;
                                            while($sql_basket =mysqli_fetch_assoc($sql_order_seller))
                                            {
                                                $subtotal = $subtotal + floor($sql_basket['subtotal']*$_SESSION['conratio']);
                                                $submrp = $submrp + floor($sql_basket['submrp']*$_SESSION['conratio']); 
                                                $grand_total = $grand_total + $sql_basket['subtotal']; 
                                                
                                            ?>
                                            <tr class="v-middle" data-id="15"> 
                                                <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $sql_basket['oid_seller']; ?></span></td>
                                                <td class="flex"><a href="#" class="item-title text-color">  
                                                  </a><a href="#" class="" data-toggle="tooltip" title="" data-original-title="Product Name">
                                                    <?php  
                                                    $product_id = $sql_basket['productid']; 
                                                    if($sql_basket['productimage'] != '')
                                                    {
                                                    ?> 
                                                        <a href="#" class="" data-toggle="tooltip" title="Product Name"><img src="<?php echo URL;?>/uploads/productimage/thumb/<?php echo $sql_basket['productimage']; ?>" height="80px"alt="."></a>
                                                     <?php } else { ?>
                                                        <a href="#" class="" data-toggle="tooltip" title="Product Name"><img src="assets/img/a6.jpg" height="80px"alt="."></a>
                                                    <?php } ?>
                                                  </a>
                                                </td> 
                                                <?php
                                                    $sql_product=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where id='".$product_id."'"));
                                                ?>
                                               <td class="flex">
                                                   <div class="">PID:<?php echo $sql_product['id']; ?></div>UID:<?php echo $sql_product['master_sku']; ?> | SKU: <?php echo $sql_product['sku']; ?><br> 
                                                   <a href="#" class="item-title text-color"> <?php echo $sql_product['productname']; ?></a> 
                                                </td> 
                                                <td class="flex">
                                                    <div class="item-title text-color"><?php echo $sql_basket['size']; ?></div> 
                                                </td> 
                                                <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $sql_basket['quantity'];?></span></td>
                                                <td>
                                                    <input type="hidden" name="basketpids12[]" value="<?php echo $sql_basket['id'];?>" />
                                                    <input type="hidden" name="orderidssa" value="<?php echo $_REQUEST['id'];?>" />
                                    
                                                    <select name="basketcancel[]" onchange="update_value(this.value,<?php echo $sql_basket['subtotal']; ?>)" > 
                                                        <option <?php if($sql_basket['iscancel']==0) { ?> selected="selected" <?php } ?> value="">Approve</option>
                                                        <option value="1" <?php if($sql_basket['iscancel']==1) { ?> selected="selected" <?php } ?>>Cancel</option> 
                                                    </select>
                                                </td>
                                                <td class="text-right"><span class="item-amount d-none d-sm-block text-sm">
                                                    <?php if($sql_basket['submrp'] > $sql_basket['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($sql_basket['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                                                    <?php echo Currency." ".number_format($sql_basket['subtotal'],2); ?>
                                                    </span></td> 
                                                
                                            </tr> 
                                            <?php } 
                                            $totalsaving = $submrp - $subtotal; 
                                            $paybleamount = $sql_order['totalcost'] - $sql_order['walletused'];
                                            ?>
                                        </tbody> 
                                    </table> 
                                    <table class="table table-theme table-rows v-middle">
                                        <tbody> 
                                            <?php if($totalsaving > 0) { ?><tr><td>Total Saving </td> <td class="text-right"><?php echo Currency." ".$totalsaving; ?></td></tr> <?php } ?>
                                            <tr><td>Sub Total</td> <td class="text-right"><?php echo Currency." ".$grand_total; ?></td></tr> 
                                            <tr><td>Shipping Cost</td><td class="text-right"><?php echo Currency." ".$sql_order['shipcharge']; ?></td></tr>  
                                            <?php if($sql_order['coupondiscount'] > 0) { ?>
                                            <tr><td>Coupon Discount</td><td class="text-right"><?php echo Currency." ".$sql_order['coupondiscount']; ?></td></tr> 
                                            <?php } ?>
                                            <tr><td>Total   </td><td class="text-right"><?php echo Currency." ".$sql_order['totalcost']; ?></td></tr> 
                                            <tr><td>Wallet Used</td><td class="text-right"><?php echo Currency." ".$sql_order['walletused']; ?></td></tr> 
                                        </tbody>
                                        <tfoot>
                                            <tr><td colspan="3" class="text-right no-border"><small class="muted mx-2">Total Payble Amount: </small><strong class="text-success"><?php echo Currency." ".$paybleamount ; ?></strong></td> </tr>
                                            <tr><td colspan="3" class="text-right no-border"><small class="muted mx-2">Wallet Return</small> <input type="text" name="walletreturn" id="walletreturn" value="" /> </td> </tr>
                                            <tr><td colspan="3" class="text-right no-border">  <button type="submit" class="btn btn-raised btn-wave mb-2 cyan text-white" onclick="updatestatus( );">Update Order</button> </td> </tr>
                                        </tfoot> 
                                    </table>
                                    
                                    <?php
                                    $sql_cancelled_order=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$sql_order['bid']."' and iscancel='1'");
                                    if(mysqli_num_rows($sql_cancelled_order) > 0)
                                    {
                                    ?>
                                    <h4>Cancelled Products</h4>
                                    <table class="table table-theme table-row v-middle gaj">
                                        <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                            <tr> 
                                                <th class="text-muted">ORDER</th>
                                                <th class="text-muted sortable" data-toggle-class="asc">PRODUCT</th>
                                                <th class="text-muted sortable" data-toggle-class="asc">PRODUCT DETAILS</th>
                                                <th class="text-muted"><span class="d-none d-sm-block">WEIGHT</span></th> 
                                                <th class="text-muted sortable" data-toggle-class="asc">QUANTITY</th>
                                                <th class="text-muted  " data-toggle-class="asc">STATUS</th>
                                                <th class="text-muted sortable">AMOUNT </th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            $grand_total = 0;
                                            $submrp = '';
                                            $subtotal = 0;
                                            while($sql_basket =mysqli_fetch_assoc($sql_cancelled_order))
                                            {
                                                $subtotal = $subtotal + floor($sql_basket['subtotal']*$_SESSION['conratio']);
                                                $submrp = $submrp + floor($sql_basket['submrp']*$_SESSION['conratio']); 
                                                $grand_total = $grand_total + $sql_basket['subtotal']; 
                                                
                                            ?>
                                            <tr class="v-middle" data-id="15"> 
                                                <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $sql_basket['oid_seller']; ?></span></td>
                                                <td class="flex"><a href="#" class="item-title text-color">  
                                                  </a><a href="#" class="" data-toggle="tooltip" title="" data-original-title="Product Name">
                                                    <?php  
                                                    $product_id = $sql_basket['productid']; 
                                                    if($sql_basket['productimage'] != '')
                                                    {
                                                    ?> 
                                                        <a href="#" class="" data-toggle="tooltip" title="Product Name"><img src="<?php echo URL;?>/uploads/productimage/thumb/<?php echo $sql_basket['productimage']; ?>" height="80px"alt="."></a>
                                                     <?php } else { ?>
                                                        <a href="#" class="" data-toggle="tooltip" title="Product Name"><img src="assets/img/a6.jpg" height="80px"alt="."></a>
                                                    <?php } ?>
                                                  </a>
                                                </td> 
                                                <?php
                                                    $sql_product=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where id='".$product_id."'"));
                                                ?>
                                               <td class="flex">
                                                   <div class="">PID:<?php echo $sql_product['id']; ?></div>UID:<?php echo $sql_product['master_sku']; ?> | SKU: <?php echo $sql_product['sku']; ?><br> 
                                                   <a href="#" class="item-title text-color"> <?php echo $sql_product['productname']; ?></a> 
                                                </td> 
                                                <td class="flex">
                                                    <div class="item-title text-color"><?php echo $sql_basket['size']; ?></div> 
                                                </td> 
                                                <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $sql_basket['quantity'];?></span></td>
                                                <td>
                                                    Cancelled
                                                </td>
                                                <td class="text-right"><span class="item-amount d-none d-sm-block text-sm">
                                                    <?php if($sql_basket['submrp'] > $sql_basket['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($sql_basket['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                                                    <?php echo Currency." ".number_format($sql_basket['subtotal'],2); ?>
                                                    </span></td> 
                                                
                                            </tr> 
                                            <?php } 
                                            $totalsaving = $submrp - $subtotal; 
                                            $paybleamount = $sql_order['totalcost'] - $sql_order['walletused'];
                                            ?>
                                        </tbody> 
                                    </table> 
                                    
                                    <?php } ?>
                                    </form>
                                </div> 
                            </div> 
                        </div> 
                    </div>
                </div>
                        
                      </div>
                      </div>
            </div>
        </div> 
<script type="text/javascript">
function updatestatus(orderid)
{ 
    var status = $("#status").val(); 
    $.ajax({
    	type: "POST",
    	data: { status: status, orderid: orderid },
    	url: "https://localhost/project/shopurneeds/seller-panel/update_order_status.php",
    	success: function(response){    
    	    window.location.reload();
    	}
    });   
}
</script>

<script>
function cancelother(othervalue) {
	if(othervalue=='other') {
		$(".othershowtext").css("display","block");
		$('.cancel_reason1').attr('required', 'required');
	} else { 
		$(".othershowtext").css("display","none");
		$('.cancel_reason1').removeAttr('required');
	}
}
function update_value(status,currentvalue)
{
    var walletreturn = $("#walletreturn").val();
    if(status == 0)
    {
        var total =  Number(walletreturn) - Number(currentvalue);
    }
    else
    { 
        var total =  Number(walletreturn) + Number(currentvalue);
    }
    $("#walletreturn").val(total);
}
</script>

   