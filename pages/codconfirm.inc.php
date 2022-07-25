<?php
session_start(); 
date_default_timezone_set('Asia/Calcutta');
include("../configuration.php");
include("../mailfunction.php");   
$CompanyEmail=CompanyEmail; //
$CompanyName=CompanyName; // 
$URL=URL;
 
$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'") ;
$rowuser=mysqli_fetch_assoc($sql);	

$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$_SESSION['selected_address']."'");
$rowaddress = mysqli_fetch_array($sqladdress);


$sql2=mysqli_query($conn,"select * from ".$sufix."order where oid ='".$_SESSION['oid']."' and emailid='".$_SESSION['emailid']."'") ;
$roworder=mysqli_fetch_assoc($sql2);  
$sqlupdate123=mysqli_query($conn,"update ".$sufix."order set remarks='Order Approved', reference_id='', approve_status='Order Approved', onlinemode='' where oid='".$_SESSION['oid']."'");
if($roworder['walletused']>0)
     {
        
         $walleramount=$roworder['walletused'];
         	
	mysqli_query($conn,"insert into `".$sufix."user_wallet` (user_id,orderid,type,debit,adddate) values('".$rowuser['id']."','".$_SESSION['oid']."','Paid For Order','".$walleramount."',NOW())");

     }
$paytpemail="cod";

