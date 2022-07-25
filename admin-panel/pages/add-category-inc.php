<?php 
    
    $sql_cat = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."category where cat_id='".$_REQUEST['id']."'")) ;
    
    if($_REQUEST['thumb_delete_id']!='') 
    {
        $file = "../uploads/categoryimages/".$sql_cat['uploadimage1']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."category set uploadimage1='' where cat_id='".$_REQUEST['logo_delete_id']."'");
    }
    if($_REQUEST['banner_delete_id']!='') 
    {
        $file = "../uploads/categoryimages/".$sql_cat['uploadimage']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."category set uploadimage='' where cat_id='".$_REQUEST['banner_delete_id']."'");
         
    }
    
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."category where cat_id='".$_REQUEST['id']."'") ;
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
            <form name="addForm" id="addForm" action="category-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="parent"  value="<?php echo $_REQUEST['catid']; ?>"  />	 
            <input type="hidden" name="catid"  value="<?php echo $_REQUEST['catid']; ?>"  /> 
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
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mark as Top Category</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="topcat" id="topcat" value='1'   <?php if($rows['topcat'] == '1'){ echo "checked"; } ?> />
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name" value="<?php echo $rows['categoryname']; ?>" class="form-control" placeholder="Category Name">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Category Thumb</label>
                                    <div class="col-sm-9">
                                        <input name="image1" type="file" size=20 class="form-control col-md-3" /> &nbsp;(Size : width 900, height 506) 
 										<?php if($rows['uploadimage1']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/categoryimages/<?php echo $rows['uploadimage1']; ?>" width="120"  /><br />
										<strong>Existing Image</strong>
										<a href="<?php echo URL;?>/admin-panel/add-category.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&thumb_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage1" value="<?php echo $rows['uploadimage1']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload Banner</label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file" size=20 class="form-control col-md-3" /> &nbsp;(Size : width 900, height 506) 
 										<?php if($rows['uploadimage']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/categoryimages/<?php echo $rows['uploadimage']; ?>" width="120"  /><br />
										<strong>Existing Image</strong>
										<a href="<?php echo URL;?>/admin-panel/add-category.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&banner_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['uploadimage']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Attribute</label>
                                    <div class="col-sm-9">
                                        <?php $atr_array = explode(',',$rows['attribute']); ?>
                                        <select name="atr_id[]" class="form-control col-md-4" multiple="multiple" style="height:250px;"> 
                                            <?php 
    								  	        $sql_atr = mysqli_query($conn,"select * from ".$sufix."attributes where displayflag='1'");
    								  	        while($rows_atr = mysqli_fetch_assoc($sql_atr))
    								  	        {
    								  	    ?>
    								  	    <option value="<?php echo $rows_atr['atr_id']; ?>" <?php if (in_array($rows_atr['atr_id'], $atr_array)) { echo "Selected"; } ?>><?php echo $rows_atr['attributename']; ?></option> 
    								  	    <?php } ?>
    								    </select>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>  
            <div class="padding">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                               <div class="card-body"> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="long_description" id="shorlong_descriptiont_description" value="<?php echo $rows['long_description']; ?>" class="form-control" placeholder="Description">
                                        </div>
                                    </div> 
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta Title</label>
                                        <div class="col-sm-9"> 
                                            <input type="text" name="metatitle" id="metatitle" value="<?php echo $rows['metatitle']; ?>" class="form-control" placeholder="Meta Title"> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta Keyword</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="metakeyword" id="metakeyword" value="<?php echo $rows['metakeyword']; ?>" class="form-control" placeholder="Meta Keyword">  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Meta Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="metadescription" id="metadescription" value="<?php echo $rows['metadescription']; ?>" class="form-control" placeholder="Meta Description">   
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
                <button type="submit" class="category btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.category').click(function(){ 
	var name = $('#name').val();   
	var short_description = $('#short_description').val(); 
	if(name == '')
	{  
		$('#name').css("border","1px solid red");
		$('#name').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter category name</div>");
		return false;
	}
	else
	{ 
		$('#name').css("border","1px solid #bdb9b9"); 
	} 
    
    
    if(short_description == '')
	{  
		$('#short_description').css("border","1px solid red");
		$('#short_description').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter short</div>");
		return false;
	}
	else
	{ 
		$('#short_description').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
    
}); 


 $('textarea').each(function(){
		CKEDITOR.replace(this.name,{
		toolbar: [
			{ name: 'document', items: [ 'Source','-','Print','-','Preview','-','Bold','-', 'Italic','-','Underline','-','list','-','align','-','NumberedList','-','BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','-','JustifyCenter','-','JustifyRight','-','JustifyBlock','-','Maximize','-','spellchecker','-','Link','-','Image','-','Table','-','Smiley','-','SpecialChar','-','TextColor', 'BGColor','Format', 'Font','FontSize','-'] }        		
			
		]
	});
});


</script>
 