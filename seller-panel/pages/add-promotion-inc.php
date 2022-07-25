<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."promotion where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_menu); 
    	$option="Edit"; 
    	
    	
		$startdate=$rows['validfrom'];
		$sssd = explode('-',$startdate);
		$sd = $sssd[0].'-'.$sssd[1].'-'.$sssd[2];
		$enddate=$rows['validto'];
		$eeed = explode('-',$enddate);
		$ed = $eeed[0].'-'.$eeed[1].'-'.$eeed[2];
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
                    <h2 class="text-md text-highlight"><?php if($_SESSION['admin_language'] == 'HE') { ?>הוסף קידום<?php } else { ?>Add Promotion<?php } ?></h2>
                </div>
                <div class="flex"></div>
                <div><a href="promotion-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?>רשימת קידום<?php } else { ?>Promotion List<?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="add-promotion-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                
                                <div class="card">
                                    <div class="card-header"><strong><?php if($_SESSION['admin_language'] == 'HE') { ?>אינפורמטיו <?php } else { ?>INFOMRMATION<?php } ?></strong></div>
                                    <div class="card-body"> 
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>תצוגה<?php } else { ?>Display<?php } ?></label>
                                            <div class="col-sm-9 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                                <input type="radio" name="showto" value="0" <?php if($rows['showto']=='0') { echo "checked='checked'"; } ?> />
                                                <?php if($_SESSION['admin_language'] == 'HE') { ?>לא מוצג בניווט <?php } else { ?>Not show on navigation<?php } ?>
                                                <input type="radio" name="showto" value="1" <?php if($rows['showto']=='1') { echo "checked='checked'"; } ?> />
                                                <?php if($_SESSION['admin_language'] == 'HE') { ?>הראה נכון<?php } else { ?>show right<?php } ?>
        										 <input type="radio" name="showto" value="2" <?php if($rows['showto']=='2') { echo "checked='checked'"; } ?> />
                                                <?php if($_SESSION['admin_language'] == 'HE') { ?> להראות שמאלה <?php } else { ?>show left<?php } ?>
                                            </div>
                                        </div> 
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-6"> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>שם קידום<?php } else { ?>Promotion Name<?php } ?></span></div>
                                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $rows['name']; ?>"  required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>כתובת אתר<?php } else { ?>URL<?php } ?></span></div>
                                                    <input type="text" class="form-control" name="link" id="link" value="<?php echo $rows['link']; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>עדכוני מוצר<?php } else { ?>Product UPIds<?php } ?></span></div>
                                                    <input type="text" class="form-control" id="upids"   name="upids" value="<?php echo $rows['upids']; ?>"  required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>קוד צבע רקע<?php } else { ?>Background Color Code<?php } ?></span></div>
                                                    <input type="text" class="form-control" id="colorCodeBackground"   name="colorCodeBackground" value="<?php echo $rows['colorCodeBackground']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>קוד צבע לתוכן<?php } else { ?>Content Color Code<?php } ?></span></div>
                                                    <input type="text" class="form-control" id="colorCodeContent"    name="colorCodeContent" value="<?php echo $rows['colorCodeContent']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>סטטוס<?php } else { ?>Status<?php } ?></span></div>
                                                    <select name="status" class="form-control">
                								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>אפשר<?php } else { ?>Enable<?php } ?></option>
                    									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת<?php } else { ?>Disable<?php } ?></option> 
                								    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>בתוקף מ<?php } else { ?>Valid From<?php } ?></span></div>
                                                    <input  class="form-control" name="validfrom" type="date" value="<?php echo $sd; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?> תקף ל<?php } else { ?>Valid To<?php } ?></span></div>
                                                    <input  class="form-control" name="validto" type="date" value="<?php echo $ed; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>חיובי COD<?php } else { ?>COD Charges<?php } ?></span></div>
                                                    <input type="text" class="form-control" id="codCharge"  name="codCharge" value="<?php echo $rows['codCharge']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>עלויות משלוח<?php } else { ?>Shipping Charges<?php } ?></span></div>
                                                    <input type="text" class="form-control" id="shippingCharge" name="shippingCharge" value="<?php echo $rows['shippingCharge']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'HE') { ?>מוצר בודד לקנות<?php } else { ?>Single Product to buy<?php } ?></span></div>
                                                    <input type="text" class="form-control" id="single_product" name="single_product" value="<?php echo $rows['single_product']; ?>" required>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> 
                                 
                                <button type="submit" class="seller btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור<?php } else { ?>SAVE<?php } ?></button>
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