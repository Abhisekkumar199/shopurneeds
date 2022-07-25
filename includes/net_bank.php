<div id="netbank2"  style="display:none;">
<table width="96%" border="0" align="right" cellpadding="2" cellspacing="2" style="font-size:12px;">
	   		  				 <tr>
							 <td valign="top">
						
							 <div style="font-weight:bold; font-size:14px; border-bottom:#666666 1px solid;"><strong>Pay using Net Banking.</strong></div> 

							 <div style="padding-top:10px;">
							<strong> Note:</strong> Once you click on the "Pay Now" button you would be redirected to the CitrusPay gateway. After the payment process is complete, you will be redirected back to <?php echo TSite; ?> to view details of your order.</div>
									<!--<img src="<?php //echo URL; ?>/images/paypalbutton.gif" alt="" border="0" title="Paypal" align="right" />
									-->
									
									
									<br />
									<br />	
	
				<form action="<?php echo URL; ?>/payment/citruspay.php?flg=submit" method="POST" name="netbank" id="netbank" target="_blank">
				<input name="paymentMode" type="hidden" value="NET_BANKING" />
			<table width="100%" border="0" cellpadding="3" cellspacing="3">
  <!--<tr>
    <td><label width="125px;">Payment Mode:</label></td>
    <td width="1%"></td>
    <td><select class="text" name="paymentMode">
				
				<option value="NET_BANKING">NetBanking</option>
				<option value="CREDIT_CARD">Credit Card</option>
				<option value="DEBIT_CARD">Debit Card</option>
			</select></td>
  </tr>-->
   <tr>
    <td><label width="125px;">Bank Name:</label></td>
    <td width="1%"></td>
    <td> <select class="text" name="issuerCode">
			<option value="">Select Bank</option>
			<option value="CID001">ICICI Bank</option>
			<option value="CID002">AXIS Bank</option>
			<option value="CID003">CITI Bank</option>
			<option value="CID004">YES Bank</option>
			<option value="CID005">SBI Bank</option>
			<option value="CID006">DEUTSCHE Bank</option>
			<option value="CID007">UNION Bank</option>
			<option value="CID008">Indian Bank</option>
			<option value="CID009">Federal Bank</option>
			<option value="CID010">HDFC Bank</option>
			<option value="CID011">IDBI Bank</option>
		</select></td>
  </tr>
 <!-- <tr>
    <td><label width="125px;">Card Holder Name:</label></td>
    <td width="1%"></td>
    <td> <input class="text" name="cardHolderName"
				type="text" value="" /></td>
  </tr>
   <tr>
    <td><label width="125px;">Card Number:</label></td>
    <td width="1%"></td>
    <td> <input class="text" name="cardNumber" type="text"
				value="" /></td>
  </tr>
   <tr>
    <td><label width="125px;">Expiry Month:</label></td>
    <td width="1%"></td>
    <td> <input class="text" name="expiryMonth" type="text"
				value="" /></td>
  </tr>
   <tr>
    <td><label width="125px;">Card Type:</label></td>
    <td width="1%"></td>
    <td> <input class="text" name="cardType" type="text" value="" /></td>
  </tr>
  <tr>
    <td><label width="125px;">CVV Number:</label></td>
    <td width="1%"></td>
    <td><input class="text" name="cvvNumber" type="text"
				value="" /></td>
  </tr>
  <tr>
    <td><label width="125px;">Expiry Year:</label></td>
    <td width="1%"></td>
    <td> <input class="text" name="expiryYear" type="text"
				value="" /></td>
  </tr>-->
   <tr>
   <td width="30" colspan="2"></td>
    <td valign="top" class="buy_button" align="right"> <input class="hidden" name="orderAmount" type="hidden" value="<?php echo $roworder['totalcost']; ?>" />
	<!--<input class="hidden" name="merchantAccessKey" type="hidden"
				value="EZ1Z48G8YU40YKP6BCWL" />-->
	
	<input class="hidden" name="returnUrl" type="hidden"
				value="<?php echo URL.'/checkout/confirm'; ?>" />
			<input class="hidden" name="merchantTxnId"
				type="hidden" value="<?php echo $_SESSION['oid']; ?>" />
		
			<input class="hidden" name="addressState" type="hidden"
				value="<?php echo $rowuser['billing_state']; ?>" />
		
			<input class="hidden" name="addressCity" type="hidden"
				value="<?php echo $rowuser['billing_city']; ?>" />
		
			<input class="hidden" name="addressStreet1"
				type="hidden" value="<?php echo $rowuser['billing_address']; ?>" />
		
			<input class="hidden" name="addressCountry"
				type="hidden" value="<?php echo $rowuser['billing_country']; ?>" />
		
			<input class="hidden" name="addressZip" type="hidden"
				value="<?php echo $rowuser['billing_zip']; ?>" />
		
			<input class="hidden" name="firstName" type="hidden"
				value="<?php echo $rowuser['fname']; ?>" />
		
			<input class="hidden" name="lastName" type="hidden" value="<?php echo $rowuser['lname']; ?>" />
		
			<input class="hidden" name="phoneNumber" type="hidden"
				value="<?php echo $rowuser['billing_phone']; ?>" />
		
			<input class="hidden" name="email" type="hidden" value="<?php echo $_SESSION['emailid']; ?>" />
			
						
				<span style="font-weight:bold;"><a href="#" style="text-decoration:none; color:#ffffff;" onclick="document.getElementById('netbank').submit();">Pay Now&nbsp;&nbsp;&nbsp;</a></span><img src="<?php echo URL; ?>/images/arrow-img.png" width="16" height="13" align="absmiddle" />		
						
						<!--<input type="submit" name="submit"  class="btn-orange" value="Pay Now" /> <input
							type="reset" name="reset" class="btn" value="Cancel" />	-->
				
				</td>
  </tr>
  
</table>

		<!-- COD section END -->
		
			
		
		
				
				</form>
				
									</td>
									</tr>
								</table>
							</div>