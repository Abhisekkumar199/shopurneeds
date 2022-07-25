<?php







//$fromc=$CompanyEmail;







//$toc=$_SESSION['emailid'];








mysqli_query($conn,"select * from `".$sufix."order` where oid='".$orderid."'") ;
$rows = mysqli_fetch_assoc();
$ordercost=$rows['totalcost'];
$subjectc="Order Confirmation Mail for order no:- ".$orderid;
$fromc = "https://localhost/project/shopurneeds<info@shopurneeds.in>";
 $toc = "Ramona Recipient <".$_SESSION['emailid'].">";
 $subjectc = " https://localhost/project/shopurneeds Order# ".$orderid." Confirmed";
$message='







<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">







<head><meta name="charset" content="utf-8"><meta name="format-detection" content="telephone=no"><meta name="format-detection" content="address=no"><meta name="format-detection" content="date=no"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><meta http-equiv="Content-type" content="text/html; charset=utf-8">







	<style type="text/css">/* Linked Styles */







		body { padding:0 !important; margin:0 !important; display:block !important; background:#d6d6d6; -webkit-text-size-adjust:none }







		a { color:#b92182; text-decoration:none }







		p { padding:0 !important; margin:0 !important } 















		/* Mobile styles */







		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) { 







			div[class="mobile-br-5"] { height: 5px !important; }







			div[class="mobile-br-10"] { height: 10px !important; }







			div[class="mobile-br-15"] { height: 15px !important; }







			div[class="mobile-br-20"] { height: 20px !important; }







			div[class="mobile-br-25"] { height: 25px !important; }







			div[class="mobile-br-30"] { height: 30px !important; }















			th[class="m-td"], 







			td[class="m-td"], 







			div[class="hide-for-mobile"], 







			span[class="hide-for-mobile"] { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }















			span[class="mobile-block"] { display: block !important; }















			div[class="wgmail"] img { min-width: 320px !important; width: 320px !important; }















			div[class="img-m-center"] { text-align: center !important; }















			div[class="fluid-img"] img,







			td[class="fluid-img"] img { width: 100% !important; max-width: 100% !important; height: auto !important; }















			table[class="mobile-shell"] { width: 100% !important; min-width: 100% !important; }







			td[class="td"] { width: 100% !important; min-width: 100% !important; }







			







			table[class="center"] { margin: 0 auto; }







			







			td[class="column-top"],







			th[class="column-top"],







			td[class="column"],







			th[class="column"] { float: left !important; width: 100% !important; display: block !important; }















			td[class="content-spacing"] { width: 15px !important; }















			div[class="h2"] { font-size: 44px !important; line-height: 48px !important; }







		}







	</style>







	<!--[if gte mso 9]><xml>







	<o:OfficeDocumentSettings>







	<o:AllowPNG/>







	<o:PixelsPerInch>96</o:PixelsPerInch>







	</o:OfficeDocumentSettings>







	</xml><![endif]-->







	<title>Email Template</title>







</head>







<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#d6d6d6; -webkit-text-size-adjust:none">







<table bgcolor="#d6d6d6" border="0" cellpadding="0" cellspacing="0" width="100%">







	<tbody>







		<tr>







			<td align="center" valign="top"><!-- Top -->







			<table bgcolor="#d6d6d6" border="0" cellpadding="0" cellspacing="0" width="100%">







				<tbody>







					<tr>







						<td align="center" valign="top">







						<table border="0" cellpadding="0" cellspacing="0" class="mobile-shell" width="600">







							<tbody>







								<tr>







									<td class="td" style="font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;width:600px;min-width:600px;" width="600">







									<table border="0" cellpadding="0" cellspacing="0" width="100%">







										<tbody>







											<tr>







												<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







												<td>







												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td>







															<div class="text-header" style="color:#d6d6d6;font-family:Arial, sans-serif;min-width:auto !important;font-size:12px;line-height:16px;text-align:left;"> </div>







															</td>







															<td>







															<div class="text-header-1" style="color:#d6d6d6;font-family:Arial, sans-serif;min-width:auto !important;font-size:12px;line-height:16px;text-align:right;"> </div>







															</td>







														</tr>







													</tbody>







												</table>







												</td>







												<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







											</tr>







										</tbody>







									</table>







									</td>







								</tr>







							</tbody>







						</table>







						</td>







					</tr>







				</tbody>







			</table>







			<!-- END Top -->















			<table border="0" cellpadding="0" cellspacing="0" class="mobile-shell" width="600">







				<tbody>







					<tr>







						<td class="td" style="font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;width:600px;min-width:600px;" width="600"><!-- Header -->







						<table border="0" cellpadding="0" cellspacing="0" width="100%">







							<tbody>







								<tr>







									<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







									<td>







									<div class="img-center" style="font-size:0pt;line-height:0pt;text-align:center;"><a href="https://localhost/project/shopurneeds" target="_blank"><img alt="" border="0" height="50" src="https://localhost/project/shopurneeds/images/logonew.png" width="210" /></a></div>















									<div class="hide-for-mobile">







									<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







										<tbody>







											<tr>







												<td class="spacer" height="20" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







											</tr>







										</tbody>







									</table>







									</div>







									</td>







									<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







								</tr>







							</tbody>







						</table>







						<!-- END Header --><!-- Main -->















						<table border="0" cellpadding="0" cellspacing="0" width="100%">







							<tbody>







								<tr>







									<td><!-- Head -->







									<table bgcolor="#b92182" border="0" cellpadding="0" cellspacing="0" width="100%">







										<tbody>







											<tr>







												<td>







												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="27"><img alt="" border="0" height="34" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/l1.jpg" width="34" /></td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" width="100%">







																<tbody>







																	<tr>







																		<td bgcolor="#b92182" class="img" height="3" style="font-size:0pt;line-height:0pt;text-align:left;"> </td>







																	</tr>







																</tbody>







															</table>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="24" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="27"><img alt="" border="0" height="34" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/r1.jpg" width="34" /></td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td bgcolor="#b92182" class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="3"> </td>







															<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="10"> </td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="h2" style="color:#ffffff;font-family:Georgia, serif;min-width:auto !important;font-size:60px;line-height:64px;text-align:center;"><em>Thank you</em></div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="h3-2-center" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:20px;line-height:26px;text-align:center;letter-spacing:5px;">FOR YOUR ORDER!</div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="35" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="10"> </td>







															<td bgcolor="#b92182" class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="3"> </td>







														</tr>







													</tbody>







												</table>







												</td>







											</tr>







										</tbody>







									</table>







									<!-- END Head --><!-- Body -->















									<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">







										<tbody>







											<tr>







												<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







												<td>







												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="35" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>















												<div class="h3-1-center" style="color:#1e1e1e;font-family:Arial, serif;min-width:auto !important;font-size:16px;line-height:26px;text-align:center;">







												<table cellpadding="0" role="presentation">







													<tbody>







														<tr>







															<td>







															<table id="m_-6527949812705684337container">







																<tbody>







																	<tr>







																		<td>







																		<table id="m_-6527949812705684337main">







																			<tbody>







																				<tr>







																					<td>







																					<table id="m_-6527949812705684337summary">







																						<tbody>







																							<tr>







																								<td>







																								<h3 style="text-align:left;color:#1e1e1e;font-family:Arial, serif;min-width:auto !important;font-size:16px;line-height:26px;">Hello '.$rowuser['fname'].'&nbsp;'.$rowuser['lname'].',</h3>















																								<p style="text-align:left;color:#1e1e1e;font-family:Arial, serif;min-width:auto !important;font-size:16px;line-height:26px;">Thank you for shopping with us. We&#39;d like to let you know that your order has been confirmed by the Seller, who will prepare it for shipment. </p>







																								</td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																	</tr>







																</tbody>







															</table>







															</td>







														</tr>







													</tbody>







												</table>







												<br />







												Feel free to review your order below or click the button to view your account.</div>















												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="20" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>







												<!-- Button -->















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td align="center">







															<table border="0" cellpadding="0" cellspacing="0" width="210">







																<tbody>







																	<tr>







																		<td align="center" bgcolor="#b92182">







																		<table border="0" cellpadding="0" cellspacing="0">







																			<tbody>







																				<tr>







																					<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="15">







																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="50" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																					<td bgcolor="#b92182">







																					<div class="text-btn" style="color:#ffffff;font-family:Arial, sans-serif;min-width:auto !important;font-size:16px;line-height:20px;text-align:center;"><a class="link-white" href="'.$URL.'/customer_email_login.php?emailid='.$_SESSION['emailid'].'" style="color:#ffffff;text-decoration:none;" target="_blank"><span class="link-white" style="color:#ffffff;text-decoration:none;">MY ACCOUNT</span></a></div>







																					</td>







																					<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="15"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																	</tr>







																</tbody>







															</table>







															</td>







														</tr>







													</tbody>







												</table>







												<!-- END Button -->















												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="40" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<th class="column-top" style="font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;vertical-align:top;" valign="top" width="270">







															<table border="0" cellpadding="0" cellspacing="0" width="100%">







																<tbody>







																	<tr>







																		<td>







																		<table bgcolor="#f4f4f4" border="0" cellpadding="0" cellspacing="0" width="100%">







																			<tbody>







																				<tr>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																					<td>







																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>















																					<div class="text-1" style="color:#b92182;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><strong>SHIPPING ADDRESS:</strong></div>















																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<table bgcolor="#fafafa" border="0" cellpadding="0" cellspacing="0" width="100%">







																			<tbody>







																				<tr>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																					<td>







																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>















																					<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><b>'.$rowuser['dfname'].'&nbsp;'.$rowuser['dlname'].'</b><br />







																					'.$rowuser['deliver_address'].'&nbsp;'.$rowuser['deliver_number'].' | '.$rowuser['deliver_state'].'<br />







																					 '.$rowuser['deliver_country'].'<br />







																					'.$rowuser['deliver_phone'].'</div>















																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																	</tr>







																</tbody>







															</table>







															</th>







															<th class="column-top" style="font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;vertical-align:top;" valign="top" width="20">







															<table border="0" cellpadding="0" cellspacing="0" width="100%">







																<tbody>







																	<tr>







																		<td>







																		<div class="mobile-br-15" style="font-size:0pt;line-height:0pt;"> </div>







																		</td>







																	</tr>







																</tbody>







															</table>







															</th>







															<th class="column-top" style="font-size:0pt;line-height:0pt;padding:0;margin:0;font-weight:normal;vertical-align:top;" valign="top" width="270">







															<table border="0" cellpadding="0" cellspacing="0" width="100%">







																<tbody>







																	<tr>







																		<td>







																		<table bgcolor="#f4f4f4" border="0" cellpadding="0" cellspacing="0" width="100%">







																			<tbody>







																				<tr>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																					<td>







																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>















																					<div class="text-1" style="color:#b92182;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><strong>ORDER NUMBER:</strong><span style="color:#1e1e1e;">'.$rows['oid'].'</span></div>















																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="20" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<table bgcolor="#f4f4f4" border="0" cellpadding="0" cellspacing="0" width="100%">







																			<tbody>







																				<tr>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																					<td>







																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>















																					<div class="text-1" style="color:#b92182;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><strong>PAYMENT METHOD:</strong></div>







																					<span style="color:#1e1e1e;">A80SD99</span>































																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<table bgcolor="#fafafa" border="0" cellpadding="0" cellspacing="0" width="100%">







																			<tbody>







																				<tr>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																					<td>







																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>















																					<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><span style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:20px;line-height:20px;"><strong>Prepaid</strong></span></div>















																					<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																						<tbody>







																							<tr>







																								<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																							</tr>







																						</tbody>







																					</table>







																					</td>







																					<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																	</tr>







																</tbody>







															</table>







															</th>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="40" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td class="content-spacing" style="border-bottom:1px solid #f4f4f4;" width="20"> </td>







															<td style="border-bottom:1px solid #f4f4f4;" width="225">







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><strong>Item</strong></div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td class="content-spacing" style="border-bottom:1px solid #f4f4f4;" width="20"> </td>







															<td style="border-bottom:1px solid #f4f4f4;">







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><strong>Qty</strong></div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td class="content-spacing" style="border-bottom:1px solid #f4f4f4;" width="20"> </td>







															<td style="border-bottom:1px solid #f4f4f4;" width="60">







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="text-center" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:center;"><strong>Total</strong></div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td class="content-spacing" style="border-bottom:1px solid #f4f4f4;" width="20"> </td>







														</tr>';







														







mysqli_query($conn,"select * from `".$sufix."basket` where bid='".$rows['bid']."'") ;		
$totalval=0;
$count=1;
$totalcost=0;
$tax1 = 0;
$discount_price1 = 0;
$sellprice1 = 0;
$coupan_discount1= 0;
$totaldiscount = 0;
while($row=mysqli_fetch_assoc())
{	
$masterrows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ".$sufix."master_product where id='".$row['productid']."' limit 1"));
$pwieght=$pwieght + $row['totalweight'];
$totalweight=$totalweight + $row['totalweight'];
$totalcost=$totalcost + $row['subtotal'];
$quantity = $row['quantity'];
$sellprice = $row['sellprice']*$row['quantity'];
$discount_price = $row['discount_price']*$row['quantity'];
$coupan_discount = $row['coupan_discount']*$row['quantity'];
$tax = $row['tax']*$row['quantity'];
$tax1 = $tax1+$tax;
$sellprice1 = $sellprice1+$sellprice;
$discount_price1 = $discount_price1+$discount_price;
$coupan_discount1 = $coupan_discount1+$coupan_discount;
if($row['size']!='') { $sizerb = "Size : ".$row['size']; } 
 if($row['coupon_code']!='') {  $couponcode = "(".$row['coupon_code'].")";}



															$message .='<tr><td> </td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">'.$row['productname'].'<br>














															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td> </td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">'.$row['quantity'].'</div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td> </td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="text-center" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:center;">&#x20b9;'.$row['subtotal'].'</div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="8" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td> </td>







														</tr>';







															$count++;







															}







											$totaldiscount = ($discount_price1+$coupan_discount1);







											$subtotalnew = ($sellprice1-$totaldiscount);







											if($vouchervalue!='')







											{







											$totalcost=$totalcost-$vouchervalue;







											}







											else







											{







											$totalcost=$totalcost;







											}







															$message .='







														







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="10" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td bgcolor="#b92182" class="img" height="1" style="font-size:0pt;line-height:0pt;text-align:left;"> </td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td align="right">







															<table border="0" cellpadding="0" cellspacing="0">







																<tbody>







																	<tr>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text-right" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:right;">Cart total:</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																		<td width="50">







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		 















																		<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">&#x20b9;'.$sellprice1.'</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																	</tr>







																	<tr>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text-right" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:right;">Discount'.$couponcode.':</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																		<td width="50">







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">&#x20b9;'.$totaldiscount.'</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																	</tr>







																	<tr>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text-right" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:right;">Subtotal:</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																		<td width="50">







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">&#x20b9;'.$subtotalnew.'</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																	</tr>







																	<tr>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text-right" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:right;">Shipping Charges:</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">















																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">&#x20b9;'.$shipprice.'</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td> </td>







																	</tr>







																	<tr>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text-right" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:right;">Tax:</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																		<td width="50">







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;">&#x20b9;'.$tax1.'</div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







																	</tr>







																	<tr>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>';







$gtotal=($totalcost + $shipprice+$tax1);







																		$message .='<div class="text-right" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:right;"><strong>TOTAL:</strong></div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td> </td>







																		<td>







																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>















																		<div class="text" style="color:#1e1e1e;font-family:Arial, sans-serif;min-width:auto !important;font-size:14px;line-height:20px;text-align:left;"><strong>&#x20b9;'.$gtotal.'</strong></div>















																		<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																			<tbody>







																				<tr>







																					<td class="spacer" height="3" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																		<td> </td>







																	</tr>







																</tbody>







															</table>







															</td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







													<tbody>







														<tr>







															<td class="spacer" height="35" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







														</tr>







													</tbody>







												</table>







												</td>







												<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







											</tr>







										</tbody>







									</table>







									<!-- END Body --><!-- Foot -->















									<table bgcolor="#b92182" border="0" cellpadding="0" cellspacing="0" width="100%">







										<tbody>







											<tr>







												<td>







												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td bgcolor="#b92182" class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="3"> </td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="30" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<div class="h3-1-center" style="color:#1e1e1e;font-family:Georgia, serif;min-width:auto !important;font-size:20px;line-height:26px;text-align:center;"><em>Follow Us</em></div>















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															<!-- Socials -->THIS IS AN AUTO-GENERATED INVOICE AND DOES NOT NEED SIGNATURE.















															<table border="0" cellpadding="0" cellspacing="0" width="100%">







																<tbody>







																	<tr>







																		<td align="center">







																		<table border="0" cellpadding="0" cellspacing="0">







																			<tbody>







																				<tr>







																					<td class="img-center" style="font-size:0pt;line-height:0pt;text-align:center;" width="38"><a href="https://www.facebook.com/https://localhost/project/shopurneeds/" target="_blank"><img alt="" border="0" height="28" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/fbs.jpg" width="28" /></a></td>







																					<td class="img-center" style="font-size:0pt;line-height:0pt;text-align:center;" width="38"><a href="https://twitter.com/https://localhost/project/shopurneeds" target="_blank"><img alt="" border="0" height="28" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/twitters.jpg" width="28" /></a></td>







																					<td class="img-center" style="font-size:0pt;line-height:0pt;text-align:center;" width="38"><a href="https://www.instagram.com/https://localhost/project/shopurneeds/" target="_blank"><img alt="" border="0" height="28" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/insta.jpg" width="28" /></a></td>







																					<td class="img-center" style="font-size:0pt;line-height:0pt;text-align:center;" width="38"><a href="https://www.pinterest.com/https://localhost/project/shopurneeds/" target="_blank"><img alt="" border="0" height="28" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/prints.JPG" width="28" /></a></td>







																				</tr>







																			</tbody>







																		</table>







																		</td>







																	</tr>







																</tbody>







															</table>







															<!-- END Socials -->















															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="15" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td bgcolor="#b92182" class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="3"> </td>







														</tr>







													</tbody>







												</table>















												<table border="0" cellpadding="0" cellspacing="0" width="100%">







													<tbody>







														<tr>







															<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="27"><img alt="" border="0" height="34" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/l2.jpg" width="34" /></td>







															<td>







															<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







																<tbody>







																	<tr>







																		<td class="spacer" height="24" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







																	</tr>







																</tbody>







															</table>















															<table border="0" cellpadding="0" cellspacing="0" width="100%">







																<tbody>







																	<tr>







																		<td bgcolor="#b92182" class="img" height="3" style="font-size:0pt;line-height:0pt;text-align:left;"> </td>







																	</tr>







																</tbody>







															</table>







															</td>







															<td class="img" style="font-size:0pt;line-height:0pt;text-align:left;" width="27"><img alt="" border="0" height="34" src="https://app4.easysendy.com/frontend/assets/files/customer/la573m9f354de/r2.jpg" width="34" /></td>







														</tr>







													</tbody>







												</table>







												</td>







											</tr>







										</tbody>







									</table>







									<!-- END Foot --></td>







								</tr>







							</tbody>







						</table>







						<!-- END Main --><!-- Footer -->















						<table border="0" cellpadding="0" cellspacing="0" width="100%">







							<tbody>







								<tr>







									<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







									<td>







									<div class="text-footer" style="color:#666666;font-family:Arial, sans-serif;min-width:auto !important;font-size:12px;line-height:18px;text-align:center;"><br />







									G-24, Sector-6, Noida, Uttar Pradesh, India<br />







									<a href="https://localhost/project/shopurneeds" target="_blank">www.https://localhost/project/shopurneeds</a> | <a href="mailto:mp@https://localhost/project/shopurneeds" target="_blank">mp@https://localhost/project/shopurneeds</a> | Phone: +91 8130352808







									<hr /><strong><span style="color:#000000;"><span style="font-size:10px;"><span style="background-color:#FFFFFF;">THIS IS AN AUTO-GENERATED ORDER BOOKING DETAILS AND IT MAY VARY FROM THE ACTUAL INVOICE</span></span><span style="background-color:#FFFFFF;"></span></span></strong>















									<hr />  </div>















									<table border="0" cellpadding="0" cellspacing="0" class="spacer" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;" width="100%">







										<tbody>







											<tr>







												<td class="spacer" height="30" style="font-size:0pt;line-height:0pt;text-align:center;width:100%;min-width:100%;"> </td>







											</tr>







										</tbody>







									</table>







									</td>







									<td class="content-spacing" style="font-size:0pt;line-height:0pt;text-align:left;" width="20"> </td>







								</tr>







							</tbody>







						</table>







						<!-- END Footer --></td>







					</tr>







				</tbody>







			</table>















			<div class="wgmail" style="font-size:0pt;line-height:0pt;text-align:center;"><img alt="" border="0" height="1" src="https://d1pgqke3goo8l6.cloudfront.net/oD2XPM6QQiajFKLdePkw_gmail_fix.gif" style="min-width:600px;" width="600" /></div>







			</td>







		</tr>







	</tbody>







</table>







</body>







</html>';




  ?>