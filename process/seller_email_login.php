<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php"); 

$sql=mysqli_query($conn,"select * from `".$sufix."suppliers` WHERE emailid='".$_REQUEST['emailid']."'");
		$num=mysqli_num_rows($sql);
		if($num>0)//if data fetch
		{
			while($rows=mysqli_fetch_array($sql))//login id would set to session
			{
				$emailid=$rows['emailid'];
    			$_SESSION['id'] = $rows['id'];	
            	$_SESSION['sellerid'] = $rows['id'];		               
                $_SESSION['username'] = $rows['username'];	
            	$_SESSION['usertype'] = $rows['type']; 
			}
			
		?>
		<script>window.location.href='https://localhost/project/shopurneeds/seller-panel/dashboard';</script>
		<?php
		  		
		}
?>