<?php 
##  PHP AdminPanel                                           	          
##  Developed by:  Pawan Kumar <pavan@exisolutionsgroup.com>   
##  Created Date:  07-June-2013 											
##  WebSite:       http://www.exisolutionsgroup.com/		                    
##  Copyright:     Exi Solutions Group@ 2013. All rights reserved. 
//

class Search{
//start class 
		
		
		function catid()
		{
				$mystring = $_REQUEST['catid'];
				$findme   = 'submenu_cat';
				$pos = strpos($mystring, $findme);	
				
				$findme2   = 'submenu_brand';
				$pos2 = strpos($mystring, $findme2);
				
			return array($pos,$pos2);
			//return $pos2;	
		
		} //
		
			
		
		function productquery($sufix,$where,$selvalue,$group)
		{
			if($selvalue!='' && $group!='')
			{
				$sqlp="select ".$selvalue." from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where." ".$group;
			}
			elseif($selvalue!='' && $group=='')
			{
				$sqlp="select ".$selvalue." from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where;
			
			}
			elseif($selvalue=='' && $group!='')
			{
				$sqlp="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where." ".$group;
			
			}
			else
			{
				$sqlp="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where ." order by id";			
			}			
			//echo $sqlp;
			return $sqlp;
		}
		
		
		function productqueryload($sufix,$where,$selvalue,$group,$filtered)
		{
			if($selvalue!='' && $group!='')
			{
				$sqlp="select ".$selvalue." from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where." ".$group;
			}
			elseif($selvalue!='' && $group=='')
			{
				$sqlp="select ".$selvalue." from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where;
			
			}
			elseif($selvalue=='' && $group!='')
			{
				$sqlp="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and ". $where." ".$group;
			
			}
			else
			{
				$sqlp="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and id > '".$filtered."' and ". $where ." order by id asc";			
			}			
			//echo $sqlp;
			return $sqlp;
		}
		
		
		function productqueryaj($sufix,$where,$selvalue,$group)
		{
			if($selvalue!='' && $group!='')
			{
				$sqlp="select ".$selvalue." from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' ". $where." ".$group;
			}
			elseif($selvalue!='' && $group=='')
			{
				$sqlp="select ".$selvalue." from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' ". $where;
			
			}
			elseif($selvalue=='' && $group!='')
			{
				$sqlp="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' ". $where." ".$group;
			
			}
			else
			{
				$sqlp="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' ". $where;			
			}			
			
			//echo $sqlp;
			//return $sqlp;
		}
		
		
			
		function leftsection($sufix,$type)
		{
			
			//echo $_REQUEST['catid'];
			
			$catid=explode("/",$_REQUEST['catid']);
			$query=new query();			
			
			
			$mystring = $_REQUEST['catid'];
			$findme   = 'submenu_cat';
			$pos = strpos($mystring, $findme);
	
			$findme2   = 'submenu_brand';
			$pos2 = strpos($mystring, $findme2);


			if($pos !== false) 
			{
				//echo "select * from `".$sufix."category` where parent='".$catid[1]."'";
				$sql=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$catid[1]."'");
				$sqlcat=mysqli_query($conn,"select * from `".$sufix."category` where cat_id='".$catid[1]."'");
				
				if($rowscat=mysqli_fetch_assoc($sqlcat))
					{
						$parentcatid=$rowscat['parent'];	
					}	
			
			}
			elseif($pos2 !== false) 
			{
				
				//echo "select catid from ".$sufix."brand `a`, ".$sufix."category_brand `b`  where b.bdisplayflag='1' and a.bid='".$catid[0]."' and b.catid='".$catid[1]."' and a.bid=b.brandid order by a.sortid asc";
				
				$sqlcat2=mysqli_query($conn,"select catid from ".$sufix."brand `a`, ".$sufix."category_brand `b`  where b.bdisplayflag='1' and a.bid='".$catid[1]."' and b.catid='".$catid[2]."' and a.bid=b.brandid order by a.sortid asc");
				
				if($rowscat=mysqli_fetch_assoc($sqlcat2))
				{
					//echo "select * from `".$sufix."category` where cat_id='".$rowscat['parent']."'";
					
					
						$parentcatid=$rowscat['catid'];	
						
				}	
			
			}
			else
			{
				//echo "select * from `".$sufix."category` where cat_id='".$catid[1]."'";
				
				$sqlcat2=mysqli_query($conn,"select * from `".$sufix."category` where cat_id='".$catid[1]."'");
				
				if($rowscat=mysqli_fetch_assoc($sqlcat2))
				{
					//echo "select * from `".$sufix."category` where cat_id='".$rowscat['parent']."'";
					
					$sqlcat=mysqli_query($conn,"select * from `".$sufix."category` where cat_id='".$rowscat['parent']."'");
					//$sqlcat=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$catid[1]."'");	
					
					if($rowscat=mysqli_fetch_assoc($sqlcat))
						{
							$parentcatid=$rowscat['parent'];	
						}	
				}	
			}
			
			
			
			
			
			if($pos !== false) 
			{
			
			if($type=='Sub-SubCategory')
			{
			
			$num=mysqli_num_rows($sql);
			if($num > 0)
			{
				
								
				?>
				 <h3>By Subcategory</h3>
					<div>
						<div id="boxscrolls3">
							<!--<div style="overflow-y: scroll; overflow-x: hidden; height:80px; width:200px;">-->
							<input name="category" id="category" type="hidden" value="" />
							<input name="catid" id="catid" type="hidden" value="<?php echo $_REQUEST['catid']; ?>" />
							
							<input name="category2" id="category2" type="hidden" value="<?php echo $catid[1]; ?>" />
							 <table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
								<?php
								$c=1;
									while($rows=mysqli_fetch_assoc($sql))
										{
										
											//$sqlcat=mysqli_query($conn,"select id from `".$sufix."product` where subcat_id='".$rowscat['parent']."'");
											
											$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where subsubcat_id='".$rows['cat_id']."'");
											$numproduct=mysqli_num_rows($sqlproduct);
											if($numproduct > 0)
														{					
								?>			
								
								<tr>
									<td width="7%"><input type="checkbox" name="cat_<?php echo $c; ?>" id="cat_<?php echo $c; ?>"  value="<?php echo $rows['cat_id']; ?>" class="sortcategory"/></td>
									<td width="93%" class="pad_left5"><!--<a href="#" id="sortcategory" style="text-decoration:none;">--><font color="#000000"><?php echo $rows['categoryname']; ?> (<?php echo $numproduct; ?>)</font><!--</a>--></td>
								  </tr>	
								<?php 
								$c++;
								}
								} ?>	
									
							   </table>
							</div>
						</div>
						 
					<?php 
					}
				
				} //end first type of search
				
				
				}
				
