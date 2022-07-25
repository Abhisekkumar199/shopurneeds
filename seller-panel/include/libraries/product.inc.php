<?php 
 


class Product
{

//start class 

		

		

		function subquery($table,$id,$fid,$fname)

			{

				//echo "select ".$fname." from ".$table." where ".$id."=".$fid; 

				$subsql=mysqli_query($conn,"select ".$fname." from ".$table." where ".$id."=".$fid);

				$rowname=mysqli_fetch_array($subsql);

				echo $name= $rowname[$fname];	

				return $name;			

			}

			

			function subquery2($table,$id,$fid,$fname)

			{

				//echo "select ".$fname." from ".$table." where ".$id."=".$fid; 

				$subsql=mysqli_query($conn,"select ".$fname." from ".$table." where ".$id."=".$fid);

				$rowname=mysqli_fetch_array($subsql);

				

				return $rowname[$fname];			

			}

			

			

		function id($id,$id2)

		{

			if($id2==''){ echo $id=$id;	}else{ echo $id=$id2;}return $id;

		}

		

		function sku($sku,$sku2)

		{

			if($sku2=='') {	echo $sku=$sku;	}else{echo $sku=$sku2;}			

			return $sku;		

		}

		function name($name,$name2)

		{

			if($name2=='') {	echo $name=$name;}else{echo $name=$name2;}			

			return $name;		

		}

		

		function comboname($pid,$name,$name2)

		{

			$pid=explode(",",$pid);

			$pname=explode("~",$name2);

			//$num= count($pname);

			 $j=0;

			 for($i=0; $i<=count($pname); $i++)

			 {

			 	$j++;

				//if($pname[$i]!='')

				// {

					//echo "select categoryname from ".$sufix."category `a`, ".$sufix."product_combo `b` where a.cat_id=b.combo_subsubcat_id and a.cat_id='".$catid[$i]."'";

					if($j==count($pname))

					{	$tpname .="<a href='view_product.php?option=view&id=".$pid[$i]."'>".$pname[$i]."</a>"; } else { $tpname .="<a href='view_product.php?option=view&id=".$pid[$i]."'>".$pname[$i]."</a>,"; }

				

				 }				

					//$rows=mysqli_fetch_array($sql);		

					//return $rows['categoryname'].",".$rows['categoryname'];

			//}	

			

			echo $tpname;

			

		}

		

		

		function qty($qty,$qty2)

		{

			if($qty2=='') {	echo $qty=$qty;	}else{echo $qty=$qty2;}			

			return $qty;		

		}

		function sub_subcategory($sufix,$pid,$id)

		{

		 //echo "select categoryname from ".$sufix."category `a`, ".$sufix."product `b`  where a.cat_id=b.subsubcat_id and b.id='".$pid."'";

		 if($id=='')

		 {

		 	$sql=mysqli_query($conn,"select categoryname from ".$sufix."category `a`, ".$sufix."product `b`  where a.cat_id=b.subsubcat_id and b.id='".$pid."'");

		 }

		 else

		 {

		 	$sql=mysqli_query($conn,"select categoryname from ".$sufix."category `a`, ".$sufix."product `b`  where a.cat_id=b.subsubcat_id and b.id='".$id."'");

		 

		 }			

			$rows=mysqli_fetch_array($sql);		

			return $rows['categoryname'];

		}

		

		

		function sub_subcategorycombo($sufix,$id)

		{

		 

		 $catid=explode(",",$id);

		 //echo count($catid);

		 $j=0;

		 for($i=0; $i<=count($catid); $i++)

		 {

		 	$j++;

			if($catid[$i]!='')

			 {

			 //

			 	//echo "select categoryname from ".$sufix."category `a`, ".$sufix."product_combo `b` where a.cat_id=b.combo_subsubcat_id and a.cat_id='".$catid[$i]."'";

				$sql=mysqli_query($conn,"select categoryname from ".$sufix."category `a` where a.cat_id='".$catid[$i]."'");

				$rows=mysqli_fetch_array($sql);				

					if($j==count($catid))

					{		

						$category .=$rows['categoryname'];

					}

					else

					{

						$category .=$rows['categoryname'].",";					

					}				

				 }				

				

			}	

			return $category;	

			

		}

		

