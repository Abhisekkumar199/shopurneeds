<?php  
function imp_change($v)
{
	$str_func = $_GET[strtolower($v)];
	$url1 = explode(",",$str_func);
    return( count($url1) > 0 ? implode(',',$url1) : $url1[0]);
}
$url_str = $_SERVER['REQUEST_URI'];
$url_ary = explode("&",$url_str);
     
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
    });
</script>
<?php
$clicksupdate = mysqli_query($conn,"update `".$sufix."category` set categoryclicks = categoryclicks+1 where cat_id='".$cat_id."'");

if($promotionIdfcat!=0)
{
    $sqlpromo=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."promotion where id='".$promotionIdfcat."'"));
    $upids1 = $sqlpromo['upids'];
    $endsasa=$sqlpromo['validto'];
    $updsas=str_replace(",","','",$upids1);
    $udssas="'".$updsas."'";
    $prodcatquery  = mysqli_query($conn,"select distinct id from ".$sufix."product where displayflag='1' and master_sku in (".$udssas.")");
    while($sqlidrows123 = mysqli_fetch_assoc($prodcatquery)) 
    {
        $sqlidtotalrows .= $sqlidrows123['id'].',';
    }
    $sqlidrowsprocat = substr($sqlidtotalrows,0,-1);
    $range123 ="and id in($sqlidrowsprocat)";
    $rangesize123 ="and product_id in($sqlidrowsprocat)"; 
}
else
{ 
    function get_categories($parent = 0)
    {
        global $conn;
        $html = ''; 
        $query = mysqli_query($conn,"SELECT * FROM `shopurneeds_category` WHERE `parent` = '$parent'");
        while($row = mysqli_fetch_assoc($query))
        { 
            $current_id = $row['cat_id'];
             $html .= $row['cat_id'].',';
            $has_sub = NULL;
            "SELECT COUNT(`parent`) FROM `shopurneeds_category` WHERE `parent` = '$current_id'";
            $has_sub = mysqli_num_rows(mysqli_query($conn,"SELECT COUNT(`parent`) FROM `shopurneeds_category` WHERE `parent` = '$current_id'"));
            if($has_sub)
            {
                $html .= get_categories($current_id);
            }
            $html .= '';
        }
        $html .= '';
        return $html;
    }
    $catlistcomma= get_categories($cat_id); 
	$catlistfinal=$catlistcomma.''.$cat_id;
	 
    $product_cat_query = mysqli_query($conn,"select distinct pid from ".$sufix."product_cat where displayflag='1' and cat_id in (".$catlistfinal.")");
    while($rows_product_cat = mysqli_fetch_assoc($product_cat_query)) 
    {
        $product_ids .= $rows_product_cat['pid'].',';
    }
    $product_ids = substr($product_ids,0,-1);
    $range123 ="and id in($product_ids)";
    $rangesize123 ="and product_id in($product_ids)"; 
	
}
 
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


 	
$finalproids=$range123;