?>
<div id="content"> 
    <div class="container"> 
        <div class="col-lg-1"></div>
        <div class="col-lg-10 grid-center ot_20 clearfix">
            <div class="row">
                <div class="col-sm-12 shoping-gridLine">
                    <div class="step2 shopping_step_col hidden-xs"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
                    <div class="step1 shopping_step_col hidden-xs"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
                    <div class="step3 shopping_step_col hidden-xs"> <span class="step_num">3</span><span>Shipping</span> </div>
                    <div class="step4 shopping_step_col hidden-xs"> <span class="step_num">4</span><span>Payment</span> </div>
                    <div class="step5 shopping_step_col active"> <span class="step_num">5</span><span>Reciept</span> </div>
                </div>
                <div class=" card-wrap" style="border:0;">
                <div class="col-md-12 col-sm-2 pd-70 run-10" > 
                    <?php
                    $basketpid=$_SESSION['shopid'];
                    $emailid = $_SESSION['emailid'];
                    $orderid = $_SESSION['oid'];
                    $usersql = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$emailid."'"));
                    
                    $sqlbas=mysqli_query($conn,"select *, subtotal As subtotal1,quantity As quantity1,(shipprice*quantity) As shipprice1,(cod_charges*quantity) As cod_charges1,(tax*quantity) As tax1,totalweight As totalweight1  from ".$sufix."basket where bid='$basketpid'");
                    $i=1;
                    while($row1=mysqli_fetch_array($sqlbas))
                    {
                        $seller_id = $row1['seller_id'];
                        $idtt=$orderid."-".$i;
                        mysqli_query($conn,"insert into ".$sufix."order_seller(`id`,`oid`,`seller_id`,`bid`, `quantity2`, `totalcost`,`cashcoinvalue`, `shipcharge`,`cod_charges`,`tax`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,paytype,ipaddress, orderinistatus, ordermode,orderstatus,reference_id) values ('".$idtt."','".$orderid."','".$row1['seller_id']."','".$basketpid."', '".$row1['quantity1']."', '".$row1['subtotal1']."','',  '".$row1['shipprice1']."','".$row1['cod_charges1']."','".$row1['tax1']."', '".$discvalue."', '".$vouchervalue."', '".$row1['totalweight1']."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Placed','0','0','1', '".$rowaddress['fname']."', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['city']."', '".$rowaddress['state']."', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '".$method[0]."', '".$method[1]."','COD','$ipaddress', 'Order Placed', 'COD','".$_REQUEST['statusd']."','".$_REQUEST['idssas']."')") ;	
                        $oseller=mysqli_insert_id($conn);
                        $sqlsellerid = mysqli_query($conn,"select id from ".$sufix."order_seller where sid='".$oseller."'");
                        $sql_order = mysqli_fetch_array($sqlsellerid);
                        $fisellid = $sql_order['id'];
                        mysqli_query($conn,"update ".$sufix."basket set oid_seller='$fisellid' where bid='$basketpid' and seller_id='".$row1['seller_id']."' and oid_seller='' limit 1") ;
                        
                        mysqli_query($conn,"insert into ".$sufix."order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`,`ordermode`) values ('".$fisellid."','Order Placed','".date('Y-m-d')."', '".date("H:m")."', '1','COD')") ;	
                        
                        $rowpsize=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$row1['productid']."' and product_size='".$row1['size']."'"));
                        $cartqtyr=$row1['quantity'];
                        if($rowpsize['qty_stock']>=$cartqtyr)
                        {
                            mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_stock=qty_stock-$cartqtyr where id='".$rowpsize['id']."'");
                            mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_stock' where bid='".$basketpid."' and productid='".$row1['productid']."'");
                        }
                        else if($rowpsize['qty_rto']>=$cartqtyr)
                        {
                            mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_rto=qty_rto-$cartqtyr where id='".$rowpsize['id']."'");
                            mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_rto' where bid='".$basketpid."' and productid='".$row1['productid']."'");
                        }
                        else if($rowpsize['qty_cmnt']>=$cartqtyr)
                        {
                            mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_cmnt=qty_cmnt-$cartqtyr where id='".$rowpsize['id']."'");
                            mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_cmnt' where bid='".$basketpid."' and productid='".$row1['productid']."'");
                        }
                        else
                        {
                            mysqli_query($conn,"update ".$sufix."product_size  set qty=qty-$cartqtyr, qty_bo=qty_bo-$cartqtyr where id='".$rowpsize['id']."'");
                            mysqli_query($conn,"update ".$sufix."basket  set qtyminusfrom='qty_bo' where bid='".$basketpid."' and productid='".$row1['productid']."'");
                        }	
                        $i++; 
                        $cashback_price = $cashback_price+$row1['cashback_price'];
                        
                        
                        
                    }
                     
                    if($_SESSION['shopid'] != '')
                    {
            	        include("order_mail.php"); 
                        send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
                        include("order_mail_admin.php");
                        send_mail($toc, $subjectc, $messagec, $headers1, $fromc, ''); 
                        
                        $sql_seller = mysqli_fetch_array(mysqli_query($conn,"select emailid,suppliername from ".$sufix."suppliers where id='".$seller_id."'"));
                        $seller_email = $sql_seller['emailid'];
                        $suppliername = $sql_seller['suppliername'];
                        include("order_mail_vendor.php");
                        send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
                    }
        	        
        	        mysqli_query($conn,"update ".$sufix."user_registration  set cashback='".$cashback_price."',wallet='".$_SESSION['remainingwalletamount']."' where emailid='".$emailid."'");
        	
        	        mysqli_query($conn,"update ".$sufix."order  set orderstatus='".$_REQUEST['statusd']."',reference_id='".$_REQUEST['idssas']."' where oid='".$orderid."'");
                    
                    $mobileno = $rowaddress['mobileno'];
                    if($roworder['paytype'] == "COD")
                    {
                        $message=urlencode("Hi, Your order no $orderid placed successfully.It will be delivered on ".date("d-M-Y",strtotime($roworder['delivery_date'])).". Pay online for hassle free & contactless delivery.");  
                    }
                    else if($roworder['paytype'] == "Wallet" and $_SESSION['totalpaybleamount'] > 0)
                    {
                        $message=urlencode("Hi, Your order no $orderid placed successfully.It will be delivered on ".date("d-M-Y",strtotime($roworder['delivery_date'])).". Pay online for hassle free & contactless delivery.");  
                    }
                    else
                    {
                        $message=urlencode("Hi, Your order no $orderid placed successfully.It will be delivered on ".date("d-M-Y",strtotime($roworder['delivery_date'])).".");  
                    }
                    
                    $url="sms.webkype.in/sms_api/sendsms.php?username=shopurneeds&password=shopurneeds123@&mobile=$mobileno&sendername=SHOPUR&message=$message";  
                    $ch = curl_init();  
                    
                    curl_setopt($ch, CURLOPT_HEADER, 1); 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_HTTPGET, 1);
                    curl_setopt($ch, CURLOPT_URL, $url );
                    curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
                    curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2 ); 
                    curl_exec($ch);
        
                   /* 
                    $api_key = '55AA12057210C1';
                    $contacts = $usersql['billing_mobile']; 
                    $from = 'shopropayIN';
                    $sms_text = urlencode("Congratulations! Your https://localhost/project/shopurneeds order :".$orderid." successfully generated, You can use this for further assistant.");
                    //Submit to server
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, "http://bulksms.preeticonsultancy.com/app/smsapi/index.php");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=9&type=text&contacts=".$contacts."&senderid=shopropayIN&msg=".$sms_text);
                    $response = curl_exec($ch);
                    curl_close($ch); */
                    $coupanupdate=mysqli_query($conn,"update ".$sufix."user_coupon set displayflag='1' where coupon_code='".$_SESSION['coupancode']."' and coupon_id='".$_SESSION['coup_id']."' and user_id='".$_SESSION['useridse']."'");
                    
                    ?>
                    <div class="col-sm-12 text-center thankyou-img"><img src="https://localhost/project/shopurneeds/thankyou-img.jpeg" ></div>
                    <div class="clearfix"></div>
                    <h5 class="odr_dtl">
                        Hey <?php echo $rowaddress['fname'].'&nbsp;'.$rowaddress['lname'];?>, <span class="pull-right">Order Date:<?php
                        $orderdate = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."order where oid='".$_SESSION['oid']."'"));
                        $sql_slot = mysqli_fetch_assoc(mysqli_query($conn,"select delivery_slot from ".$sufix."shipping_slot where id='".$orderdate['delivery_slot']."'"));
                        echo $orderdate['orderdate'];
                        ?></span>
                    </h5>
                    <div style="color:green;"> Thank you for shopping with Shop Ur Needs. You have sucessfully placed ur order. Soon u will receive an order confirmation from our side. Further for any queries feel free to reach us at contact@shopurneeds.com or call us on +919711567607.</div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="delivery-left col-sm-12 " style="padding:0;">
                        <div class="billing-add col-sm-4 col-xs-12">
                        <p><strong>Customer Information</strong></p>
                        <?php echo $rowaddress['fname'].'&nbsp;'.$rowaddress['lname'];?><br>
                        <?php echo $usersql['emailid'];?><br>
                        <?php echo $rowaddress['mobileno'];?><br>
                        </div>
                        <div class="shipping-add col-sm-4 col-xs-12">
                            <p><strong>Shipping Address</strong></p>
                            <?php echo $rowaddress['address'];?><br>
                            <?php echo $rowaddress['city'];?><br>
                            <?php echo $rowaddress['state'];?> - <?php echo $rowaddress['zipcode'];?> 
                        </div>
                        <div class="shipping-add col-sm-4 pull-right col-xs-12">
                            <p><strong>Shipping Date & Slot</strong></p>
                            <?php echo $orderdate['delivery_date'];?> |
                            <?php echo $sql_slot['delivery_slot'];?><br> 
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border:1px solid #ddd !important; margin-top:5px;" class="table">
                        <tbody>    
                            <tr>
                                <th width="25%" style="text-align:center">            
                                    <div class="detail-head_col">Product</div>
                                </th>
                                <th width="44.5%" style="text-align:center">           
                                    <div class="detail-head_col">Product Description</div>
                                </th> 
                                <th width="14%" style="text-align:center">            
                                    <div class="detail-head_col">Unit</div> 
                                </th>
                                <th width="16.5%" style="text-align:center">             
                                    <div class="detail-head_col">Sub Total</div> 
                                </th>
                            </tr>
                            <?php 
                            $sql_basket = mysqli_query($conn,"select * from `".$sufix."basket` where bid='".$basketpid."'") ;		
                            $totalval=0;
                            $count=1;
                            $totalcost=0;
                            $cod_charges1=0;
                            $tax1 = 0;
                            $discount_price1 = 0;
                            $sellprice1 = 0;
                            $coupan_discount1= 0; 
                            $shipprice = $roworder['shipcharge'];
                            $codcharge = $roworder['codcharge'];
                            $submrp = '';
                            $subtotal = 0;
                            
                            while($row=mysqli_fetch_assoc($sql_basket))
                            {	
                                $subtotal = $subtotal + floor($row['subtotal']*$_SESSION['conratio']);
                                $submrp = $submrp + floor($row['submrp']*$_SESSION['conratio']); 
                                $pwieght=$pwieght + $row['totalweight'];
                                $totalweight=$totalweight + $row['totalweight'];
                                $totalcost=$totalcost + $row['subtotal'];
                                $quantity = $row['quantity'];
                                $sellprice = $row['sellingprice']*$row['quantity'];
                                $discount_price = $row['discount_price']*$row['quantity'];
                                $coupan_discount = $row['coupan_discount']*$row['quantity'];
                                $tax = $row['tax']*$row['quantity'];
                                
                                $tax1 = $tax1+$tax;
                                $sellprice1 = $sellprice1+$sellprice;
                                $discount_price1 = $discount_price1+$discount_price;
                                $coupan_discount1 = $coupan_discount1+$coupan_discount;
                                $coupon_discount = $row['coupan_discount'];
                            ?>
                            <tr>
                            <td><div class="detail-info_col text-center">
                            <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php echo $row['productimage']; ?>" style="max-height:100px;" border="0">
                            </div></td>
                            <td><div class="detail-info_col">
                            <p class="da_product-name"><a href="<?php echo URL;?>/<?php echo $row['slug']; ?>"><?php echo $row['productname']; ?></a></p>
                            
                            <br> <small> Size : <?php echo $row['size']; ?> </small> 
                            </div></td>
                            
                            
                            <td><div class="detail-info_col text-center "><?php echo $row['quantity'];?></div></td>
                            <td><div class="detail-info_col text-center">
                            <p>
                                <?php if($row['submrp'] > $row['subtotal']){ ?><span style="font-size: 11px;"><del><?php echo Currency; ?> <?php echo round($row['submrp']*$_SESSION['conratio']); ?></del>&nbsp;</span><?php } ?>
                                <?php echo Currency; ?> <?php echo ($row['subtotal']*$_SESSION['conratio']); ?>
                            </p>
                            </div>
                            </td>
                        </tr>
                			<?php $count++; 
                            }
                            $totalsaving = $submrp - $subtotal; 
                            if($vouchervalue!='')
                            {
                                $totalcost=$totalcost-$vouchervalue;
                            }
                            else
                            {
                                $totalcost=$totalcost;
                            }
                            $totalcost  = $totalcost - $_SESSION['couponcartvalue'];
                            ?>
                         </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 basketdeatil-total_col checkout-total-col">
                        
                        <div class="col-sm-10 col-xs-8 text-right" style="padding:0">
                            <div class="detail-total_col"><strong>Total Saving:</strong></div>
                        </div>
                        <div class="col-sm-2 col-xs-4" style="padding:0">
                            <div class="detail-total_col text-center"> <?php echo Currency;?> <?php echo $totalsaving;?></div>
                        </div> 
                        
                        <div class="col-sm-10 col-xs-8 text-right" style="padding:0">
                            <div class="detail-total_col"><strong>Order Subtotal:</strong></div>
                        </div>
                        <div class="col-sm-2 col-xs-4" style="padding:0">
                            <div class="detail-total_col text-center"> <?php echo Currency;?> <?php echo ($sellprice1*$_SESSION['conratio']);?></div>
                        </div> 
                            
                        <?php if(($_SESSION['couponcartvalue']!="")) { ?>
                        <div class="col-sm-10 col-xs-8 text-right" style="padding:0">
                            <div class="detail-total_col"><strong>Coupon Discount: </strong></div>
                        </div>
                        <div class="col-sm-2 col-xs-4" style="padding:0">
                            <div class="detail-total_col text-center"> <?php echo Currency;?> <?php echo $_SESSION['couponcartvalue']; ?></div>
                        </div>
                        <?php } ?>
                            
                            
                        <div class="col-sm-10 text-right col-xs-8" style="padding:0">
                            <div class="detail-total_col"><strong>Shipping Charges:</strong></div>
                        </div>
                        <div class="col-sm-2 col-xs-4" style="padding:0">
                            <div class="detail-total_col text-center"><?php echo Currency;?> <?php echo ($shipprice*$_SESSION['conratio']);?></div>
                        </div>
                      
                      
                        <?php if($_SESSION['user_wallet_amount'] > 0) { ?>
                            <div class="col-sm-10 text-right col-xs-8" style="padding:0">
                                <div class="detail-total_col"><strong>Wallet:</strong></div>
                            </div>
                            <div class="col-sm-2 col-xs-4" style="padding:0">
                                <div class="detail-total_col text-center"><?php echo Currency;?> <?php echo $_SESSION['walletamounttobeuse'];?></div>
                            </div> 
                        <?php } ?> 
                      
                        <div class="col-sm-10 col-xs-8 text-right" style="padding:0">
                            <div class="detail-total_col"><strong>Estimated Order Total:</strong></div>
                        </div>
                        <div class="col-sm-2 col-xs-4" style="padding:0">
                            <div class="detail-total_col text-center">
                            <?php echo Currency;?> <?php echo $_SESSION['totalpaybleamount']; ?>
                            </div>
                        </div>
                    </div>
                      
                    <div class="col-sm-12 col-md-12 col-xs-12 pull-right" style="padding:0; margin-top:10px;">
                        <form  style="text-align:left; background: margin:0; border:0;">
                            <a class="btn btn-primary pull-left" href="<?php echo URL;?>/mydashboard" >Go to my Account</a>  
            				<a class="btn btn-primary pull-right" href="<?php echo URL;?>/" style="cursor:pointer;">Continue shopping</a>
                        </form>
                    </div>
                </div>
                </div>
            </div> 
        </div>
    </div>
