<?php             
$username=$_SESSION['emailid'];  
if(!$username)
{
    header("Location:index.php?er=Either your session has been expired or you are not valid user");
    exit();
}
?>