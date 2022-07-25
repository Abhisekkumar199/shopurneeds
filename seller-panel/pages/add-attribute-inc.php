<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_attribute = mysqli_query($conn,"select * from ".$sufix."attributes where atr_id='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight"><?php if($_SESSION['admin_language'] == 'HE') { ?> הוסף תכונה<?php } else { ?>Add Attribute <?php } ?></h2>
                </div>
                <div class="flex"></div>
                <div><a href="attribute-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?>הצג את כל התכונות <?php } else { ?>View All Attribute<?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="attribute-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="id"  value="<?php echo $_REQUEST['id']; ?>"  /> 
            <div class="padding">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                               <div class="card-body">  
                                    <div class="form-group row"> 
                                        <div class="col-md-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">  
                                            <label class="col-form-label"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם מאפיין<?php } else { ?>Attribute Name<?php } ?></label> 
                                            <input type="text" name="attributename" id="attributename" value="<?php echo $rows['attributename']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?> שם מאפיין<?php } else { ?>Attribute Name <?php } ?> ">
                                             
                                        </div> 
                                        <div class="col-md-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                            <label class="col-form-label"><?php if($_SESSION['admin_language'] == 'HE') { ?> שם התכונה בעברית<?php } else { ?>Attribute Name in Hebrew<?php } ?> </label> 
                                            <input type="text" name="attributename_in_hebrew" id="attributename_in_hebrew" value="<?php echo $rows['attributename_in_hebrew']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?> שם התכונה בעברית<?php } else { ?>Attribute Name in Hebrew<?php } ?>">
                                             
                                        </div> 
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-md-6 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                        <label class="col-form-label"><?php if($_SESSION['admin_language'] == 'HE') { ?> סטטוס<?php } else { ?>Status <?php } ?></label> 
                                        <select name="status" class="form-control col-md-4">
    								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>אפשר <?php } else { ?>Enable <?php } ?></option>
        									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת <?php } else { ?>Disable <?php } ?></option> 
    								    </select> 
    								    </div>
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>  
                <button type="submit" class="attribute btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור<?php } else { ?>SAVE <?php } ?></button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.attribute').click(function(){ 
	var attributename = $('#attributename').val();   
	var short_description = $('#short_description').val(); 
	if(attributename == '')
	{  
		$('#attributename').css("border","1px solid red");
		$('#attributename').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter attribute name</div>");
		return false;
	}
	else
	{ 
		$('#attributename').css("border","1px solid #bdb9b9"); 
	}   
}); 
</script> 