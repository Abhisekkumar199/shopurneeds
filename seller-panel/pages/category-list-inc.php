<?php  
    if($_REQUEST['delete_catid']!='') 
	{
		$delcat = mysqli_query($conn,"delete from ".$sufix."category where cat_id='".$_REQUEST['delete_catid']."'");
		$delcat = mysqli_query($conn,"delete from ".$sufix."slug_master where slugtype='category' and slugname='".$_REQUEST['delete_slug']."'");
	} 
	if($_REQUEST['catid']=="")
	{
		$catid="0";
	}
	else
	{
		$catid=$_REQUEST['catid'];
	}
    $sql="select * from ".$sufix."category where parent='".$catid."' and categoryname!=''"; 
    $sql .= " order by cat_id desc"; 
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
            <?php if($_SESSION['admin_language'] == 'HE') { ?> 
            
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/category-list"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp; צפה בכל הקטגוריה </h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-category.php?catid=<?php echo $_REQUEST['catid']; ?>" class="btn w-sm mb-1 btn-primary">  הוסף קטגוריה</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="custom-select " name="catid" onchange="this.form.submit()">
                                            <option value=""> בחר קטגוריה  </option>
                                            <?php
                                            $sqlc=mysqli_query($conn,"select * from shopurneeds_category where parent='".$catid."'");
                                            while($rowc=mysqli_fetch_array($sqlc))
                                            {
                                            ?>						
                                                <option value="<?php echo  $rowc['cat_id']; ?>"><?php echo $rowc['name_in_hebrew']; ?></option>						
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
                                                <input type="checkbox" id="check"  ><i></i></label>
                                        </th> 
                                        <th class="text-muted text-right">  תמונת קטגוריה</th> 
                                        <th class="text-muted text-right"> שם קטגוריה</th> 
                                        <th class="text-muted text-right"> שם קטגוריה בעברית</th>
                                        <th class="text-muted text-right"> סוג</th>
                                        <th class="text-muted text-right"> סטטוס</th>
                                        <th style="width:50px text-left">פעולה</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($num > 0)
										{ 
											while($row=mysqli_fetch_array($result))
											{		
											    $category_code=$row['cat_id']; 								
									?> 
                                    <tr class="v-middle" data-id="15">
                                        <td class="text-right">
                                            <label class="ui-check m-0">
                                            <input type="checkbox" class="allcheck" name="cat_id[]" value="<?php echo $category_code; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex text-right">
                                            <?php if($row['uploadimage1']!='') { ?> 
                                                <img src="../uploads/categoryimages/<?php echo $row['uploadimage1']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="../assets/default.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex text-right"><a href="<?php echo URL;?>/admin-panel/category-list?catid=<?php echo $row['cat_id'];?>"><?php echo $row['name_in_hebrew'];	?></a></td>
                                        <td class="flex text-right"><a href="#" target="_blank"><?php echo $row['categoryname'];?></a></td>
                                        
                                        <td class="flex text-right">
                                            <input type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" /> 
										    <input name="ids[]" type="hidden" value="<?php echo $row['cat_id']; ?>" />
                                        </td>
                                        <td class="flex text-right">
                                            <?php if($row['displayflag']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">מופעל</span> 
											<?php } elseif($row['displayflag']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">נכים</span> 
											<?php } ?>
                                        </td>
                                        <td class="text-left">
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cat_id']; ?>&page=<?php echo $page; ?>&catid=<?php echo $_REQUEST['catid'];?>&status=0&link=category-list.php&tb=<?php echo $sufix; ?>category&option=cat_id">נכים</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cat_id']; ?>&page=<?php echo $page; ?>&catid=<?php echo $_REQUEST['catid'];?>&status=1&link=category-list.php&tb=<?php echo $sufix; ?>category&option=cat_id">מופעל</a>
													<?php } ?> 
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['cat_id']; ?>&page=<?php echo $page; ?>&catid=<?php echo $_REQUEST['catid'];?>&status=1&link=category-list.php&tb=<?php echo $sufix; ?>category&option=cat_id" onclick="return confirm('Are you sure to delete this?')" >למחוק</a>
													<a class="dropdown-item edit" href="add-category.php?option=Edit&id=<?php echo $row['cat_id']; ?>&catid=<?php echo $_REQUEST['catid'];?>&page=<?php echo $page; ?>">ערוך</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'category-list.php',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">סך הכל <span id="count"><?php echo $num; ?></span> פריטים</small> 
                            <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">למחוק</button> &nbsp;&nbsp;
                            <button  type="button" onclick="upsort();" class="btn  bg-primary-lt pull-right"> עדכן מזהה מיון</button>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            
            
            
            <?php } else { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/category-list"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;VIEW ALL CATEGORY</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-category.php?catid=<?php echo $_REQUEST['catid']; ?>" class="btn w-sm mb-1 btn-primary">Add Category</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="custom-select " name="catid" onchange="this.form.submit()">
                                            <option value="">Select Category</option>
                                            <?php
                                            $sqlc=mysqli_query($conn,"select * from shopurneeds_category where parent='".$catid."'");
                                            while($rowc=mysqli_fetch_array($sqlc))
                                            {
                                            ?>						
                                                <option value="<?php echo  $rowc['cat_id']; ?>"><?php echo $rowc['categoryname']; ?></option>						
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
                                                <input type="checkbox" id="check"  ><i></i></label>
                                        </th> 
                                        <th class="text-muted">Category Image</th> 
                                        <th class="text-muted">Category Name</th> 
                                        <th class="text-muted">Category Name in Hebrew</th>
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
											    $category_code=$row['cat_id']; 								
									?> 
                                    <tr class="v-middle" data-id="15">
                                        <td>
                                            <label class="ui-check m-0">
                                            <input type="checkbox" class="allcheck" name="cat_id[]" value="<?php echo $category_code; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex">
                                            <?php if($row['uploadimage1']!='') { ?> 
                                                <img src="../uploads/categoryimages/<?php echo $row['uploadimage1']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="../assets/default.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><a href="<?php echo URL;?>/admin-panel/category-list?catid=<?php echo $row['cat_id'];?>"><?php echo $row['categoryname'];	?></a></td>
                                        <td class="flex"><a href="#" target="_blank"><?php echo $row['name_in_hebrew'];?></a></td>
                                        
                                        <td class="flex">
                                            <input type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" /> 
										    <input name="ids[]" type="hidden" value="<?php echo $row['cat_id']; ?>" />
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cat_id']; ?>&page=<?php echo $page; ?>&catid=<?php echo $_REQUEST['catid'];?>&status=0&link=category-list.php&tb=<?php echo $sufix; ?>category&option=cat_id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cat_id']; ?>&page=<?php echo $page; ?>&catid=<?php echo $_REQUEST['catid'];?>&status=1&link=category-list.php&tb=<?php echo $sufix; ?>category&option=cat_id">Enable</a>
													<?php } ?>
													
														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['cat_id']; ?>&page=<?php echo $page; ?>&catid=<?php echo $_REQUEST['catid'];?>&status=1&link=category-list.php&tb=<?php echo $sufix; ?>category&option=cat_id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-category.php?option=Edit&id=<?php echo $row['cat_id']; ?>&catid=<?php echo $_REQUEST['catid'];?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'category-list.php',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small> 
                            <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">Delete</button> &nbsp;&nbsp;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript">
function upsort()
{ 
	document.category.action='sort-category.php';
	document.category.submit();
} 
function sure(vr, ac)
{
    var cat_check = $('input[name="cat_id[]"]:checked').length; 
    if(cat_check > 0)
    {  
    	var sur=confirm("Are you sure ! You want to "+ ac +" Category from this list");
    	if(sur==true)
    	{
    	    
    	    
    		document.category.action='delete-records.php';
    		document.category.submit();
    		return true;
    	}
    	else
    	{
    		return false;
    	} 
    }
    else
    {
        alert("please select records!");
    }
}
$(document).ready(function(){ 
    $("#check").click(function(){  
        $(".allcheck").not(this).prop('checked', this.checked);
    });
});
</script>
        