		function stock($sufix,$pid,$id)

		{

		 //echo "select stockavailability from ".$sufix."product `b` where b.id='".$pid."'";

		 if($id=='')

		 {

		 	$sql=mysqli_query($conn,"select stockavailability from ".$sufix."product `b` where b.id='".$pid."'");

		 }

		 else

		 {

		 	$sql=mysqli_query($conn,"select stockavailability from ".$sufix."product `b` where b.id='".$id."'");

		 

		 }			

			$rows=mysqli_fetch_array($sql);		

			return $rows['stockavailability'];

		}

		

		function offer($sufix,$offername,$id)

		{

		 //echo "select stockavailability from ".$sufix."product `b` where b.id='".$pid."'";

		 if($id!='')

		 {

		 	//echo "select offername from ".$sufix."offers `a` where a.id='".$id."'";

		 	$sql=mysqli_query($conn,"select offername from ".$sufix."offers `a` where a.id='".$id."'");

			$rows=mysqli_fetch_array($sql);	

			echo $rows['offername'];

		 }

		 else

		 {

		 	echo $offername;

		 

		 }			

			

		}

		

		

		function category($sufix,$subid,$subsubid)

		{

		 //echo "select categoryname from ".$sufix."category `a`, ".$sufix."product `b`  where a.cat_id=b.subsubcat_id and b.id='".$pid."'";

		 if($subsubid!='')

		 {

		 	//echo "select categoryname from ".$sufix."category `a` where a.cat_id='".$subsubid."'";

		 	$sqlsubcat=mysqli_query($conn,"select categoryname from ".$sufix."category `a` where a.cat_id='".$subsubid."'");

				

			$rowsubsubcat=mysqli_fetch_array($sqlsubcat);

			$subsubcat=$rowsubsubcat['categoryname'];

		 }	

		 	

		 if($subid!='')

		 {

		 	$sqlsubcat=mysqli_query($conn,"select categoryname from ".$sufix."category `a` where a.cat_id='".$subid."'");

		 			

			$rowsubcat=mysqli_fetch_array($sqlsubcat);	

			 $subcat=$rowsubcat['categoryname'];

		}			

			

			echo $subcat."-".$subsubcat;

		

		}	

		

		

		function productlist($sufix,$home,$category,$sql2)

		{

			

			if($home=='Home')

			{ 

				$sql="select id,productname,sellingprice,slug from ".$sufix."product where displayflag='1' and featuredproduct='1' and feanddate >='".date("Y-m-d")."'";

			

			}

			elseif($home=='Product')

			{ 

				$sql="select * from ".$sufix."product where displayflag='1' and slug='".$_REQUEST['name']."'";

			

			}			

			elseif($home=='Variant')

			{ 

				echo $sql="select * from ".$sufix."product_variant where displayflag='1' and pid='".$row['id']."'";

			

			}

			else

			{

			

				$sql=$sql2;

			}

			

			return $sql;

		}

		

		

	

	

		function num($sql)

			{ 

				//echo $sql;

				 return (@mysqli_num_rows($sql));

				

			}	

			

			function fetchassoc($sql)

			{ 

				

				 return (@mysqli_fetch_assoc($sql));

				

			}	

			

			function fetcharray($sql)

			{ 

				

				 return (@mysqli_fetch_array($sql));

			}	

			

			public function sqlquery($sql)

			{ 	

				//echo $sql;

				return (@mysqli_query($sql));			

			}	

			

			

