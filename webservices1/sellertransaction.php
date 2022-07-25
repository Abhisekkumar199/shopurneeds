<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $sellerid = $_REQUEST['sellerid'];
	 $sqluser=mysql_query("select * from shopurneeds_suppliers where id='".$sellerid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
            $result = mysql_query("select * from shopurneeds_order where seller_id='".$sellerid."' and approve_status!='Order Pending' order by oid desc");
			while($orderrows = mysql_fetch_assoc($result)) {
			  $sqlseller=mysql_fetch_array(mysql_query("select * from shopurneeds_suppliers where id='".$sellerid."'"));  
	$oid=$orderrows['oid'];
	$ordertotalvlaue=($orderrows['totalcost']+$orderrows['discountvalue'])-($orderrows['shipcharge']+$orderrows['gstvalue']);
 $commission=$sqlseller['sellercomm'];
	$totalcommsionvalue=($ordertotalvlaue*$commission)/100;
	$sellertotal=($ordertotalvlaue-$totalcommsionvalue)+$orderrows['gstvalue'];
	if($orderrows['paidstatus']=='Paid') {$paidss="Paid";} else {$paidss="Unpaid";};
			$orderdetails[] =array("orderid"=>$orderrows['oid'],
			                     "Seller"=>$sqlseller['suppliername'],
			                     "orderstatus"=>$orderrows['approve_status'],
								 "ordedate"=>$orderrows['orderdate'],
								 "comnission"=>$commission,
							"totalamount"=>number_format($ordertotalvlaue,2),
						"totaldeduction"=>number_format($totalcommsionvalue,2),
					 "sellerpayout"=>number_format($sellertotal,2),
						"status"=>$paidss); 
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