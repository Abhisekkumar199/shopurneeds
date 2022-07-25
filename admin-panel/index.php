<?php 
session_start();
include("include/configurationadmin.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from flatfull.com/themes/basik/html/signin.1.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Jan 2020 05:56:31 GMT -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Super Admin Panel Perpetual Access Licence Active - Webkype</title>
    <meta name="description" content="Super Admin Panel Perpetual Access Licence Active - Webkype">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <!-- style -->
    <link rel="stylesheet" href="<?php echo URL; ?>/admin-panel/assets/css/site.min.css">
</head>

<body class="layout-row">
    <div class="flex">
        <div class="w-xl w-auto-sm mx-auto py-5">
            <div class="p-4 d-flex flex-column h-100">
                <!-- brand -->
                <a href="<?php echo URL; ?>" class="navbar-brand align-self-center">
                    <img src="<?php echo URL; ?>/assets/images/logo.png" alt="..." style="max-height: 4.5rem;width:150px;height:90px;">
                </a>
                <!-- / brand -->
            </div>
            <div class="card">
                <div id="content-body">
                    <div class="p-3 p-md-5">
                        <?php  
                            echo $_SESSION['message']; 
	                        unset($_SESSION['message']); 
	                    ?>
                        <h5>Login</h5> 
                        <form class="" role="form" action="logincheck.php" method="post">
                            <span id="message"> </span>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password"> 
                            </div> 
                            <button type="submit" class="btn btn-primary mb-4 login">Sign in</button> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center text-muted">&copy; Perpetual Access Licence Active
    Copyright : Webkype.com</div>
        </div>
    </div>
    <script src="<?php echo URL; ?>/admin-panel/assets/js/site.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('.login').click(function(){ 
    	var username = $('#username').val();   
    	var password = $('#password').val(); 
    	if(username == '')
    	{  
    		$('#username').css("border","1px solid red");
    		$('#username').focus();
    		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter user id</div>");
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
        
    }); 
    </script> 
</body> 

</html>