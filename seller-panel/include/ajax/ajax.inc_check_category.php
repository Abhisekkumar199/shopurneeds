<?php

include_once('../classes/config.inc.php');

include_once('../classes/database.inc.php');

include_once('../libraries/function_inc.php');






if($_REQUEST["value_text"]!='') { 
$brandname = $_REQUEST["value_text"]; 
$checksql = mysqli_query($conn,"SELECT * FROM shopurneeds_brand WHERE brandname LIKE '$brandname%'");
if(mysqli_num_rows($checksql)>0) { 
echo "Already Exist brand";
echo "<br>";
while($brandrow = mysqli_fetch_assoc($checksql))
{
	echo $brandrow['brandname'];
	echo "<br>";
}
} else { 
echo "No record found!";
} }
?>