<?php 
##  PHP AdminPanel                                           	          
##  Developed by:  Pawan Kumar <pavan@exisolutionsgroup.com>   
##  Created Date:  29-Mar 2013 	
##  WebSite:       http://www.exisolutionsgroup.com/		                    
##  Copyright:     Exi Solutions Group@ 2013. All rights reserved. 

class basket{
//start class 
		
		function qty($query)
		{
			$sql=mysqli_query($conn,$query);
			return $sql; 
		}
		
		function invoice($sufix)
		{
				$sbasket=mysqli_query($conn,"select iid from ".$sufix."invoice where orderid='".$oid."' order by iid desc");
				
				$numinvoide=$this->num($sbasket);
			
				if($numinvoide <= 0)
					{	
					
						$row=mysqli_fetch_array($sbasket);
						$iid=$row['iid'];
						
					//$bid=mysql_insert_id(); 
					}
					else
					{
						if($row=mysqli_fetch_array($sbasket))
						{
							$iid=$row['iid']+1;
						}
						else
						{
							$iid=1;
						}
						mysqli_query($conn,"insert into ".$sufix."invoise(`iid`,`adddate`) values ('".$iid."', '".date('Y-m-d')."')") ;
						
					
					}
					
				echo $iid;
			
		
		}
		
		function selectcart($sufix)
		{
			$sql="select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' order by id desc";
			
			$sql2=mysqli_query($conn,$sql);
			
			return $sql2; //
		}
		
		function selectwhishlist($sufix,$id)
		{
			$sql="select * from ".$sufix."whishlist where wid='".$id."'";
			
			$sql2=mysqli_query($conn,$sql);
			
			return $sql2; //
		}
		
