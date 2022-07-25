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
                    <h2 class="text-md text-highlight">Import Product</h2>
                </div>
                <div class="flex"></div>
                <div><a href="product-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Products</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <?php if($_REQUEST['insertid']=="") { ?>
            <?php echo session_msg(); ?> 
            <form name="addForm" id="addForm" action="import-product-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data">
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
                                    <label class="col-sm-3 col-form-label">Upload CSV file</label>
                                    <div class="col-sm-9">
                                        <input name="uploaded" type="file" size=20 class="form-control col-md-3" required /> &nbsp;(Size : width 900, height 506)  
                                    </div>
                                </div>
                                
                                <button type="submit" name="upfile" class="category btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>   
            </form>
            <?php } else { ?>
            <form name="addForm" id="addForm" action="import-product-final-step-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="insertid"  value="<?php echo $_REQUEST['insertid']; ?>"  />	  
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
                                    <label class="col-sm-3 col-form-label">Upload CSV file</label>
                                    <div class="col-sm-9">
                                        <?php 
                                        $sqlasdas=mysql_query("select * from dorbby_product_dummy where uploaderror !='0' and insertid='".$_REQUEST['insertid']."'");
                                        $numsdsd=mysql_num_rows($sqlasdas);
                                        if($numsdsd==0)
                                        {  
                                        ?>
                                        <p>Product Uploaded Successfully, Please click here to complete the upload process		</p>
                                        <button type="submit" class="category btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
                                            <?php } else { ?>
                                            <?php while($rowss=mysql_fetch_array($sqlasdas)) { ?>
												<p> <?php echo  $rowss ['sku'];?>-<?php echo  $rowss ['product_title'];?> Contain Error, Please check. <?php if($rowss['uploaderror']=="1") { echo "mandatory field missing"; }?><?php if($rowss['uploaderror']=="2") { echo "SKU already exist."; }?></p>
										    <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>   
            </form>
            
            <?php } ?>
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
 