<style>
select, textarea, input[type="text"], input {
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

</style>

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
<script language="JavaScript">
function checkall(objForm){
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
}
function ena(enable2)
{
	document.wsh.action='<?php echo URL; ?>/checkout/whishlist';
	document.wsh.submit(); //
}
</script>
<div class="ma-page">
  <div class="container">
    <div class="container-home">
      <div style="text-align:left; padding-top:15px;">
        <h2>Change Password</h2>
      </div>
      <fieldset>
        <table width="100%">
          <tr>
            <td width="30%" align="left" valign="top"><?php include("includes/left_account_seller.php"); ?></td>
            <td width="5%" align="left" valign="top">&nbsp;</td>
            <td width="70%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="left" bgcolor="#CCCCCC" class="head_shadow heading pad_1 pad-cart" style="padding-left:5px;">Change Password</td>
                </tr>
                <tr>
                  <td height="5" class="body-txt" style="padding-left:8px;padding-right:8px; padding-top:3px;"><?php
					$sql=mysqli_query($conn,"select * from `".$sufix."suppliers` where companyname='".$_SESSION['cname']."'") ;
					if($rows=mysqli_fetch_array($sql))
					{
					 ?>
                    <table align="center" border="0" width="100%" cellspacing="5" cellpadding="0" class="table-border" style="line-height:40px;">
                      <tr>
                        <td align="left" colspan="3" style="padding-left:10px;"><strong>Hello <?php echo $rows['companyname']; ?> </strong><br />
                          From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information. </td>
                      </tr>
                      <tr>
                        <td valign="middle" style="padding:10px;" height="5" colspan="3"><?php echo session_msg(); ?></td>
                      </tr>
                      <tr>
                        <td width=38% class=formtxt_lable valign="top" colspan="3"><form name="form2" id="form2" action="<?php echo URL; ?>/sellerchangepassword_process.php" method="post" style="text-align:left; background: margin:0; border:0;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="86%" valign="top"><table width="94%" border="0" align="center" cellpadding="2" cellspacing="2" class="body-txt table-border">
                                    <tr>
                                      <td colspan="2"><strong>Authorization Information</strong></td>
                                    </tr>
                                    <tr>
                                      <td width="35%" align="right" class="pad_1">Old Password: </td>
                                      <td width="65%"><input type="password" name="oldpassword" size="35" required="true" /></td>
                                    </tr>
                                    <tr>
                                      <td width="35%" align="right" class="pad_1">New Password: </td>
                                      <td width="65%"><input type="password" name="password" id="regpassword" required="true" size="35" pattern="\w{6,}" onchange=" this.setCustomValidity(this.validity.patternMismatch ? 'Password must contain at least 6 characters' : ''); if(this.checkValidity()) form2.cregpassword.pattern = this.value;" /></td>
                                    </tr>
                                    <tr>
                                      <td align="right" valign="top" class="pad_1">Confirm Password: </td>
                                      <td><input type="password" name="cpassword" id="cregpassword" required="true" size="35" pattern="\w{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : ''); "/></td>
                                    </tr>
                                  </table></td>
                                <td width="14%" valign="top">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="3" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td align="left" style="padding-left:233px;"><input name="" type="submit" value="Submit" /></td>
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
                        <td colspan="3" height="15"></td>
                      </tr>
                    </table>
                    <?php } ?></td>
                </tr>
                <tr>
                  <td style="border-bottom:#FF0000 solid 1px;" colspan="3"><img src="images/specer.gif" width="5" height="5" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td class="left-menu" align="right"><a href="<?php echo URL; ?>/donor"><font color="#FF0000">Click Here to see the list</font></a>&nbsp;&nbsp; </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>