if($_REQUEST['size']!='') 
{		
	$productsizesql = mysqli_query($conn,"select distinct product_id from ".$sufix."product_size where displayflag='1' $size11   $rangesize123");
	$sizenum233=mysqli_num_rows(@$productsizesql);
		if($sizenum233>0)
		{
			while($rowssize = mysqli_fetch_assoc($productsizesql)) 
			{
				$sizerows23 .= $rowssize['product_id'].',';
			}		
			$sizerows34 = substr($sizerows23,0,-1);	 
			$rangesize23 ="and id in($sizerows34)";	
			$finalproids = $rangesize23; 
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
}
else 
{
	if($shopbyinventory1!="")
	{
		$productsizesql = mysqli_query($conn,"select distinct product_id from ".$sufix."product_size where displayflag='1'   $rangesize123");
		
		$sizenum233=mysqli_num_rows(@$productsizesql);
		if($sizenum233>0)
		{
			while($rowssize = mysqli_fetch_assoc($productsizesql)) 
			{
				$sizerows23 .= $rowssize['product_id'].',';
			}		
			$sizerows34 = substr($sizerows23,0,-1);	 
			$rangesize23 ="and id in($sizerows34)";	
			$finalproids = $rangesize23; 
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
	}
}


$atr_val_id = '';
// attribute filter 
if($_REQUEST['atr_val_id'] != '')
{
	$atr_val_id = implode(',',$_REQUEST['atr_val_id']);
}

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
  

$sql_pro="select * from ".$sufix."product where displayflag='1' and vartype='' {$brand} {$color_filter} {$attribute_filter}  {$minprss1} {$maxprss1} {$discountpr} {$gender1} {$finalproids} {$orderby} "; 
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
        <h1 class="uppercase"><<?php echo $cat_details['categoryname']; ?></h1>
        <ul>
            <li><a href="<?php echo URL; ?>"><i class="fa fa-home"></i></a></li>
            <?php 
			function cagegory_breadcrumbs($id, $category_tbl, $except = null) 
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
					return cagegory_breadcrumbs($row['parent'],$category_tbl, $except)." ".$name;
				}
				return cagegory_breadcrumbs($row['parent'],$category_tbl, $except). " <li><a href='".URL."/".$row['cat_slug']."'>".$name."</a></li> ";
			} 
			$cagegory_breadcrumbs = cagegory_breadcrumbs($cat_id,'shopurneeds_category',$except = null);
			echo $cagegory_breadcrumbs = substr($cagegory_breadcrumbs,0, -1);
			?>
            
           
        </ul>
      </div>
    </div>
    <!-- =====  BREADCRUMB END===== -->
    <div class="product-section section mt-30">
    <!-- =====  CONTAINER START  ===== -->
    
    <div class="container">
        <form role="form" id="search_form" method="get" style="width:100%;" > 
        <div class="row"> 
        <div class="fliter_tab" style="display:none">Filter</div>
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
                                      <label> <input id="size<?php echo $i; ?>" value="<?php echo $sizerosa['product_size']; ?>" name="size[]"  <?php if(!empty($_REQUEST['size'])) { if(in_array($sizerosa['product_size'],$_REQUEST['size'])) { echo "checked='checked'"; } } ?> type="checkbox" class="sort_rang"> <?php echo $sizerosa['product_size']; ?></label>
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
                                            <label> <input class="sort_rang" id="brand<?php echo $brandrows['bid'];?>" name="brand[]" value="<?php echo $brandrows['bid'];?>"  <?php if(!empty($_REQUEST['brand'])){ if(in_array($brandrows['bid'],$_REQUEST['brand'])) { echo "checked='checked'"; } } ?>type="checkbox"> <?php echo $brandrows['brandname'];?> </label>
                                        </div> 
                                    <?php $i++; }  ?> 
                                </div>
                            </div>
                        <?php } ?>
                        
                        
                        
                        <?php   
                        $sql_category=mysqli_fetch_assoc(mysqli_query($conn,"select attribute from ".$sufix."category   where cat_id='".$cat_id."'"));
                        $attribute_ids = $sql_category['attribute'];
						if($attribute_ids != '')
						{
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
                		<?php } } ?>	
                        
                                
                  </div>
                </div>
                </div>
                
              <!--<div class="left_banner left-sidebar-widget mb-50"> <a href="#"><img src="<?php echo URL; ?>/assets/images/left1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>-->
            </div> 
            <div class="col-lg-9 col-xl-9 col-sm-8 cat_right_tab">
                <div class="category-page-wrapper mb-15 pb-10">
                    <div class="row" style="float: right;">  
                        <div class="col-md-auto sort-wrapper order-11 pull-right">
                            <label class="control-label" for="input-sort">Sort By :</label>
                            <div class="sort-inner">
                                <select id="input-sort" name="sort"  class="form-control sort_rang">
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
                                                                <div class="center QTY-sec">
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
        </form>
    </div>
    <script>
$(document).ready(function(){
  $(".fliter_tab").click(function(){
    $(this).toggleClass("main");
  });
});
</script>
    <!-- =====  CONTAINER END  ===== -->