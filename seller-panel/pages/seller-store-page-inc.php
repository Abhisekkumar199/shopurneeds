<?php   
	$sql_seller= mysqli_query($conn,"select * from ".$sufix."suppliers where id='".$_SESSION['sellerid']."'") ;
	$rows = mysqli_fetch_assoc($sql_seller); 
	$option="Edit"; 
    
    
    if($_REQUEST['profilepic_delete_id']!='') 
    {
        $file = "../uploads/sellerimages/".$rows['uploadimage']; 
        unlink($file);
         mysqli_query($conn,"update  ".$sufix."suppliers set uploadimage='' where id='".$_REQUEST['logo_delete_id']."'");
    } 
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight"><?php  echo $row['suppliername']; ?></h2>
                </div>
                <div class="flex"></div> 
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="seller-store-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="id"  value="<?php echo $_SESSION['sellerid']; ?>"  />
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
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?> Showroom Name<?php } else { ?> Showroom Name <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="showroom_name" id="showroom_name" value="<?php echo $rows['showroom_name']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Showroom Name <?php }  else { ?> Showroom Name <?php } ?>">
                                    </div>
                                </div> 
                               
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>  Banner 1  <?php }  else { ?> Banner 1 <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="banner1" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['banner1']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/sellerimages/<?php echo $rows['banner1']; ?>" width="120"  /><br />
										<strong><?php if($_SESSION['admin_language'] == 'AR') { ?>   <?php } else { ?> Existing Image <?php } ?></strong>
										<a href="<?php echo URL;?>/admin-panel/add-seller.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&banner1_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>מחק<?php }  else { ?> Delete <?php } ?></a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['banner1']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>  Banner 2  <?php }  else { ?> Banner 2 <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="banner2" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['banner2']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/sellerimages/<?php echo $rows['banner2']; ?>" width="120"  /><br />
										<strong><?php if($_SESSION['admin_language'] == 'AR') { ?>   <?php } else { ?> Existing Image <?php } ?></strong>
										<a href="<?php echo URL;?>/admin-panel/add-seller.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&banner2_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>מחק<?php }  else { ?> Delete <?php } ?></a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['banner2']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>  Banner 2  <?php }  else { ?> Banner 2 <?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="banner3" type="file" size=20 class="form-control col-md-5" /> &nbsp; 
 										<?php if($rows['banner3']!='')
										{
										?>	 
										<br> 
										<img src="../uploads/sellerimages/<?php echo $rows['banner3']; ?>" width="120"  /><br />
										<strong><?php if($_SESSION['admin_language'] == 'AR') { ?>   <?php } else { ?> Existing Image <?php } ?></strong>
										<a href="<?php echo URL;?>/admin-panel/add-seller.php?option=Edit&id=<?php echo $_REQUEST['id'];?>&page=1&banner3_delete_id=<?php echo $_REQUEST['id'];?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>מחק<?php }  else { ?> Delete <?php } ?></a>
										 
										<?php } ?>
										<input type="hidden" name="blankimage" value="<?php echo $rows['banner3']; ?>"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Facebook Url<?php } else { ?>Facebook Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="facebookurl" id="facebookurl" value="<?php echo $rows['facebookurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Facebook Url<?php } else { ?> Facebook Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Twitter Url<?php } else { ?>Twitter Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="twitterurl" id="twitterurl" value="<?php echo $rows['twitterurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Twitter Url<?php } else { ?> Twitter Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Instagram Url<?php } else { ?>Instagram Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="instagramurl" id="instagramurl" value="<?php echo $rows['instagramurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Instagram Url<?php } else { ?> Instagram Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Flipkart Store Url<?php } else { ?>Flipkart Store Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="flipkarturl" id="flipkarturl" value="<?php echo $rows['flipkarturl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Flipkart Store Url<?php } else { ?> Flipkart Store Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Amazon Store Url<?php } else { ?>Amazon Store Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="amazonurl" id="amazonurl" value="<?php echo $rows['amazonurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Amazon Store Url<?php } else { ?> Amazon Store Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Myntra Store Url<?php } else { ?>Myntra Store Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="myntraurl" id="myntraurl" value="<?php echo $rows['myntraurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Myntra Store Url<?php } else { ?>Myntra Store Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Shopclues Store Url<?php } else { ?>Shopclues Store Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="shopcluesurl" id="shopcluesurl" value="<?php echo $rows['shopcluesurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Shopclues Store Url<?php } else { ?>Shopclues Store Url<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Ebay Store Url<?php } else { ?>Ebay Store Url<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="ebayurl" id="ebayurl" value="<?php echo $rows['ebayurl']; ?>" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'AR') { ?>Ebay Store Url<?php } else { ?>Ebay Store Url<?php } ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>About Us<?php }else { ?>About Us<?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="aboutus" id="aboutus" rows="4"><?php echo $rows['aboutus']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?>Shipping Details<?php } else { ?>Shipping Details <?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="shipping" id="shipping" rows="4"><?php echo $rows['shipping']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?> Customer service<?php }else { ?> Customer service<?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="customerservice" id="customerservice" rows="4" ><?php echo $rows['customerservice']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'AR') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'AR') { ?> Return<?php }else { ?> Return<?php } ?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="returns" id="returns" rows="4" ><?php echo $rows['returns']; ?></textarea>
                                    </div>
                                </div> 
                                
                                <button type="submit" class="seller btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'AR') { ?>Save<?php } else {?> SAVE <?php } ?></button>
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
</script> 