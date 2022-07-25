 <link href="css/snpp.css" rel="stylesheet" type="text/css" />
<link href="css/brandcat.css"	rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#firstpane p.menu_head").click(function()
    {
		$(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(left.png)"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph
	$("#secondpane p.menu_head").mouseover(function()
    {
	     $(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings().css({backgroundImage:"url(left.png)"});
	});
});
</script>



<!--------------------------------Menu Hover--------------------------------->
<link href="css/menu-hover.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/menu-hover.js"></script>

 <div class="space20"></div>
     <div class="container"> <div class="row"> <section class="">
        <div class="flexslider" style="padding-left:10px; padding-right:10px;">
          <ul class="slides">
            <li>
  	    	    <img src="<?php echo URL; ?>/showroomimages/<?php echo $rowse['uploadimage2']; ?>" class="img-responsive" style="height:300px; width:1200px;" >
    		</li>
  	    	 <li>
  	    	    <img src="<?php echo URL; ?>/showroomimages/<?php echo $rowse['uploadimage3']; ?>" class="img-responsive"  style="height:300px; width:1200px;" >
    		</li>
             <li>
  	    	    <img src="<?php echo URL; ?>/showroomimages/<?php echo $rowse['uploadimage4']; ?>" class="img-responsive"  style="height:300px; width:1200px;" >
    		</li>
          </ul>
        </div>
      </section> </div> </div> 
      
      
    
	<!-- MASON WRAP -->
<section class="category-wrap" style="padding-bottom:30px;">
		<div class="container" style="padding-left:8px; padding-right:8px;">
        
        <div style="border:#d3cbb8 solid 1px;">
        
       <div class="row" style="background-color:#f7f7f7; padding:5px; margin-left:0px; margin-right:0px;" > <div class="col-sm-4"> &nbsp;</div> <div class="col-sm-8" align="right"></div>  </div> 
			<div class="row">
				<div class="category-products">
					<div class="container">
						<div class="row">
                        <div class="col-md-3 cw-right" style="padding-left:15px !important; width:20%;">
                              
                            
                            
                        
                        
								<div class="aside" style="padding-left:0px; padding-right:0px; padding-top:0px;">
									<div class="title" style="background-color:#CCC; padding:5px; color:#333; margin-left:5px; margin-right:5px;">
					<strong>Showroom Categories</strong>
						</div>
						<div class="aside" style="padding-bottom:0px; padding-top:10px;" >    
						<?php 
						$sqlcatseller=mysqli_query($conn,"select distinct(mc.cat_id) from `".$sufix."category` mc,`".$sufix."product` mp  where mc.cat_id=mp.cat_id and mc.displayflag='1' and seller_id='".$rowse['id']."' order by mc.sortid asc");
						
						while($rowcatseller=mysqli_fetch_array($sqlcatseller))
						{
						$catseller .=$rowcatseller['cat_id'].",";
						}
						$catseller1=substr($catseller,0,-1);
						$sql=mysqli_query($conn,"select * from `".$sufix."category`  where cat_id in ($catseller1) and displayflag='1' order by sortid asc") ;
	$num=$query->num($sql); 
	if($num > 0)
	{
		$catcount=1;
		while($rows=mysqli_fetch_assoc($sql))
		{
?>	
  <div id="firstpane" class="menu_list"> 
  
		<p class="menu_head" style="border-bottom:#CCC solid 1px;"><?php echo $rows['categoryname']; ?></p>
		<div class="menu_body">
		<?php 
			$sqlcatseller1=mysqli_query($conn,"select distinct(mc.cat_id) from `".$sufix."category` mc,`".$sufix."product` mp  where mc.cat_id=mp.subcat_id and mc.displayflag='1' and seller_id='".$rowse['id']."' and mc.parent='".$rows['cat_id']."' order by mc.sortid asc");
						while($rowcatseller1=mysqli_fetch_array($sqlcatseller1))
						{
						$catseller1333 .=$rowcatseller1['cat_id'].",";
						}
						$catseller11=substr($catseller1333,0,-1);
	$sql2=mysqli_query($conn,"select * from `".$sufix."category`  where cat_id in ($catseller11) and displayflag='1' order by sortid asc") ;	
		$num2=$query->num($sql2); 
		if($num2 > 0)
		{ //start condition for subcategory 
		?>
		<?php	
$xx="1";
while($rowsub=mysqli_fetch_assoc($sql2))
				{  //start loop for subcategory
				$lic="1";
				
			?>
        <p class="menu_head"><?php echo $rowsub['categoryname']; ?></p>
		<div class="menu_body">
		<?php 
		$sqlcatseller12=mysqli_query($conn,"select distinct(mc.cat_id) from `".$sufix."category` mc,`".$sufix."product` mp  where mc.cat_id=mp.subsubcat_id and mc.displayflag='1' and seller_id='".$rowse['id']."' and mc.parent='".$rowsub['cat_id']."' order by mc.sortid asc");
					$numrow232=mysqli_num_rows($sqlcatseller12);	
					if($numrow232>0)
					{
																		$catseller112="";

						while($rowcatseller12=mysqli_fetch_array($sqlcatseller12))

						{
						$catseller123331 .=$rowcatseller12['cat_id'].",";
						}
						$catseller112=substr($catseller123331,0,-1);
	$sql3=mysqli_query($conn,"select * from `".$sufix."category`  where cat_id in ($catseller112) and displayflag='1' order by sortid asc") ;	

		$num3=$query->num($sql3); 
		if($num3 > 0)
		{ //start condition for sub-subcategory 
?>
<?php 
$subsubcat=1;
$subcat2=1;
while($rowsubsub=mysqli_fetch_assoc($sql3))
{
?> 
		<a href="<?php echo URL; ?>/showroom-search.php?catid=<?php echo $rowsubsub['cat_id']; ?>&id=<?php echo $rowse['id']; ?>"><?php echo $rowsubsub['categoryname']; ?></a>
         
         <?php }} }?>
         </div>
		 <?php }} ?>
          		</div> 

         </div>
		       <?php }} ?>  

	
  
  
  
  
  
  
 </div>
								</div>
                 
                            </div>
							<div class="col-md-9  cw-left" style="width:80%;" >
							<?php

$pcount=0;
$i="1";
$sql=mysqli_query($conn,"select * from flip_product  where seller_id='".$rowse['id']."' Limit 16");
while($rowitem=mysqli_fetch_array($sql))

	{

	

	 if($rowitem['offername']!='') 

		 { 

			//echo "select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."'";

			$offerquery=mysqli_query($conn,"select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto >='".date("Y-m-d")."'");

			

			$numoffer=$query->num($offerquery);

			$rowoffer=mysqli_fetch_assoc($offerquery);

				

		 

		 }

if(($i=="1") || ($i=="5") || ($i=="9") || ($i=="13")) {

?>

        
			                
		<div class="row"><?php } ?>  <div class="col-sm-3"  style="padding-left:0px;"> <div class="product_grid_row">
       	<div style="box-shadow: none;" class="product_grid_cont hoverProdCont4Grid  prodheight prodGridLayout gridLayout4" >
          <div class="product_grid_box">     
    		 <div class="productWrapper">
             	 <div class="shippingImage" > &nbsp;</div>
             				 <div class="outerImg">
              					  <div  class=" product-image ">
               						 <a class="hit-ss-logger somn-track prodLink" href="<?php echo URL; ?>/<?php echo $rowitem['product_pagename']; ?>" > <img  src="<?php echo URL; ?>/uploads/productimage/thumb/<?php $product->productimage($sufix,$rowitem['id']) ; ?>" style="width:166px; height:176px;"  border="0"></a>
                                     </div>
             					</div>
              
              <div style="height: 135px;" class="hoverProductWrapper product-txtWrapper ">
                <div style="display: block;" class="product-title">
               		 <a class="hit-ss-logger somn-track hell prodLink" href="<?php echo URL; ?>/<?php echo $rowitem['product_pagename']; ?>" ><?php echo $product->substrword5($rowitem['productname'], 40); // ?></a></div>
               		 <a style="position: relative; top: 0px;"  class="hit-ss-logger somn-track prodLink" href="<?php echo URL; ?>/<?php echo $rowitem['product_pagename']; ?>" >
               				 <div style="display: block;" class="ratingsWrapper">
                  				<div class="ratingStarsSmall" style="background-position: 0px -90px;"></div>
                </div>
                
                </a>
                <div style="position: relative; top: 0px;" class="lfloat product_list_view_highlights">
             
                  <div class="product-price">
                  <div> 
                 
                   <?php if($rowitem['costprice']>$rowitem['sellingprice']) {
				 $pervalue=100-(($rowitem['sellingprice']*100)/$rowitem['costprice']);
				  ?>
                    <strike> <img src="<?php echo $url; ?>/images/rs01.PNG">  <?php echo $rowitem['costprice']; ?></strike> 
                   <s style=" color:#c93a0e;">(<?php echo intval($pervalue); ?>% off)   </s>
                   <?php } ?>
                    </div> 
             
              
                </div>
                <div>
                  Price <img src="<?php echo $url; ?>/images/rs01.PNG"> <span style=" color:#c93a0e; font-size:18px;" > <?php echo $rowitem['sellingprice']; ?> </span> </div>
                  </
                </div>
              </div>
            </div>
          </div>
        </div>
        
       </div></div>       </div>
        
			                
		
        

<?php $i=$i+1; } ?>

</div> 
       
								<!-- PAGE NAV -->
								
								<!-- PAGE NAV -->
							</div>

							<!-- SIDEBAR -->
							


						</div>
					</div>
				</div>
			</div>
		</div>
        
        </div>
        
        </div>
	</section>

