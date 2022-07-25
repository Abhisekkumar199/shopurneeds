<?php    
    $sql="select * from ".$sufix."master_configuration   "; 
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
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/static-pages"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;תצורת אבرئيسي</h2></div> 
                    <div class="flex"></div> 
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
                                        <th class="text-muted">חיוב COD</th> 
                                        <th class="text-muted">מטא כותרת</th> 
                                        <th class="text-muted">מטא מילות מפתח</th>  
                                        <th class="text-muted">תיאור מטא</th>
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
                                            <?php if($row['logo']!='') { ?> 
                                                <img src="../uploads/masterimages/<?php echo $row['logo']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><?php echo $row['cod_charge'];	?></td>
                                        <td class="flex"><?php echo $row['metatitle'];	?></td>
                                        <td class="flex"><?php echo $row['metakeyword'];	?></td>
                                        <td class="flex"><?php echo $row['metadescription'];	?></td>
                                      
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
													<a class="dropdown-item edit" href="add-master-configuration.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">ערוך</a> 
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
                            <small class="text-muted py-2 mx-2">مجموع <span id="count"><?php echo $num; ?></span> العناصر</small>  
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
                                        <th class="text-muted">COD Charge</th> 
                                        <th class="text-muted">Meta title</th> 
                                        <th class="text-muted">Meta Keyword</th>  
                                        <th class="text-muted">Meta Description</th>
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
                                            <?php if($row['logo']!='') { ?> 
                                                <img src="../uploads/masterimages/<?php echo $row['logo']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><?php echo $row['cod_charge'];	?></td>
                                        <td class="flex"><?php echo $row['metatitle'];	?></td>
                                        <td class="flex"><?php echo $row['metakeyword'];	?></td>
                                        <td class="flex"><?php echo $row['metadescription'];	?></td>
                                      
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
													<a class="dropdown-item edit" href="add-master-configuration.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
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
        