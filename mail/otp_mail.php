<?php
include("includes/configuration.php");
	
include("includes/libraries/mailfunction.php");
   

$fromc = "https://localhost/project/shopurneeds<info@shopurneeds.in>";
$toc = $emailforotp;
$subjectc = " OTP";
$message='<table width="700" align="center" cellpadding="0" cellspacing="0" style="font-size:13px;font-family:arial,sans-serif;color:#00295e;background:#f7cfbe;padding:0px">
  <tbody>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#fff4da">
          <tbody>
            <tr>
              <td height="70" align="center" valign="middle" style="background-color:#fcb800;padding:0px"><table style="color:#00295e;font-size:20px;width:100%">
                  <tbody>
                    <tr>
                      <td height="70" align="center" valign="middle" style="background-color: #fcb800;"><a href="https://localhost/project/shopurneeds" style="display:block;border:0;text-decoration:none" target="_blank" data-saferedirecturl=""> <img style="max-width:250px;" style="display:block;border:0" src="https://localhost/project/shopurneeds/asset/img/logo.png" class="CToWUd"> </a></td>
                    
                    </tr>
                  </tbody>
                </table></td>
            </tr>
             
            <tr>
              <td><table width="100%" border="0" align="center" cellpadding="15" cellspacing="0">
                  <tbody>
                    <tr>
                      <th align="center" style="font-size:17px;  ">Password</th>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="15" cellpadding="0" >
                          <tbody>
                            <tr>
                              <td colspan="2" height="30" align="left" valign="middle" style="color:#00295e;font-size:18px">Dear User,</td>
                            </tr>
                            <tr>
                              <td colspan="2" height="30" align="left" valign="middle" style="color:#00295e;font-size:15px"> Thank you for shopping at https://localhost/project/shopurneeds! </td>
                            </tr>
                            <tr>
                              <td colspan="2" height="30" align="left" valign="middle" style="color:#00295e;font-size:15px">OTP for online order on https://localhost/project/shopurneeds is . '.$six_digit_random_number.'</td>
                            </tr>
                             
                            
                            <tr>
                              <td colspan="2" height="30" align="left" valign="middle" style="color:#00295e;font-size:13px"> In case of any queries, please feel free to contact us at 0120-4123499, +91-9717295892 between <span class="aBn" data-term="goog_118579545" tabindex="0"><span class="aQJ">Monday</span></span> to <span class="aBn" data-term="goog_118579546" tabindex="0"><span class="aQJ">Saturday</span></span> <span class="aBn" data-term="goog_118579547" tabindex="0"><span class="aQJ">09:00 AM – 7:00 PM (IST)</span></span>.  You may also email us at <a href="" target="_blank">care@https://localhost/project/shopurneeds</a>. </td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <th align="center" style="font-size:18px;"> <a href="" style="display:block;border:0;background-color:#002b4f;color:#fff;width:150px;font-size:15px;text-decoration:none;padding:7px;border-radius:5px" target="_blank" data-saferedirecturl="">FEEDBACK</a> </th>
                    </tr>
                     
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>';
  ?>
  