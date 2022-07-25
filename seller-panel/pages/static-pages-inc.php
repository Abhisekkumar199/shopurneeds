<?php    
    $sql="select * from ".$sufix."static_pages   "; 
    $sql .= " order by id desc"; 
	$sql1=mysqli_query($conn,$sql);
	$num=mysqli_num_rows($sql1);	
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
    <!-- ############ Content START-->
    <div id="content" class="flex">
        <!-- ############ Main START-->
        <div>
            <?php if($_SESSION['admin_language'] == 'HE') { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/static-pages"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp; צפו בכל הדפים</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-static-page" class="btn w-sm mb-1 btn-primary">הוסף עמוד</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar">  
                             
                        </div>
                        <form name="category" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox"><i></i></label>
                                        </th> 
                                        <th class="text-muted">תמונה</th> 
                                        <th class="text-muted">כותרת</th> 
                                        <th class="text-muted">כתובת אתר</th>  
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
                                            <input type="checkbox" name="id[]" value="<?php echo $row['id']; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex">
                                            <?php if($row['imageupload']!='') { ?> 
                                                <img src="../uploads/staticpageimages/<?php echo $row['imageupload']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><?php echo $row['heading'];	?></td>
                                        <td class="flex"><a href="<?php echo URL;?>/<?php echo $row['link_name'];?>" target="_blank"><?php echo $row['heading'];?></a></td> 
                                        <td class="flex">
                                            <?php if($row['displayflag']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">מופעל </span> 
											<?php } elseif($row['displayflag']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">מושבת</span> 
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=static-pages.php&tb=<?php echo $sufix; ?>static_pages&option=id">השבת</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=static-pages.php&tb=<?php echo $sufix; ?>static_pages&option=id">לאפשר</a>
													<?php } ?> 
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=static-pages.php&tb=<?php echo $sufix; ?>static_pages&option=id" onclick="return confirm('Are you sure to delete this?')" >למחוק</a>
													<a class="dropdown-item edit" href="add-static-page.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">ערוך</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'static-pages.php',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">סך הכל <span id="count"><?php echo $num; ?></span>  עמודים </small>  
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php } else { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/static-pages"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;VIEW ALL PAGES</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-static-page" class="btn w-sm mb-1 btn-primary">Add Page</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar">  
                             
                        </div>
                        <form name="category" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox"><i></i></label>
                                        </th> 
                                        <th class="text-muted">Image</th> 
                                        <th class="text-muted">Heading</th> 
                                        <th class="text-muted">URL</th>  
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
                                            <input type="checkbox" name="id[]" value="<?php echo $row['id']; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex">
                                            <?php if($row['imageupload']!='') { ?> 
                                                <img src="../uploads/staticpageimages/<?php echo $row['imageupload']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><?php echo $row['heading'];	?></td>
                                        <td class="flex"><a href="<?php echo URL;?>/<?php echo $row['link_name'];?>" target="_blank"><?php echo $row['heading'];?></a></td>
                                         
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=static-pages.php&tb=<?php echo $sufix; ?>static_pages&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=static-pages.php&tb=<?php echo $sufix; ?>static_pages&option=id">Enable</a>
													<?php } ?>
													
														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=static-pages.php&tb=<?php echo $sufix; ?>static_pages&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-static-page.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'static-pages.php',$page,$no_page,$display_range); ?> 
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
	document.category.action='sort-category.php';
	document.category.submit();
} 
function sure(vr, ac)
{ 
	var sur=confirm("Are you sure ! You want to "+ ac +" Category from this list");
	if(sur==true)
	{
		document.category.action=vr;
		document.category.submit();
		return true;
	}
	else
	{
		return false;
	} 
}
</script>
        