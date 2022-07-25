<?php 
session_start();
header('Access-Control-Allow-Origin: *');
include("includes/configuration.php"); 		
include("includes/con_inc.php");

  
if($_REQUEST['searchtext'] != '' or $_REQUEST['searchtext'] != ' ')
{
 
?>
<div id="top-select-searchautocomplete-list" class="autocomplete-items">
 
<?php
 
$sqlProduct = mysqli_query($conn,"select * from shopurneeds_product where displayflag ='1' and searchkeyword like '%".$_REQUEST['searchtext']."%'");
$num = mysqli_num_rows($sqlProduct); 
?> 
<?php

while($rows2=mysqli_fetch_array($sqlProduct)) 
{   
    $productname = $rows2['productname']; 
    ?>
        <a href="<?php echo URL; ?>/ksearch?ksearch=<?php echo $productname; ?>">
            <div class="dropdowndiv" style=" border-right: 1px solid #d2cdcd;border-bottom: 1px solid #d2cdcd;padding-top: 13px;
    padding-bottom: 13px;padding-left: 5px;"> 
                <?php echo $productname; ?>  
            </div>
        </a>
    <?php  
}

}
?>
</div>
 