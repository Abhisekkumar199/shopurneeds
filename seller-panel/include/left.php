<tr bgcolor="#FFFFFF">
	<td>


    <style type="text/css">

#boxscrolls3 {
	height:auto;
	width:200px;	
}
#boxscrolls4 {
	height:auto;
	width:200px;	
}
#boxscrollb1 {
	height:auto;
	width:200px;	
}
#boxscrolld1 {
	height:auto;
	width:200px;	
}
#boxscrollp1 {
	height:auto;
	width:200px;	
}

</style>	
	


<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="202" align="center" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pad_2" style="border:#c3c3c3 solid 1px;" height="450" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top"><div id="left-search-part"><div id="left-sub-search"><div><img src="<?php echo URL; ?>/images/shop-img.gif" /></div><div>
<div class="column">
<?php 
$ar=$search->keywordsearch($sufix);
$keypage=$ar[2];
$slug=$ar[3];

if($keypage=='product')
{
	//echo $ar[0];
	
	 $s=mysqli_query($ar[0]); //
	//echo $num=mysqli_num_rows($s);
	$slug='';
$subcatid=array();
$catid=array();
$bid=array();
while($rowcategory=mysqli_fetch_array($s))
	{
		//echo $rowcategory['subcat_id'];
		
		
		
		if(!in_array($rowcategory['cat_id'],$catid)) 
		{
			$catid[]=$rowcategory['cat_id'];
		}
		
		
		if(!in_array($rowcategory['subcat_id'],$subcatid)) 
		{
						
			$subcatid[]=$rowcategory['subcat_id'];
		}
		//$subcatid[]=$rowcategory['subcat_id'];
		
		
		
		if(!in_array($rowcategory['bid'], $bid)) {
		
			$bid[]=$rowcategory['bid'];
		
		}
		//$slug=array();
		//if(!in_array($rowcategory['slug'], $slug)) {
			//if($rowcategory['id'])
				$pid=$pid."~".$rowcategory['id'];
		
		//}
		
		/*$sql=mysqli_query($conn,"select cat_id,cat_type,pagename from ".$sufix."category where displayflag='1' and cat_id = '".$cat_id."'");
		while($row=mysqli_fetch_array($sql))
			{	
				$keypage=$row['pagename'];
		
			}	*/					
	}

}

else
{
	
	
	 $catid=$ar[1];


}



if($_REQUEST['ksearch']!='')
{
//echo $subcatid;
?>
<input name="ksearch2" id="ksearch2" type="hidden" value="<?php echo $pid; ?>" />
<input name="keypage" id="keypage" type="hidden" value="<?php echo $keypage; ?>" />

<?php $search->leftkeyword($sufix,"Sub-SubCategory",$keypage,$catid,$subcatid,$bid,$_REQUEST['ksearch'],$pid); ?>
 
<?php $search->leftkeyword($sufix,"Brand",$keypage,$catid,$subcatid,$bid,$_REQUEST['ksearch'],$pid); ?>

  
<?php $search->leftkeyword($sufix,"Discount",$keypage,$catid,$subcatid,$bid,$_REQUEST['ksearch'],$pid); ?>
 

<?php $search->leftkeyword($sufix,"Price",$keypage,$catid,$subcatid,$bid,$_REQUEST['ksearch'],$pid); ?>
  
<?php } 

elseif($_REQUEST['brand']!='')
{
//echo $_REQUEST['brand'];
?>
<input name="ksearch2" id="ksearch2" type="hidden" value="" />
<input name="keypage" id="keypage" type="hidden" value="" />

	<?php $search->leftbrand($sufix,"Sub-SubCategory"); ?>

  
	<?php $search->leftbrand($sufix,"Discount"); ?>

	<?php $search->leftbrand($sufix,"Price"); ?>



<?php

}

elseif($_REQUEST['refdesc']=='discount')
{
//echo $_REQUEST['brand'];
?>
<input name="ksearch2" id="ksearch2" type="hidden" value="" />
<input name="keypage" id="keypage" type="hidden" value="" />
<?php $search->offerleft($sufix,"Sub-SubCategory"); ?>
 
 <?php $search->offerleft($sufix,"Brand"); ?>

  <div>&nbsp;</div>
  
   <?php $search->offerleft($sufix,"Discount"); ?>
 
  <div>&nbsp;</div>
  
  <?php $search->offerleft($sufix,"Price"); ?>



<?php

}

else { 


?>

<input name="ksearch2" id="ksearch2" type="hidden" value="" />
<input name="keypage" id="keypage" type="hidden" value="" />

	<?php $search->leftsection($sufix,"Sub-SubCategory"); ?>
 
	<?php $search->leftsection($sufix,"Brand"); ?>

  
   <?php $search->leftsection($sufix,"Discount"); ?>

   <?php $search->leftsection($sufix,"Price"); ?>


<?php } ?> 

	
</div>

 </div></div></div></td>
              </tr>
			   <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
            </table></td>
              </tr>
            </table></td>
            <td width="8"></td>
					

					

			<!--end left column-->