<?php
$mid="31";
$APIKey="31D0E2916BOA53FO4BF3OBA3COCE8D950CF388";
$OrderID="12342";
$TotalAmount="10";
$TxnAmount="10";
$ResponseURL="https://localhost/project/shopurneeds/offerxoneresponse";
$Salt="3125162497X77DCX4D07XB13BX9F4F5BEF5C09";
$BankID="1";
$AID="OXSBI123";


$CheckSum = hash('sha256', $mid.'#'.$OrderID.'#'.$TotalAmount.'#'.$TxnAmount.'#'.$ResponseURL.'#'.$Salt);
//Sha256(MID#orderid#totalamt#txnamount#responseurl#saltvalue)
?>

<form method="POST" action="https://test.offerxone.com/pay.aspx">
    <input type="text" name="MID" value="<?php echo $mid; ?>" />
        <input type="text" name="APIKey" value="<?php echo $APIKey; ?>" />
    <input type="text" name="OrderID" value="<?php echo $OrderID; ?>" />
    <input type="text" name="TotalAmount" value="<?php echo $TotalAmount; ?>" />
    <input type="text" name="Discount" value="0" />
    <input type="text" name="DiscountType" value="1" />
    <input type="text" name="TxnAmount" value="<?php echo $TxnAmount; ?>" />
    <input type="text" name="PayMedium" value="1" />
    <input type="text" name="AID" value="<?php echo $AID; ?>" />
    <input type="text" name="BankID" value="<?php echo $BankID; ?>" />
    <input type="text" name="Couponcode" value="dddd" />
    <input type="text" name="ProductInfo" value="Testing Product" />
    <input type="text" name="ProductCat" value="tops" />
    <input type="text" name="CustName" value="shakti pratap" />
    <input type="text" name="CustEmail" value="shakti@webkype.com" />
    <input type="text" name="CustNumber" value="9953323804" />
    <input type="text" name="ResponseURL" value="https://localhost/project/shopurneeds/offerxoneresponse" />
    <input type="text" name="CheckSum" value="<?php echo $CheckSum; ?>" />
    <input type="submit" name="submit" value="Pay Now" />
    
    
</form>