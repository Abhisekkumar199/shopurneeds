<?php 
include("includes/configuration.php"); 
include("includes/header_sub.php");	
if(!$_SESSION['emailid']){
?>
<script language="javascript">

window.location.href="index.php?er=Either your session has been expired or you are not valid user";
</script>
<?php } ?>
<?php			 
	include("pages/myvouchers.php");
	include("includes/footer.php");
	
?>