<?php

//start paging links 

function pagingall($offset,$num,$link,$page,$no_page,$display_range)
{  
	if($num > $offset)
	{
	$pager=new Pager();
	$pager=$pager->getPagerData($no_page, $display_range, $page, $offset);	
	
?>

<ul class="pagination">
			  <?php
					if ($page == 1)
						echo "&nbsp;&nbsp;";  
					else					
						echo "<li class='page-item disabled'><a class='page-link' href='$link?page=".($page - 1)."$paging' aria-label='Previous'><span aria-hidden='true'>&laquo;</span> <span class='sr-only'>Previous</span></a></li> ";  
						
					for ($i = $pager->lrange; $i <= $pager->rrange; $i++)
					{  
						if ($page != 1)
						{
							echo ""; 
						}
						if ($i == $pager->page)  
						{
							echo "<li class='page-item active'><a class='page-link' href='#'>$i <span class='sr-only'>(current)</span></a></li>";  
						}
						else
						{  
							if($i!=0)
							{
								echo "<li class='page-item'><a class='page-link' href='$link?page=$i$paging'>$i</a></li>";  
							}	
						}	
					}  
					if ($page == $pager->np)
					{ 
						echo "";  
					}
					else
					{ 
						echo "<li class='page-item'><a class='page-link' href='$link?page=".($page + 1)."$paging' aria-label='Next'><span aria-hidden='true'>&raquo;</span> <span class='sr-only'>Next</span></a></li>";  
					}	
				?>
		 
	</ul>
<?php	
	}
}

// show message

function session_msg() 
{ 
	if(isset($_SESSION['sessionMsg'])) 
	{ 
	    echo "<div align='center' class='alert'>".$_SESSION['sessionMsg']."</div>"; 
	    unset($_SESSION['sessionMsg']); 
	} 
}



error_reporting(E_ALL ^ E_NOTICE);

function removespecialcharacter($value) { 

$data_slug = trim(strtolower($value));
         $search = array('/','\\',':',';','!','@','#','$','%','^','*','(',')','_','+','=','|','{','}','[',']','"',"'",'<','>',',','?','~','`','&','.',' ');
      return $data_slug1 = str_replace($search, "-", $data_slug);

}

function removespecialcharacterslug($value) { 

$data_slug = trim(strtolower($value));
         $search = array('/','\\',':',';','!','@','#','$','%','^','*','(',')','_','+','=','|','{','}','[',']','"',"'",'<','>',',','?','~','`','&','.',' ');
      return $data_slug1 = str_replace($search, "-", $data_slug);

}

function getCountry($sufix,$countrycode) {
	global $conn;
		$sqlc="select countryname from `".$sufix."country` where `countrycode`='".$countrycode."'";
	
	 $qr123=mysqli_query($conn,$sqlc);
	
	 $rows=mysqli_fetch_assoc($qr123);
	
	 return $rows['countryname'];
} 

function change2dmy($date) 
{
	$dtmp = explode("-",$date);
	echo $date=$dtmp[2]."-".$dtmp[1]."-".$dtmp[0];
}

function getExtension($str) 
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}

function categoryname($sufix,$var,$cattype){
global $conn;
 $sqlc="select categoryname from `".$sufix."category` where `cat_id`='$var' and displayflag='1' and `cat_type`='".$cattype."'";

 $qr123=mysqli_query($conn,$sqlc);

 $rows=mysqli_fetch_array($qr123);

 return $rows['categoryname'];

}





function changedate($date) 

{

	$dtmp = explode("-",$date);

	$date=$dtmp[2]."-".$dtmp[1]."-".$dtmp[0];

	return $date;

}



function changedateform($date) 

{

	$dtmp = explode("/",$date);

	$date=$dtmp[2]."-".$dtmp[0]."-".$dtmp[1];

	return $date;

}





function changedateform2($date) 

{

	$dtmp = strtotime($date);

	$date=date('d-M-Y', $dtmp);

	return $date;

}





function changedateform3($date) 

{

	$dtmp = strtotime($date);

	$date=date('d-M-Y', $dtmp);

	return $date;

}







/*function GetDays($sStartDate, $sEndDate){

  // Firstly, format the provided dates.

  // This function works best with YYYY-MM-DD

  // but other date formats will work thanks

  // to strtotime().

  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));

  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));



  // Start the variable off with the start date

  $aDays[] = $sStartDate;



  // Set a 'temp' variable, sCurrentDate, with

  // the start date - before beginning the loop

  $sCurrentDate = $sStartDate;



  // While the current date is less than the end date

  while($sCurrentDate < $sEndDate){

	// Add a day to the current date

	$sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));



	// Add this new day to the aDays array

	$aDays[] = $sCurrentDate;

  }



  // Once the loop has finished, return the

  // array of days.

  return $aDays;

}*/

function cityname($sufix,$var){
global $conn;
$sqlc="select cityname from `".$sufix."city` where cityid='$var' and displayflag='1'";

$qr123=mysqli_query($conn,$sqlc);

$rows=mysqli_fetch_array($qr123);

return $rows['cityname'];

}





function dDiff($d1, $d2) {

// Return the number of days between the two dates:



  return round(abs(strtotime($d1)-strtotime($d2))/86400);



} 

function changedateform1($date) 

{

	$dtmp = explode("/",$date);

	$date=$dtmp[2]."-".$dtmp[0]."-".$dtmp[1];

	return $date;

}



function changedateform4($date) 

{

	$dtmp = explode("-",$date);

	$date=$dtmp[1]."/".$dtmp[2]."/".$dtmp[0];

	return $date;

}





/*function daydiff($end_date,$start_date){	

		$date_part1=explode("-",$start_date);

		$date_part2=explode("-",$end_date);

		$start_date=gregoriantojd($date_part1[1],$date_part1[2],$date_part1[0]);

		$end_date=gregoriantojd($date_part2[1],$date_part2[2],$date_part2[0]);

		return($end_date - $start_date);

}*/





//to check null value at view details

function chknull($val)

{

	if($val=="")

	{

		echo "NA";

	}

	else

	{

		echo $val;

	}

}





function chknull2($val)

{

	if($val=="")

	{

		echo "There is no records found Please try after some time";

	}

	else

	{

		echo $val;

	}

}



//to check option value

function chkoption($val)

{

	if($val=="1")

	{

		echo "Yes";

	}

	else

	{

		echo "No";

	}

}







