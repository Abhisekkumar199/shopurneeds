<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_attribute = mysqli_query($conn,"select * from ".$sufix."color_code where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_attribute); 
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
                    <h2 class="text-md text-highlight"><?php echo $option; ?> Color</h2>
                </div>
                <div class="flex"></div>
                <div><a href="attributevalue-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Attribute Value</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="color-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Color Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="color_name" id="color_name" value="<?php echo $rows['name']; ?>" class="form-control" placeholder="Color Name">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Color Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="color_code" id="color_code" value="<?php echo $rows['code']; ?>" class="form-control" placeholder="Color Code">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9"> 
                                            <select name="category[]" id="category" class="form-control col-md-4" multiple="multiple" style="height:300px;width:200px;"> 
        								  	    <?php 
        								  	        $sql_cat = mysqli_query($conn,"select * from ".$sufix."category where displayflag='1'");
        								  	        while($rows_cat = mysqli_fetch_assoc($sql_cat))
        								  	        {
        								  	    ?>
        								  	    <option value="<?php echo $rows_cat['cat_id']; ?>" <?php if($rows['cat_id']== $rows_cat['cat_id']) { echo "Selected"; } ?>><?php echo $rows_cat['categoryname']; ?></option> 
        								  	    <?php } ?>
        								    </select>
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
                                </div>
                            </div> 
                        </div>
                    </div>  
                <button type="submit" class="color btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.color').click(function(){ 
	var color_name = $('#color_name').val();   
	var category = $('#category').val(); 
	if(color_name == '')
	{  
		$('#color_name').css("border","1px solid red");
		$('#color_name').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter color!</div>");
		return false;
	}
	else
	{ 
		$('#color_name').css("border","1px solid #bdb9b9"); 
	}   
	
	if(category == '')
	{  
		$('#category').css("border","1px solid red");
		$('#category').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please select category!</div>");
		return false;
	}
	else
	{ 
		$('#category').css("border","1px solid #bdb9b9"); 
	}  
}); 
</script> 