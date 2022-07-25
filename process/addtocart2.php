<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php");  

    if($_SESSION['shopid']==0 || $_SESSION['shopid']=="")
    {	
    	$sbasket=mysqli_query($conn,"select bid from ".$sufix."basketid order by bid desc");
        $bid21=mysqli_fetch_array($sbasket,0);	
    	if($bid21!="")
    	{
    		$bid=$bid21+1;
    	}
    	else
    	{
    		$bid=1;
    	}
    	mysqli_query($conn,"insert into ".$sufix."basketid(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") ;
    	//$bid=mysql_insert_id(); 
    	$_SESSION['shopid']=$bid;
    }
    else
    {
    	$bid=$_SESSION['shopid'];
    
    }
    $productsid = $_REQUEST['productid'];
    $sqlpchecksingle=mysqli_query($conn,"select * from ".$sufix."basket where bid='$bid' and is_single='1'") ;
    $numpchecksingle=mysqli_num_rows($sqlpchecksingle);
if($numpchecksingle==0)
{
    $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where bid='$bid' and productid='".$_REQUEST['productid']."'") ;
    $numpcheck=mysqli_num_rows($sqlpcheck);
    if($numpcheck=="0")
    {
        $sql=mysqli_query($conn,"select * from ".$sufix."product where displayflag='1' and id='".$_REQUEST['productid']."'") ;
    	$numproduct2= mysqli_num_rows($sql);
    	if($numproduct2 > 0 )
    	{
    		 while($rowproduct = mysqli_fetch_array($sql))									
    		{
    			$sqlimage=mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$_REQUEST['productid']."' and mainimage='1'");
    		 
    			$sizeRows=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where  id='".$_REQUEST['sizeid']."'"));
    			 
    			$rowimage=mysqli_fetch_array($sqlimage);
    			
                if($rowproduct['gst'] > 0) 
                { 
                $gstamount = $rowproduct['sellingprice']*$rowproduct['gst']/100;
                }
                else
                {
                $gstamount = '';
                }
                
                $sellingprice=$rowproduct['sellingprice'] + $gstamount; 
                $mrp = $rowproduct['mrp'] + $gstamount;
    			
    			 
			    $master_sku=$rowproduct['master_sku'];
    			$offer="";
    			$productname=mysqli_real_escape_string($conn,$rowproduct['productname']);
    			$qty=$_REQUEST['Quantity'];
    			
    																
    			$totalcost=$qty * $sellingprice;
    
    			$description=str_replace("'","`",$rowproduct['shortdescription']);									
    			
    			if($rowproduct['bid']!='')
    			{
    				$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
    			}
                mysqli_query($conn,"insert into ".$sufix."basket(`bid`, `productid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`, `suppliername`, `sellpricevat`,`seller_id`,`size`,`gst`,`color`,sla,disclaimer,sellprice1,sellprice,brandid,emailid,hsncode) values ('".$bid."', '".$_REQUEST['productid']."', '".$rowproduct['cat_id']."', '".$rowproduct['subcat_id']."', '".$rowproduct['subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$rowproduct['product_mrp']."', '".$brands."', '', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['sku']."', '".$rowproduct['barcode']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$msubscription."', '".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."', '".$rowproduct['sellpricevat']."','".$rowproduct['seller_id']."','".$_REQUEST['sizeid']."','".$rowproduct['gst']."','".$rowproduct['color']."','".$sizeRows['sla']."','".$sizeRows['disclaimer']."','".$sellingprice."','".$sellingprice."', '".$rowproduct['bid']."','".$_SESSION['emailid']."','".$rowproduct['hsncode']."')") ;
                $lastid = mysqli_insert_id($conn);
                
                $sqlsize33=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size  where  product_id='".$productsid."' and product_size='".$_REQUEST['sizeid']."' group by product_size limit 1"));
        			 
               	$sellingprice = $sqlsize33['product_sellingprice'];
               	$mrp = $sqlsize33['product_mrp'];
               	$subtotal = $sellingprice*$qty;
               	$basketupdate = mysqli_query($conn,"update ".$sufix."basket set sellingprice='".$sellingprice."',subtotal='".$subtotal."',sellprice1='".$sellingprice."'  where id='".$lastid."'");
                
                
                $pro_id = $productsid;	
                $date = date('Y-m-d');
                
                $sqlpromotionCheck=mysqli_query($conn,"select * from ".$sufix."promotion where  upids like '%".$rowproduct['master_sku']."%' and  validto>= '".$date."' and validfrom <= '".$date."'");
                if(mysqli_num_rows($sqlpromotionCheck) > 0)
                {
                    $rowPromotion = mysqli_fetch_assoc($sqlpromotionCheck);
                    $promotionId= $rowPromotion['id'];
                     $single_product= $rowPromotion['single_product'];
                    $basketupdate = mysqli_query($conn,"update ".$sufix."basket set promotionId='".$promotionId."',is_single='".$single_product."' where id='".$lastid."'"); 
                }
                
                
                $sql_deal =mysqli_query($conn,"select * from ".$sufix."deal where start_date <='".$_SESSION["current-date"]."' and end_date >='".$_SESSION["current-date"]."' and start_time <=  '".$_SESSION["current-time"]."' and 0 < FIND_IN_SET('$pro_id',products) "); 
                if(mysqli_num_rows($sql_deal) > 0)
                {
                    $rows_deals = mysqli_fetch_assoc($sql_deal);
                    $discount_percentage = $rows_deals['percentage'];  
                    $discount_amount = ($mrp*$discount_percentage)/100;
                    $sellprice2=$mrp-$discount_amount;
                       
                    $subtotal = $sellprice2*$qty;
                    $basketupdate = mysqli_query($conn,"update ".$sufix."basket set sellingprice='".$sellprice2."',subtotal='".$subtotal."',sellprice1='".$sellingprice."',coupan_discount='".($rowcoupanvalue1*$qty)."', couponused='1' where id='".$lastid."'");
                     
                }
                else
                {   
                    $sqlcoupan=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$master_sku%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='0' order by codeid desc");
                    
                    $sqlcoupan2=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$master_sku%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='2' order by codeid desc");
                    $cashbacknum = mysqli_num_rows($sqlcoupan2);
        
                    if(mysqli_num_rows($sqlcoupan)>0) 
                    {
                        $rowcoupan = mysqli_fetch_assoc($sqlcoupan);
                         
                        $rowcoupanvalue1 = ($mrp*$rowcoupan['discountvalue'])/100; 
                        $sellprice2=$mrp-$rowcoupanvalue1;   
                        $pervalue= $rowcoupan['discountvalue'];
                         
                        $subtotal = $sellprice2*$qty;
                        $basketupdate = mysqli_query($conn,"update ".$sufix."basket set sellingprice='".$sellprice2."',subtotal='".$subtotal."',sellprice1='".$sellingprice."',coupan_discount='".($rowcoupanvalue1*$qty)."', couponused='1' where id='".$lastid."'");
                    
                    } 
                    else 
                    { 
                    	$rowcoupan2 = mysqli_fetch_assoc($sqlcoupan2);
                    	$rowcoupanvalue1 = ($sellingprice*$rowcoupan2['discountvalue'])/100;
                    	$basketupdate = mysqli_query($conn,"update ".$sufix."basket set cashback_price='".$rowcoupanvalue1."',cashback_status='yes', couponused='1' where id='".$lastid."'");
                    } 
                }
    		}
    	} 									
    }
	 	
}
    $sql=$basket->selectcart($sufix);
	$num=$basket->num($sql);
	$totalcost=0;
	$qty = 0;
	while($rows = mysqli_fetch_assoc($sql))
	{
		$pwieght=$pwieght + $rows['totalweight'];
	   	$totalweight=$totalweight + $rows['totalweight'];
	   	$qty=$qty + $rows['quantity'];
		
		$totalcost=$totalcost + $rows['subtotal'];
	}
	
		if($_SESSION['shopid']!='')
	{
		$shipcharge=$basket->shipchargeheader($sufix,$pwieght,$_SESSION['city']);
	}	
	$grandtotal=($totalcost + $shipcharge);
			
