<style>
    .pb-60 {
    padding-bottom: 49px;
}
.pt-60 {
    padding-top: 31px;
}
</style>
<div class="breadcrumb section pt-60 pb-60 mb-30" style="margin-bottom:0px;">
    <div class="container">
        <h1 class="uppercase">Login</h1>
        <ul>
            <li><a href="<?php echo URL; ?>"><i class="fa fa-home"></i></a></li>
            <li class="active">Seller Login</li>
        </ul>
    </div>
</div>
    <!-- =====  BREADCRUMB END===== -->
    <div class="page-login section">
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <div class="col-12 my-4">
          <div class="row">
            
            <!-- Login -->
            <div class="col-md-6 col-12 d-flex">

                <div class="register">
                    
                    <h3>Login to seller account</h3> 

                    <!-- Login Form -->
                    <form method="post" action="<?php echo URL; ?>/process/seller-login-process.php" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <span id="login_message" > </span> 
                                <?php echo $_SESSION['sessionregmsg']; unset($_SESSION['sessionregmsg']); ?>
                            </div> 
                            <div class="form-group">
                            <input class="  form-control" name="seller_emailid" id="seller_emailid" type="text" placeholder="Email" autocomplete="off"> 
                            </div> 
                            <div class="form-group">
                            <input class="  form-control" name="seller_password" id="seller_password" type="password" placeholder="Password">
                            </div> 
                            <button type="submit" class="btn mt-10 " id="register1" style="background-color:#84c225;">Login</button>
                    </form>

                    <h4>Don’t have account? please <a href="<?php echo URL; ?>/register-seller" style="color:#84c225;">click here for register</a></h4>
                    
                </div>
            </div>

            
            <!-- Login With Social -->
            <div class="col-md-6 col-12 d-flex">  
                <img src="../assets/images/seller2.jpg" alt="Account Image Placeholder" class="image-placeholder"> 
            </div>
            
        </div>

        </div>
      </div>
    </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#register1').click(function(){      
        	var seller_emailid = $('#seller_emailid').val();   
        	var seller_password = $('#seller_password').val();  
            
            if(seller_emailid == '')
        	{  
        		$('#seller_emailid').css("border","1px solid red");
        		$('#seller_emailid').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter email id</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_emailid').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	}  
        	  
        	if(seller_password == '')
        	{  
        		$('#seller_password').css("border","1px solid red");
        		$('#seller_password').focus(); 
        		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter password</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_password').css("border","1px solid #bdb9b9"); 
                $('#register_message').html("");
        	} 
        	 
        });   
        }); 
    </script>