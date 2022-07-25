<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
		 $bid = $_REQUEST['cartid'];
		 $user_id = $_REQUEST['userId'];

	 $latuser = $_REQUEST['lat'];
	 	 $lonuser = "-".$_REQUEST['lon'];
	 	 	 $cdate = $_REQUEST['cdate'];
	 	 	 	 	 	 $isbagused = $_REQUEST['isbagused'];
	 	 	 $coupondiscount = $_REQUEST['coupondiscount'];
	 	 	 	 $iswalletused = $_REQUEST["iswalletused"];


if($isbagused==0)
{
    $bagcost='0';
}
else
{
        $bagcost='10';

}

$date = date('Y-m-d');
  $tomorrow = date("Y-m-d", strtotime("+1 day"));

if($cdate!="")
{
if($tomorrow==$cdate)
{
    date_default_timezone_set('Asia/Calcutta'); 
     $todaytime = date("His"); 
   $sqlship=mysql_query("select * from shopurneeds_shipping_slot where displayflag='1'");
    while($rowship=mysql_fetch_array($sqlship)) {
                $slotidsaas2=$rowship['id'];
        
             if($slotidsaas2==3)
            {
            $dslotflag="1";
            }
            else
            {
            $dslotflag="0";
            }
       
       $shipdetails[] =array("shipid"=>$rowship['id'],
			                     "shiptype"=>$rowship['delivery_slot'],
								 "shipcheck"=>$dslotflag
								 );  
    } 
}
else
{

   $sqlship=mysql_query("select * from shopurneeds_shipping_slot where displayflag='1'");
    while($rowship=mysql_fetch_array($sqlship)) {
                $slotidsaas2=$rowship['id'];
                $slotnooforder=$rowship['nooforder'];
            $sqlorderdinal=mysql_query("select * from shopurneeds_order where cdate='".$cdate."' and shippingslot='".$slotidsaas2."'");
            $sqlsslotnumorder=mysql_num_rows($sqlorderdinal);
        $dtimesing=$rowship['delivery_timing'];
        if($slotnooforder>$sqlsslotnumorder)
        {
             if($todaytime>$dtimesing)
            {
            $dslotflag="0";
            }
            else
            {
            $dslotflag="1";
            }
        }        
        else
        {
                        $dslotflag="0";

        }
       $shipdetails[] =array("shipid"=>$rowship['id'],
			                     "shiptype"=>$rowship['delivery_slot'],
								 "shipcheck"=>$dslotflag
								 );  
    } 
}


}
			


	 	 $sqlcart=mysql_query("select * from shopurneeds_basket where bid='".$bid."' order by productid asc");
          $cartnum=mysql_num_rows($sqlcart);
          if($cartnum>0)
          {
			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["bid"] = $bid;
			$productcost=0;
			$productordercost=0;
			$shippingprice=0;
			$totalqty=0;
						$netsaving=0;

			//	$result = mysql_query("select * from shopurneeds_basket where bid='$bid'  group by productid,size order by productid asc");

	$result = mysql_query("select * from shopurneeds_basket where bid='$bid'  order by productid asc");
			while($productrows = mysql_fetch_assoc($result)) {
			       $sellerId=$productrows['seller_id'];
			 $productcost=$productrows['sellingprice']*$productrows['quantity'];
			 $productordercost=$productordercost+($productrows['sellingprice']*$productrows['quantity']);

			    $shippingprice=$shippingprice+$productrows['shipprice'];
			    $totalqty=$totalqty+$productrows['quantity'];
			    	$pervalue=100-(($productrows['sellingprice']*100)/$productrows['costprice']);
			    $cashback=($productcost*8)/100;
			$netsaving=$netsaving+ (($productrows['costprice']-$productrows['sellingprice'])*$productrows['quantity']);    
			    // product type
			    $produtctType=mysql_fetch_assoc(mysql_query("select vegnonveg from shopurneeds_product where id='".$productrows["productid"]."'"));
			    if($productrows['is_withoutpro']==0)
			    {
			        $ddds="https://localhost/project/shopurneeds/uploads/productimage/thumb";
			    }
			    else
			    {
			       $ddds="https://localhost/project/shopurneeds/withoutproimages";

			    }
			$prodetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$productrows['sellingprice'],
			                     "productType"=>$produtctType['vegnonveg'],
			                     "costprice"=>$productrows['costprice'],
								 "discount"=>number_format($cashback,0),
						 "imageurl"=>$ddds."/".$productrows['productimage'],
								 "pid"=>$productrows['productid'],
								 "is_withoutpro"=>$productrows['is_withoutpro'],
								 "qty"=>$productrows['quantity'],
								 "size"=>$productrows['size']
								 ); 
}
$sgst="0";
$cgst="0";
$totalgst="0";
$sqlsssu=mysql_fetch_array(mysql_query("select is_gst,lat,lng,discountper from shopurneeds_suppliers where id='".$sellerId."'"));

$gstcheck=$sqlsssu['is_gst'];
$latseller=$sqlsssu['lat'];
$lngseller="-".$sqlsssu['lng'];
$discountper=$sqlsssu['discountper'];

if($gstcheck==1)
{
    $totalgst="0";
   $sgst="0";
$cgst="0";
}
$sqlshipcharge=mysql_fetch_array(mysql_query("select * from shopurneeds_extra_charges where id='1'"));

$sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
$numuser=mysql_num_rows($sqluser);
$rows = mysql_fetch_array($sqluser);
$userwallet=	$rows['wallet'];


	  if($productordercost < 600)
                        {
                            $shippingprice = 49;
                        }
                        else if($productordercost >= 600 and $productordercost < 1100)
                        {
                            $shippingprice = 40;
                        }
                        else
                        {
                            $shippingprice = 0 ;
                        } 
                        

$totalcost=($productordercost+$shippingprice+$bagcost)-$coupondiscount; 
if($iswalletused==1)
{
if($userwallet>0)
{
if($totalcost > $userwallet)
{
$walletused=$userwallet;
$totalcost=$totalcost-$walletused;
$userwalletremain=$userwallet-$walletused;
}
else if($totalcost == $userwallet)
{
$walletused=$userwallet;
$totalcost=$totalcost-$walletused;
$userwalletremain=$userwallet-$walletused;

}
else
{
$walletused=$totalcost;
$userwalletremain=$userwallet-$walletused;
$totalcost=$totalcost-$walletused;


}

}

}
if($totalcost>0)
{
    $response["iscod"]='1';

}
else
{
        $response["iscod"]='1';

}
$response["totalqty"]=$totalqty;
            $response["productdetails"]=$prodetails;
            $response["subtotal"]=$productordercost;
            $response["shippingprice"]=$shippingprice;
            $response["coupondiscount"]=$coupondiscount;
            $response["totalcost"]=$totalcost;
            $response["user_wallet"]=$walletused;
          $response["user_wallet_amount"]=number_format($userwallet,0);

            $response["bagcost"]=$bagcost;
			$response["netsaving"]=$netsaving;
            $response["sgst"]=$sgst;
            $response["cgst"]=$cgst;
			$response["shippingtype"]=$shipdetails;
            $response["codordervaluecheck"]="1999";
            $response["minimumordervaluecheck"]="250";
            $response["activatepaytm"]="0";
            $response["todaydate"]=$date;
			$response["tomorrowdate"]=$tomorrow;
			$response["shippingcheck"]="0";

			echo json_encode($response);
		} else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>