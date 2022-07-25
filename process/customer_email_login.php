<?php
session_start();
include("includes/configuration.php");

$sql=mysqli_query($conn,"select * from `".$sufix."user_registration` WHERE emailid='".$_REQUEST['emailid']."'");
		$num=mysqli_num_rows($sql);
		
		if($num>0)//if data fetch
		{
			while($rows=mysqli_fetch_array($sql))//login id would set to session
			{
				$emailid=$rows['emailid'];
				$_SESSION['emailid']=$emailid;
				$_SESSION['fnamenew']=$rows['fname'];
				$_SESSION['useridse']=$rows['id'];
			}
		?>
		<script>window.location.href='<?php echo URL;?>/mydashboard.php';</script>
		<?php
		  		
		}
?>