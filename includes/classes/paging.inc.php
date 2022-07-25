<?php
//defined( '_JEXEC' ) or header("Location:$redirectpath");
class Pager  {  
   function getPagerData($np, $range, $page, $offset) {  
	   $np  = (int) $np;
	   $offset = max(0,(($page - 1) * $offset));
	   $lrange = max(1,$page -(($range-1)/2));
	   $rrange = min($np, $page + (($range-1)/2));
	   if(($rrange - $lrange) < ($range -1)){
			if($lrange==1){
				$rrange = min($np, $lrange + ($range - 1));
			}else{
				$lrange = max($rrange - ($range - 1) , 0);
			}
	   }
	   $ret = new Pager();  
	   $ret->lrange = round($lrange);
	   $ret->rrange = round($rrange); 
	   $ret->np = $np;  
	   $ret->page = $page;  
	   $ret->offset = $offset;
	   return $ret;  
   }  
}

$pager=new Pager();
?>