<?php  
    if($_REQUEST['cateidd']!='') 
    {
        $delcat = mysqli_query($conn,"delete from ".$sufix."attributevalue where atr_val_id='".$_REQUEST['cateidd']."'");
    }
    
    $sql="select *,av.displayflag as displayflag1 from ".$sufix."attributevalue av inner join ".$sufix."attributes a on av.atr_id = a.atr_id ";  
    $sql .= " order by av.atr_val_id desc "; 
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
            <?php if($_SESSION['admin_language'] == 'HE') { ?> 
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">  ערך תכונה</h2></div> 
                    <div class="flex"></div>
                    <div ><a  style="width:170px;" href="add-attribute-value" class="btn w-sm mb-1 btn-primary"> הוסף ערך תכונה </a></div>
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
                        <form name="attributevalue" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th class="text-right" style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox" id="check"><i></i></label>
                                        </th> 
                                        <th class="text-muted text-right "> ערך תכונה </th> 
                                        <th class="text-muted text-right">ערך תכונה בעברית</th> 
                                        <th class="text-muted text-right"> ערך תכונה בעברית</th>  
                                        <th class="text-muted text-right"> שם מאפיין</th>
                                        <th class="text-left" style="width:50px">סטטוס</th> 
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
                                        <td class="text-right">
                                            <label class="ui-check m-0">
                                            <input type="checkbox" class="allcheck" name="atr_val_id[]" value="<?php echo $row['atr_val_id']; ?>"   > <i></i></label>
                                        </td>
                                        <td class="flex text-right"><a href="#" class="item-title text-color"><?php echo $row['attributevaluename'];	?></a> </td> 
                                        <td class="flex text-right"><a href="#" class="item-title text-color"><?php echo $row['attributevaluename_in_hebrew'];	?></a> </td> 
                                        <td class="flex text-right"><a href="#" class="item-title text-color"><?php echo $row['attributename_in_hebrew'];	?></a> </td> 
                                         
                                        <td class="flex text-right">
                                            <?php if($row['displayflag1']==1) { ?>
											    <span class="badge badge-primary  text-uppercase">לאפשר</span> 
											<?php } elseif($row['displayflag1']==0) { ?>												
												 <span class="badge badge-danger text-uppercase">השבת</span> 
											<?php } ?>
                                        </td>
                                        <td class="text-left">
                                            <div class="item-action dropdown">
                                                <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                                    <?php if($row['displayflag1']==1) { ?>
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>&status=0&link=attributevalue-list.php&tb=<?php echo $sufix; ?>attributevalue&option=atr_val_id">השבת</a> 
													<?php } elseif($row['displayflag1']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>&status=1&link=attributevalue-list.php&tb=<?php echo $sufix; ?>attributevalue&option=atr_val_id">לאפשר</a>
													<?php } ?>	
													
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>&link=attributevalue-list.php&tb=<?php echo $sufix; ?>attributevalue&option=atr_val_id" onclick="return confirm('Are you sure to delete this?')" >למחוק</a>
													<a class="dropdown-item edit" href="add-attribute-value.php?option=Edit&id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>">ערוך</a> 
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
                               <small class="text-muted py-2 mx-2">מוצרים <span id="count"><?php echo $num; ?></span> סך הכל</small>
                                <button  type="button" onclick="sure();" class="btn  bg-primary-lt pull-right">למחוק</button> &nbsp;&nbsp;
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
            <?php } else { ?>
            <div class="page-hero page-container" id="page-hero">
                <div class="padding d-flex">
                    <div class="page-title">
                        <h2 class="text-md text-highlight">Attribute Value</h2></div> 
                    <div class="flex"></div>
                    <div ><a  style="width:170px;" href="add-attribute-value" class="btn w-sm mb-1 btn-primary">Add Attribute Value</a></div>
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
                        <form name="attributevalue" method="post" action="#">
                        <div class="table-responsive">
                            <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                                <input type="checkbox" id="check"><i></i></label>
                                        </th> 
                                        <th class="text-muted">Attribute Value</th> 
                                        <th class="text-muted">Attribute Value in Hebrew</th> 
                                        <th class="text-muted">Attribute Name</th>  
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
                                            <input type="checkbox" class="allcheck" name="atr_val_id[]" value="<?php echo $row['atr_val_id']; ?>"   > <i></i></label>
                                        </td>
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['attributevaluename'];	?></a> </td> 
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['attributevaluename_in_hebrew'];	?></a> </td> 
                                        <td class="flex"><a href="#" class="item-title text-color"><?php echo $row['attributename'];	?></a> </td> 
                                         
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
													    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>&status=0&link=attributevalue-list.php&tb=<?php echo $sufix; ?>attributevalue&option=atr_val_id">Disable</a> 
													<?php } elseif($row['displayflag1']==0) { ?>												
														<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>&status=1&link=attributevalue-list.php&tb=<?php echo $sufix; ?>attributevalue&option=atr_val_id">Enable</a>
													<?php } ?>	
													
													<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>&link=attributevalue-list.php&tb=<?php echo $sufix; ?>attributevalue&option=atr_val_id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
													<a class="dropdown-item edit" href="add-attribute-value.php?option=Edit&id=<?php echo $row['atr_val_id']; ?>&page=<?php echo $page; ?>">Edit</a> 
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
            <?php } ?>
        </div>
        <!-- ############ Main END-->
    </div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
function upsort()
{
	document.attributevalue.action='sort-attributevalue.php';
	document.attributevalue.submit();
} 
function sure(vr, ac)
{
    var atr_val_check = $('input[name="atr_val_id[]"]:checked').length; 
    if(atr_val_check > 0)
    {  
    	var sur=confirm("Are you sure ! You want to delete records ?");
    	if(sur==true)
    	{ 
    		document.attributevalue.action='delete-records.php';
    		document.attributevalue.submit();
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
        