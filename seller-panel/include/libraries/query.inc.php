<?php
##  PHP AdminPanel                                           	          
##  Developed by:  Pawan Kumar <pavan@exisolutionsgroup.com>   
##  Created Date:  08-Apr 2013 											
##  WebSite:       http://www.exisolutionsgroup.com/		                    
##  Copyright:     Exi Solutions Group@ 2013. All rights reserved.  			
//defined( '_JEXEC' ) or header("Location:$redirectpath");
//start class query
class query{
		
		
		function pagingquery($query)
		{
				global $conn;
			//echo $query;
			$sql1=mysqli_query($conn,$query);
			$num=mysqli_num_rows($sql1);	
			return $num;	
			
		}
		
		
		function querybanner($sufix,$position,$id,$limit)
		{	
		//
				$sql="select * from `".$sufix."banners` where displayflag='1' and bposition='".$position."' order by ".$id." asc limit ".$limit."";				
				return $sql;
		
		}	
		
		function subquery($table,$id,$fid,$fname)
			{
				//echo "select ".$fname." from ".$table." where ".$id."=".$fid;
				$subsql=mysqli_query($conn,"select ".$fname." from ".$table." where ".$id."=".$fid." and displayflag='1'");
				$rowname=mysqli_fetch_array($subsql);
				echo $rowname[$fname];				
			}
			
		function squery2($sufix,$table,$id,$asc,$whr)
		{	
		//
				$sql="select * from ".$sufix.$table." where ".$id."='".$whr."' and displayflag='1' ";	
			//$sql=mysqli_query($query);
			return $sql;
		
		}	
			
			
			function valquery($table,$id,$fid,$fname)
			{
				//echo "select ".$fname." from ".$table." where ".$id."=".$fid;
				$subsql=mysqli_query($conn,"select ".$fname." from ".$table." where ".$id."=".$fid." and displayflag='1'");
				$rowname=mysqli_fetch_array($subsql);
				return $rowname[$fname];				
			}
		
		function pagingquery2($query,$offset,$display_range,$page)
			{
				
				//pagingquery($query);
				
				$no_page = max(1,ceil($num/$offset));
				$pager=new Pager();
				$pager=$pager->getPagerData($no_page, $display_range, $page, $offset);	
				//echo $query." LIMIT $pager->offset, $offset";
				$result=mysqli_query($query." LIMIT $pager->offset, $offset");
			
				return $result;
			}
		
		function option_listmultiple($table,$id,$fid,$fname,$category,$name,$onchange)
				{  
					 
					// echo $fid;
					if($category=='')
					{ 
						$catSql="SELECT * FROM ".$table." WHERE displayflag='1' order by ".$fname;
						$selname='parentname';
					}
					elseif($category=='Category')
					{
						$catSql="SELECT * FROM ".$table." WHERE parent='0' order by ".$fname;
						$selname='category';
					
					}	
					elseif($category=='Sub_Category')
					{
						$catSql="SELECT * FROM ".$table." WHERE parent!='0' order by ".$fname;
						$selname='subcategory';
					
					}
					
					elseif($category=='Page')
					{
						$catSql="SELECT * FROM ".$table." order by ".$fname;
						$selname='pageid';
					
					}
					
					elseif($category=='SubNavigation')
					{
						$catSql="SELECT * FROM ".$table." where parent='0' order by ".$fname;
						$selname='mainmenu';
						$fname="itemname";
					
					}

					elseif($category=='Sub_SubNavigation')
					{
						$catSql="SELECT * FROM ".$table." where parent!='0' and menu_type='Sub_Menu' and menuposition='Header Offer' order by ".$fname;
						$selname='submenu';
						$fname="itemname";
					
					}
					
						
					$rs=mysqli_query($catSql);
					echo "<select name='".$selname."'[] id='".$selname."' multiple='multiple' size='3'>";
					echo "<option value='' style='color:#000000;font:bold 12px arial;font-style:italic'>--Select ".$name."--</option>";
					while($rw = mysqli_fetch_array($rs))
					{
					
							if($rw[$id]==$fid)
							{
								$sel="selected";
							
							}
							else
							{
								$sel='';
							
							}
								echo "<option value='$rw[$id]' style='color:#000000;font:bold 12px arial;font-style:italic' $sel>$rw[$fname]</option>";							
						}
				echo "</select>";	
				}
		
		
		
		
		function option_list2($table,$id,$fid,$fname,$category,$name,$onchange)
				{  
					 
					// echo $fid;
					if($category=='')
					{ 
						$catSql="SELECT * FROM ".$table." WHERE displayflag='1' order by ".$fname;
						$selname='parentname';
					}
					elseif($category=='Category')
					{
						$catSql="SELECT * FROM ".$table." WHERE parent='0' order by ".$fname;
						$selname='category';
					
					}	
					elseif($category=='Sub_Category')
					{
						$catSql="SELECT * FROM ".$table." WHERE parent!='0' order by ".$fname;
						$selname='subcategory';
					
					}
					
					elseif($category=='Page')
					{
						$catSql="SELECT * FROM ".$table." order by ".$fname;
						$selname='pageid';
					
					}
					
					elseif($category=='SubNavigation')
					{
						$catSql="SELECT * FROM ".$table." where parent='0' order by ".$fname;
						$selname='mainmenu';
					
					}
					
						
					$rs=mysqli_query($catSql);
					echo "<select name='".$selname."' id='".$selname."' onchange='".$onchange."(this.value);'>";
					echo "<option value='' style='color:#000000;font:bold 12px arial;font-style:italic'>--Select ".$name."--</option>";
					while($rw = mysqli_fetch_array($rs))
					{
					
							if($rw[$id]==$fid)
							{
								$sel="selected";
							
							}
							else
							{
								$sel='';
							
							}
								echo "<option value='$rw[$id]' style='color:#000000;font:bold 12px arial;font-style:italic' $sel>$rw[$fname]</option>";							
						}
				echo "</select>";	
				} //end function for list of parent menu
			
			
			
