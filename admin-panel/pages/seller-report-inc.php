<?php  
    
    if($_REQUEST['page']=="")
    {
        $page="0";
    }
    else
    {
        $page=$_REQUEST['page'];
    }
    $sql="select * from ".$sufix."suppliers ";
    $sql .= " order by id desc "; 
    $sql1=mysqli_query($conn,$sql);
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
    $num=mysqli_num_rows($sql1);					
    $no_page = max(1,ceil($num/$offset));
    $pager=$pager->getPagerData($no_page, $display_range, $page, $offset); 
    $result=mysqli_query($conn,$sql." LIMIT $pager->offset, $offset");	
?>
    <!-- ############ Content START-->
    <div id="content" class="flex">
        <!-- ############ Main START-->
        <div>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">Seller Reports</h2></div> 
                    <div class="flex"></div> 
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">  <?php  echo $_SESSION['message']; unset($_SESSION['message']); ?>  </div>
                            </form>
                             
                        </div>
                        <form name="esdere" action="report_seller.php" method="post">
                            <input id="sql" name="sql" value="<?php echo $sql; ?>" type="hidden"> 
                            <div class="table-responsive gaj " style="min-height:400px;">
                                <table class="table table-theme table-row v-middle" >
                                    <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                        <tr>
                                            <th style="width:20px">
                                                <label class="ui-check m-0">
                                                <input type="checkbox"><i></i></label>
                                            </th> 
                                            <th class="text-muted sortable">Seller Pic</th> 
                                            <th class="text-muted sortable sortable">Seller Details</th> 
                                            <th class="text-muted sortable">Seller Address</th>
                                            <th class="text-muted sortable">Total Products</th>
                                            <th class="text-muted sortable">Total Order</th>
                                            <th class="text-muted sortable">Total Sale</th> 
                                            <th style="width:50px"><button class="btn btn-sm btn-primary" type="submit" ><i class="fa fa-file-excel-o" style="font-size:24px"></i></button> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($num > 0)
    										{ 
    											while($row=mysqli_fetch_array($result))
    											{		 
    											    $sql_total_order = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."order_seller  where seller_id='".$row['id']."'")); 
    									?> 
                                        <tr class="v-middle" data-id="15">
                                            <td>
                                                <label class="ui-check m-0">
                                                    <input type="checkbox" name="seller_id[]" value="<?php echo $row['id']; ?>"  > <i></i></label>
                                            </td>
                                            <td class="flex">
                                                <?php if($row['uploadimage']!='') { ?> 
                                                    <img src="../uploads/sellerimages/<?php echo $row['uploadimage']; ?>" width="70"  /> 
                                                <?php } else { ?>
                                                    <img src="<?php echo URL ?>/asset/img/default.png" width="50"  /> 
                                                <?php } ?>
                                            </td>
                                            <td class="flex">
                                                <a target="blank" style="color: #005ef7;" href="<?php echo URL."/".$row['seller_slug'];	?>" class="item-title text-color"><?php echo $row['suppliername'];	?></a>
                                                <div class="item-title text-color"><?php echo $row['emailid'];	?></div>
                                                <div class="item-title text-color"><?php echo $row['phone'];	?></div>
                                            </td>
                                            <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['address1'];	?> <?php echo $row['pcity'];	?></a> </td> 
                                            <td>  
                                                <?php echo  mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."product  where seller_id='".$row['id']."' and vartype=''")); ?>
                                                
                                            </td>
                                            <td><?php echo $sql_total_order; ?></td>
                                            <td> 
                                                <?php $sql_customer_order1 = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller  where seller_id='".$row['id']."'")); ?>
                                                <?php echo $sql_customer_order1['totalcost'];    ?>
                                            </td>   
                                            <td> 
                                            </td>
                                        </tr>
                                        <?php } } ?> 
                                    </tbody> 
                                </table>
                            </div>
                            <div class="d-flex"> 
                                <?php pagingall($offset,$num,'seller-report.php',$page,$no_page,$display_range); ?>
                                <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>  
                            </div> 
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- ############ Main END-->
    </div> 
<script type="text/javascript">
function upsort()
{
	document.brand.action='sort-brand.php';
	document.brand.submit();
} 
function sure(vr, ac)
{ 
	var sur=confirm("Are you sure ! You want to "+ ac +" brand from this list");
	if(sur==true)
	{
		document.brand.action=vr;
		document.brand.submit();
		return true;
	}
	else
	{
		return false;
	} 
}
</script>
        