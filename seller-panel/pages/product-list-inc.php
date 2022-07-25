<?php
if(@$_REQUEST['pcat']!='' && $_REQUEST['proidd']!='' && $_REQUEST['id']!='') 
{ 
    $del111 = mysqli_query($conn,"delete from ".$sufix."product_cat where id='".$_REQUEST['id']."' and pid='".$_REQUEST['proidd']."' and cat_id='".$_REQUEST['pcat']."'");
?>
<script>window.location.href='<?php echo $_SERVER['HTTP_REFERER'];?>';</script>
<?php
}
if($_REQUEST['productidd']!='') 
{
    $delcat1 = mysqli_query($conn,"delete from ".$sufix."product where id='".$_REQUEST['productidd']."'");
}

if($_REQUEST['catid']=="")
{
	$catid="0";
}
else
{
	$catid=$_REQUEST['catid'];
} 
$sql="select * from ".$sufix."product";
 
    
    if($_REQUEST['search_text']!='') 
	{
		$fieldlike=$_REQUEST['search_text'];
        $search_text="	and	(sku like '%$fieldlike%' or	productname like '%$fieldlike%' or	id like '%$fieldlike%' or master_sku like '%$fieldlike%') ";
	}
	
	
	
	if($_REQUEST['sellerid']!='') 
	{
        $productquery = mysqli_query($conn,"select * from ".$sufix."product where seller_id='".$_REQUEST['sellerid']."'");
        if(mysqli_num_rows($productquery)>0) 
        { 
        while($productrows = mysqli_fetch_assoc($productquery)) 
        {
        	$productid .= $productrows['id'].',';
        }
            $productid = substr($productid,0,-1);
        	$seller_filter =" and id IN($productid)";
        }
	}
	
	if($_REQUEST['brandid']!='') 
	{
        $brand_filter=" and bid='".$_REQUEST['brandid']."'";
	}
	
	if($_REQUEST['pricerange']!='') 
	{
        $price_filter =" and sellingprice between ".$_REQUEST['pricerange'];
	}
	
	if($catid > 0)
	{
	    $parent = $catid;
	    
	    function get_categories_filter($parent = 0)
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
                    $html .= get_categories_filter($current_id);
                }
                $html .= '';
            }
            $html .= '';
            return $html;
        }
        $catlistcomma= get_categories_filter($catid); 
    	  $catlistfinal=$catlistcomma.''.$catid; 
    	 
        $product_cat_query = mysqli_query($conn,"select distinct pid from ".$sufix."product_cat where displayflag='1' and cat_id in (".$catlistfinal.")");
        while($rows_product_cat = mysqli_fetch_assoc($product_cat_query)) 
        {
            $product_ids .= $rows_product_cat['pid'].',';
        }
        $product_ids = substr($product_ids,0,-1);
          $category_filter ="and id in($product_ids)";  
	}
	else
	{
	    $parent = 0 ; 
	}
	
 
		
	if($_REQUEST['sdate']!='' && $_REQUEST['edate']!='')
	{
        $hold = $_REQUEST['sdate'];
        $hold1 = $_REQUEST['edate'];
        $startorderdate = date("Y-m-d",strtotime($hold)); 
        $endorderdate = date("Y-m-d",strtotime($hold1));
        $date1= " and adddate BETWEEN '".$startorderdate."' AND '".$endorderdate."'";
	} 
	
	$sql .=" where id!='' and vartype='' and seller_id='".$_SESSION['sellerid']."' {$search_text} {$seller_filter} {$brand_filter} {$price_filter} {$category_filter}  {$date1}  ";	
 

  $sql .= " order by id desc ";
