<?php  
     
	$sql_seller= mysqli_query($conn,"select * from ".$sufix."suppliers where id='".$_SESSION['sellerid']."'") ;
	$rows = mysqli_fetch_assoc($sql_seller); 
	$option="Edit"; 
    
    
    if($_REQUEST['profilepic_delete_id']!='') 
    {
        $file = "../uploads/sellerimages/".$rows['uploadimage']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."suppliers set uploadimage='' where id='".$_REQUEST['logo_delete_id']."'");
    } 
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight"><?php  echo $row['suppliername']; ?></h2>
                </div>
                <div class="flex"></div> 
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="seller-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="id"  value="<?php echo $_SESSION['sellerid']; ?>"  />
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
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם המוכר <?php } else { ?> Seller Name <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="suppliername" id="suppliername" value="<?php echo $rows['suppliername']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם המוכר <?php }  else { ?> Seller Name <?php } ?>">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סיסמה <?php } else { ?> Password <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" id="password" value="<?php echo $rows['password']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>  סיסמה<?php } else { ?> Password  <?php } ?>">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>תמונת פרופיל <?php }  else { ?> Profile Pic <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['uploadimage']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/sellerimages/<?php echo $rows['uploadimage']; ?>" width="120"  /><br />
										<strong><?php if($_SESSION['admin_language'] == 'HE') { ?>תמונה קיימת<?php } else { ?> Existing Image <?php } ?></strong>
										<a href="<?php echo URL;?>/admin-panel/add-seller.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&profilepic_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מחק<?php }  else { ?> Delete <?php } ?></a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['uploadimage']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מזהה אימייל <?php } else { ?> Email Id <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emailid" id="emailid" value="<?php echo $rows['emailid']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>מזהה אימייל<?php } else { ?> Email Id <?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מס 'נייד<?php } else { ?> Mobile No <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" id="phone" value="<?php echo $rows['phone']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>מס 'נייד<?php } else { ?> Mobile No <?php } ?>">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם מותג<?php } else { ?> Brand Name <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="brandname" id="brandname" value="<?php echo $rows['brandname']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם מותג<?php } else { ?> Brand Name <?php } ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>כתובת 1 <?php } else { ?> Address 1 <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address1" id="address1" value="<?php echo $rows['address1']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>כתובת 1<?php } else { ?> Address 1 <?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"> <?php if($_SESSION['admin_language'] == 'HE') { ?>כתובת 2<?php } else { ?> Address 2 <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="address2" id="address2" value="<?php echo $rows['address2']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>כתובת 2<?php } else { ?> Address 2 <?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>עיר<?php } else { ?> City</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pcity" id="pcity" value="<?php echo $rows['pcity']; ?>" class="form-control" placeholder="City">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מטא כותרת <?php }else { ?> Meta Title <?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="metatitle" id="metatitle" rows="4"><?php echo $rows['metatitle']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מטא מילות מפתח<?php } else { ?> Meta Keyword <?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="metakeyword" id="metakeyword" rows="4"><?php echo $rows['metakeyword']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>תיאור מטא<?php }else { ?> Meta Description <?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="metadescription" id="metadescription" rows="4" ><?php echo $rows['metadescription']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סטטוס<?php } else { ?> Status <?php } ?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control col-md-4">
    								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>אפשר<?php } ?> Enable <?php } ?></option>
        									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת<?php } else { ?> Disable <?php } ?></option> 
    								    </select>
                                    </div>
                                </div>
                                
                                <button type="submit" class="seller btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור<?php } else {?> SAVE <?php } ?></button>
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
    $('.seller').click(function(){ 
	var suppliername = $('#suppliername').val(); 
	var emailid = $('#emailid').val(); 
	var phone = $('#phone').val(); 
	var pcity = $('#pcity').val(); 
	var address1 = $('#address1').val();    
	if(suppliername == '')
	{  
		$('#suppliername').css("border","1px solid red");
		$('#suppliername').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter seller name</div>");
		return false;
	}
	else
	{ 
		$('#suppliername').css("border","1px solid #bdb9b9"); 
	}  
    
    if(emailid == '')
	{  
		$('#emailid').css("border","1px solid red");
		$('#emailid').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter email id</div>");
		return false;
	}
	else
	{ 
		$('#emailid').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	if(phone == '')
	{  
		$('#phone').css("border","1px solid red");
		$('#phone').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter phone</div>");
		return false;
	}
	else
	{ 
		$('#phone').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	if(address1 == '')
	{  
		$('#address1').css("border","1px solid red");
		$('#address1').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter address</div>");
		return false;
	}
	else
	{ 
		$('#address1').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	} 
	
	if(pcity == '')
	{  
		$('#pcity').css("border","1px solid red");
		$('#pcity').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter City</div>");
		return false;
	}
	else
	{ 
		$('#pcity').css("border","1px solid #bdb9b9"); 
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