?>
     
 <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i><?php echo $sqlcd=mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'")); ?></i></span></a>
                    <div class="ps-cart__content">
                        <?php if($sqlcd > 0) { ?>
                        <div class="ps-cart__items">
                            <?php 
                            $grandtotal = '';
                            $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                            while($rowcs=mysqli_fetch_array($sqlcd))
                            { 
                                $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                                $grandtotal = $grandtotal + $totalamount; 
                            ?>     
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail"><a href="#"><img src="<?php echo URL;?>/uploads/productimage/small/<?php echo $rowcs['productimage']; ?>" alt=""></a></div>
                                <div class="ps-product__content">
                                    <a class="ps-product__remove" href="<?php echo URL; ?>/delete_basket.php?id=<?php echo $rowcs['id']; ?>&pid=<?php echo $rowcs['productid']; ?>" onClick="return confirm('Are you sure delete product?')"><i class="icon-cross"></i></a>
                                    <a href="product-default.html"><?php echo $rowcs['productname']; ?></a>
                                    <p><strong>Size:</strong>  <?php echo $rowcs['size']; ?></p>
                                    <small><?php echo $rowcs['quantity']; ?> x <?php echo Currency.$totalamount; ?></small>
                                </div>
                            </div>
                            <?php } ?> 
                        
                        </div>
                        <div class="ps-cart__footer">
                            <h3>Sub Total:<strong><?php echo Currency.$grandtotal; ?></strong></h3>
                            <figure><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >View Cart</a><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >Checkout</a></figure>
                        </div>
                        <?php } else { ?>
                            <p>Your Cart is empty</p>
                        <?php } ?>
                    </div>					
	 