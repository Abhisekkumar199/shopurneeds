<?php   
$sqlrecentyly=mysqli_query($conn,"insert into `".$sufix."recently`(pid,ipaddress,created) values ('$pid', '".$_SERVER['REMOTE_ADDR']."',NOW())"); 
$clicksupdate = mysqli_query($conn,"update `".$sufix."product` set pdpclicks = pdpclicks+1,pdpclicks2 = pdpclicks2+1 where id='".$pid."'");

$rowproduct=mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."product` where id='".$pid."' and displayflag='1'")); 

$productid = $rowproduct['id'];  
$productname=$rowproduct['productname'];  
$master_sku=$rowproduct['master_sku']; 
$sku=$rowproduct['sku'];  
$queryBrand = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."brand`   where bid='".$rowproduct['bid']."'"));
$query_supplier = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."suppliers`   where id='".$rowproduct['seller_id']."'")); 
?>      
    <!-- =====  BREADCRUMB STRAT  ===== -->
    <div class="breadcrumb section pt-60 pb-60 mb-30">
      <div class="container"> 
        <ul>
            <li><a href="<?php echo URL; ?>"><i class="fa fa-home"></i></a></li>
          
            <?php 
			function cagegory_breadcrumbs1($id, $category_tbl, $except = null) 
			{
				global $conn;
				$s = "SELECT * FROM ".$category_tbl." WHERE cat_id = $id";
				$r = mysqli_query($conn,$s);
				$row = mysqli_fetch_array($r);
				$cat_slug = $row['cat_slug'];
				if($row['parent'] == 0) 
				{
					$name = $row['categoryname'];
					$curl = URL;  
					return "<li class='active'><a href='".URL."/".$row['cat_slug']."'>".$name."</a></li> ";
				} 
				else 
				{
					$name = $row['categoryname'];
					if(!empty($except) && $except == $name)
					return cagegory_breadcrumbs1($row['parent'],$category_tbl, $except)." ".$name;
				}
				return cagegory_breadcrumbs1($row['parent'],$category_tbl, $except). " <li><a href='".URL."/".$row['cat_slug']."'>".$name."</a></li> ";
			} 
			$cagegory_breadcrumbs = cagegory_breadcrumbs1($rowproduct['cat_id'],'shopurneeds_category',$except = null);
			echo $cagegory_breadcrumbs = substr($cagegory_breadcrumbs,0, -1);
			?> 
        </ul>
      </div>
    </div>

    <!-- =====  BREADCRUMB END===== -->

    <div class="product-section section">
    <!-- =====  CONTAINER START  ===== --> 
      <div class="container">
        <div class="row">
            <div class="col-sm-1"></div>
          <div class="col-sm-10 mb-20 mt-50">
            <div class="row mt_10 ">
                <div class="col-md-5 product_img"> 
                    <?php 
                    $sqlthumb="select * from ".$sufix."imageupload where displayflag='1' and pid='".$pid."' and mainimage = 1 limit 1";
                    $sqlimagethumb=mysqli_query($conn,$sqlthumb); 
                    $countimagethumb=1;
                    while($rowimagethumb=mysqli_fetch_assoc($sqlimagethumb))
                    {  
                        $largeimage=$cdnurl."/uploads/productimage/".$rowimagethumb['productimage'];
                    ?> 
                        <div><a class="thumbnails "> <img data-name="product_image" src="<?php echo $largeimage;?>" alt="" /></a></div>   
                    <?php $countimagethumb++; } ?>   
                
                    <div id="product-thumbnail" class="owl-carousel">
                        <?php 
                        $sqlthumb="select * from ".$sufix."imageupload where displayflag='1' and pid='".$pid."' order by sortid asc";
                        $sqlimagethumb=mysqli_query($conn,$sqlthumb); 
                        $countimagethumb=1;
                        while($rowimagethumb=mysqli_fetch_assoc($sqlimagethumb))
                        { 
                            $thumbimage=$cdnurl."/uploads/productimage/thumb/".$rowimagethumb['productimage']; 
                            $largeimage=$cdnurl."/uploads/productimage/".$rowimagethumb['productimage'];
                        ?> 
                            <div class="item">
                                <div class="image-additional"><a class="thumbnail" href="<?php echo $largeimage;?>" data-fancybox="group1"> <img style="max-height: 100px; max-width: 80px;" src="<?php echo $thumbimage;?>" alt="" /></a></div>
                            </div> 
                        <?php $countimagethumb++; } ?>  
                    </div>
                </div>
                <div class="col-md-7 prodetail caption">
                    <h4 data-name="product_name" class="product-name"><a href="#" title="Casual Shirt With Ruffle Hem"><?php echo $productname; ?></a></h4>
                   
                    <span class="price mb-20 newprice" style="font-size: 21px;display: inline-block;width: 100%;">
                        <?php
                        $pro_id = $rowproduct['id'];	
        		 		$date = date('Y-m-d');   
        		 		$sql_deal =mysqli_query($conn,"select * from ".$sufix."deal where start_date <='".$_SESSION["current-date"]."' and end_date >='".$_SESSION["current-date"]."'  and 0 < FIND_IN_SET('$master_sku',products) "); 
                        if(mysqli_num_rows($sql_deal) > 0)
                        {
                            $rows_deals = mysqli_fetch_assoc($sql_deal);
                            $discount_percentage = $rows_deals['percentage'];  
                            
                            $rowssize = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$productid."' order by id desc limit 1"));  
                                                 
                            $discount_amount = ($rowssize['product_mrp']*$discount_percentage)/100;
                            $sellprice=$rowssize['product_mrp']-$discount_amount;
                             
                            $is_deal = 1;
                             
                            echo $price = '<span class="amount"><span class="currencySymbol">'.Currency.'</span>'.floor($sellprice*$_SESSION['conratio']).'</span>';
                        }
                        else
                        { 
            		 	 	$rowssize = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$productid."' order by id desc limit 1")); 
                            $sellingprice = $rowssize['product_sellingprice'];
                            echo Currency.$price_sell =  floor($sellingprice*$_SESSION['conratio']).'';  
                            $is_deal = 0;
                        }
                        ?>  
                    </span>
                    <p>Size: <?php echo $rowssize['product_size']; ?></p>
                    <hr>
                    <ul class="list-unstyled product_info my-3">
                        <li>
                            <label>Brand:</label>
                            <span> <a  style="color:#84c225;" href="<?php echo URL; ?>/<?php echo $queryBrand['brandslug']; ?>" ><?php echo $queryBrand['brandname']; ?></a></span>
                        </li>
                        <li>
                            <label>Seller:</label>
                            <span> <a  style="color:#84c225;" href="<?php echo URL; ?>/<?php echo $query_supplier['seller_slug']; ?>" ><?php echo $query_supplier['suppliername']; ?></a></span>
                        </li>
                        <li>
                        <label>Product Code:</label>
                        <span><?php echo $rowproduct['master_sku']; ?></span>
                        </li>
                      <li>
                        <label>Availability:</label>
                        <?php
                        $sqlqty_check = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$rowproduct['id']."' and qty > 0");  
                        $is_available = mysqli_num_rows($sqlqty_check); 
                        if($is_available > 0)
                        {
                        ?>
                        <span> In Stock</span>
                        <?php } else { ?>
                        <span> Out Of Stock</span>
                        <?php } ?>
                        </li>
                    </ul>
                    <p><?php echo $rowproduct['longdescription']; ?></p>
                    <hr>
                    <p class="product-desc mt-20"><?php echo $rowproduct['shortdescription']; ?></p>
                    
                    
                    
                <div id="product">
                  <div class="form-group">
                    <div class="row">
                      <div class="Sort-by col-lg-6 col-12 ">
                        <label>Size</label>
                        <input type="hidden" id="prod_id" value="<?php echo $rowproduct['id'];  ?>">
                        <select name="product_size" id="select-by-size" onchange="selectsize(this.value);" class="selectsize selectpicker form-control">
                            <option value="">Select</option>
                            
                            <?php $sqlsize = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$productid."' order by id desc"); 
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
                                <option value="<?php echo $rowssize1['product_size']; ?>" <?php if($x == 1) { echo "selected";  } ?>  <?php if($rowssize1['qty'] < 1) { echo "disabled"; } ?>  > <?php echo $rowssize1['product_size']; ?>(<?php echo Currency." ".$sellprice1; ?>) <?php if($rowssize1['qty'] < 1) { echo "Out Of Stock"; } ?></option>
                            <?php $x++; } ?> 
                             
                        </select>
                        <span class="sizeError"></span>
                        
                      </div>
                      <!--<div class="Color col-lg-6 col-12 mt-20">
                        <label>Color</label>
                        <select name="product_color" id="select-by-color" class="selectpicker form-control">
                          <option>Blue</option>
                          <option>Green</option>
                          <option>Orange</option>
                          <option>White</option>
                        </select>
                      </div>-->
                    </div>
                  </div>
                    <?php
                    $sqlqty_check = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$rowproduct['id']."' and qty > 0");  
                    $is_available = mysqli_num_rows($sqlqty_check); 
                    if($is_available > 0)
                    {
                    ?>
                    <div class="qty mt-10 form-group">
                        <label>Qty</label>
                        <input name="product_quantity" min="1" value="1" type="number" id="Quantity">
                      </div>
                      <div class="button-group mt-10">
                        <div class="add-to-cart" data-toggle="tooltip" title="" data-original-title="Add to cart"><a onclick="addtocartbutton1('<?php echo $pid; ?>');" href="javascript:void(0);" ><span>Add</span></a></div>
                        <div class="wishlist favorite_result<?php echo intval($rowproduct['id']); ?>" data-toggle="tooltip"   >
                                <?php if($_SESSION['emailid']=='') { ?> 
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal"><span><i class="fa fa-heart"></i></span></a>   
                                <?php } else {  
                                $user_id_follow = mysqli_query($conn,"select * from ".$sufix."favorite_product where user_id = '".$_SESSION['useridse']."' and product_id = '".$rowproduct['id']."'");
                                if(mysqli_num_rows($user_id_follow)>0) 
                                {
                                ?> 
                                    <a href="javascript:void(0);" onClick="removetofavoritepro('<?php echo intval($rowproduct['id']); ?>')"><span><i style="color: #84c225;" class="fa fa-heart"></i></span></a>  
                                <?php } else { ?>
                                    <a href="javascript:void(0);" onClick="addtofavoritepro('<?php echo intval($rowproduct['id']); ?>')"><span><i class="fa fa-heart"></i></span></a>  
                                <?php } ?>
                                <?php } ?>  
                            </div> 
                      </div>
                    <?php } else { ?>  
                            <p style="color:#84c225;"> Out Of Stock</p>
                           
                    <?php } ?>
                  
                  <div class="prodbottominfo mt-20">
                    <ul class="list-unstyled">                    
                      <li data-toggle="tooltip" title="" data-original-title="Worldwide Shipping">
                        <img src="<?php echo URL; ?>/assets/images/world.png" alt=""> 
                      </li>
                      <li data-toggle="tooltip" title="" data-original-title="100% Original Product">
                        <img src="<?php echo URL; ?>/assets/images/original.png" alt=""> 
                      </li>
                      <li data-toggle="tooltip" title="" data-original-title="Best Price Guaranteed">
                        <img src="<?php echo URL; ?>/assets/images/inquire.png" alt=""> 
                      </li>
                       <li data-toggle="tooltip" title="" data-original-title="COD Available in India">
                         <img src="<?php echo URL; ?>/assets/images/cod.png" alt=""> 
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 my-5">
                <ul class="nav nav-tabs mb-30" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="true">Overview</a>
                  </li> 
                 <!--<li class="nav-item">
                    <a class="nav-link" id="solution-tab" data-toggle="tab" href="#Solution" role="tab" aria-controls="solution-tab" aria-selected="false">Solution</a>
                  </li>-->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Overview" role="tabpanel" aria-labelledby="Overview">
                      <p><?php echo $rowproduct['longdescription']; ?></p>
                        <div class="table-responsive">
                          <table class="table table-bordered ps-table ps-table--specification">
                            <tbody>
                              <tr>
                                <td>Product SKU</td>
                                <td><?php echo $rowproduct['master_sku'];?></td>
                              </tr>
                              <tr>
                                <td>Brand</td>
                                <td><a style="color:#84c225;" href="<?php echo URL; ?>/<?php echo $queryBrand['brandslug']; ?>"><?php echo $queryBrand['brandname'];?></a></td>
                              </tr>
                               
                              
                                <?php
                               $sql_prod_attr = mysqli_query($conn,"select * from ".$sufix."product_attribute where pid='".$rowproduct['id']."' group by atr_id");
        						while($rows11 = mysqli_fetch_assoc($sql_prod_attr))
        						{
        							$atr_id = $rows11['atr_id']; 
        							$sql_attr  = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."attributes where atr_id ='".$atr_id."'")); 
							    ?>
        							<tr>
                                        <td><?php echo $sql_attr['attributename']; ?></td>
                                        <td>
                                            <?php 
                                            
        						            $attr_val= '';
					                        $sql_prod_attr_val = mysqli_query($conn,"select atr_val_id from ".$sufix."product_attribute where pid='".$rowproduct['id']."' and atr_id='".$atr_id."'");
                							while($rows11 = mysqli_fetch_assoc($sql_prod_attr_val))
                    						{
                    							$attr_val .= $rows11['atr_val_id'].","; 
                    						}
                						    $attr_val1 = substr($attr_val,0,-1); 
                						    
            								$sql_atr_val  = mysqli_query($conn,"select attributevaluename from ".$sufix."attributevalue where atr_val_id IN (".$attr_val1.") and displayflag='1' order by attributevaluename ASC") ;
            								$z = 1;
            								while($rows_atr_val= mysqli_fetch_assoc($sql_atr_val))
            								{ 
            								?>	
            								<?php if($z > 1){ echo ", ";} echo $rows_atr_val['attributevaluename'];?> 
            								<?php $z++; } ?>
                                            
                                        </td>
                                    </tr>
        							
        							
        							<?php
        							
        						}
                               ?>
                                
                            </tbody>
                          </table>
                        </div> 
                        
                        <div class="row"> 
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 mt-30">
                                <form class="ps-form--review"  method="get"> 
                                    <input type="hidden" name="review_user_id" id="review_user_id" value="<?php echo $_SESSION['useridse'];?>">
                                    <input type="hidden" name="review_product_id" id="review_product_id" value="<?php echo $productid ;?>">
                                    <h4>Submit Your Review</h4> 
                                    <div class="col-md-12 col-lg-12">
                                        <div class="alert-success" id="alertr"></div>
                                    </div>
                                    <div class="form-group form-group__rating">
                                        <label>Your rating of this product</label> 
                                         
                                        <div id="full-stars-example">
                                            <div class="rating-group"> 
                                                <input class="rating__input" name="rating" id="rating-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating-1">1 <i style="color:#ffb307f0;" class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating-2">2 <i style="color:#ffb307f0;" class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-3" value="3" type="radio" >
                                                <label aria-label="4 stars" class="rating__label" for="rating-3">3 <i style="color:#ffb307f0;" class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating-4">4 <i style="color:#ffb307f0;" class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                <input class="rating__input" name="rating" id="rating-5" value="5" type="radio" checked> 
                                                <label aria-label="5 stars" class="rating__label" for="rating-5">5 <i style="color:#ffb307f0;" class="rating__icon rating__icon--star fa fa-star"></i></label>
                                            </div> 
                                        </div>  
                                         
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="4" id="message" placeholder="Write your review here" maxlength="200"></textarea>
                                    </div>
                               
                                    <div class="form-group submit"> 
                                        <?php if($_SESSION['emailid']=='') { ?> 
                                            <button type="button" class="ps-btn" data-toggle="modal" data-target="#loginModal" style="    height: 36px;
                                            background-color: #84c225;
                                            color: #fff;
                                            font-size: 14px;
                                            padding: 0 12px;border: none;
                                            box-shadow: none;
                                            line-height: 36px;" >Submit Review</button> 
                                                <?php } else { ?> 
                                                                                    <button type="button" onclick="leavereview();"  class="ps-btn" style="    height: 36px;
                                            background-color: #84c225;
                                            color: #fff;
                                            font-size: 14px;
                                            padding: 0 12px;border: none;
                                            box-shadow: none;
                                            line-height: 36px;">Submit Review</button>
                                                                                <?php } ?>  
                                    </div>
                                </form>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                 <?php 
                                $sql_revie = mysqli_query($conn,"select * from ".$sufix."reviews  where product_id='".$productid."'");
                                while($rows_review = mysqli_fetch_assoc($sql_revie))
                                {
                                ?>
                                    <div class="border-bottom border-color-1 pb-4 mb-4" style="border: 1px solid #ececec; padding: 10px; border-radius: 5px;margin-top:3px;">
                                        <!-- Review Rating --> 
                                        <div id="full-stars-example">
                                            <div class="rating-group"> 
                                                <?php  
                                                for($x=0;$x <  $rows_review['rating']; $x++)
                                                { 
                                                ?>  
                                                <label style="margin-bottom: 0px;" aria-label="2 stars" class="rating__label" for="rating-1"><i style="color:#ffb307f0;" class="rating__icon rating__icon--star fa fa-star"></i></label> 
                                                <?php } ?>   
                                            </div> 
                                        </div> 
                                        <p style="margin-bottom: 0px;" class="text-gray-90"><?php echo $rows_review['comments']; ?></p>
    
                                        <!-- Reviewer -->
                                        <div class="mb-2">
                                            <strong><?php echo $rows_review['fullname']; ?></strong>
                                            <span class="font-size-13 text-gray-23">- <?php echo date("M d Y", strtotime($rows_review['adddate'])); ?></span>
                                        </div>
                                        <!-- End Reviewer -->
                                    </div> 
                                <?php } ?>
                            </div>
						</div>  
                        
                    </div> 
                 </div>

              </div>
            </div>
            <?php
                $sql_pro="select * from ".$sufix."product where displayflag='1' and vartype=''  and cat_id='".$rowproduct['cat_id']."' and id != '".$rowproduct['id']."' order by id desc limit 10";  
				$rewsss = mysqli_query($conn,$sql_pro);
				if(mysqli_num_rows($rewsss)>0) 
				{
            ?>
            <div class="row">
              <div class="col-md-12">
                <div class="heading-part text-center mb-10">
                  <h3 class="section_title mt-50">Related Products</h3>
                </div>
                <div class="related_pro">
                    <div class="product-layout related-pro  owl-carousel mb-50 "> 
                    <?php 
                    while($fetc_pro_row2=mysqli_fetch_array($rewsss))
                    {  
                        $query_supplier = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."suppliers`   where id='".$fetc_pro_row2['seller_id']."'")); 
                    $master_sku=$fetc_pro_row2['master_sku'];
                    $selimage2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$fetc_pro_row2['id']."' and mainimage='1'")); 
                    $selimage3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$fetc_pro_row2['id']."' and mainimage='0'")); 
                    if($selimage2['productimage']!= '') 
                    {   
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
                            $sqlsize = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc limit 1")); 
                            $sellingprice = $sqlsize['product_sellingprice'];
                            $price_sell =  floor($sellingprice*$_SESSION['conratio']).'';  
                            $is_deal = 0;
                        } 
                        ?>  
                            <div class="product-grid">
                                <div class="item">
                                    <div class="product-thumb transition">
                                        <div class="image">
                                            <div class="first_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"> <img style="height: 221px;"  src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage2['productimage']; ?>"   class="img-responsive"> </a> </div>
                                            <div class="swap_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php if($selimage3['productimage'] != '') { ?> <img style="height: 221px;"  src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage3['productimage']; ?>"    class="img-responsive"> <?php } ?>  </a></div>
                                        </div>
                                        <div class="product-details">
                                            <div class="caption">
                                                <h4><a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php echo substr($fetc_pro_row2['productname'], 0, 25);  ?></a></h4> 
                                                <div class="clearfix"></div>
                                                <?php if($is_deal == 1) { ?>
                                                <div class="row" style="    margin: 2px;">
                                                    <span class="price-tax col-md-5" style="font-size: 13px;padding: 0px;"> <?php echo $rowssize['product_size']; ?></span>   <span class="col-md-3" style="color: #ffffff;background-color: #84c225;padding: 0px;font-size: 10px;"><?php echo $discount_percentage; ?> % off</span> <p class="price col-md-4 text-right" style="padding: 0px;"><?php echo Currency." ".$sellprice; ?></p>
                                                </div>
                                                <?php } else { ?>
                                                <span class="price-tax"> <?php echo $rowssize['product_size']; ?></span> <p class="price"><?php echo Currency." ".$price_sell; ?></p>
                                                <?php } ?>
                                                <div class="product_option">
                                                    <div class="form-group required ">
                                                      <select   id="input-option231" class="form-control selectsize<?php echo floor($fetc_pro_row2['id']); ?>">
                                                        <option value=""> --- Please Select --- </option>
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
                                                            <option value="<?php echo $rowssize1['product_size']; ?>" <?php if($x == 1) { echo "selected";  } ?>><?php echo $rowssize1['product_size']; ?>(<?php echo Currency." ".$sellprice1; ?>)</option>
                                                        <?php $x++; } ?> 
                                                      </select>
                                                    </div>
                                                    <div class="input-group button-group cartqty<?php echo floor($fetc_pro_row2['id']); ?>" style="position: inherit;">
                                                    <?php
                                                    $sqlpcheck=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' and productid='".$fetc_pro_row2['id']."'");
                                                    if(mysqli_num_rows($sqlpcheck) > 0)
                                                    {
                                                        $basketrows = mysqli_fetch_assoc($sqlpcheck);
                                                    ?>
                                                      
                                                    <div class="center">
                                                        <a style="font-weight: 700; background: #84c225; color: #ffffff;    padding: 1px 10px 1px 10px;border-radius: 50%;" onclick="quantity(<?php echo $basketrows['id']; ?>,<?php echo floor($fetc_pro_row2['id']); ?>,'minus');" href="javascript:void(0)" > -</a>  
                                                        <input type="text" size="1" value="<?php echo $basketrows['quantity']; ?>" name="quantity[40]" class="tradzeal-qty-input" style="text-align:center;width: 120px;height: 20px;" readonly>
                                                        <a style="font-weight: 700; background: #84c225; color: #ffffff;    padding: 1px 9px 1px 9px;border-radius: 50%;" onclick="quantity(<?php echo $basketrows['id']; ?>,<?php echo floor($fetc_pro_row2['id']); ?>,'add');" href="javascript:void(0)" > + </a> 
                                                        
                                                    </div>
                                                     
                                                    <?php } else { ?>
                                                    
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" name="quantity" min="1" value="1"  step="1" class="qty form-control quantity<?php echo floor($fetc_pro_row2['id']); ?>">
                                                    <button type="button" onclick="addtocart(<?php echo floor($fetc_pro_row2['id']); ?>);"  class="addtocart pull-right">Add</button>
                                                    
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
               
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

     

      </div>
    <!-- =====  CONTAINER END  ===== -->
    </div>
<script type="text/javascript"> 
function leavereview()
{    
var rating = $('input[name="rating"]:checked').val();  
var message = $("#message").val();  
var product_id = $("#review_product_id").val();   
var user_id = $("#review_user_id").val();   
    if(rating == '0')
    {
        $('#alertr').html("<div class='alert alert-danger'>Please select rating.</div>");
		$('#rating').css("border","1px solid red");
		$('#rating').focus();
		return false;
    }
    else
    {
        $('#alertr').html("");
        $('#rating').css("border","1px solid #c9c9c9");
    } 
   
    if(message == '')
    {
        $('#alertr').html("<div class='alert alert-danger'>Please enter message.</div>");
        $('#message').css("border","1px solid red");
		$('#message').focus();
		return false;
    }
    else
    {
        $('#alertr').html("");
        $('#message').css("border","1px solid #c9c9c9");
    } 
   
     
    
     
$.ajax({ /* THEN THE AJAX CALL */
type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */ 
url: "https://localhost/project/shopurneeds/ajax/ajax_review.php", /* PAGE WHERE WE WILL PASS THE DATA */
data:{'rating':rating,'message':message,'product_id':product_id,'user_id':user_id}, 
success: function(result){ /* GET THE TO BE RETURNED DATA */  
$("#alertr").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
$("#review_name").val('');  
$("#title").val('');  
$("#message").val(''); 
}
});
} 
</script>