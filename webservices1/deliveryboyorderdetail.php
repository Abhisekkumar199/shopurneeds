<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $deliveryboyid = $_REQUEST['deliveryboyid'];
	 $order_id = $_REQUEST['order_id'];

	 $sqluser=mysql_query("select * from shopurneeds_driver where id='".$deliveryboyid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
		 $resultflag = mysql_query("select * from shopurneeds_order_status_flag");	
					while($orderrowsflag = mysql_fetch_assoc($resultflag)) {
					$orderstatusflag[] =array("displayname"=>$orderrowsflag['displayname'],
			                     "keyname"=>$orderrowsflag['keyname']
								 ); 	    
					}	
			        			$response["orderstatusflag"] = $orderstatusflag;

            $result = mysql_query("select * from shopurneeds_order where oid='".$order_id."'");
			while($orderrows = mysql_fetch_assoc($result)) {
			    $sqlsellerinfo=mysql_fetch_assoc(mysql_query("select *  from shopurneeds_suppliers where id='".$orderrows['seller_id']."'"));

			    
			    
			    $results = mysql_query("select * from nfdcart_basket where bid='".$orderrows['bid']."'");
		$sqlgst28=mysql_fetch_assoc(mysql_query("select sum(sellingprice*quantity) as totalprice from nfdcart_basket where bid='".$orderrows['bid']."' and gst='28'"));
	$total28gst= $sqlgst28['totalprice'];
	if($total28gst>0)
	{
$pwithout28gst=$total28gst/(1+(28/100));
$gstvalue28=$total28gst-$pwithout28gst;
$cgst14=number_format($gstvalue28/2,2);
$sgst14	  =  number_format($gstvalue28/2,2);
	}
	else
	{
	    $cgst14="0.00";
$sgst14	  =  "0.00";
	}
	$sqlgst18=mysql_fetch_assoc(mysql_query("select sum(sellingprice*quantity) as totalprice from nfdcart_basket where bid='".$orderrows['bid']."' and gst='18'"));
	$total18gst= $sqlgst18['totalprice'];
	if($total18gst>0)
	{
$pwithout18gst=$total18gst/(1+(18/100));
$gstvalue18=$total18gst-$pwithout18gst;
$cgst9=number_format($gstvalue18/2,2);
$sgst9	  =  number_format($gstvalue18/2,2);
	}
	else
	{
	    $cgst9="0.00";
$sgst9	  =  "0.00";
	}
	$sqlgst12=mysql_fetch_assoc(mysql_query("select sum(sellingprice*quantity) as totalprice from shopurneeds_basket where bid='".$orderrows['bid']."' and gst='12'"));
	$total12gst= $sqlgst12['totalprice'];
	if($total12gst>0)
	{
$pwithout12gst=$total12gst/(1+(12/100));
$gstvalue12=$total12gst-$pwithout12gst;
$cgst6=number_format($gstvalue12/2,2);
$sgst6	  =  number_format($gstvalue12/2,2);
	}
	else
	{
	    $cgst6="0.00";
$sgst6	  =  "0.00";
	}
	$sqlcess12=mysql_fetch_assoc(mysql_query("select sum(sellingprice*quantity) as totalprice from shopurneeds_basket where bid='".$orderrows['bid']."' and cess='12'"));
	$total12cess= $sqlcess12['totalprice'];
	if($total12cess>0)
	{
$pwithout12cess=$total12cess/(1+(12/100));
$cessvalue12=number_format($total12cess-$pwithout12cess,2);

	}
	else
	{
	  $cessvalue12="0.00";
	}
	
			while($productrows = mysql_fetch_assoc($results)) {
			    $productcost=$productcost+($productrows['sellingprice']*$productrows['quantity']);
			    $shippingprice=$shippingprice+$productrows['shipprice'];
			    $totalqty=$totalqty+$productrows['quantity'];
			    	$pervalue=100-(($productrows['sellingprice']*100)/$productrows['costprice']);
			$prodetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$productrows['sellingprice'],
			                     "costprice"=>$productrows['costprice'],
								 "discount"=>number_format($pervalue,0),
								 "imageurl"=>"https://www.nfdcart.com/productimage/".$productrows['productimage'],
								 "pid"=>$productrows['productid'],
								 "qty"=>$productrows['quantity'],
								 "psubtotal"=>number_format($productrows['sellingprice']*$productrows['quantity'],2),
								 "size"=>$productrows['size']
								 ); 
}
			$orderdetails[] =array("orderid"=>$orderrows['oid'],
			                     "ordertotal"=>$orderrows['totalcost'],
			                     "shippingcost"=>$orderrows['shipcharge'],
								 "quantity"=>$orderrows['quantity2'],
								 "orderdate"=>$orderrows['orderdate'],
								 "orderstatus"=>$orderrows['approve_status'],
								 "regwallet_discount"=>$orderrows['regwallet'],
								"userwallet_discount"=>$orderrows['userwallet'],
								 "emailid"=>$orderrows['emailid'],
								 "sfname"=>$orderrows['deliver_fname'],
								 "slname"=>$orderrows['deliver_lname'],
								  "saddress"=>$orderrows['deliver_address'],
								 "slankmark"=>$orderrows['deliver_housenumber'],
								 "scity"=>$orderrows['deliver_city'],
								  "sstate"=>$orderrows['deliver_state'],
								 "spincode"=>$orderrows['deliver_zip'],
								 "sphone"=>$orderrows['deliver_phone'],
								 "invoicenumber"=>$orderrows['invoiceno'],
								 "invoicedate"=>$orderrows['invoicedate'],
								 "ordermode"=>$orderrows['payby'],
								 "is_picked"=>$orderrows['is_picked'],

								 "cgst14"=>$cgst14,
								 "sgst14"=>$sgst14,
								  "cgst9"=>$cgst9,
								 "sgst9"=>$sgst9,
								 "cgst6"=>$cgst6,
								 "sgst6"=>$sgst6,
 "cess12"=>$cessvalue12,
 "sellername"=>$sqlsellerinfo['suppliername'],
  "selleraddress"=>$sqlsellerinfo['paddress1'],
 "sellercity"=>$sqlsellerinfo['pcity'],
 "sellerstate"=>$sqlsellerinfo['pstate'],
 "sellerpincode"=>$sqlsellerinfo['ppincode'],
 "sellergst"=>$sqlsellerinfo['gstno'],


								 "prodetails"=>$prodetails

								 ); 
			
		 
}


        			$response["orderdetails"] = $orderdetails;

			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Seller do not exist.";
			echo json_encode($response);
		}
?>