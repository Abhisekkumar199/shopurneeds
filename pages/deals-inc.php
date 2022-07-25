<?php  
function imp_change($v)
{
	$str_func = $_GET[strtolower($v)];
	$url1 = explode(",",$str_func);
    return( count($url1) > 0 ? implode(',',$url1) : $url1[0]);
}
     $url_str = $_SERVER['REQUEST_URI'];
     $url_ary = explode("&",$url_str);
     //echo $url_ary[1];
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () { 
 
    $(document).on('change','.sort_rang',function(){
    	 var datastring = $("#search_form").serialize();
    	 var length = datastring.length;  
    	  
    	  if(length > 13){
    	 window.location.href = "<?php echo 'https://'.$_SERVER['SERVER_NAME'].''.$url_ary[0]; ?>&"+datastring;
    	  } 
    	  else{ 
    	 window.location.href = "<?php echo 'https://'.$_SERVER['SERVER_NAME'].''.$url_ary[0]; ?>";
    	  } 
    }); 
 
    $(".inner-filter").click(function(){
        $(".left-cat").toggleClass("opened");
    });
});
</script>
<?php

$sqldeal=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."deal where id='".$_REQUEST['str']."'")); 
$skuids = explode(",",$sqldeal['products']);
$skuids = implode("','",$skuids);   
$discount_percentage = $sqldeal['percentage']; 
  
 
	
 
 
 
// brand filter 
$brand = (!empty($_GET['brand'])) ? " and bid IN(".implode(",",$_GET['brand']).")" : ""; 

// color filter
$color1 = $_GET['color'];
if($color1!='') 
{
	foreach ($color1 as $value) 
	{ 
		if($value!="")
		{ 
			$pp112 .="  color like '%$value%' or ";
		}
	}
	$color_filter=" and (".substr($pp112,0,-3).")";
} 	  	




// size filter
$size1 = $_GET['size'];
if($size1!='') 
{ 
	$size = "'".implode("','", $_GET['size'])."'";
	$size11 = ($size != '') ? " and product_size IN(".$size.")" : ""; 
}


$shopbyinventory1 = $_GET['shopbyinventory'];
if($shopbyinventory1=="Immediate-Shipment")
{
	$ishment=" and (qty_stock!=0 or qty_rto!=0 or qty_cmnt!=0)";
}
else if($shopbyinventory1=="Made-On-Order")
{
	$ishment=" and qty_bo!=0";
}
else
{
	$ishment="";
}	
$finalproids=$range123;

if($_REQUEST['size']!='') 
{		
	$productsizesql = mysqli_query($conn,"select distinct product_id from ".$sufix."product_size where displayflag='1' $size11 $ishment $rangesize123");
}
else 
{
	if($shopbyinventory1!="")
	{
		$productsizesql = mysqli_query($conn,"select distinct product_id from ".$sufix."product_size where displayflag='1' $ishment $rangesize123");
	}
}
$sizenum233=mysqli_num_rows($productsizesql);
if($sizenum233>0)
{
	while($rowssize = mysqli_fetch_assoc($productsizesql)) 
	{
		$sizerows23 .= $rowssize['product_id'].',';
	}		
	$sizerows34 = substr($sizerows23,0,-1);	 
	$rangesize23 ="and id in($sizerows34)";	
	$finalproids=$rangesize23; 
}
else 
{
	if($_REQUEST['size']!='') 
	{	 
		$finalproids=" and id =''";
	}
	if($shopbyinventory1!="")
	{ 
		$finalproids=" and id =''";
	} 
} 

// attribute filter 
$atr_val_id = implode(',',$_REQUEST['atr_val_id']);

if($atr_val_id!='')
{ 
	$sql_attr = mysqli_query($conn,"select distinct pid from ".$sufix."product_attribute where atr_val_id='".$atr_val_id."'");
	$i=1;
	while($rows_attr=mysqli_fetch_array($sql_attr))
	{
		$attr_prod_ids .=$rows_attr['pid'].","; 
	}
	$attr_prod_ids=substr($attr_prod_ids,0,-1);
    $attribute_filter = "and id IN ($attr_prod_ids)";
}	

