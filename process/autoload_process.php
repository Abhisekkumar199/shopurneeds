<?php
session_start();  
include("../configuration.php");  
include("../includes/currency_display.php");
if($_POST)
{
    //sanitize post value
    $group_number = filter_var($_POST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); 
    //throw HTTP error if group number is not valid
    if(!is_numeric($group_number))
    {
        header('HTTP/1.1 500 Invalid number!');
        exit();
    }
    $items_per_group = 24; 
    $position = ($group_number * $items_per_group); 
    $sql = $_POST['sql'];
    $checkflag = $_POST['check1']; 
    "$sql LIMIT $position, $items_per_group";
    $results = mysqli_query($conn,"$sql LIMIT $position, $items_per_group"); 
    if(mysqli_num_rows($results) > 0) 
    { 
        $z = 1;
        while($fetc_pro_row2=mysqli_fetch_array($results))
        {  
            $query_supplier = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."suppliers`   where id='".$fetc_pro_row2['seller_id']."'")); 
            $master_sku=$fetc_pro_row2['master_sku'];
            $selimage2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$fetc_pro_row2['id']."' and mainimage='1'")); 
            $selimage3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$fetc_pro_row2['id']."' and mainimage='0'")); 
            if($selimage2['productimage']!= '') 
            { 
        ?>
             <?php  
		 		$sql_deal =mysqli_query($conn,"select * from ".$sufix."deal where start_date <='".$_SESSION["current-date"]."' and end_date >='".$_SESSION["current-date"]."'   and 0 < FIND_IN_SET('$master_sku',products) "); 
                if(mysqli_num_rows($sql_deal) > 0)
                {
                    $rows_deals = mysqli_fetch_assoc($sql_deal);
                    $discount_percentage = $rows_deals['percentage'];  
                    
                    $sqlsize = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc limit 1");  
                                        
                    $rowssize = mysqli_fetch_assoc($sqlsize);
                    $discount_amount = ($rowssize['product_mrp']*$discount_percentage)/100;
                    $sellprice=$rowssize['product_mrp']-$discount_amount;
                     $is_deal = 1;
                    $price_sell =  floor($sellprice*$_SESSION['conratio']).'&nbsp;';  
                }
                else
                { 
                    $rowssize = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc limit 1")); 
                   
                    
                    $sellingprice = $rowssize['product_sellingprice'];
                    $mrpprice = $rowssize['product_mrp'];
                    $pervalue = $mrpprice - $sellingprice;
					$percentage = round($pervalue*100/$mrpprice);
					if($percentage!=0)
					{  
					     
						$price_sell = ''.Currency.''.floor($sellingprice*$_SESSION['conratio']).'';
						$price_mrp = '<del>'.Currency.''.floor($mrpprice*$_SESSION['conratio']).'</del>&nbsp;'; 
						$discount = '<small>'.$percentage.'% off</small>'; 
					}
					else
					{ 
					    $price_mrp="";
					    $discount="";
						$price_sell = ''.Currency.''.floor($sellingprice*$_SESSION['conratio']).''; 
					}
                    
                    $is_deal = 0;
                } 
                ?>  
                    <div class="product-layout  product-grid col-lg-3 col-6 ">
                        <div class="item">
                            <div class="product-thumb transition">
                                <div class="image">
                                    <div class="first_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"> <img style="height: 221px;"  src="<?php echo URL;  ?>/uploads/productimage/<?php echo $selimage2['productimage']; ?>"   class="img-responsive"> </a> </div>
                                    <div class="swap_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php if($selimage3['productimage'] != '') { ?> <img style="height: 221px;"  src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage3['productimage']; ?>"    class="img-responsive"> <?php } ?>  </a></div>
                                </div>
                                <div class="product-details">
                                    <div class="caption">
                                        <h4><a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php echo substr(ucwords(strtolower($fetc_pro_row2['productname'])), 0, 25);  ?></a></h4> 
                                        <div class="clearfix"></div>
                                        <?php if($is_deal == 1) { ?>
                                        <div class="row" style="    margin: 2px;">
                                            <span class="price-tax col-md-5" style="font-size: 13px;padding: 0px;"> <?php echo $rowssize['product_size']; ?></span>   <span class="col-md-3" style="color: #ffffff;background-color: #84c225;padding: 0px;font-size: 10px;"><?php echo $discount_percentage; ?> % off</span> <p class="price col-md-4 text-right" style="padding: 0px;"><?php echo Currency." ".$sellprice; ?></p>
                                        </div>
                                        <?php } else { ?> 
                                        <span class="price-tax"> <?php echo $rowssize['product_size']; ?></span> <p class="price"><span style="font-size: 11px;"><?php echo $price_mrp ?></span><span class="ml-1 mr-1"><?php echo $price_sell; ?></span><span style="font-size: 11px;"><?php echo $discount; ?></span></p>
                                        <?php } ?>
                                        <div class="product_option">
                                            <div class="form-group required ">
                                              <select   id="input-option231" class="form-control selectsize<?php echo floor($fetc_pro_row2['id']); ?>">
                                                <option value=""> Select Size </option>
                                                <?php $sqlsize = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc"); 
                                                    $x = 1;
                                                    $sellprice1 = '';
                                                    while($rowssize1 = mysqli_fetch_assoc($sqlsize))
                                                    {
                                                        if($is_deal == 1)
                                                        {
                                                            $discount_amount1 = ($rowssize1['product_mrp']*$discount_percentage)/100;
                                                            $sellprice1=$rowssize1['product_mrp']-$discount_amount1;
                                                        }
                                                        else
                                                        {
                                                            $sellprice1 = $rowssize1['product_sellingprice'];
                                                        }
                                                ?>
                                                    <option value="<?php echo $rowssize1['product_size']; ?>" <?php if($x == 1 and $rowssize1['qty'] > 0) { echo "selected";  } ?> <?php if($rowssize1['qty'] < 1) { echo "disabled"; } ?> ><?php echo $rowssize1['product_size']; ?>(<?php echo Currency." ".$sellprice1; ?>) <?php if($rowssize1['qty'] < 1) { echo "Out Of Stock"; } ?></option>
                                                <?php $x++; } ?> 
                                              </select>
                                            </div>
                                            <div class="input-group button-group cartqty<?php echo floor($fetc_pro_row2['id']); ?>" style="position: inherit;">
                                                <?php
                                                $sqlqty_check = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' and qty > 0");  
                                                $is_available = mysqli_num_rows($sqlqty_check); 
                                                if($is_available > 0)
                                                {
                                                $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' and productid='".$fetc_pro_row2['id']."'");
                                                if(mysqli_num_rows($sqlpcheck) > 0)
                                                {
                                                    $basketrows = mysqli_fetch_assoc($sqlpcheck);
                                                ?> 
                                                    <div class="center">
                                                        <a style="font-weight: 700; background: #84c225; color: #ffffff;    padding: 1px 10px 1px 10px;border-radius: 50%;" onclick="quantity(<?php echo $basketrows['id']; ?>,<?php echo floor($fetc_pro_row2['id']); ?>,'minus');" href="javascript:void(0)" > -</a>  
                                                        <input type="text" size="1" value="<?php echo $basketrows['quantity']; ?>"   class="tradzeal-qty-input" style="text-align:center;width: 120px;height: 20px;" readonly>
                                                        <a style="font-weight: 700; background: #84c225; color: #ffffff;    padding: 1px 9px 1px 9px;border-radius: 50%;" onclick="quantity(<?php echo $basketrows['id']; ?>,<?php echo floor($fetc_pro_row2['id']); ?>,'add');" href="javascript:void(0)" > + </a>  
                                                    </div> 
                                                    <?php } else { ?> 
                                                        <label class="control-label">Qty</label>
                                                        <input type="number"  min="1" value="1"  step="1" class="qty form-control quantity<?php echo floor($fetc_pro_row2['id']); ?>">
                                                        <button type="button" onclick="addtocart(<?php echo floor($fetc_pro_row2['id']); ?>);"  class="addtocart pull-right">Add</button> 
                                                    <?php } ?> 
                                                <?php } else { ?>
                                                    <div class="center">
                                                        <p style="color:#84c225;">Out of Stock</p>   
                                                    </div> 
                                                <?php } ?>
                                            </div>
                                        <div class="loaderdiv<?php echo floor($fetc_pro_row2['id']); ?>" style="text-align: center;display: none;"><span  style=""><img style="height:20px;width:20px;text-align-center;" src="<?php echo URL; ?>/assets/images/loader.gif"   ></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
            <?php } $z++; }  } ?>  
                        
 
                    
 <?php   } else { echo false;     } ?> 
 


