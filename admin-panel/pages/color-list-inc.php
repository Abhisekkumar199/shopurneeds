<?php  
    if($_REQUEST['cateidd']!='') 
    {
        $delcat = mysqli_query($conn,"delete from ".$sufix."color_code where id='".$_REQUEST['cateidd']."'");
    }
    
    $sql="select *,cc.displayflag as displayflag1,cc.adddate as color_as_date from ".$sufix."color_code cc inner join ".$sufix."category c on cc.cat_id = c.cat_id ";  
    $sql .= " order by cc.name asc "; 
    $sql1=mysqli_query($conn,$sql);
    $offset = 50; 
    if($_REQUEST['page'] == '')
    {
        $page = 1;
    }
    else
    {
        $page = $_REQUEST['page'];
    }
    $display_range = 10;
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
                        <h2 class="text-md text-highlight">Color List</h2></div> 
                    <div class="flex"></div>
                    <div ><a  style="width:170px;" href="add-color.php" class="btn w-sm mb-1 btn-primary">Add Color</a></div>
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
                        <form name="color" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox" id="check"><i></i></label>
                                        </th> 
                                        <th class="text-muted">Color Name</th> 
                                        <th class="text-muted">Color Code</th> 
                                        <th class="text-muted">Category</th>  
                                        <th class="text-muted">Add Date</th> 
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
                                            <input type="checkbox" class="allcheck" name="color_id[]" value="<?php echo $row['id']; ?>"   > <i></i></label>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['name'];	?></a> </td> 
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['code'];	?></a> </td> 
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['categoryname'];	?></a> </td> 
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['color_as_date'];	?></a> </td> 
                                         
                                        <td class="flex">
                                            <?php if($row['displayflag1']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">Enabled</span> 
											<?php } elseif($row['displayflag1']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">Disabled</span> 
											<?php } ?>
                                        </td>
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag1']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=color-list&tb=<?php echo $sufix; ?>color_code&option=id">Disable</a> 
													<?php } elseif($row['displayflag1']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=color-list&tb=<?php echo $sufix; ?>color_code&option=id">Enable</a>
													<?php } ?>	
													
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=color-list&tb=<?php echo $sufix; ?>color_code&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-color?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                                <?php pagingall($offset,$num,'attributevalue-list.php',$page,$no_page,$display_range); ?>
                               <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>
                                <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">Delete</button> &nbsp;&nbsp;
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- ############ Main END-->
    </div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
function upsort()
{
	document.color.action='sort-color.php';
	document.color.submit();
} 
function sure(vr, ac)
{
    var id_check = $('input[name="color_id[]"]:checked').length; 
    if(id_check > 0)
    {  
    	var sur=confirm("Are you sure ! You want to delete records ?");
    	if(sur==true)
    	{ 
    		document.color.action='delete-records.php';
    		document.color.submit();
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
        