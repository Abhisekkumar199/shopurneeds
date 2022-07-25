<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."promotion where id='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight"><?php if($_SESSION['admin_language'] == 'HE') { ?>הוסף קידום<?php } else { ?>Join Promotion<?php } ?></h2>
                </div>
                <div class="flex"></div>
                <div><a href="promotion-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?>רשימת קידום<?php } else { ?>Promotion List<?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="ajax_join_permotion.php" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="promotion_id"  value="<?php echo $_REQUEST['id']; ?>"  />
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
                                    <div class="card-header"><strong><?php if($_SESSION['admin_language'] == 'AR') { ?> INFOMRMATION<?php } else { ?>INFOMRMATION<?php } ?></strong></div>
                                    <div class="card-body"> 
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Select <?php } else { ?>Select<?php } ?></label>
                                            <div class="col-sm-9 <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>">
                                                <input type="radio" class="checkpro" name="optradio" value="1" checked  />
                                                <?php if($_SESSION['admin_language'] == 'AR') { ?>All Product<?php } else { ?>All Product<?php } ?>
                                                <input type="radio" class="checkpro" name="optradio" value="2"   />
                                                <?php if($_SESSION['admin_language'] == 'AR') { ?>Selected Product<?php } else { ?>Selected Product<?php } ?> 
                                            </div>
                                        </div>  
                                        <div class="row"> 
                                            <div class="col-md-12">  
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text" id=""><?php if($_SESSION['admin_language'] == 'AR') { ?>Product UPIds<?php } else { ?>Product UPIds<?php } ?></span></div>
                                                    <?php 
                                                    $sqlsellerproduct = mysqli_query($conn,"select * from  ".$sufix."product where seller_id='".$_SESSION['sellerid']."'");
                                                     $a = 1; 
                                                    while($rowsproduct = mysqli_fetch_assoc($sqlsellerproduct))
                                                    {
                                                      if($a == 1)
                                                      {
                                                          $oldsku .= $rowsproduct['master_sku']; 
                                                      }
                                                      else
                                                      {
                                                          $oldsku .= ",".$rowsproduct['master_sku']; 
                                                      }
                                                      
                                                      $a++;  
                                                    }
                                                  ?>
                                                    <input type ="hidden" id="masterskuid1" value="<?php echo $oldsku; ?>" /> 
                                                    <input type="text" class="form-control" id="upids"   name="upids" value="<?php echo $oldsku; ?>"  required>
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                </div> 
                                 
                                <button type="submit" class="seller btn w-sm mb-1 btn-success submitpromotion" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'AR') { ?> Join<?php } else { ?>Join<?php } ?></button>
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
    $(".checkpro").click(function(){
         
	    var radioValue = $("input[name='optradio']:checked").val();
	    var skuids = $('#masterskuid1').val();
	     
	    if(radioValue == 2)
	    {
	       $('#upids').val('');
	    }
	    else
	    {
	         $('#upids').val(skuids);
	    }
	});  
	
	$(".submitpromotion").click(function(){ 
	    var radioValue = $("input[name='optradio']:checked").val();
	    var promotionId = $('#promotionId').val(); 
        var skuids = $('#upids').val();
        
        if(skuids == '')
        { 
           $('#message').html("Please enter Master SKU Ids!"); 
           return false;
        }
        else
        {
           $('#message').html("");
        } 
	}); 
 
</script> 