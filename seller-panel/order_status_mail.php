<?php 
$sqlorder = mysqli_query($conn,"select * from `".$sufix."order` where oid='".$id."'") ;
$rows = mysqli_fetch_assoc($sqlorder);

$date=date_create($rows['orderdate']);
$orderdate = date_format($date,"d F Y");
$shipprice = $rows['shipcharge'];
$codcharge = $rows['codcharge'];

$paytype = $rows['paytype'];
$emailid = $rows['emailid'];
$name = $rows['deliver_fname']." ".$roworder['deliver_lname']; 
$address_id = $rows['address_id'];
$sqladdress = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."customer_address` where id='".$address_id."'")) ;

$url = URL;
$ordercost=$rows['totalcost'];
$fromc = "Shopurneeds";
$toc = $emailid;
$subjectc = "Order# ".$id." Status";
$messagec='<!DOCTYPE HTML>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Untitled Document</title>
</head>

<body>
<table width="700" align="center" cellpadding="0" cellspacing="0" style="font-size:13px;font-family:arial,sans-serif;color:#00295e;background:#f7f7f7;padding:0px">
  <tbody>
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#f7f7f7">
          <tbody>
            <tr>
              <td height="70" align="center" valign="middle" style="background-color:#f7f7f7;padding:0px"><table style="color:#00295e;font-size:20px;width:100%">
                  <tbody>
                    <tr>
                      <td height="70" align="center" valign="middle" style="background-color: #f7f7f7;"><a href="https://localhost/project/shopurneeds" style="display:block;border:0;text-decoration:none" target="_blank" data-saferedirecturl=""> <img style="max-width:250px;" src="https://localhost/project/shopurneeds/assets/images/logo.png" class="CToWUd"> </a></td>
                    
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="15" cellspacing="0">
                  <tbody>
                    <tr>
                <td width="50%" align="left" valign="top" style="color:#002b4f;padding:10px 10px 0;font-weight:600;font-size:15px;line-height:26px"> Dear '.$name.', <br>
                        Your order has been '.$mail_Status.'</td>
                      <td width="50%" align="right" valign="top" style="color:#002b4f;padding:10px 10px 0;font-size:15px;font-weight:600;line-height:26px">Order no. '.$orderid.' <br>
                        Date: '.$orderdate.'&nbsp;'.$rows['ordertime'].'</td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" align="center" cellpadding="15" cellspacing="0">
                  <tbody>
                    <tr>
                      <td style="padding:5px 15px;font-size:13px;color:#00295e;line-height:17px"> We will share the tracking details with you shortly once your Order is Shipped.In case of any queries, please feel free to contact us at + 91 9717295892 between <span class="aBn" data-term="goog_118579533" tabindex="0"><span class="aQJ">Monday</span></span> to <span class="aBn" data-term="goog_118579534" tabindex="0"><span class="aQJ">Saturday</span></span> <span style="display:inline-block"><span class="aBn" data-term="goog_118579535" tabindex="0"><span class="aQJ">10:00 AM – 7:00 PM(IST)</span></span>.</span>You may also email us at <a href="mailto:care@https://localhost/project/shopurneeds" target="_blank">care@https://localhost/project/shopurneeds</a>.<br>
                        <br>
                        Your item details are given below: </td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="5">
                          <tbody>
                            <tr>
                              <th align="left" style="font-size:14px" width="30%">Item</th>
                              <th align="center" style="font-size:14px" width="30%">Expected Date</th>
                              <th align="center" width="20%" style="font-size:14px">Qty</th>
                              <th align="center" width="20%" style="font-size:14px">Subtotal</th>
                            </tr>';
                            $sql_order_seller=mysqli_query($conn,"select * from ".$sufix."order_seller where oid='".$id."'");
                            while($rows_seller =mysqli_fetch_assoc($sql_order_seller))
                            {
    			                $row = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."basket` where oid_seller='".$rows_seller['id']."' ")) ;		
                                $totalval=0;
                                $count=1;
                                $totalcost=0;
                                $tax1 = 0;
                                $discount_price1 = 0;
                                $sellprice1 = 0;
                                $coupan_discount1= 0;
                                $totaldiscount = 0;
                                 
                                	if($row['coupon_code']!='') 
                                	{ 
            			                $coupon_code = $row['coupon_code'];
                    			    }
                                    $pwieght=$pwieght + $row['totalweight'];
                                    $totalweight=$totalweight + $row['totalweight'];
                                    $totalcost=$totalcost + $row['subtotal'];
                                    $quantity = $row['quantity'];
                                    $sellprice = $row['sellprice1']*$row['quantity'];
                                    $discount_price = $row['discount_price']*$row['quantity'];
                                    $coupan_discount = $row['coupan_discount']*$row['quantity'];
                                    $tax = $row['tax']*$row['quantity'];
                                    $tax1 = $tax1+$tax;
                                    $sellprice1 = $sellprice1+$sellprice;
                                    $discount_price1 = $discount_price1+$discount_price;
                                    $coupan_discount1 = $coupan_discount1+$coupan_discount;
                                    if($row['size']!='') { $sizerb = "Size : ".$row['size']; } 
                                    if($row['coupon_code']!='') {  $couponcode = "(".$row['coupon_code'].")";}
                                    
                                    $messagec .='<tr>
                                      <td><div style="padding-bottom:3px; font-size:12px;">'.$row['productname'].'</div>
                                        <div style="padding-bottom:3px; font-size:12px;">'.$sizerb.'</div>
                                        <div style="padding-bottom:3px; font-size:12px;">Color:'.$row['color'].'</div>
                                        <a style="text-decoration:none;display:block;padding-bottom:3px"><img width="80" alt="shopurneeds" src="'.$url.'/uploads/productimage/thumb/'.$row['productimage'].'" class="CToWUd"></a><a style="text-decoration:none;color:#002b4f">'.$row['sku'].'</a></td>
                                      <td valign="middle" align="center" style="font-size:14px">'.$row['disclaimer'].'</td>
                                      <td valign="top" align="center">'.$row['quantity'].'</td>
                                      <td valign="top" align="center">'.Currency.floor(($row['sellprice1']*$row['quantity'])*$_SESSION['conratio']).'</td>
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
                            $gtotal=($totalcost + $shipprice+$tax1+$codcharge);
                            $gtotal1 = ($gtotal*$_SESSION['conratio']);
                            $messagec .='<tr>
                              <td colspan="2"></td>
                              <td style="font-size:12px;color:#002b4f">Subtotal:</td>
                              <td style="font-size:12px;color:#002b4f">'.Currency.floor($sellprice1*$_SESSION['conratio']).'</td>
                            </tr>
                            
                            <tr>
                              <td colspan="2"></td>
                              <td style="font-size:12px;color:#002b4f">Coupon Discount:</td>
                              <td style="font-size:12px;color:#002b4f">'.Currency.floor($coupan_discount1*$_SESSION['conratio']).'</td>
                            </tr>
                            <tr>
                              <td colspan="2"></td>
                              <td style="font-size:12px;color:#002b4f">Shipping Charges:</td>
                              <td style="font-size:12px;color:#002b4f">'.Currency.floor($shipprice*$_SESSION['conratio']).'</td>
                            </tr>
                            <tr>
                              <td colspan="2"></td>
                              <td style="font-size:12px;color:#002b4f">COD Charges:</td>
                              <td style="font-size:12px;color:#002b4f">'.Currency.floor($codcharge*$_SESSION['conratio']).'</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="font-size:12px;color:#002b4f"></td>
                              <th align="left" style="font-size:12px;color:#002b4f">Grand Total:</th>
                              <th align="left" style="font-size:12px;color:#002b4f">'.Currency.floor($gtotal1).'</th>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="100%" align="left" valign="top" style="padding:0 10px"><table width="100%" align="right" cellpadding="5" cellspacing="0" border="0">
                          <tbody>
                            <tr>
                              <td align="left" valign="top" width="50%"><table width="100%" cellpadding="5" style="border:1px solid white" cellspacing="0">
                                  <tbody>
                                    <tr valign="top" style="min-height:90px">
                          <td style="font-weight:600;font-size:15px;color:#002b4f;height:20px;background-color:white;border:1px solid white" valign="middle">Payment Method:</td>
                                    </tr>
                                  </tbody>
                                </table></td>
                              <td align="left" valign="top"><table cellpadding="5" width="100%" style="border:1px solid white" cellspacing="0">
                                  <tbody>
                                    <tr valign="top" style="min-height:90px">
                                      <td style="font-weight:600;font-size:15px;color:#002b4f;height:20px;border:1px solid white;text-align:center" valign="middle">'.$paytype.'</td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="100%" align="left" valign="top" style="padding:0 10px"><table width="100%" align="right" cellpadding="5" cellspacing="0" border="0">
                          <tbody>
                            <tr>
                      <td align="left" valign="top" width="50%" style="padding-bottom:20px"><table width="100%" cellpadding="5" style="border:3px solid white" cellspacing="0">
                                  <tbody>
                                    <tr valign="top" style="min-height:80px">
                                      <td style="font-weight:600;font-size:15px;color:#002b4f;height:20px;background-color:white" valign="middle">Billing/Shipping Address:</td>
                                    </tr>
                                    <tr>
                                      <td valign="top" style="height:80px;font-size:14px;color:#002b4f">'. $sqladdress['fname'].'&nbsp;'.$sqladdress['lname'].'<br>'.
                                        $sqladdress['address'].','.
                                        $sqladdress['city'].'-'.$sqladdress['zipcode'].'<br>'; 
                                        'T:'.$sqladdress['mobileno'].'</td>
                                    </tr>
                                  </tbody>
                                </table></td>
                              
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <th align="center" style="font-size:17px;">Happy Shopping @ https://localhost/project/shopurneeds</th>
                    </tr>
                    <tr>
                      <td align="center" style="font-size:14px;height:20px;background-color:white"> We would like to hear about your shopping experience with us! Please click on the link below and share your feedback as we value your opinion and they will immensely help us to improve our services. </td>
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
</body>
</html>
';
  ?>