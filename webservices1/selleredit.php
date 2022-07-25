<?php 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();   
$date =date("Y-m-d H:i:s"); 
$sellerid = isset($_REQUEST['sellerid'])?$_REQUEST['sellerid']:'';
$showroomname = isset($_REQUEST['showroomname'])?$_REQUEST['showroomname']:'';
$aboutus = isset($_REQUEST['aboutus'])?$_REQUEST['aboutus']:'';
$shipping = isset($_REQUEST['shipping'])?$_REQUEST['shipping']:'';
$returns = isset($_REQUEST['returns'])?$_REQUEST['returns']:'';
$customercare = isset($_REQUEST['customercare'])?$_REQUEST['customercare']:'';
$dealsin = isset($_REQUEST['dealsin'])?$_REQUEST['dealsin']:'';
$address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
$city = isset($_REQUEST['city'])?$_REQUEST['city']:'';
$state = isset($_REQUEST['state'])?$_REQUEST['state']:'';
$pincode = isset($_REQUEST['pincode'])?$_REQUEST['pincode']:'';
$lat = isset($_REQUEST['slat'])?$_REQUEST['slat']:'';
$long = isset($_REQUEST['slong'])?$_REQUEST['slong']:'';


if($sellerid != '')
{ 
    
    $file=$_FILES['showroomimage']['name'];
    if($file) 
    { 
        $filename1 = $_FILES['showroomimage']['name']; 
        $size=filesize($_FILES['showroomimage']['tmp_name']); 
        $photo_namecatalog=$filename1;
        $newname1="../showroomimages/".$photo_namecatalog;		
        $move=move_uploaded_file($_FILES['showroomimage']['tmp_name'],$newname1); 
         
            $sqlquery = mysql_query("update `shopurneeds_suppliers` set `uploadimage`='".$photo_namecatalog."' where id='".$sellerid."'");
        
    }
    
     $file1=$_FILES['showroomlogo']['name'];
    if($file1) 
    { 
        $filename1 = $_FILES['showroomlogo']['name']; 
        $size=filesize($_FILES['showroomlogo']['tmp_name']); 
        $photo_namecatalog1=$filename1;
        $newname1="../showroomimages/".$photo_namecatalog1;		
        $move=move_uploaded_file($_FILES['showroomlogo']['tmp_name'],$newname1); 
        
            $sqlquery = mysql_query("update `shopurneeds_suppliers` set `uploadimage1`='".$photo_namecatalog1."' where id='".$sellerid."'");
        
    }
    
    	$updaes= mysql_query("update `shopurneeds_suppliers` set `suppliername`='".$showroomname."', `aboutus`='".$aboutus."' ,`shipping`='".$shipping."' ,`returns`='".$returns."' ,`dealsin`='".$dealsin."' ,`customerservice`='".$customercare."' , `editdate`='".date("Y-m-d")."', address1='".$address."',cityname='".$city."',paddress1='".$address."',pcity='".$city."',pstate='".$state."',ppincode='".$pincode."',baddress1='".$address."',bcity='".$city."',bstate='".$state."',bpincode='".$pincode."' where id='".$sellerid."'");
    
     $response["status"] = "200";
        $response["msg"] = "Success"; 
        echo json_encode($response);
    
   
}
else 	
{		
	$response["status"] = "401";		
	$response["msg"] = "Parameter missing!";		
	echo json_encode($response);	
}