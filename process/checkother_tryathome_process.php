<?php
session_start();
include("includes/configuration.php");

$city = $_SESSION['TryCity'];
$email = $_SESSION['Tryemail'];
$tdate = $_SESSION['TryDate'];
$tryid = $_SESSION['TryID'];
$pid = $_REQUEST['pid'];
$check6valisss = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."tryathome where try_id='".$tryid."' and  product_id='".$pid."'"));
if($check6valisss==0)
{
$check6vali = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."tryathome where emailid='".$email."' and `date`='".$tdate."'"));
 if($check6vali<=5)
 {
$checkTry = mysqli_query($conn,"select * from ".$sufix."tryathome where product_id='".$pid."' and `date`='".$tdate."'");
$rowtry=mysqli_fetch_array($checkTry);
$numros=mysqli_num_rows($checkTry);
if($numros==0)
{
$ins = mysqli_query($conn,"INSERT INTO ".$sufix."tryathome (`product_id`,`try_id`,`city`,`date`,`emailid`,`adddate`) values ('".$pid."','".$tryid."' ,'".$city."','".$tdate."','".$email."',NOW())");

$tyathome ='<span class="notiify shadow TryAtHomeResponse">';
$numsql2 = mysqli_query($conn,"select * from ".$sufix."tryathome where try_id = '".$_SESSION['TryID']."'");
	$tyathome .=''.$num2 = mysqli_num_rows($numsql2);
				$tyathome .='</span>';
$message = "Product successfully added on ".$tdate." for TRY @ HOME, You may add upto 6 products. Thank You!";
$array = array('tyathome'=>$tyathome,"message"=>$message);
echo $myJSON = json_encode($array);


}
else if($numros==1)
{
if($rowtry['city']==$city)
{
$ins = mysqli_query($conn,"INSERT INTO ".$sufix."tryathome (`product_id`,`try_id`,`city`,`date`,`emailid`,`adddate`) values ('".$pid."','".$tryid."' ,'".$city."','".$tdate."','".$email."',NOW())");

$tyathome ='<span class="notiify shadow TryAtHomeResponse">';
$numsql2 = mysqli_query($conn,"select * from ".$sufix."tryathome where try_id = '".$_SESSION['TryID']."'");
	$tyathome .=''.$num2 = mysqli_num_rows($numsql2);
				$tyathome .='</span>';
$message = "Product successfully added on ".$tdate." for TRY @ HOME, You may add upto 6 products. Thank You!";
$array = array('tyathome'=>$tyathome,"message"=>$message);
echo $myJSON = json_encode($array);

}
else
{
	$tyathome ='<span class="notiify shadow TryAtHomeResponse">';
$numsql2 = mysqli_query($conn,"select * from ".$sufix."tryathome where try_id = '".$_SESSION['TryID']."'");
	$tyathome .=''.$num2 = mysqli_num_rows($numsql2);
				$tyathome .='</span>';
$message = "We do not have this product on ".$tdate." for TRY @ HOME";
$array = array('tyathome'=>$tyathome,"message"=>$message);
echo $myJSON = json_encode($array);

}
}
else
{

$tyathome ='<span class="notiify shadow TryAtHomeResponse">';
$numsql2 = mysqli_query($conn,"select * from ".$sufix."tryathome where try_id = '".$_SESSION['TryID']."'");
	$tyathome .=''.$num2 = mysqli_num_rows($numsql2);
				$tyathome .='</span>';
$message = "We do not have this product on ".$tdate." for TRY @ HOME";
$array = array('tyathome'=>$tyathome,"message"=>$message);
echo $myJSON = json_encode($array);

}
}
else
{
$tyathome ='<span class="notiify shadow TryAtHomeResponse">';
$numsql2 = mysqli_query($conn,"select * from ".$sufix."tryathome where try_id = '".$_SESSION['TryID']."'");
	$tyathome .=''.$num2 = mysqli_num_rows($numsql2);
				$tyathome .='</span>';
$message = "You can add upto 6 product for TRY @ HOME";
$array = array('tyathome'=>$tyathome,"message"=>$message);
echo $myJSON = json_encode($array);

}
}
else
{

$tyathome ='<span class="notiify shadow TryAtHomeResponse">';
$numsql2 = mysqli_query($conn,"select * from ".$sufix."tryathome where try_id = '".$_SESSION['TryID']."'");
	$tyathome .=''.$num2 = mysqli_num_rows($numsql2);
				$tyathome .='</span>';
$message = "You have already added this Product for TRY @ HOME";
$array = array('tyathome'=>$tyathome,"message"=>$message);
echo $myJSON = json_encode($array);

}

?>