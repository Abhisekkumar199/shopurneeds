<?php
    header("Content-type:application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['userId'];
	 	 $orderstatus = $_REQUEST['orderstatus'];
if($orderstatus!='')
{
    $sssass=" and approve_status='$orderstatus'";
}
else
{
       $sssass=" and approve_status!='Order Pending'";
 
}
	 $sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."' ");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
			
            $result = mysql_query("select * from shopurneeds_order where userid='".$rows['emailid']."' $sssass order by `oid` desc");
            
            if(mysql_num_rows($result)>0){
                
                	while($orderrows = mysql_fetch_assoc($result)) {
			 
			            // for seller details 
        			$sellerRes=mysql_query("select id,suppliername from shopurneeds_suppliers where id='".$orderrows["seller_id"]."' ");
        			$sellerRow = mysql_fetch_assoc($sellerRes);
        			
        			$orderdetails[] =array(
        			                     
        			                     "sellername"=>$sellerRow['suppliername'],
        			                     "orderid"=>$orderrows['oid'],
        			                     "ordertotal"=>$orderrows['totalcost'],
        								 "orderdate"=>$orderrows['orderdate'],
        								 "ordertime"=>$orderrows['ordertime'],
        								 "orderstatus"=>$orderrows['approve_status']
        								 ); 
                    }
                
            }else{
                $orderdetails=array();
            }
		
        			$response["orderdetails"] = $orderdetails;

			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer does not exist.";
			echo json_encode($response);
		}
?>