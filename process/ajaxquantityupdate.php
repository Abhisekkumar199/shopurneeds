<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php");  

$cartid = $_REQUEST['cartid'];
$productid = $_REQUEST['productid'];
$status = $_REQUEST['status'];

$sql=mysqli_query($conn,"select * from ".$sufix."basket where id='".$cartid."'  and productid='".$productid."'");
$rows = mysqli_fetch_assoc($sql);
 
$sellingprice=$rows['sellingprice'];
$qty=$rows['quantity'];	
$pweight2=$rows['pweight'];
$submrp=$rows['costprice'];
$subdiscount=$rows['subdiscount'];
$shipprice=$rows['shipprice']; 
if($qty == 1 and $status == 'minus')
{
     mysqli_query($conn,"delete from `".$sufix."basket` where id='".$cartid."' and  productid='".$productid."'"); 
    ?>
    
    <?php

}
else  
{
    if($status=='add')
    {
    	$qty=$qty + 1;
    }
    else
    {
    	$qty=$qty - 1; 
    } 
    
    $subtotal=$sellingprice*$qty;
    $pweight= $pweight2*$qty;
    
    $submrpnew=$submrp*$qty;
    $subdiscountnew = $subdiscount*$qty;
 
 
    mysqli_query($conn,"update `".$sufix."basket` set `quantity`='".$qty."', `subtotal`='".$subtotal."',submrp='".$submrpnew."',subdiscount='".$subdiscountnew."', `totalweight`='".$pweight."' where id='".$cartid."' and productid='".$productid."'");
    
   
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
            
            
    $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where id='".$cartid."'  and productid='".$productid."'"); 
    if(mysqli_num_rows($sqlpcheck) > 0)
    { 
        $basketrows = mysqli_fetch_assoc($sqlpcheck);
         
        
        $minus = "'minus'";
        $add = "'add'";
  
        $basket .='<div class="center">
        <a style="font-weight: 700; background: #84c225; color: #ffffff;padding: 1px 10px 1px 10px;border-radius: 50%;" onclick="quantity('.$cartid.','.$productid.','.$minus.');" href="javascript:void(0)" > -</a>  
        <input type="text" size="1" value="'.$basketrows['quantity'].'"   class="tradzeal-qty-input" style="text-align:center;width: 120px;height: 20px;" readonly >
        <a style="font-weight: 700; background: #84c225; color: #ffffff;padding: 1px 9px 1px 9px;border-radius: 50%;" onclick="quantity('.$cartid.','.$productid.','.$add.');" href="javascript:void(0)" > + </a> 
        
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