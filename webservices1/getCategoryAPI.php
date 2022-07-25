<?php 
header("Content-type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$response=array("status"=>400,"msg"=>"Invalid Request");
$catSql="select cat_id,categoryname from jewellersmandi_category order by cat_id asc";
$catRes=mysql_query($catSql);
if(mysql_num_rows($catRes)>0){
	$response['status']=200;
	$response['msg']='success';
	while($catRow=mysql_fetch_assoc($catRes)){
		if($catRow['cat_id']=='0106' or $catRow['cat_id']=='0107' or $catRow['cat_id']=='0110' or $catRow['cat_id']=='0111' or $catRow['cat_id']=='0112' or $catRow['cat_id']=='0113' ){
		}else{
			$catData[]=$catRow;
		}
	}
	$response['catData']=$catData;
}else{
	$response['status']=404;
	$response['msg']='No Category found';
}
//response

echo json_encode($response);
die;
?>