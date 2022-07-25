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
                    <h2 class="text-md text-highlight">Add Promotion</h2>
                </div>
                <div class="flex"></div>
                <div><a href="promotion-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Promotion</span> <i data-feather="arrow-right"></i></a></div>
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
                                    <div class="card-header"><strong>INFOMRMATION</strong></div>
                                    <div class="card-body"> 
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Display</label>
                                            <div class="col-sm-9">
                                                <input type="radio" name="showto" value="0" <?php if($rows['showto']=='0') { echo "checked='checked'"; } ?> />
                                                Not show on navigation
                                                <input type="radio" name="showto" value="1" <?php if($rows['showto']=='1') { echo "checked='checked'"; } ?> />
                                                show right
        										 <input type="radio" name="showto" value="2" <?php if($rows['showto']=='2') { echo "checked='checked'"; } ?> />
                                                show left
                                            </div>
                                        </div> 
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-6"> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Promotion Name</span></div>
                                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $rows['name']; ?>"  required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">URL</span></div>
                                                    <input type="text" class="form-control" name="link" id="link" value="<?php echo $rows['link']; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Product UPIds</span></div>
                                                    <input type="text" class="form-control" id="upids"   name="upids" value="<?php echo $rows['upids']; ?>" onkeyup="if (/[^0-9.]/g.test(this.value)) this.value = this.value.replace(/[^0-9.]/g,'')"  required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Background Color Code</span></div>
                                                    <input type="text" class="form-control" id="colorCodeBackground"   name="colorCodeBackground" value="<?php echo $rows['colorCodeBackground']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Content Color Code</span></div>
                                                    <input type="text" class="form-control" id="colorCodeContent"    name="colorCodeContent" value="<?php echo $rows['colorCodeContent']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Status</span></div>
                                                    <select name="status" class="form-control">
                								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>>Enable</option>
                    									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>>Disable</option> 
                								    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid From</span></div>
                                                    <input  class="form-control" name="validfrom" type="date" value="<?php echo $sd; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid To</span></div>
                                                    <input  class="form-control" name="validto" type="date" value="<?php echo $ed; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">COD Charges</span></div>
                                                    <input type="text" class="form-control" id="codCharge"  name="codCharge" value="<?php echo $rows['codCharge']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Shipping Charges</span></div>
                                                    <input type="text" class="form-control" id="shippingCharge" name="shippingCharge" value="<?php echo $rows['shippingCharge']; ?>" required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Single Product to buy</span></div>
                                                    <input type="text" class="form-control" id="single_product" name="single_product" value="<?php echo $rows['single_product']; ?>" required>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> 
                                 
                                <button type="submit" class="seller btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
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