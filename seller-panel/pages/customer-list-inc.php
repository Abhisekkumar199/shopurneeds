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
            <?php if($_SESSION['admin_language'] == 'HE') { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">צפו בכל הלקוחות</h2></div> 
                    <div class="flex"></div> 
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row"> 
                                        <?php  
                                            echo $_SESSION['message']; 
                	                        unset($_SESSION['message']); 
                	                    ?> 
                                </div>
                            </form>
                             
                        </div>
                        <form name="brand" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                            <input type="checkbox"><i></i></label>
                                        </th>  
                                        <th class="text-muted text-right">שם</th> 
                                        <th class="text-muted text-right">מזהה אימייל</th>
                                        <th class="text-muted text-right text-right">מס 'נייד</th>
                                        <th class="text-muted text-right">כתובת</th>  
                                        <th class="text-muted text-right">סטטוס</th>
                                        <th style="width:50px">פעולה</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($num > 0)
										{ 
											while($row=mysqli_fetch_array($result))
											{		 								
									?> 
                                    <tr class="v-middle" data-id="15">
                                        <td>
                                            <label class="ui-check m-0">
                                                <input type="checkbox" name="customer_id[]" value="<?php echo $row['id']; ?>"  > <i></i>
                                            </label>
                                        </td> 
                                        <td class="flex text-right"><?php echo $row['fname'];  echo ' '; echo $row['lname']; ?></td>
                                        <td class="flex text-right text-right"><?php echo $row['emailid'];	?></td>  
                                        <td class="flex text-right"><?php echo $row['billing_mobile'];	?></td>
                                        <td class="flex text-right"> 
                                            <?php echo $row['billing_address']; ?><br />
											<?php echo $row['billing_city']; ?>-<?php echo $row['billing_zip']; ?> 
											<?php echo $row['billing_country']; ?>
                                        </td>
                                        
                                        
                                        <td class="flex text-right">
                                            <?php if($row['displayflag']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">השבת</span> 
											<?php } elseif($row['displayflag']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">לאפשר</span> 
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id">לאפשר</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id">השבת</a>
													<?php } ?>
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id" onclick="return confirm('Are you sure to delete this?')" >למחוק</a>
																				 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'seller-list.php',$page,$no_page,$display_range); ?>
                            <small class="text-muted py-2 mx-2">סך הכל <span id="count"><?php echo $num; ?></span> </small>  
                        </div> 
                        </form>
                        
                        <form name="esdere" action="export-customer.php" method="post">
                        <input type="hidden" id="getselectvalue" name="getselectvalue" value="" />
                        <input type="hidden" name="query12" value="<?php echo $sql ?>" />
                        <input type="submit" value="Export to CSV" />
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php } else { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">VIEW ALL CUSTOMER</h2></div> 
                    <div class="flex"></div> 
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row"> 
                                        <?php  
                                            echo $_SESSION['message']; 
                	                        unset($_SESSION['message']); 
                	                    ?> 
                                </div>
                            </form>
                             
                        </div>
                        <form name="brand" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                            <input type="checkbox"><i></i></label>
                                        </th>  
                                        <th class="text-muted">Name</th> 
                                        <th class="text-muted">Email Id</th>
                                        <th class="text-muted">Mobile No</th>
                                        <th class="text-muted">Address</th> 
                                        <th class="text-muted">Status</th>
                                        <th style="width:50px">Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($num > 0)
										{ 
											while($row=mysqli_fetch_array($result))
											{		 								
									?> 
                                    <tr class="v-middle" data-id="15">
                                        <td>
                                            <label class="ui-check m-0">
                                                <input type="checkbox" name="customer_id[]" value="<?php echo $row['id']; ?>"  > <i></i>
                                            </label>
                                        </td> 
                                        <td class="flex"><?php echo $row['fname'];  echo ' '; echo $row['lname']; ?></td>
                                        <td class="flex"><?php echo $row['emailid'];	?></td>  
                                        <td class="flex"><?php echo $row['billing_mobile'];	?></td>
                                        <td class="flex"> 
                                            <?php echo $row['billing_address']; ?><br />
											<?php echo $row['billing_city']; ?>-<?php echo $row['billing_zip']; ?> <br />
											<?php echo $row['billing_country']; ?>
                                        </td>
                                        
                                         
                                        <td class="flex">
                                            <?php if($row['displayflag']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">Enabled</span> 
											<?php } elseif($row['displayflag']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">Disabled</span> 
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id">Enable</a>
													<?php } ?>
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=customer-list.php&tb=<?php echo $sufix; ?>user_registration&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
																				 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'seller-list.php',$page,$no_page,$display_range); ?>
                            <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>  
                        </div> 
                        </form>
                        
                        <form name="esdere" action="export-customer.php" method="post">
                        <input type="hidden" id="getselectvalue" name="getselectvalue" value="" />
                        <input type="hidden" name="query12" value="<?php echo $sql ?>" />
                        <input type="submit" value="Export to CSV" />
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php } ?>
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
        