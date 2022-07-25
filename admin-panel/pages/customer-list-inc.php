<?php  
    if($_REQUEST['isverified']=="1")
    {
        $dsss=mysqli_query($conn,"update ".$sufix."user_registration set is_verified='1' where id='".$_REQUEST['id']."'");
    }
    if($_REQUEST['page']=="")
    {
        $page="0";
    }
    else
    {
        $page=$_REQUEST['page'];
    }
    
    
    if($_REQUEST['search_text']!='') 
	{
		$fieldlike=$_REQUEST['search_text'];
        $search_filter="	and	(fname like '%$fieldlike%' or  lname like '%$fieldlike%'  or emailid like '%$fieldlike%' or billing_mobile like '%$fieldlike%') ";
	}
    
    
      $sql="select * from ".$sufix."user_registration where id != '' {$search_filter}";
     
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
                        <h2 class="text-md text-highlight">VIEW ALL CUSTOMER</h2></div> 
                    <div class="flex"></div> 
                </div>
            </div>
            
            <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="mb-5 web">
                            <div class="toolbar"  style="margin-bottom:4px;"> 
                                <form class="flex" method="get">
                                    <div class="row">
                                        <div class="input-group col-md-6" style="padding-right: 4px;padding-left: 10px;">
                                            <input type="text" name="search_text" class="form-control form-control-theme form-control-sm search" placeholder="Search by customer name, email or mobile"  value="<?php echo $_REQUEST['search_text']; ?>"  /> 
                                            
                                        </div>
                                        
                                        <div class="input-group col-md-1" style="padding-right: 4px;padding-left: 4px;">
                                              <span class="input-group-append"><button class="btn btn-primary no-border btn-sm" type="submit"><span class="d-flex text-muted" style="color:#ffffff;"><i data-feather="search"></i></span></button> </span>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                            <div class="table-responsive  ">
                                <table class="table table-theme table-row v-middle">
                                    <thead style="background: #448bff linear-gradient(45deg, #448bff, #44e9ff);">
                                        <tr> 
                                            <th style="width:20px"> <label class="ui-check m-0"><input type="checkbox"><i></i></label></th> 
                                            <th class="text-muted">Name</th>
                                            <th class="text-muted">Email</th> 
                                            <th class="text-muted">Mobile</th> 
                                            <th class="text-muted">Wallet&nbsp;Amount</th>
                                            <th class="text-muted">Total&nbsp;Orders</th>
                                            <th class="text-muted">Total&nbsp;Orders&nbsp;Amount</th>
                                            <th class="text-muted">Joining&nbsp;Date</th> 
                                            <th style="width:50px">Act</th>
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
                                            <td><input type="text" style="width: 50px;" value="<?php echo $row['wallet'];	?>" readonly /></td>
                                            <td>
                                                <?php $sql_customer_order = mysqli_query($conn,"select * from ".$sufix."order_seller  where emailid='".$row['emailid']."'"); ?>
                                                <?php  $total_order =  mysqli_num_rows($sql_customer_order); ?> 
                                                <input type="text" style="width: 80px;" value="<?php echo $total_order;	?>" readonly />
                                            </td>
                                            <td>
                                                <?php $sql_customer_order1 = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller  where emailid='".$row['emailid']."'")); ?>
                                                <?php $total_order_amount =  $sql_customer_order1['totalcost'];    ?>
                                                <input type="text" style="width: 80px;" value="<?php echo $total_order_amount;	?>" readonly />
                                            </td>
                                             <td style="width:150px;"><?php echo date("Y M d",strtotime($row['adddate']));?></td>
                                            
                                            
                                             
                                             <td> 
                                             								<?php if($row['is_verified']==0) { ?>
                                  	<a class="dropdown-item edit" href="customer-list.php?id=<?php echo $row['id']; ?>&isverified=1">Approve</a>		
<br>
<?php } ?>
											    <a class="dropdown-item edit" href="manage_user_wallet.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id"   >Manage Wallet</a>		
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
                                <?php pagingall($offset,$num,'customer-list.php',$page,$no_page,$display_range); ?> 
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
        