//start paging function

function paging2($query)

{

		$offset=5;

			$display_range=5;

			$page=1;

			if(isset($_REQUEST['page'])){   

				$page=$_REQUEST['page']; 

				if($page!=1){

					$a=$page-1;

					$j=1+($offset*$a);

				}else{

					$j=1;

				}

			}else{

				$j=1;

			}

		

		$sqlpro1=mysqli_query($query) ;	

		$num=mysqli_num_rows($sqlpro1);	

		$no_page = max(1,ceil($num/$offset));

		$pager = Pager::getPagerData($no_page, $display_range, $page, $offset);

		

		$sqlpro2=mysqli_query($query." LIMIT $pager->offset, $offset");	

		//paginglinks();

		

		return $sqlpro2;

}

//end paging function





//start paging function

function paging($query)

{

		$offset=4;

			$display_range=5;

			$page=1;

			if(isset($_REQUEST['page'])){   

				$page=$_REQUEST['page']; 

				if($page!=1){

					$a=$page-1;

					$j=1+($offset*$a);

				}else{

					$j=1;

				}

			}else{

				$j=1;

			}

		

		$sqlpro1=mysqli_query($query) ;	

		$num=mysqli_num_rows($sqlpro1);	

		$no_page = max(1,ceil($num/$offset));

		$pager = Pager::getPagerData($no_page, $display_range, $page, $offset);

		

		$sqlpro2=mysqli_query($query." LIMIT $pager->offset, $offset");	

		//paginglinks();

		

		return $sqlpro2;

}

//end paging function



//start paging links



function paginglinks($query,$paging,$link)

{

			$offset=3;

			$display_range=5;

			$page=1;

			if(isset($_REQUEST['page'])){   

				$page=$_REQUEST['page']; 

				if($page!=1){

					$a=$page-1;

					$j=1+($offset*$a);

				}else{

					$j=1;

				}

			}else{

				$j=1;

			}

		

		$sqlpro1=mysqli_query($query) ;	

		$num=mysqli_num_rows($sqlpro1);	

		$no_page = max(1,ceil($num/$offset));

		$pager = Pager::getPagerData($no_page, $display_range, $page, $offset);

		$sqlpro2=mysqli_query($query." LIMIT $pager->offset, $offset");

		

	if($num > $offset)

	{

	

?>

	<table width=100%>

		<tr>

		  <td align=center colspan=2 >

			

			  <?php

					if ($page == 1)

						echo "&nbsp;&nbsp;";  

					else					

						echo "<span class='paginglink'><a href='$link?page=".($page - 1)."$paging' class='paginglink'><<</a></span>&nbsp;";  

					for ($i = $pager->lrange; $i <= $pager->rrange; $i++){  

						if ($page != 1){

							echo ""; 

						}

							

						if ($i == $pager->page)  {

							echo "<span class='paginglink'> $i </span>&nbsp;";  

						}else{  

							if($i!=0){

								echo "<span class='paginglink'><a class='paginglink' href='$link?page=$i$paging'>$i</a></span>&nbsp;";  

							}	

						}	

					}  

					if ($page == $pager->np){ 

						echo "";  

					}else{ 

						echo "<span class='paginglink'><a class='paginglink' href='$link?page=".($page + 1)."$paging'>>></a></span>&nbsp;";  

					}	

				?>

			

		

		</td>

	</tr>

	</table>

<?php	

	}



}

//end paging links









//to check null value at view details

function nullvalue()

{

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

	<td valign="middle" style="padding:10px;" height="15">										

		<div align="center" class="alert">		

				<?php echo "Either records not found or you are selecting null value"; ?>		

		</div>		 

	 </td>

</tr>	

</table>

<?php 

}





//view button

function pagingpro($query)

{

		$offset=5;

			$display_range=5;

			$page=1;

			if(isset($_REQUEST['page'])){   

				$page=$_REQUEST['page']; 

				if($page!=1){

					$a=$page-1;

					$j=1+($offset*$a);

				}else{

					$j=1;

				}

			}else{

				$j=1;

			}

		

		$sqlpro1=mysqli_query($query) ;	

		$num=mysqli_num_rows($sqlpro1);	

		$no_page = max(1,ceil($num/$offset));

		$pager = Pager::getPagerData($no_page, $display_range, $page, $offset);

		

		$sqlpro2=mysqli_query($query." LIMIT $pager->offset, $offset");	

		//paginglinks();

		

		return $sqlpro2;

}

//end paging function





//view button

function paging2pro($query)

{

		$offset=5;

			$display_range=5;

			$page=1;

			if(isset($_REQUEST['page'])){   

				$page=$_REQUEST['page']; 

				if($page!=1){

					$a=$page-1;

					$j=1+($offset*$a);

				}else{

					$j=1;

				}

			}else{

				$j=1;

			}

		

		$sqlpro1=mysqli_query($query) ;	

		$num=mysqli_num_rows($sqlpro1);	

		$no_page = max(1,ceil($num/$offset));

		$pager = Pager::getPagerData($no_page, $display_range, $page, $offset);

		

		$sqlpro2=mysqli_query($query." LIMIT $pager->offset, $offset");	

		//paginglinks();

		

		return $sqlpro2;

}

//end paging function







//start function for Static Content query

function staticon($tb)

{

	$sqlstatic="select * from $tb where displayflag='1' ORDER BY id DESC";

	return $sqlstatic;

	//return $sqlproduct;		

}

//end function for static content query;









//start paging function

function pagingsearch($query)

{

  $offset=5;

   $display_range=5;

   $page=1;

   if(isset($_REQUEST['page'])){   

    $page=$_REQUEST['page']; 

    if($page!=1){

     $a=$page-1;

     $j=1+($offset*$a);

    }else{

     $j=1;

    }

   }else{

    $j=1;

   }

  

  $sqlpro1=mysqli_query($query) ; 

  $num=mysqli_num_rows($sqlpro1); 

  $no_page = max(1,ceil($num/$offset));

  $pager = Pager::getPagerData($no_page, $display_range, $page, $offset);

  

  $sqlpro2=mysqli_query($query." LIMIT $pager->offset, $offset"); 

  //paginglinks();

  

  return $sqlpro2;

}











function session_msg2()

