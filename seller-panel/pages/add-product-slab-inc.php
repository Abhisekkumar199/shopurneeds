<?php 
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."product_slab where id='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight">Add Product Slab</h2>
                </div>
                <div class="flex"></div>
                <div><a href="product-slab-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">View All Slab</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="product-slab-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="title" value="<?php echo $rows['title']; ?>" class="form-control" placeholder="Title">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Title in hebrew</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title_in_hebrew" id="title_in_hebrew" value="<?php echo $rows['title_in_hebrew']; ?>" class="form-control" placeholder="Title in hebrew">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">SKU</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sku_ids" id="sku_ids" value="<?php echo $rows['sku_ids']; ?>" class="form-control" placeholder="SKU">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" id="description" rows="4"><?php echo $rows['description']; ?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Column</label>
                                    <div class="col-sm-9">
                                        <select name="column" class="form-control col-md-4">
    								  	    <option value="2" <?php if($rows['rows']=="2") echo "Selected";?>>2 Column</option>
        									<option value="4" <?php if($rows['rows']=="4") echo "Selected";?>>4 Column</option> 
    								    </select>
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
                                <button type="submit" class="banner btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button> 
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
    $('.banner').click(function(){ 
	var title = $('#title').val();   
	var sku_ids = $('#sku_ids').val();    
	
	if(title == '')
	{  
		$('#title').css("border","1px solid red");
		$('#title').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter title</div>");
		return false;
	}
	else
	{ 
		$('#title').css("border","1px solid #bdb9b9"); 
	} 
    
    
    if(sku_ids == '')
	{  
		$('#sku_ids').css("border","1px solid red");
		$('#sku_ids').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter sku</div>");
		return false;
	}
	else
	{ 
		$('#sku_ids').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	
     
	 
}); 
</script> 