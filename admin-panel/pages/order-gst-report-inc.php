<?php   
$sql="select * from ".$sufix."order ";
 
$order_condition = " and approve_status='Delivered'";
 	 
 
$order_start_date=" and orderdate >='".$_REQUEST['start_date']."'"; 
$order_end_date=" and orderdate <='".$_REQUEST['end_date']."'"; 
$sql .=" where oid!=''";  
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
  $sql .= "{$order_condition} {$order_start_date} {$order_end_date} order by oid desc "; 
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
                            <h2 class="text-md text-highlight">Order Report</h2><small class="text-muted"></small></div>
                        <div class="flex"></div>
                       
                    </div>
                </div>
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="mb-5 web">
                            <div class="toolbar"> 
                                <form class="flex" method="get" style="margin-bottom:20px;">
                                    <div class="row"> 
                                        <div class="input-group col-md-5" style="padding-right: 4px;padding-left: 4px;max-width: 41%!important;">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Date</span>
                                            </div>
                                            <input type="date" name="start_date" class="form-control" value="<?php echo $_REQUEST['start_date']; ?>" placeholder="From Date" required>
                                            <input type="date" name="end_date" class="form-control" value="<?php echo $_REQUEST['end_date']; ?>" placeholder="To Date" required>
                                        </div>
                                        <div class="input-group col-md-3" style="padding-right: 4px;padding-left: 4px;">
                                            <select class="custom-select  " name="type"  >
                                                <option value="order" <?php if($_REQUEST['type'] == 'order') { ?>selected <?php } ?>  >Order Wise GST</option> 
                                                <option value="product" <?php if($_REQUEST['type'] == 'product') { ?>selected <?php } ?>>Product Wise GST</option> 
                                            </select>
                                        </div>
                                        <div class="input-group col-md-1" style="padding-right: 4px;padding-left: 4px;">
                                              <span class="input-group-append"><button class="btn btn-white no-border btn-sm" type="submit"><span class="d-flex text-muted"><i data-feather="search"></i></span></button> </span>
                                        </div>
                                    </div> 
                                </form>     
                            </div>
                            <?php if($_REQUEST['type'] == 'order') { ?>
                                <form name="esdere" action="report_orderwise_gst.php" method="post">
                                    <input id="sql" name="sql" value="<?php echo $sql; ?>" type="hidden"> 
                                    <div class="table-responsive gaj">
                                         <table class="table table-theme table-row v-middle">
                                            <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                                <tr>  
                                                     <th  class="text-muted">Date</th>  
                                                     <th  class="text-muted">Order Id</th>   
                                                     <th  class="text-muted">Product Value</th>     
                                                     <th  class="text-muted">Shipping Charge</th>   
                                                     <th  class="text-muted">SGST</th> 
                                                     <th  class="text-muted">CGST</th> 
                                                     <th  class="text-muted">IGST</th> 
                                                     <th  class="text-muted">Total Order Value</th> 
                                                     <th  class="text-muted">Email Id</th> 
                                                     <th  class="text-muted">Mobile No.</th> 
                                                     <th style="width:50px"><button class="btn btn-sm btn-primary" type="submit" ><i class="fa fa-file-excel-o" style="font-size:24px"></i></button> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($num > 0)
                                                { 
                                                    while($row=mysqli_fetch_array($result))
                                                    { 	 
                                                        $subtotal="0"; 
                                                        $sqlcart=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$row['bid']."'  ");
                                                        while($rowcart = mysqli_fetch_array($sqlcart))
                                                        {  
                                                            $subtotal= $rowcart['subtotal'];  
                                                            $sqlpt=mysqli_fetch_array(mysqli_query($conn,"select gst from ".$sufix."product where id='".$rowcart['productid']."'"));
                                                            $tax=$sqlpt['gst'];  
                                                            $gst=$subtotal*$tax/100; 
                                                            $gstvalues122=$gstvalues122+$gst; 
                                                        } 
                                                        $total_gst_value=number_format($gstvalues122,2);  
                                                         
                                                        $total_order_value=$subtotal; 
                                                        $shipcharge=$row['shipcharge']; 
                                                        $bagcost=$row['bagcost']; 
                                                        
                                                        $totalgstfinal=number_format($total_gst_value,2);
                                                        $totalsgst=number_format(($total_gst_value)/2,2);
                                                        $totalcgst=number_format(($total_gst_value)/2,2); 
                                                        
                                                        $finalcost=$total_order_value+$bagcost+$shipcharge;
                                                        
                                                         							
                                                ?>
                                                <tr class="v-middle" data-id="15">  
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['orderdate']; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['oid']; ?></span></td>  
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo round($row['totalcost'] - $totalgstfinal); ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $shipcharge; ?></span></td> 
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $totalsgst; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $totalcgst; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $totalgstfinal; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['totalcost']; ?></span></td>
                                                    <td ><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['emailid']; ?></span></td>
                                                    <td colspan="2"><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['deliver_phone']; ?></span></td> 
                                                </tr>
                                                <?php
                                                
                                                $total_order_value = 0;    
                                                $total_gst_value=0;
                                                $totalgstfinal=0;
                                                $totalsgst=0;
                                                $totalcgst=0;  
                                                 
                                                $gstvalues122=0;
                                                
                                                    
                                                
                                                
                                                } } else { ?> 
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
                            <?php } else  if($_REQUEST['type'] == 'product') { ?>
                                <form name="esdere" action="report_productwise_gst.php" method="post">
                                    <input id="sql" name="sql" value="<?php echo $sql; ?>" type="hidden"> 
                                    <div class="table-responsive gaj">
                                         <table class="table table-theme table-row v-middle">
                                            <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                                <tr>  
                                                     <th style="width:15%;" class="text-muted">Date</th>  
                                                     <th style="width:4%;"  class="text-muted">O.&nbsp;Id</th>   
                                                     <th style="width:15%;" class="text-muted">P.&nbsp;Name</th>   
                                                     <th style="width:5%;" class="text-muted">HSN&nbsp;Code</th>     
                                                     <th style="width:4%;"  class="text-muted">Qty</th>     
                                                     <th style="width:5%;" class="text-muted">Selling&nbsp;Price</th>   
                                                     <th style="width:4%;" class="text-muted">SGST</th> 
                                                     <th style="width:4%;" class="text-muted">CGST</th> 
                                                     <th style="width:4%;" class="text-muted">IGST</th> 
                                                     <th style="width:4%;" class="text-muted">Order&nbsp;Value</th> 
                                                     <th style="width:4%;" class="text-muted">Pay&nbsp;Type</th> 
                                                     <th style="width:10%;" class="text-muted">Email&nbsp;Id</th> 
                                                     <th style="width:5%;" class="text-muted">Mobile&nbsp;No.</th> 
                                                     <th style="width:6%;"><button class="btn btn-sm btn-primary" type="submit" ><i class="fa fa-file-excel-o" style="font-size:24px"></i></button> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($num > 0)
                                                { 
                                                    while($row=mysqli_fetch_array($result))
                                                    { 	  
                                                        $sqlcart=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$row['bid']."'  ");
                                                        while($rowcart = mysqli_fetch_array($sqlcart))
                                                        {     
                                                            $sqlpt=mysqli_fetch_array(mysqli_query($conn,"select gst from ".$sufix."product where id='".$rowcart['productid']."'"));
                                                            $tax=$sqlpt['gst'];  
                                                            $gst=$rowcart['subtotal']*$tax/100;  
                                                            
                                                            $total_gst_value=number_format($gst,2);   
                                                            $totalgstfinal=number_format($total_gst_value,2);
                                                            $totalsgst=number_format(($total_gst_value)/2,2);
                                                            $totalcgst=number_format(($total_gst_value)/2,2);  
                                                ?>
                                                <tr class="v-middle" data-id="15">  
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['orderdate']; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['oid']; ?></span></td>  
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $rowcart['productname']; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $rowcart['hsncode']; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $rowcart['quantity']; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $rowcart['sellingprice']; ?></span></td> 
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $totalsgst; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $totalcgst; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $totalgstfinal; ?></span></td>
                                                    <td ><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['paytype']; ?></span></td>
                                                    <td><span class="item-amount d-none d-sm-block text-sm"><?php echo $rowcart['subtotal']; ?></span></td>
                                                    <td ><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['emailid']; ?></span></td>
                                                    <td colspan="2"><span class="item-amount d-none d-sm-block text-sm"><?php echo $row['deliver_phone']; ?></span></td> 
                                                </tr>
                                                <?php   
                                                }  } } else { ?> 
                                                <tr class="v-middle" data-id="15"> 
                                                    <td colspan="14" ><p>No record found!</p></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>  
                                        </table>
                                    </div>
                                </form> 
                                <div class="d-flex">
                                    <?php pagingall($offset,$num,'order-list.php',$page,$no_page,$display_range); ?> 
                                </div>  
                            <?php } else { ?>
                            <p>Please select date range to view report</p>
                            <?php } ?>
                        
                    </div>
                </div>
            </div>
            <!-- ############ Main END-->
        </div>
        <!-- ############ Content END-->
        