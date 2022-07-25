<?php  
    if($_REQUEST['delete_catid']!='') 
	{
		$delcat = mysqli_query($conn,"delete from ".$sufix."category where cat_id='".$_REQUEST['delete_catid']."'");
		$delcat = mysqli_query($conn,"delete from ".$sufix."slug_master where slugtype='category' and slugname='".$_REQUEST['delete_slug']."'");
	} 
	
	
	if($_REQUEST['page'] == '')
    {
        $page = 1;
    }
    else
    {
        $page = $_REQUEST['page'];
    }
	 
    $sql="select * from ".$sufix."banners"; 
    if($_REQUEST['bposition1']!="")
    {
        $sql .= " where bposition='".$_REQUEST['bposition1']."' ";
    } 
    $sql .= " order by id desc"; 
	$sql1=mysqli_query($conn,$sql);
	$num=mysqli_num_rows($sql1);	
	$offset = 20;
	$display_range = 10;
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
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/banner-list"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;VIEW ALL BANNER</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-banner.php" class="btn w-sm mb-1 btn-primary">Add Banner</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar"> 
                            <form action="" method="get" name="sps" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="custom-select " name="bposition1" onchange="this.form.submit()">
                                            <option value="">Select Position</option> 
                                            <option value="Header" <?php if($_REQUEST['bposition1']=="Header") echo "Selected";?>>Header</option> 
                                            <option value="Slider" <?php if($_REQUEST['bposition1']=="Slider") echo "Selected";?>>Slider</option>  
                                            <option value="Below Slider" <?php if($_REQUEST['bposition1']=="Below Slider") echo "Selected";?>>Below Slider</option> 
                                            <option value="Top Right" <?php if($_REQUEST['bposition1']=="Top Right") echo "Selected";?>>Top Right</option>  
											<option value="Index Bottom Slider" <?php if($_REQUEST['bposition1']=="Index Bottom Slider") echo "Selected";?>>Index Bottom Slider</option>
											
											<option value="Center Bottom" <?php if($_REQUEST['bposition1']=="Center Bottom") echo "Selected";?>>Center Bottom</option>
											<option value="Above Footer" <?php if($_REQUEST['bposition1']=="Above Footer") echo "Selected";?>>Above Footer</option>
										    <option value="Below Footer" <?php if($_REQUEST['bposition1']=="Below Footer") echo "Selected";?>>Below Footer</option>	 
										    <option value="Mobile Banner" <?php if($_REQUEST['bposition1']=="Mobile Banner") echo "Selected";?>>Mobile Banner</option>	 

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
                                        <th class="text-muted">Banner Image</th> 
                                        <th class="text-muted">Banner Name</th> 
                                        <th class="text-muted">Link</th> 
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
                                            <?php if($row['uploadimage']!='') { ?> 
                                                <img src="../uploads/bannerimages/<?php echo $row['uploadimage']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="<?php echo URL ?>/admin-panel/assets/img/category.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><?php echo $row['bannername'];	?></td>
                                        <td class="flex"><a href="<?php echo URL;?>/<?php echo $row['cat_slug'];?>" target="_blank"><?php echo $row['externallink']; ?></a></td>
                                         
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=banner-list.php&tb=<?php echo $sufix; ?>banners&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=banner-list.php&tb=<?php echo $sufix; ?>banners&option=id">Enable</a>
													<?php } ?>
													
														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=banner-list.php&tb=<?php echo $sufix; ?>banners&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-banner.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'banner-list.php',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>  
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- ############ Main END-->
    </div> 

        