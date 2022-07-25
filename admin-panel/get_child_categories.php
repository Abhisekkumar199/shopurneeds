<?php

include("include/configurationadmin.php"); 

$id 	= $_REQUEST['parent_id'];  
$cagegory_breadcrumbs = '';
function cagegory_breadcrumbs($id, $category_tbl, $except = null) 
{
	global $conn;
	$s = "SELECT * FROM ".$category_tbl." WHERE cat_id = $id";
	$r = mysqli_query($conn,$s);
	$row = mysqli_fetch_array($r);
	$cat_slug = $row['cat_slug'];
	if($row['parent'] == 0) 
	{
		$name = $row['categoryname'];
		$curl = URL;  
		return "<a href='#'>".$name."</a> >";
	} 
	else 
	{
		$name = $row['categoryname'];
		if(!empty($except) && $except == $name)
		return cagegory_breadcrumbs($row['parent'],$category_tbl, $except)." ".$name;
	}
	return cagegory_breadcrumbs($row['parent'],$category_tbl, $except). " <a   href='#'>".$name."</a> >";
} 
$cagegory_breadcrumbs1 = cagegory_breadcrumbs($id,'shopurneeds_category',$except = null);
$cagegory_breadcrumbs = substr($cagegory_breadcrumbs1,0, -1);

if($_REQUEST)
{ 
	 
	$querys  = mysqli_query($conn,"select categoryname,attribute from shopurneeds_category where cat_id = ".$id);
	$selecat  = mysqli_fetch_array($querys);
	$cat_name = $selecat['categoryname'];
	$atribute = $selecat['attribute'];  
	$sql_attr  = mysqli_query($conn,"select * from shopurneeds_attributes where atr_id IN (".$atribute.")"); 
	$text = '';
	
	
    $query  = "select * from shopurneeds_category where parent IN ($id)";
	$results  = @mysqli_query($conn, $query);
	$num_rows = @mysqli_num_rows($results);
	if($num_rows > 0)
	{ 
	    $cat ='<div class="col-md-3 next_sub ">
                <div class="card-header" style="border-bottom:none;"><br></div>
                <div class="card-body"> 
                    <div class="input-group mb-3"> ';
            
                	    $cat .='<select name="sub_category parent" class="custom-select" style=" "  onchange="parent(this.value);"  >'; 
                		 $cat .='<option value="">Select</option>';
                		while ($rows = mysqli_fetch_assoc(@$results))
                		{ 
                			$cat .='<option value="'.$rows['cat_id'].'">'.$rows['categoryname'].'</option>';
                	    }
                		$cat .='</select>';	 
            $cat .='</div>  
                </div>
            </div>'; 
			if(@mysqli_num_rows($sql_attr) > 0)
			{
				while($rows_attr = mysqli_fetch_assoc($sql_attr))
				{			
					$text .= '<div class="col-md-6">
								<div class="input-group mb-3">
							<div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">'.$rows_attr['attributename'].'</label></div>
					        <INPUT TYPE="hidden" NAME="atr_id[]" value="'.$rows_attr['atr_id'].'" size=25 class="inputtext">
							<select class="custom-select" name="'.$rows_attr['atr_id'].'_atr_val_id[]" multiple="multiple"   >
								<option value="">Select</option>';  
							$sql_atr_val  = mysqli_query($conn,"select atr_val_id,attributevaluename from ".$sufix."attributevalue where atr_id='".$rows_attr['atr_id']."' and displayflag='1' order by attributevaluename ASC") ;
							while($rows_atr_val= mysqli_fetch_assoc($sql_atr_val))
							{	 
								$text .= '<option value="'.$rows_atr_val['atr_val_id'].'" >'.$rows_atr_val['attributevaluename'].'</option>';	
							} 	
						$text .= '</select>
					</div></div>'; 
				}
			}			
			$array = array("category"=>$cat,"attribute"=>$text,"allcategory"=>$cagegory_breadcrumbs); 
        echo $myJSON = json_encode($array);
	}
	else
	{
	    $cat ='<div class="col-md-3 next_sub">
                <div class="card-header" style="border-bottom:none;"><br></div>
                <div class="card-body"> 
                    <div class="input-group mb-3"> <label style="padding:7px; font-size:12px;"> <strong>Selected Category:&nbsp;</strong>'.$cat_name.'</label></div>  
                </div>
            </div>';
		while($rows_attr = @mysqli_fetch_assoc($sql_attr))
		{			
			$text .= '<div class="col-md-6">
						<div class="input-group mb-3">
					<div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">'.$rows_attr['attributename'].'</label></div>
					<INPUT TYPE="hidden" NAME="atr_id[]" value="'.$rows_attr['atr_id'].'" size=25 class="inputtext">
					<select class="custom-select" name="'.$rows_attr['atr_id'].'_atr_val_id[]" multiple="multiple"  >
						<option value="">Select</option>';  
					$sql_atr_val  = mysqli_query($conn,"select atr_val_id,attributevaluename from ".$sufix."attributevalue where atr_id='".$rows_attr['atr_id']."' and displayflag='1' order by attributevaluename ASC") ;
					while($rows_atr_val= mysqli_fetch_assoc($sql_atr_val))
					{	 
						$text .= '<option value="'.$rows_atr_val['atr_val_id'].'" >'.$rows_atr_val['attributevaluename'].'</option>';	
					} 	
				$text .= '</select>
			</div></div>'; 
		} 	
	    $array = array("category"=>$cat,"attribute"=>$text,"allcategory"=>$cagegory_breadcrumbs);
        echo  $myJSON = json_encode($array);
	    
	}
}
?>
