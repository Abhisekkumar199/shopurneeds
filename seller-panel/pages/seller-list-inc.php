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
            <?php if($_SESSION['admin_language'] == 'HE') { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">צפה בכל המוכר</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-seller" class="btn w-sm mb-1 btn-primary">הוסף את המוכר</a></div>
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
                                        <th class="text-muted">תמונה מוכר</th> 
                                        <th class="text-muted">שם המוכר</th> 
                                        <th class="text-muted">כתובת</th>
                                        <th class="text-muted">מזהה אימייל</th>
                                        <th class="text-muted">טלפון</th>
                                        <th class="text-muted">סטטוס</th>
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
                                                <input type="checkbox" name="seller_id[]" value="<?php echo $row['id']; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex">
                                            <?php if($row['uploadimage']!='') { ?> 
                                                <img src="../uploads/sellerimages/<?php echo $row['uploadimage']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['suppliername'];	?></a> </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['address1'];	?> <?php echo $row['pcity'];	?></a> </td> 
                                         
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['emailid'];	?></a> </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['phone'];	?></a> </td>
                                         
                                        <td class="flex">
                                            <?php if($row['displayflag']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">מופעל</span> 
											<?php } elseif($row['displayflag']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">נכים</span> 
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=seller-list.php&tb=<?php echo $sufix; ?>suppliers&option=id">השבת</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=seller-list.php&tb=<?php echo $sufix; ?>suppliers&option=id">אפשר</a>
													<?php } ?>
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=seller-list.php&tb=<?php echo $sufix; ?>suppliers&option=id" onclick="return confirm('Are you sure to delete this?')" >מחק</a>
																				
													<a class="dropdown-item edit" href="add-seller.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">ערוך</a> 
													<a class="dropdown-item edit" href="<?php echo URL;?>/seller_email_login.php?emailid=<?php echo $row['emailid'];?>" target="_blank">כניסה למוכר</a>
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
                            <small class="text-muted py-2 mx-2">סך הכל <span id="count"><?php echo $num; ?></span> פריטים</small>  
                        </div> 
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php } else { ?> 
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">VIEW ALL SELLER</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-seller" class="btn w-sm mb-1 btn-primary">Add Seller</a></div>
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
                        <div class="table-responsive" style="min-height:400px;">
                            <table class="table table-theme table-row v-middle" >
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                            <input type="checkbox"><i></i></label>
                                        </th> 
                                        <th class="text-muted">Seller Pic</th> 
                                        <th class="text-muted">Seller Name</th> 
                                        <th class="text-muted">Address</th>
                                        <th class="text-muted">Email id</th>
                                        <th class="text-muted">Phone</th>
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
                                                <input type="checkbox" name="seller_id[]" value="<?php echo $row['id']; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex">
                                            <?php if($row['uploadimage']!='') { ?> 
                                                <img src="../uploads/sellerimages/<?php echo $row['uploadimage']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['suppliername'];	?></a> </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['address1'];	?> <?php echo $row['pcity'];	?></a> </td> 
                                         
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['emailid'];	?></a> </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['phone'];	?></a> </td>
                                         
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=seller-list.php&tb=<?php echo $sufix; ?>suppliers&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=seller-list.php&tb=<?php echo $sufix; ?>suppliers&option=id">Enable</a>
													<?php } ?>
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=seller-list.php&tb=<?php echo $sufix; ?>suppliers&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
																				
													<a class="dropdown-item edit" href="add-seller.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
													<a class="dropdown-item edit" href="<?php echo URL;?>/seller_email_login.php?emailid=<?php echo $row['emailid'];?>" target="_blank">Seller Login</a>
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
        