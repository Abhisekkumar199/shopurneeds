<?php
$_SESSION['currencyid'] = '';
if($_SESSION['currencyid']=="")
{
    $ipdss=$_SERVER['REMOTE_ADDR'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://www.geoplugin.net/json.gp?ip='.$ipdss);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response, true);
    $councode= $result['geoplugin_currencyCode'];
    if($_SESSION['current_language'] == 'AR') 
    {
        $language = "AR";
    }
    else
    {
        $language = "INR";
    } 
    $sqlcutrsssa=mysqli_query($conn,"select * from shopurneeds_currency where currencycode='$language'");
    if(mysqli_num_rows($sqlcutrsssa)>0)
    {
        $sqlcutr=mysqli_fetch_array($sqlcutrsssa);
        $_SESSION['curdisplay']=$sqlcutr['currencydisplaycode'];
        $_SESSION['currencycode']=$sqlcutr['currencycode'];
        $_SESSION['conratio']=$sqlcutr['conratio'];
        $_SESSION['currencyid']=$sqlcutr['id']; 
        define('Currency', $_SESSION['curdisplay']);
        define('CurrencyCode', $_SESSION['currencycode']);
    }
    else
    {
        $sqlcutrsssaus=mysqli_query($conn,"select * from shopurneeds_currency where currencycode='$language'");
        $sqlcutruss=mysqli_fetch_array($sqlcutrsssaus);
         $_SESSION['curdisplay']=$sqlcutruss['currencydisplaycode'];
        $_SESSION['currencycode']=$sqlcutruss['currencycode'];
        $_SESSION['conratio']=$sqlcutruss['conratio'];
        $_SESSION['currencyid']=$sqlcutruss['id']; 
        define('Currency', $_SESSION['curdisplay']);
        define('CurrencyCode', $_SESSION['currencycode']);
    }
}
else
{  
define('Currency', $_SESSION['curdisplay']);
define('CurrencyCode', $_SESSION['currencycode']);
} 
?>