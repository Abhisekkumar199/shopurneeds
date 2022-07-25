<?php  
     
	if($_REQUEST['parentid']=="")
	{
		$parent="0";
	}
	else
	{
		$parent=$_REQUEST['parentid'];
	}
    $sql="select * from ".$sufix."top_navigation where parent='".$parent."'"; 
    $sql .= " order by id desc"; 
	$sql1=mysqli_query($conn,$sql);
	$num=mysqli_num_rows($sql1);	
	$offset = 50;
	$no_page = max(1,ceil($num/$offset)); 
	
    $pager=$pager->getPagerData($no_page, $display_range, $page, $offset); 
    $result=mysqli_query($conn,$sql." LIMIT $pager->offset, $offset");	
?>
    <!-- ############ Content START-->
    <div id="content" class="flex">
        <!-- ############ Main START-->
        <div>
            <?php if($_SESSION['admin_language'] == 'AR') { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/static-pages-menu"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;قائمة القائمة</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-static-pages-menu.php?parent=<?php echo $_REQUEST['parentid']; ?>" class="btn w-sm mb-1 btn-primary">إضافة قائمة</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="custom-select " name="parentid" onchange="this.form.submit()">
                                            <option value="">حدد القائمة الرئيسية</option>
                                            <?php
                                            $sqlc=mysqli_query($conn,"select * from ".$sufix."top_navigation where parent='0'");
                                            while($rowc=mysqli_fetch_array($sqlc))
                                            {
                                            ?>						
                                                <option value="<?php echo  $rowc['id']; ?>" <?php if($_REQUEST['parentid'] == $rowc['id']) { echo "selected";} ?>><?php echo $rowc['itemname']; ?></option>						
                                            <?php } ?>	
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <?php  
                                            echo $_SESSION['message']; 
                	                        unset($_SESSION['message']); 
                	                    ?>
                                    </div>
                                </div>
                            </form>
                             
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
                                        <th class="text-muted">عنوان القائمة</th> 
                                        <th class="text-muted">الأبوين</th> 
                                        <th class="text-muted">موضع</th>
                                        <th class="text-muted">فرز</th>
                                        <th class="text-muted">الحالة</th>
                                        <th style="width:50px">عمل</th> 
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
                                         
                                        <td class="flex"><?php echo $row['itemname'];	?></td>
                                        <?php 
                                        $parentid = $row['parent'];  
                                        if($parentid > 0)
                                        {
                                            $sqlparent = mysqli_fetch_assoc(mysqli_query($conn,"select * from shopurneeds_top_navigation where id='".$parentid."'"));
                                        }
                                        ?>
                                        <td class="flex"><?php echo $sqlparent['itemname'];	?></td>
                                        <td class="flex"><?php echo $row['menuposition'];	?></td>
                                        <td class="flex">
                                            <input type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" /> 
										    <input name="ids[]" type="hidden" value="<?php echo $row['id']; ?>" />
                                        </td>
                                        <td class="flex">
                                            <?php if($row['displayflag']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">ممكّن</span> 
											<?php } elseif($row['displayflag']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">معاق</span> 
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&status=0&link=static-pages-menu.php&tb=<?php echo $sufix; ?>top_navigation&option=id">معاق</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&status=1&link=static-pages-menu.php&tb=<?php echo $sufix; ?>top_navigation&option=id">ممكن</a>
													<?php } ?>
													
														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&link=static-pages-menu.php&tb=<?php echo $sufix; ?>top_navigation&option=id" onclick="return confirm('Are you sure to delete this?')" >حذف</a>
													<a class="dropdown-item edit" href="add-static-pages-menu.php?option=Edit&id=<?php echo $row['id']; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&page=<?php echo $page; ?>">تعديل</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'static-pages-menu.php',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">مجموع <span id="count"><?php echo $num; ?></span> العناصر</small> 
                            <button  type="button" onclick="upsort();" class="btn  bg-primary-lt pull-right">تحديث معرف الفرز</button>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php } else { ?>
            
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/static-pages-menu"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;VIEW ALL MENU</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-static-pages-menu.php?parent=<?php echo $_REQUEST['parentid']; ?>" class="btn w-sm mb-1 btn-primary">Add Menu</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="custom-select " name="parentid" onchange="this.form.submit()">
                                            <option value="">Select Parent Menu</option>
                                            <?php
                                            $sqlc=mysqli_query($conn,"select * from ".$sufix."top_navigation where parent='0'");
                                            while($rowc=mysqli_fetch_array($sqlc))
                                            {
                                            ?>						
                                                <option value="<?php echo  $rowc['id']; ?>" <?php if($_REQUEST['parentid'] == $rowc['id']) { echo "selected";} ?>><?php echo $rowc['itemname']; ?></option>						
                                            <?php } ?>	
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <?php  
                                            echo $_SESSION['message']; 
                	                        unset($_SESSION['message']); 
                	                    ?>
                                    </div>
                                </div>
                            </form>
                             
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
                                        <th class="text-muted">Menu Heading</th> 
                                        <th class="text-muted">Parent</th> 
                                        <th class="text-muted">Position</th>
                                        <th class="text-muted">Sort</th>
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
                                         
                                        <td class="flex"><?php echo $row['itemname'];	?></td>
                                        <?php 
                                        $parentid = $row['parent'];  
                                        if($parentid > 0)
                                        {
                                            $sqlparent = mysqli_fetch_assoc(mysqli_query($conn,"select * from shopurneeds_top_navigation where id='".$parentid."'"));
                                        }
                                        ?>
                                        <td class="flex"><?php echo $sqlparent['itemname'];	?></td>
                                        <td class="flex"><?php echo $row['menuposition'];	?></td>
                                        <td class="flex">
                                            <input type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" /> 
										    <input name="ids[]" type="hidden" value="<?php echo $row['id']; ?>" />
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&status=0&link=static-pages-menu.php&tb=<?php echo $sufix; ?>top_navigation&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&status=1&link=static-pages-menu.php&tb=<?php echo $sufix; ?>top_navigation&option=id">Enable</a>
													<?php } ?>
													
														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&link=static-pages-menu.php&tb=<?php echo $sufix; ?>top_navigation&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-static-pages-menu.php?option=Edit&id=<?php echo $row['id']; ?>&parentid=<?php echo $_REQUEST['parentid'];?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'static-pages-menu.php',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small> 
                            <button  type="button" onclick="upsort();" class="btn  bg-primary-lt pull-right">Update Sort ID</button>
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
	document.category.action='sort-page-menu.php';
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
        