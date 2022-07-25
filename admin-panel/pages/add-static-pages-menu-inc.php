<?php 
    
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."top_navigation where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_menu); 
    	$option="Edit"; 
    }
    else
    {
        $option="Add";  
    } 
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight">ADD Category</h2>
                </div>
                <div class="flex"></div>
                <div><a href="category-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Category</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="static-pages-menu-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="parent"  value="<?php echo $_REQUEST['parentid']; ?>"  />	 
            <input type="hidden" name="id"  value="<?php echo $_REQUEST['id']; ?>"  />
            <div class="padding"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="col-md-3"> 
                                    <span id="message"> </span>
                                </div>
                                <div class="col-md-9"> 
                                </div>
                                <div class="clearfix"></div>
                                <?php if($_REQUEST['parent'] == '') { ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Menu Position</label>
                                    <div class="col-sm-9">
                                        <?php   $menuposition_array = explode(',',$rows['menuposition']);  ?>
                                        <select name="menuposition[]" class="form-control col-md-4" multiple="multiple">  
                                        <option value="Top" <?php if(in_array("Top", $menuposition_array)) { echo "selected";} ?>>Top</option>
                                        <option value="Header" <?php if(in_array("Header", $menuposition_array)) { echo "selected";} ?>>Header</option> 
                                        <option value="Footer" <?php if(in_array("Footer", $menuposition_array)) { echo "selected";} ?>>Footer</option>
                                        <option value="Bottom" <?php if(in_array("Bottom", $menuposition_array)) { echo "selected";} ?>>Bottom</option> 
    								    </select> 
                                    </div>
                                </div>
                                <?php } else { ?>
                                <?php } ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Select Page</label>
                                    <div class="col-sm-9"> 
                                        <select name="pageid" class="form-control col-md-4"  > 
                                            <option value="">Select</option>
                                            <?php 
    								  	        $sql_pages = mysqli_query($conn,"select * from ".$sufix."static_pages where displayflag='1'");
    								  	        while($rows_pages = mysqli_fetch_assoc($sql_pages))
    								  	        {
    								  	    ?>
    								  	    <option value="<?php echo $rows_pages['id']; ?>" <?php if ($rows_pages['id'] == $rows['pageid']) { echo "Selected"; } ?>><?php echo $rows_pages['heading']; ?></option> 
    								  	    <?php } ?>
    								    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="itemname" id="itemname" value="<?php echo $rows['itemname']; ?>" class="form-control" placeholder="Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="targetlink" id="targetlink" value="<?php echo $rows['targetlink']; ?>" class="form-control" placeholder="URL">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description" rows="4"><?php echo $rows['description']; ?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control col-md-4">
    								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>>Enable</option>
        									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>>Disable</option> 
    								    </select>
                                    </div>
                                </div>  
                                <button type="submit" class="menu btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>  
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.menu').click(function(){ 
	var itemname = $('#itemname').val();    
	if(itemname == '')
	{  
		$('#itemname').css("border","1px solid red");
		$('#itemname').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter title name</div>");
		return false;
	}
	else
	{ 
		$('#itemname').css("border","1px solid #bdb9b9"); 
	}
}); 
</script> 