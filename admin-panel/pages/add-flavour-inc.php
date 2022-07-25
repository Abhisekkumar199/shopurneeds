<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_attribute = mysqli_query($conn,"select * from ".$sufix."flavour where id='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight"><?php echo $option; ?> Flavour</h2>
                </div>
                <div class="flex"></div>
 
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="flavour-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                        <label class="col-sm-3 col-form-label">Flavour Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" id="name" value="<?php echo $rows['name']; ?>" class="form-control" placeholder="Flavour Name">
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
                                </div>
                            </div> 
                        </div>
                    </div>  
                <button type="submit" class="flavour btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.flavour').click(function(){ 
	var name = $('#name').val();      
	if(name == '')
	{  
		$('#name').css("border","1px solid red");
		$('#name').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter flavour!</div>");
		return false;
	}
	else
	{ 
		$('#name').css("border","1px solid #bdb9b9"); 
	}   
 
}); 
</script> 