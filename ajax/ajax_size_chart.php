<?php 
session_start();
include("../config.inc.php");
include("../configuration.php"); 
include("../process/currency_display.php");  
$sizeno = $_REQUEST['sizeno'];
$productsid = $_REQUEST['productsid']; 

$text = '';
$sqlsizorde=mysqli_query($conn,"select sizename from shopurneeds_size");
while($roesizode=mysqli_fetch_array($sqlsizorde))
{
  $dddszeor .= "'".$roesizode['sizename']."',"; 
}

$ordesussa=substr($dddszeor,0,-1);  
$sqlsize=mysqli_query($conn,"select * from ".$sufix."product_size  where  product_id='".$productsid."' and qty!=0 ");  

if(mysqli_num_rows($sqlsize)>0)
{ 
    $i=1;
    while($rows=mysqli_fetch_array($sqlsize))
    { 
        $sqlproduct=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where displayflag='1' and id='".$productsid."'")) ;
        $master_sku=$sqlproduct['master_sku'];
        $sqlsize33=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product_size  where  product_id='".$productsid."' and product_size='".$sizeno."' group by product_size limit 1"));
    			 
       	$sellingprice = $sqlsize33['product_sellingprice'];
       	$mrpprice = $sqlsize33['product_mrp'];  
    	$pro_id = $productsid;	
    	 
    	$sql_deal =mysqli_query($conn,"select * from ".$sufix."deal where start_date <='".$_SESSION["current-date"]."' and end_date >='".$_SESSION["current-date"]."' and start_time <=  '".$_SESSION["current-time"]."' and 0 < FIND_IN_SET('$pro_id',products) "); 
        if(mysqli_num_rows($sql_deal) > 0)
        {
            $rows_deals = mysqli_fetch_assoc($sql_deal);
            $discount_percentage = $rows_deals['percentage'];  
            $discount_amount = ($mrpprice*$discount_percentage)/100;
            $sellprice2=$mrpprice-$discount_amount;
             
              $price = '<span class="amount"><span class="currencySymbol">'.Currency.'</span>'.floor($sellprice2*$_SESSION['conratio']).'</span>';
        }
        else
        {
	 	 	$sqlcoupan=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$master_sku%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='0' order by codeid desc");
			
			$sqlcoupan2=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$master_sku%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='2' order by codeid desc");
			$cashbacknum = mysqli_num_rows($sqlcoupan2);
			
			if(mysqli_num_rows($sqlcoupan)>0) 
        	{
        		$rowcoupan = mysqli_fetch_assoc($sqlcoupan);
                $rowcoupanvalue1 = ($mrpprice*$rowcoupan['discountvalue'])/100;
                $sellprice2=$mrpprice-$rowcoupanvalue1; 
                  $price = '<span class="amount"><span class="currencySymbol">'.Currency.'</span>'.floor($sellprice2*$_SESSION['conratio']).'</span>';
        	} 
        	else if($cashbacknum>0) 
        	{ 
                  $price = '<span class="amount"><span class="currencySymbol">'.Currency.'</span>'.floor($sellingprice*$_SESSION['conratio']).'</span>';
        	} 
        	else 
        	{   
                  $price = '<span class="amount"><span class="currencySymbol">'.Currency.'</span>'.floor($sellingprice*$_SESSION['conratio']).'</span>';  
        	} 
        }
        
    	$price2 = (floor($sqlsize33['product_mrp']*$_SESSION['conratio']));
    	$disclaimer = '<div class="alert alert-disclamier clearfix ob_10" id="DivShipping" style=""> DISCLAIMER - '.$sqlsize33['disclaimer'].'. </div>';
    	$i++;  
    } 
}    
?>

<?php	
    $array = array('sizetext'=>$text,"sellingprice"=>$price,"mrpprice"=>$price2,"allprice"=>$price3,"disclaimer"=>$disclaimer);
    echo $myJSON = json_encode($array);
?>
		