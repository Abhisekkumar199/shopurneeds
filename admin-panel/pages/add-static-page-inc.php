<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."static_pages where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_menu); 
    	$option="Edit"; 
    }
    else
    {
        $option="Add";  
    } 
    
    if($_REQUEST['image_delete_id']!='') 
    {
        $file = "../uploads/staticpageimages/".$rows['imageupload']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."static_pages set imageupload='' where id='".$_REQUEST['image_delete_id']."'");
    }
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight">Add Page</h2>
                </div>
                <div class="flex"></div>
                <div><a href="static-pages" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Page</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="static-page-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <label class="col-sm-3 col-form-label">Heading</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="heading" id="heading" value="<?php echo $rows['heading']; ?>" class="form-control" placeholder="Heading">
                                    </div>
                                </div> 
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload Image</label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file" size=20 class="form-control col-md-3" /> &nbsp;(Size : width 900, height 506) 
 										<?php if($rows['imageupload']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/staticpageimages/<?php echo $rows['imageupload']; ?>" width="120"  /><br />
										<strong>Existing Image</strong>
										<a href="<?php echo URL;?>/admin-panel/add-static-page.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&image_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['imageupload']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description" rows="4"><?php echo $rows['description']; ?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="metatitle" id="metatitle" rows="4"><?php echo $rows['metatitle']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Meta Keyword</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="metakeyword" id="metakeyword" rows="4"><?php echo $rows['metakeyword']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Meta Description</label>
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
                                <button type="submit" class="pages btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
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
    $('.pages').click(function(){ 
	var heading = $('#heading').val();   
	var description = $('#description').val();  
	var status = $('#status').val();  
	if(heading == '')
	{  
		$('#heading').css("border","1px solid red");
		$('#heading').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter heading</div>");
		return false;
	}
	else
	{ 
		$('#heading').css("border","1px solid #bdb9b9"); 
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