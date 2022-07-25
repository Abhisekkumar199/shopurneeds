<?php 
##  PHP AdminPanel                                           	          
##  Developed by:  Pawan Kumar <pavan@exisolutionsgroup.com>   
##  Created Date:  29-Mar 2013 											
##  WebSite:       http://www.exisolutionsgroup.com/		                    
##  Copyright:     Exi Solutions Group@ 2013. All rights reserved.     			

class OrderSet{
//start class
			
			function basketquery($sql,$val,$subcatid,$bid)
			{
			
			if($subcatid!='')
			{
					if($val=='Delivered')
					{
						$sql2=$sql. " bid='".$bid."' and subsubcat_id='".$subcatid."' and basket_status='Delivered'";
					}
					elseif($_REQUEST['val']=='Cancelled')
					{
						$sql2=$sql. " bid='".$bid."' and subsubcat_id='".$subcatid."' and basket_status='Cancelled'";
					}
					else
					{
						$sql2=$sql. " bid='".$bid."' and subsubcat_id='".$subcatid."'";
						
					}
			}		
			else
			{
					if($val=='Delivered')
					{
						$sql2=$sql. " bid='".$bid."' and basket_status='Delivered'";
					}
					elseif($_REQUEST['val']=='Cancelled')
					{
						$sql2=$sql. " bid='".$bid."' and basket_status='Cancelled'";
					}
					else
					{
						$sql2=$sql. " bid='".$bid."'";
						
					}
			
			}
			//echo $sql2;
				return $sql2;		
		
		}
	
		function basket($sufix,$offername,$id)
		{
		 //echo "select stockavailability from ".$sufix."product `b` where b.id='".$pid."'";
		 if($id!='')
		 {
		 	//echo "select offername from ".$sufix."offers `a` where a.id='".$id."'";
		 	$sql=mysqli_query($conn,"select offername from ".$sufix."offers `a` where a.id='".$id."'");
			$rows=mysqli_fetch_array($sql);	
			echo $rows['offername'];
		 }
		 else
		 {
		 	echo $offername;
		 
		 }			
			
		}
		
		
		function category($sufix,$subid,$subsubid)
		{
		 //echo "select categoryname from ".$sufix."category `a`, ".$sufix."product `b`  where a.cat_id=b.subsubcat_id and b.id='".$pid."'";
		 if($subsubid!='')
		 {
		 	//echo "select categoryname from ".$sufix."category `a` where a.cat_id='".$subsubid."'";
		 	$sqlsubcat=mysqli_query($conn,"select categoryname from ".$sufix."category `a` where a.cat_id='".$subsubid."'");
				
			$rowsubsubcat=mysqli_fetch_array($sqlsubcat);
			$subsubcat=$rowsubsubcat['categoryname'];
		 }	
		 	
		 if($subid!='')
		 {
		 	$sqlsubcat=mysqli_query($conn,"select categoryname from ".$sufix."category `a` where a.cat_id='".$subid."'");
		 			
			$rowsubcat=mysqli_fetch_array($sqlsubcat);	
			 $subcat=$rowsubcat['categoryname'];
		}			
			
			echo $subcat."-".$subsubcat;
		
		}		
		
		
} //end class
$order= new OrderSet();	
?>