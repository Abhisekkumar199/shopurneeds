<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."questions where id='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight">Add Question</h2>
                </div>
                <div class="flex"></div>
                <div><a href="static-pages" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">All Questions</span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="question-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <label class="col-sm-3 col-form-label">Question</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="question" id="question" rows="4" value="<?php echo $rows['question']; ?>" /> 
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Option 1</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="option1" id="option1" rows="4" value="<?php echo $rows['option1']; ?>" /> 
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Option 2</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="option2" id="option2" rows="4" value="<?php echo $rows['option2']; ?>" />
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
                                <button type="submit" class="pages btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button>
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
    $('.pages').click(function(){   
     
        
    }); 
 $('textarea').each(function(){
		CKEDITOR.replace(this.name,{
		toolbar: [
			{ name: 'document', items: [ 'Source','-','Print','-','Preview','-','Bold','-', 'Italic','-','Underline','-','list','-','align','-','NumberedList','-','BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','-','JustifyCenter','-','JustifyRight','-','JustifyBlock','-','Maximize','-','spellchecker','-','Link','-','Image','-','Table','-','Smiley','-','SpecialChar','-','TextColor', 'BGColor','Format', 'Font','FontSize','-'] }        		
			
		]
	});
});
</script> 