{

	if(isset($_SESSION['sessionMsg2']))

	{

?>

<div align='center' style='color:#FF0000;font-size:11px;'><?php echo $_SESSION['sessionMsg2']; ?>'</div>'



<?php	

	

	

	unset($_SESSION['sessionMsg2']);

	}

}



function get_msg()

{

	if(isset($_REQUEST['msg']))

	{

	echo "<div align='center' class='alert'>".$_REQUEST['msg']."</div>";

	

	//unset($_SESSION['sessionMsg']);

	}

}

function sqlquery($querytype,$sufix)

{

//echo $sufix;

	if($querytype=='category')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."category where cat_id='".$_REQUEST['id']."' order by cat_id desc";

		}

		else

		{

			$sql="select * from ".$sufix."category order by cat_id desc";

		

		}

	

	}

	

	elseif($querytype=='banners')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."banners where id='".$_REQUEST['id']."' order by id desc";

		}

		else

		{

			$sql="select * from ".$sufix."banners order by id desc";

		

		}

	

	}

	

	elseif($querytype=='brand')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."brand where bid='".$_REQUEST['id']."' order by bid desc";

		}

		else

		{

			$sql="select * from ".$sufix."brand order by bid desc";

		

		}

	

	}

	

	elseif($querytype=='navigation')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."navigation where nav_id='".$_REQUEST['id']."' order by nav_id desc";

		}

		else

		{

			$sql="select * from ".$sufix."navigation order by nav_id desc";

		}

	

	}

	

	elseif($querytype=='offer')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."offers where id='".$_REQUEST['id']."' order by id desc";

		}

		else

		{

			$sql="select * from ".$sufix."offers order by id desc";		

		}

	

	}

	

	elseif($querytype=='poffer')

	{

		$sql="select * from ".$sufix."offers order by id desc";		

	}

	

	if($querytype=='product')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."product where id='".$_REQUEST['id']."' order by id desc";

		}

		else

		{

			$sql="select * from ".$sufix."product order by id desc";

		

		}	

	}

	

	elseif($querytype=='variation')

	{

		

		$sql="select * from ".$sufix."product_variant order by vproductcode desc";

		

	}



	elseif($querytype=='shipping')

	{

		if($_REQUEST['id'])

		{

			$sql="select * from ".$sufix."shipping where wid='".$_REQUEST['id']."' order by wid desc";

		}

		else

		{

			$sql="select * from ".$sufix."shipping order by wid desc";		

		}

	

	}

	//

	return $sql;

}





function sqlquery2($querytype,$id,$sufix)

{

	if($querytype=='category')

	{

		

		$sql="select categoryname from ".$sufix."category where cat_id='".$id."'";		

	

	}	

	if($querytype=='navigation')

	{		

		$sql="select categoryname from ".$sufix."category where cat_id='".$id."'";	

	

	}

	return $sql;

}



function sort_arrows($column)

{

	return '<A HREF="' . $_SERVER['PHP_SELF'] .	get_qry_str(array('order_by', 'order_by2'),	array($column, 'asc')) . '"><img src="images/up_arrow.png" border="0" width="14" height="14"></a>	<a href="'	. $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column,	'desc')) . '"><img src="images/down_arrow.png" border="0" width="14" height="14"></a>';

}



// get_qry_str: Updated 31 may 2006

function get_qry_str($over_write_key = array(),	$over_write_value =	array())

{

	global $_GET;

	$m = $_GET;

	if (is_array($over_write_key)) {

		$i = 0;

		foreach($over_write_key	as $key) {

			$m[$key] = $over_write_value[$i];

			$i++;

		}

	} else {

		$m[$over_write_key]	= $over_write_value;

	}

	$qry_str = qry_str($m);

	return $qry_str;

}



// qry_str: Updated 31 may 2006

function qry_str($arr, $skip = '')

{

	$s = "?";

	$i = 0;

	foreach($arr as	$key =>	$value)	{

		if ($key !=	$skip) {

			if (is_array($value)) {

				foreach($value as $value2) {

					if ($i == 0) {

						$s .= $key . '[]=' . $value2;

						$i = 1;

					} else {

						$s .= '&' .	$key . '[]=' . $value2;

					}

				}

			} else {

				if ($i == 0) {

					$s .= "$key=$value";

					$i = 1;

				} else {

					$s .= "&$key=$value";

				}

			}

		}

	}

	return $s;

	

}



function orderby($id)

{	

	if($_REQUEST['order_by'])

	{

		$order_by=$_REQUEST['order_by'];

	}

	else

	{

		$order_by=$id;

	

	}

	return $order_by;	

}





function orderby2($ord)

{	

	

	if($_REQUEST['order_by2'])

	{

		$order_by2=$_REQUEST['order_by2'];

	}	

	else

	{

		$order_by2=$ord;

	}



	

	return $order_by2;

}








function pagingall2($offset,$num,$link,$page,$no_page,$display_range)
{
	if($num > $offset)
	{
	$pager=new Pager();
	$pager=$pager->getPagerData($no_page, $display_range, $page, $offset);	
?>
<table width=100%>
		<tr>
		  <td align=right colspan=2>
			  <?php
					if ($page == 1)
						echo "&nbsp;&nbsp;";  //
					else					
						echo "<span class='paginglink'><a href='$link?paging=true&page=".($page - 1)."$paging' class='paginglink'><<</a></span>&nbsp;";  
					for ($i = $pager->lrange; $i <= $pager->rrange; $i++){  
						if ($page != 1){
							echo ""; 
						}
						if ($i == $pager->page)  {
							echo "<span class='paginglink'> $i </span>&nbsp;";  
						}else{  
							if($i!=0){
								echo "<span class='paginglink'><a class='paginglink' href='$link?paging=true&page=$i$paging'>$i</a></span>&nbsp;";  
							}	
						}	
					}  
					if ($page == $pager->np){ 
						echo "";  
					}else{ 
						echo "<span class='paginglink'><a class='paginglink' href='$link?paging=true&page=".($page + 1)."$paging'>>></a></span>&nbsp;";  
					}	
				?>
		</td>
	</tr>
	</table>
<?php	
	}
}


//end paging links





//function for disable table



function enable_disable($ids,$tb,$chkstatus,$link,$option)

