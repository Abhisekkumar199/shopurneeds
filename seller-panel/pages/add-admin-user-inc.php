<?php  
    if(isset($_REQUEST['option'])=="Edit" && isset($_REQUEST['id'])!='')
    {  
    	$sql_menu = mysqli_query($conn,"select * from ".$sufix."admin where id='".$_REQUEST['id']."'") ;
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
                    <h2 class="text-md text-highlight"><?php if($_SESSION['admin_language'] == 'HE') { ?>הוסף את המוכר<?php } else { ?>Add Seller <?php } ?></h2>
                </div>
                <div class="flex"></div>
                <div><a href="seller-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?>צפה בכל המוכר<?php } else { ?>View All Seller<?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="admin-user-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
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
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם משתמש<?php } else { ?>User Name<?php } ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="username" id="username" value="<?php echo $rows['username']; ?>" maxlegth="20" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם משתמש<?php } else { ?>User Name<?php } ?>">
                                    </div>
                                </div> 
                                <?php if($_REQUEST['id'] == '') { ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סיסמה<?php } else { ?>Password<?php } ?></label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" id="password" value="<?php echo $rows['password']; ?>" maxlegth="10" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>סיסמה<?php } else { ?> Password <?php } ?>">
                                    </div>
                                </div> 
                                <?php } ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>שם<?php } else { ?>Name<?php } ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" id="name" value="<?php echo $rows['name']; ?>" maxlegth="50" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>שם<?php } else { ?>Name<?php } ?>">
                                    </div>
                                </div> 
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מזהה אימייל<?php } else { ?>Email Id<?php } ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="email" id="email" value="<?php echo $rows['email']; ?>" maxlegth="100" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>מזהה אימייל<?php } else { ?>Email Id<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>מס 'נייד<?php } else { ?>Mobile No<?php } ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" id="phone" value="<?php echo $rows['phone']; ?>" maxlegth="12" class="form-control" placeholder="<?php if($_SESSION['admin_language'] == 'HE') { ?>מס 'נייד<?php } else { ?>Mobile No<?php } ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סוג משתמש<?php } else { ?>User Type<?php } ?></label>
                                    <div class="col-sm-6">
                                        <select name="type" class="form-control col-md-4"> 
    								  	    <option value="User" <?php if($rows['type']=="User") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>משתמש<?php } else { ?>User<?php } ?></option>
        									<option value="Master" <?php if($rows['type']=="Master") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>אדון<?php } else { ?>Master<?php } ?></option> 
    								    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>הרשאה<?php } else { ?>Permission<?php } ?></label>
                                    <div class="col-sm-9 <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>">
                                        <?php
                                        $per = explode(',',$rows['permission']);
                                        $select = mysqli_query($conn,"select * from ".$sufix."menu_permission where parent='0' and displayflag='1'");
                                        while($menurows = mysqli_fetch_assoc($select)) {
                                        ?>
                                        <input type="checkbox" name="permission[]" value="<?php echo $menurows['id'];?>" <?php if(in_array($menurows['id'],$per)) { echo "checked='checked'"; } ?> />
                                        <?php if($_SESSION['admin_language'] == 'HE') {  echo $menurows['menu_name_in_hebrew']; } else {  echo $menurows['menu']; } ?>&nbsp;&nbsp;
                                        <?php } ?>
                                    </div>
                                </div>
                                 
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label <?php if($_SESSION['admin_language'] == 'HE') { ?>text-right <?php } ?>"><?php if($_SESSION['admin_language'] == 'HE') { ?>סטטוס<?php } else { ?>Status<?php } ?></label>
                                    <div class="col-sm-6">
                                        <select name="status" class="form-control col-md-4">
    								  	    <option value="1" <?php if($rows['displayflag']=="1") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>אפשר<?php } else { ?>Enable<?php } ?></option>
        									<option value="0" <?php if($rows['displayflag']=="0") echo "Selected";?>><?php if($_SESSION['admin_language'] == 'HE') { ?>השבת<?php } else { ?>Disable<?php } ?></option> 
    								    </select>
                                    </div>
                                </div>
                                
                                <button type="submit" class="adminuser btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור<?php } else { ?>SAVE <?php } ?></button>
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
    $('.adminuser').click(function(){ 
	var username = $('#username').val(); 
	var password = $('#password').val(); 
	var name = $('#name').val();     
	if(username == '')
	{  
		$('#username').css("border","1px solid red");
		$('#username').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter username</div>");
		return false;
	}
	else
	{ 
		$('#username').css("border","1px solid #bdb9b9"); 
	}  
    
    if(password == '')
	{  
		$('#password').css("border","1px solid red");
		$('#password').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter password</div>");
		return false;
	}
	else
	{ 
		$('#password').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	if(name == '')
	{  
		$('#name').css("border","1px solid red");
		$('#name').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter name</div>");
		return false;
	}
	else
	{ 
		$('#name').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	 
}); 
</script> 