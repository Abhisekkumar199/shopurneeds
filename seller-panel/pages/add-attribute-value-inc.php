<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_attribute = mysqli_query($conn,"select * from ".$sufix."attributevalue where atr_val_id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_attribute); 
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
                    <h2 class="text-md text-highlight"> <?php if($_SESSION['admin_language'] == 'HE') { ?>ערך תכונה <?php } else { ?>Attribute Value <?php } ?> </h2>
                </div>
                <div class="flex"></div>
                <div><a href="attributevalue-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?>הצג את כל התכונות ערך<?php } else { ?> View All Attribute Value <?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="attribute-value-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם ערך של תכונה <?php } else { ?>Attribute Value Name<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="attributevaluename" id="attributevaluename" value="<?php echo $rows['attributevaluename']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם ערך של תכונה<?php } else { ?>Attribute Value Name<?php } ?> ">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם ערך של תכונה בעברית<?php } else { ?>Attribute Value Name in Hebrew<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="attributevaluename_in_hebrew" id="attributevaluename_in_hebrew" value="<?php echo $rows['attributevaluename_in_hebrew']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם ערך של תכונה בעברית<?php } else { ?>Attribute Value Name in Hebrew <?php } ?> ">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>תכונה<?php } else { ?>Attribute<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <select name="attribute" id="attribute" class="form-control col-md-4">
        								  	    <option value="" ><?php if($_SESSION['admin_language'] == 'HE') { ?>בחר <?php } else { ?>Select<?php } ?> </option> 
        								  	    <?php 
        								  	        $sql_atr = mysqli_query($conn,"select * from ".$sufix."attributes where displayflag='1'");
        								  	        while($rows_atr = mysqli_fetch_assoc($sql_atr))
        								  	        {
        								  	    ?>
        								  	    <option value="<?php echo $rows_atr['atr_id']; ?>" <?php if($rows['atr_id']== $rows_atr['atr_id']) { echo "Selected"; } ?>><?php echo $rows_atr['attributename']; ?></option> 
        								  	    <?php } ?>
        								    </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סטטוס<?php } else { ?>Status<?php } ?> </label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control col-md-4">
        								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>אפשר<?php } else { ?>Enable<?php } ?> </option>
            									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת<?php } else { ?>Disable<?php } ?> </option> 
        								    </select>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>  
                <button type="submit" class="attributevalue btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור<?php } else { ?>SAVE<?php } ?> </button>
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