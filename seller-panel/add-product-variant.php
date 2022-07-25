<?php  
    session_start();
    include("include/configurationadmin.php");
    include("include/header.php");
    if($_SESSION['admin_language'] == 'AR') 
    {  
        include("pages/add-product-variant-arabic-inc.php");
    }
    else
    {
        include("pages/add-product-variant-inc.php"); 
    }
    include("include/footer.php");
?>