{ 
	if($chkstatus=='enable2') 
	{ 
		$status2='1'; 
	}  
	elseif($chkstatus=='disable2') 
	{ 
		$status2='0'; 
	} 
	$ids2=explode(",",$ids); 
	for($i=0; $i<=count($ids2); $i++)

	{

		if($ids2[$i]!='')

		{

			

			  $sql="update ".$tb." set `displayflag`='".$status2."' where ".$option."=".$ids2[$i];

			mysqli_query($sql);

		

		}

		

	}

	



}

//end function for multiple records







function sdelete($id,$tb,$type,$option,$sufix)

{

	

	

	//echo $type;

	if($type=='category')

	{	

	//echo "delete from ".$sufix."category where parent=".$id;	

		mysqli_query($conn,"delete from ".$sufix."category where cat_id=".$id);

		$sql2=mysqli_query($conn,"select * from ".$sufix."category where parent='".$id."'");

		while($row=mysqli_fetch_array($sql2))

		{

			mysqli_query($conn,"delete from ".$sufix."category where parent=".$row['cat_id']);

			mysqli_query($conn,"update `".$sufix."product` set cat_id='',subcat_id='',subsubcat_id='',`displayflag`='0' where cat_id='".$id."'");

			

		}

	

	}	

	elseif($type=='subcategory')

	{		

		//echo "select * from ".$sufix."category where parent='".$id."'"; 

		mysqli_query($conn,"delete from ".$sufix."category where cat_id=".$id);

		$sql2=mysqli_query($conn,"select * from ".$sufix."category where parent='".$id."'");

		while($row=mysqli_fetch_array($sql2))

		{

						

			mysqli_query($conn,"delete from ".$sufix."category where cat_id=".$row['cat_id']);

			mysqli_query($conn,"update `".$sufix."product` set cat_id='',subcat_id='',subsubcat_id='',`displayflag`='0' where subcat_id='".$id."'");

			

		}	

	}



	elseif($type=='subsubcategory')

	{		

		mysqli_query($conn,"delete from ".$sufix."category where cat_id=".$id);

		mysqli_query($conn,"update `".$sufix."product` set cat_id='',subcat_id='',subsubcat_id='',`displayflag`='0' where subsubcat_id='".$id."'");

	}

	

	

	elseif($type=='brand')

	{	

		

		   mysqli_query($conn,"delete from ".$sufix."brand where bid=".$id);

		//echo "update `".$sufix."product` set bid='' where bid='".$id."'";	

			mysqli_query($conn,"update `".$sufix."product` set bid='' where bid='".$id."'");

	}

	

	elseif($type=='offer')

	{		

		

		$sql2=mysqli_query($conn,"select * from ".$sufix."offers where id='".$id."'");

		while($row=mysqli_fetch_array($sql2))

		{

			mysqli_query($conn,"delete from ".$sufix."offers where id=".$row['id']);

			mysqli_query($conn,"update `".$sufix."product` set offername='' where offername='".$row['offername']."'");

			

		}

	

	}

	elseif($type=='shipping')

	{		

		

			mysqli_query($conn,"delete from ".$sufix."shipping where wid=".$id);

	}

	elseif($type=='shippingmethod')

	{		

		

			mysqli_query($conn,"delete from ".$sufix."shippingmethod where sid=".$id);

	}

	elseif($type=='product')

	{		

		

		//$sql2=mysqli_query($conn,"select * from ".$sufix."product where id='".$id."'"); 

		//while($row=mysqli_fetch_array($sql2)) 

		//{

			mysqli_query($conn,"delete from ".$sufix."product_variant where pid=".$id);

			mysqli_query($conn,"delete from ".$sufix."product where id=".$id);

			

		//}

	

	}

	

	else

	{
		 
			$sql=mysqli_query($conn,"delete from ".$tb." where ".$option."=".$id);
		mysqli_query($conn,"delete from ".$tb." where id=".$id);

	

	}

		

	

}



//start delete function for multiple delete 



function mdelete($ids,$tb,$type,$option,$sufix)

{

	

	$ids2=explode(",",$ids);

	for($i=0; $i<=count($ids2); $i++)

	{

		if($ids2[$i]!='')

		{

	

			$sql="delete from ".$tb." where ".$option."=".$ids2[$i];

	if($type=='category')

	{		

		mysqli_query($conn,"delete from ".$sufix."category where parent=".$ids2[$i]);

		$sql2=mysqli_query($conn,"select * from flip_category where parent='".$ids2[$i]."'");

		while($row=mysqli_fetch_array($sql2))

		{

			mysqli_query($conn,"delete from ".$sufix."category where parent=".$row['cat_id']);

			mysqli_query($conn,"update `".$sufix."product` set cat_id='',subcat_id='',subsubcat_id='',`displayflag`='0' where cat_id='".$ids2[$i]."'");

			

		}

	

	}

	

		if($type=='subcategory')

		{		

			

			$sql2=mysqli_query($conn,"select * from ".$sufix."category where parent='".$id."'");

			while($row=mysqli_fetch_array($sql2))

			{

				mysqli_query($conn,"delete from ".$sufix."category where parent=".$row['cat_id']);

				mysqli_query($conn,"update `".$sufix."product` set cat_id='',subcat_id='',subsubcat_id='',`displayflag`='0' where subcat_id='".$ids2[$i]."'");

				

			}

		

		}



		if($type=='subsubcategory')

		{		

			mysqli_query($conn,"update `".$sufix."product` set cat_id='',subcat_id='',subsubcat_id='',`displayflag`='0' where subsubcat_id='".$ids2[$i]."'");

		}

	

	

		if($type=='brand')

		{		

			mysqli_query($conn,"update `".$sufix."product` set bid='' where bid='".$ids2[$i]."'");

		}

	

		mysqli_query($sql);	

	

		}

	}		

	

}





//end delete function for multiple delete





function create_slug($string){

   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);

   return $slug;

}



function getrecords($table,$link,$field,$field2)

{	

	$sql2=mysqli_query($conn,"select $field2 from $table where $field2='".$field."'");

	$num=mysqli_num_rows($sql2);

	if($num > 0)

	{

		$_SESSION['sessionMsg']="Record already exist";

		header("Location:".$link);

		exit();

	

	}



}



function getrecordssub($table,$link,$field,$field2,$field3,$field4)

{	

	$sql2=mysqli_query($conn,"select $field2 from $table where $field2='".$field."' and $field4='".$field3."'");

	$num=mysqli_num_rows($sql2);

	if($num > 0)

	{

		$_SESSION['sessionMsg']="Record already exist";

		header("Location:".$link);

		exit();

	

	}



}







