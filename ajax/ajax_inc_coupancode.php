<?php
session_start();
include("../configuration.php");
include("../mailfunction.php");

$date = date('Y-m-d');

if($_REQUEST['promocode']!="")
{
    if($_SESSION['cartvalues']>100)
    {
        $promocode=$_REQUEST['promocode'];
        $sqlcoupan=mysqli_query($conn,"select * from ".$sufix."discountcodes where disc_code like '%$promocode%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' order by codeid desc");
        if(mysqli_num_rows($sqlcoupan)>0) 
        {
        
            $rowcoupan = mysqli_fetch_assoc($sqlcoupan) ;
            $sql11user=mysqli_query($conn,"select * from ".$sufix."user_coupon where coupon_id='".$rowcoupan['codeid']."' and user_id='".$_SESSION['useridse']."' and displayflag='1'");
            if(mysqli_num_rows($sql11user)>0) 
            {
                echo "Coupon already used";
            }
            else
            {
                $inseeq=mysqli_query($conn,"insert into ".$sufix."user_coupon(coupon_code,coupon_id,user_id,adddate,displayflag) values('".$rowcoupan['disc_code']."','".$rowcoupan['codeid']."','".$_SESSION['useridse']."',NOW(),'1')");
                $couponcartvalue=	$rowcoupan['discountvalue'];
                $_SESSION['couponcartvalue']=$couponcartvalue;
                $_SESSION['couponcartdiscode']=$rowcoupan['disc_code']; 
            } 
	    } else { echo "Coupon invalid"; }	
								
    } 
    else { echo "Please add more product to use this coupon"; }
}
else { echo "Coupon invalid"; }

