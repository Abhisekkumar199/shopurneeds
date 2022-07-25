<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
$categorySqlmain = mysql_query("SELECT `cat_id`,`categoryname`,`uploadimage`,`uploadimage1`,`description` FROM `buyde_category` WHERE `displayflag` = '1' and parent='0'") or die(mysql_error());
    while($catRows = mysql_fetch_array($categorySqlmain)){
        	$categorySqlsub = mysql_query("SELECT `cat_id`,`categoryname`,`uploadimage`,`uploadimage1` FROM `buyde_category` WHERE `displayflag` = '1' and parent='".$catRows['cat_id']."'") or die(mysql_error());
    while($subcatRows = mysql_fetch_array($categorySqlsub)){
        	$subcatResult[] = array("subcatid"=>$subcatRows['cat_id'],"subcategoryname"=>$subcatRows['categoryname'],"subcategorydesc"=>$subcatRows['description'],"subimageurl"=>'https://www.buydebest.com/categoryimages/'.$subcatRows['uploadimage1']);
    }
	$catResult111[] = array("catid"=>$catRows['cat_id'],"categoryname"=>$catRows['categoryname'],"categorydesc"=>$catRows['description'],"imageurl"=>'https://www.buydebest.com/categoryimages/'.$catRows['uploadimage1'],"Subcategory"=>$subcatResult);
     $subcatResult="";	
     		
    }
        $response["topcategorysubcat"]=$catResult111;
                echo json_encode($response);

    
    ?>