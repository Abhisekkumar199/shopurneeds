<?php   
$sql="select * from ".$sufix."order ";
 
if($_SESSION["current-date"] == '')
{
    $current_date = date("Y-m-d");
}
else
{
    $current_date = date("Y-m-d",$_SESSION["current-date"]);
}
$order_condition = " and approve_status !='Cancelled' and orderdate='$current_date'";
 
 	 
if($_REQUEST['search_text']!='' || $_REQUEST['sellerid']!=''  || $_REQUEST['brandid']!='' || $_REQUEST['start_date']!='' || $_REQUEST['end_date']!='')
{
	if($_REQUEST['search_text']!='') 
	{
		$fieldlike=$_REQUEST['search_text'];
        $search_filter ="	and	(userid like '%$fieldlike%' or	deliver_fname like '%$fieldlike%' or deliver_lname like '%$fieldlike%') ";
	}
	 
 
    if($_REQUEST['start_date']!='') 
	{
        $order_start_date=" and orderdate >='".$_REQUEST['start_date']."'";
	}
	
	if($_REQUEST['end_date']!='') 
	{
        $order_end_date=" and orderdate ='".$_REQUEST['end_date']."'";
	}
    
	$sql .=" where oid!=''"; 	
}
else
{
	$sql .=" where oid!='' ";	
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
   $sql .= "{$order_condition} {$search_filter} {$seller_filter} {$brand_filter} {$order_start_date} {$order_end_date} order by oid desc "; 
$sql1=mysqli_query($conn,$sql);
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
                            <h2 class="text-md text-highlight">Today Sales Report</h2><small class="text-muted"></small></div>
                        <div class="flex"></div>
                       
                    </div>
                </div>
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="mb-5 web">
                            <div class="toolbar"> 
                                <form class="flex">
                                    <div class="row">
                                    <div class="input-group col-md-2" style="padding-right: 4px;padding-left: 15px;">
                                        <input type="text" class="form-control form-control-theme form-control-sm search"  name="search_text"  placeholder="Search"  >  
                                    </div> 
                                    <div class="input-group col-md-5" style="padding-right: 4px;padding-left: 4px;max-width: 41%!important;">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Date</span>
                                        </div>
                                        <input type="date" name="start_date" class="form-control" value="<?php $_REQUEST['start_date']; ?>" placeholder="From Date">
                                        <input type="date" name="end_date" class="form-control" value="<?php $_REQUEST['end_date']; ?>" placeholder="To Date">
                                    </div>
                                    <div class="input-group col-md-1" style="padding-right: 4px;padding-left: 4px;">
                                          <span class="input-group-append"><button class="btn btn-white no-border btn-sm" type="submit"><span class="d-flex text-muted"><i data-feather="search"></i></span></button> </span>
                                    </div>
                                    </div>
                                </form>     
                            </div>
                            <form name="esdere" action="report_today_sales.php" method="post">
                                <input id="sql" name="sql" value="<?php echo $sql; ?>" type="hidden">
                                
                            
                            <div class="table-responsive gaj">
                                <table class="table table-theme table-row v-middle">
                                    <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                        <tr> 
                                            <th style="width:20px"> <label class="ui-check m-0"><input type="checkbox"><i></i></label></th>
                                             <th  class="text-muted">ORDER ID</th>  
                                             <th style="width:200px" class="text-muted sortable" data-toggle-class="asc">CUSTOMER DETAILS</th> 
                                             <th style="width:200px" class="text-muted sortable" data-toggle-class="asc">SHIPPING DETAILS</th>
                                             <th class="text-muted"><span class="d-none d-sm-block">PRO. QTY</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">AMOUNT</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">PAYMENT</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">DATE</span></th>
                                             
                                             <th style="width:50px"><button  type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-file-excel-o" style="font-size:24px"></i></button> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($num > 0)
                                        { 
                                            while($row=mysqli_fetch_array($result))
                                            { 	
                                            	$oid=$row['id']; 	
                                            	$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$row['address_id']."'");
                                                    $rowaddress = mysqli_fetch_array($sqladdress);								
                                        ?>
                                        <tr class="v-middle" data-id="15"> 
                                            <td> <label class="ui-check m-0"><input type="checkbox" name="id" value="15"> <i></i></label></td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['oid']; ?></span></td>
                                         
                                            
                                            <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['fname']." ".$row['lname']; ?></a>
                                                <div class="item-title text-color"><?php echo $row['emailid']; ?></div>
                                                <div class="item-title text-color"><?php echo $row['billing_mobile']; ?></div> 
                                            </td>
                                            <td class="flex">
                                                <?php echo $rowaddress['address'];?><br>
                                                <?php echo $rowaddress['city'];?><br>
                                                Pin Code - <?php echo $rowaddress['zipcode'];?> 
                                            </td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['quantity2'];?></span></td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo Currency." ".number_format($row['totalcost'],2); ?> </span></td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['paytype']; ?></span></td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"></span><span class="item-amount d-none d-sm-block text-sm"><?php echo change2dmy($row['orderdate']);	?>&nbsp;<?php echo $row['ordertime'];?></span></td>
                                            <td> 
                                                 
                                            </td>
                                        </tr>
                                        <?php } } else { ?> 
                                        <tr class="v-middle" data-id="15"> 
                                        <td colspan="10" ><p>No record found!</p></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>  
                                </table>
                            </div>
                            </form>
                            <div class="d-flex">
                                <?php pagingall($offset,$num,'order-list.php',$page,$no_page,$display_range); ?> 
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- ############ Main END-->
        </div>
        <!-- ############ Content END-->
        