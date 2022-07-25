<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php");  
 
    if($_SESSION['shopid']==0 || $_SESSION['shopid']=="")
    {	
    	$sbasket=mysqli_query($conn,"select bid from ".$sufix."basketid order by bid desc");
        $bid21=mysqli_fetch_assoc($sbasket);	
    	if($bid21!="")
    	{
    		$bid=$bid21['bid'] + 1;
    	}
    	else
    	{
    		$bid=1;
    	}
    	mysqli_query($conn,"insert into ".$sufix."basketid(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") ; 
    	$_SESSION['shopid']=$bid;
    }
    else
    {
    	$bid=$_SESSION['shopid']; 
    }
    
    $productid = $_REQUEST['productid'];
	$qty=$_REQUEST['Quantity']; 
	$sizeid = $_REQUEST['sizeid'];
     
    $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where bid='$bid' and productid='".$_REQUEST['productid']."'") ; 
    $numpcheck = mysqli_num_rows($sqlpcheck);
    if($numpcheck=="0")
    {
        $sql=mysqli_query($conn,"select * from ".$sufix."product where displayflag='1' and id='".$_REQUEST['productid']."'") ;
    	$numproduct2= mysqli_num_rows($sql);
    	if($numproduct2 > 0 )
    	{
		    while($rowproduct = mysqli_fetch_array($sql))									
    		{
    			$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$productid."' and mainimage='1'"));  
    			
			    $master_sku=$rowproduct['master_sku']; 
    			$productname=mysqli_real_escape_string($conn,$rowproduct['productname']);
    			$description=str_replace("'","`",$rowproduct['shortdescription']);									
    			
    			if($rowproduct['bid']!='')
    			{
    				$brands= mysqli_fetch_assoc(mysqli_query($conn,"select brandname from ".$sufix."brand where  bid='".$rowproduct['bid']."'"));   
    				$brandname =$brands['brandname'];
    			}
    			
                mysqli_query($conn,"insert into ".$sufix."basket(`bid`, `productid`, `cat_id`, `productname`, `productimage`, `slug`, `description`, `brand`, `quantity`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `suppliername`,`seller_id`,`size`,`color`,brandid,emailid,hsncode) values ('".$bid."', '".$productid."', '".$rowproduct['cat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$brandname."', '".$qty."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['sku']."', '".$rowproduct['barcode']."', '".$rowproduct['suppliername']."','".$rowproduct['seller_id']."','".$sizeid."','".$rowproduct['color']."', '".$rowproduct['bid']."','".$_SESSION['emailid']."','".$rowproduct['hsncode']."')") ;
                $lastid = mysqli_insert_id($conn);
                 
                $sqlsize33=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size  where  product_id='".$productid."' and product_size='".$sizeid."' group by product_size limit 1")); 
               	$sellingprice = $sqlsize33['product_sellingprice'];
               	$mrp = $sqlsize33['product_mrp'];
                $dissscunt = $sqlsize33['discount_value'];
                
               	$sql_deal =mysqli_query($conn,"select * from ".$sufix."deal where start_date <='".date("Y-m-d")."' and end_date >='".date("Y-m-d")."'  and 0 < FIND_IN_SET('$master_sku',products) "); 
             
                if(mysqli_num_rows($sql_deal) > 0)
                {
                    $rows_deals = mysqli_fetch_assoc($sql_deal);
                    $discount_percentage = $rows_deals['percentage'];  
                    $discount_amount = ($mrp*$discount_percentage)/100;
                    $sellprice2=$mrp-$discount_amount; 
                    $subtotal = $sellprice2*$qty; 
                     $submrp=$mrp*$qty;
                   	$subdiscount=$discount_amount*$qty;
                   	
                    $basketupdate = mysqli_query($conn,"update ".$sufix."basket set costprice='".$mrp."',sellingprice='".$sellprice2."',discount_price='".$discount_amount."',subtotal='".$subtotal."',submrp='".$submrp."',subdiscount='".$subdiscount."',sellprice1='".$sellingprice."',coupan_discount='".($rowcoupanvalue1*$qty)."', couponused='1' where id='".$lastid."'"); 
                }
                else
                {
                    $submrp=$mrp*$qty;
                   	$subdiscount=$dissscunt*$qty;
                   	$subtotal = $sellingprice*$qty;  
           	    	$basketupdate = mysqli_query($conn,"update ".$sufix."basket set costprice='".$mrp."',sellingprice='".$sellingprice."',discount_price='".$dissscunt."',subtotal='".$subtotal."',submrp='".$submrp."',subdiscount='".$subdiscount."',sellprice1='".$sellingprice."'  where id='".$lastid."'");  
                } 
                
    		}
    	} 
    }
    
    
    $cart = '';
 	$basket = '';
 	 
    $sqlcd =    mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'"));
  
    $cart .= '  <div id="cart" class="btn-block mt-40 mb-30 ">
                <button type="button" class="btn" data-target="#cart-dropdown" data-toggle="collapse" aria-expanded="true">
                  <span id="shippingcart">My basket</span>
                  <span id="cart-total">Item '.$sqlcd.'</span>
                </button>
              <a href="'.URL.'/basket/cart" class="cart_responsive btn"><span id="cart-text">My basket</span><span id="cart-total-res">'.$sqlcd.'</span> </a>
            </div>
            <div id="cart-dropdown" class="cart-menu collapse">
              <ul>
                <li>
                  <table class="table table-striped">
                    <tbody>'; 
                        $grandtotal = '';
                        $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                        while($rowcs=mysqli_fetch_array($sqlcd))
                        { 
                            $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                            $grandtotal = $grandtotal + $totalamount; 
                          
                            $cart .= '<tr>
                                <td class="text-center"><a href="#"><img style="width: 60px;" src="'.URL.'/uploads/productimage/thumb/'.$rowcs['productimage'].'" alt="iPod Classic" title="iPod Classic"></a></td>
                                <td style="width: 240px;" class="text-left product-name"><a href="'.$rowcs['slug'].'">'.$rowcs['productname'].'</a> <span class="text-left price">'.$rowcs['quantity'].' x '.Currency.$totalamount.'</span>
                                  
                                </td> 
                                <td class="text-center"><a class="close-cart"  href="'.URL.'/process/delete_basket.php?id='.$rowcs['id'].'&pid='.$rowcs['productid'].'" onClick="return confirm("Are you sure delete product?")"><i class="fa fa-times-circle"></i></a></td>
                            </tr>'; 
                          }    
                    $cart .= '</tbody>
                  </table>
                </li>
                <li>
                  <table class="table">
                    <tbody>
                       
                      <tr>
                        <td class="text-right"><strong>Total</strong></td>
                        <td class="text-right">'.Currency.$grandtotal.'</td>
                      </tr>
                    </tbody>
                  </table>
                </li>
                <li>
                  <form action="'.URL.'/basket/cart">
                    <input class="btn pull-left" value="View cart" type="submit">
                  </form>
                  <form action="'.URL.'/basket/cart">
                    <input class="btn pull-right" value="Checkout" type="submit">
                  </form>
                </li>
              </ul>
            </div>';
            
            
    $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where id='".$lastid."'  and productid='".$productid."'"); 
    if(mysqli_num_rows($sqlpcheck) > 0)
    { 
        $basketrows = mysqli_fetch_assoc($sqlpcheck);
         
        
        $minus = "'minus'";
        $add = "'add'";
  
        $basket .='<div class="center">
        <a style="font-weight: 700; background: #84c225; color: #ffffff;padding: 1px 10px 1px 10px;border-radius: 50%;" onclick="quantity('.$lastid.','.$productid.','.$minus.');" href="javascript:void(0)" > -</a>  
        <input type="text" size="1" value="'.$basketrows['quantity'].'"   class="tradzeal-qty-input" style="text-align:center;width: 120px;height: 20px;" readonly >
        <a style="font-weight: 700; background: #84c225; color: #ffffff;padding: 1px 9px 1px 9px;border-radius: 50%;" onclick="quantity('.$lastid.','.$productid.','.$add.');" href="javascript:void(0)" > + </a> 
        
        </div>'; 
    } 
    else 
    {  
          
        $basket .='<label class="control-label">Qty</label>
                <input type="number" name="quantity" min="1" value="1"  step="1" class="qty form-control quantity'.$productid.'">
                <button type="button" onclick="addtocart('.$productid.');"  class="addtocart pull-right">Add</button>';
        
    }                  
    $array = array('cart'=>$cart,"basket"=>$basket );
    echo  $myJSON = json_encode($array);   
     ?>