$sql1=mysqli_query($conn,$sql);
$num2=mysqli_num_rows($sql1);	
if($num2>0)
{
	$num=$num2;
} 
$offset = 50;
$display_range = 10;
if($_REQUEST['page'] == '')
{
    $page = 1;
}
else
{
    $page = $_REQUEST['page'];
}
$no_page = max(1,ceil($num/$offset));
$pager=$pager->getPagerData($no_page, $display_range, $page, $offset); 
$result=mysqli_query($conn,$sql." LIMIT $pager->offset, $offset");	
?>
<?php
function get_categories($parent = 0)
{
	global $conn;
    $html = '';
    @$query = mysqli_query($conn,"SELECT * FROM `shopurneeds_category` WHERE `parent` = '$parent'");
	if(mysqli_num_rows($query) >0)
	{
    while($row = mysqli_fetch_assoc(@$query))
    {
        $current_id = $row['cat_id'];
        $html .= $row['cat_id'].',';
        $has_sub = NULL;
        $has_sub = mysqli_num_rows(mysqli_query($conn,"SELECT COUNT(`parent`) FROM `shopurneeds_category` WHERE `parent` = '$current_id'"));
        if($has_sub)
        {
            $html .= get_categories($current_id);
        }
        $html .= '';
    }
	}
    $html .= '';
    return $html;
}
function cagegory_breadcrumbs($id, $category_tbl, $except = null) 
{
	global $conn;
    $s = "SELECT * FROM ".$category_tbl." WHERE cat_id = $id";
    $r = mysqli_query($conn,$s);
    $row = mysqli_fetch_array($r);
	$cat_slug = $row['cat_slug'];
    if($row['parent'] == 0) {
        $name = $row['categoryname'];
		$curl = URL;  
        return $name." > ";
    } else {
        $name = $row['categoryname'];
        if(!empty($except) && $except == $name)
            return cagegory_breadcrumbs($row['parent'],$category_tbl, $except)." ".$name;
        }
        return cagegory_breadcrumbs($row['parent'],$category_tbl, $except). " ".$name." >";
}
function get_categories1($parent = 0)
{
	global $conn;
    $html = '';
    $query = mysqli_query($conn,"SELECT * FROM `shopurneeds_category` WHERE `parent` = '$parent'");
    while($row = mysqli_fetch_assoc($query))
    {
        $current_id = $row['cat_id'];
        $html .= $row['cat_id'].',';
        $has_sub = NULL;
        $has_sub = mysqli_num_rows(mysqli_query($conn,"SELECT COUNT(`parent`) FROM `shopurneeds_category` WHERE `parent` = '$current_id'"));
        if($has_sub)
        {
            $html .= get_categories1($current_id);
        }
        $html .= '';
    }
    $html .= '';
    return $html;
}
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
        return $name." > ";
    } 
    else 
    {
        $name = $row['categoryname'];
        if(!empty($except) && $except == $name) 
        {
            
              cagegory_breadcrumbs1($row['parent'],$category_tbl, $except)." ".$name;
        }
    }
    return cagegory_breadcrumbs1($row['parent'],$category_tbl, $except). " ".$name." >";
}
?>

        <!-- ############ Content START-->
        <div id="content" class="flex">
            <!-- ############ Main START-->
            <div>
                <div class="page-hero page-container" id="page-hero">
                    <div class="padding d-flex">
                        <div class="page-title">
                            <h2 class="text-md text-highlight">Total <?php echo $num2; ?> Products</h2></div>
                        <div class="flex"></div> 
                        
                        <div><a href="add-product" class="btn w-sm mb-1 btn-primary">Add Product</a></div>
                    </div>
                </div>
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="mb-5">
                            <div class="toolbar"> 
                                <form class="flex" method="get">
                                    
                                    <div class="row">
                                        <div class="col-md-12"> 
                                        <label><?php if($catid > 0) { ?>
                                            Selected Category : <a href='product-list'><i class="fa fa-home" aria-hidden="true"></i></a> > 
                                            <?php  
                                            $cagegory_breadcrumbs = '';
                                            function cagegory_breadcrumbs2($id, $category_tbl, $except = null) 
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
                                            		return "<a href='product-list?catid=$id'>".$name."</a> >";
                                            	} 
                                            	else 
                                            	{
                                            		$name = $row['categoryname'];
                                            		if(!empty($except) && $except == $name)
                                            		return cagegory_breadcrumbs2($row['parent'],$category_tbl, $except)." ".$name;
                                            	}
                                            	return cagegory_breadcrumbs2($row['parent'],$category_tbl, $except). " <a   href='product-list?catid=$id'>".$name."</a> >";
                                            } 
                                            $cagegory_breadcrumbs1 = cagegory_breadcrumbs2($catid,'shopurneeds_category',$except = null);
                                            echo $cagegory_breadcrumbs = substr($cagegory_breadcrumbs1,0, -1);
                                            } ?>
                                        </label>
                                        <br> 
                                        </div>
                                        <div class="col-md-3">
                                            <?php  
                                                echo $_SESSION['message']; 
                    	                        unset($_SESSION['message']); 
                    	                    ?>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="input-group col-md-2" style="padding-right: 4px;padding-left: 4px;">
                                            <select class="custom-select  " name="catid" onchange="this.form.submit()">
                                                <option value="">Select Category</option>
                                                <?php
                                                $sqlc=mysqli_query($conn,"select * from shopurneeds_category where categoryname != '' and parent='".$catid."'");
                                                while($rowc=mysqli_fetch_array($sqlc))
                                                {
                                                ?>						
                                                    <option value="<?php echo  $rowc['cat_id']; ?>"><?php echo $rowc['categoryname']; ?></option>						
                                                <?php } ?>	
                                            </select>
                                        </div>
                                        <div class="input-group col-md-3" style="padding-right: 4px;padding-left: 10px;">
                                            <input type="text" name="search_text" class="form-control form-control-theme form-control-sm search" placeholder="Search by product name, sku"   /> 
                                            
                                        </div>
                                     
                                        <div class="input-group col-md-2" style="padding-right: 4px;padding-left: 4px;">
                                            <select class="form-control" name="brandid">
                                                <option value="">Select Brand</option>
                                                <?php
                                                $brandquery = mysqli_query($conn,"select * from ".$sufix."brand where displayflag='1' order by brandname asc");
                                                while($brandrows = mysqli_fetch_assoc($brandquery)) {  ?>
                                                <option value="<?php echo $brandrows['bid'];?>" <?php if($_REQUEST['brandid']==$brandrows['bid']) { echo "selected='selected'";} ?>><?php echo $brandrows['brandname'];?></option>
                                                <?php } ?>
                                            </select> 
                                        </div>
                                        <div class="input-group col-md-2" style="padding-right: 4px;padding-left: 4px;">
                                            <select class="form-control" name="pricerange">
                                                <option value="">Price Range</option> 
                                                <option value="0 and 499" <?php if($_REQUEST['pricerange']=="0 and 499") { ?>selected="selected"<?php } ?>>0-499</option>
                                                <option value="500 and 999" <?php if($_REQUEST['pricerange']=="500 and 999") { ?>selected="selected"<?php } ?>>500-999</option>
                                                <option value="1000 and 1499" <?php if($_REQUEST['pricerange']=="1000 and 1499") { ?>selected="selected"<?php } ?>>1000-1499</option>
                                                <option value="1500 and 1999" <?php if($_REQUEST['pricerange']=="1500 and 1999") { ?>selected="selected"<?php } ?>>1500-1999</option>
                                                <option value="2000 and 2499" <?php if($_REQUEST['pricerange']=="2000 and 2499") { ?>selected="selected"<?php } ?>>2000-2499</option>
                                                <option value="2500 and 30000" <?php if($_REQUEST['pricerange']=="2500 and 30000") { ?>selected="selected"<?php } ?>>2500 and above</option> 
                                            </select> 
                                        </div>
                                        
                                        <div class="input-group col-md-1" style="padding-right: 4px;padding-left: 4px;">
                                              <span class="input-group-append"><button class="btn btn-white no-border btn-sm" type="submit"><span class="d-flex text-muted"><i data-feather="search"></i></span></button> </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <form name="product" method="post" action="#">
                            <div class="table-responsive">
                                <table class="table table-theme table-row v-middle">
                                    <thead>
                                        <tr>
                                            <th style="width:20px">
                                                <label class="ui-check m-0">
                                                <input type="checkbox" id="check"><i></i></label>
                                            </th>
                                            
                                            <th class="text-muted sortable">Seller</th>
                                            <th class="text-muted">Product</th>
                                            <th class="text-muted sortable" data-toggle-class="asc">Product Details</th>
                                            <th class="text-muted sortable" data-toggle-class="asc">Category</th>
                                            <th class="text-muted"><span class="d-none d-sm-block">Brand</span></th>
                                            <th class="text-muted" style="width:100px;"><span class="d-none d-sm-block">Size</span></th>
                                            <th class="text-muted" style="width:100px;"><span class="d-none d-sm-block">S.Price</span></th>
                                            <th class="text-muted"><span class="d-none d-sm-block">Qty</span></th> 
                                            <th style="width:50px">Act</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($num > 0)
											{ 
    											while($row=mysqli_fetch_array($result))
    											{
    												
    											@$produrows = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where master_pro_id='".$row['id']."' limit 1"));	
    											$productsize = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$row['id']."' order by id asc limit 1"));
										        $sqlimg=mysqli_query($conn,"select id,productimage from ".$sufix."imageupload where pid='".$row['id']."' order by  mainimage asc");
														 
												$count2=0;
												$total_image = mysqli_num_rows($sqlimg);
												while($row1= mysqli_fetch_array($sqlimg))
												{ 
                                                    $mainimage = $row1['productimage'];
													$num2=$row1['id'];
													$count2++;
												}
									    ?>
                                        <tr class="v-middle" data-id="15">
                                            <td>
                                                <label class="ui-check m-0">
                                                <input type="checkbox" class="allcheck"   name="product_id[]" value="<?php echo $row['id']; ?>" > <i></i></label>
                                            </td>
                                             <td class="flex"> 
                                                <div class="item-title text-color">
                                                <?php
                                                $sql_supplier=mysqli_fetch_array(mysqli_query($conn,"select suppliername,seller_slug from shopurneeds_suppliers where id='".$row['seller_id']."'"));    
                                                  
                                                ?>
                                                    Sold By: <a href="<?php  echo URL."/".$sql_supplier['seller_slug']; ?>" target="blank"> <?php  echo $sql_supplier['suppliername']; ?></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group web-1">
                                                    <?php
                                                    if($mainimage!='') 
                                                    {
									                    $image_name=$mainimage;
									                ?>
                                                        <a href="#" class="avatar ajax w-80" data-toggle="tooltip" title="Product Name"><img style="border-radius: 0px!important;" src="../uploads/productimage/thumb/<?php echo $image_name; ?>" alt="."></a> 
                                                    <?php } else { ?> 
                                                        <a href="#" class="avatar ajax w-80" data-toggle="tooltip" ><img style="border-radius: 0px!important;" src="../asset/img/missing.png" alt="."></a>
                                                    <?php } ?>
                                                     <a href="<?php echo URL; ?>/seller-panel/product-image.php?id=<?php echo $row['id']; ?>"><span class="web-2">+ <?php echo $total_image; ?> Images</span></a>
                                                </div>
                                            </td>
                                            <td class="flex"><a style="color:#448bff;" href="<?php echo URL;?>/<?php echo $row['slug'];?>" class="item-title text-color">UPID: <?php echo  $row['master_sku']; ?> <br> SKU: <?php echo  $row['sku']; ?><br> 
                                            <?php $product->name($row['variantproname'],$row['productname']); ?></a>
                                                 <?php
                                                $rowsaa=mysqli_fetch_array(mysqli_query($conn,"select brandname from shopurneeds_brand where bid='".$row['bid']."'"));  
                                                ?>
                                                <div class="item-title text-color"> <?php if($row['color'] != '') { ?> <?php echo $row['color']; }?> </div>
                                            </td>
                                            <td class="flex">
                                                 
                                                <?php
                                                $ppid = $row['id'];
                                                $selectcatsql = mysqli_query($conn,"select * from ".$sufix."product_cat where pid='".$ppid."' and displayflag='1'");
                                                while($selectrows = mysqli_fetch_assoc($selectcatsql)) 
                                                {  
                                                    if($selectrows['cat_id']!='') 
                                                    { 
                                                          $catid1 = $selectrows['cat_id'];                                                          
                                                    }	
                                                ?> 
                                                <?php } 
                                                        $cagegory_breadcrumbs = cagegory_breadcrumbs1($catid1,'shopurneeds_category',$except = null);
                                                        echo $cagegory_breadcrumbs = substr($cagegory_breadcrumbs,0, -1);  
                                                ?> 
                                                 
                                                  
                                            </td>
                                            
                                            <td><span class="item-amount d-none d-sm-block text-sm"> <?php  echo $rowsaa['brandname']; ?> </span></td>
                                              <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $productsize['product_size'];?></span></td>
                                                <td><span class="item-amount d-none d-sm-block text-sm">Rs <?php echo $productsize['product_sellingprice'];?></span></td> 
                                            <td><span class="item-amount d-none d-sm-block text-sm [object Object]"><?php echo $productsize['qty'];?></span></td>
                                            <td>
                                                
                                                <div class="item-action dropdown">
                                                    <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                        <?php if($row['displayflag']==1) { ?>
    													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=product-list.php&tb=<?php echo $sufix; ?>product&option=id">Disable</a> 
    													<?php } elseif($row['displayflag']==0) { ?>												
    														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?> &status=1&link=product-list.php&tb=<?php echo $sufix; ?>product&option=id">Enable</a>
    													<?php } ?>
    													
    														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=product-list.php&tb=<?php echo $sufix; ?>product&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
    													<a class="dropdown-item edit" href="edit-product.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                    </div>
                                                </div>
                                                 
                                            </td>
                                        </tr> 
                                        <?php } ?>
                                        <?php } ?>
                                        </tbody> 
                                </table>
                            </div>
                            <div class="d-flex">
                                <?php pagingall($offset,$num,'product-list.php',$page,$no_page,$display_range); ?> &nbsp;&nbsp;
                                <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">Delete</button> &nbsp;&nbsp;
                            </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- ############ Main END-->
        </div>
        <!-- ############ Content END-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
 
function sure(vr, ac)
{
    var product_check = $('input[name="product_id[]"]:checked').length; 
    if(product_check > 0)
    {  
    	var sur=confirm("Are you sure ! You want to delete records ?");
    	if(sur==true)
    	{ 
    		document.product.action='delete-records.php';
    		document.product.submit();
    		return true;
    	}
    	else
    	{
    		return false;
    	} 
    }
    else
    {
        alert("please select records!");
    }
}
$(document).ready(function(){ 
    $("#check").click(function(){  
        $(".allcheck").not(this).prop('checked', this.checked);
    });
});
</script>