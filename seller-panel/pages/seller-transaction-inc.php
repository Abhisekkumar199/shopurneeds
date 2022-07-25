<?php 

$sql_seller=mysqli_fetch_array(mysqli_query($conn,"select commission from ".$sufix."suppliers where id = '".$_SESSION['sellerid']."' "));
$commission = $sql_seller['commission'];
$sql="select * from ".$sufix."order where seller_id='".$_SESSION['sellerid']."'   and approve_status !='Order Placed'";
  
 	 
if($_REQUEST['search_text']!='' || $_REQUEST['sellerid']!=''  || $_REQUEST['brandid']!='' || $_REQUEST['start_date']!='' || $_REQUEST['end_date']!='')
{
	if($_REQUEST['search_text']!='') 
	{
		$fieldlike=$_REQUEST['search_text'];
        $search_filter ="	and	(userid like '%$fieldlike%' or	deliver_fname like '%$fieldlike%' or deliver_lname like '%$fieldlike%') ";
	}
 
	
	if($_REQUEST['brandid']!='') 
	{
        $brand_filter=" and bid='".$_REQUEST['brandid']."'";
	}
 
    if($_REQUEST['start_date']!='') 
	{
        $order_start_date=" and orderdate >='".$_REQUEST['start_date']."'";
	}
	
	if($_REQUEST['end_date']!='') 
	{
        $order_end_date=" and orderdate ='".$_REQUEST['end_date']."'";
	}
   
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
echo $sql .= " {$search_filter}  {$brand_filter} {$order_start_date} {$order_end_date} order by oid desc "; 
$sql1=mysqli_query($conn,$sql);
$num=mysqli_num_rows($sql1);					
$no_page = max(1,ceil($num/$offset));
$pager=$pager->getPagerData($no_page, $display_range, $page, $offset);  
$result=mysqli_query($conn,$sql." LIMIT $pager->offset, $offset");	
?>

<script>
function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);
}
</script>        
        <!-- ############ Content START-->
        <div id="content" class="flex">
            <!-- ############ Main START-->
            <div> 
                <div class="page-hero page-container" id="page-hero">
                    <div class="padding d-flex">
                        <div class="page-title">
                            <h2 class="text-md text-highlight">VIEW ORDERS</h2><small class="text-muted"></small></div>
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
                                    <!--<div class="input-group col-md-2" style="padding-right: 4px;padding-left: 4px;">
                                        <select class="custom-select"  name="sellerid">
                                            <option value="">Seller</option>
                                            <?php
                                            $sellerquery = mysqli_query($conn,"select * from ".$sufix."suppliers where displayflag='1'");
                                            while($sellerrows = mysqli_fetch_assoc($sellerquery)) {  ?>
                                            <option value="<?php echo $sellerrows['id'];?>" <?php if($_REQUEST['sellerid']==$sellerrows['id']) { echo "selected='selected'";} ?>><?php echo $sellerrows['suppliername'];?></option>
                                            <?php } ?> 
                                        </select>
                                    </div>-->
                                    
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
                            <div class="table-responsive gaj">
                                <table class="table table-theme table-row v-middle">
                                    <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                        <tr>  
                                             <th  class="text-muted">ORDER ID</th>  
                                             <th style="width:200px" class="text-muted sortable" data-toggle-class="asc">CUSTOMER DETAILS</th> 
                                             <th style="width:200px" class="text-muted sortable" data-toggle-class="asc">SHIPPING DETAILS</th>
                                             <th class="text-muted"><span class="d-none d-sm-block">PRO. QTY</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">AMOUNT</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">COMISSION</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">SELLER PAYOUT</span></th>
                                             <th class="text-muted"><span class="d-none d-sm-block">PAID STATUS</span></th> 
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
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['oid']; ?></span></td>
                                         
                                            
                                            <td class="flex"><a href="#" class="item-title text-color"><?php echo ucwords($row['deliver_fname']." ".$row['deliver_lname']); ?></a>
                                                <div class="item-title text-color"><?php echo $row['emailid']; ?></div>
                                                <div class="item-title text-color"><?php echo $row['deliver_phone']; ?></div> 
                                            </td>
                                            <td class="flex">
                                                <?php echo $rowaddress['address'];?><br>
                                                <?php echo $rowaddress['city'];?><br>
                                                Pin Code - <?php echo $rowaddress['zipcode'];?> 
                                            </td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['quantity2'];?></span></td>
                                            <td><span class="item-amount d-none d-sm-block text-sm"><?php echo Currency." ".number_format($row['totalcost'],2); ?> </span></td>
                                            <td><?php echo $commission; ?></td>
                                            <td><?php echo number_format($row['totalcost'],2) *$commission/100; ?></td>
                                            <td> 
                                                <?php if($row['paidstatus']=='Paid') { ?>
                                                    <span style="color:#009933"> Paid</span>
                                                <?php } else { ?>
                                                    <span style="color:#FF0000"> Unpaid</span>
                                                <?php } ?>
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
                            <div class="d-flex">
                                <?php pagingall($offset,$num,'seller-transaction.php',$page,$no_page,$display_range); ?> 
                        </div>
                        
                    </div>
                </div>
            </div> 
            
            
            <!-- ############ Main END-->
        </div>
        <!-- ############ Content END-->
        