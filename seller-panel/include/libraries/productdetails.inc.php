<?php //$pid=$product->productid();
//echo $_REQUEST['pid']; 


if($_REQUEST['pid']!='')
{
	//echo $_REQUEST['pid'];  
	$pid2=explode("/",$_REQUEST['pid']);
	$pid=$pid2[0];
	$vpid=$pid2[1];
	$vvalue=$pid2[3];
	$vvalue2=explode(".",$vvalue);
	$vvalue3=$vvalue2[0];
	$pid3=$_REQUEST['pid'];
}
else
{
	
	$pid2=explode("/",$_REQUEST['catid']);
    $pid=$pid2[1];
    $vpid=$pid2[3];
	//$pid3=$_REQUEST['catid']; 
 
}

if($_REQUEST['wtype']!='')
{
	//echo $_REQUEST['vpid2'];
	$basket->whishlist($sufix,$_REQUEST['pid2'],$_REQUEST['vpid2'],'','');

}

 ?>

<script language="javascript">
function getXMLHTTP() 
{ //fuction to return the xml http object
    var xmlhttp=false; 
    try{
      xmlhttp=new XMLHttpRequest();
      }
    catch(e) 
	{  
		try{   
		   xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		   }
		catch(e)
		{
			 try{
			 xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			 }
			 catch(e1)
			 {
			  xmlhttp=false;
			 }
	   }
    }
            
return xmlhttp;
}
function selectvariantsize(variantcolor) 
{  
var pidcolor=document.getElementById('pidcolor').value;
var strURL="http://flip2save.co.uk/variantvaluecheck.php?pidcolor="+pidcolor+"&variantcolor="+variantcolor;
var req = getXMLHTTP();
   
   if (req) 
   {
	
		req.onreadystatechange = function() 
		{
			 if (req.readyState == 4) 
			 {
			  
                  
			   document.getElementById('showcariantsize').innerHTML=req.responseText; 
     
			 }    
		}   
	req.open("GET", strURL, true);
	req.send(null);
   }  
}  



function pdetails(pid,vpid,vpid2) 
{  


var vcolor=document.getElementById("vcolor2").value;

//var pid2=document.getElementById("pid").value;

var vcolor2=vcolor.split('/');


//alert(vpid);

var strURL="<?php echo URL; ?>/pages/productdetailsajax.php?pid="+pid+"&vpid="+vpid+"&vpid2="+vpid2+"&varvalue="+vcolor2[8];

//alert (strURL); 
/*var list = document.getElementById("listProductSizes").getElementsByTagName('li');
        
        for(i=0; i<pid.length; i++) 
        {
            pid[i].style.background = '#333333';
        }
        
		pid.style.background = '#ff0000';*/
        //ctrl.style.background = '#ff0000';


//alert (strURL);
var req = getXMLHTTP();
          
   if (req) 
   {
	
		req.onreadystatechange = function() 
		{
			 if (req.readyState == 4) 
			 {
			  // only if "OK"
			  //if (req.status == 0) {                    
			   document.getElementById('pdetails').innerHTML=req.responseText;      
			  //} //else {
			 
			   //alert("There was a problem while using XMLHTTP:\n" + req.statusText);
			  //}
			 }    
		}   
	req.open("GET", strURL, true);
	req.send(null);
   }  


}   


function psize(pid,vpid) 
{  
//alert(pid); 



//alert(vpid);

var strURL="<?php echo URL; ?>/pages/productdetailsajax.php?pid="+pid+"&vspid="+vpid;

//alert (strURL);
/*var list = document.getElementById("listProductSizes").getElementsByTagName('li');
        
        for(i=0; i<pid.length; i++)
        {
            pid[i].style.background = '#333333';
        }
        
		pid.style.background = '#ff0000';*/
        //ctrl.style.background = '#ff0000';


//alert (strURL);
var req = getXMLHTTP();
          
   if (req) 
   {
	
		req.onreadystatechange = function() 
		{
			 if (req.readyState == 4) 
			 {
			  // only if "OK"
			  //if (req.status == 0) {                    
			   document.getElementById('pdetails').innerHTML=req.responseText;      
			  //} //else {
			 
			   //alert("There was a problem while using XMLHTTP:\n" + req.statusText);
			  //}
			 }    
		}   
	req.open("GET", strURL, true);
	req.send(null);
   }  


}   


function subs(val)
{
	
	
	if(val=='1')
	{
		document.getElementById('subsc').disabled=true;
	}
	else if(val=='2')
	{
		document.getElementById('subsc').disabled=false;
	
	}

}


//

