<?php 
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();  
$date = date('Y-m-d');
$promocode = isset($_REQUEST['promocode'])?$_REQUEST['promocode']:'';
$cartid = isset($_REQUEST['cartid'])?$_REQUEST['cartid']:'';
$user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';
$cartvalue = isset($_REQUEST['cartvalue'])?$_REQUEST['cartvalue']:'';


if($promocode != '')
{ 
    

    	$sqlbid12=mysql_query("select * from shopurneeds_discountcodes where disc_code like '%$promocode%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' order by codeid desc");
  $numcarnms=mysql_num_rows($sqlbid12);
  if($numcarnms>0) {
          		$rowcoupan = mysql_fetch_assoc($sqlbid12) ;
  $sql11user=mysql_query("select * from shopurneeds_user_coupon where coupon_id='".$rowcoupan['codeid']."' and user_id='".$user_id."' and displayflag='1'");
 	 if(mysql_num_rows($sql11user)==0) {
                      $inseeq=mysql_query("insert into shopurneeds_user_coupon(coupon_code,coupon_id,user_id,adddate,displayflag) values('".$rowcoupan['disc_code']."','".$rowcoupan['codeid']."','".$user_id."',NOW(),'0')");

      $couponcartvalue=	($cartvalue*$rowcoupan['discountvalue'])/100;
		$response["coupondiscount"]=$couponcartvalue;
		$response["promocode"]=$rowcoupan['disc_code'];
    
     $response["status"] = "200";
        $response["msg"] = "Success"; 
        echo json_encode($response);
    
 	 }
 	 else
 	 {
 	$response["status"] = "400";		
	$response["msg"] = "Coupon already used";		
	echo json_encode($response);	
 	 }
  }
  else
  {
      $response["status"] = "400";		
	$response["msg"] = "Invalid Coupon";		
	echo json_encode($response);	
  }
}
else 	
{		
	$response["status"] = "400";		
	$response["msg"] = "Parameter missing!";		
	echo json_encode($response);	
}