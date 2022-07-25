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
<section class="main-container"> 
<!-- BEGIN Main Container Inner-->
          <article class="main-container-inner">              
              
               
                            <div class="cart">
    <div class="page-title">
<h2>Account</h2>
</div>
    
        <fieldset>
          		<table width="100%">
				<tr>
				<td width="30%" align="left" valign="top"><?php include("includes/left_account.php"); ?>				</td>
				<td width="70%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          
		  
		  <tr>
            <td align="left" valign="top" class="border_left border_right border_top border_bottom">
			
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
 
    <tr>
      <td align="left" bgcolor="#CCCCCC" class="head_shadow heading pad_1 pad-cart">My Vouchers</td>
    </tr>
     <tr>
  			<td height="20"></td>
  		</tr>
    <tr>
      <td class="pad_1" >
	  		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="body-txt">
			  <tr>
				<td align="center" style="border-bottom:#999999 dotted 1px;">
					<table width="98%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="2">
								
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td class="rightareaheading" bgcolor="#e3e3e3" colspan="12" align="left" valign="middle" height="30" style="border-left:#999999 solid 1px; border-right:#999999 solid 1px; border-top:#999999 solid 1px;"><strong><font color="#303030" style="padding-left:5px;">Whishlist Item</font></strong></td>
												</tr>
												<tr>
													<td colspan="12" valign="top"  align="center" >
													<form name="wsh" method="post" action="#">
													<table width="100%" cellpadding="1" cellspacing="0" border="0" class="table-border">	
													  <tr bgcolor="#ffffff">
																						  
														<td width="20%" align="left" class="pad_1 border_left border_right border_top border_bottom"><strong>Voucher Code</strong></td>
														<td width="44%" align="left" class="pad_1 border_right border_top border_bottom"><strong>Voucher Value</strong></td>
														<td width="9%" align="right" class="pad_1 border_right border_top border_bottom"><strong>Validity</strong></td>
														<td width="13%" align="right" class="pad_1 border_right border_top border_bottom"><strong>Status</strong></td>
														<!--   <td width="14%" align="right" class="pad_1 border_right border_top border_bottom"><strong>Total Price</strong></td>-->
													  </tr>
													  <?php	
															$sql2=mysqli_query($conn,"select * from `".$sufix."discountcodes` where displayflag='1' and validto > '".date("Y-m-d")."'") or die(mysql_error());		
															
															
															$totalcost=0;
															while($row=mysqli_fetch_array($sql2))
															{	
															
																	
													?>
												<tr>
													
													 <td align="center" valign="top" bgcolor="#FFFFFF" class="txt border_left border_right  border_bottom" width="20%">
													<?php echo $row['disc_code'];	?></td>
													<td align="left" valign="top" bgcolor="#FFFFFF" class="txt pad_1 border_right  border_bottom" width="44%" ><?php echo Currency. " ".$row['discountvalue']; ?>
												 	 </td>							  
													<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="9%"><?php echo change2dmy($row['validto']); ?></td>
													<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="13%">
													
													
													<?php if($row['validto']< date("Y-m-d"))
													{
													echo "Expired";
													}
													else
													{
														echo "Valid"; //
													
													}
													
													 ?></td>
													
													  </tr>
														<?php
														  	} //
														
														?>
														
														
														</table>
														</form>
													</td>
												</tr>
										</table>
									</td>
								</tr>
					</table>
				</td>
			  </tr>
			</table>  
	  
	  </td>
    </tr>
   </table>
			
		
		
		
		
		</td>
      </tr>
</table></td>
				</tr>
				</table>    
			 
        </fieldset>
		


   <!-- BEGIN CART COLLATERALS -->

  

<div id="mgkquickview">
<div id="magikloading" style="display:none;text-align:center;margin-top:400px;"><img src="images/mgkloading.gif" alt="loading">
</div></div>
<script type="text/javascript">
function callQuickView(qurl) { 
    jQuery('#mgkquickview').show();
    jQuery('#magikloading').show();
    jQuery.get(qurl, function(data) {
      jQuery.fancybox(data);
      jQuery('#magikloading').hide();
jQuery('#mgkquickview').hide();
    });
 }
 
</script></div>  <!--cart-->
          </article> <!--main-container-inner-->
      </section>