function chkquerystring($back)

{

	if($_REQUEST['id']=='')

	{

?>

<script language="javascript">

window.location.href='<?php echo $back; ?>';

</script>

<?php	

	

	}



}





function vartype($vartype)

{

	if($vartype=='3')

	{

		echo '<td width="6%" style="padding-left:3px;">Size</td>';

		echo '<td width="6%" style="padding-left:3px;">Color</td>';		

	

	}

	if($vartype=='2')

	{

		echo '<td width="6%" style="padding-left:3px;">Size</td>';



	}

	if($vartype=='1')

	{

		echo '<td width="6%" style="padding-left:3px;">Color</td>';



	}

		



}





function vartype2($vartype)

{

	if($vartype=='3')

	{

		echo 'Size,Color';			

	

	}

	if($vartype=='2')

	{

		echo 'Size';



	}

	if($vartype=='1')

	{

		echo 'Color';



	}

	if($vartype=='')

	{

		echo 'NA';

	

	}

}





function vartype3($vartype)

{

	if($vartype=='3')

	{

		$var='Size,Color';			

	

	}

	if($vartype=='2')

	{

		$var='Size';



	}

	if($vartype=='1')

	{

		$var='Color';



	}

	return $var;

}



function sub_subcategory($var,$sufix)

{ // 

//echo "select categoryname from `".$sufix."category where cat_id='".$var."'";

	$sql=mysqli_query($conn,"select categoryname from `".$sufix."category` where cat_id='".$var."'");

	

	$row=mysqli_fetch_array($sql);

	

	return $row['categoryname'];

}



function productoffer($var,$sufix)

{

	$row=mysqli_fetch_array(mysqli_query($conn,"select offername from `".$sufix."offers` where id='".$var."'"));

	return $row['offername'];

}







function productbrand($var,$sufix)

{

	$row=mysqli_fetch_array(mysqli_query($conn,"select brandname from `".$sufix."brand` where bid='".$var."'"));

	return $row['brandname'];

}



function apply_filter($sql,	$field,	$field_filter, $column1,$column2,$column3)

{

	if (!empty($field))	{

		if ($field_filter == "=" || $field_filter == "") {

			$sql = $sql	. "	and	$column	= '$field' ";

		} else if ($field_filter == "like")	{

			$sql = $sql	. "	and	$column	like '%$field%'	";

		} else if ($field_filter ==	"starts_with") {

			$sql = $sql	. "	and	$column	like '$field%' ";

		} else if ($field_filter ==	"ends_with") {

			$sql = $sql	. "	and	$column	like '%$field' ";

		} else if ($field_filter ==	"not_contains")	{

			$sql = $sql	. "	and	$column	not	like '%$field%'	";

		} else if ($field_filter ==	"!=") {

			$sql = $sql	. "	and	$column	!= '$field'	";

		} else if ($field_filter ==	"IN") {

			$sql = $sql	. "	or $column	IN ($field)	";

		}

	}

	return $sql;

}



function apply_filter2($sql,$field, $column1,$column2,$column3)

{

	if (!empty($field))	{

	

		if($column1!='' && $column2!='' && $column3!='')

		{

			$sql = $sql. "	and	($column1 like '%$field%' or	$column2 like '%$field%' or	$column3 like '$field%') ";

		}

		elseif($column1!='' && $column2!='' && $column3=='')

		{

			$sql = $sql. "	and	($column1 like '%$field%' or	$column2 like '%$field%')";		

		}

		elseif($column1!='' && $column2=='' && $column3!='')

		{

			$sql = $sql. "	and	($column1 like '%$field%' or	$column3 like '$field%' )";		

		}

		elseif($column1=='' && $column2!='' && $column3!='')

		{

			$sql = $sql. "	and	($column2 like '%$field%' or	$column3 like '$field%' )";		

		}

		elseif($column1!='' && $column2=='' && $column3=='')

		{

			$sql = $sql. "	and	$column1 like '%$field%'";		

		}

		elseif($column1=='' && $column2!='' && $column3=='')

		{

			$sql = $sql. "	and	$column2 like '%$field%'";		

		}

		elseif($column1=='' && $column2=='' && $column3!='')

		{

			$sql = $sql. "	and	$column3 like '%$field%'";		

		}

	}

	

	//echo $sql;

	

	return $sql;

}







function predit()

{

	if($_REQUEST['option']=='Edit')

	{	

		echo $editlink="?id=".$_REQUEST['id']."&option=".$_REQUEST['option']."&page=".$_REQUEST['page'];

	}

	else

	{

		echo $editlink="?id=".$_REQUEST['id'];

	

	}

	//return $editlink;



}









function cssclass()

{

	if($_REQUEST['option']=='Edit')

	{

		echo $cssclass='button7';	

	}

	elseif($_REQUEST['option']=='View')

	{

		echo $cssclass='button7';	

	}

	else

	{	

		echo $cssclass='button6';

	}

	return $cssclass;





}



function optionval()

{

	if($_REQUEST['option']=='Edit')

	{

		echo $option='Edit';	

	}

	elseif($_REQUEST['option']=='View')

	{

		echo $option='View';	

	}

	else

	{	

		echo $option='Add';

	}

	return $option;

}





/*function daydiff($end_date,$start_date){	

		$date_part1=explode("-",$start_date);

		$date_part2=explode("-",$end_date);

		$start_date=gregoriantojd($date_part1[1],$date_part1[2],$date_part1[0]);

		$end_date=gregoriantojd($date_part2[1],$date_part2[2],$date_part2[0]);

		return($end_date - $start_date);

	}

	$t = mktime(0,0,0,date("m"),date("d")-10,date("Y"));

	$ex_date=date("Y-m-d", $t);*/





function daydiff($end_date,$start_date) 

{



	$date1 = $end_date;

	$date2 = $start_date;

	

	$diff = abs(strtotime($date2) - strtotime($date1));

	

	$years = floor($diff / (365*60*60*24));

	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	return $days;



}



function userorder($val,$status,$payment,$sufix)