			function substrword5($text, $maxchar, $end='') {

				if (strlen($text) > $maxchar || $text == '') {

					$words = preg_split('/\s/', $text);      

					$output = '';

					$i      = 0;

					while (1) {

						$length = strlen($output)+strlen($words[$i]);

						if ($length > $maxchar) {

							break;

						} 

						else {

							$output .= " " . $words[$i];

							++$i;

						}

					}

					$output .= $end;

				} 

				else {

					$output = $text;

				}

				return $output;

				}

				

				

			function productimage($sufix,$productid)

			{

			

				//echo "select * from ".$sufix."imageupload where mainimage='1' and displayflag='1' and pid='".$productid."' LIMIT 0,1";

				$proimage1=$this->sqlquery("select * from ".$sufix."imageupload where mainimage='1' and displayflag='1' and pid='".$productid."' and sortid='1' LIMIT 0,1");

				$proimage=$this->fetchassoc($proimage1);

					if($proimage['productimage']!='')

					{

						$imagename=$proimage['productimage'];									

					}

					else

					{

						$imagename="noproductimage.png";

					

					}	

				

					echo $imagename;	

			

			

			}

			
function productimagemouseover($sufix,$productid)

			{

			

				//echo "select * from ".$sufix."imageupload where mainimage='1' and displayflag='1' and pid='".$productid."' LIMIT 0,1";

				$proimage1=$this->sqlquery("select * from ".$sufix."imageupload where displayflag='1' and pid='".$productid."' and sortid='2' LIMIT 0,1");

				$proimage=$this->fetchassoc($proimage1);

					if($proimage['productimage']!='')

					{

						$imagename=$proimage['productimage'];									

					}

					else

					{

					$proimage1=$this->sqlquery("select * from ".$sufix."imageupload where displayflag='1' and pid='".$productid."' and sortid='1' LIMIT 0,1");

				$proimage=$this->fetchassoc($proimage1);
						$imagename=$proimage['productimage'];									

					

					}	

				

					echo $imagename;	

			

			

			}

			

			function productimagecombo($sufix,$productid)

			{

			

				

				$proimage1=$this->sqlquery("select * from ".$sufix."imageupload where displayflag='1' and comboid='".$productid."' LIMIT 0,1");

				$proimage=$this->fetchassoc($proimage1);

					if($proimage['productimage']!='')

					{

						$imagename=$proimage['productimage'];									

					}

					else

					{

						$imagename="noproductimage.png";

					

					}	

				

					echo $imagename;	

			

			

			}

			

			

			function variantproductimage($sufix,$productid,$varid)

			{

			

				//echo "select * from ".$sufix."imageupload where displayflag='1' and pid='".$productid."' and varpid='".$varid."' LIMIT 0,1";

				$proimage1=$this->sqlquery("select * from ".$sufix."imageupload where displayflag='1' and pid='".$productid."' and varpid='".$varid."' LIMIT 0,1");

				$proimage=$this->fetchassoc($proimage1);

					if($proimage['productimage']!='')

					{

						$imagename=$proimage['productimage'];									

					}

					else

					{

						$imagename="noproductimage.png";

					

					}	

				

					echo $imagename;	//

			

			

			}

			

			function categoryliststrip($sufix)

			{

				

				$sql=$this->sqlquery("select * from `".$sufix."category` where parent='00000' and displayflag='1'");

				

				while($rowitem=$this->fetchassoc($sql))

				{

				

				?>

					<li>

					

					 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="catbackground">

						  <tr>

							<td align="center" style="padding-top:3px;"><a href="<?php echo URL; ?>/<?php echo $rowitem['pagename']; ?>"><img src="categoryimages/<?php if($rowitem['uploadimage']!='') { echo $rowitem['uploadimage'] ; } else {  echo "default.jpg"; }?>" width="100" height="80" border="0" style=" background-color:#FFFFFF;" /></a></td>

					   </tr>

						  <tr>

							<td class="pad_2"><table width="100" border="0" cellspacing="0" cellpadding="0" >

								<tr>

								  <td class="pad_1 catname"  align="center">

								  <a href="<?php echo URL; ?>/<?php echo $rowitem['pagename']; ?>" style="text-decoration:none;"><?php echo $rowitem['categoryname'] ; ?></a>&nbsp;&nbsp;</td>

								</tr>

							</table></td>

						  </tr>

						</table>

					</li>

			<?php } 

			

			}

			

			

			

