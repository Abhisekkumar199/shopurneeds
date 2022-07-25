<?php
$irlds=$_SERVER['HTTP_REFERER'];
session_start();
include("includes/configuration.php");
	
include("includes/libraries/mailfunction.php");
$sqlcur=mysqli_query($conn,"select * from shopurneeds_currency where displayflag='1' and id='".$_REQUEST['curid']."'"); 
$rowcur=mysqli_fetch_array($sqlcur);
$_SESSION['curdisplay']=$rowcur['currencydisplaycode'];
$_SESSION['currencycode']=$rowcur['currencycode'];
$_SESSION['conratio']=$rowcur['conratio'];
$_SESSION['currencyid']=$rowcur['id'];
?>
<script type="text/javascript">
window.location = "<?php echo $irlds; ?>"
</script>