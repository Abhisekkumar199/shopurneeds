<?php  
    if($_REQUEST['city_id']!='') 
    {
        $delcat = mysqli_query($conn,"delete from ".$sufix."city where id='".$_REQUEST['city_id']."'");
    }
    
    $sql="select * from ".$sufix."city ";  
    $sql .= " order by cityname asc "; 
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
            <?php if($_SESSION['admin_language'] == 'AR') { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">قائمة المدن</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-city" class="btn w-sm mb-1 btn-primary">أضف مدينة</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar">  
                                <div class="row">  
                                        <?php  
                                            echo $_SESSION['message']; 
                	                        unset($_SESSION['message']); 
                	                    ?> 
                                </div> 
                        </div>
                        <form name="attribute" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox" id="check"><i></i></label>
                                        </th> 
                                        <th class="text-muted">اسم المدينة</th>   
                                        <th class="text-muted">اسم المدينة بالعربية</th>   
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
                                                <input type="checkbox" class="allcheck" name="city_id[]" value="<?php echo $row['cityid']; ?>"   > <i></i></label>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['cityname'];	?></a> </td>  
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['cityname_in_arabic'];	?></a> </td> 
                                         
                                         
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>&status=0&link=city-list.php&tb=<?php echo $sufix; ?>city&option=cityid">تعطيل</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>&status=1&link=city-list.php&tb=<?php echo $sufix; ?>city&option=cityid">ممكن</a>
													<?php } ?>	
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>&link=city-list.php&tb=<?php echo $sufix; ?>city&option=cityid" onclick="return confirm('Are you sure to delete this?')" >حذف</a>						
													<a class="dropdown-item edit" href="add-city.php?option=Edit&id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>">تعديل</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                                <?php pagingall($offset,$num,'city-list.php',$page,$no_page,$display_range); ?>
                               <small class="text-muted py-2 mx-2">مجموع <span id="count"><?php echo $num; ?></span> العناصر</small>
                                <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">حذف</button> &nbsp;&nbsp;
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <?php } else { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">City List</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-city" class="btn w-sm mb-1 btn-primary">Add City</a></div>
                </div>
            </div>
            <div class="page-content page-container" id="page-content">
                <div class="padding">
                    <div class="mb-5">
                        <div class="toolbar">  
                                <div class="row">  
                                        <?php  
                                            echo $_SESSION['message']; 
                	                        unset($_SESSION['message']); 
                	                    ?> 
                                </div> 
                        </div>
                        <form name="attribute" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox" id="check"><i></i></label>
                                        </th> 
                                        <th class="text-muted">City Name</th>   
                                        <th class="text-muted">City Name In Arabic</th>   
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
                                                <input type="checkbox" class="allcheck" name="city_id[]" value="<?php echo $row['cityid']; ?>"   > <i></i></label>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['cityname'];	?></a> </td>  
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['cityname_in_arabic'];	?></a> </td> 
                                         
                                         
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>&status=0&link=city-list.php&tb=<?php echo $sufix; ?>city&option=cityid">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>&status=1&link=city-list.php&tb=<?php echo $sufix; ?>city&option=cityid">Enable</a>
													<?php } ?>	
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>&link=city-list.php&tb=<?php echo $sufix; ?>city&option=cityid" onclick="return confirm('Are you sure to delete this?')" >Delete</a>						
													<a class="dropdown-item edit" href="add-city.php?option=Edit&id=<?php echo $row['cityid']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                                <?php pagingall($offset,$num,'city-list.php',$page,$no_page,$display_range); ?>
                               <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>
                                <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">Delete</button> &nbsp;&nbsp;
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
	document.attribute.action='sort-attribute.php';
	document.attribute.submit();
} 
function sure(vr, ac)
{
    var atr_check = $('input[name="atr_id[]"]:checked').length; 
    if(atr_check > 0)
    {  
    	var sur=confirm("Are you sure ! You want to delete records ?");
    	if(sur==true)
    	{ 
    		document.attribute.action='delete-records.php';
    		document.attribute.submit();
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
        