</div>
 
 
    <script type="text/javascript">
    $('#formUpdateCart').validate({
       rules: {
            ProductSizeId:
            {
                required: true,
            },
            //ProductColorId: {
            //    required: true
            //},
            quantity: {
                greaterThanZero: true,
           },
        },
        messages: {
            //ProductColorId: "Choose Color",
            quantity: "Invalid quantity",
           ProductSizeId: "Please select size"
        }
    });
    jQuery.validator.addMethod("greaterThanZero", function (value, element) {
        return (parseFloat(value) > 0);
    }, "* Invalid quantity");
  </script> 
  </main>
  <?php $totalValue=$roworder['totalcost']*$_SESSION['conratio']; ?>
  <script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 805336370;
var google_conversion_label = "99BhCK7C04IBELLqgYAD";
if (<? echo $totalValue ?>) {
		var google_conversion_value = <? echo floor($totalValue); ?>;
		var google_conversion_currency = <? echo CurrencyCode; ?>;
	}
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/805336370/?value=<? echo floor($totalValue); ?>&amp;currency_code=<? echo CurrencyCode; ?>&amp;label=99BhCK7C04IBELLqgYAD&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
  <?php
    
	unset($_SESSION['ordervalue']);
	unset($_SESSION['totalpaybleamount']);
	unset($_SESSION['walletamounttobeuse']);
	unset($_SESSION['remainingwalletamount']);  
  
  	unset($_SESSION['shopid']);	
	unset($_SESSION['shipping']);
	unset($_SESSION['productcost']);
	unset($_SESSION['totalcost']);
	unset($_SESSION['weight']);
	unset($_SESSION['selected_address']);
	unset($_SESSION['couponcartvalue']);
	unset($_SESSION['couponcartdiscode']);
  ?>
  <style>.detail-head_col, .detail-info_col{ border:0 !important} table{ border-color:#ddd !important; margin-bottom:0 !important;} table th, .detail-info_col{ padding:0 !important}</style>
  <!-- Google Code for Order Placed Conversion Page -->
  <style>
     @media screen and (max-width: 767px) {.thankyou-img img{ width:100%;}
         .card-wrap .delivery-left .billing-add, .card-wrap .delivery-left .shipping-add{ float:left !important;}
         .btn-primary {
   
    width: 100%;
    margin-top: 20px;
}
     } 
     .run-10 h5{
         font-weight: 900;
     } 
      
  </style>
<br>
<br>
<br>