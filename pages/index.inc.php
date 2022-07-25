    
    <!-- =====  BANNER STRAT  ===== -->
    <div class="banner section">
        <div class="main-banner owl-carousel">
            <?php   
            $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Slider' order by id asc limit 0,6");
            $num1=mysqli_num_rows($sql1); 
            if($num1 > 0)
            { 
                $j = 0;
            while($rowsbanner1=mysqli_fetch_assoc($sql1))
            {
            ?>  
                <div class="item"><a href="<?php echo $rowsbanner1['externallink']; ?>"><img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>" alt=""></a></div>
				 
            <?php $j++;  } } ?>  
      </div>
    </div>
    <!-- =====  BANNER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <!-- =====  SUB BANNER  STRAT ===== -->
      <div class="subbanner-section section mt-20">
        <div class="owl-carousel banner-carousel">
            <?php   
            $sql2=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Below Slider' order by id asc limit 0,6");
            $num2=mysqli_num_rows($sql2); 
            if($num2 > 0)
            { 
                $j = 0;
            while($rowsbanner2=mysqli_fetch_assoc($sql2))
            {
            ?>   
			    <div class="home-subbanner">
                    <div class="home-img"><a href="<?php echo $rowsbanner2['externallink']; ?>"><img class="leftbanner" src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner2['uploadimage']; ?>" ></a></div>
                    <div class="cms-desc">
                      <div class="cms-text1"><?php echo $rowsbanner2['description']; ?></div> 
                    </div>
                  </div>
            <?php $j++;  } } ?>  
           
        </div>
      </div>
      <!-- =====  SUB BANNER END  ===== --> 

      <!-- =====  SEARVICES START  ===== -->
      <div class="shipping-outer section">
        <div class="shipping-inner row">
          <div class="heading col-lg-3 col-12 text-center text-lg-left">
            <h2>Why choose us?</h2>
          </div>
          <div class="subtitle-part subtitle-part1 col-lg-3 col-4 text-center text-lg-left">
            <div class="subtitle-part-inner">
              <div class="subtitile">
                <div class="subtitle-part-image"></div>
                <div class="subtitile1">For Contactless On Time Delivery</div> 
              </div>
            </div>
          </div>
          <div class="subtitle-part subtitle-part2 col-lg-3 col-4 text-center text-lg-left">
            <div class="subtitle-part-inner">
              <div class="subtitile">
                <div class="subtitle-part-image"></div>
                <div class="subtitile1">Flexible Delivery Slots With Free Home Delivery**</div> 
              </div>
            </div>
          </div>
          <div class="subtitle-part subtitle-part3 col-lg-3 col-4 text-center text-lg-left">
            <div class="subtitle-part-inner">
              <div class="subtitile">
                <div class="subtitle-part-image"></div>
                <div class="subtitile1">Quality Assurance</div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- =====  SEARVICES END  ===== -->

      <!-- =====  PRODUCT CATEGORY START  ===== -->
      <?php
        $sql_top_category=mysqli_query($conn,"select * from `".$sufix."category` where displayflag='1' and topcat='1' order by sortid asc limit 0,6") ;
        $num=mysqli_num_rows($sql_top_category); 
        if($num > 0)
        {
      ?>
      <div class="category-banner-block">
        <div class="section_title">top categories</div>
        <div class="row"> 
            <?php  
            while($rows=mysqli_fetch_assoc($sql_top_category))
            {  
            ?>  
            <div class="product-layout col-lg-2 col-md-3 col-sm-4 col-6">
                <div class="product-thumb transition text-center">
                  <div class="caption categoryname">
                    <h4><a href="<?php echo URL; ?>/<?php echo $rows['cat_slug']; ?>"><?php echo $rows['categoryname']; ?></a></h4>
                  </div>
                  <div class="image"><a href="<?php echo URL; ?>/<?php echo $rows['cat_slug']; ?>"><img src="<?php echo URL; ?>/uploads/categoryimages/<?php echo $rows['uploadimage1']; ?>" alt="<?php echo $rows['categoryname']; ?>" title="<?php echo $rows['categoryname']; ?>" class="img-responsive"></a></div>
                </div>
            </div>
            <?php } ?> 
        </div>
      </div>
      <?php } ?> 
      <!-- =====  PRODUCT CATEGORY END  ===== -->

      <!-- =====  PRODUCT section  ===== -->
      <?php
      $sql3=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Fruits Store Left' order by id asc limit 0,1"); 
      if(mysqli_num_rows($sql3) > 0)
      {
      ?>
      <div class="category_product section">
        <div class="row">
            <div class="col-12">
                <div class="section_title">Fruits store</div>
            </div>
            <?php    
            $sql3=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Fruits Store Left' order by id asc limit 0,1"); 
            while($rowsbanner3=mysqli_fetch_assoc($sql3))
            {
            ?>   
                <div class="col-sm-3 productcategory_thumb text-center mb-15"> <img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner3['uploadimage']; ?>" alt="" title="" class="img-thumbnail"> </div>
            <?php  } ?>  
            <div class="col-sm-9 right_block">
                <div class="row">
                    <?php   
                    $sql4=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Fruits Store' order by id asc limit 0,6");
                    $num4=mysqli_num_rows($sql4); 
                    if($num4 > 0)
                    { 
                        $j = 0;
                    while($rowsbanner4=mysqli_fetch_assoc($sql4))
                    {
                    ?>    
                        <div class="product-layout col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="product-thumb transition">
                              <?php if($rowsbanner4['description'] !=  ''){ ?><p class="tag"><?php echo $rowsbanner4['description']; ?><br> % <br> <i>off</i></p><?php } ?>
                              <h4><a href="<?php echo $rowsbanner4['externallink']; ?>"><?php echo $rowsbanner4['bannername']; ?></a></h4>
                              <div class="image"><a href="<?php echo $rowsbanner4['externallink']; ?>"><img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner4['uploadimage']; ?>" alt="<?php echo $rowsbanner4['bannername']; ?>" title="<?php echo $rowsbanner4['bannername']; ?>" class="img-thumbnail"></a></div>
                            </div>
                        </div> 
                    <?php $j++;  } } ?>  
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="btn btn-primary viewall"><a href="#">View All</a></div>
            </div>
        </div>
      </div>
    <?php } ?>
      <!-- =====  featured section  ===== -->
      <div class="featured_product section mt-30">
        <div class="row">
          <div class="col-12">
            <div class="section_title">Featured Products</div>
          </div>
          <div class="section-product grid section">
              
                <?php 
                
                 $sql_slab=mysqli_query($conn,"select * from `".$sufix."product_slab` where displayflag='1' and id=1");
             $num_slab=mysqli_num_rows($sql_slab); 
            if($num_slab > 0)
            { 
                $j = 0;
                while($rows_slab=mysqli_fetch_assoc($sql_slab))
                {
                    $skuids = explode(",",$rows_slab['sku_ids']);
                    $skuids = implode("','",$skuids);
                }
            }
                $sql_pro="select * from ".$sufix."product where displayflag='1' and master_sku IN ('".$skuids."') and vartype=''";


                $sql_product .= $sql_pro."limit 0,10";   
				$rewsss = mysqli_query($conn,$sql_product);
				if(mysqli_num_rows($rewsss)>0) 
				{
                    $z = 1;
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
                            $price_sell =  round($sellprice*$_SESSION['conratio']).'&nbsp;';  
                        }
                        else
                        { 
                           
                            $sqlsize = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc limit 1")); 
                            $sellingprice = $sqlsize['product_sellingprice'];
                            $mrpprice = $sqlsize['product_mrp'];
                            $pervalue = $mrpprice - $sellingprice;
								$percentage = round($pervalue*100/$mrpprice);
								if($percentage!=0)
								{  
								     
									$price_sell = ''.Currency.''.round($sellingprice*$_SESSION['conratio']).'';
									$price_mrp = '<del>'.Currency.''.round($mrpprice*$_SESSION['conratio']).'</del>&nbsp;'; 
									$discount = '<small>'.$percentage.'% off</small>'; 
								}
								else
								{ 
								    $price_mrp="";
								    $discount="";
									$price_sell = ''.Currency.''.round($sellingprice*$_SESSION['conratio']).''; 
								}
                             
                            $is_deal = 0;
                        } 
                        ?>  
                            <div class=" product-items col-6 col-sm-4 col-md-4 col-lg-3">
                                <div class="product-thumb transition">
                                    <div class="image">
                                        <div class="first_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"> <img style="height: 170px;" src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage2['productimage']; ?>"   class="img-responsive"> </a> </div>
                                        <div class="swap_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php if($selimage3['productimage'] != '') { ?> <img style="height: 170px;" src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage3['productimage']; ?>"  class="img-responsive"><?php } ?> </a></div>
                                    </div>
                                    <div class="product-details">
                                        <div class="caption">
                                            <h4><a href="p<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php echo substr($fetc_pro_row2['productname'], 0, 25);  ?></a></h4>
                                            <div class="clearfix"></div>
                                            <?php if($is_deal == 1) { ?>
                                            <div class="row" style="    margin: 2px;">
                                                <span class="price-tax col-md-5" style="font-size: 13px;padding: 0px;"> <?php echo $rowssize['product_size']; ?></span>   <span class="col-md-3" style="color: #ffffff;background-color: #84c225;padding: 0px;font-size: 10px;"><?php echo $discount_percentage; ?> % off</span> <p class="price col-md-4 text-right" style="padding: 0px;"><?php echo Currency." ".$sellprice; ?></p>
                                            </div>
                                            <?php } else { ?>
                                            <span class="price-tax"> <?php echo $sqlsize['product_size']; ?></span> <p class="price"><span style="font-size: 11px;"><?php echo $price_mrp ?></span><span class="ml-1 mr-1"><?php echo $price_sell; ?></span><span style="font-size: 11px;"><?php echo $discount ?></span></p>
                                            <?php } ?>
                                                
                                            <div class="product_option">
                                                <div class="form-group required ">
                                                    <select   id="input-option231" class="form-control selectsize<?php echo round($fetc_pro_row2['id']); ?>">
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
                                                <div class="QTY-sec input-group button-group cartqty<?php echo round($fetc_pro_row2['id']); ?>" style="position: inherit;">
                                                    
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
                                                            <a style="font-weight: 700; background: #84c225; color: #ffffff;    padding: 1px 10px 1px 10px;border-radius: 50%;" onclick="quantity(<?php echo $basketrows['id']; ?>,<?php echo round($fetc_pro_row2['id']); ?>,'minus');" href="javascript:void(0)" > -</a>  
                                                            <input type="text" size="1" value="<?php echo $basketrows['quantity']; ?>" name="quantity[40]" class="tradzeal-qty-input" style="text-align:center;width: 120px;height: 20px;" readonly>
                                                            <a style="font-weight: 700; background: #84c225; color: #ffffff;    padding: 1px 9px 1px 9px;border-radius: 50%;" onclick="quantity(<?php echo $basketrows['id']; ?>,<?php echo round($fetc_pro_row2['id']); ?>,'add');" href="javascript:void(0)" > + </a> 
                                                            
                                                        </div>
                                                         
                                                        <?php } else { ?>
                                                        
                                                        <label class="control-label">Qty</label>
                                                        <input type="number" name="quantity" min="1" value="1"  step="1" class="qty form-control quantity<?php echo round($fetc_pro_row2['id']); ?>">
                                                        <button type="button" onclick="addtocart(<?php echo round($fetc_pro_row2['id']); ?>);"  class="addtocart pull-right">Add</button>
                                                        
                                                        <?php } ?> 
                                                    <?php } else { ?>
                                                        <div class="center">
                                                            <p style="color:#84c225;">Out of Stock</p>   
                                                        </div> 
                                                    <?php } ?>
                                                    
                                                </div>
                                                <div class="loaderdiv<?php echo round($fetc_pro_row2['id']); ?>" style="text-align: center;display: none;"><span  style=""><img style="height:20px;width:20px;text-align-center;" src="<?php echo URL; ?>/assets/images/loader.gif"   ></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>  
                            <?php if($z == 5) { ?>
                            
                            <?php } ?>
                    <?php } $z++; }  } ?>     
            
            
            
          </div>

        </div>
      </div>
      <!-- =====  featured section end ===== -->


      <div class="category_product section category_product2 mt-30">
        <div class="row">
          <div class="col-12">
            <div class="section_title">Grocery & Staples</div>
          </div>
             
            
          <div class="col-sm-9 left_block">
            <div class="row">
                <?php   
                $sql5=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Grocery & Staples' order by id asc limit 0,6");
                $num5=mysqli_num_rows($sql5); 
                if($num5 > 0)
                { 
                    $j = 0;
                while($rowsbanner5=mysqli_fetch_assoc($sql5))
                {
                ?>    
                    <div class="product-layout col-lg-4 col-md-4 col-sm-4 col-6">
                        <div class="product-thumb transition">
                          <?php if($rowsbanner4['description'] !=  ''){ ?><p class="tag"><?php echo $rowsbanner5['description']; ?><br> % <br> <i>off</i></p><?php } ?>
                          <h4><a href="<?php echo $rowsbanner5['externallink']; ?>"><?php echo $rowsbanner5['bannername']; ?></a></h4>
                          <div class="image"><a href="<?php echo $rowsbanner5['externallink']; ?>"><img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner5['uploadimage']; ?>" alt="<?php echo $rowsbanner5['bannername']; ?>" title="<?php echo $rowsbanner5['bannername']; ?>" class="img-thumbnail"></a></div>
                        </div>
                    </div> 
                <?php $j++;  } } ?>  
            </div>
            </div>
            <?php    
            $sql6=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Grocery & Staples Right' order by id asc limit 0,1"); 
            while($rowsbanner6=mysqli_fetch_assoc($sql6))
            {
            ?>   
                <div class="col-sm-3 productcategory_thumb right_block text-center mb-15"> <img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner6['uploadimage']; ?>" alt="" title="" class="img-thumbnail"> </div>
            <?php  } ?>  
          <div class="col-sm-12 text-center">
            <div class="btn btn-primary viewall"><a href="#">View All</a></div>
          </div>
        </div>
      </div>

      <!-- =====  PRODUCT section  END ===== -->

      <!-- =====  Brand start ===== -->
     <!-- <div id="brand_carouse" class="section text-center mt-30 pb-15">
        <div class="row">
          <div class="col-12">
            <div class="section_title">Our Popular Brands</div>
          </div>
          <div class="col-sm-12">
            <div class="brand owl-carousel">
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand1.png" alt="Disney" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand2.png" alt="Dell" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand3.png" alt="Harley" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand4.png" alt="Canon" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand5.png" alt="Canon" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand6.png" alt="Canon" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand7.png" alt="Canon" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand8.png" alt="Canon" class="img-responsive" /></a> </div></div>
              <div class="product-thumb"><div class="item text-center"> <a href="#"><img src="<?php echo URL; ?>/assets/images/brand/brand9.png" alt="Canon" class="img-responsive" /></a> </div></div>
            </div>
          </div>
        </div>
      </div>-->
      <!-- =====  Brand end ===== -->



    </div>
    <!-- =====  CONTAINER END  ===== -->

 