			function productliststrip($sqlproduct5,$sufix,$t)

			{

				//echo $sqlproduct5;

				//echo $t;

				//if($t!='')

				//{

					

				

				while($rowitem=$this->fetchassoc($sqlproduct5))

				{

				

					 if($rowitem['offername']!='') 

					 { 

					 	//echo "select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."' and (discount >= '50' || offervalue >= '100'"; 

					 	$offerquery=$this->sqlquery("select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."' and (discount >= '50' || offervalue >= '100')");

					 	

						$numoffer=$this->num($offerquery);

						if($numoffer>0)

						{

						

						$rowoffer=$this->fetchassoc($offerquery);

							

					 }

					 }

					 //

					 

				

					

				

				?>

					<li>

					 <table width="100%" border="0" cellspacing="0" cellpadding="0">

						  <tr>

							<td align="center"><a href="<?php echo URL; ?>/<?php echo $rowitem['product_pagename']; ?>" style="text-decoration:none;"><img src="productimage/small/<?php $this->productimage($sufix,$rowitem['productid']) ; ?>" width="110" height="119" border="0" /></a></td>

					   </tr>

						  <tr>

							<td class="pad_2"><table width="165px" border="0" cellspacing="0" cellpadding="0" >

								<tr>

								  <td class="pad_1 pro-heading"  align="center">

								 <a href="<?php echo URL; ?>/<?php echo $rowitem['product_pagename']; ?>" style="text-decoration:none;"> <?php echo $this->substrword5($rowitem['productname'], 20); ?></a>&nbsp;&nbsp;</td>

								</tr>

								<tr>

								  <td class="pad_1 pro-txt" align="center">

								  	<?php if($rowitem['offername']!='' and $numoffer > 0) { ?><div class="rs"><?php echo Currency." ".$rowitem['sellingprice']; ?></div><div class="strike"><?php echo $rowitem['mrp']; ?></div><div class="yellow"><?php echo $rowoffer['offername']; ?></div><?php }  else { ?><div class="rs"><?php echo Currency." ".$rowitem['mrp']; ?></div><?php } ?>

								  

								  <!--<div> <span style="color:#FF0000;"><?php //echo Currency; ?> <?php //echo $rowitem['sellingprice']; ?></span></div>-->

								  

								  </td>

								</tr>

								

							</table></td>

						  </tr>

						</table>

					</li>

			<?php 

			

			

				

			

			}

			

			

			 

			//}

			//else

			//{

			

			//while($rowitem=$this->fetchassoc($sqlproduct5))

			//	{

				

					// if($rowitem['offername']!='') 

					// { 

					 	//echo "select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."'"; 

					 //	$offerquery=$this->sqlquery("select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."'");

					 	

						//$numoffer=$this->num($offerquery);

						//$rowoffer=$this->fetchassoc($offerquery);

							

					 

					// }

				

					

				

				?>

					<!--<li>

					 <table width="100%" border="0" cellspacing="0" cellpadding="0">

						  <tr>

							<td align="center"><a href="<?php //echo URL; ?>/<?php //echo $rowitem['product_pagename']; ?>" style="text-decoration:none;"><img src="productimage/small/<?php //$this->productimage($sufix,$rowitem['productid']) ; ?>" width="110" height="119" border="0" /></a></td>

					   </tr>

						  <tr>

							<td class="pad_2"><table width="165px" border="0" cellspacing="0" cellpadding="0" >

								<tr>

								  <td class="pad_1 pro-heading"  align="center">

								 <a href="<?php //echo URL; ?>/<?php //echo $rowitem['product_pagename']; ?>" style="text-decoration:none;"> <?php //echo $this->substrword5($rowitem['productname'], 20); ?></a>&nbsp;&nbsp;</td>

								</tr>

								<tr>

								  <td class="pad_1 pro-txt" align="center">

								  	<?php //if($rowitem['offername']!='' and $numoffer > 0) { ?><div class="rs"><?php //echo Currency." ".$rowitem['sellingprice']; ?></div><div class="strike"><?php //echo $rowitem['mrp']; ?></div><div class="yellow"><?php //echo $rowoffer['offername']; ?></div><?php //}  else { ?><div class="rs"><?php //echo Currency." ".$rowitem['mrp']; ?></div><?php //} ?>

								  

								

								  

								  </td>

								</tr>

								

							</table></td>

						  </tr>

						</table>

					</li>-->

			<?php //} 

			

			//}

			

			}

			

			

			

			function productid()

			{

					$pid=explode("/",$_REQUEST['pid']);

					//$mystring = $_REQUEST['catid'];

					

					//echo $mystring2=$_REQUEST['pname'];

					//return $pos2;	

					return $pid[0];

			

					return $pid[2];

			}

			

			

			function productvariation($sufix,$pid,$vartype,$url,$vtype,$vvalue,$vpid,$vpid2,$vvalue3)

			{ //start product variation function

				

						

					//query for variation product

					if($vtype!='' && $vvalue!='')

					{

						$sql1="select * from `".$sufix."product_variant` where pid='".$pid."' and variantvalue1='".$vtype."' and variantqty > 0 group by variantvalue";

						$sql2="select * from `".$sufix."product_variant` where pid='".$pid."' and variantvalue='".$vvalue."' and variantqty > 0 group by variantvalue1";

					

					}

					elseif($vtype!='' && $vvalue=='')

					{

						$sql1="select * from `".$sufix."product_variant` where pid='".$pid."' and variantvalue1='".$vtype."' and variantqty > 0 group by variantvalue";

						$sql2="select * from `".$sufix."product_variant` where pid='".$pid."' and variantqty > 0 group by variantvalue1";

					

					}

					elseif($vvalue!='' && $vtype=='')

					{

						$sql1="select * from `".$sufix."product_variant` where pid='".$pid."' and variantqty > 0 group by variantvalue";

						$sql2="select * from `".$sufix."product_variant` where pid='".$pid."' and variantvalue='".$vvalue."' and variantqty > 0 group by variantvalue1";

					

					}

					else

					{

						$sql1="select *  from `".$sufix."product_variant` where pid='".$pid."' and variantqty > 0 group by variantvalue";

						$sql2="select * from `".$sufix."product_variant` where pid='".$pid."' and variantqty > 0 group by variantvalue1";

					

					}

					

					//echo $sql1;

					//echo "<br>";

					//echo $sql2; 

					

					$sqlvariation=$this->sqlquery($sql1) ;

					$sqlvariation2=$this->sqlquery($sql2) ;

					

					

					

					//echo $vpid2;

					$numvariation=$this->num($sqlvariation);

					if($numvariation > 0)

					{

						if($vartype==1)

						{

							

				   ?>

						<strong>Color:</strong><ul class="selectcolor">

						 		<!--<select name="vcolor" id="vcolor" onchange="vselect(this.value);" style="width:150px;">-->

								 <?php 

						 

									 $i=1;

									 while($rowvariation=$this->fetchassoc($sqlvariation))

									 {

											//echo $rowvariantvalue=explode("~",$rowvariation['value']);

											//echo $rowvariation['value'];

											//if($vtype)

											// 

									 

										

									 ?> 

									 <li style="width:30px; cursor:pointer; height:25px;background-color:<?php echo color_name_to_hex($rowvariation['variantvalue']); ?>;" onclick="vselect(this.value);" value="<?php echo $rowvariation['vproductcode']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>

										<!--<option value="<?php //echo $url."/".$rowvariation['variantpagename']; ?>" <?php //if($vvalue3==$rowvariation['variantvalue']) { ?> selected="selected" <?php //} ?>><?php //echo $rowvariation['variantvalue']; ?></option>-->

									<?php 

										$i++;

										

										} ?>

							<!--</select>-->

						 </ul>

					<br /><br />

						

						<?php } 

						

						elseif($vartype==2)

						{

							

				   ?>

	   <strong>Size:</strong>&nbsp;<select name="vsize" id="vsize" onchange="vselect(this.value);"  style="width:150px;" required>

								 

								 <option value="">--Select Size--</option>

								 <?php 

						 

									 $i=1;

									 while($rowvariation2=$this->fetchassoc($sqlvariation))

									 {

											//echo $rowvariantvalue=explode("~",$rowvariation['value']);

											//echo $rowvariation['value'];

											//if($vtype)

											// 

											

									 

										

									 ?> 

										<option value="<?php echo $rowvariation2['vproductcode']; ?>" <?php if(substr($vpid,0,-4)==$rowvariation2['vproductcode']) { ?> selected="selected" <?php } ?> ><?php echo $rowvariation2['variantvalue']; ?></option>

									<?php 

										$i++;

										

										} ?>

							</select><br /><br />

							

						<?php } 

						

						

						elseif($vartype==3)

						{ // 

						$sqlvarcolor=mysqli_query($conn,"select variantvalue from flip_product_variant where vproductcode='".substr($vpid,0,-4)."'");

						$valuecolorvar=mysqli_fetch_array($sqlvarcolor,0);

				   ?>

	   

	   

	        <input type="hidden" value="<?php echo $pid; ?>" name="pidcolor" id="pidcolor" />

						

						<strong>Color:</strong><ul class="selectcolor">

						 		<!--<select name="vcolor" id="vcolor" onchange="vselect(this.value);" style="width:150px;">-->

								 <?php 

						 

									 $i=1;

									 while($rowvariation=$this->fetchassoc($sqlvariation))

									 {

											//echo $rowvariantvalue=explode("~",$rowvariation['value']);

											//echo $rowvariation['value'];

											//if($vtype)

											// 

									 

										

									 ?> 

									 <li class="ui-listItem" style="width:30px; cursor:pointer; height:15px; background-color:<?php echo color_name_to_hex($rowvariation['variantvalue']); ?>;" onclick="selectvariantsize('<?php echo $rowvariation['variantvalue']; ?>')" value="<?php echo $valuecolorvar; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>

										<!--<option value="<?php //echo $url."/".$rowvariation['variantpagename']; ?>" <?php //if($vvalue3==$rowvariation['variantvalue']) { ?> selected="selected" <?php //} ?>><?php //echo $rowvariation['variantvalue']; ?></option>-->

									<?php 

										$i++;

										

										} ?>

							<!--</select>-->

						 </ul>

							

							<br />

							<strong>Size:</strong>

							<div id="showcariantsize">

					<select name="vsize" id="vsize" onchange="vselect(this.value);" style="width:150px;" required>

								 

								 <option value="">--Select Size--</option>

								 <?php 

						 

									 $i=1;

									 while($rowvariation2=$this->fetchassoc($sqlvariation2))

									 {

											//echo $rowvariantvalue=explode("~",$rowvariation['value']);

											//echo $rowvariation['value'];

											//if($vtype)

											// 

											

									 

										

									 ?> 

										<option value="<?php echo $rowvariation2['vproductcode']; ?>" <?php if(substr($vpid,0,-4)==$rowvariation2['vproductcode']) { ?> selected="selected" <?php } ?>><?php echo $rowvariation2['variantvalue1']; ?></option>

									<?php 

										$i++;

										

										} ?>

							</select>

							</div>

							<br /><br />

							

						<?php } ?>	

						

								

    

			<?php } 

	

			

			} //product variation function







		

		

} //end class

$product= new Product();	

?>