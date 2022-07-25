<script language="javascript"> 
function showonlyonev2(thechosenone) { 
  var newboxes = document.getElementsByTagName("div");
  for(var x=0; x<newboxes.length; x++) {
		name = newboxes[x].getAttribute("name");
		if (name == 'newboxes-2') {
			  if (newboxes[x].id == thechosenone) {
					if (newboxes[x].style.display == 'block') {
						  newboxes[x].style.display = 'none';
					}
					else {
						  newboxes[x].style.display = 'block';
					}
			  }else {
					newboxes[x].style.display = 'none';
			  }
		}
  }
}
function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);
} //
</script>
<style>
/*select, textarea, input[type="text"], input {
    border: 1px solid #eee;
    border-radius: 4px;
    box-sizing: content-box;
    color: #555555;
    display: inline-block;
    font-size: 14px;
    height: 24px;
    line-height: 24px;
    margin-bottom: 10px;
    padding: 4px 6px;
    vertical-align: middle;
}
.uplabel .form-control {
    padding-top: 10px !important; height:100% !important; padding-bottom: 10px !important;
}*/

@media (max-width: 640px) {
	.da_body .da_dashboard{ width:100%; padding:0; margin-top:10px;}
	.da_body .da_left_dash {
    border-right: 0 none;
    padding-right: 0;
    width: 100%;
}
.da_body .da_left_dash ul li a{ text-align:center;}
.da_body .da_right_board {
    padding: 0 15px;
    width: 100%;
}
.da_body .da_dashboard_cont {
    float: left;
    width: 100%;
}	
	.da_body .da_right_board h1 p {
    float: left;
    margin-top: 20px;
    width: 100%;
}
.da_body .da_more_info_container .da_onehalf.fleft {
    float: left;
    width: 100%;
}
.table-responsive{ border:0 !important}
	}
</style> 
<div class="da_body"  style="width:100%; padding:10px;" >
  <?php
		$sql=mysqli_query($conn,"select * from `".$sufix."user_registration` where emailid='".$_SESSION['emailid']."'") or die(mysql_error());
		if($rows = mysqli_fetch_assoc($sql))
		{
		 ?>
  <div class="da_dashboard">     
    <!--left dashboard sidebar starts here-->
    <?php include("includes/left_account.php"); ?>
    <!--right dashboard starts here-->
    <div class="da_right_board fleft">
      <h1><img src="images/fav-showroom.png"> Change Password <p class="pull-right">Welcome : <?php if($_SESSION['fnamenew']!='') { echo $_SESSION['fnamenew']; } else { echo "GUEST"; } ?></p></h1>
            <!--Fav Stores Starts here-->      
      <div class="da_dashboard_cont">
        <div class="da_more_info_container table-responsive">
          <table width="100%">
           <tr>
              <td valign="middle" ><?php echo session_msg(); ?></td></tr>
            </tr>
            <tr>
              <td align="center" colspan="3"><form name="form2" id="form2" action="<?php echo URL; ?>/process/changepassword_process.php" method="post" onsubmit="return validate123();" style="text-align:left; background: margin:0; border:0;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="50%" valign="top">
                      <table border="0" align="left" cellpadding="0" cellspacing="0" class="body-txt table-border">
                          <tr>
                            <td colspan="2" class="da_wel_dash"> <h3>Authorization Information</h3></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp; </td></tr>
                        
                          <tr>
                          <td><div id="regpasswordDiv" class="form-group uplabel">
                                    <label class="label-txt" for="regpassword">NEW PASSWORD</label>
                                    <input type="password" name="password" id="regpassword" class=" form-control" required="true" size="35"  />
                                  </div></td>
                          
                          </tr>
                          <tr>
                            <td><div id="cregpasswordDiv" class="form-group uplabel">
                                    <label class="label-txt" for="cregpassword">CONFIRM PASSWORD</label>
                                  <input type="password" name="cpassword" id="cregpassword" required="true" class=" form-control" size="35" />
                                  </div></td>
                            
                          </tr>
                        </table></td>
                      <td width="10%" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" ><button type="submit" title="Continue Shopping" class="btn btn-primary btn-continue"><span><span>Continue</span></span></button>
               <!--<a href="#" onclick="document.getElementById('frmshipping').submit();" style="text-decoration:none; color:#FFFFFF;">Continue</a>--></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                </form></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
          </table>
          </td>
          </tr>
          </table>
          </td>
          </tr>
          </table>
        </div>        
        <!--more info ends here-->         
      </div>      
      <!--Fav Stores ends here-->       
    </div>    
    <!--right dashboard ends here-->    
    <div class="clear"></div>
  </div>
  <?php } ?>
</div>
<script>
    function validate123() {
        var regpassword = document.getElementById("regpassword").value;
        var cregpassword = document.getElementById("cregpassword").value;
        if (regpassword != cregpassword) {
            alert("Passwords Do not match");
            document.getElementById("regpassword").style.borderColor = "#E34234";
            document.getElementById("cregpassword").style.borderColor = "#E34234";
			return false;
        }
        else {
			return true;
        }
    }
</script>