		function wcart($sufix,$id)
		{
			
			if($_SESSION['shopid']==0 || $_SESSION['shopid']=="")
				{	
					$sbasket=mysqli_query($conn,"select bid from ".$sufix."basketid order by bid desc");
					if($row=mysqli_fetch_array($sbasket))
					{
						$bid=$row['bid']+1;
					}
					else
					{
						$bid=1;
					}
					mysqli_query($conn,"insert into ".$sufix."basketid(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") ;
					//$bid=mysql_insert_id(); 
					$_SESSION['shopid']=$bid;
				}
				else
				{
					$bid=$_SESSION['shopid']; //
				
				}
			
			
			
			$cartquery=mysqli_query($conn,"select * from ".$sufix."whishlist where wid='".$id."'") ;							
			$Numbasket=$this->num($cartquery);
			if($Numbasket > 0)
			{
				while($rowproduct = mysqli_fetch_array($cartquery))									
				{
					
					mysqli_query($conn,"insert into ".$sufix."basket(`bid`, `productid`, `vproductid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `variantvalue`, `variantname`, `pweight`, `totalweight`, `monthly`) values ('".$bid."', '".$rowproduct['productid']."' , '".$_REQUEST['vproductid']."', '".$rowproduct['cat_id']."', '".$rowproduct['subcat_id']."', '".$rowproduct['subsubcat_id']."', '".$rowproduct['productname']."', '".$rowproduct['productimage']."', '".$rowproduct['slug']."', '".$rowproduct['description']."', '".$rowproduct['sellingprice']."', '".$rowproduct['costprice']."', '".$rowproduct['brand']."', '', '".$rowproduct['subtotal']."', '".$rowproduct['quantity']."', '".$rowproduct['offername']."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['sku']."', '".$rowproduct['variantname']."', '".$rowproduct['variantvalue']."', '".$rowproduct['variantname']."', '".$rowproduct['pweight']."', '".$rowproduct['totalweight']."', '0')") ;	
				
				}
				
				mysqli_query($conn,"delete from ".$sufix."whishlist where wid='".$id."'") ;	
			
			}		
		
		}
		
		
		
		function selectusername($sufix)
		{
			$sql="select fname from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."' and displayflag='1'";
			
			$sql2=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($sql2);
			echo $row['fname']; // 
		}
		
		
		function shipcharge($sufix,$pweight,$cityname)
		{
				
			//echo $pweight;	
			if($cityname=='')
			{
				$sql="select * from ".$sufix."shipping where displayflag='1'";			
			}
			else
			{
				$sql="select * from ".$sufix."shipping where cityname='".$cityname."' and displayflag='1'";			
			}
				
			//echo $sql; 
			$sql2=mysqli_query($conn,$sql); //
			
			$num=$this->num($sql2);
			if($num > 0)
			{
			
					$row=mysqli_fetch_array($sql2);					
					if($pweight > 200)
					{
						$shipcharge1=$row['shipcharge'];
						$shipcharge2=0;
						$wg=($pweight / 200);
						
						for($i=1; $i<=$wg; $i++)
						{
							$shipcharge2=$shipcharge2 + $row['shipcharge2'];
						}
						
						$shipcharge=$shipcharge1 + $shipcharge2;
					
					}
					elseif($pweight == 0)
					{
						$shipcharge=$row['shipcharge'];		
					
					}
					else
					{
						$shipcharge=$row['shipcharge'];					
					
					}
					
				}
			else
			{
				$sql2=mysqli_query($conn,"select * from ".$sufix."shipping where displayflag='1'");
				$row=mysqli_fetch_array($sql2);
					
					if($pweight > 200)
					{
						$shipcharge1=$row['shipcharge'];
						$shipcharge2=0;
						$wg=($pweight / 200);
						
						for($i=1; $i<=$wg; $i++)
						{
							$shipcharge2=$shipcharge2 + $row['shipcharge2'];
						}
						
						$shipcharge=$shipcharge1 + $shipcharge2;
					
					}
					elseif($pweight == 0)
					{
						$shipcharge=$row['shipcharge'];
					
					
					}
					else
					{
						$shipcharge=$row['shipcharge'];					
					
					}
			}	
			
			return $shipcharge;		
			
		
		}
		
		
		function shipchargeheader($sufix,$pweight,$cityname)
		{
				
			//echo $pweight;	
			
			if($cityname!='')
			{
				$sql="select * from ".$sufix."shipping where cityname='".$cityname."' and displayflag='1'";			
			}
				
			//echo $sql; 
			$sql2=mysqli_query($conn,$sql); //
			
			$num=$this->num($sql2);
			if($num > 0)
			{
			
					$row=mysqli_fetch_array($sql2);					
					if($pweight > 200)
					{
						$shipcharge1=$row['shipcharge'];
						$shipcharge2=0;
						$wg=($pweight / 200);
						
						for($i=1; $i<=$wg; $i++)
						{
							$shipcharge2=$shipcharge2 + $row['shipcharge2'];
						}
						
						$shipcharge=$shipcharge1 + $shipcharge2;
					
					}
					elseif($pweight == 0)
					{
						$shipcharge=$row['shipcharge'];			
					
					}
					else
					{
						$shipcharge=$row['shipcharge'];					
					
					}
					
				}
			else
			{
				 
			}	
			echo $shipcharge;
			 
			return $shipcharge;		
			
		
		}
		
		 
		function cart($sufix)
		{
			
			
			$product= new Product();
			if($_REQUEST['subscription']=='2')
			{
				$msubscription=$_REQUEST['subsc'];
				
			}
			else
			{
				$msubscription='0';
			
			}
			
			if($_REQUEST['pid']!='')
				{
				if($_SESSION['shopid']==0 || $_SESSION['shopid']=="")
				{	
					$sbasket=mysqli_query($conn,"select bid from ".$sufix."basketid order by bid desc");
					if($row=mysqli_fetch_array($sbasket))
					{
						$bid=$row['bid']+1;
					}
					else
					{
						$bid=1;
					}
					mysqli_query($conn,"insert into ".$sufix."basketid(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") ;
					//$bid=mysql_insert_id(); 
					$_SESSION['shopid']=$bid;
				}
				else
				{
					$bid=$_SESSION['shopid'];
				
				}
				
			
							
							if($_REQUEST['vpid']!='')
							{ //start condition for variation product 
							
							$cartquery=mysqli_query($conn,"select bid from ".$sufix."basket where bid='".$bid."' and productid='".$_REQUEST['pid']."' and vproductid='".$_REQUEST['vpid']."'") ;
							
							$Numbasket=$this->num($cartquery);
			
								if($Numbasket <= 0)
									{
									
										$sql=mysqli_query($conn,"select * from ".$sufix."product `a`, ".$sufix."product_variant `b` where b.displayflag='1' and b.pid='".$_REQUEST['pid']."' && b.vproductcode='".$_REQUEST['vpid']."' and a.id=b.pid") ;
												$numproduct2= $this->num($sql);	
												if($numproduct2 > 0 )
												{
													
												 while($rowproduct = mysqli_fetch_array($sql))									
													{
														
														
														$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where varpid='".$_REQUEST['vpid']."' and mainimage='1'"));
																						
														$mrp=$_REQUEST['mrp'];
														$sellingprice=$_REQUEST['fprice'];
														$offer=$_REQUEST['offer'];
														$productname=$_REQUEST['pname'];
														$qty=$_REQUEST['pquantity'];
														//$shipprice=$rowproduct['shipprice']; 
														$totalcost=$qty * $sellingprice;
														$description=str_replace("'","`",$rowproduct['shortdescription']);									
														
														if($rowproduct['bid']!='')
														{
															$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
														}
														
																			
													mysqli_query($conn,"insert into ".$sufix."basket(`bid`, `productid`, `vproductid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `variantvalue`, `variantname`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`, `suppliername`, `sellpricevat`,cashcoin) values ('".$bid."', '".$_REQUEST['pid']."' , '".$_REQUEST['vpid']."', '".$rowproduct['cat_id']."', '".$rowproduct['subcat_id']."', '".$rowproduct['subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands."', '".$rowproduct['shippingcost']."', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['variantsku']."', '".$rowproduct['variantbarcode']."', '".$_REQUEST['vvalue']."', '".$_REQUEST['vname']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$msubscription."', '".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."', '".$rowproduct['sellpricevat']."', '".$_REQUEST['cashcoinp']."')") ;	
												
												}
											}
							
									
								}
								else
								{
								
									$sql=mysqli_query($conn,"select * from ".$sufix."product `a`, ".$sufix."product_variant `b` where b.displayflag='1' and b.pid='".$_REQUEST['pid']."' && b.vproductcode='".$_REQUEST['vpid']."' and a.id=b.pid") ;
								$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where varpid='".$_REQUEST['vpid']."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offername=$_REQUEST['offer'];
													$productname=$_REQUEST['pname'];
													$qty=$_REQUEST['pquantity'];
													//$shipprice=$rowproduct['shipprice']; 
													$shipprice=$qty *$rowproduct['shippingcost'];
													$totalcost=$qty * $sellingprice;
													$description=str_replace("'","`",$rowproduct['shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
													
													//echo "update ".$sufix."basket set `productname`='".$productname."', `productimage`='".$rowimage['productimage']."', `slug`='".$rowproduct['slug']."', `description`='".$description."', `sellingprice`='".$sellingprice."', `costprice`='".$mrp."', `brand`='".$brands."', `subtotal`='".$totalcost."', `quantity`='".$qty."', `offername`='".$offername."', `displayflag`='1', `adddate`='".date("Y-m-d")."', `basket_status`='New Order', `sku`='".$rowproduct['variantsku']."', `barcode`='".$rowproduct['variantbarcode']."', `variantvalue`='".$_REQUEST['vvalue']."', `variantname`='".$_REQUEST['vname']."', `pweight`='".$_REQUEST['weight']."' where bid='".$bid."' and `productid`='".$_REQUEST['pid']."' and vproductid='".$_REQUEST['vpid']."'";
													
												mysqli_query($conn,"update ".$sufix."basket set `productname`='".$productname."', `productimage`='".$rowimage['productimage']."', `slug`='".$rowproduct['slug']."', `description`='".$description."', `sellingprice`='".$sellingprice."', `costprice`='".$mrp."', `brand`='".$brands."',`shipprice`='".$shipprice."', `subtotal`='".$totalcost."', `quantity`='".$qty."', `offername`='".$offername."', `displayflag`='1', `adddate`='".date("Y-m-d")."', `basket_status`='New Order', `sku`='".$rowproduct['variantsku']."', `barcode`='".$rowproduct['variantbarcode']."', `variantvalue`='".$_REQUEST['vvalue']."', `variantname`='".$_REQUEST['vname']."', `pweight`='".$_REQUEST['weight']."', `totalweight`='".$_REQUEST['weight']."', `monthly`='".$msubscription."', `vatvalue`='".$rowproduct['vatvalue']."', `sellpricevat`='".$rowproduct['sellpricevat']."', `vat`='".$rowproduct['vat']."', `suppliername`='".$rowproduct['suppliername']."'  where bid='".$bid."' and `productid`='".$_REQUEST['pid']."' and vproductid='".$_REQUEST['vpid']."'") ;
											
											}
										}
									}	
								
							
							} //end condition for product variation
							
							
							
							else
							{ //start the condition for product section 
							
								$cartquery=mysqli_query($conn,"select bid from ".$sufix."basket where bid='".$bid."' and productid='".$_REQUEST['pid']."'") ;
							
								$Numbasket=$this->num($cartquery);
			
								if($Numbasket <= 0)
									{
							
											$sql=mysqli_query($conn,"select * from ".$sufix."master_product where displayflag='1' and id='".$_REQUEST['pid']."'") ;
											$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$_REQUEST['pid']."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offer=$_REQUEST['offer'];
													$productname=mysqli_real_escape_string($conn,$_REQUEST['pname']);
													$qty=$_REQUEST['pquantity'];
													$seller_id = $_REQUEST['seller_id'];
													//$shipprice=$rowproduct['shipprice'];
													$shipprice=$qty *$_REQUEST['pshipcharge']; 
													$totalcost=$qty * $sellingprice;
													$description=str_replace("'","`",$rowproduct['shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
			
			$prodsql = mysqli_query($conn,"select * from ".$sufix."product where master_pro_id = '".$rowproduct['id']."' limit 1");
			
				$prodrows = mysqli_fetch_assoc($prodsql);
									
												mysqli_query($conn,"insert into ".$sufix."basket(`bid`, `productid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`, `suppliername`, `sellpricevat`,cashcoin,seller_id,ringsize,banglesize,diamond_price,gold_price,gemstone_price,making_price,sub_pro_id,silver_price,top_category,sellprice,discount_price,tax,cod_charges,emailid) values ('".$bid."', '".$_REQUEST['pid']."', '".$rowproduct['cat_id']."', '".$rowproduct['subcat_id']."', '".$rowproduct['subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands."', '".$shipprice."', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$prodrows['sku']."', '".$rowproduct['barcode']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$msubscription."', '".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."', '".$rowproduct['sellpricevat']."','".$_REQUEST['cashcoinp']."', '".$seller_id."','".$_REQUEST['rsize']."','".$_REQUEST['bsize']."','".$_REQUEST['diamond_price']."','".$_REQUEST['gold_price']."','".$_REQUEST['gemstone_price']."','".$_REQUEST['making_price']."','".$_REQUEST['sub_pro_id']."','".$_REQUEST['silver_price']."','".$_REQUEST['top_category']."','".$_REQUEST['sellprice']."','".$_REQUEST['discount_price']."','".$_REQUEST['tax']."','".$_REQUEST['cod_charges']."','".$_SESSION['emailid']."')") ;	
											
											}
										}
										
										
								} 
										
										
							else
							{
								$sql=mysqli_query($conn,"select * from ".$sufix."product `a` where a.displayflag='1' and a.id='".$_REQUEST['pid']."'") ;
								$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$_REQUEST['pid']."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offername=$_REQUEST['offer'];
													$productname=mysqli_real_escape_string($conn,$_REQUEST['pname']);
													$qty=$_REQUEST['pquantity'];
													//$shipprice=$rowproduct['shipprice']; 
													$shipprice=$qty *$_REQUEST['pshipcharge']; 
													$totalcost=$qty * $sellingprice;
																										$shipprice=$qty *$rowproduct['shippingcost'];
													$description=str_replace("'","`",$rowproduct['shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
													
													 
												mysqli_query($conn,"update ".$sufix."basket set `productname`='".$productname."', `productimage`='".$rowimage['productimage']."', `slug`='".$rowproduct['slug']."', `description`='".$description."', `sellingprice`='".$sellingprice."', `costprice`='".$mrp."', `brand`='".$brands."',`shipprice`='".$shipprice."', `subtotal`='".$totalcost."', `quantity`='".$qty."', `offername`='".$offername."', `displayflag`='1', `adddate`='".date("Y-m-d")."', `basket_status`='New Order', `sku`='".$rowproduct['sku']."', `barcode`='".$rowproduct['barcode']."', `pweight`='".$_REQUEST['weight']."', `totalweight`='".$_REQUEST['weight']."', `monthly`='".$msubscription."', `vatvalue`='".$rowproduct['vatvalue']."', `sellpricevat`='".$rowproduct['sellpricevat']."', `vat`='".$rowproduct['vat']."', `suppliername`='".$rowproduct['suppliername']."',`ringsize`='".$_REQUEST['rsize']."',`banglesize`='".$_REQUEST['bsize']."' where bid='".$bid."' and `productid`='".$_REQUEST['pid']."'") ;
											
											}
										}
									}	
							
							
							}	//end product section //
					
					}
					
			elseif($_REQUEST['cid']!='')
				{
					
					if($_SESSION['shopid']==0 || $_SESSION['shopid']=="")
					{	
						$sbasket=mysqli_query($conn,"select bid from ".$sufix."basketid order by bid desc");
						if($row=mysqli_fetch_array($sbasket))
						{
							$bid=$row['bid']+1;
						}
						else
						{
							$bid=1;
						}
						mysqli_query($conn,"insert into ".$sufix."basketid(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") ;
						//$bid=mysql_insert_id(); 
						$_SESSION['shopid']=$bid;
					}
					else
					{
						$bid=$_SESSION['shopid'];
					
					}
					
							$cartquery=mysqli_query($conn,"select bid from ".$sufix."basket where bid='".$bid."' and comboid='".$_REQUEST['cid']."'") ;
							
								$Numbasket=$this->num($cartquery);			
								if($Numbasket <= 0)
									{
							
											$sql=mysqli_query($conn,"select * from ".$sufix."product_combo where displayflag='1' and cid='".$_REQUEST['cid']."'") ;
											$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where comboid='".$_REQUEST['cid']."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offer=$_REQUEST['offer'];
													$productname=mysqli_real_escape_string($conn,$_REQUEST['pname']);
													$qty=$_REQUEST['pquantity'];
													//$shipprice=$rowproduct['shipprice'];
													$shipprice=$qty *$rowproduct['shippingcost'];  
													$totalcost=$qty * $sellingprice;
													$description=str_replace("'","`",$rowproduct['combo_shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
														
												mysqli_query($conn,"insert into ".$sufix."basket(`bid`, `comboid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`, `suppliername`,cashcoin) values ('".$bid."', '".$_REQUEST['cid']."', '".$rowproduct['combo_catid']."', '".$rowproduct['combo_subcatid']."', '".$rowproduct['combo_subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['product_slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands."', '', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['product_sku']."', '".$rowproduct['product_bar']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$msubscription."', '".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."', '".$rowproduct['sellpricevat']."','".$_REQUEST['cashcoinp']."')") ;	
											
											}
										}
										
										
								} 
										
										
							else
							{
								$sql=mysqli_query($conn,"select * from ".$sufix."product_combo `a` where a.displayflag='1' and a.cid='".$_REQUEST['cid']."'") ;
								$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where comboid='".$_REQUEST['cid']."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offername=$_REQUEST['offer'];
													$productname=mysqli_real_escape_string($conn,$_REQUEST['pname']);
													$qty=$_REQUEST['pquantity'];
													//$shipprice=$rowproduct['shipprice']; //
													$shipprice=$qty *$rowproduct['shippingcost']; 
													$totalcost=$qty * $sellingprice;
													$description=str_replace("'","`",$rowproduct['shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
													
													//echo "update ".$sufix."basket set `productname`='".$productname."', `productimage`='".$rowimage['productimage']."', `slug`='".$rowproduct['product_slug']."', `description`='".$description."', `sellingprice`='".$sellingprice."', `costprice`='".$mrp."', `brand`='".$brands."', `subtotal`='".$totalcost."', `quantity`='".$qty."', `offername`='".$offername."', `displayflag`='1', `adddate`='".date("Y-m-d")."', `basket_status`='New Order', `sku`='".$rowproduct['product_sku']."', `barcode`='".$rowproduct['product_bar']."', `pweight`='".$_REQUEST['weight']."', `totalweight`='".$_REQUEST['weight']."', `monthly`='".$msubscription."' where bid='".$bid."' and `comboid`='".$_REQUEST['cid']."'";
													
												mysqli_query($conn,"update ".$sufix."basket set `productname`='".$productname."', `productimage`='".$rowimage['productimage']."', `slug`='".$rowproduct['product_slug']."', `description`='".$description."', `sellingprice`='".$sellingprice."', `costprice`='".$mrp."', `brand`='".$brands."', `subtotal`='".$totalcost."', `quantity`='".$qty."', `offername`='".$offername."', `displayflag`='1', `adddate`='".date("Y-m-d")."', `basket_status`='New Order', `sku`='".$rowproduct['product_sku']."', `barcode`='".$rowproduct['product_bar']."', `pweight`='".$_REQUEST['weight']."', `totalweight`='".$_REQUEST['weight']."', `monthly`='".$msubscription."', `vatvalue`='".$rowproduct['vatvalue']."', `vat`='".$rowproduct['vat']."', `suppliername`='".$rowproduct['suppliername']."', `sellpricevat`='".$rowproduct['sellpricevat']."' where bid='".$bid."' and `comboid`='".$_REQUEST['cid']."'") ;
											
											}
										}
									}
			
							}
		
					}
		
		
	//	
		
		
		function whishlist($sufix,$pid,$vpid2,$vpid,$cid)
		{
			
			
			$product= new Product();
			
			if($pid!='')
				{
					
					if($vpid2!='' || $vpid!='')
							{ 
							
								if($vpid2!='')
								{
									$vproductid=$vpid2;
								
								}
								else
								{
									$vproductid=$vpid;								
								}
							
							//echo "select wid from ".$sufix."whishlist where productid='".$pid."' and vproductid='".$vproductid."' and emailid='".$_SESSION['emailid']."'";
							$cartquery=mysqli_query($conn,"select wid from ".$sufix."whishlist where productid='".$pid."' and vproductid='".$vproductid."' and emailid='".$_SESSION['emailid']."'") ;
							
							$Numbasket=$this->num($cartquery);
			
								if($Numbasket <= 0)
									{
									
										$sql=mysqli_query($conn,"select * from ".$sufix."product `a`, ".$sufix."product_variant `b` where b.displayflag='1' and b.pid='".$pid."' && b.vproductcode='".$vproductid."' and a.id=b.pid") ;
											$numproduct2= $this->num($sql);	
												if($numproduct2 > 0 )
												{
													
												 while($rowproduct = mysqli_fetch_array($sql))									
													{
														
														
														$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where varpid='".$vproductid."' and mainimage='1'"));
																						
														$mrp=$_REQUEST['mrp'];
														$sellingprice=$_REQUEST['fprice'];
														$offer=$_REQUEST['offer'];
														$productname=$_REQUEST['pname'];
														$qty="1";
														//$shipprice=$rowproduct['shipprice']; 
														$totalcost=$qty * $sellingprice;
														$description=str_replace("'","`",$rowproduct['shortdescription']);									
														
														if($rowproduct['bid']!='')
														{
															$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
														}
														
																			
													mysqli_query($conn,"insert into ".$sufix."whishlist(`productid`, `vproductid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `sku`, `barcode`, `variantvalue`, `variantname`, `pweight`, `totalweight`, `emailid`) values ('".$pid."' , '".$vproductid."', '".$rowproduct['cat_id']."', '".$rowproduct['subcat_id']."', '".$rowproduct['subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands."', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', '".$rowproduct['variantsku']."', '".$rowproduct['variantbarcode']."', '".$_REQUEST['vvalue']."', '".$_REQUEST['vname']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$_SESSION['emailid']."')") ;	
												
												}
											}
							
									
								}
								
							
							} //end condition for product variation
							
							
							
						else
							{ //start the condition for product section 
							
								$cartquery=mysqli_query($conn,"select wid from ".$sufix."whishlist where productid='".$pid."' and emailid='".$_SESSION['emailid']."'") ;
							
								$Numbasket=$this->num($cartquery);
			
								if($Numbasket <= 0)
									{
							
											$sql=mysqli_query($conn,"select * from ".$sufix."product where displayflag='1' and id='".$pid."'") ;
											$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$pid."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offer=$_REQUEST['offer'];
													$productname=$_REQUEST['pname'];
													$qty="1";
													//$shipprice=$rowproduct['shipprice']; 
													$totalcost=$qty * $sellingprice;
													$description=str_replace("'","`",$rowproduct['shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
														
												mysqli_query($conn,"insert into ".$sufix."whishlist(`productid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `sku`, `barcode`, `pweight`, `totalweight`, `emailid`) values ('".$_REQUEST['pid']."', '".$rowproduct['cat_id']."', '".$rowproduct['subcat_id']."', '".$rowproduct['subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands."', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', '".$rowproduct['sku']."', '".$rowproduct['barcode']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$_SESSION['emailid']."')") ;	
											
											}
										}
										
										
								} 
						}	//end product section //
					
					}
					
			elseif($cid!='')
				{
					
					$cartquery=mysqli_query($conn,"select wid from ".$sufix."whishlist where comboid='".$cid."' and emailid='".$_SESSION['emailid']."'") ;
							
								$Numbasket=$this->num($cartquery);			
								if($Numbasket <= 0)
									{
							
											$sql=mysqli_query($conn,"select * from ".$sufix."product_combo where displayflag='1' and cid='".$cid."'") ;
											$numproduct2= $this->num($sql);	
											if($numproduct2 > 0 )
											{
												
											 while($rowproduct = mysqli_fetch_array($sql))									
												{
													
													
													$rowimage=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."imageupload where comboid='".$cid."' and mainimage='1'"));
																					
													$mrp=$_REQUEST['mrp'];
													$sellingprice=$_REQUEST['fprice'];
													$offer=$_REQUEST['offer'];
													$productname=$_REQUEST['pname'];
													$qty="1";
													//$shipprice=$rowproduct['shipprice'];
													$totalcost=$qty * $sellingprice;
													$description=str_replace("'","`",$rowproduct['combo_shortdescription']);									
													
													if($rowproduct['bid']!='')
													{
														$brands=$product->subquery2($sufix.'brand', 'bid', $rowproduct['bid'], 'brandname');
													}
														
												mysqli_query($conn,"insert into ".$sufix."whishlist(`comboid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `sku`, `barcode`, `pweight`, `totalweight`, `emailid`) values ('".$cid."', '".$rowproduct['combo_catid']."', '".$rowproduct['combo_subcatid']."', '".$rowproduct['combo_subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['product_slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands."', '', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', '".$rowproduct['product_sku']."', '".$rowproduct['product_bar']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$_SESSION['emailid']."')") ;	
											
											}
										}
										
										
								} 
			
							}
		
					}
		
		
		
		
		function num($sql)
		{ 			
			 return (@mysqli_num_rows($sql));			
		}	
		
		function query($sql)
		{ 			
			 return (@mysqli_query($sql));			
		}	
			
		function fetchassoc($sql)
		{ 
			 return (@mysqli_fetch_assoc($sql));
		}	
		function fetcharray($sql)
		{ 			
			 return (@mysqli_fetch_array($sql));
		}
		
		
		
} //end class
$basket= new basket();	




?>