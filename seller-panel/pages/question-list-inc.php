<?php    
    $sql="select * from ".$sufix."questions   "; 
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
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight"><a href="<?php echo URL; ?>/admin-panel/static-pages"><i data-feather="home" style="font-size:20px;"></i> </a>&nbsp;&nbsp;All Questions</h2></div> 
                    <div class="flex"></div>
                    <div><a href="add-question" class="btn w-sm mb-1 btn-primary">Add</a></div>
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
                                        <th class="text-muted">Question</th>  
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
                                        
                                        <td class="flex"><?php echo $row['question'];	?></td> 
                                      
                                        <td>
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=0&link=question-list&tb=<?php echo $sufix; ?>questions&option=id">Disable</a> 
													<?php } elseif($row['displayflag']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&status=1&link=question-list&tb=<?php echo $sufix; ?>questions&option=id">Enable</a>
													<?php } ?>
													
														<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&link=question-list&tb=<?php echo $sufix; ?>questions&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-question.php?option=Edit&id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>">Edit</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                        </div>
                        <div class="d-flex"> 
                            <?php pagingall($offset,$num,'question-list',$page,$no_page,$display_range); ?> 
                            <small class="text-muted py-2 mx-2">Total <span id="count"><?php echo $num; ?></span> items</small>  
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
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
        