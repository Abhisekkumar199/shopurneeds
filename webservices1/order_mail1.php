<?php
$fromc="info@keramicfresh.com";
$toc=$rowuser['emailid'];
$orderid=$orderid;
$sqlssa=mysql_query("select * from `buyde_order` where oid='".$orderid."'");
$rows = mysql_fetch_array($sqlssa);
$ordercost=$rows['totalcost'];
$subjectc="Keramic Fresh ORDER COFIRMATION FOR ORDER NO:- ".$orderid; 
$message = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>confirmation mail</title>
</head>
<body>
<div bgcolor="#ffffff" marginwidth="0" marginheight="0" style="margin:0;padding:0">
  <table style="font-family:Arial,sans-serif;font-weight:normal; font-size:12px;" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
              <tr>
                <td align="center" valign="top">
                <table style="width:600px" width="600" border="0" cellspacing="0" cellpadding="0">
                    <tbody>                      
                      <tr>
                        <td width="100%" bgcolor="#ffffff" align="right"
                         style="color:#222;font-family:Arial,sans-serif;font-weight:normal;font-size:12px;margin:0;padding:5px 5px 5px 5px">
                           </td>
                      </tr>
                      <tr>
                        <td bgcolor="#f3f3f3">
                        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style=" background:#fff;">
                            <tbody>
                              <tr>
                                <td align="center" width="100%" bgcolor="#fff" style="padding:20px 12px 15px 12px; border:3px solid #4aa4a5;">
                                <table align="left" border="0" cellspacing="0" cellpadding="0" style="">
                                    <tbody>
                                      <tr>
                                        <td align="left" style="font-size:1px;line-height:0">
         <a href="http://www.direct-pharmacy.co.uk/" target="_blank"> <img style="outline:none;text-decoration:none;border:none;padding:0px 5px 0px 5px"
 src="http://direct-pharmacy.co.uk/confirmation_mail/images/logo.jpg" width="240" height="49" alt="Chemist Direct" border="0"> </a></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table align="right" border="0" cellspacing="0" cellpadding="0" style="">
                                    <tbody>
                                      <tr>
                                        <td align="right" style="font-family:Arial,sans-serif;font-size:12px;color:#ffffff;padding:3px 0px 7px 0px"><a style="color:#4aa4a5;text-decoration:none" href="" target="_blank">Free standard UK delivery</a></td>
                                        <td><img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/delivery-2.png" width="25" height="16" alt="" border="0"></td>
                                      </tr>
                                      <tr>
                                        <td height="5" align="right" style="font-family:Arial,sans-serif;font-size:12px;color:#ffffff"></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td align="right" style="font-family:Arial,sans-serif;font-size:12px;color:#ffffff"><a style="color:#4aa4a5;text-decoration:none" href="" target="_blank">Call us on 01216616357</a></td>
                                        <td><img style="outline:none;text-decoration:none;border:none" border="0" src="http://direct-pharmacy.co.uk/confirmation_mail/images/phone-2.png" width="25" height="16" alt=""></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="center" width="100%" bgcolor="#ffffff" style="border-left:1px solid #eee; border-right:1px solid #eee;">
                                  <table border="0" cellspacing="0" cellpadding="0" style="background:#fff" width="100%">
                                    <tbody>
                                      <tr>
                                        <td style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;text-align:center;padding-top:14px;padding-bottom:14px">
                                        <a style="color:#5a535d;text-decoration:none" href="http://www.direct-pharmacy.co.uk/medicine-pharmacy" target="_blank"> <strong> Medicine & Pharmacy</strong> </a></td>
                                        <td style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;text-align:center;padding-top:14px;padding-bottom:14px">
                                        <a style="color:#5a535d;text-decoration:none" href="http://www.direct-pharmacy.co.uk/baby-store" target="_blank"> <strong>Baby Store</strong> </a></td>
                                        <td style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;text-align:center;padding-top:14px;padding-bottom:14px">
                                        <a style="color:#5a535d;text-decoration:none" href="http://www.direct-pharmacy.co.uk/health-personal-care" target="_blank"> <strong> Health & Personal Care</strong> </a></td>
                                        <td style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;text-align:center;padding-top:14px;padding-bottom:14px">
                                        <a style="color:#5a535d;text-decoration:none" href="http://www.direct-pharmacy.co.uk/beauty-cosmetics" target="_blank"> <strong>  Beauty & Cosmetics</strong> </a></td>
                                 </tr> </tbody> </table></td>
                              </tr>
                              <tr>
                                <td align="center" style="padding:0px 0px 0px 0px;">
                                <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style=" border-left:1px solid #eee; border-right:1px solid #eee;">
                                    <tbody>
                                      <tr>
                                        <td width="100%"  style="background:#ffffff; font-family:Arial,sans-serif; font-size:12px; color:#5a535d; ">
                                        <table border="0" cellspacing="0" cellpadding="0" style="width:100%; padding:0 10px; background:#4aa4a5; color:#fff;" >
                                            <tbody>
                                              <tr>
                                                <td style="font-size:18px; text-align:center; padding:10px 0"> Order Information </td>
                                              </tr>                                              
                                            </tbody>
                                          </table></td></tr>
                                          <tr>
                                          <td>
                                          <table width="100%"  border="0" cellpadding="0" cellspacing="0" style="padding:0 10px;">
                                          <tbody>
                                          <tr>
                                                <td style="padding-bottom:15px" align="left">&nbsp;</td>
                                              </tr> 
                                           <tr>
                                                <td style="padding-bottom:15px" align="left"> Hi '.ucfirst($rowuser['fname']).', </td>
                                              </tr> 
                                              <tr>
                                                <td style="padding-bottom:15px" align="left"> Thank you for placing an order with <strong>direct-pharmacy.co.uk</strong></td>
                                              </tr>
                                              <tr>
                                                <td style="padding-bottom:15px" align="left"><strong> YOUR ORDER DETAILS ARE:</strong></td>
                                              </tr>
                                              
                                          
                                          </tbody>
                                          
                                          </table></td>
                                      </tr>
                                           <tr>
                                          <td>
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" padding:0 10px;">
                                            <tbody>
                                              <tr>
                                                <td >
                                                <table border="0" cellspacing="0" cellpadding="0" style="width:100%" align="left">
                                                    <tbody>
                                                      <tr>
                                                        <td width="23%" align="left" style="padding-bottom:15px">Order number is:  </td>
                                                         <td width="77%" align="left" style="padding-bottom:15px">'.$orderid.'</td>
                                                      </tr>
                                                      
                                                       <tr>
                                                        <td style="padding-bottom:15px" align="left"> Order date is:  </td>
                                                         <td style="padding-bottom:15px" align="left">'.$rows['orderdate'].' </td>
                                                      </tr>
                                                       <tr>
                                                        <td style="padding-bottom:15px" align="left"> We will deliver to:  </td>
                                                         <td style="padding-bottom:15px" align="left"> '.$rowuser['billing_address'].' </td>
                                                      </tr>
                                                     <tr>
                                                        <td style="padding-bottom:15px" align="left"> Delivery Option:  </td>
                                                         <td style="padding-bottom:15px" align="left"> Store Standard delivery: '.$_SESSION['shippingname12'].'  </td>
                                                      </tr>            
                                                 </tbody>
                                                  </table></td>
                                                
                                              </tr>
                                              
                                        </tbody>
                                          </table></td>
                                      </tr>
                                      <tr><td>&nbsp; </td></tr>
									  
                                      <tr>
                                      <td>
                                       <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                                       <tbody>
                                       <tr><td colspan="2" style="background:#4aa4a5; padding:10px 0;font-size:15px; color:#fff; text-align:center">YOUR ORDER SUMMARY </td></tr>
                                     
                                           <tr><td colspan="2">&nbsp; </td></tr>';