/*$(function() {
$("#sortable1 li").click(function() {
 // alert("Clicked list." + $(this).html());
   
   $("#pzoom").load("<?php // echo URL; ?>/productdetailszoom_ajax.php?pid=<?php //echo $pid; ?>");
  
});
 
 });*/



</script>
<?php 
//echo "select * from `".$sufix."product where id='".$pid."' and displayflag='1'";
$sqlproduct=mysqli_query($conn,"select * from `".$sufix."product` where id='".$pid."' and displayflag='1'");
$num=mysqli_num_rows($sqlproduct);
if($num>0)
{

	$rowproduct=mysqli_fetch_assoc($sqlproduct);
	$productname=$rowproduct['productname'];
	$categoryname=$query->valquery($sufix."category",'cat_id',$rowproduct['cat_id'],'categoryname');
	$categorypagename=$query->valquery($sufix."category",'cat_id',$rowproduct['cat_id'],'pagename');
	
	$subcategoryname=$query->valquery($sufix."category",'cat_id',$rowproduct['subcat_id'],'categoryname');
	$subcategorypagename=$query->valquery($sufix."category",'cat_id',$rowproduct['subcat_id'],'pagename');
	
	$subsubcategoryname=$query->valquery($sufix."category",'cat_id',$rowproduct['subsubcat_id'],'categoryname');
	$subsubcategorypagename=$query->valquery($sufix."category",'cat_id',$rowproduct['subsubcat_id'],'pagename');
	
	$relatedproduct=$rowproduct['relatedproducts'];
	$productpage=$rowproduct['product_pagename'];
	
	
	$vartype=$rowproduct['vartype'];
	$sellingprice=$rowproduct['sellingprice']; 
	$offerid=$rowproduct['offername'];
	$mrp=$rowproduct['mrp'];
	$sku=$rowproduct['sku'];
	$bid=$rowproduct['bid'];
	$weight=$rowproduct['pweight'];
	$monthly=$rowproduct['monthly'];
	$supplier=$rowproduct['suppliername'];
	$saddress=$rowproduct['saddress'];
	$scontact=$rowproduct['scontact'];
	$sideinfo=$rowproduct['sideinfo'];
		$paymentoption=$rowproduct['paymentoption'];

	//$sellin=$rowproduct['mrp']; 
	
	
	
	
	
if($vpid!='')
{
	$sqlvariant="select * from `".$sufix."product_variant` where pid='".$pid."' and vproductcode='".$vpid."'  and displayflag='1'";


$sqlproductvar=mysqli_query($conn,"$sqlvariant) ;
$num2=mysqli_num_rows($sqlproductvar);
if($num2>0)
{
	$rowproductvar=mysqli_fetch_assoc($sqlproductvar);
	$productname2=$rowproductvar['variantproname'];
	$sellingprice2=$rowproductvar['variantselling']; 
	$variantvalue=$rowproductvar['variantvalue'];
	$productpage=$rowproductvar['variantpagename'];
	$offerid2=$rowproductvar['varoffername'];
	$mrp2=$rowproductvar['variantcost'];
	$sku2=$rowproductvar['variantsku'];
	$varvalue=$rowproductvar['variantvalue'];
	$varname=$rowproductvar['variantname'];
	//$mrp=$rowproduct['mrp'];
	
	//
}		

}

?>	
<div class="container"><a href="<?php echo URL; ?>" style="font-size:10px;">Home</a>&nbsp; &gt; &nbsp; <a href="<?php echo URL; ?>/<?php echo $categorypagename; ?>" style="font-size:10px;"><?php echo $categoryname; ?></a>&nbsp;&gt; &nbsp; 
<?php if($subcategoryname!='') { ?>	
                  
						<a href="<?php echo URL; ?>/<?php echo $subcategorypagename; ?>" style="font-size:10px;"><?php echo $subcategoryname; ?></a> &nbsp; &gt; &nbsp;
						<?php } ?>	 
<?php if($subsubcategoryname!='') { ?>	
                  
						 <a href="<?php echo URL; ?>/<?php echo $subsubcategorypagename; ?>" style="font-size:10px;"><?php echo $subsubcategoryname; ?></a> &nbsp; &gt; &nbsp;
						<?php } ?>
<span  style="font-size:10px;"><?php if($productname2!='') { echo $productname2; } else { echo $productname; } ?></span><div>&nbsp;</div>
	<!-- PRODUCT SINGLE -->
	<section class="product-single">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
                       <div class="productImages" data-ctrl="ProductImagesController">
                <div class="innerPanel">
                  <div class="mainImage">
                    <div class="imgWrapper"> 
                    <?php
			
						
							$sql1="select * from ".$sufix."imageupload where displayflag='1' and pid='".$pid."' order by mainimage desc";
						
			
				?>
			
			
                 <?php $sqlimage=mysqli_query($conn,"$sql1); 
 							$countimage2=1;
 							while($rowimage=mysqli_fetch_assoc($sqlimage))
							{
								$smallimage=URL."/uploads/productimage/small/".$rowimage['productimage'];
								$thumbimage=URL."/uploads/productimage/thumb/".$rowimage['productimage'];
								$middleimage=URL."/uploads/productimage/middle/".$rowimage['productimage'];
								$largimage=URL."/uploads/productimage/".$rowimage['productimage'];
 							?>
				    <img src="<?php echo URL; ?>/images/thumb-default.jpg"
                                 class="productImage  <?php if($countimage2=="1") { ?>current<?php } ?>"
                                 data-imageId="<?php echo $rowimage['id'] ;?>"
                                 data-src="<?php echo $largimage; ?>"
                                 data-zoomImage="<?php echo $largimage; ?>" style="max-height:300px;"> 
                                 
                                 
                           <?php //} 
						   $countimage2=$countimage2+1;
				} ?>      
                                 
                                 
                                 

 </div>
 
                  </div>
                  <div class="carouselContainer leftDisabled"> <span class="leftArrow arrow"></span> <span class="rightArrow arrow"></span>
                    <ul class="carousel leftDisabled">
                      <?php 
				 
				
						$sql4="select * from ".$sufix."imageupload where displayflag='1' and pid='".$pid."' order by mainimage desc";
					
				 $sqlimage=mysqli_query($conn,"$sql4); 
 							$countimage=1;
 							while($rowimage=mysqli_fetch_assoc($sqlimage))
							{
								$smallimage=URL."/uploads/productimage/small/".$rowimage['productimage'];
								$thumbimage=URL."/uploads/productimage/thumb/".$rowimage['productimage'];
								$middleimage=URL."/uploads/productimage/middle/".$rowimage['productimage'];
								$largimage=URL."/uploads/productimage/".$rowimage['productimage'];
 							?>  
					  <li>
                        <div class="thumbContainer">
                          <div class="thumb" style="background-image:url(<?php echo $thumbimage; ?>)"  data-imageId="<?php echo $rowimage['id'] ;?>"> </div>
                        </div>
                      </li>
                     <?php 
					$countimage++;	
					} ?>
                    </ul>
                  </div>
                </div>
                <div class="productImageZoom"></div>
              </div>
						</div>
						<div class="col-md-6"> 
						<div>
<div class="sub2"><h2 style="margin:0px; padding-top:0px; padding-bottom:15px; color:#000000;"><?php if($productname2!='') { echo ucfirst($productname2); } else { echo ucfirst($productname); } ?></h2></div>
<img src="<?php echo $url;  ?>/images/pensile.png" alt="" /> <a href="#"> Be the first to review this products  </a>
</div>
<div class="text_linking_01 "> <img src="<?php echo $url;  ?>/images/one.png"/> Base on 3 rating  &nbsp;|&nbsp;  <a href="#">  write a riview </a>  &nbsp;|&nbsp; <img src="<?php echo $url;  ?>/images/dil.png" alt="" /> <a href="#" >  Shortlist </a></div>

<?php
				if($sellingprice2!='') 
				{
				
					
						
			?>
  <div class="price-box">
                                                            <span class="regular-price" id="product-price-39">
                                            <span class="price" style="font-weight:bold; font-size:20px;"><span class="price" style="font-weight:bold; font-size:20px;"><?php echo Currency."&nbsp;".$sellingprice2;  ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span ></span>                               </span>
                        
        </div>
		   <?php  
	   
	   $sellprice=$sellingprice2;
				$buymrp=$sellprice;
				$buyoffer=$sellprice;
	   
	    }  else {
			
			  ?>
<div class="sub2" style="background-color:#f0efef;">
<div class="sub2new1" style="background-color:#f0efef;"><strong style="font-size:16px;">&nbsp;You Pay&nbsp;&nbsp;<span style="font-size:18px; color:#b70000;"><img src="<?php echo $url; ?>/images/rs01.PNG"/>&nbsp;<?php echo $sellingprice;  ?></strong></span> <br/><strong>&nbsp;&nbsp;MRP</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration:line-through"><img src="<?php echo $url; ?>/images/rs01.PNG"/>&nbsp;<?php echo $rowproduct['costprice'];  ?></span><br/><strong>&nbsp;&nbsp;Shipping</strong>&nbsp;&nbsp;<span><img src="<?php echo $url; ?>/images/rs01.PNG"/>&nbsp;<?php echo $rowproduct['shippingcost'];  ?></span></div>
<div class="sub2new2" style="background-color:#f0efef; padding-top:5px;"><strong>You Save </strong>
<span> 
<img src="<?php echo $url; ?>/images/rs01.PNG"/>
<span class="product_pricing01" > <?php echo ($rowproduct['costprice']-$sellingprice);  ?></span>
</div>
<div class="cl"></div>
<div class="yousave" style=" text-align:left;">
</div>
</div>
			
			<div class="sp_prd_price_black"  id="before_price" >
<span itemprop="price" style="font-weight:bold; font-size:20px;"></span><br />
<span style="font-size:11px;"> </span>
</div>
<div class="yousave">
<div class="one"><div >
<img src="<?php echo $url;  ?>/images/1.png"/> </div>
<div style="margin-left:37px; margin-top:-25px; color:#000000;" class="text_linking_01"> <strong> Buy and Earn<font color="#b70000"> <?php echo $sellingprice;  ?></font> Cash Coins!!  Details </strong></div>
</div>

</div>
			
			<?php 
			   $sellprice=$sellingprice;
				$buymrp=$mrp;
				$buyoffer=productoffer($offerid,$sufix);
				
				}
			
			 ?>






<div class="sub2"><img src="<?php echo $url;  ?>/images/truck.png"/><div style="margin-left: 34px; margin-top: -21px;" class="text_linking_01"><?php $rowproduct['delivertime']; ?></div> </div>
<script language="javascript">
function vselect(id)
{
	window.location.href=id;
//
}


</script>  
<div class="sub2" style="padding-top:15px;">

<form name="basket" action="<?php echo URL; ?>/basket/cart" method="post" id="basket">
		  <div class="qty no_selection"><strong>Qty</strong>:&nbsp;&nbsp;
		  <select name="pquantity" required>
		<option>Quantity</option>
		<option>1 </option>
		<option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        
	</select>
                </div>
				<div style="padding-top:10px;">		<?php  $product->productvariation($sufix,$pid,$vartype,URL,'',$variantvalue,$vpid,'',$vvalue3); ?>   
</div>
		
				
<input name="fprice" type="hidden" value="<?php echo $sellprice; ?>" />
<input name="mrp" type="hidden" value="<?php echo $buymrp; ?>" />
<input name="offer" type="hidden" value="<?php echo $buyoffer; ?>" />
<input name="pid" type="hidden" value="<?php echo $pid; ?>" />
<?php if($rowproduct['vartype']!="") { ?>

<input name="vpid" type="hidden" value="<?php echo $vpid; ?>" />

<?php } else {
 ?>
 <input name="vpid" type="hidden" value="" />

 <?php } ?>
<input name="vvalue" type="hidden" value="<?php echo $varvalue; ?>" />
<input name="vname" type="hidden" value="<?php echo $varname; ?>" />
<input name="weight" type="hidden" value="<?php echo $weight; ?>" />
<input name="pname" type="hidden" value="<?php if($productname2!='') { echo $productname2; } else { echo $productname; } ?>" />
<div class="button_outer" style="text-align:center;">
<button type="submit" title="Add to Cart" class="btn btn-danger"><span>Add to Cart</span></button>  
            </div> 
  </div>
   
   </form></div>
<div class="cl"></div>
<div class="gap_4px"> </div>
<div class="sub2"><img src="<?php echo $url;  ?>/images/social.png"/></div>
<div class="cl"></div>

</div>
                        
						</div>
					</div>
				</div>
				<div class="col-md-3" style="padding-right:0px; padding-left:50px;">
				
				</div>
			</div>

			<div class="clearfix"></div>

			<!-- PRODUCT INFO TABS -->
        <div class="product-tabs" style="padding-top:25px;">
		<div class="container">
        
			<div class="col-md-9" style="padding-left:0px;">
            
             <ul class="nav nav-tabs">
            <li><a href="#tab-2"><strong>Product Details</strong></a></li>
            <li><a href="#tab-3"><strong>Review</strong></a></li>
           
        </ul>
        <div class="tabscontent">
            
            <div id="tab-2" class="lorem">
               <div class="row" style="border:#CCC solid 1px;">
							<div class="col-md-12" style="padding-left:0px; padding-right:0px;">
                            
                            <div class="pad5 pad6 pro-des"><?php echo $rowproduct['longdescription']; ?></div>    
                   			
							</div>
               