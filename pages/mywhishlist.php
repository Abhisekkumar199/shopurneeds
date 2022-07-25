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
		<div style="text-align:left; padding-top:15px;"><h2>My Wishlist</h2></div>
	
<fieldset>

          	<table width="100%">

				<tr>

				<td width="30%" align="left" valign="top"><?php include("includes/left_account.php"); ?>				</td>
<td width="5%" align="left" valign="top">&nbsp;</td>

				<td width="70%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">

          

		  

		  <tr>

            <td align="left" valign="top" class="border_left border_right border_top border_bottom">

			

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

 

    <tr>

      <td height="25" align="left" bgcolor="#CCCCCC" class="head_shadow heading pad_1 pad-cart" style="padding-left:5px;">My Whishlist</td>

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

													<td colspan="12" valign="top"  align="center">

													<form name="wsh" method="post" action="#">

													<table width="100%" cellpadding="1" cellspacing="0" border="0" class="table-border">	

													  <tr bgcolor="#ffffff">

														<td width="3%" align="left" class="pad_1 border_left border_right border_top border_bottom"><input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)"></td>									  

														<td width="20%" align="left" class="pad_1 border_left border_right border_top border_bottom"><strong>Product Image</strong></td>

														<td width="44%" align="left" class="pad_1 border_right border_top border_bottom"><strong>Product Name</strong></td>

														<td width="9%" align="right" class="pad_1 border_right border_top border_bottom"><strong>Qty</strong></td>

														<td width="13%" align="right" class="pad_1 border_right border_top border_bottom"><strong>Unit price</strong></td>

														<td width="14%" align="right" class="pad_1 border_right border_top border_bottom"><strong>Total Price</strong></td>

													  </tr>

													  <?php	

															$sql2=mysqli_query($conn,"select * from `".$sufix."whishlist` where emailid='".$_SESSION['emailid']."'") or die(mysql_error());	

															$numw=mysqli_num_rows($sql2);	

															if($numw > 0)

															{

															

															$totalcost=0;

															while($row=mysqli_fetch_array($sql2))

															{	

															

																	$pwieght=$pwieght + $row['totalweight'];

																    $totalweight=$totalweight + $row['totalweight'];

																    $totalcost=$totalcost + $row['subtotal'];

													?>

												<tr>

													<td align="left" valign="top" bgcolor="#FFFFFF" class="txt border_left border_right  border_bottom"><input name="ids[]" type="checkbox" id="ids[]" value="<?php echo $row['wid']; ?>"></td>

													 <td align="center" valign="top" bgcolor="#FFFFFF" class="txt border_left border_right  border_bottom" width="20%">

													<?php 

													if($row['productimage'])

															{

															

															

														echo '<img src="'.URL.'/productimage/thumb/'.$row['productimage'].'" width="80" height="80"/>';

														} else {

															echo '<img src="'.URL.'/productimage/default.jpg" width="80" height="80" />';

														}

														?>													</td>

													<td align="left" valign="top" bgcolor="#FFFFFF" class="txt pad_1 border_right  border_bottom" width="44%" ><?php echo $row['productname']; ?><br>

												  </td>							  

													<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="9%"><?php echo $row['quantity']; ?></td>

													<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="13%"><?php echo $row['sellingprice']; ?></td>

													<td align="right" valign="top" bgcolor="#FFFFFF" class="pad_1 txt border_right  border_bottom" width="14%"><font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold;"><?php echo Currency; ?></font>&nbsp;<?php echo number_format($row['subtotal'],2); ?>													</td>

													  </tr>

														<?php

														  	} 

														

														?>

														<tr>

															

															<td class="txt pad_1 border_left border_right  border_bottom" align="right" colspan="5" ><strong>Total Price: </strong></td>

															<td class="pad_1 txt border_right  border_bottom" align="right">

															<font style="font-family:Arial, Helvetica, sans-serif; color:#333333; font-size:12px; font-weight:bold; text-align:left;"><?php echo Currency; ?>&nbsp;</font><?php echo number_format($totalcost,2); ?>

														

														</td>

														</tr>

														

														<tr>

																<td colspan="6">

																	<input type="button" name="ordernow" value="Order Now" class="button2" onclick="ena();"/>

																</td>

															</tr>

															

														<?php } else { ?>	

														<tr>

																<td colspan="6" class="alert" align="center">

																	No records in whishlist.

																</td>

															</tr>	

														<?php } ?>		

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
			 

</div>

    </div>
	</div>