$sqlcartsd=mysql_query("select * from `buyde_basket` where bid='".$rows['bid']."'") or die(mysql_error());		
$totalval=0;
$count=0;
$totalcost=0;
while($row=mysql_fetch_array($sqlcartsd))
{	

$pwieght=$pwieght + $row['totalweight'];
$totalweight=$totalweight + $row['totalweight'];
$totalcost=$totalcost + $row['subtotal'];
$shipcharge = $rows['shipcharge'];

if($row['color']!='') {
	$colorn = "<tr>
	<td> Colour :</td>
	<td>".$row['color']."</td>
	</tr>";
} else { 
$colorn="";
}

if($row['size']!='') {
	$sizern = "<tr>
	<td> Size :</td>
	<td>".$row['size']."</td>
	</tr>";
} else { 
$sizern="";
}

           
                                      $message .='<tr>
                                       <td>';
if($row['productimage'])
{
$message .='<img border="0" src="'.$URL.'/productimage/thumb/'.$row['productimage'].'" style="width:100px;">';
}
									   
                                       $message .='</td><td>
                                       <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                       <tbody>
                                       <tr><td colspan="2"><strong>'.$row['productname'].'</strong></td></tr>
                                        <tr><td colspan="2">&nbsp;</td></tr>
										
                                        '.$sizern.'
                                         
                                        '.$colorn.'
                                         <tr>
                                        <td> Quantity :</td>
                                        <td>'.$row['quantity'].'</td>
                                        </tr>
                                         <tr>
                                        <td> Total :</td>
                                        <td>&#163; '.$row['sellingprice'].'</td>
                                        </tr>
                                       </tbody>
                                       
                                       </table>
                                       
                                       </td>                                       
                                       </tr>  
                                          <tr><td colspan="2" >&nbsp; </td></tr> 
                                  <tr><td colspan="2" style="border-top:1px solid #4aa4a5">&nbsp; </td></tr>'; 
									   $count++; }
									if($vouchervalue!='')
									{
									$totalcost=$totalcost-$vouchervalue;
									}
									else
									{
									$totalcost=$totalcost;
}
                                       
                                       $message .='<tr>
                                       <td align="center"><strong>Total '.$count.' Products</strong>
                                       </td>
                                      
                                       <td>
                                       <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                       <tbody>
                                       <tr>
									   <td  style="width: 54%;"> &nbsp;</td>
									   <td><strong>&#163; '.$rows['totalcost'].'</strong></td></tr>
                                      
                                       </tbody>
                                       
                                       </table>
                                       
                                       </td>                                       
                                       </tr>
                                                                      
                                       </tbody>
                                      </table>
                                      </td>                                      
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              
                              
                              <tr>
                                <td width="100%" align="center" style="padding:10px 0px 0px 0px"><table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="">
                                    <tbody>
                                      <tr>
                                        <td align="center" bgcolor="#F3F3F3" style="font-family:Arial,sans-serif;font-size:13px;color:#5a535d;line-height:15px"><table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-left:2px solid #4aa4a5;border-right:2px solid #4aa4a5;border-bottom:2px solid #4aa4a5">
                                            <tbody>
                                              <tr>
                                                <td width="50%" style="border-top:2px solid #4aa4a5;border-right:2px solid #4aa4a5"><table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                      <tr>
                                                        <td width="114" height="60" bgcolor="#ffffff" valign="middle" align="center" style="padding:0px 0px 0px 0px;font-size:1px;line-height:0"><img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/pharmacy.jpg" width="91" height="36" border="0"></td>
                                                        <td bgcolor="#ffffff" valign="middle" align="left" style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;line-height:14px;padding-right:10px"><a style="color:#5a535d;text-decoration:none;font-size:12px;font-family:Arial,sans-serif" href="" target="_blank">We are a GPhC registered and regulated pharmacy</a></td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                                <td width="50%" style="border-top:2px solid #4aa4a5"><table width="100%" align="right" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                      <tr>
                                                        <td bgcolor="#ffffff" valign="middle" width="98" height="60" align="center" style="padding:0px 0px 0px 0px;font-size:1px;line-height:0"><img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/LogoSancoInternet_UK.jpg"  border="0"></td>
                                                        <td bgcolor="#ffffff" valign="middle" align="left" style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;line-height:14px;padding-right:10px"><a style="color:#5a535d;text-decoration:none;font-size:12px;font-family:Arial,sans-serif" href="" target="_blank">DIRECT PHARMACY LIMITED is registered to sell medicines.</a></td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td width="50%" style="border-top:2px solid #4aa4a5;border-right:2px solid #4aa4a5"><table width="100%" align="left" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                      <tr>
                                                        <td bgcolor="#ffffff" valign="middle" width="114" height="60" align="center" style="font-size:1px;line-height:0"><img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/reward-point.jpg"  border="0"></td>
                                                        <td bgcolor="#ffffff" valign="middle" align="left" style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;line-height:14px;padding-right:10px"><a style="color:#5a535d;text-decoration:none;font-size:12px;font-family:Arial,sans-serif" href="" target="_blank">Go Cardless Shopping with Reward Points</a></td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                                <td width="50%" style="border-top:2px solid #4aa4a5"><table width="100%" align="right" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                      <tr>
                                                        <td bgcolor="#ffffff" valign="middle" width="98" height="60" align="center" style="padding:0px 0px 0px 0px;font-size:1px;line-height:0"><img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/shipping-icon.jpg" border="0"></td>
                                                        <td bgcolor="#ffffff" valign="middle" align="left" style="font-family:Arial,sans-serif;font-size:12px;color:#5a535d;line-height:14px;padding-right:10px"><a style="color:#5a535d;text-decoration:none;font-size:12px;font-family:Arial,sans-serif" href="" target="_blank">Direct Pharmacy offers multiple shipping services</a></td>
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                              </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                              <tr>
                                <td align="center" style="padding:10px 0px 0px 0px"><table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="">
                                    <tbody>
                                      <tr>
                                        <td align="center" bgcolor="#4aa4a5" style="padding:10px 15px 10px 15px"><table width="100" align="right" border="0" cellspacing="0" cellpadding="0" style=";border:1px solid #4aa4a5">
                                            <tbody>
                                              <tr>
                                                <td bgcolor="#4aa4a5" width="100%" colspan="3" align="center" style="font-family:Arial,sans-serif;font-size:12px;color:#ffffff;line-height:17px"><p style="padding:0px;margin:0px"> <strong>Connect with us:</strong> </p></td>
                                              </tr>
                                              <tr>
                                                <td bgcolor="#4aa4a5" align="center"><table width="60" border="0" cellspacing="0" cellpadding="0" style="">
                                                    <tbody>
                                                      <tr>
                                                        <td bgcolor="#4aa4a5" align="left" style="font-size:1px;line-height:0"><a href="" target="_blank"> <img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/fb-icon.jpg" alt="Facebook" border="0"> </a></td>
                                                        <td bgcolor="#4aa4a5" align="center" style="font-size:1px;line-height:0"><a href="" target="_blank"> <img style="outline:none;text-decoration:none;border:none" src="http://direct-pharmacy.co.uk/confirmation_mail/images/twitter-icon.jpg" alt="Twitter" border="0"> </a></td>
                                                      </tr>
                                                      <tr>
                                                      <td colspan="2">&nbsp; </td>
                                                      </tr>
                                                      <tr>
                                                      <td colspan="2"><a href="" target="_blank" style=" background:#fff; color:#000; text-decoration:none; padding:5px 10px; border-radius:3px;">Unsubscribe</a></td>
                                                      
                                                      </tr>
                                                    </tbody>
                                                  </table></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                          <table width="445" align="left" border="0" cellspacing="0" cellpadding="0" style=";border:1px solid #4aa4a5">
                                            <tbody>
                                              <tr>
                                                <td bgcolor="#4aa4a5" align="left" style="font-family:Arial,sans-serif;font-size:12px;color:#ffffff;line-height:17px">
                                                <p style="padding:0px;margin:0px"><strong>Email :</strong> &nbsp;pharmacist@direct-pharmacy.co.uk <br>
                                                  
                                                    <strong>Registered Address :</strong> &nbsp; 99 Spring Road, Tyesely, Birmingham West Midlands, United Kingdom, B11 3DJ<br><br>
                                                    <a href="http://www.direct-pharmacy.co.uk/contact-direct-pharmacy.php" style="color:#ffffff;text-decoration:underline" target="_blank">Contact Us</a> // <a href="" style="color:#ffffff;text-decoration:underline" target="_blank">Privacy Policy</a> // <a href="http://www.direct-pharmacy.co.uk/terms_and_condistions" style="color:#ffffff;text-decoration:underline" target="_blank">Terms &amp; Conditions</a>  </p></td>
                                              </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                    </tbody>
                                  </table></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                    </tbody>
                  </table></td>
              </tr>
           
    </tbody>
  </table>
  <a> <img src="" alt="" border="0"> </a> <span class="HOEnZb"> <font color="#888888"> </font> </span> </div>
