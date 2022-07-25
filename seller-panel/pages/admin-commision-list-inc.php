<?php  
    if($_REQUEST['cateidd']!='') 
    {
        $delcat = mysqli_query($conn,"delete from ".$sufix."menu_permission where id='".$_REQUEST['cateidd']."'");
    }
      
    if($_REQUEST['menuid']=="")
    {
        $menuid="0";
    }
    else
    {
        $menuid=$_REQUEST['menuid'];
    }
    $sql="select * from ".$sufix."menu_permission where parent='".$menuid."'";  
    $sql .= " order by id desc "; 
    $sql1=mysqli_query($conn,$sql);
    $offset = 50;
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
                        <h2 class="text-md text-highlight">VIEW ALL MENU</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-menu.php?menuid=<?php echo $_REQUEST['menuid']; ?>" class="btn w-sm mb-1 btn-primary">Add Menu</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="custom-select " name="menuid" onchange="this.form.submit()">
                                            <option value="">Select Menu</option>
                                            <?php
                                            $sqlc=mysqli_query($conn,"select * from shopurneeds_menu_permission where parent='".$menuid."'");
                                            while($rowc=mysqli_fetch_array($sqlc))
                                            {
                                            ?>						
                                            <option value="<?php echo  $rowc['id']; ?>"><?php echo $rowc['menu']; ?></option>						
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
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox"><i></i></label>
                                        </th> 
                                        <th class="text-muted">Menu Name</th> 
                                        <th class="text-muted">Menu Link</th>
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
											    $category_code=$row['id']; 								
									?> 
                                    <tr class="v-middle" data-id="15">
                                        <td>
                                            <label class="ui-check m-0">
                                                <input type="checkbox" name="menu_id[]" value="<?php echo $category_code; ?>" <?php if($row['position']=='Top') { ?> checked="checked" <?php } ?> > <i></i></label>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['menu'];	?></a> </td>
                                        <td class="flex"><?php echo $row['link'];	?> </td>
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&menuid=<?php echo $_REQUEST['menuid'];?>&status=0&link=menu-list.php&tb=<?php echo $sufix; ?>menu_permission&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&menuid=<?php echo $_REQUEST['menuid'];?>&status=1&link=menu-list.php&tb=<?php echo $sufix; ?>menu_permission&option=id">Enable</a>
													<?php } ?>							
													<a class="dropdown-item edit" href="add-menu.php?option=Edit&id=<?php echo $row['id']; ?>&menuid=<?php echo $_REQUEST['menuid'];?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                                <?php pagingall($offset,$num,'menu_list.php',$page,$no_page,$display_range); ?>
                               <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>
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
	document.category.action='sort_menu.php';
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
        