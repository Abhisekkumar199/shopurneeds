<?php  
    
    if($_REQUEST['page']=="")
    {
        $page="0";
    }
    else
    {
        $page=$_REQUEST['page'];
    }
    $sql="select * from ".$sufix."user_registration ";
     
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
                        <h2 class="text-md text-highlight">Customer Report</h2></div> 
                    <div class="flex"></div> 
                </div>
            </div>
            
            <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="mb-5 web">
                            <form name="esdere" action="report_customer.php" method="post">
                                <input id="sql" name="sql" value="<?php echo $sql; ?>" type="hidden"> 
                            <div class="table-responsive gaj">
                                <table class="table table-theme table-row v-middle">
                                    <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                        <tr> 
                                            <th style="width:20px"> <label class="ui-check m-0"><input type="checkbox"><i></i></label></th> 
                                            <th class="text-muted">Name</th>
                                            <th class="text-muted">Email</th> 
                                            <th class="text-muted">Mobile</th> 
                                            <th class="text-muted sortable" data-toggle-class="asc">Address</th>
                                            <th class="text-muted sortable" data-toggle-class="asc">Total Order</th> 
                                            <th class="text-muted sortable" data-toggle-class="asc">Total Order Value</th>
                                            <th style="width:50px"><button class="btn btn-sm btn-primary" type="submit" ><i class="fa fa-file-excel-o" style="font-size:24px"></i></button> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($num > 0)
                                        { 
                                            while($row=mysqli_fetch_array($result))
                                            { 	
                                                $sqladdress=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."customer_address where user_id='".$row['id']."'"));

                                            	$oid=$row['id']; 									
                                        ?>
                                        <tr class="v-middle" data-id="15"> 
                                            <td> <label class="ui-check m-0"><input type="checkbox" name="id" value="15"> <i></i></label></td> 
                                          
                                            <td class="flex"> <?php echo $row['fname'];  echo ' '; echo $row['lname'];   ?> </td> 
                                           
                                            <td class="flex">  <?php echo $row['emailid'];	  ?> 
                                            </td>
                                            
                                            <td> <?php echo $row['billing_mobile'];	?></td>
                                            <td class="flex"> 
                                                <?php echo $sqladdress['address'];?><br>
                                                <?php echo $sqladdress['city'];?><br>
                                                 <?php if($sqladdress['zipcode'] != '') {  echo "Pin Code - ".$sqladdress['zipcode'];  }?> 
                                            </td> 
                                            <td>  
                                                <?php $sql_customer_order = mysqli_query($conn,"select * from ".$sufix."order_seller  where emailid='".$row['emailid']."'"); ?>
                                                <?php echo mysqli_num_rows($sql_customer_order); ?> 
                                            </td>
                                            <td> 
                                                <?php $sql_customer_order1 = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller  where emailid='".$row['emailid']."'")); ?>
                                                <?php echo $sql_customer_order1['totalcost'];    ?>
                                            </td> 
                                             <td></td>
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
                                <?php pagingall($offset,$num,'customer-report.php',$page,$no_page,$display_range); ?> 
                        </div>
                        
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
        