<?php 
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."banners where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_menu); 
    	$option="Edit"; 
    }
    else
    {
        $option="Add";  
    } 
    
    if($_REQUEST['image_delete_id']!='') 
    {
        $file = "../uploads/bannerimages/".$rows['uploadimage']; 
        unlink($file); 
         mysqli_query($conn,"update  ".$sufix."banners set uploadimage='' where id='".$_REQUEST['image_delete_id']."'");
         
    }
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight"> <?php if($_SESSION['admin_language'] == 'HE') { ?> הוסף באנר<?php } else { ?>Add Category <?php } ?></h2>
                </div>
                <div class="flex"></div>
                <div><a href="banner-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?> צפה בכל באנרים<?php } else { ?>  View All Banners <?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="banner-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם הכרזה<?php } else { ?>Banner Name<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="bannername" id="bannername" value="<?php echo $rows['bannername']; ?>" class="form-control" placeholder="Banner Name">
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם הכרזה בעברית<?php } else { ?>Banner Name In Hebrew<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="bannername_in_hebrew" id="bannername_in_hebrew" value="<?php echo $rows['bannername_in_hebrew']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם הכרזה בעברית<?php } else { ?>Banner Name In Hebrew<?php } ?> ">
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>העלאת תמונה<?php } else { ?>Upload Image<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <input name="image" id="image" type="file" size=20 class="form-control col-md-3" />   
     										<?php if($rows['uploadimage']!='')
    										{
    										?>	 
        										<br> 
        										<img src="../uploads/bannerimages/<?php echo $rows['uploadimage']; ?>" width="120"  /><br />
        										<strong>Existing Image</strong>
        										<a href="<?php echo URL;?>/admin-panel/add-banner.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&image_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מחק<?php } else { ?>Delete<?php } ?> </a>
        										 
    										<?php } ?>
    										<input type="hidden" name="blankimage" value="<?php echo $rows['uploadimage']; ?>"  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?> כתובת אתר<?php } else { ?>URL <?php } ?> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="externallink" id="externallink" value="<?php echo $rows['externallink']; ?>" class="form-control" placeholder="URL">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group row"> 
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?>תיאור  <?php } else { ?>  Description <?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="description" id="description" rows="4"><?php echo $rows['description']; ?></textarea> 
                                            </div>
                                        </div>
                                        <div class="col-sm-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <span><?php if($_SESSION['admin_language'] == 'HE') { ?> תיאור בעברית<?php } else { ?> Description in Hebrew<?php } ?> </span>
                                            <div class="input-group mb-3">  
                                                <textarea class="form-control" name="description_in_hebrew" id="description_in_hebrew" rows="4"><?php echo $rows['description_in_hebrew']; ?></textarea> 
                                            </div>
                                        </div>
                                    </div> 
                                    
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?> עמדה <?php } else { ?>Position <?php } ?> </label>
                                        <div class="col-sm-9">
                                            <select name="bposition" class="form-control col-md-4">
        								  	    <option value=""><?php if($_SESSION['admin_language'] == 'HE') { ?>בחר מיקום <?php } else { ?>Select Position<?php } ?> </option> 
        								  	    
                                                <option value="Index Top" <?php if($rows['bposition']=="Index Top") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?> אינדקס למעלה <?php } else { ?>Index Top<?php } ?> </option>
                                                <option value="Below Slider" <?php if($rows['bposition']=="Below Slider") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?> מתחת לסליידר<?php } else { ?>Below Slider<?php } ?> </option>   
    											<option value="Center Banner" <?php if($rows['bposition']=="Center Banner") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>באנר מרכזי<?php } else { ?>Center Banner<?php } ?> </option>
    											<option value="Center Bottom" <?php if($rows['bposition']=="Center Bottom") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>מרכז התחתון<?php } else { ?>Center Bottom <?php } ?> </option>
    											<option value="Above Footer" <?php if($rows['bposition']=="Above Footer") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?> מעל כותרת תחתונה <?php } else { ?>Above Footer<?php } ?> </option>
    										 
    
        								    </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סטטוס<?php } else { ?>Status<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control col-md-4">
        								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?> אפשר<?php } else { ?>Enable<?php } ?> </option>
            									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת<?php } else { ?>Disable<?php } ?> </option> 
        								    </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="banner btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור <?php } else { ?>SAVE<?php } ?> </button> 
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
    $('.banner').click(function(){ 
	var bannername = $('#bannername').val();   
	var image = $('#image').val();   
	var externallink = $('#externallink').val();   
	var description = $('#description').val();  
	var bposition = $('#bposition').val(); 
	
	if(bannername == '')
	{  
		$('#bannername').css("border","1px solid red");
		$('#bannername').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter banner name</div>");
		return false;
	}
	else
	{ 
		$('#bannername').css("border","1px solid #bdb9b9"); 
	} 
    
    
 
	
	if(description == '')
	{  
		$('#description').css("border","1px solid red");
		$('#description').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter description</div>");
		return false;
	}
	else
	{ 
		$('#description').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}
	
	if(bposition == '')
	{  
		$('#bposition').css("border","1px solid red");
		$('#bposition').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter bposition</div>");
		return false;
	}
	else
	{ 
		$('#bposition').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}
    
}); 
</script> 