// min price filter	 
if($_REQUEST['minprice']!="")
{
	$mindssa=floor($_REQUEST['minprice']/$_SESSION['conratio']);
	$minprss1=" and sellingprice >= ".$mindssa;
}

// max price filter
if($_REQUEST['maxprice']!="")
{
	$maxdssa=floor($_REQUEST['maxprice']/$_SESSION['conratio']);
	$maxprss1=" and sellingprice <= ".$maxdssa;
}

// discount filter
if($_REQUEST['discountpr'] != '')
{
	$discountpr = "and discountper ".$_REQUEST['discountpr'];
} 

// gender filter
if($_REQUEST['gender'] != '')
{
	$gender1 = " and gender ='".$_REQUEST['gender']."'";
} 

// order by filter   
$orderby= isset($_GET['sort']) ? $_GET['sort'] : "ORDER BY id DESC"; 


$minquery=mysqli_fetch_array(mysqli_query($conn,"select sellingprice from ".$sufix."product where displayflag='1' $range123 order by sellingprice asc limit 1"));
$minvalue=floor($minquery['sellingprice']*$_SESSION['conratio']);
$maxquery=mysqli_fetch_array(mysqli_query($conn,"select sellingprice from ".$sufix."product where displayflag='1' $range123 order by sellingprice desc limit 1"));
$maxvalue=floor($maxquery['sellingprice']*$_SESSION['conratio']);
$sqlcatname=mysqli_query($conn,"select * from ".$sufix."category where cat_id='".$cat_id."'");
$cat_details=mysqli_fetch_array($sqlcatname);
  

$sql_pro="select * from ".$sufix."product where displayflag='1' and vartype='' and master_sku in ('".$skuids."') {$brand} {$color_filter} {$attribute_filter}  {$minprss1} {$maxprss1} {$discountpr} {$gender1}  {$orderby} "; 
$product_query = mysqli_query($conn,$sql_pro);
$get_total_rows = mysqli_num_rows($product_query);

$sql_product .= $sql_pro."limit 0,24";   
$inc = 0;
$pcount=0;
$i="1";
$items_per_group = 6; 
$total_groups= floor($get_total_rows/$items_per_group); 
    
?> 