			if($pos2 !== false) 
			{
			
			if($type=='Sub-SubCategory')
			{
				//echo "select * from `".$sufix."category` where parent='".$parentcatid."'";
				$sql=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$parentcatid."'");
															
			$num=mysqli_num_rows($sql);
			if($num > 0)
			{
			
				
								
				?>
			
					<h3>By Subcategory</h3>
						<div>	
						 <div id="boxscrolls4">
						<!--<div style="overflow-y: scroll; overflow-x: hidden; height:80px; width:200px;">-->
							<input name="brand" id="brand" type="hidden" value="<?php echo $catid[1]; ?>" /> 
							<input name="category" id="category" type="hidden" value="<?php //echo $catid[2]; ?>" />
							<input name="catid" id="catid" type="hidden" value="<?php echo $_REQUEST['catid']; ?>" />
							<input name="category2" id="category2" type="hidden" value="<?php echo $parentcatid; ?>" />
							 <table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
								<?php
								$c=1;
									while($rows=mysqli_fetch_assoc($sql))
									{
									//echo "select * from `".$sufix."category` where parent='".$rows['cat_id']."'";
									
									$sql2=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rows['cat_id']."'");
									
										while($rows=mysqli_fetch_assoc($sql2))
											{
										
												//echo "select categoryname,pagename,id,subsubcat_id from `".$sufix."product` `a`, `".$sufix."category` `b` where a.subsubcat_id='".$rows['cat_id']."' and a.bid='".$catid[1]."' and a.subsubcat_id=b.cat_id";
												$sqlproduct2=mysqli_query($conn,"select categoryname,pagename,id,subsubcat_id from `".$sufix."product` `a`, `".$sufix."category` `b` where a.subsubcat_id='".$rows['cat_id']."' and a.bid='".$catid[1]."' and a.subsubcat_id=b.cat_id");
														
														$numproduct=mysqli_num_rows($sqlproduct2);
														if($numproduct > 0)
														{
														
												
												//$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where subsubcat_id='".$rows['cat_id']."'");
												//$numproduct=mysqli_num_rows($sqlproduct);		
											//$sqlcat=mysqli_query($conn,"select id from `".$sufix."product` where subcat_id='".$rowscat['parent']."'");
																
								?>			
								
								<tr>
									<td width="7%" height="15"><input type="checkbox" name="cat_<?php echo $c; ?>" id="cat_<?php echo $c; ?>"  value="<?php echo $rows['cat_id']; ?>" class="sortcategory"/></td>
									<td width="93%" class="pad_left5"><!--<a href="#" id="sortcategory" style="text-decoration:none;">--><font color="#000000"><?php echo $rows['categoryname']; ?>(<?php echo $numproduct; ?>) </font><!--</a>--></td>
								  </tr>	
								<?php 
								$c++;
								}
								
								}
								} ?>	
									
							   </table>
							</div>
						</div>
				  
						 
					<?php 
					}
				
				} //end first type of search
				
				
				}
				
				if ($pos2 == '') 
				{
				if($type=='Brand')
				{ //start the type of brand
				
				
				
				//echo "select distinct* from ".$sufix."brand `a`, ".$sufix."category_brand `b`, ".$sufix."product `c`  where b.bdisplayflag='1' and b.catid='".$parentcatid."' and a.bid=b.brandid and c.cat_id='".$parentcatid."' and c.bid=b.brandid order by a.sortid"; 
				 
				$sqlbrand=mysqli_query($conn,"select distinct* from ".$sufix."brand `a`, ".$sufix."category_brand `b`  where b.bdisplayflag='1' and b.catid='".$parentcatid."' and a.bid=b.brandid order by a.sortid");
				$numbrand=mysqli_num_rows($sqlbrand);
				if($numbrand > 0)
					{ //start num brand
					
				?>	
					
						 <h3>By Brand</h3>
							<div>
								 <div id="boxscrollb1">
								<!--<div style="overflow-y: scroll; overflow-x: hidden; height:80px; width:200px;">-->
								<?php
									if ($pos == false && $pos2 == '') 
									{
								?>
									<input name="category" id="category" type="hidden" value="<?php echo $catid[1]; ?>" />
									<input name="catid" id="catid" type="hidden" value="<?php echo $_REQUEST['catid']; ?>" />
									<?php } ?>
									<input name="brand" id="brand" type="hidden" value="" /> 
									<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
										<?php	
										$b=1;							
											while($rowbrand=mysqli_fetch_assoc($sqlbrand))
												{
														
													//	echo "select id from `".$sufix."product` where bid='".$rowbrand['bid']."' and (subsubcat_id='".$catid[1]."' || subcat_id='".$catid[1]."')";
														$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where bid='".$rowbrand['bid']."' and (subsubcat_id='".$catid[1]."' || subcat_id='".$catid[1]."')");
														$numproduct=mysqli_num_rows($sqlproduct); //
														if($numproduct > 0)
														{			
											?>
											
												<tr>
													<td width="7%" ><input type="checkbox" name="brand_<?php echo $b; ?>" id="brand_<?php echo $b; ?>" value="<?php echo $rowbrand['bid']; ?>" class="sortbrand"/></td>
													<td width="93%" class="pad_left5"><?php echo $rowbrand['brandname']; ?></td>
											  </tr>
											  <?php } ?>
											 <?php 
											 $b++;
											 
											 } ?>
											</table>
											</div>
									</div>
											
					
					
								<?php	
									} //end num brand	
								else
								{
								?>
								
									<input name="brand" id="brand" type="hidden" value="" /> 
								<?php
								
								
								}			
								
								} //end the type of brand
								
								
								}
								
								
								if($type=='Discount')
								{ //start the type of discount 
								
								//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
								$sqloffer=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
								$sqloffer2=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
								$numoffer=mysqli_num_rows($sqloffer);
								if($numoffer > 0)
									{ //start num brand 
									
										while($rowoffer=mysqli_fetch_assoc($sqloffer))
											{
												
												
												if ($pos !== false) 
													{
														$selvalue="";
														$group="";
														$where=" subcat_id='".$catid[1]."' and offername='".$rowoffer['id']."'";
													}
													elseif($pos2 !== false)
													{
														$selvalue="";
														$group="";
														$where=" bid='".$catid[1]."' and offername='".$rowoffer['id']."' ";
													
													}
													else
													{
														$selvalue="";
														$group="";
														$where=" subsubcat_id='".$catid[1]."' and offername='".$rowoffer['id']."' ";
														//$orderby="order by id desc";
													
													}
												
												$sql=$this->productquery($sufix, $where,$selvalue,$group) ;
												
												$sqlproduct=mysqli_query($conn,$sql);
												$numproduct=mysqli_num_rows($sqlproduct);												
												
												if($numproduct > 0)
												{ //
									
													$numval=$numproduct;
												}
											}	
									
									if($numval>0)
									{ //start num value
									
									
									?>	
						 <h3>By Discount</h3>
							<div>								
							 <div id="boxscrolld1">
								<input name="discount" id="discount" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php
										$dc=1;
										while($rowoffer=mysqli_fetch_assoc($sqloffer2))
											{
												
												
												if ($pos !== false) 
													{
														$selvalue="";
														$group="";
														$where=" subcat_id='".$catid[1]."' and offername='".$rowoffer['id']."'";
													}
													elseif($pos2 !== false)
													{
														$selvalue="";
														$group="";
														$where=" bid='".$catid[1]."' and offername='".$rowoffer['id']."' ";
													
													}
													else
													{
														$selvalue="";
														$group="";
														$where=" subsubcat_id='".$catid[1]."' and offername='".$rowoffer['id']."' ";
														//$orderby="order by id desc";
													
													}
												
												$sql=$this->productquery($sufix, $where,$selvalue,$group) ;
												
												$sqlproduct=mysqli_query($conn,$sql);
												$numproduct=mysqli_num_rows($sqlproduct);												
												
												if($numproduct > 0)
												{ //
													
																
										?>			
								
									  	<tr>
											<td width="7%"><input type="checkbox" name="discount_<?php echo $dc; ?>" id="discount_<?php echo $dc; ?>" value="<?php echo $rowoffer['id']; ?>" class="sortdiscount" /></td>
											<td width="93%" class="pad_left5"><?php echo $rowoffer['offername']; ?> </td>
									  </tr>
									 <?php }
									 	
										$dc++;
									 }
									 
									  ?>
									</table>
								</div>
							</div>
											
					
				<?php
				
					} //end numvalue
					else
					{
					
					?>
					
					<h3 style="display:none;"></h3><div><input name="discount" id="discount" type="hidden" value="" /></div>
					<?php
					}
					
						
					} //end num brand	
							
				
				} //end the type of discount
				
				
				if($type=='Price')
				{ //start the type of price 
				
				
					
				?>	
						<h3>By Price</h3>
							<div>
								 <div id="boxscrollp1">
								<input name="price" id="price" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									
								
									  	<tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1~50" class="sortprice" /></td>
											<td width="93%" class="pad_left5">1 to 50
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="50~100" class="sortprice" /></td>
											<td width="93%" class="pad_left5">50 to 100
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="100~200" class="sortprice" /></td>
											<td width="93%" class="pad_left5">100 to 200
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="200~500" class="sortprice" /></td>
											<td width="93%" class="pad_left5">200 to 500
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="500~1000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">500 to 1000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1000~10000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">1000 to 10000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="above10000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">Above 10000
												</td>
										  </tr>
									
									</table>
								</div>
							</div>	
				<?php	
					
							
				
				} //end the type of price 
				
				
				
				
				
				}	
				
				
				
	function searchfilterload($sufix,$filtered)
		{
			$catid=explode("/",$_REQUEST['catid']);
			$query=new query();
			$mystring = $_REQUEST['catid'];
			
			$findme   = 'submenu_cat';
			$pos = strpos($mystring, $findme);
		
			$findme2   = 'submenu_brand';
			$pos2 = strpos($mystring, $findme2);
		
			if($pos !== false) 		
			{
				$catval="subcat_id";
				$cattype=$catid[1];
			
			}
			elseif($pos2 !== false) 		
			{
				 $catval="cat_id";
				$cattype=$catid[2];
			
			}
			else
			{
				$catval="subsubcat_id";
				$cattype=$catid[1];
			
			}
			
			//$sql=mysqli_query($conn,"$sqlp." and subcat_id='".$catid[1]."'");
				$where = " 1 = 1 ";
				 
				  if ($pos !== false) 		
					{
						$s[] = "`".$catval."` = '".$cattype."'";
					
					}
					elseif ($pos2 !== false) 		
					{
						
						
							$s[] = "`".$catval."` = '".$cattype."' and `bid`='".$catid[1]."'";
					}
					else
					{
						$s[] = "`".$catval."` = '".$cattype."'";
					
					}
			
					//count($s);
					if(isset($s)){
						$where = " " . implode(" and ",$s)." ";
					}
					
					$group='';
					$selvalue='';
					
					$sqlp=$this->productqueryload($sufix, $where,$selvalue,$group,$filtered) ;
					//echo $sqlp;
    				//$sql=mysqli_query($conn,"$sqlp);
					return $sqlp;
				}	
				
				
				
				
		function searchfilter($sufix)
		{
			$catid=explode("/",$_REQUEST['catid']);
			$query=new query();
			$mystring = $_REQUEST['catid'];
			$findme   = 'submenu_cat';
			$pos = strpos($mystring, $findme);
		
			$findme2   = 'submenu_brand';
			$pos2 = strpos($mystring, $findme2);
		    $findme3   = 'category';
			$pos3 = strpos($mystring, $findme3);
			if($pos !== false) 		
			{
				$catval="subcat_id";
				$cattype=$catid[1];
			
			}
			elseif($pos2 !== false) 		
			{
				 $catval="cat_id";
				$cattype=$catid[2];
			
			}
			elseif($pos3 !== false) 		
			{
				 $catval="cat_id";
				$cattype=$catid[1];
			
			}
			else
			{
				$catval="subsubcat_id";
				$cattype=$catid[1];
			
			}
			
			//$sql=mysqli_query($conn,"$sqlp." and subcat_id='".$catid[1]."'");
				$where = " 1 = 1 ";
				 
				  if ($pos !== false) 		
					{
						$s[] = "`".$catval."` = '".$cattype."'";
					
					}
					elseif ($pos2 !== false) 		
					{
						
						
							$s[] = "`".$catval."` = '".$cattype."' and `bid`='".$catid[1]."'";
					}
					else
					{
						$s[] = "`".$catval."` = '".$cattype."'";
					
					}
			
					//count($s);
					if(isset($s)){
						$where = " " . implode(" and ",$s)." ";
					}
					
					$group='';
					$selvalue='';
					
					$sqlp=$this->productquery($sufix, $where,$selvalue,$group) ;
					//echo $sqlp;
    				//$sql=mysqli_query($conn,"$sqlp);
					return $sqlp;
				}		
				
			//
				function searchfilterajax($sufix,$keywordsearch)
				{
						
						
					
						//echo $keywordsearch; 
					//echo $mystring = $_REQUEST['catid'];
						if($_REQUEST['catid']!='product' && $_REQUEST['catid']!='undefined')
						{ 
							//echo $_REQUEST['catid'];
							$scatid=explode("/",$_REQUEST['catid']);						
							$mystring = $_REQUEST['catid'];
							
							$findme   = 'submenu_cat';
							$findme12   = 'submenu_subcat';
							$findme11   = 'category';
							
							
							$pos = strpos($mystring, $findme);
						
							$pos11 = strpos($mystring, $findme11);
							
							$pos12 = strpos($mystring, $findme12);
							
							$findme2   = 'submenu_brand';
					 	$pos2 = strpos($mystring, $findme2);
							
							
						}						
						elseif($keywordsearch!='undefined' || $keywordsearch!='undefined' || $_REQUEST['keypage']!='undefined')						
						{
							
							//echo $keywordsearch;			
							$mystring5 = $_REQUEST['keypage'];
							$findme5   = 'category';
							$pos5 = strpos($mystring5, $findme5);							
							$keysearch=explode("~",$keywordsearch);
							$pos6="product";
													
						
						}
						elseif(($_REQUEST['keypage']=='undefined' || $_REQUEST['keypage']=='') && $_REQUEST['brand']!='')						
						
						{
							$pos9 = $_REQUEST['brand'];
						
						}
						
						
						
					//echo $_REQUEST['keypage'];
						
					
						if ($pos !== false && $_REQUEST['keypage']!='product') 		
						{
							$catval="subcat_id";
							$cattype=$catid[1];
						
						}
						if ($pos12 !== false && $_REQUEST['keypage']!='product') 		
						{
							$catval="subsubcat_id";
							$cattype=$catid[1];
						
						}
						
						elseif ($pos11 !== false && $_REQUEST['keypage']!='product') 		
						{
							$catval="cat_id";
							$cattype=$catid[1];
						
						}
						elseif ($pos2 !== false && $_REQUEST['keypage']!='product') 		
						{
							$catval="cat_id";
							$cattype=$catid[2];
						
						}
						elseif($pos9 !== false && $_REQUEST['keypage']!='product') 		
						{
							$catval="cat_id";
							$cattype=$catid[2];
						
						}
						elseif($_REQUEST['keypage']=='product' || $pos6 !== false)
						{
							$catval="subcat_id";
							$cattype=$catid[1];
						
						}
						else
						{
							$catval="subsubcat_id";
							$cattype=$catid[1];
						
						}
						
						//echo $catval;
						
						//echo $catval;
						
						/*if ($pos !== false) 
						//
						{
							$catval="subcat_id";
						
						}
						else
						{
							$catval="subsubcat_id";
						
						}*/
			
			//$sql=mysqli_query($conn,"$sqlp." and subcat_id='".$catid[1]."'");
					$group='';
					$selvalue='';
				$q=0;	
				$where = " 1 = 1 ";
				if($_REQUEST['cat']!='')
				{
				//echo $_REQUEST['cat'];
					$catid=explode(",",$_REQUEST['cat']);
				}
				if($_REQUEST['brand']!='')
				{
					//echo $_REQUEST['brand'];
					$bid=explode(",",$_REQUEST['brand']);
				}
				if($_REQUEST['discount']!='')
				{
					$dis=explode(",",$_REQUEST['discount']);
				}
				if($_REQUEST['price']!='')
				{
					$price=explode(",",$_REQUEST['price']);
				}
				
				//echo $_REQUEST['brand'];
				//echo count($price);
				
				//echo $_REQUEST['keypage'];
				
				if ($pos !== false && $_REQUEST['keypage']!='product' && ($_REQUEST['keypage']=='undefined' || $_REQUEST['keypage']=='')) 		
						{
				
						//echo $scatid[1];
						if(count($catid)!=0)
						{
							//echo $catid;
							$s=$this->subsubcatquery($catid,$bid,$dis,$price,$sufix);
							
						} ///end check the condition for catid is not equal to blank
						else
						{
						//echo $scatid[1];
							$s=$this->subcatquery($scatid[1],$bid,$dis,$price,$sufix);
						
						}
				
				}
				
				
				elseif ($pos12 !== false && $_REQUEST['keypage']!='product' && ($_REQUEST['keypage']=='undefined' || $_REQUEST['keypage']=='')) 		
						{
				
						//echo $catval;
						if($catval=="subsubcat_id")
							{
								//echo $scatid[1];
								$s=$this->subcatquery($scatid[1],$bid,$dis,$price,$sufix);
							
							}
				
				}
				
				elseif ($pos11 !== false && $_REQUEST['keypage']!='product' && $_REQUEST['keypage']!='undefined') 		
						{
				
						
						if(count($catid)!=0)
						{
							//echo $catid;
							$s=$this->subsubcatquery($catid,$bid,$dis,$price,$sufix);
							
						} ///end check the condition for catid is not equal to blank
						else
						{
							//echo $scatid[1];
							$s=$this->subcatquery($scatid[1],$bid,$dis,$price,$sufix);
						
						}
				
				}
				elseif ($pos2 !== false && $_REQUEST['keypage']!='product' && $_REQUEST['keypage']!='undefined') 		
					{
						//echo "Test";
						
						//echo $bid;
						if($bid=='')
						{
							$bid=explode(",",$scatid[1]);
						
						}
						else
						{
							$bid=$bid;
						
						}
						if(count($catid)!=0)
						{
							//echo $catid; 
							$s=$this->subsubcatquery($catid,$bid,$dis,$price,$sufix);
						}
						else
						{
						  //echo $bid;;
							$s=$this->brandquery($scatid[2],$bid,$dis,$price,$sufix);
						
						}	
					
					}
					
				elseif ($pos9 !== false && $_REQUEST['keypage']!='product' && ($_REQUEST['keypage']=='undefined' || $_REQUEST['keypage']=='')) 		
					{
						//echo "Test";
						//echo $scatid[2];
						//echo count($catid);
						
						if(count($catid)!=0)
						{
							//$catid;
							$s=$this->subsubcatquery($catid,$bid,$dis,$price,$sufix);
						}
						else
						{
							//echo $scatid[2];
							$s=$this->brandquery($scatid[2],$bid,$dis,$price,$sufix);
						
						}	
					
					}	
				
				elseif($keysearch!='' && $_REQUEST['keypage']=='product')
				{
					//echo $keysearch;
					//echo $pos5;
					if($pos5!==false)
					{ 
						//echo $catid;
						$s=$this->keyquery2($catid,$bid,$dis,$price,$sufix);
					}
					elseif($pos6!==false)
					{
					 	//echo $keysearch;
						$s=$this->keyquery($catid,$bid,$dis,$price,$sufix,$keysearch);
					
					}
					else
					{
					 	//echo $catid;
						$s=$this->keyquery($catid,$bid,$dis,$price,$sufix,$keysearch);
					
					}
					
					
					
				
				
				}
				elseif($keywordsearch=='' && $_REQUEST['keypage']!='')
				{
					
					//echo $catid;
					$s=$this->keyquery2($catid,$bid,$dis,$price,$sufix);
				
				}
				else
				{ 
					//echo "Test2";
					//echo $scatid[1];
				
					//echo $catval;
					if($catval=="subsubcat_id")
					{
						//echo $bid;
						$s=$this->subsubcatquery($scatid[1],$bid,$dis,$price,$sufix);
					
					}
					elseif($catval=="cat_id")
					{
						//echo $_REQUEST['cat'];
						 $s=$this->subcatquery2($catid,$bid,$dis,$price,$sufix);
					
					}
					elseif($catval=="subcat_id")
					{
						
						 $s=$this->subcatquery2($scatid[1],$bid,$dis,$price,$sufix);
					
					}
					else
					{
							
						 $s=$this->subcatquery2($scatid[1],$bid,$dis,$price,$sufix);
					
					}
						 
					
				} //
				
				//echo $s;
				return $s;
				
			}
			
			function keyquery2($scatid,$bid,$dis,$price,$sufix)
			{
			
				//echo $scatid;
				
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
													
														$s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') and `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													$s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') and `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' ";
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') and `bid` = '".$bid[$b]."' and ".$pquery." ";
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') and `offername` = '".$dis[$d]."' and ".$pquery." ";
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														echo $s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') and `offername` = '".$dis[$d]."' ";
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
											
												$s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') and ".$pquery." ";
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										
										for($b=0;$b<count($bid);$b++)
										{
									
											$s[] = " `bid` = '".$bid[$b]."'";
										}
									}
								
								elseif(count($scatid)!=0)
									{
										
										for($scat=0;$scat<count($scatid);$scat++)
										{
									
											$s[] = " (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";	
										 
										 }
									}
								
								/*else
								{
									
									$s[] = " `subcat_id` = '".$scatid."'";	
											
								}*/
							
			//echo $s;
					return $s;
				}
			
			
			
			
			function keyquery($scatid,$bid,$dis,$price,$sufix,$keysearch)
			{
			
				//echo count($dis);
				// echo count($price);
				//echo $keysearch; 
				for($k=0;$k<count($keysearch);$k++)
				{
				
				
				if($keysearch[$k]!='')
				{
				
				
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($scat=0;$scat<count($scatid);$scat++)
										{
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
													
														$s[] = " `id` ='".$keysearch[$k]."'  and `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand section
										
									}	
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									
									for($scat=0;$scat<count($scatid);$scat++)
										{
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													$s[] = " `id` ='".$keysearch[$k]."'  and `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
										}
										
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										//echo $scatid;
										if(count($scatid)>0)
										{
										for($scat=0;$scat<count($scatid);$scat++)
										{
										
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " `id` ='".$keysearch[$k]."' and `bid` = '".$bid[$b]."' and ".$pquery." and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
														} //end loop for price section
																			
												
											} //end loop for brand section
											
											}
										}
										else
										{
										
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
											for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
											
												$s[] = " `id` ='".$keysearch[$k]."' and `bid` = '".$bid[$b]."' and ".$pquery." ";
											} //end loop for price section
																
									
								} //end loop for brand section
										
										
										
										}	
											
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
										for($scat=0;$scat<count($scatid);$scat++)
											{	
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " `id` ='".$keysearch[$k]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
														} //end loop for price section
													}	//end loop for dicount section							
												
												}
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
										for($scat=0;$scat<count($scatid);$scat++)
										{
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														if($dis[$d]!='undefined')
														{
															$s[] = " `offername` = '".$dis[$d]."'  and `id` ='".$keysearch[$k]."' and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";													
														}
														else
														{
															
															if($scatid[$scat]!='undefined')
															{
																$s[] = " `id` ='".$keysearch[$k]."' and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
															}
															else
															{
																$s[] = " `id` ='".$keysearch[$k]."'";
															
															}													
														}
														
													
													}	//end loop for dicount section							
												
											}	
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
										if(count($scatid) > 0)
										{		
										for($scat=0;$scat<count($scatid);$scat++)
										{	
										
										
											for($p=0;$p<count($price);$p++)
												{ //start loop for price section
													if($price[$p]=='above10000')
													{
														$pquery="`sellingprice` > '10000' and (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%') ";	
													}
													else
													{
														$price2=explode("~",$price[$p]);
														$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')  and (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%') ";															
													}
												
												
											
													$s[] = " ".$pquery." and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
											} //end loop for price section						
										
										}	
										
										}
										else
										{
											for($p=0;$p<count($price);$p++)
												{ //start loop for price section
													if($price[$p]=='above10000')
													{
														$pquery="`sellingprice` > '10000' and `id` ='".$keysearch[$k]."' ";	
													}
													else
													{
														$price2=explode("~",$price[$p]);
														$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')  and (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%') ";															
													}
												
												
											
													$s[] = " ".$pquery." ";
											} //end loop for price section	
										
										
										
										}
											
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										if(count($scatid) > 0)
										{		
										for($scat=0;$scat<count($scatid);$scat++)
										{
											for($b=0;$b<count($bid);$b++)
											{
										
												$s[] = " `bid` = '".$bid[$b]."'  and  (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%') and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";
											}
										}	
											
										}	
										else
										{
										
											for($b=0;$b<count($bid);$b++)
											{
										
												$s[] = " `bid` = '".$bid[$b]."'  and  (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%') ";
											}
										
										}		
									}
								
								elseif(count($scatid)!=0)
									{
										//echo count($scatid);
										for($scat=0;$scat<count($scatid);$scat++)
										{
											if($scatid[$scat]!='undefined')
											{
												$s[] = " (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%') and (`cat_id` = '".$scatid[$scat]."' || `subcat_id` = '".$scatid[$scat]."' || `subsubcat_id` = '".$scatid[$scat]."') ";	
											
											}
											else
											{
												$s[] = " (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%')";	
											
											}
											
										 
										 }
									}
								
								else
								{
									
									$s[] = " (`productname` LIKE '%".$keysearch[$k]."%' || `sku` LIKE '%".$keysearch[$k]."%' || `barcode` LIKE '%".$keysearch[$k]."%')";
											
								}
								
							} //end if condition
							
							
							
						}		
			
					return $s;
				}
			
			
			
			
			function subsubcatquery($catid,$bid,$dis,$price,$sufix)
			{
			
				//echo $catid;
				//echo count($catid);
				for($c=0;$c<count($catid);$c++)
				{				
					//echo $catid[$c];
					if($catid[$c]!=0)
						  { //start category condition
						 	 if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}	
															
													//if($dis[$d]!='undefined')
														//{
															$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														
														//}
														//else
														//{
															//$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." and `cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."' ";
														//}
													
														
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													if($dis[$d]!='undefined')
														{
															$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														
														}
														else
														{
															$s[] = " `bid` = '".$bid[$b]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														}
													
													
													
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";
															
															}	
														
															$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
															
														if($dis[$d]!='undefined')
														{
															$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														
														}
														else
														{
															$s[] = " ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														
														}
															
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														if($dis[$d]!='undefined')
														{
															$s[] = " `offername` = '".$dis[$d]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														
														}
														else
														{
															$s[] = " (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														
														}
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
													{
														$pquery="`sellingprice` > '10000'";
													}
													else
													{
														$price2=explode("~",$price[$p]);
														$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
													}
											
												$s[] = " ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
												if($catid[$c]!='undefined')
													{
											 		$s[] = " `bid` = '".$bid[$b]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
													}
													else
													{
														$s[] = " `bid` = '".$bid[$b]."' ";
													
													}
													
										}
									}
								
								
								
								else
								{
									$s[] = " (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
								
								}
								
						}	//end category condition if catid is not equal to zero
						
						else
						{
						
						
						if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
													
														$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														
															$s[] = " `offername` = '".$dis[$d]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
											
												$s[] = " ".$pquery." and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
									
											if($catid[$c]!='undefined')
													{
											 		$s[] = " `bid` = '".$bid[$b]."' and (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
													}
													else
													{
														$s[] = " `bid` = '".$bid[$b]."' ";
													
													}
										}
									}
								
								
								
								else
								{
									$s[] = " (`cat_id` = '".$catid[$c]."' || `subcat_id` = '".$catid[$c]."' || `subsubcat_id` = '".$catid[$c]."') ";
								
								}
								
						}	//end category condition for catid 0		
				
					
				}
				
				//$s[]
				//$s=array(" and offername!=''",$s);
				//$s[]=$s. " and offername!='' ";
		//	echo $s;
				return $s;
				
			
			}
			
			
			
			function subcatquery($scatid,$bid,$dis,$price,$sufix)
			{
			
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
													
														$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														
															$s[] = " `offername` = '".$dis[$d]."' and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
											
												$s[] = " ".$pquery." and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
									
											$s[] = " `bid` = '".$bid[$b]."' and (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
										}
									}
								
								
								
								else
								{
									 $s[] = " (`cat_id` = '".$scatid."' || `subcat_id` = '".$scatid."' || `subsubcat_id` = '".$scatid."') ";
								
								}
			
			
				return $s;
			
			}
			
			
			
			function subcatquery2($scatid,$bid,$dis,$price,$sufix)
			{
				//echo $scatid;
				for($c=0;$c<count($scatid);$c++)
				{
				
				
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
															if($scatid!='')
															{
													
														$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."') ";
														}
														else
														{
															$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
														
														}
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													if($scatid!='')
													{
														
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
													
													}
													else
													{
																											
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' ";
													}
													
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														if($scatid!='')
														{
															$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
														}
														else
														{
														
														$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." ";
														}
														
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
																
																if($scatid!='')
																{
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
																		
																}
																else
																{
																
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." ";
																}	
														
														
														
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														if($scatid!='')
															{
																$s[] = " `offername` = '".$dis[$d]."' and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
																	
															}
															else
															{
															
																$s[] = " `offername` = '".$dis[$d]."'";
															}	
															
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
												if($scatid!='')
												{
														$s[] = " ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
														
												}
												else
												{
												
													$s[] = " ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
												}		
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
											if($scatid!='')
											{
												$s[] = " `bid` = '".$bid[$b]."' and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
											}
											else
											{
												$s[] = " `bid` = '".$bid[$b]."' ";
											
											}	
										}
									}
								
								
								
								else
								{
									 $s[] = " (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."') ";
								
								}
			
				}
			//echo $s;
				return $s;
			
			}
			
			
			function brandquery($catid,$bid,$dis,$price,$sufix)
			{
				//echo $catid;
				
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
														{
															$pquery="`sellingprice` > '10000'";
														}
														else
														{
															$price2=explode("~",$price[$p]);
															$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
														}
														if($catid!='')
														{
															$s[] = " `cat_id` = '".$catid."' and `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
														}
														else
														{
															$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
														
														}	
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													if($catid!='')
													{
													
														$s[] = " `cat_id` = '".$catid."' and `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' ";
													
													}
													else
													{
													
														$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' ";
													}
													
													
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															if($catid!='')
																{
																	$s[] = " `cat_id` = '".$catid."' and `bid` = '".$bid[$b]."' and ".$pquery." ";
																}
																else
																{
																	$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." ";
																
																}	
															
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														
															if($catid!='')
																{
																	$s[] = " `cat_id` = '".$catid."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
																}
																else
																{
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." ";
																
																}	
															
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														if($catid!='')
																{
																	$s[] = " `cat_id` = '".$catid."' and `offername` = '".$dis[$d]."' ";
																}
																else
																{
																	$s[] = " `offername` = '".$dis[$d]."' ";
																
																}	
															
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
												
												if($catid!='')
													{
														$s[] = " `cat_id` = '".$catid."' and ".$pquery." ";
													}
													else
													{
														$s[] = "  and ".$pquery." ";
													
													}
								
												
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
									
										 if($catid!='')
												{
													 $s[] = " `cat_id` = '".$catid."' and `bid` = '".$bid[$b]."' ";
												}
												else
												{
													 $s[] = " `bid` = '".$bid[$b]."' ";
												
												}
										}
									}
								
								
								
								else
								{
									
									
									$s[] = " `cat_id` = '".$catid."' ";
								
								}
						
							
						
						
						return $s;
						
						}
			
			
			
			
					
			function productliststrip($sqlproduct5,$sufix)
			{
				
				while($rowitem=$this->fetchassoc($sqlproduct5))
				{
				
					 if($rowitem['offername']!='') 
					 { 
					 	//echo "select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."'";
					 	$offerquery=$this->sqlquery("select * from `".$sufix."offers` where id='".$rowitem['offername']."' and displayflag='1' and validto>='".date("Y-m-d")."'");
					 	
						$numoffer=$this->num($offerquery);
						$rowoffer=$this->fetchassoc($offerquery);
							
					 
					 }
				
					
				
				?>
					<li>
					 <table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center"><img src="productimage/small/<?php $this->productimage($sufix,$rowitem['productid']) ; ?>" width="110" height="119" /></td>
						  </tr>
						  <tr>
							<td class="pad_2"><table width="165px" border="0" cellspacing="0" cellpadding="0" >
								<tr>
								  <td class="pad_1 pro-heading"  align="center">
								  <?php echo $this->substrword5($rowitem['productname'], 20); ?>&nbsp;&nbsp;</td>
								</tr>
								<tr>
								  <td class="pad_1 pro-txt" align="center">
								  	<?php if($rowitem['offername']!='' or $numoffer > 0) { ?><div class="rs"><?php echo Currency." ".$rowitem['sellingprice']; ?></div><div class="strike"><?php echo $rowitem['mrp']; ?></div><div class="yellow"><?php echo $rowoffer['offername']; ?></div><?php }  else { ?><div class="rs"><?php echo Currency." ".$rowitem['mrp']; ?></div><?php } ?>
								  
								  <!--<div> <span style="color:#FF0000;"><?php //echo Currency; ?> <?php //echo $rowitem['sellingprice']; ?></span></div>-->
								  
								  </td>
								</tr>
								
							</table></td>
						  </tr>
						</table>
					</li>
			<?php } 
			
			}
			
			
			function leftkeyword($sufix,$type,$pagename,$catid,$subcatid,$bid,$ksearch,$slug)
			{
			
				//echo $pagename;
				
				$query=new query();
				//echo $subcatid;
				$num=count($subcatid);
				//echo $subcatid; 
				if($type=='Sub-SubCategory')
				{ 
				
				if($num > 0)
				{
				
								
				?>
				<div class="portlet">
				<div class="portlet-header filter-heading">By Subcategory</div>						 
					<div class="portlet-content"><div id="scroll">
					<div id="scrollcontent"> 
							
							<input name="category" id="category" type="hidden" value="" />
							
							<input name="category2" id="category2" type="hidden" value="" />
							
							
							 <table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
								<?php
								$c=1;
								
								//echo count($subcatid); 
									for($a=0;$a<=count($subcatid);$a++)
									{
									
										//echo "select * from `".$sufix."category` `a` where a.displayflag='1' and a.parent='".$subcatid[$a]."'";
										if($subcatid[$a]!='')
										{
											$sql2="select * from `".$sufix."category` `a` where a.displayflag='1' and a.parent='".$subcatid[$a]."'";
										
										}
										
										$sql=mysqli_query($sql2) ;
										//$sql=mysqli_query($conn,"select * from `".$sufix."category` `a` where a.displayflag='1' and a.parent='".$subcatid[$a]."'") ;
										
									 	
										while($rows=mysqli_fetch_array($sql))
										{
											
											//echo "select categoryname,pagename,id from `".$sufix."product` `a`, `".$sufix."category` `b` where a.subsubcat_id='".$rows['cat_id']."' and a.subsubcat_id=b.cat_id and productname LIKE '%".$_REQUEST['ksearch']."%'";
											
											$sqlproduct=mysqli_query($conn,"select categoryname,pagename,id from `".$sufix."product` `a`, `".$sufix."category` `b` where a.subcat_id='".$subcatid[$a]."' and a.subsubcat_id='".$rows['cat_id']."' and a.subsubcat_id=b.cat_id and (a.productname LIKE '%".$_REQUEST['ksearch']."%' || a.sku LIKE '%".$_REQUEST['ksearch']."%' || a.barcode LIKE '%".$_REQUEST['ksearch']."%') and stockavailability='Instock'");
											$sqlproduct2=mysqli_query($conn,"select categoryname,pagename,id from `".$sufix."product` `a`, `".$sufix."category` `b` where a.subcat_id='".$subcatid[$a]."' and a.subsubcat_id='".$rows['cat_id']."' and a.subsubcat_id=b.cat_id and (a.productname LIKE '%".$_REQUEST['ksearch']."%' || a.sku LIKE '%".$_REQUEST['ksearch']."%' || a.barcode LIKE '%".$_REQUEST['ksearch']."%') and stockavailability='Instock'");
											
											
											$numproduct=mysqli_num_rows($sqlproduct);
											if($numproduct>0)
											{
											
											// $sql2=mysqli_query($conn,"select * from ".$sufix."category where displayflag='1' and parent='".$subcatid[$a]."'") ;
												while($rows2=mysqli_fetch_array($sqlproduct2))
												{	
													$pid=$pid."~".$rows2['id'];	
												}
												
												$rows3=mysqli_fetch_array($sqlproduct);		
								?>			
								
								<tr>
									<td width="7%">
										
										<input name="catid_<?php echo $c; ?>" id="catid_<?php echo $c; ?>" type="hidden" value="<?php echo  $rows3['pagename']; ?>" />
										<input type="checkbox" name="cat_<?php echo $c; ?>" id="cat_<?php echo $c; ?>"  value="<?php echo $rows['cat_id']; ?>" class="sortcategory"/></td>
									<td width="93%" class="pad_left5"><font color="#000000"><?php echo $rows3['categoryname']; ?> (<?php echo $numproduct; ?>)</font></td>
								  </tr>	
								<?php 
									
								$c++;
								}
								
								}
								}
								
								
								 ?>	
								 
								 <!--<input name="total" id="total" type="text" value="<?php //echo $c; ?>" />-->
									
							   </table>
							</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>	
					<?php 
					}
					
					else
					{
					?>
					
					<div class="portlet">
				<div class="portlet-header filter-heading">By Subcategory</div>						 
					<div class="portlet-content"><div id="scroll">
					<div id="scrollcontent"> 
							<input name="category" id="category" type="hidden" value="" />
							<input name="category2" id="category2" type="hidden" value="<?php echo $catid; ?>" />
							
							 <table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
								<?php
								$c=1;
									
										
											$mystring = $pagename;
											$findme   = 'category';
											$poscat = strpos($mystring, $findme);
											
											$findme2   = 'submenu_cat';
											$possubcat = strpos($mystring, $findme2);
											//echo $catid;
											if($poscat!==false)
											{
												//echo "select cat_id from ".$sufix."category where displayflag='1' and parent='".$catid."'";
												$sql=mysqli_query($conn,"select * from ".$sufix."category where displayflag='1' and parent='".$catid."'") ;
											
											}
											elseif($possubcat!==false)
											{
												//echo "select cat_id from ".$sufix."category where displayflag='1' and parent='".$catid."'";
												$sql=mysqli_query($conn,"select * from ".$sufix."category where displayflag='1' and parent='".$catid."'") ;
											
											}
											else
											{
												//echo "select cat_id from ".$sufix."category where displayflag='1' and cat_id='".$catid."'";
												$sql=mysqli_query($conn,"select * from ".$sufix."category where displayflag='1' and cat_id='".$catid."'") ;
											
											}
										
										
										
										while($rowcat=mysqli_fetch_array($sql))
										{
										
										
											
											//echo "select id from `".$sufix."product` where subcat_id='".$rows['cat_id']."'";
											
											$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where cat_id='".$catid."' || subcat_id='".$catid."' || subsubcat_id='".$catid."'");
											$numproduct=mysqli_num_rows($sqlproduct);
											if($numproduct > 0)
											{
											//$rows2=mysqli_fetch_array($sql2);				
								?>			
								
								<tr>
									<td width="7%">
									<input name="catid_<?php echo $c; ?>" id="catid_<?php echo $c; ?>" type="hidden" value="<?php echo $rows2['pagename']; ?>" />
									<input type="checkbox" name="cat_<?php echo $c; ?>" id="cat_<?php echo $c; ?>"  value="<?php echo $rowcat['cat_id']; ?>" class="sortcategory"/></td>
									<td width="93%" class="pad_left5"><font color="#000000"><?php echo $rowcat['categoryname']; ?></font></td>
								  </tr>	
								<?php 
								$c++;
								}
								
								
								}
								
								
								 ?>	
									
							   </table>
							</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>
					
					
				<?php	
					}
				
				}
				
				
				
				if($type=='Brand')
				{ 
				
				
				$mystring5 = $pagename;
				$findme5   = 'category';
				$pos5 = strpos($mystring5, $findme5);
		
				if($pos5!==false)
				{
				
					?>	
					
						<div class="portlet">
				<div class="portlet-header filter-heading">By Brand</div>						 
					<div class="portlet-content"><div id="scroll">
					<div id="scrollcontent"> 
									<input name="brand" id="brand" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php	
									$b=1;
									
									
										$sql=mysqli_query($conn,"select * from ".$sufix."brand `a`, ".$sufix."category_brand `b`  where b.bdisplayflag='1' and b.catid='".$catid."' and a.bid=b.brandid order by a.sortid asc") ;
										
									
									while($rowbrand=mysqli_fetch_array($sql))
										{							
											$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where bid='".$rowbrand['bid']."'");
											$numproduct=mysqli_num_rows($sqlproduct);			
										?>
									  	<tr>
											<td width="7%"><input type="checkbox" name="brand_<?php echo $b; ?>" id="brand_<?php echo $b; ?>" value="<?php echo $rowbrand['bid']; ?>" class="sortbrand"/></td>
											<td width="93%" class="pad_left5"><?php echo $rowbrand['brandname']; ?></td>
									  </tr>
									 <?php 
									 $b++;
									 
									 }
									 
									
									 
									?>
									</table>
								</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>
					
					
				<?php	
				
				
				
				
				}
				elseif($bid!='')
				{
				
				?>
					<div class="portlet">
				<div class="portlet-header filter-heading">By Brand</div>						 
					<div class="portlet-content"><div id="scroll">
					<div id="scrollcontent"> 					
								   <input name="category" id="category" type="hidden" value="<?php echo $catid[1]; ?>" />
								   <input name="catid" id="catid" type="hidden" value="<?php echo $pagename; ?>" />
								
								  <input name="brand" id="brand" type="hidden" value="" /> 
									<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php	
									$b=1;
									for($a=0;$a<count($bid);$a++)
									{
									if($bid[$a]!='')
									{
										//echo "select * from ".$sufix."category where displayflag='1' and cat_id='".$catid[$a]."'";
										$sql=mysqli_query($conn,"select * from ".$sufix."brand where displayflag='1' and bid='".$bid[$a]."'") ;
										
									}
									if($rowbrand=mysqli_fetch_array($sql))
										{							
									
													
													$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where bid='".$rowbrand['bid']."'");
													$numproduct=mysqli_num_rows($sqlproduct);			
										?>
									  	<tr>
											<td width="7%"><input type="checkbox" name="brand_<?php echo $b; ?>" id="brand_<?php echo $b; ?>" value="<?php echo $rowbrand['bid']; ?>" class="sortbrand"/></td>
											<td width="93%" class="pad_left5"><?php echo $rowbrand['brandname']; ?></td>
									  </tr>
									 <?php 
									 $b++;
									 
									 }
									 
									 } ?>
							</table>
						</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>	
				<?php	
					 //end num brand	
							
				} 
				else
				{
				?>
				<input name="brand" id="brand" type="hidden" value="" /> 
				
				<?php
				
				}
				
				}
				 //end the type of brand
				
				
			
				
				
				if($type=='Discount')
				{ //start the type of discount 
				
				//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
				$sqloffer=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
				$sqloffer2=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
				$numoffer=mysqli_num_rows($sqloffer);
				
				if($numoffer > 0)
					{ //start num brand 
					
						while($rowoffer=mysqli_fetch_assoc($sqloffer))
						{
						
						if ($pos !== false) 
							{
								$selvalue="";
								$group="";
								$where=" subcat_id='".$catid[1]."' and offername='".$rowoffer['id']."'";
							}
							elseif($pos2 !== false)
							{
								$selvalue="";
								$group="";
								$where=" bid='".$catid[1]."' and offername='".$rowoffer['id']."' ";
							
							}
							else
							{
								$selvalue="";
								$group="";
								$where=" subsubcat_id='".$catid[1]."' and offername='".$rowoffer['id']."' ";
								//$orderby="order by id desc";
							
							}
						
						$sql=$this->productquery($sufix, $where,$selvalue,$group) ;
						
						$sqlproduct=mysqli_query($conn,$sql);
						$numproduct=mysqli_num_rows($sqlproduct);												
						
						if($numproduct > 0)
						{
											
							$numval=$numproduct;
							
							}
						}	
					//echo $numval;		
											
					if($numval > 0)
					{					
											
						
					
					?>	
						<div class="portlet">
				<div class="portlet-header filter-heading">By Discount</div>						 
					<div class="portlet-content"><div id="scroll">
					<div id="scrollcontent"> 	
								<input name="discount" id="discount" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php
										$dc=1;
										while($rowoffer=mysqli_fetch_assoc($sqloffer2))
											{
												
												if ($pos !== false) 
													{
														$selvalue="";
														$group="";
														$where=" subcat_id='".$catid[1]."' and offername='".$rowoffer['id']."'";
													}
													elseif($pos2 !== false)
													{
														$selvalue="";
														$group="";
														$where=" bid='".$catid[1]."' and offername='".$rowoffer['id']."' ";
													
													}
													else
													{
														$selvalue="";
														$group="";
														$where=" subsubcat_id='".$catid[1]."' and offername='".$rowoffer['id']."' ";
														//$orderby="order by id desc";
													
													}
												
												$sql=$this->productquery($sufix, $where,$selvalue,$group) ;
												
												$sqlproduct=mysqli_query($conn,$sql);
												$numproduct=mysqli_num_rows($sqlproduct);												
												
												if($numproduct > 0)
												{ //
													
																
										?>			
								
									  	<tr>
											<td width="7%"><input type="checkbox" name="discount_<?php echo $dc; ?>" id="discount_<?php echo $dc; ?>" value="<?php echo $rowoffer['id']; ?>" class="sortdiscount" /></td>
											<td width="93%" class="pad_left5"><?php echo $rowoffer['offername']; ?> </td>
									  </tr>
									 <?php }
									 	
										$dc++;
									 }
									 
									  ?>
									</table>
								</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>
					
				<?php
				
					} //end the numvalue
					
					else
					{
					?>
						<h3 style="display:none;"></h3><input name="discount" id="discount" type="hidden" value="" />
					
					
					<?php
					
					}
						
					} //end num brand	
							
				
				} //end the type of discount
				
				
				if($type=='Price')
				{ //start the type of price 
				
				//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
				
				
				/*if($rowproduct2=mysqli_fetch_assoc($sqlproduct2))
				{	
					$minprice= $rowproduct2['MIN(sellingprice)'];
				
				}
				//.
				
				$numproduct=mysqli_num_rows($sqlproduct);
				if($numproduct > 0)
					{*/ //start num brand
					
				?>	
					<div class="portlet">
				<div class="portlet-header filter-heading">By Price</div>						 
					<div class="portlet-content"><div id="scroll">
					<div id="scrollcontent">
							
								<input name="price" id="price" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									  	<tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1~50" class="sortprice" /></td>
											<td width="93%" class="pad_left5">1 to 50
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="50~100" class="sortprice" /></td>
											<td width="93%" class="pad_left5">50 to 100
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="100~200" class="sortprice" /></td>
											<td width="93%" class="pad_left5">100 to 200
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="200~500" class="sortprice" /></td>
											<td width="93%" class="pad_left5">200 to 500
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="500~1000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">500 to 1000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1000~10000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">1000 to 10000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="above10000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">Above 10000
												</td>
										  </tr>
									 <?php //} 
									 //}
									 ?>
									</table>
								</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>
							
					
				<?php	
					//} //end num brand	
							
				
				} //end the type of price 
				
				
			}	
				
			
			
			
			
			function keywordsearch($sufix)
			{
			
			
				//$sql=mysqli_query($conn,"$sqlp." and subcat_id='".$catid[1]."'");
				//$query=new query();
				//echo "select bid from ".$sufix."brand where displayflag='1' and brandname LIKE '%".$_REQUEST['ksearch']."%' order by bid desc";
									
				/*$sqlp=mysqli_query($conn,"select bid from ".$sufix."brand where displayflag='1' and brandname LIKE '%".$_REQUEST['ksearch']."%' order by bid desc");	
				$num=mysqli_num_rows($sqlp);
				if($num>0)
				{
						$s = "select bid from ".$sufix."brand where displayflag='1' and brandname LIKE '%".$_REQUEST['ksearch']."%' order by bid desc";
				
				} 
				else
				{*/
					//echo "select cat_id from ".$sufix."category where displayflag='1' and categoryname LIKE '%".$_REQUEST['ksearch']."%'";
					$sqlp=mysqli_query($conn,"select cat_id,cat_type,pagename,cat_slug from ".$sufix."category where displayflag='1' and categoryname = '".$_REQUEST['ksearch']."'");	
					$num=mysqli_num_rows($sqlp);
					if($num>0)
					{
						while($row=mysqli_fetch_array($sqlp))
						{					
							if($row['cat_type']=='category')
							{
								$pagename=$row['pagename'];
								$cat_id=$row['cat_id'];
								$slug=$row['cat_slug'];
								$s = "select * from ".$sufix."product where displayflag='1' and cat_id ='".$row['cat_id']."' || subcat_id='".$row['cat_id']."' || subsubcat_id='".$row['cat_id']."'";				
							
							}
							if($row['cat_type']=='subcategory')
							{
								$pagename=$row['pagename'];
								$cat_id=$row['cat_id'];
								$slug=$row['cat_slug'];
								$s = "select * from ".$sufix."product where displayflag='1' and cat_id ='".$row['cat_id']."' || subcat_id='".$row['cat_id']."' || subsubcat_id='".$row['cat_id']."'";				
							
							}
							if($row['cat_type']=='sub-subcategory')
							{
								$pagename=$row['pagename'];
								$cat_id=$row['cat_id'];
								$slug=$row['cat_slug'];
								$s = "select * from ".$sufix."product where displayflag='1' and cat_id ='".$row['cat_id']."' || subcat_id='".$row['cat_id']."' || subsubcat_id='".$row['cat_id']."'";				
							
							}
							
								
						}
					
					}
					else
					{ 
						///echo "select id from ".$sufix."product where displayflag='1' and productname LIKE '%".$_REQUEST['ksearch']."%'"; 
						$sqlp=mysqli_query($conn,"select id from ".$sufix."product where displayflag='1' and (productname LIKE '%".$_REQUEST['ksearch']."%' || sku LIKE '%".$_REQUEST['ksearch']."%' || barcode LIKE '%".$_REQUEST['ksearch']."%' || id LIKE '%".$_REQUEST['ksearch']."%')");	
						$num=mysqli_num_rows($sqlp);
						if($num>0)
						{							
							$s ="select * from ".$sufix."product where displayflag='1' and (productname LIKE '%".$_REQUEST['ksearch']."%' || sku LIKE '%".$_REQUEST['ksearch']."%' || barcode LIKE '%".$_REQUEST['ksearch']."%'  || id LIKE '%".$_REQUEST['ksearch']."%')";						
							$pagename="product";
												
						}
						else
						{
						echo "No Result Found";
						}
					}
				
				//}
				
					
					//echo $s[] = "`".$catval."` = '".$cattype."'"; 
					
				return array($s,$cat_id,$pagename,$slug);
				
			}
				
				
			function brandsearch($sufix)
			{
				if($_REQUEST['ref']=='brandoffer')
				{
					
					
					$s ="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and `bid` ='".$_REQUEST['brand']."' and offername!='' order by id asc";	
						
				}
				else
				{
					$s ="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and `bid` ='".$_REQUEST['brand']."' order by id asc";				
				
				}												
				
					//echo $s;
				return $s;
				
			}
			
			
			function offersearch($sufix)
			{
				if($_REQUEST['refdesc']=='discount')
				{
					
					
					$s ="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0' and offername!=''";	
						
				}
				else
				{
					$s ="select * from ".$sufix."product where displayflag='1' and stockavailability='Instock' and sellingprice!='0'";				
				
				}												
				
					//echo $s;
				return $s;
				
			}
				
				
				
			function leftbrand($sufix,$type)
			{
			
				//echo $pagename;
				
				$query=new query();
			
				if($type=='Sub-SubCategory')
				{ 
				
				
				$sqlbrand=mysqli_query($conn,"select distinct(catid) from ".$sufix."brand `a`, ".$sufix."category_brand `b`  where b.bdisplayflag='1' and a.bid='".$_REQUEST['brand']."' and a.bid=b.brandid order by a.sortid asc") ;
				
				
				$num=mysqli_num_rows($sqlbrand);
				if($num > 0)
				{
				
								
				?>
				<div class="portlet">
					<div class="portlet-header filter-heading">Subcategory Name</div>
					<div class="portlet-content"><div id="scroll">
				<div id="scrollcontent"> 
							<input name="brand" id="brand" type="hidden" value="<?php echo $_REQUEST['brand']; ?>" /> 
							
							<input name="category" id="category" type="hidden" value="" />
							<input name="catid" id="catid" type="hidden" value="" />
							<input name="category2" id="category2" type="hidden" value="" />
							
							 <table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
								<?php
								$c=1;
								
								//echo count($subcatid);
									while($rows= mysqli_fetch_assoc($sqlbrand))
									{
									
																			
										$sql=mysqli_query($conn,"select * from `".$sufix."category` `a` where a.displayflag='1' and a.parent='".$rows['catid']."'") ;
										//$sql=mysqli_query($conn,"select * from `".$sufix."category` `a` where a.displayflag='1' and a.parent='".$subcatid[$a]."'") ;
										
									 	
										while($rows=mysqli_fetch_array($sql))
										{
											//echo "select cat_id from `".$sufix."category` `b` where a.parent='".$rows['cat_id']."'";
											$sqlproduct=mysqli_query($conn,"select cat_id from `".$sufix."category` `b` where b.parent='".$rows['cat_id']."'");
											
												while($rows2=mysqli_fetch_array($sqlproduct))
												{	
													
														$sqlproduct2=mysqli_query($conn,"select categoryname,pagename,id,subsubcat_id from `".$sufix."product` `a`, `".$sufix."category` `b` where a.subsubcat_id='".$rows2['cat_id']."' and a.bid='".$_REQUEST['brand']."' and a.subsubcat_id=b.cat_id");
														
														$numproduct=mysqli_num_rows($sqlproduct2);
														if($numproduct > 0)
														{
												
															$rows3=mysqli_fetch_array($sqlproduct2);		
								?>			
								
								<tr>
									<td width="7%">
										
										
										<input type="checkbox" name="cat_<?php echo $c; ?>" id="cat_<?php echo $c; ?>"  value="<?php echo $rows3['subsubcat_id']; ?>" class="sortcategory"/></td>
									<td width="93%" class="pad_left5"><font color="#000000"><?php echo $rows3['categoryname']; ?></font></td>
								  </tr>	
								<?php 
									
								$c++;
								
									}
								}
								
								
								}
								
								}
								
								 ?>	
								 
								 <!--<input name="total" id="total" type="text" value="<?php //echo $c; ?>" />-->
									
							   </table>
							</div>
						<div id="scrollbar">
						  <div id="scroller" class="scroller"></div>
						</div>
					  </div></div>
						</div>
					<?php 
					}
					
					
				
				}
				
				
				
				
				if($type=='Discount')
				{ //start the type of discount 
				
				//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
				$sqloffer=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
				$sqloffer2=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
				$numoffer=mysqli_num_rows($sqloffer);
				
				if($numoffer > 0)
					{ //start num brand 
					
						while($rowoffer=mysqli_fetch_assoc($sqloffer))
						{
						
						
								$selvalue="";
								$group="";
								$where=" bid='".$_REQUEST['brand']."' and offername='".$rowoffer['id']."' ";
								//$orderby="order by id desc";
							
						
						
						$sql=$this->productquery($sufix, $where,$selvalue,$group) ;
						
						$sqlproduct=mysqli_query($conn,$sql);
						$numproduct=mysqli_num_rows($sqlproduct);												
						
						if($numproduct > 0)
						{
											
							$numval=$numproduct;
							
							}
						}		
											
					if($numval > 0)
					{					
											
						
					
					?>	
						<div class="portlet">
					<div class="portlet-header filter-heading">By Discount</div>
					<div class="portlet-content"><div id="scroll">
				<div id="scrollcontent"> 
								<input name="discount" id="discount" type="hidden" value="" /> 
								
								<input name="category2" id="category2" type="hidden" value="" />
								
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php
										$dc=1;
										
										
										while($rowoffer=mysqli_fetch_assoc($sqloffer2))
											{
												
												
												
														$selvalue="";
														$group="";
														$where=" bid='".$_REQUEST['brand']."' and offername='".$rowoffer['id']."' ";
														//$orderby="order by id desc";
													
													
												
												$sql=$this->productquery($sufix, $where,$selvalue,$group) ;
												
												$sqlproduct=mysqli_query($conn,$sql);
												$numproduct=mysqli_num_rows($sqlproduct);												
												
												if($numproduct > 0)
												{ //
													
																
										?>			
								
									  	<tr>
											<td width="7%"><input type="checkbox" name="discount_<?php echo $dc; ?>" id="discount_<?php echo $dc; ?>" value="<?php echo $rowoffer['id']; ?>" class="sortdiscount" /></td>
											<td width="93%" class="pad_left5"><?php echo $rowoffer['offername']; ?> </td>
									  </tr>
									 <?php }
									 	
										$dc++;
									 }
									 
									  ?>
									</table>
								</div>
							<div id="scrollbar">
							  <div id="scroller" class="scroller"></div>
							</div>
						  </div></div>
							</div>	
					
				<?php
				
					} //end the numvalue
						
					} //end num brand	
							
				
				} //end the type of discount
				
				
				if($type=='Price')
				{ //start the type of price 
				
				//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
				
				
				/*if($rowproduct2=mysqli_fetch_assoc($sqlproduct2))
				{	
					$minprice= $rowproduct2['MIN(sellingprice)'];
				
				}
				//.
				
				$numproduct=mysqli_num_rows($sqlproduct);
				if($numproduct > 0)
					{*/ //start num brand
					
				?>	
						<div class="portlet">
							<div class="portlet-header filter-heading">By Price</div>
							<div class="portlet-content"><div id="scroll">
						<div id="scrollcontent"> 
								<input name="price" id="price" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									  	<tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1~50" class="sortprice" /></td>
											<td width="93%" class="pad_left5">1 to 50
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="50~100" class="sortprice" /></td>
											<td width="93%" class="pad_left5">50 to 100
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="100~200" class="sortprice" /></td>
											<td width="93%" class="pad_left5">100 to 200
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="200~500" class="sortprice" /></td>
											<td width="93%" class="pad_left5">200 to 500
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="500~1000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">500 to 1000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1000~10000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">1000 to 10000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="above10000" class="sortprice" /></td>
											<td width="93%" class="pad_left5">Above 10000
												</td>
										  </tr>
									 <?php //} 
									 //}
									 ?>
									</table>
								</div>
							<div id="scrollbar">
							  <div id="scroller" class="scroller"></div>
							</div>
						  </div></div>
							</div>	
					
				<?php	
					//} //end num brand	
							
				
				} //end the type of price 
				
				
			}	
				
				
			
		function offerleft($sufix,$type)
		{
			
			$query=new query();		
			if($type=='Sub-SubCategory')
			{
			//
				$sql=mysqli_query($conn,"select * from `".$sufix."category` where cat_type='sub-subcategory'");
			
			
			$num=mysqli_num_rows($sql);
			if($num > 0)
			{
				
								
				?>
				<div style="width:191px;" class="bottom_bdr pad_2 filter-heading">By Subcategory</div>
						<div id="scroll">
							<div id="scrollcontent"> 
							<input name="category" id="category" type="hidden" value="" />
							<input name="catid" id="catid" type="hidden" value="" />
							
							<input name="category2" id="category2" type="hidden" value="<?php echo $catid[1]; ?>" />
							 <table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
								<?php
								$c=1;
									while($rows=mysqli_fetch_assoc($sql))
										{
										
											//$sqlcat=mysqli_query($conn,"select id from `".$sufix."product` where subcat_id='".$rowscat['parent']."'");
											
											$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where subsubcat_id='".$rows['cat_id']."' and offername!=''");
											$numproduct=mysqli_num_rows($sqlproduct);
											if($numproduct > 0)
														{					
								?>			
								
								<tr>
									<td width="7%"><input type="checkbox" name="cat_<?php echo $c; ?>" id="cat_<?php echo $c; ?>"  value="<?php echo $rows['cat_id']; ?>" class="sortcategory"/></td>
									<td width="93%" class="pad_left5"><font color="#000000"><?php echo $rows['categoryname']; ?> (<?php echo $numproduct; ?>)</font></td>
								  </tr>	
								<?php 
								$c++;
								}
								} ?>	
									
							   </table>
							</div>
							<div id="scrollbar">
							  <div id="scroller" class="scroller"></div>
							</div>
						  </div></div>
							</div>	
						  <div>&nbsp;</div>
					<?php 
					}
				
				} //end first type of search
				
			if($type=='Brand')
				{ //start the type of brand
				
				//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
				$sqlbrand=mysqli_query($conn,"select * from ".$sufix."brand `a` where a.displayflag='1'");
				$numbrand=mysqli_num_rows($sqlbrand);
				if($numbrand > 0)
					{ //start num brand
					
				?>	
					
						<div><div  style="width:191px;" class="bottom_bdr pad_2 filter-heading"><br />By Brand</div>
							<div id="scroll">
								<div id="scrollcontent">
								
								<input name="category" id="category" type="hidden" value="" />
								<input name="catid" id="catid" type="hidden" value="" />
								
								<input name="brand" id="brand" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php	
									$b=1;							
										while($rowbrand=mysqli_fetch_assoc($sqlbrand))
											{
													
													$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where bid='".$rowbrand['bid']."' and offername!=''");
													$numproduct=mysqli_num_rows($sqlproduct);	
													if($numproduct>0)
													{		
										?>
									  	<tr>
											<td width="7%"><input type="checkbox" name="brand_<?php echo $b; ?>" id="brand_<?php echo $b; ?>" value="<?php echo $rowbrand['bid']; ?>" class="sortbrand"/></td>
											<td width="93%"><?php echo $rowbrand['brandname']; ?></td>
									  </tr>
									 <?php 
									 		}
									 $b++;
									 
									 } ?>
									</table>
								</div>
								<div id="scrollbar">
								  <div id="scroller" class="scroller"></div>
								</div>
							  </div></div>
					
					
					
				<?php	
					} //end num brand	
					
				
				} //end the type of brand
				
				
			
				
				
				if($type=='Discount')
				{ //start the type of discount 
				
				//echo "select * from ".$sufix."brand `a`, ".$sufix."category_brand `b` where a.bid=b.brandid and b.catid='".$parentcatid."'";
				$sqloffer=mysqli_query($conn,"select offername,id from ".$sufix."offers `a` where a.displayflag='1' and a.validto >= '".date("Y-m-d")."'");
				
				$numoffer=mysqli_num_rows($sqloffer);
				if($numoffer > 0)
					{ //start num brand 
					
					
					?>	
						<div><div  style="width:191px;" class="bottom_bdr pad_2 filter-heading"><br />By Discount</div>
							<div id="scroll" style="height:120px;">
								<div id="scrollcontent"> 
								<input name="discount" id="discount" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									<?php
										$dc=1;
										while($rowoffer=mysqli_fetch_assoc($sqloffer))
											{
												
												
												$sqlproduct=mysqli_query($conn,"select id from `".$sufix."product` where offername='".$rowoffer['id']."' and offername!=''");
												$numproduct=mysqli_num_rows($sqlproduct);	
												if($numproduct>0)
												{												
												
												
													
																
										?>			
								
									  	<tr>
											<td width="7%"><input type="checkbox" name="discount_<?php echo $dc; ?>" id="discount_<?php echo $dc; ?>" value="<?php echo $rowoffer['id']; ?>" class="sortdiscount" /></td>
											<td width="93%"><?php echo $rowoffer['offername']; ?> </td>
									  </tr>
									 <?php }
									 	
										$dc++;
									 }
									 
									  ?>
									</table>
								</div>
								<div id="scrollbar">
								  <div id="scroller" class="scroller"></div>
								</div>
							  </div></div>
					
				<?php
				
					} //end numvalue
					else
					{
					
					?>
					
					<input name="discount" id="discount" type="hidden" value="" /> 
					<?php
					}
					
						
					
							
				
				} //end the type of discount
				
				
				if($type=='Price')
				{ //start the type of price 
				
				
					
				?>	
						<div><div  style="width:191px;" class="bottom_bdr pad_2 filter-heading"><br />By Price</div>
							<div id="scroll">
								<div id="scrollcontent"> 
								<input name="price" id="price" type="hidden" value="" /> 
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="filter-txt">
									
								
									  	<tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1~50" class="sortprice" /></td>
											<td width="93%">1 to 50
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="50~100" class="sortprice" /></td>
											<td width="93%">50 to 100
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="100~200" class="sortprice" /></td>
											<td width="93%">100 to 200
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="200~500" class="sortprice" /></td>
											<td width="93%">200 to 500
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="500~1000" class="sortprice" /></td>
											<td width="93%">500 to 1000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="1000~10000" class="sortprice" /></td>
											<td width="93%">1000 to 10000
												</td>
										  </tr>
										  <tr>
											<td width="7%"><input type="checkbox" name="price_1" id="price_1" value="above10000" class="sortprice" /></td>
											<td width="93%">Above 10000
												</td>
										  </tr>
									
									</table>
								</div>
								<div id="scrollbar">
								  <div id="scroller" class="scroller"></div>
								</div>
							  </div></div>
					
				<?php	
					
							
				
				} //end the type of price 
				
				
				
				
				
				}		
			
			
			function searchfilterdiscount($sufix)
				{
						
				//echo $_REQUEST['discount'];
				if($_REQUEST['cat']!='')
				{
				//echo $_REQUEST['cat'];
					$catid=explode(",",$_REQUEST['cat']);
				}
				if($_REQUEST['brand']!='')
				{
					//echo $_REQUEST['brand'];
					$bid=explode(",",$_REQUEST['brand']);
				}
				if($_REQUEST['discount']!='')
				{
					$dis=explode(",",$_REQUEST['discount']);
				}
				if($_REQUEST['price']!='')
				{
					$price=explode(",",$_REQUEST['price']);
				}
				
				//echo $catid;
					
				 $s=$this->offerquery($catid,$bid,$dis,$price,$sufix);
				//echo $s;
				return $s;
				
			}
			
			
			function offerquery($scatid,$bid,$dis,$price,$sufix)
			{
				//echo $scatid;
				if($scatid!='')
				{
				for($c=0;$c<count($scatid);$c++)
				{
				
				
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
															if($scatid!='')
															{
													
														$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."') ";
														}
														else
														{
															$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
														
														}
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													if($scatid!='')
													{
														
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
													
													}
													else
													{
																											
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' ";
													}
													
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														if($scatid!='')
														{
															$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
														}
														else
														{
														
														$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." ";
														}
														
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
																
																if($scatid!='')
																{
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
																		
																}
																else
																{
																
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." ";
																}	
														
														
														
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														if($scatid!='')
															{
																$s[] = " `offername` = '".$dis[$d]."' and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
																	
															}
															else
															{
															
																$s[] = " `offername` = '".$dis[$d]."'";
															}	
															
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
												if($scatid!='')
												{
														$s[] = " ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
														
												}
												else
												{
												
													$s[] = " ".$pquery." and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
												}		
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
											if($scatid!='')
											{
												$s[] = " `bid` = '".$bid[$b]."' and (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."')";
											}
											else
											{
												$s[] = " `bid` = '".$bid[$b]."' ";
											
											}	
										}
									}
								
								
								
								else
								{
									 $s[] = " (`cat_id` = '".$scatid[$c]."' || `subcat_id` = '".$scatid[$c]."' || `subsubcat_id` = '".$scatid[$c]."') ";
								
								}
			
				}
				
				}
				else
				{ //start condition if category is equal to blanck
				
			
				
				if(count($bid)!=0 && count($dis)!=0 && count($price)!=0)
								{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													for($p=0;$p<count($price);$p++)
													{ //start loop for price section
														if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
															if($scatid!='')
															{
													
														$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
														}
														else
														{
															$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' and ".$pquery." ";
														
														}
													} //end loop for price section
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($dis)!=0 )
									{ //start condition for brand
									for($b=0;$b<count($bid);$b++)
									{	//start loop for brand id section			
										
											for($d=0;$d<count($dis);$d++)
												{ //start loop for discount section
													
													if($scatid!='')
													{
														
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."'";
													
													}
													else
													{
																											
													$s[] = " `bid` = '".$bid[$b]."' and `offername` = '".$dis[$d]."' ";
													}
													
													
												}	//end loop for dicount section							
											
										} //end loop for brand sectio
									} //end condition for brand, discount,price		
									
									elseif(count($bid)!=0 && count($price)!=0)
									{ //start condition for brand
										for($b=0;$b<count($bid);$b++)
										{	//start loop for brand id section			
											
												
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
														if($scatid!='')
														{
															$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." ";
														}
														else
														{
														
														$s[] = " `bid` = '".$bid[$b]."' and ".$pquery." ";
														}
														
														} //end loop for price section
																			
												
											} //end loop for brand section
										} //end condition for brand, discount,price		
									
									elseif(count($dis)!=0 && count($price)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														for($p=0;$p<count($price);$p++)
														{ //start loop for price section
															if($price[$p]=='above10000')
															{
																$pquery="`sellingprice` > '10000'";
															}
															else
															{
																$price2=explode("~",$price[$p]);
																$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
															}
																
																if($scatid!='')
																{
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." ";
																		
																}
																else
																{
																
																	$s[] = " `offername` = '".$dis[$d]."' and ".$pquery." ";
																}	
														
														
														
														} //end loop for price section
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
										
									elseif(count($dis)!=0)
									{ //start condition for brand
												
											
												for($d=0;$d<count($dis);$d++)
													{ //start loop for discount section
														
														if($scatid!='')
															{
																$s[] = " `offername` = '".$dis[$d]."' ";
																	
															}
															else
															{
															
																$s[] = " `offername` = '".$dis[$d]."'";
															}	
															
													
													}	//end loop for dicount section							
												
											} //end loop for brand sectio
											
									elseif(count($price)!=0)
									{ //start condition for brand
												
											
										for($p=0;$p<count($price);$p++)
											{ //start loop for price section
												if($price[$p]=='above10000')
												{
													$pquery="`sellingprice` > '10000'";
												}
												else
												{
													$price2=explode("~",$price[$p]);
													$pquery="(`sellingprice` between '".$price2[0]."' and '".$price2[1]."')";															
												}
												if($scatid!='')
												{
														$s[] = " ".$pquery." ";
														
												}
												else
												{
												
													$s[] = " ".$pquery." ";
												}		
											} //end loop for price section						
												
										} //end loop for brand sectio
									
									elseif(count($bid)!=0)
									{
										for($b=0;$b<count($bid);$b++)
										{
											if($scatid!='')
											{
												$s[] = " `bid` = '".$bid[$b]."' ";
											}
											else
											{
												$s[] = " `bid` = '".$bid[$b]."' ";
											
											}	
										}
									}
								
								
								
								else
								{
									 $s[] = " offername!='' ";
								
								}
			
				
				
				
				
				
				
				
				} //end condition if catid is equal to blanck
				
			
				return $s;
			
			}
				
			
			
		
		
} //end class
$search= new Search();	
?>