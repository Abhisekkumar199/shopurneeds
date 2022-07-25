<?php  
    if($_REQUEST['cateidd']!='') 
    {
        $delcat = mysqli_query($conn,"delete from ".$sufix."brand where id='".$_REQUEST['cateidd']."'");
    }
      
    if($_REQUEST['menuid']=="")
    {
        $menuid="0";
    }
    else
    {
        $menuid=$_REQUEST['menuid'];
    }
    $sql="select * from ".$sufix."brand where seller_id='".$_SESSION['sellerid']."'";  
    $sql .= " order by bid desc "; 
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
                        <h2 class="text-md text-highlight">VIEW ALL BRAND</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-brand" class="btn w-sm mb-1 btn-primary">Add Brand</a></div>
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
                                            <input type="checkbox" id="check"><i></i></label>
                                        </th> 
                                        <th class="text-muted">Brand Logo</th> 
                                        <th class="text-muted">Brand Name</th> 
                                        <th class="text-muted">Slug</th>
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
                                                <input type="checkbox" class="allcheck"  name="brand_id[]" value="<?php echo $row['bid']; ?>"  > <i></i></label>
                                        </td>
                                        <td class="flex">
                                            <?php if($row['uploadimage1']!='') { ?> 
                                                <img src="../uploads/brandimages/<?php echo $row['uploadimage1']; ?>" width="70"  /> 
                                            <?php } else { ?>
                                                <img src="../asset/img/default.png" width="50"  /> 
                                            <?php } ?>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['brandname'];	?></a> </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['brandslug'];	?></a> </td> 
                                        <td class="flex">
                                            <input type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" /> 
										    <input name="ids[]" type="hidden" value="<?php echo $row['bid']; ?>" />
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['bid']; ?>&page=<?php echo $page; ?>&status=0&link=brand-list.php&tb=<?php echo $sufix; ?>brand&option=bid">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['bid']; ?>&page=<?php echo $page; ?>&status=1&link=brand-list.php&tb=<?php echo $sufix; ?>brand&option=bid">Enable</a>
													<?php } ?>
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['bid']; ?>&page=<?php echo $page; ?>&link=brand-list.php&tb=<?php echo $sufix; ?>brand&option=bid" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
																				
													<a class="dropdown-item edit" href="add-brand.php?option=Edit&id=<?php echo $row['bid']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'brand-list.php',$page,$no_page,$display_range); ?>
                            <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small> 
                                <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">Delete</button> &nbsp;&nbsp;
                            <button  type="button" onclick="upsort();" class="btn  bg-primary-lt pull-right">Update Sort ID</button>
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
	document.brand.action='sort-brand.php';
	document.brand.submit();
} 
function sure(vr, ac)
{
    var brand_check = $('input[name="brand_id[]"]:checked').length; 
    if(brand_check > 0)
    {  
    	var sur=confirm("Are you sure ! You want to delete records?");
    	if(sur==true)
    	{ 
    		document.brand.action='delete-records.php';
    		document.brand.submit();
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
        
        