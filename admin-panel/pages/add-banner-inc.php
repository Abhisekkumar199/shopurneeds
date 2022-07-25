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
                    <h2 class="text-md text-highlight">Add Banner</h2>
                </div>
                <div class="flex"></div>
                <div><a href="banner-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Banners</span> <i data-feather="arrow-right"></i></a></div>
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
                                    <label class="col-sm-3 col-form-label">Banner Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bannername" id="bannername" value="<?php echo $rows['bannername']; ?>" class="form-control" placeholder="Banner Name">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Upload Image</label>
                                    <div class="col-sm-9">
                                        <input name="image" id="image" type="file" size=20 class="form-control col-md-3" />   
 										<?php if($rows['uploadimage']!='')
										{
										?>	 
    										<br> 
    										<img src="../uploads/bannerimages/<?php echo $rows['uploadimage']; ?>" width="120"  /><br />
    										<strong>Existing Image</strong>
    										<a href="<?php echo URL;?>/admin-panel/add-banner.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&image_delete_id=<?php echo $_REQUEST['id'];?>">Delete</a>
    										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['uploadimage']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="externallink" id="externallink" value="<?php echo $rows['externallink']; ?>" class="form-control" placeholder="URL">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="editor1" rows="4"><?php echo $rows['description']; ?></textarea>
                                    </div>
                                </div> 
                                <script> 
									CKEDITOR.replace( 'editor1' );
								</script>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Position</label>
                                    <div class="col-sm-9">
                                        <select name="bposition" class="form-control col-md-4">
    								  	    <option value="">Select Position</option> 
                                            <option value="Header" <?php if($rows['bposition']=="Header") echo "Selected";?>>Header</option>  
                                            <option value="Slider" <?php if($rows['bposition']=="Slider") echo "Selected";?>>Slider</option>  
                                            <option value="Below Slider" <?php if($rows['bposition']=="Below Slider") echo "Selected";?>>Below Slider</option> 
                                            <option value="Fruits Store Left" <?php if($rows['bposition']=="Fruits Store Left") echo "Selected";?>>Fruits Store Left</option>
                                            <option value="Fruits Store" <?php if($rows['bposition']=="Fruits Store") echo "Selected";?>>Fruits Store</option>   
											<option value="Grocery & Staples" <?php if($rows['bposition']=="Grocery & Staples") echo "Selected";?>>Grocery & Staples</option> 
											<option value="Grocery & Staples Right" <?php if($rows['bposition']=="Grocery & Staples Right") echo "Selected";?>>Grocery & Staples Right</option> 
    								    										    <option value="Mobile Banner" <?php if($rows['bposition']=="Mobile Banner") echo "Selected";?>>Mobile Banner</option>	 

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
                                <button type="submit" class="banner btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button> 
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
    
    
    
	
	
    if(externallink == '')
	{  
		$('#externallink').css("border","1px solid red");
		$('#externallink').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter url</div>");
		return false;
	}
	else
	{ 
		$('#externallink').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
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