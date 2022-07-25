<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."deal where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_menu); 
    	$option="Edit"; 
    	
    	
		$startdate=$rows['start_date'];
		$sssd = explode('-',$startdate);
		$sd = $sssd[0].'-'.$sssd[1].'-'.$sssd[2];
		$enddate=$rows['end_date'];
		$eeed = explode('-',$enddate);
		$ed = $eeed[0].'-'.$eeed[1].'-'.$eeed[2];
    }
    else
    {
        $option="Add";  
    } 
    
    function cagegory_breadcrumbs($id, $category_tbl, $except = null) 
    {
        global $conn;
        $s = "SELECT * FROM ".$category_tbl." WHERE cat_id = $id";
        $r = mysqli_query($conn,$s);
        $row = mysqli_fetch_array($r);
    	$cat_slug = $row['cat_slug'];
        if($row['parent'] == 0) {
            $name = $row['categoryname'];
    		$curl = URL;  
            return "".$name." > ";
        } 
        else 
        {
            $name = $row['categoryname'];
            if(!empty($except) && $except == $name)
            {
                return cagegory_breadcrumbs($row['parent'],$category_tbl, $except)." ".$name; 
            }
        }
        return cagegory_breadcrumbs($row['parent'],$category_tbl, $except). " ".$name." >";
    } 
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight">Deals Details</h2>
                </div>
                <div class="flex"></div>
                <div><a href="deal-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Deals</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="add-deals-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <div class="card-body"> 
                                        <div class="row"> 
                                            <div class="col-md-6"> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Deal Name  </span></div>
                                                    <input type="text" class="form-control" name="deal_name" id="deal_name" value="<?php echo $rows['name']; ?>"  required>
                                                </div>  
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Discount Percentage</span></div>
                                                    <input type="text" class="form-control" name="deal_percentage" id="deal_percentage" value="<?php echo $rows['percentage']; ?>" onkeyup="if (/[^0-9.]/g.test(this.value)) this.value = this.value.replace(/[^0-9.]/g,'')"  required>
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
                                                    <input  class="form-control" name="start_date" id="start_date" type="date" value="<?php echo $sd; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid From Time</span></div>
                                                    <input  class="form-control"  name="start_time" id="start_time"  type="time" value="<?php echo $rows['start_time']; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid To</span></div>
                                                    <input  class="form-control" name="end_date" id="end_date" type="date" value="<?php echo $ed; ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id="">Valid To Time</span></div>
                                                    <input  class="form-control" name="end_time" id="end_time" type="time" value="<?php echo $rows['end_time']; ?>" required>
                                                </div>
                                                 
                                            </div> 
                                        </div>
             
                                        
                                          <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Product UPIDs (Comma separated)</label>
                                            <div class="col-sm-9" id="productselect"> 
                                                <input  class="form-control" name="prod_ids" id="prod_ids" style=" line-height: 100px;" type="text" value="<?php echo $rows['products']; ?>" required> 
                                                 
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


function category_product(sellername) 
{ 
    
    var cat_ids = []; 
    $("#cat_ids :selected").each(function(){
    cat_ids.push($(this).val()); 
    }); 
      
    jQuery.ajax({
		type: "POST",
		data: { cat_ids: cat_ids},
		url: "https://localhost/project/shopurneeds/admin-panel/ajax_category_product.php",
		success: function(response){  
		     $("#productselect").html(response);
		}
	}); 
     
}



</script> 