			function pagingall2($query,$offset,$display_range,$page,$link)
{  
	global $conn;
	$sql1=mysqli_query($conn,$query);
	$num=mysqli_num_rows($sql1);	
	$no_page = max(1,ceil($num/$offset));
	$pager=new Pager();
	$pager=$pager->getPagerData($no_page, $display_range, $page, $offset);	 
	$result=mysqli_query($conn,$query." LIMIT $pager->offset, $offset");
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
						echo "<span class='pagination'><a href='$link?page=".($page - 1)."$paging' class='pagination'><<</a></span>&nbsp;";  
					for ($i = $pager->lrange; $i <= $pager->rrange; $i++){  
						if ($page != 1){
							echo ""; 
						}
							
						if ($i == $pager->page)  {
							echo "<span class='pagination'> $i </span>&nbsp;";  
						}else{  
							if($i!=0){
								echo "<span class='pagination'><a class='pagination' href='$link?page=$i$paging'>$i</a></span>&nbsp;";  
							}	
						}	
					}  
					if ($page == $pager->np){ 
						echo "";  
					}else{ 
						echo "<span class='pagination'><a class='pagination' href='$link?page=".($page + 1)."$paging'>>></a></span>&nbsp;";  
					}	
				?>
			
		
		</td>
	</tr>
	</table>
<?php	
	}

} 

			
			
			
			function lquery($sufix,$table,$id,$asc,$field1,$field2,$l1,$l2)
			{	
			//				
				if($field1 && $field2)
				{
					$sql="select ".$field1.",".$field2." from ".$sufix.$table." WHERE displayflag='1' order by ".$id." ".$asc." Limit ".$l1.", ".$l2;
			
				}
				elseif($field1)
				{
					$sql="select ".$field1." from ".$sufix.$table." WHERE displayflag='1' order by ".$id." ".$asc." Limit ".$l1.", ".$l2;
			
				}
				elseif($field2)
				{
					$sql="select ".$field2." from ".$sufix.$table." WHERE displayflag='1' order by ".$id." ".$asc." Limit ".$l1.", ".$l2;
			
				}
				else
				{
					
					$sql="select * from ".$sufix.$table." WHERE displayflag='1' order by ".$id." ".$asc." Limit ".$l1.", ".$l2;			
				}
				//$sql=mysqli_query($query);
				return $sql;
			
			}
			
			
			
			
			function sqlquery($sql)
			{ 	
				//echo $sql;
				return (mysqli_query($conn,$sql));			
			}	
				
			function fetchassoc($sql)
			{ 
				 return (@mysqli_fetch_assoc($sql));
			}	
			function fetcharray($sql)
			{ 			
				 return (@mysqli_fetch_array($sq));
			}
	
			function num($sql)
			{ 
				//echo $sql;
				$num=mysqli_num_rows($sql);
				return $num;		
						
			}
			
			
			
			function squery($sufix,$table,$id,$asc,$field1,$field2)
				{	
				//				
					if($field1 && $field2)
					{
						$sql="select ".$field1.",".$field2." from ".$sufix.$table." where displayflag='1' order by ".$id." ".$asc;
				
					}
					elseif($field1)
					{
						$sql="select ".$field1." from ".$sufix.$table."  where displayflag='1' order by ".$id." ".$asc;
				
					}
					elseif($field2)
					{
						$sql="select ".$field2." from ".$sufix.$table." where displayflag='1' order by ".$id." ".$asc;
				
					}
					else
					{
						
						$sql="select * from ".$sufix.$table." where displayflag='1' order by ".$id." ".$asc;			
					}
					//echo $sql;
					//$sql=mysqli_query($query);
					return $sql;
				
				}
			
				
		/*	
			function itemstrip($sufix,$productid)
			{
					//echo "select * from ".$sufix."product `a`, ".$sufix."imageupload `b` where a.id='".$productid."' and a.id=b.pid and a.displayflag='1' and b.mainimage='1'";
					
					
				
			
			
			}*/
			

}
$query=new query();

?>