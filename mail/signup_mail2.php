<?php
$toc=$_REQUEST['emailid'];
$fromc = "info@shopurneeds.in";
$subjectc = "shopurneeds Seller Registration Confirmation";
$message='<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td style="padding-top:15px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        
          <td width="50%" align="left"><a href="https://localhost/project/shopurneeds"><img src="https://localhost/project/shopurneeds/images/logo.png" width="200" /></a></td>
          <td width="50%" align="center">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width=" 100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:inherit; padding-top:10px;"><strong>Dear  '.ucfirst($fname12).',</strong><br /></td>
                          </tr>
                          <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:inherit; padding-top:10px; line-height:22px;">Welcome to Shop Ur Needs!<br>
                              <br>
                              Thanks for your interest in doing business with us. We are happy to inform you that you are just a few steps away from completing your registration.<br>
                              <br>
                              Kindly complete your registration by at the earliest so that your seller account gets active. All you need to do is follow the following simple steps and GO LIVE instantly :<br>
                              1. Login using your below mentioned credentials. <br>
                              2. Fill in your details (Address and Bank account details.)<br>
                              3. List your products.<br>
                              4. Start Selling.<br>
                              <br>
                              You can access your seller account using this URL : <a href="https://localhost/project/shopurneeds/sellerszone/">https://localhost/project/shopurneeds/sellerszone/</a> <br>
                              Verify Link <a href='.$URL.'/seller_account_verify.php?hash='.$hash.'>Click here</a><br>
                              Login Id : <b><a href="mailto:'.$toc.'">'.$toc.'</a></b><br>
                              Password : <b>'.$randpass.'</b><br>
                              <br>
                              Our seller on-boarding team will guide you step by step for further processes.<br>
                              <br>
                              If you require further dedicated help, you can reach out to Seller Support Team anytime for any assistance at <a href="mailto:ss@https://localhost/project/shopurneeds">ss@https://localhost/project/shopurneeds</a>.<br></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><hr size="1" color="#CCCCCC"></td>
                    </tr>
                    <tr>
                      <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; font-weight:inherit; padding-top:5px;">Best Regards,<br>
                        shopurneeds Team </td>
                    </tr>
                    
                    <tr>
                      <td><hr size="1" color="#CCCCCC"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
';



?>