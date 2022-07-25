<?php session_start(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>

   $(document).ready(function() {
		$("#payuForm").submit();
	});
    </script>
<form action="https://localhost/project/shopurneeds/webservices1/pgRedirect.php" method="post" name="payuForm" id="payuForm">
     <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"	name="ORDER_ID" autocomplete="off"	value="<?php echo $_SESSION['oidapi']; ?>">
    <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $_SESSION['apiuserid']; ?>">
    <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
    <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
    <input type="hidden" title="TXN_AMOUNT" tabindex="10" name="TXN_AMOUNT" value="<?php echo $_SESSION['ordertotalcost']; ?>">
    
</form>