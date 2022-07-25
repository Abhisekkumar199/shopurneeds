<?php 
session_start();

include("../configuration.php");  
$productid=$_REQUEST['productid'];
?>
<?php 					 
$sqlfil=mysqli_query($conn,"insert into ".$sufix."favorite_product(user_id,product_id,adddate) values ('".$_SESSION['useridse']."','".$productid."',NOW())");
$sqlfil=mysqli_query($conn,"update ".$sufix."product set like_count=like_count+1 where id='".$productid."'");
 $sqlpro=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where id ='$productid'"));
?>

<?php
	//echo "select * from ".$sufix."favorite_product where user_id = '".$_SESSION['useridse']."' and product_id = '".$productid."'";
	
	$numsql = mysqli_query($conn,"select * from ".$sufix."favorite_product where user_id = '".$_SESSION['useridse']."'");
	$num = mysqli_num_rows($numsql);
	   
$user_id_follow1 = mysqli_query($conn,"select * from ".$sufix."favorite_product where user_id = '".$_SESSION['useridse']."' and product_id = '".$productid."'");

if(mysqli_num_rows($user_id_follow1)>0)
{ 
?>
<?php
    $wishlist = '<a href="javascript:void(0);" onClick="removetofavoritepro('.$productid.')"><span><i style="color: #84c225;" class="fa fa-heart"></i></span></a>  ';
 } 
 else  
 { 
	$wishlist = '<a href="javascript:void(0);" onClick="addtofavoritepro('.$productid.')"><span><i  class="fa fa-heart"></i></span></a>  ';
} ?>
	<?php
	$mmm = '<span class="notiify shadow">'.$num.'<span>';
$array = array('wishlist'=>$wishlist,"wishlistcount"=>$mmm);
echo $myJSON = json_encode($array);
?>
    