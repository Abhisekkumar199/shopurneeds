<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_city_mapping = mysqli_query($conn,"select * from ".$sufix."city_shipping_charges where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_city_mapping); 
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
                    <h2 class="text-md text-highlight"><?php echo $option; ?> City Mapping</h2>
                </div>
                <div class="flex"></div>
                <div><a href="city-shipping-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Shipping Charges</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="city-shipping-maping-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <select name="city" id="city" class="form-control col-md-4">
        								  	    <option value="" >Select</option> 
        								  	    <?php 
        								  	        $sql_city_from = mysqli_query($conn,"select * from ".$sufix."city where displayflag='1'");
        								  	        while($rows_city = mysqli_fetch_assoc($sql_city_from))
        								  	        {
        								  	    ?>
        								  	    <option value="<?php echo $rows_city['cityid']; ?>" <?php if($rows_city['cityid']== $rows['city']) { echo "Selected"; } ?>><?php echo $rows_city['cityname']; ?></option> 
        								  	    <?php } ?>
        								    </select>
                                        </div>
                                    </div>
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Amount From</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="amount_from" id="amount_from" value="<?php echo $rows['amount_from']; ?>" class="form-control" placeholder="Amount From">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Amount Upto</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="amount_upto" id="amount_upto" value="<?php echo $rows['amount_upto']; ?>" class="form-control" placeholder="Amount Upto">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Charge</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="charge" id="charge" value="<?php echo $rows['charge']; ?>" class="form-control" placeholder="Charge">
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>  
                <button type="submit" class="attributevalue btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.attributevalue').click(function(){ 
	var attributevaluename = $('#attributevaluename').val();   
	var attribute = $('#attribute').val(); 
	if(attributevaluename == '')
	{  
		$('#attributevaluename').css("border","1px solid red");
		$('#attributevaluename').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter attribute value!</div>");
		return false;
	}
	else
	{ 
		$('#attributevaluename').css("border","1px solid #bdb9b9"); 
	}   
	
	if(attribute == '')
	{  
		$('#attribute').css("border","1px solid red");
		$('#attribute').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please select attribute!</div>");
		return false;
	}
	else
	{ 
		$('#attribute').css("border","1px solid #bdb9b9"); 
	}  
}); 
</script> 