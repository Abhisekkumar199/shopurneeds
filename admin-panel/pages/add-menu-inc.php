<?php 							
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."menu_permission where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_menu); 
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
                    <h2 class="text-md text-highlight">ADD MENU</h2>
                </div>
                <div class="flex"></div>
                <div><a href="menu-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Menu</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <div class="padding"> 
            </div> 
            <div class="col-md-12"> 
                <div class="card">
                    <form name="addForm" id="addForm" action="menu-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="parent"  value="<?php echo $_REQUEST['parent']; ?>"  />	 
                    <input type="hidden" name="menuid"  value="<?php echo $_REQUEST['menuid']; ?>"  /> 
                    <input type="hidden" name="id"  value="<?php echo $_REQUEST['id']; ?>"  />
                    <div class="card-body"> 
                        <div class="row"> 
                            <div class="col-md-3"> 
                                <span id="message"> </span>
                            </div>
                            <div class="col-md-9"> 
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Menu Name</span></div>
                                    <input type="text" name="menu" id="menu" value="<?php echo $rows['menu']; ?>" class="form-control" placeholder="Menu Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Menu Link</span></div>
                                    <input type="text" name="link" id="link" value="<?php echo $rows['link']; ?>" class="form-control" placeholder="Menu Link">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Menu Icon</span></div>
                                    <input type="text" name="icon" value="<?php echo $rows['icon']; ?>" class="form-control" placeholder="Menu Icon">
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Status</span></div>
                                    <select name="status" class="form-control">
								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>>Enable</option>
    									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>>Disable</option> 
								    </select>	
                                </div>
                            </div>  
                            <div class="col-md-12 text-right"> 
                                <button type="submit" class="menu btn w-sm mb-1 btn-success " style="float: right;    margin-right: 12px;">SAVE</button>
                            </div> 
                        </div> 
                    </div>
                    </form>
                </div>
            </div> 
        </div> 
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.menu').click(function(){ 
	var menu = $('#menu').val();   
	var link = $('#link').val(); 
	if(menu == '')
	{  
		$('#menu').css("border","1px solid red");
		$('#menu').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter menu name</div>");
		return false;
	}
	else
	{ 
		$('#menu').css("border","1px solid #bdb9b9"); 
	} 
    
    
    if(link == '')
	{  
		$('#link').css("border","1px solid red");
		$('#link').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter menu link</div>");
		return false;
	}
	else
	{ 
		$('#password').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
    
}); 
</script> 