{ //function for product list page;

	

	if($payment=='1')	

	{	

	if($_REQUEST['email']!="" && $_REQUEST['oid']!="")

	{

		if($status=='Delivered')

		{

			$sql="select * from ".$sufix."order `a` where email_id='".$_REQUEST['email']."' and oid='".$_REQUEST['oid']."' and approve_status='".$val."'   and deliver_status='1' and paymentflag='".$payment."' order by oid desc";	

		}

		elseif($status=='Cancelled')

		{

			$sql="select * from ".$sufix."order `a` where email_id='".$_REQUEST['email']."' and oid='".$_REQUEST['oid']."' and cancelstatus='1' and paymentflag='".$payment."' order by oid desc";	

		

		}

		else

		{

			$sql="select * from ".$sufix."order `a` where email_id='".$_REQUEST['email']."' and oid='".$_REQUEST['oid']."' and approve_status='".$val."' and paymentflag='".$payment."' order by oid desc";	

		

		}

	}

	

	elseif($_REQUEST['email']!="" && $_REQUEST['oid']=="")

	{

		if($status=='Delivered')

		{

			$sql="select * from ".$sufix."order `a` where email_id='".$_REQUEST['email']."' and approve_status='".$val."' and paymentflag='".$payment."' and deliver_status='1' order by oid desc";

		}

		elseif($status=='Cancelled')

		{

			$sql="select * from ".$sufix."order `a` where email_id='".$_REQUEST['email']."' and cancelstatus='1' and paymentflag='".$payment."' order by oid desc";	

		

		}

		else

		{

			$sql="select * from ".$sufix."order `a` where email_id='".$_REQUEST['email']."' and approve_status='".$val."' and paymentflag='".$payment."' order by oid desc";	

		

		}

	

	}

	elseif($_REQUEST['email']=="" && $_REQUEST['oid']!="")

	{

		if($status=='Delivered')

		{

			$sql="select * from ".$sufix."order `a` where oid='".$_REQUEST['oid']."' and approve_status='".$val."' and paymentflag='".$payment."' and deliver_status='1' order by oid desc";

		}

		elseif($status=='Cancelled')

		{

			$sql="select * from ".$sufix."order `a` where oid='".$_REQUEST['oid']."' and cancelstatus='1' and paymentflag='".$payment."' order by oid desc";	

		

		}

		else

		{

			$sql="select * from ".$sufix."order `a` where oid='".$_REQUEST['oid']."' and approve_status='".$val."'  and paymentflag='".$payment."' order by oid desc";	

		

		}		

	

	}	

	else

	{

		if($status=='Delivered')

		{

			$sql="select * from ".$sufix."order `a` where approve_status='".$val."' and paymentflag='".$payment."' and deliver_status='1' order by oid desc";

		}

		elseif($status=='Cancelled')

		{

			$sql="select * from ".$sufix."order `a` where cancelstatus='1' and paymentflag='".$payment."' order by oid desc";	

		

		}

		else

		{

			$sql="select * from ".$sufix."order `a` where approve_status='".$val."'  and paymentflag='".$payment."' order by oid desc";	

		

		}		

	}

	}

	elseif($payment=='0')

	{

		$sql="select * from ".$sufix."order `a` where oid='".$val."' and paymentflag='".$payment."' order by oid desc";	

	

	}

	

	//echo $sql;

		return $sql;	

}





/*function provariant()

{

	if($num2=='')

	{

		$pid=

	

	

	}



}*/



function substrword3($text, $maxchar, $end='') {

if (strlen($text) > $maxchar || $text == '') {

	$words = preg_split('/\s/', $text);      

	$output = '';

	$i      = 0;

	while (1) {

		$length = strlen($output)+strlen($words[$i]);

		if ($length > $maxchar) {

			break;

		} 

		else {

			$output .= " " . $words[$i];

			++$i;

		}

	}

	$output .= $end;

} 

else {

	$output = $text;

}

return $output;

}



function substrword4($text, $maxchar, $end='') {

if (strlen($text) > $maxchar || $text == '') {

	$words = preg_split('/\s/', $text);      

	$output = '';

	$i      = 0;

	while (1) {

		$length = strlen($output)+strlen($words[$i]);

		if ($length > $maxchar) {

			break;

		} 

		else {

			$output .= " " . $words[$i];

			++$i;

		}

	}

	$output .= $end;

} 

else {

	$output = $text;

}

return $output;

}







function subcatmenu($text, $maxchar, $end='') {



if (strlen($text) > $maxchar || $text == '') {

	$words = preg_split('/\s/', $text);      

	$output = '';

	$i      = 0;

	while (1) {

		$length = strlen($output)+strlen($words[$i]);

		if ($length > $maxchar) {

			break;

		} 

		else {

			$output .= " " . $words[$i];

			++$i;

		}

	}

	$output .= $end;

} 

else {

	$output = $text;

}

return $output;

}





function word_cut_for_chars($c, $l, $e = "...") {

	if( strlen($c)> $l) {

		$a = explode(' ',$c);

		$s = 0;

		$r = "";

		for($i=0; $i<count($a); $i++) {

			$s += strlen($a[$i]);

			// $s += ( strlen($a[$i]) + 1);  // conta anche "lo spazio"

			if($s> $l ) return ($r . $e);

			$r .= $a[$i] . " ";

		}

	}

	return $c;

}









function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 

{

  // open the directory

 // $dir = opendir( $pathToImages );



  // loop through it, looking for any/all JPG files:

  //while (false !== ($fname = readdir( $dir ))) {

    // parse path for the extension

    $info = pathinfo($pathToImages);

    // continue only if this is a JPEG image

    if (strtolower($info['extension']== 'jpg') || strtolower($info['extension']== 'jpeg') || strtolower($info['extension']== 'png') || strtolower($info['extension']== 'gif') ) 

    {

      //echo "Creating thumbnail for {$fname} <br />";



      // load image and get image size

      $img = imagecreatefromjpeg( "{$pathToImages}" );

      $width = imagesx( $img );

      $height = imagesy( $img );



      // calculate thumbnail size

      $new_width = $thumbWidth;

      $new_height = floor( $height * ( $thumbWidth / $width ) );



      // create a new tempopary image

      $tmp_img = imagecreatetruecolor( $new_width, $new_height );



      // copy and resize old image into new image 

      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );



      // save thumbnail into a file

      imagejpeg( $tmp_img, "{$pathToThumbs}" );

    }

 // }

  // close the directory

 // closedir( $dir );

}







function createpThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 

