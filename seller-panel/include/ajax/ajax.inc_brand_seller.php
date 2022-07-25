<?php



include_once('../classes/config.inc.php');



include_once('../classes/database.inc.php');



include_once('../libraries/function_inc.php');























if($_GET["brandname"]!='')



{ //start condition to check the value for sub categroy











	$brandname=$_REQUEST['brandname');



	$brandslug2=create_slug($brandname);



	$brandslug=strtolower($brandslug2);



	



	



	mysqli_query($conn,sqlquery('brand','shopurneeds_')) ;



	//mysqli_query($conn,sqlquery('brand'),'baby_') ;



		 if($rows123 = mysqli_fetch_assoc())



		 {



		  $unique=$rows123['bid']+"1";



		  $brand_code=str_pad($unique,4, "0", STR_PAD_LEFT);



		 



		 }



		 else



		 {



		  $unique="100";



		  $brand_code=str_pad($unique, 4, "0", STR_PAD_LEFT);            



		 



		 }

$sql1=mysqli_query($conn,"select * from `shopurneeds_brand` where brandname='".$_REQUEST['brandname']."'");



	



	if(mysqli_num_rows($sql1)>0)



	{		

	echo "<span style='color:red'>Already created this brand</span>";



	} else  { 

$slugcheck = mysqli_query($conn,"select * from shopurneeds_slug_master where slugname='".$brandslug."'");
$slugrows = mysqli_fetch_assoc($slugcheck);
if(mysqli_num_rows($slugcheck)>0) {
	$i=rand(1,10);
	$brandslug1 = $brandslug.$i; 
	$slugins = mysqli_query($conn,"insert into shopurneeds_slug_master (`slugname`,`slugtype`,`adddate`) values ('".$brandslug1."','brand',NOW())");
		 
 mysqli_query($conn,"insert into `shopurneeds_brand` (`bid`, `brandname`, `brandslug`, `adddate`,`displayflag`,`add_user`, `seller_id`) values ('".$brand_code."', '".$brandname."','".$brandslug1."', '".date("Y-m-d")."', '1', '".$_SESSION['username']."', '".$_GET["seller_id"]."')") ;

		} else { 
		$slugins = mysqli_query($conn,"insert into shopurneeds_slug_master (`slugname`,`slugtype`,`adddate`) values ('".$brandslug."','brand',NOW())");
		 
 mysqli_query($conn,"insert into `shopurneeds_brand` (`bid`, `brandname`, `brandslug`, `adddate`,`displayflag`,`add_user`, `seller_id`) values ('".$brand_code."', '".$brandname."','".$brandslug."', '".date("Y-m-d")."', '1', '".$_SESSION['username']."', '".$_GET["seller_id"]."')") ;
		
		} 

		 }



		 $bcode=mysql_insert_id();



		 



		 $pagename2=$brandslug."/".$bcode."/".$_REQUEST['catid']."/mpage=submenu_brand";



		 $sql=mysqli_query($conn,"select catid,brandid from `shopurneeds_category_brand` where catid='".$_REQUEST['catid']."' and brandid='".$bcode."'");	



			$num=mysqli_num_rows($sql);



			if($num==0)



			{										



			mysqli_query($conn,"insert into `shopurneeds_category_brand` (`catid`,`brandid`,`bdisplayflag`,`bpagename`) values ('".$_REQUEST['catid']."','".$bcode."','1','".$pagename2."')") ;								



			}	



			else



			{		



				



				mysqli_query($conn,"update `shopurneeds_category_brand` set bdisplayflag='1', `bpagename`='".$pagename2."'  where catid='".$_REQUEST['catid']."' and brandid='".$bcode."'"); 



			



			}		







		 





	mysqli_query($conn,"select bid,brandname from shopurneeds_brand where displayflag='1' and seller_id = '".$_GET['seller_id']."' order by brandname ASC") ;



				?>



		<select name="brand" class="inputselect">



			<option value="">---------- Select Brand ---------</option>



			<?php 



			while($rows_brand= mysqli_fetch_assoc())



			{																				



			?>



			<option value="<?php echo $rows_brand['bid']; ?>" <?php if($brand_code==$rows_brand['bid']) { ?> selected="selected" <?php } ?>><?php echo $rows_brand['brandname']; ?></option>	



			<?php 



			}



			?>											



	</select>				







<?php



	







} //end condition to check the value for sub categroy	//







else



{



?>



	<?php				



	mysqli_query($conn,"select bid,brandname from shopurneeds_brand where displayflag='1' and seller_id = '".$_GET['seller_id']."' order by brandname ASC") ;



	?>



	 



		<select name="brand" class="inputselect">



			<option value="">---------- Select Brand ---------</option>



			<?php 



			while($rows_brand= mysqli_fetch_assoc())



			{																				



			?>



			<option value="<?php echo $rows_brand['bid']; ?>"><?php echo $rows_brand['brandname']; ?></option>	



			<?php 



			}



			?>											



</select>



				



<?php



}



?>















