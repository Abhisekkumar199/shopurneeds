<?php 
    
    $sql_brand = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."brand where bid='".$_REQUEST['id']."'")) ;
    
    if($_REQUEST['logo_delete_id']!='') 
    {
        $file = "../uploads/brandimages/".$sql_brand['uploadimage1']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."brand set uploadimage1='' where bid='".$_REQUEST['logo_delete_id']."'");
    }
    if($_REQUEST['banner_delete_id']!='') 
    {
        $file = "../uploads/brandimages/".$sql_brand['uploadimage']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."brand set uploadimage='' where bid='".$_REQUEST['banner_delete_id']."'");
         
    }
    if($_REQUEST['certificate_delete_id']!='') 
    {
        $file = "../uploads/brandcertificate/".$sql_brand['certificate']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."brand set certificate='' where bid='".$_REQUEST['certificate_delete_id']."'");
         
    }
    
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."brand where bid='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight">ADD Brand</h2>
                </div>
                <div class="flex"></div>
                <div><a href="brand-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Brand</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="brand-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <label class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="brand_category" class="form-control col-md-4">
                                            <option value="">Select</option>
    								  	    <?php
    								  	        $sql_cat = mysqli_query($conn,"select * from shopurneeds_category where parent = 0 and displayflag='1'"); 
    								  	        while($rows_cat = mysqli_fetch_assoc($sql_cat))
    								  	        {
    								  	    ?>
    								  	    <option value="<?php echo $rows_cat['cat_id']; ?>" <?php if($rows['brand_category'] == $rows_cat['cat_id']) { echo "selected";}  ?>><?php echo $rows_cat['categoryname']; ?></option>
    								  	    <?php } ?>
    								    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Brand Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="brandname" id="brandname" value="<?php echo $rows['brandname']; ?>" class="form-control" placeholder="Brand Name">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Brand Logo</label>
                                    <div class="col-sm-9">
                                        <input name="image1" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['uploadimage1']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/brandimages/<?php echo $rows['uploadimage1']; ?>" width="120"  /><br />
										<strong>Existing Image</strong>
										<a href="<?php echo URL;?>/admin-panel/add-brand.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&logo_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage1" value="<?php echo $rows['uploadimage1']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload Banner</label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['uploadimage']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/brandimages/<?php echo $rows['uploadimage']; ?>" width="120"  /><br />
										<strong>Existing Image</strong>
										<a href="<?php echo URL;?>/admin-panel/add-brand.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&banner_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['uploadimage']; ?>"  />
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload Brand Patent Certificate</label>
                                    <div class="col-sm-9">
                                        <input name="certificate" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['certificate']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/brandcertificate/<?php echo $rows['certificate']; ?>" width="120"  /><br />
										<strong>Existing Image</strong>
										<a href="<?php echo URL;?>/admin-panel/add-brand.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&certificate_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
										 
										<?php } ?> 
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
                                        <label class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="website" id="website" value="<?php echo $rows['website']; ?>" class="form-control" placeholder="Brand Website">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Short Description </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="short_description" id="short_description" value="<?php echo $rows['short_description']; ?>" class="form-control" placeholder="Short Description">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brand Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_description" id="long_description" rows="4"><?php echo $rows['long_description']; ?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brand Meta Title</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="metatitle" id="metatitle" rows="4"><?php echo $rows['metatitle']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brand Meta Keyword</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="metakeyword" id="metakeyword" rows="4"><?php echo $rows['metakeyword']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brand Meta Keywords</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="metadescription" id="metadescription" rows="4" ><?php echo $rows['metadescription']; ?></textarea>
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
                <button type="submit" class="brand btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.brand').click(function(){ 
	var brandname = $('#brandname').val();   
	var short_description = $('#short_description').val(); 
	if(brandname == '')
	{  
		$('#brandname').css("border","1px solid red");
		$('#brandname').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter brand name</div>");
		return false;
	}
	else
	{ 
		$('#brandname').css("border","1px solid #bdb9b9"); 
	} 
    
    
    if(short_description == '')
	{  
		$('#short_description').css("border","1px solid red");
		$('#short_description').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter short description</div>");
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