{

  // open the directory

 // $dir = opendir( $pathToImages );



  // loop through it, looking for any/all JPG files:

  //while (false !== ($fname = readdir( $dir ))) { 

    // parse path for the extension

    $info = pathinfo($pathToImages);

    // continue only if this is a JPEG image

    if (strtolower($info['extension']== 'jpg') || strtolower($info['extension']== 'jpeg') || strtolower($info['extension']== 'png') || strtolower($info['extension']== 'gif') ) 

    {

      



      // load image and get image size

      $img = imagecreatefromjpeg( "{$pathToImages}" );

      $width = imagesx( $img );

    $height = imagesy( $img );



      // calculate thumbnail size

      $new_width = $thumbWidth;

      $new_height = floor( $height * ( $thumbWidth / $width ) );



      // create a new tempopary image

      $tmp_img = imagecreatetruecolor( $new_width, $new_height );



      // copy and resize old image into new image 

      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );



      // save thumbnail into a file

      imagejpeg( $tmp_img, "{$pathToThumbs}" );

    }

 // }

  // close the directory

  //closedir( $dir );

}



/*function curPageName() {

 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

}*/







function color_name_to_hex($color_name)

{

    // standard 147 HTML color names

    $colors  =  array(

        'aliceblue'=>'F0F8FF',

        'antiquewhite'=>'FAEBD7',

        'aqua'=>'00FFFF',

        'aquamarine'=>'7FFFD4',

        'azure'=>'F0FFFF',

        'beige'=>'F5F5DC',

        'bisque'=>'FFE4C4',

        'black'=>'000000',

        'blanchedalmond '=>'FFEBCD',

        'blue'=>'0000FF',

        'blueviolet'=>'8A2BE2',

        'brown'=>'A52A2A',

        'burlywood'=>'DEB887',

        'cadetblue'=>'5F9EA0',

        'chartreuse'=>'7FFF00',

        'chocolate'=>'D2691E',

        'coral'=>'FF7F50',

        'cornflowerblue'=>'6495ED',

        'cornsilk'=>'FFF8DC',

        'crimson'=>'DC143C',

        'cyan'=>'00FFFF',

        'darkblue'=>'00008B',

        'darkcyan'=>'008B8B',

        'darkgoldenrod'=>'B8860B',

        'darkgray'=>'A9A9A9',

        'darkgreen'=>'006400',

        'darkgrey'=>'A9A9A9',

        'darkkhaki'=>'BDB76B',

        'darkmagenta'=>'8B008B',

        'darkolivegreen'=>'556B2F',

        'darkorange'=>'FF8C00',

        'darkorchid'=>'9932CC',

        'darkred'=>'8B0000',

        'darksalmon'=>'E9967A',

        'darkseagreen'=>'8FBC8F',

        'darkslateblue'=>'483D8B',

        'darkslategray'=>'2F4F4F',

        'darkslategrey'=>'2F4F4F',

        'darkturquoise'=>'00CED1',

        'darkviolet'=>'9400D3',

        'deeppink'=>'FF1493',

        'deepskyblue'=>'00BFFF',

        'dimgray'=>'696969',

        'dimgrey'=>'696969',

        'dodgerblue'=>'1E90FF',

        'firebrick'=>'B22222',

        'floralwhite'=>'FFFAF0',

        'forestgreen'=>'228B22',

        'fuchsia'=>'FF00FF',

        'gainsboro'=>'DCDCDC',

        'ghostwhite'=>'F8F8FF',

        'gold'=>'FFD700',

        'goldenrod'=>'DAA520',

        'gray'=>'808080',

        'green'=>'008000',

        'greenyellow'=>'ADFF2F',

        'grey'=>'808080',

        'honeydew'=>'F0FFF0',

        'hotpink'=>'FF69B4',

        'indianred'=>'CD5C5C',

        'indigo'=>'4B0082',

        'ivory'=>'FFFFF0',

        'khaki'=>'F0E68C',

        'lavender'=>'E6E6FA',

        'lavenderblush'=>'FFF0F5',

        'lawngreen'=>'7CFC00',

        'lemonchiffon'=>'FFFACD',

        'lightblue'=>'ADD8E6',

        'lightcoral'=>'F08080',

        'lightcyan'=>'E0FFFF',

        'lightgoldenrodyellow'=>'FAFAD2',

        'lightgray'=>'D3D3D3',

        'lightgreen'=>'90EE90',

        'lightgrey'=>'D3D3D3',

        'lightpink'=>'FFB6C1',

        'lightsalmon'=>'FFA07A',

        'lightseagreen'=>'20B2AA',

        'lightskyblue'=>'87CEFA',

        'lightslategray'=>'778899',

        'lightslategrey'=>'778899',

        'lightsteelblue'=>'B0C4DE',

        'lightyellow'=>'FFFFE0',

        'lime'=>'00FF00',

        'limegreen'=>'32CD32',

        'linen'=>'FAF0E6',

        'magenta'=>'FF00FF',

        'maroon'=>'800000',

        'mediumaquamarine'=>'66CDAA',

        'mediumblue'=>'0000CD',

        'mediumorchid'=>'BA55D3',

        'mediumpurple'=>'9370D0',

        'mediumseagreen'=>'3CB371',

        'mediumslateblue'=>'7B68EE',

        'mediumspringgreen'=>'00FA9A',

        'mediumturquoise'=>'48D1CC',

        'mediumvioletred'=>'C71585',

        'midnightblue'=>'191970',

        'mintcream'=>'F5FFFA',

        'mistyrose'=>'FFE4E1',

        'moccasin'=>'FFE4B5',

        'navajowhite'=>'FFDEAD',

        'navy'=>'000080',

        'oldlace'=>'FDF5E6',

        'olive'=>'808000',

        'olivedrab'=>'6B8E23',

        'orange'=>'FFA500',

        'orangered'=>'FF4500',

        'orchid'=>'DA70D6',

        'palegoldenrod'=>'EEE8AA',

        'palegreen'=>'98FB98',

        'paleturquoise'=>'AFEEEE',

        'palevioletred'=>'DB7093',

        'papayawhip'=>'FFEFD5',

        'peachpuff'=>'FFDAB9',

        'peru'=>'CD853F',

        'pink'=>'FFC0CB',

        'plum'=>'DDA0DD',

        'powderblue'=>'B0E0E6',

        'purple'=>'800080',

        'red'=>'FF0000',

        'rosybrown'=>'BC8F8F',

        'royalblue'=>'4169E1',

        'saddlebrown'=>'8B4513',

        'salmon'=>'FA8072',

        'sandybrown'=>'F4A460',

        'seagreen'=>'2E8B57',

        'seashell'=>'FFF5EE',

        'sienna'=>'A0522D',

        'silver'=>'C0C0C0',

        'skyblue'=>'87CEEB',

        'slateblue'=>'6A5ACD',

        'slategray'=>'708090',

        'slategrey'=>'708090',

        'snow'=>'FFFAFA',

        'springgreen'=>'00FF7F',

        'steelblue'=>'4682B4',

        'tan'=>'D2B48C',

        'teal'=>'008080',

        'thistle'=>'D8BFD8',

        'tomato'=>'FF6347',

        'turquoise'=>'40E0D0',

        'violet'=>'EE82EE',

        'wheat'=>'F5DEB3',

        'white'=>'FFFFFF',

        'whitesmoke'=>'F5F5F5',

        'yellow'=>'FFFF00',

        'yellowgreen'=>'9ACD32');



    $color_name = strtolower($color_name);

    if (isset($colors[$color_name]))

    {

        return ('#' . $colors[$color_name]);

    }

    else

    {

        return ($color_name);

    }

}





