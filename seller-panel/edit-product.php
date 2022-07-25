<?php  
    session_start();
    include("include/configurationadmin.php");
    include("include/header.php");
    if($_SESSION['admin_language'] == 'AR') 
    {   
        include("pages/edit-product-arabic-inc.php");
    }
    else
    {
        include("pages/edit-product-inc.php");
    }
    include("include/footer.php");
?>