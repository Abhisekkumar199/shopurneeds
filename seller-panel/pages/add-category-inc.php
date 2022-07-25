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
                    <h2 class="text-md text-highlight"><?php if($_SESSION['admin_language'] == 'HE') { ?> הוסף קטגוריה <?php } else { ?>Add Category <?php } ?></h2>
                </div>
                <div class="flex"></div>
                <div><a href="category-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?> צפה בכל הקטגוריה <?php } else { ?>View All Category <?php } ?></span> <i data-feather="arrow-right"></i></a></div>
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
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם קטגוריה  <?php } else { ?>Category Name <?php } ?></label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3"> 
                                            <input type="text"  name="name" id="name" value="<?php echo $rows['categoryname']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם קטגוריה  <?php } else { ?>Category Name <?php } ?>">&nbsp;&nbsp; 
                                            <input type="text" name="name_in_hebrew" id="name_in_hebrew" value="<?php echo $rows['name_in_hebrew']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם קטגוריה  <?php } else { ?>שם קטגוריה בעברית <?php } ?>">
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>אגודל קטגוריה  <?php } else { ?>Category Thumb <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="image1" type="file" size=20 class="form-control col-md-3" /> &nbsp; 
 										<?php if($rows['uploadimage1']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/categoryimages/<?php echo $rows['uploadimage1']; ?>" width="120"  /><br />
										<strong><?php if($_SESSION['admin_language'] == 'HE') { ?>תמונה קיימת  <?php } else { ?>Existing Image<?php } ?></strong>
										<a href="<?php echo URL;?>/admin-panel/add-category.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&thumb_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'HE') { ?> מחק <?php } else { ?>Delete<?php } ?></a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage1" value="<?php echo $rows['uploadimage1']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?> העלה באנר <?php } else { ?>Upload Banner<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file" size=20 class="form-control col-md-3" /> &nbsp; 
 										<?php if($rows['uploadimage']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/categoryimages/<?php echo $rows['uploadimage']; ?>" width="120"  /><br />
										<strong><?php if($_SESSION['admin_language'] == 'HE') { ?>תמונה קיימת  <?php } else { ?>Existing Image<?php } ?></strong>
										<a href="<?php echo URL;?>/admin-panel/add-category.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&banner_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'HE') { ?> מחק <?php } else { ?>Delete<?php } ?></a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['uploadimage']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>תכונה  <?php } else { ?>Attribute <?php } ?></label>
                                    <div class="col-sm-9">
                                        <?php $atr_array = explode(',',$rows['attribute']); ?>
                                        <select name="atr_id[]" class="form-control col-md-4" multiple="multiple"> 
                                            <?php 
    								  	        $sql_atr = mysqli_query($conn,"select * from ".$sufix."attributes where displayflag='1'");
    								  	        while($rows_atr = mysqli_fetch_assoc($sql_atr))
    								  	        {
    								  	    ?>
    								  	    <option value="<?php echo $rows_atr['atr_id']; ?>" <?php if (in_array($rows_atr['atr_id'], $atr_array)) { echo "Selected"; } ?>> <?php if($_SESSION['admin_language'] == 'HE') { echo $rows_atr['attributename_in_hebrew'];  } else { echo $rows_atr['attributename'];  }    ?></option> 
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
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור קצר <?php } else { ?> Short Description <?php } ?></span>
                                            <div class="input-group mb-3">  
                                                <input type="text" name="short_description" id="short_description" value="<?php echo $rows['short_description']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור קצר <?php } else { ?> Short Description <?php } ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור קצר בעברית <?php } else { ?>Short Description in Hebrew <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <input type="text" name="short_description_in_hebrew" id="short_description_in_hebrew" value="<?php echo $rows['short_description_in_hebrew']; ?>" class="form-control" placeholder=" <?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור קצר בעברית <?php } else { ?>Short Description in Hebrew <?php } ?> "> 
                                            </div>
                                        </div> 
                                    </div>
                                    
                                    <div class="form-group row"> 
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?>תיאור הקטגוריה  <?php } else { ?>Category Description <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="long_description" id="long_description" rows="4"><?php echo $rows['long_description']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור קטגוריה בעברית <?php } else { ?>Category Description in Hebrew<?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="long_description_in_hebrew" id="long_description_in_hebrew" rows="4"><?php echo $rows['long_description_in_hebrew']; ?></textarea> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row"> 
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור 2 <?php } else { ?> Description 2 <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="long_description2" id="long_description2" rows="4"><?php echo $rows['long_description2']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור 2 בעברית <?php } else { ?> Description 2 in Hebrew <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="long_description2_in_hebrew" id="long_description2_in_hebrew" rows="4"><?php echo $rows['long_description2_in_hebrew']; ?></textarea> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row"> 
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> מטא כותרת <?php } else { ?>Meta Title<?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="metatitle" id="metatitle" rows="4"><?php echo $rows['metatitle']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?>  כותרת מטה בעברית<?php } else { ?> Meta Title in Hebrew<?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="metatitle_in_hebrew" id="metatitle_in_hebrew" rows="4"><?php echo $rows['metatitle_in_hebrew']; ?></textarea> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row"> 
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?>מטא מילות מפתח  <?php } else { ?>Meta Keyword <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="metakeyword" id="metakeyword" rows="4"><?php echo $rows['metakeyword']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> מטא מילות מפתח בעברית <?php } else { ?>Meta Keyword in Hebrew<?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="metakeyword_in_hebrew" id="metakeyword_in_hebrew" rows="4"><?php echo $rows['metakeyword_in_hebrew']; ?></textarea> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row"> 
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?>תיאור מטא  <?php } else { ?>Meta Description<?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="metadescription" id="metadescription" rows="4"><?php echo $rows['metadescription']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> מטא תיאור בעברית <?php } else { ?>Meta Description in Hebrew <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="metadescription_in_hebrew" id="metadescription_in_hebrew" rows="4"><?php echo $rows['metadescription_in_hebrew']; ?></textarea> 
                                            </div>
                                        </div>
                                    </div> 
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?php if($_SESSION['admin_language'] == 'HE') { ?> סטטוס <?php } else { ?>Status<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control col-md-4">
        								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?> אפשר <?php } else { ?>Enable <?php } ?> </option>
            									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת  <?php } else { ?>Disable <?php } ?> </option> 
        								    </select>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
                        </div>
                    </div>  
                <button type="submit" class="category btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?> לשמור <?php } else { ?>SAVE<?php } ?></button>
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
 