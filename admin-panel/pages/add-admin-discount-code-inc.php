<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."discountcodes where codeid='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight">Add Discount Code</h2>
                </div>
                <div class="flex"></div>
                <div><a href="admin-discount-code-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Discount Code</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="add-admin-discount-code-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <div class="card-header"><strong>DISCOUNT  INFOMRMATION</strong></div>
                                    <div class="card-body"> 
                                         
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-6"> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Discount Name  </span></div>
                                                    <input type="text" class="form-control" name="disc_name" id="disc_name" value="<?php echo $rows['disc_name']; ?>"  required>
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Discount Code</span></div>
                                                    <input type="text" class="form-control" name="disc_code" id="disc_code" value="<?php echo $rows['disc_code']; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Discount Value</span></div>
                                                    <input type="text" class="form-control" name="discountvalue" id="discountvalue" value="<?php echo $rows['discountvalue']; ?>" onkeyup="if (/[^0-9.]/g.test(this.value)) this.value = this.value.replace(/[^0-9.]/g,'')"  required>
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
                                                    <div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">Type(%)</label></div>
                                                    <select name="disc_type" class="custom-select disc_type">
                                                        <option value="%" <?php if($rows['disc_type']=='%') { echo "selected='selected'"; } ?>>%</option>
                                                        <option value="Rs" <?php if($rows['disc_type']=='Rs') { echo "selected='selected'"; } ?>>Rs</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid From</span></div>
                                                    <input  class="form-control" name="validfrom" type="date" value="<?php echo $sd; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid To</span></div>
                                                    <input  class="form-control" name="validto" type="date" value="<?php echo $ed; ?>" required>
                                                </div>
                                                 
                                            </div> 
                                        </div>
                                        
                                       <!-- <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Products</label>
                                            <div class="col-sm-9" id="productselect"> 
                                                <select name="productname[]" class="custom-select  getselectedoptionvalue"  multiple="multiple" onclick="getselectoption();"> 
                                                <?php
                                                $mcatid = $_REQUEST['sub_category'];
                                                $sql_product = mysqli_query($conn,"SELECT * FROM shopurneeds_product WHERE   displayflag='1'");
                                                while($row_subcat= mysqli_fetch_assoc($sql_product))
                                                {
                                                ?>
                                                <?php $pppppp = explode(',',$rows['product']);?>
                                                <option value="<?php echo $row_subcat['id']; ?>" <?php if(in_array($row_subcat['id'],$pppppp)) { echo "selected='selected'"; } ?>><?php echo $row_subcat['productname']; ?>&nbsp;(<?php echo $row_subcat['sku'];?>)</option>
                                                <?php 
                                                }
                                                ?>
                                                </select> 
                                                 
                                            </div>
                                        </div> -->
                                        
                                        
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


function sellersubcategoryp(sellername) 
{ 
    
    var selectedValuesseller = []; 
    $("#multipleselectedseller :selected").each(function(){
    selectedValuesseller.push($(this).val()); 
    }); 
    jQuery.ajax({
		type: "POST",
		data: { sellerid: selectedValuesseller},
		url: "https://localhost/project/shopurneeds/admin-panel/ajax_inc_sub_catpro.php",
		success: function(response){   
		     $("#productselect").html(response);
		}
	}); 
     
}



</script> 