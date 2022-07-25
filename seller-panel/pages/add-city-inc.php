<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_city = mysqli_query($conn,"select * from ".$sufix."city where cityid='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_city); 
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
                    <h2 class="text-md text-highlight">Add City</h2>
                </div>
                <div class="flex"></div>
                <div><a href="city-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All City</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="city-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="id"  value="<?php echo $_REQUEST['id']; ?>"  /> 
            <div class="padding">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                               <div class="card-body">  
                                    <div class="form-group row"> 
                                        <div class="col-md-6">  
                                            <label class="col-form-label">City Name</label> 
                                            <input type="text" name="cityname" id="cityname" value="<?php echo $rows['cityname']; ?>" class="form-control" placeholder="City Name">
                                             
                                        </div>  
                                        <div class="col-md-6">  
                                            <label class="col-form-label">City Name</label> 
                                            <input type="text" name="cityname_in_arabic" id="cityname_in_arabic" value="<?php echo $rows['cityname_in_arabic']; ?>" class="form-control" placeholder="City Name in Arabic">
                                             
                                        </div> 
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-form-label">Status</label> 
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
                <button type="submit" class="city btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
            </div>
            </form>
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.city').click(function(){ 
	var cityname = $('#cityname').val();    
	if(cityname == '')
	{  
		$('#cityname').css("border","1px solid red");
		$('#cityname').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter city name</div>");
		return false;
	}
	else
	{ 
		$('#cityname').css("border","1px solid #bdb9b9"); 
	}   
}); 
</script> 