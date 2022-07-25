<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $pageid = $_REQUEST['pageid'];
	 $sqlpage=mysql_query("select * from shopurneeds_static_pages where id='".$pageid."'");
	 $numuser=mysql_num_rows($sqlpage);
	 
	 if($sqlpage>0) {
	     $rowpage=mysql_fetch_array($sqlpage);
?>
<p style="font-family:arial;font-size:14px;"><?php echo $rowpage['description']; ?></p>

<?php } else { ?>
No Record Found
<?php } ?>