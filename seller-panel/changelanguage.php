<?php
$irlds=$_SERVER['HTTP_REFERER'];
session_start(); 
  $_SESSION['admin_language']=$_REQUEST['lang']; 
?>
<script type="text/javascript">
window.location = "<?php echo $irlds; ?>"
</script>