<!-- =====  BREADCRUMB STRAT  ===== -->
    <div class="breadcrumb section pt-60 pb-60">
      <div class="container">
        <h1 class="uppercase"><?php echo $sqldeal['name']; ?></h1>
        <ul>
            <li><a href="<?php echo URL; ?>"><i class="fa fa-home"></i></a></li> 
        </ul>
      </div>
    </div>
    <!-- =====  BREADCRUMB END===== -->
    <div class="product-section section mt-30">
    <!-- =====  CONTAINER START  ===== -->
    <form role="form" id="search_form" method="get" style="width:100%;" >
    <div class="container">
        
      <div class="row">
          
        <div id="column-left" class="col-lg-3 col-xl-3 col-sm-4">
            
            <?php
            $sql=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$cat_id."' and displayflag='1'   order by sortid asc");
            if(mysqli_num_rows($sql) > 0)
            {
            ?> 
                <div id="category-menu" class="mb-30 mt-10">
                    <div class="nav-responsive">
                        <div class="heading-part">
                            <h3 class="section_title">Category</h3>
                        </div>
                        <ul>
                        <?php	 
                        while($rows=mysqli_fetch_assoc($sql))
                        {
                        ?>  
                            <li><a href="<?php echo URL;?>/<?php echo $rows['cat_slug']; ?>"><?php echo $rows['categoryname']; ?></a> </li> 
                        <?php  } ?> 
                        </ul>
                    </div>
                </div> 
            <?php } ?>
            
          
          <div class="filter left-sidebar-widget mb-50"> 
            <div class="filter-block">
              <!--<p>
                <label for="amount">Price range:</label>
                <input type="text" id="amount" readonly>
              </p>--> 
              
              
              <div class="list-group">
                  
                    <?php
                    $sqlsize = mysqli_query($conn,"select distinct product_size from ".$sufix."product_size where 1=1 $rangesize123 order by product_size asc");
                    if(mysqli_num_rows($sqlsize) > 0)
                    {
                    ?> 
                        <div class="list-group-item mb-10">
                            <label>Packet Size</label>
                            <div id="filter-group1">  
                            <?php 
                            $i=1;
                            while($sizerosa = mysqli_fetch_assoc($sqlsize)) { 	
                            ?>    
                                <div class="checkbox">
                                  <label> <input id="size<?php echo $i; ?>" value="<?php echo $sizerosa['product_size']; ?>"  <?php if(in_array($sizerosa['product_size'],$_REQUEST['size'])) { echo "checked='checked'"; } ?> type="checkbox" class="sort_rang"> <?php echo $sizerosa['product_size']; ?></label>
                                </div>
                            <?php  $i++; } ?>      
                            </div>
                        </div> 
                    <?php } ?> 
                    
                    <?php 
                        $sqlpbrand = mysqli_query($conn,"select distinct bid from ".$sufix."product where 1=1 $range123");
                        $i=1;
                        while($rowpbrand=mysqli_fetch_array($sqlpbrand))
                        {
                        $bidssa .=$rowpbrand['bid'].","; 
                        }
                        $bidsas12=substr($bidssa,0,-1);
                        $sqlbrand = mysqli_query($conn,"select * from ".$sufix."brand where displayflag='1' and bid in ($bidsas12) order by brandname asc");
                        if(mysqli_num_rows($sqlbrand) > 0)
                        {
                    ?>
                        <div class="list-group-item mb-10">
                            <label>Brands</label>
                            <div id="filter-group3"> 
                                <?php 
                                while($brandrows = mysqli_fetch_assoc($sqlbrand)) 
                                { 	
                                ?>
                                    <div class="checkbox">
                                        <label> <input class="sort_rang" id="brand<?php echo $brandrows['bid'];?>" name="brand[]" value="<?php echo $brandrows['bid'];?>"  <?php if(in_array($brandrows['bid'],$_REQUEST['brand'])) { echo "checked='checked'"; } ?>type="checkbox"> <?php echo $brandrows['brandname'];?> </label>
                                    </div> 
                                <?php $i++; }  ?> 
                            </div>
                        </div>
                    <?php } ?>
                    
                    
                    
                    <?php   
                    $sql_category=mysqli_fetch_assoc(mysqli_query($conn,"select attribute from ".$sufix."category   where cat_id='".$cat_id."'"));
                    $attribute_ids = $sql_category['attribute'];
                    $sql_attr  = mysqli_query($conn,"select * from ".$sufix."attributes where atr_id IN (".$attribute_ids.")");
                    
                    while($rows_attr = @mysqli_fetch_assoc($sql_attr))
            		{
    		        ?>
    		            <div class="list-group-item mb-10">
                            <label><?php echo $rows_attr['attributename']; ?></label>
                            <div id="filter-group3"> 
                                <?php
            					$sql_atr_val  = mysqli_query($conn,"select atr_val_id,attributevaluename from ".$sufix."attributevalue where atr_id='".$rows_attr['atr_id']."' and displayflag='1' order by attributevaluename ASC") ;
            					while($rows_atr_val= mysqli_fetch_assoc($sql_atr_val))
            					{
        					    ?>
                                    <div class="checkbox">
                                        <label> <input class="sort_rang" id="atr_val_id<?php echo $rows_atr_val['atr_val_id'];?>" name="atr_val_id[]" value="<?php echo $rows_atr_val['atr_val_id'];?>"  <?php if(in_array($rows_atr_val['atr_val_id'],$_REQUEST['atr_val_id'])) { echo "checked='checked'"; } ?> type="checkbox"> <?php echo $rows_atr_val['attributevaluename']; ?></label>
                                    </div> 
                                <?php $i++; }  ?> 
                            </div>
                        </div> 
            		<?php }  ?>	
                    
                            
              </div>
            </div>
          </div>
          <!--<div class="left_banner left-sidebar-widget mb-50"> <a href="#"><img src="<?php echo URL; ?>/assets/images/left1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>-->
        </div>
        <div class="col-lg-9 col-xl-9 col-sm-8">
            <div class="category-page-wrapper mb-15 pb-10">
                <div class="row" style="float: right;">  
                    <div class="col-md-auto sort-wrapper order-11 pull-right">
                        <label class="control-label" for="input-sort">Sort By :</label>
                        <div class="sort-inner">
                            <select id="input-sort" class="form-control sort_rang">
                                <option  value="ORDER BY sellingprice ASC" <?php echo ($_GET['sort'] == "ORDER BY sellingprice ASC") ? "selected" : "" ?>>Price: Low to High</option>
                                <option  value="ORDER BY sellingprice DESC" <?php echo ($_GET['sort'] == "ORDER BY sellingprice DESC") ? "selected" : "" ?>>Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="results">
                <?php 
				$rewsss = mysqli_query($conn,$sql_product);
				if(mysqli_num_rows($rewsss)>0) 
				{
                    $z = 1;
                while($fetc_pro_row2=mysqli_fetch_array($rewsss))
                {  
                    $query_supplier = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."suppliers`   where id='".$fetc_pro_row2['seller_id']."'"));
                    if($fetc_pro_row2['gst'] > 0) 
                    { 
                        $gstamount = $fetc_pro_row2['sellingprice']*$fetc_pro_row2['gst']/100;
                    }
                    else
                    {
                        $gstamount = '';
                    }
                    
                    $sellingprice=$fetc_pro_row2['sellingprice'] + $gstamount; 
                    $mrpprice = $fetc_pro_row2['mrp'] + $gstamount;
                    $master_sku=$fetc_pro_row2['master_sku'];
                    $selimage2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$fetc_pro_row2['id']."' and mainimage='1'")); 
                    $selimage3 = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$fetc_pro_row2['id']."' and mainimage='0'")); 
                    if($selimage2['productimage']!= '') 
                    { 
                ?>
                    <?php
                        $pro_id = $fetc_pro_row2['id'];	 
        		 		$sql_deal =mysqli_query($conn,"select * from ".$sufix."deal where start_date <='".$_SESSION["current-date"]."' and end_date >='".$_SESSION["current-date"]."' and start_time <=  '".$_SESSION["current-time"]."' and 0 < FIND_IN_SET('$pro_id',products) "); 
                        if(mysqli_num_rows($sql_deal) > 0)
                        {
                            $rows_deals = mysqli_fetch_assoc($sql_deal);
                            $discount_percentage = $rows_deals['percentage'];  
                            $discount_amount = ($mrpprice*$discount_percentage)/100;
                            $sellprice2=$mrpprice-$discount_amount; 
                            $price_sell = ''.Currency.''.floor($sellprice2*$_SESSION['conratio']).'&nbsp;';  
                        }
                        else
                        { 
            		 	 	$sqlcoupan=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$master_sku%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='0' order by codeid desc"); 
            				$sqlcoupan2=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$master_sku%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='2' order by codeid desc");
            				$cashbacknum = mysqli_num_rows($sqlcoupan2); 
            				if(mysqli_num_rows($sqlcoupan)>0) 
                        	{
                        		$rowcoupan = mysqli_fetch_assoc($sqlcoupan);
                                $rowcoupanvalue1 = ($mrpprice*$rowcoupan['discountvalue'])/100;
                                $sellprice2=$mrpprice-$rowcoupanvalue1; 
                                $price_sell = ''.Currency.' '.floor($sellprice2*$_SESSION['conratio']).''; 
                        	} 
                        	else if($cashbacknum>0) 
                        	{
                        		$rowcoupan = mysqli_fetch_assoc($sqlcoupan2);
                        		$rowcoupanvalue1 = ($sellingprice*$rowcoupan['discountvalue'])/100;  
                                $price_sell = ''.Currency.' '.floor($sellingprice*$_SESSION['conratio']).'';
                        	} 
                        	else 
                        	{  
                                $price_sell = ''.Currency.' '.floor($sellingprice*$_SESSION['conratio']).'';  
                        	} 
                        }
                        ?>  
                            <div class="product-layout  product-grid col-lg-3 col-6 ">
                                <div class="item">
                                    <div class="product-thumb transition">
                                        <div class="image">
                                            <div class="first_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"> <img style="height: 221px;"  src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage2['productimage']; ?>"   class="img-responsive"> </a> </div>
                                            <div class="swap_image"> <a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php if($selimage3['productimage'] != '') { ?> <img style="height: 221px;"  src="<?php echo URL;  ?>/uploads/productimage/thumb/<?php echo $selimage3['productimage']; ?>"  class="img-responsive"><?php } ?> </a></div>
                                        </div>
                                        <div class="product-details">
                                            <div class="caption">
                                                <h4><a href="<?php echo URL; ?>/<?php echo $fetc_pro_row2['slug']; ?>"><?php echo substr($fetc_pro_row2['productname'], 0, 25);  ?></a></h4> 
                                                <div class="clearfix"></div>
                                                <?php $sqlsize = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc limit 1");  
                                                if(mysqli_num_rows($sqlsize) > 0)
                                                {
                                                    $rowssize = mysqli_fetch_assoc($sqlsize);
                                                    $discount_amount = ($rowssize['product_mrp']*$discount_percentage)/100;
                                                    $sellprice=$rowssize['product_mrp']-$discount_amount;
                                                ?>
                                                <div class="row" style="    margin: 2px;">
                                                <span class="price-tax col-md-5" style="font-size: 13px;padding: 0px;"> <?php echo $rowssize['product_size']; ?></span>   <span class="col-md-3" style="color: #ffffff;background-color: #84c225;padding: 0px;font-size: 10px;"><?php echo $discount_percentage; ?> % off</span> <p class="price col-md-4 text-right" style="padding: 0px;"><?php echo Currency." ".$sellprice; ?></p>
                                                </div>
                                                <?php } else { ?>
                                                <p class="price"><?php echo $price_sell; ?> </p>
                                                <?php } ?>
                                                <div class="product_option">
                                                    <div class="form-group required ">
                                                      <select   id="input-option231" class="form-control selectsize<?php echo floor($fetc_pro_row2['id']); ?>">
                                                        <option value=""> --- Please Select --- </option>
                                                        <?php $sqlsize1 = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$fetc_pro_row2['id']."' order by id desc"); 
                                                            $x = 1;
                                                            $sellprice1 = '';
                                                            while($rowssize1 = mysqli_fetch_assoc($sqlsize1))
                                                            {
                                                                 $discount_amount1 = ($rowssize1['product_mrp']*$discount_percentage)/100;
                                                                $sellprice1=$rowssize1['product_mrp']-$discount_amount1;
                                                                
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
                <script type="text/javascript">
                    $(document).ready(function() {
                    var track_load = 1;  
                    var loading  = false; 
                                             
                    var total_groups = <?=$total_groups;?>;
                    var sql = "<?=$sql_pro;?>"; 
                    $(window).scroll(function() { //detect page scroll
                    
                    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) 
                    { 
                        if(track_load <= total_groups && loading==false)  
                        { 
                            loading = true;  
                            $('.animation_image').show();   
                            $.post("<?php echo URL ?>/process/autoload_process.php",{'group_no': track_load,'sql':sql}, function(data){  
                                    
                                   $("#results").append(data);  
                                
        
                                
                                $('.animation_image').hide();  
                                track_load++;   
                                loading = false; 
                            }).fail(function(xhr, ajaxOptions, thrownError) {   
                            alert(thrownError); 
                            $('.animation_image').hide(); 
                            loading = false;
                            
                            });
                        
                        }
                    }
                    });
                });
                </script>  
                <div class="clearfix"></div>
                <div class="animation_image" style="display:none;text-align:center;" align="center"><img style="height: 75px;" src="<?php echo URL;?>/loader.gif"></div>

        </div>
      </div>
    </div>
    </fonr>
    <!-- =====  CONTAINER END  ===== -->