</body>
</html>';


/*$message='<html>



		<head>



		<title>System Generated</title>



		<style type="text/css">



			.txt {



				font-family: Arial, Helvetica, sans-serif;



				font-size: 12px;



				line-height: 17px;



				color: #333333;	



				padding-top: 5px;



				padding-right: 5px;



				padding-bottom: 5px;



				padding-left: 6px;



				font-weight: normal;



			}



			.txt a{color:#0033CC; text-decoration:none;}



			.txt a:hover{color:#333333;text-decoration:underline;}



		



		</style>



		</head>



		<body><style type="text/css">



<!--



.style1 {color: #000000}



-->



</style>



<style type="text/css">



<!--



.style1 {font-weight: bold}



-->



</style>


<div style="width:720px; margin:20px auto; border:1px solid #252525; ">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#fff;">
<tbody>
<tr>
<td colspan="2" valign="top">
<h1 style="margin:0; text-align:center"><span style="font-size:10.0pt;font-family:Arial, sans-serif;">YOUR ORDER CONFIRMATION</span></h1>
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" >
<tbody>
<tr><td width="167"  ><a href=""><img src="'.$URL.'/assets/images/logo.jpg" width="119" style="padding-top: 6px;"></a></td>
<td width="533" style="background:#252525">
<div >
<table border="0" cellspacing="0" cellpadding="0" width="533">
<tbody>
<tr>
<td width="58" ><p align="center"><a style="font-size:13px;font-family:Arial, sans-serif;color:white; text-decoration:none;" href="" target="_blank">Home</a> </p></td>
<td width="92" ><p align="center"  ><a  style="font-size:13px;font-family:Arial, sans-serif;color:white; text-decoration:none;"href="" target="_blank">Baby Store</a> </p></td>
<td width="77" ><p  align="center"><a style="font-size:13px;font-family:Arial, sans-serif;color:white; text-decoration:none;" href="" target="_blank">Fashion</a> </p></td>
<td width="306"></td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
<tr>
<td valign="top">
<table border="0" cellspacing="0" cellpadding="0" width="505" >
<tbody>
<tr>
<td colspan="2" style="padding-right:10px" ><p ><span style="font-size: 30px; font-weight: bold;">Order Information</span></p>';
$db->query("select * from ".$sufix."user_registration where emailid='".$rows['emailid']."'") or die(mysql_error());
$rowuser = $db->fetchAssoc();
$message .='<p><span style="font-size:13px">Hi <b>'.$rowuser['fname'].'</b> </span></p>
<p><span style="font-size:13px">Thank you for placing an order with Direct Pharmacy.</span></p>
<p><span style="font-size:13px"><strong>YOUR ORDER DETAILS ARE:</strong></span></p>
<p><span style="font-size:13px">Order number is: <b>29558743</b> </span></p>
<p><span style="font-size:13px">Order date is: <b>'.$rows['orderdate'].'</b> </span></p>
<p><span style="font-size:13px">We ll deliver to: <b>'.$rowuser['deliver_address'].', '.$rowuser['deliver_city'].', '.$rowuser['deliver_state'].', '.$rowuser['deliver_country'].', '.$rowuser['deliver_zip'].'</b> </span></p>

</td>
</tr>

<tr><td colspan="2" ><div><p style="background:#eee; height:1px; width:460px">&nbsp;</p></div></td></tr>
<tr><td colspan="2" ><p><span style="font-size:13px"><strong>YOUR ORDER SUMMARY:</strong></span></p></td></tr>';

$db->query("select * from `".$sufix."basket` where bid='".$rows['bid']."'") or die(mysql_error());		
$totalval=0;
$count=1;
$totalcost=0;
while($row=$db->fetchAssoc())
{	
$pwieght=$pwieght + $row['totalweight'];
$totalweight=$totalweight + $row['totalweight'];
$totalcost=$totalcost + $row['subtotal'];
$shipcharge = $rows['shipcharge'];

$message .='<tr><td width="182" valign="top" ><p >';
if($row['productimage'])
{
	$message .='<img border="0" src="'.$URL.'/productimage/thumb/'.$row['productimage'].'" width="100">';
} 

$message .='</p></td><td width="323" valign="top"><h3 style="margin-top:0"><span style="text-transform:uppercase">'.$row['productname'].'</span></h3>
<p ><span style="font-size:13px">Size: S <br>Colour: Grey <br>Quantity: '.$row['quantity'].' <br>Total: �'.$row['sellingprice'].' </span></p>
</td>
</tr>

<tr><td colspan="2" ><div><p style="background:#eee; height:1px; width:460px">&nbsp;</p></div></td></tr>';
$count++;
}
if($vouchervalue!='')
{
	$totalcost=$totalcost-$vouchervalue;
}
 else
{
	$totalcost=$totalcost;
}
$gtotal=($totalcost + $shipcharge);
$message .='<tr><td ><p ><span style="font-size:13px">Sub Total:</span></p></td>
<td ><p ><span style="font-size:13px">�'.$totalcost.' </span></p></td></tr>
<tr><td ><p ><span style="font-size:13px">Delivery Cost: </span></p></td>
<td><p ><span style="font-size:13px">�'.$shipcharge.' </span></p></td></tr>
<tr><td ><p ><b><span style="font-size:13px">Grand Total: </span></b></p></td>
<td><p ><b><span style="font-size:13px">�'.$gtotal.'</span></b></p></td>
</tr>

</tbody>
</table>
</td>
<td valign="top" >
<p >
<span style="margin-left:0px;margin-top:0px;width:200px;min-height:646px">
<img border="0" style="border: 1px solid #9f9f9f; height: 177px;width: 196px;"  src="'.$URL.'/mail_images/10_bt2.jpeg" >
</span>
<span style="margin-left:0px;margin-top:0px;width:200px;min-height:646px">
<img border="0" style="border: 1px solid #9f9f9f; height: 177px;width: 196px;" src="'.$URL.'/mail_images/0165_high-chair.jpg" >
 </span>
 <span style="margin-left:0px;margin-top:0px;width:200px;min-height:646px">
<img border="0" style="border: 1px solid #9f9f9f; height: 177px;width: 196px;" src="'.$URL.'/mail_images/10_bt2.jpeg" >
</span>


</p>
</td>
</tr>
<tr>
<td colspan="2"  >
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" ><tbody>
<tr><td width="700" ><p  style="border-bottom:1px solid #eee; height:1px"> </p></td></tr>

<tr>
<td colspan="2" style="background:#252525; color:#fff; padding:20px; " >
<p><span style="font-size:12px">We ll email you with details when your order has left our warehouse. Do not worry if you do not receive your despatch email straight away as during busy periods your parcel may not be packed and despatched on the same day your order is placed. This does not mean your delivery will be late.</span></p>
<p><span style="font-size:12px">If you have any queries, please <a href="" target="_blank" style="color:#fff;">contact customer services</a> and we ll be happy to help you. Please do not reply to this email.</span></p>
<p><b><span style="font-size:12px">Thank you for shopping at Direct Pharmacy. </span>
</b></p>
<p><a href="" target="_blank" style="color:#fff; font-size:13px"><span style="text-decoration:none">Delivery and Returns Information</span></a> </p>
</td>
</tr>

<tr><td width="700" ><p  style="border-bottom:1px solid #eee; height:1px"> </p></td></tr>

</tbody></table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" >
<tbody>
<tr>
<td width="175" >
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="175">
<tbody>
<tr>
<td width="23" ><p >&nbsp; </p></td>
<td width="114" ><p align="center" style="text-align:center"><b>
<span style="font-size:13px;font-family:Arial, sans-serif;color:#363636">
<a href="'.$URL.'" target="_blank" style="text-decoration:none"><span style="color:#363636;">SHOP ONLINE</span></a> </span></b></p></td>
<td width="15" ><p><a href="" target="_blank"><span style="text-decoration:none"><img border="0" width="15" height="41" src="'.$URL.'/mail_images/arrow.jpg" style=" margin-top:10px" ></span></a> </p></td>

</tr>
</tbody>
</table>
</div>
</td>
<td width="175" >
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="175">
<tbody>
<tr>
<td width="23" ><p >&nbsp; </p></td>
<td width="114" ><p align="center" style="text-align:center"><b>
<span style="font-size:13px;font-family:Arial, sans-serif;color:#363636">
<a href="" target="_blank" style="text-decoration:none"><span style="color:#363636;">STORE LOCATOR</span></a> </span></b></p></td>
<td width="15" ><p><a href="" target="_blank"><span style="text-decoration:none"><img border="0" width="15" height="41" src="'.$URL.'/mail_images/arrow.jpg"style=" margin-top:10px" ></span></a> </p></td>


</tr>
</tbody>
</table>
</div>
</td>
<td width="175" >
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="175">
<tbody>
<tr>
<td width="23" ><p >&nbsp; </p></td>
<td width="114" ><p align="center" style="text-align:center"><b>
<span style="font-size:13px;font-family:Arial, sans-serif;color:#363636">
<a href="'.$URL.'/mydashboard" target="_blank" style="text-decoration:none"><span style="color:#363636;">MY ACCOUNT</span></a> </span></b></p></td>
<td width="15" ><p><a href="" target="_blank"><span style="text-decoration:none"><img border="0" width="15" height="41" src="'.$URL.'/mail_images/arrow.jpg" style=" margin-top:10px"></span></a> </p></td>
</tr>
</tbody>
</table>
</div>
</td>
<td width="175" >
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="175">
<tbody>
<tr>
<td width="23" ><p >&nbsp; </p></td>
<td width="114" ><p align="center" style="text-align:center"><b>
<span style="font-size:13px;font-family:Arial, sans-serif;color:#363636">
<a href="'.$URL.'/contact-direct-pharmacy.php" target="_blank" style="text-decoration:none"><span style="color:#363636;">CONTACT US</span></a> </span></b></p></td>
<td width="15" ><p><a href="" target="_blank"><span style="text-decoration:none"><img border="0" width="15" height="41" src="'.$URL.'/mail_images/arrow.jpg" style=" margin-top:10px"></span></a> </p></td>


</tr>
</tbody>
</table>
</div>
</td>

</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" ><tbody><tr><td width="700" ><p  style="border-bottom:1px solid #eee; height:1px"> </p></td></tr></tbody></table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" >
<tbody>
<tr>
<td width="350">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="350" >
<tbody>
<tr>
<td width="20">&nbsp;

</td>
<td width="310" >
<p  align="center" style="text-align:center">
<b>
<span style="font-family:Arial, sans-serif;color:#363636">GET SOCIAL
</span>
</b>
</p>
</td>
<td width="20" >&nbsp;

</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="350" >
<tbody>
<tr><td width="40" ><p >&nbsp;  </p></td>
<td width="45" ><p ><a href="" target="_blank"><span style="text-decoration:none">
<img border="0" width="45" height="45" src="'.$URL.'/mail_images/fb-icon.jpg" alt="Facebook" ></span></a> </p></td>
<td width="45" ><p ><a href="" target="_blank"><span style="text-decoration:none">
<img border="0" width="45" height="45" src="'.$URL.'/mail_images/tw-icon.jpg" alt="Twitter" ></span></a> </p></td>
<td width="45" ><p ><a href="" target="_blank"><span style="text-decoration:none">
<img border="0" width="45" height="45" src="'.$URL.'/mail_images/gmail-iocn.jpg" alt="google+" ></span></a> </p></td>
<td width="45" ><p ><a href="" target="_blank"><span style="text-decoration:none">
<img border="0" width="45" height="45" src="'.$URL.'/mail_images/tube-icon.jpg" alt="YouTube" ></span></a> </p></td>
<td width="45" ><p ><a href="" target="_blank"><span style="text-decoration:none">
<img border="0" width="45" height="45" src="'.$URL.'/mail_images/p-icon.jpg" alt="Pinterest" ></span></a> </p></td>
<td width="45" ><p ><a href="" target="_blank"><span style="text-decoration:none">
<img border="0" width="45" height="45" src="'.$URL.'/mail_images/i-icon.jpg" alt="Instagram" ></span></a> </p></td>
<td width="40" ><p >&nbsp;  </p></td>
</tr>
</tbody>
</table>
</div>
</td>
<td width="350" ><p class="MsoNormal" align="center" style="text-align:center"> </p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" ><tbody><tr><td width="700" ><p  style="border-bottom:1px solid #eee; height:1px"> </p></td></tr></tbody></table>
</div>



<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="700" >
<tbody>
<tr>
<td width="700" style="background:#252525; color:#fff; padding:20px; ">
<p align="center" style="text-align:center">
<span style="font-size:8.5pt;font-family:Arial, sans-serif;">Registered address: 99 Spring Road, Tyesely, Birmingham West Midlands, United Kingdom, B11 3DJ Registered in England No: 1123688<br>Customer Services Email: <a href="" target="_blank" style="color:#fff;" mailto:pharmacist@direct-pharmacy.co.uk><span style="text-decoration:none">pharmacist@direct-pharmacy.co.uk</span></a>
</span>
<span>
<span style="font-size:8.5pt;font-family:Arial, sans-serif;color:#888888"> </span>
</span>
<span style="font-size:8.5pt;font-family:Arial, sans-serif;color:#363636"> </span>
</p>
</td>
</tr>
</tbody>
</table>
</div>
<p  align="center" style="text-align:center"> </p>
</td>
</tr>
</tbody>
</table>
</div>


</body></html>';*/