function genColorCodeFromText($text,$min_brightness=100,$spec=10)

{

	// Check inputs

	if(!is_int($min_brightness)) throw new Exception("$min_brightness is not an integer");

	if(!is_int($spec)) throw new Exception("$spec is not an integer");

	if($spec < 2 or $spec > 10) throw new Exception("$spec is out of range");

	if($min_brightness < 0 or $min_brightness > 255) throw new Exception("$min_brightness is out of range");

	

	

	$hash = md5($text);  //Gen hash of text 

	$colors = array();

	for($i=0;$i<3;$i++)

		$colors[$i] = max(array(round(((hexdec(substr($hash,$spec*$i,$spec)))/hexdec(str_pad('',$spec,'F')))*255),$min_brightness)); //convert hash into 3 decimal values between 0 and 255

		

	if($min_brightness > 0)  //only check brightness requirements if min_brightness is about 100

		while( array_sum($colors)/3 < $min_brightness )  //loop until brightness is above or equal to min_brightness

			for($i=0;$i<3;$i++)

				$colors[$i] += 10;	//increase each color by 10

				

	$output = '';

	

	for($i=0;$i<3;$i++)

		$output .= str_pad(dechex($colors[$i]),2,0,STR_PAD_LEFT);  //convert each color to hex and append to output

	

	return '#'.$output;

}





function rand_string( $length ) {



$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

return substr(str_shuffle($chars),0,$length);



}





// functions.php

function check_txnid($tnxid,$sufix){

	global $link;

	return true;

	$valid_txnid = true;

    //get result set

    $sql = mysqli_query($conn,"SELECT * FROM `".$sufix."transaction` WHERE txnid = '$tnxid'", $link);		

	if($row = mysqli_fetch_array($sql)) {

        $valid_txnid = false;

	}

    return $valid_txnid;

}



function check_price($price, $id){

    $valid_price = false;

    //you could use the below to check whether the correct price has been paid for the product

    

	/* 

	$sql = mysqli_query($conn,"SELECT amount FROM `products` WHERE id = '$id'");		

    if (mysql_numrows($sql) != 0) {

		while ($row = mysqli_fetch_array($sql)) {

			$num = (float)$row['amount'];

			if($num == $price){

				$valid_price = true;

			}

		}

    }

	return $valid_price;

	*/

	return true;

}



function updatePayments($data,$sufix){	

    global $link;

	if(is_array($data)){				

        $sql = mysqli_query($conn,"INSERT INTO `".$sufix."transaction` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES (

                '".$data['txn_id']."' ,

                '".$data['payment_amount']."' ,

                '".$data['payment_status']."' ,

                '".$data['item_number']."' ,

                '".date("Y-m-d H:i:s")."' 

                )", $link);

    return mysql_insert_id($link);

    }

}



function useraccess($val,$sufix)

{

	

	$sql="select * from `".$sufix."user_acces` where userid ='".$_SESSION['username']."' and utype='".$_SESSION['usertype']."' and pagename='".$val."'";

	

	$query = mysqli_query($sql);

	$num=mysqli_num_rows($query);

	if($num>0)

	{

		$dispuser='block';

	}

	else

	{

		$dispuser='none';

	}

	return $dispuser;	

}



function useraccess2($val,$sufix)

{

	if($_SESSION['usertype']=='user')

	{

	$sql="select * from `".$sufix."user_acces` where userid ='".$_SESSION['username']."' and utype='".$_SESSION['usertype']."' and pagename='".$val."'";

	

	$query = mysqli_query($sql);

	$num=mysqli_num_rows($query);

	if($num>0)

	{

		$dispuser='block';

	}

	else

	{

		$dispuser='none'; // 

	}

	}

	

	else

	{

	

	$dispuser='block';

	

	}

	return $dispuser;	

}



function pagingallcat($offset,$num,$link,$page,$no_page,$display_range,$catid)

{

	

				

	if($num > $offset)

	{

	$pager=new Pager();

	$pager=$pager->getPagerData($no_page, $display_range, $page, $offset);	

	

?>

<table width=100%>

		<tr>

		  <td align=right colspan=2>

			  <?php

					if ($page == 1)

						echo "&nbsp;&nbsp;";  //

					else					

						echo "<span class='paginglink'><a href='$link?page=".($page - 1)."$paging' class='paginglink'><<</a></span>&nbsp;";  

					for ($i = $pager->lrange; $i <= $pager->rrange; $i++){  

						if ($page != 1){

							echo ""; 

						}

							

						if ($i == $pager->page)  {

							echo "<span class='paginglink'> $i </span>&nbsp;";  

						}else{  

							if($i!=0){

								echo "<span class='paginglink'><a class='paginglink' href='$link?catid=".$catid."&page=$i$paging'>$i</a></span>&nbsp;";   

							}	

						}	

					}  

					if ($page == $pager->np){ 

						echo "";  

					}else{ 

						echo "<span class='paginglink'><a class='paginglink' href='$link?page=".($page + 1)."$paging'>>></a></span>&nbsp;";  

					}	

				?>

		</td>

	</tr>

	</table>

<?php	

	}



}



?>