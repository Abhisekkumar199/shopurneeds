<?php 
 
 
$sql="select *,p.id as product_id from ".$sufix."product p inner join shopurneeds_booking_request b on p.id = b.product_id";

 


  $sql .= " order by b.id desc ";
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
                            <h2 class="text-md text-highlight">All Booking</h2></div>
                        <div class="flex"></div> 
                         
                    </div>
                </div>
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="mb-5">
                           
                            
                            <form name="product" method="post" action="#">
                            <div class="table-responsive">
                                <table class="table table-theme table-row v-middle">
                                    <thead>
                                        <tr> 
                                            <th class="text-muted">Product</th>
                                            <th class="text-muted sortable" data-toggle-class="asc">Product Details</th>
                                            <th class="text-muted sortable" data-toggle-class="asc">Booking Date/Time</th>
                                            <th class="text-muted"><span class="d-none d-sm-block">Address</span></th>
                                            <th class="text-muted"><span class="d-none d-sm-block">Customer Details</span></th> 
                                            <th style="width:50px">Act</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($num > 0)
											{ 
    											while($row=mysqli_fetch_array($result))
    											{  
        											@$produrows = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where master_pro_id='".$row['product_id']."' limit 1"));		
    										        $sqlimg=mysqli_query($conn,"select id,productimage from ".$sufix."imageupload where pid='".$row['product_id']."' order by  mainimage asc");	
    										        $sql_user=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$row['user_id']."'"));
														 
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
                                                <div class="avatar-group web-1">
                                                    <?php
                                                    if($mainimage!='') 
                                                    {
									                    $image_name=$mainimage;
									                ?>
                                                        <a href="#" class="avatar ajax w-80" data-toggle="tooltip" title="Product Name"><img style="border-radius: 0px!important;width:60px!important;height:80px!important;" src="../uploads/productimage/thumb/<?php echo $image_name; ?>" alt="."   ></a> 
                                                    <?php } else { ?> 
                                                        <a href="#" class="avatar ajax w-80" data-toggle="tooltip" ><img style="border-radius: 0px!important;" src="../asset/img/missing.png" alt="."></a>
                                                    <?php } ?> 
                                                </div>
                                            </td>
                                            <td class="flex"><a style="color:#448bff;" href="<?php echo URL;?>/<?php echo $row['slug'];?>" class="item-title text-color">UPID: <?php echo  $row['master_sku']; ?> <br> SKU: <?php echo  $row['sku']; ?><br> 
                                            <?php $product->name($row['variantproname'],$row['productname']); ?></a>
                                                 <?php
                                                $rowsaa=mysqli_fetch_array(mysqli_query($conn,"select brandname from shopurneeds_brand where bid='".$row['bid']."'"));  
                                                ?>
                                                <div class="item-title text-color"><?php  echo $rowsaa['brandname']; ?> <?php if($row['color'] != '') { ?> | <?php echo $row['color']; }?> </div>
                                            </td>
                                            <td class="flex">  
                                                <span><strong>Bookig Date:</strong> <?php echo $row['booking_date']; ?></span> <br>
                                                <span><strong>Bookig Time:</strong> <?php echo $row['booking_time']; ?></span> 
                                            </td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['address'];?>, <?php echo $row['city'];?></td>
                                            <td><span class="item-amount d-none d-sm-block text-sm">
                                                <span><strong></strong> <?php echo $sql_user['fname']." ".$sql_user['lname']; ?></span> <br>
                                                <span><strong>Mobile:</strong> <?php echo $sql_user['billing_mobile']; ?></span> <br>
                                                <span><strong>Email:</strong> <?php echo $sql_user['emailid']; ?></span> 
                                            </td> 
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