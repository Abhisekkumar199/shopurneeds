<?php session_start();
include("includes/con_inc.php");

if($sitename=='')
{
	$sitename="Buy-Kart";// 

}

if(!$desc)
{
	$desc="Buy-Kart";
}
if(!$keys)
{

	$keys="Buy-Kart"; //
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<iscontent type="text/html" compact="true" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $sitename; ?></title>
<meta name="description" content="<?php echo $desc; ?>" />
<meta name="keywords" content="<?php echo $keys; ?>" />
<meta name="robots" content="index,follow" />
<meta name="robots" content="ALL" />
<meta name="author" content="EXI Solutions Group, India" />

<style type="text/css">
.button_example{
border-color:#1f3346;border-width: 0px 0px 0px 0px;border-style: solid;-webkit-border-radius: 6px 6px 0px 0px;-moz-border-radius: 6px 6px 0px 0px;border-radius: 6px 6px 0px 0px;font-size:12px;font-family:arial, helvetica, sans-serif; padding: 7px 10px 7px 10px; text-decoration:none; display:inline-block;text-shadow: -1px -1px 0 rgba(0,0,0,0.3);font-weight:bold; color: #FFFFFF;
 background-color: #304F6D; background-image: -webkit-gradient(linear, left top, left bottom, from(#304F6D), to(#23415D));
 background-image: -webkit-linear-gradient(top, #304F6D, #23415D);
 background-image: -moz-linear-gradient(top, #304F6D, #23415D);
 background-image: -ms-linear-gradient(top, #304F6D, #23415D);
 background-image: -o-linear-gradient(top, #304F6D, #23415D);
 background-image: linear-gradient(to bottom, #304F6D, #23415D);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#304F6D, endColorstr=#23415D);
}

.button_example:hover{
 border-top-color: #030608;border-right-color: #030608;border-bottom-color: #030608;border-left-color: #030608;border-width: 0px;border-style: solid;
 background-color: #719DB7; background-image: -webkit-gradient(linear, left top, left bottom, from(#719DB7), to(#23405c));
 background-image: -webkit-linear-gradient(top, #719DB7, #23405c);
 background-image: -moz-linear-gradient(top, #719DB7, #23405c);
 background-image: -ms-linear-gradient(top, #719DB7, #23405c);
 background-image: -o-linear-gradient(top, #719DB7, #23405c);
 background-image: linear-gradient(to bottom, #719DB7, #23405c);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#719DB7, endColorstr=#23405c);
}
</style>
<style type="text/css">
<!--h3{ margin: 10px 10px 0 10px; color:#FFF; font:18pt Arial, sans-serif; letter-spacing:-1px; font-weight: bold;  }-->
			
.boxgrid{ 
				width: 190px; 
				height: 170px; 
				/*margin:10px; */
				float:left; 
				background:#161613; 
				/*border: solid 2px #8399AF; */
				overflow: hidden; 
				position: relative; 
			}
.boxgrid img{ 
					position: absolute; 
					top: 0; 
					left: 0; 
					border: 0; 
				}
.boxgrid p{ 
					padding:5px 5px 0px 5px; 
					color:#303030; 
					font-weight:bold; 
					font:10pt "Lucida Grande", Arial, sans-serif; 
				}
				
.boxcaption{ 
				float: left; 
				position: absolute; 
				background: #ffffff; 
				height: 100px; 
				width: 100%; 
				opacity: .8;
				border-top:#fa0a0a solid 4px;
				
				/* For IE 5-7 */
				filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
				/* For IE 8 */
				-MS-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
 			}
.captionfull .boxcaption {
 					top: 100;
 					left: 0;
 				}
.caption .boxcaption {
 					top: 100;
 					left: 0;
 				}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.boxgrid.peek').hover(function(){
			$(".cover", this).stop().animate({top:'140px'},{queue:false,duration:200});
		}, function() {
			$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:200});
		});
		
		$('.boxgrid.caption').hover(function(){
			$(".cover", this).stop().animate({top:'110px'},{queue:false,duration:200});
		}, function() {
			$(".cover", this).stop().animate({top:'140px'},{queue:false,duration:200});
		});
	});
</script>

<!-- FlexSlider pieces -->
	<!--<link rel="stylesheet" href="<?php //echo URL; ?>/css/flexslider.css" type="text/css" media="screen" />-->
	 <script src="<?php echo URL; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<!--<script src="<?php //echo URL; ?>/javascript/jquery.flexslider-min.js"></script>-->
	
	<!-- Includes for this demo -->
<!--	<link rel="stylesheet" href="demo-stuff/demo.css" type="text/css" media="screen" />-->
	
	<!-- Hook up the FlexSlider -->
	<!--<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider();
		});
	</script>-->
<!--end-->
<!--tab-->
<!--<link rel="stylesheet" href="<?php //echo URL; ?>/css/tab-ui.css" />
<script src="<?php //echo URL; ?>/js/jquery-ui-tab.js"></script>
<script>
$(function() {
$( "#tabs" ).tabs();
});
</script>-->
<!--end-->
<!--scroll bar-->
<link rel="stylesheet" href="<?php echo URL; ?>/css/slider.css">
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

	
		
<script src="<?php echo URL; ?>/javascript/home_slides.min.jquery.js"></script>

	<script>
		$(function(){
			$('#slides_one').slides({
				preload: true,
				generateNextPrev: true
			});
			$('#slides_two').slides({
				preload: true,
				generateNextPrev: true
			});
			$('#slides_three').slides({
				preload: true,
				generateNextPrev: true
			});
			$('#slides_four').slides({
				preload: true,
				generateNextPrev: true
			});
			$('#slides_five').slides({
				preload: true,
				generateNextPrev: true
			});
			$('#slides_six').slides({
				preload: true,
				generateNextPrev: true
			});
		});
	</script>
<!--end-->
<link href="<?php echo URL; ?>/css/mystyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {
	font-size: 14px;
	font-weight: bold;
}
.highlightit:hover img{
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);
-moz-opacity: 0.5;
opacity: 0.5;
}


-->
</style>
 <script type="text/javascript">
function createCookie(name, value, days) {
if (days) {
var date = new Date();
date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
var expires = "; expires=" + date.toGMTString();
}
else var expires = "";
document.cookie = name + "=" + value + expires + "; path=/";
}
function readCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(';');
for(var i=0;i < ca.length;i++) {
var c = ca[i];
while (c.charAt(0)==' ') c = c.substring(1,c.length);
if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
}
return null;
}
function eraseCookie(name) {
createCookie(name, "", -1); //
}
</script>
<link rel="stylesheet" href="<?php echo URL; ?>/css/mega-menu.css" type="text/css">
</script>
<link rel="stylesheet" href="<?php echo URL; ?>/css/popup.css" type="text/css" />
</head>

<body>
<script>
var isHomePage="true";
if(isHomePage=="false"){
$('.mainDiv').hide(); //
}
</script>
<script src="<?php echo URL; ?>/js/megaHeader.js"></script>
<script src="<?php echo URL; ?>/js/megajquery.js"></script>
<div id="shadow" class="popup"></div>
<!--start main container -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
	<td align="center" valign="top"><table width="1006px" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td> 
		
		
		<div id="main2" >
		<div class="navi2">
		<?php
				$count=0;
					
				mysqli_query($conn,"select * from ".$sufix."top_navigation where parent='0' and menuposition ='Top' and `displayflag`='1' order by sortid asc") ;
				
				$numnavhead1=$db->numRows();
				if($numnavhead1>0)
				{ //start first query condition							
					
					while($rownavhead1=mysqli_fetch_assoc())
					{ //start loop for parent menu name 
					$count++;
				?>
		
		
			  <div <?php if($count=='1' ) { ?>class="brands"<?php } ?><?php if($count=='2' ) { ?>class="ProFlowers"<?php } ?><?php if($count=='3' ) { ?>class="ProPlants"<?php } ?><?php if($count=='4' ) { ?>class="redENVELOPE"<?php } ?><?php if($count=='5' ) { ?>class="personal"<?php } ?><?php if($count=='6' ) { ?>class="CherryMoonFarms"<?php } ?><?php if($count=='7' ) { ?>class="CherryMoonFarms"<?php } ?>>
				<div align="center"><a href="<?php if($rownavhead1['targetlink']!='') { echo $rownavhead1['targetlink']; } else { ?><?php echo $url; ?>/<?php $query->subquery($sufix.'static_pages','id',$rownavhead1['pageid'],'link_name'); ?> <?php } ?>" title="<?php echo $rownavhead1['itemname']; ?>"><?php echo $rownavhead1['itemname']; ?></a></div>
			  </div>
		
			  <?php } } ?>
			  <div>
			  		
				<!--<div align="left"><a href="#"><img src="images/sharies-barries.jpg" width="126" height="31" border="0" /></a></div>-->
			  </div>
			  </div>
			</div>
			
			
			<!--<div id="headerContainer">
			<link href="<?php //echo URL; ?>/css/otherbrandsnavigation.css" rel="stylesheet" type="text/css">
		<div id="headerContainer">
		<script language="javascript" type="text/javascript" src="<?php //echo URL; ?>/javascript/ucotherbrandnavigation.js"></script>

	<div id="headerContainer">
		
		<ul id="ourBrandsLinks">            <li id="brandsLabel">                <img src="<?php //echo URL; ?>/images/TransparentPixel.gif" border="0">            </li>
		<li id="proFlowersLink"> <a class="brandLogo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/TransparentPixel.gif" alt="" style="border-width:0px;"></a>                        <a style="display: none;" class="displayMoreInfo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/PF_dropdown.gif" alt="" style="border-width:0px;"></a>                                </li>            <li id="proPlantsLink">                <a class="brandLogo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/TransparentPixel.gif" alt="" style="border-width:0px;"></a>                <a class="displayMoreInfo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/PP_dropdown.gif" alt="" style="border-width:0px;"></a>                       </li>            <li id="redEnvelopeLink">                <a class="brandLogo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/TransparentPixel.gif" alt="" style="border-width:0px;"></a>                <a class="displayMoreInfo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/RED_dropdown.gif" alt="" style="border-width:0px;"></a>            </li>            <li id="personalCreationsLink">                <a class="brandLogo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/TransparentPixel.gif" alt="" style="border-width:0px;"></a>                <a class="displayMoreInfo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/PC_dropdown.gif" alt="" style="border-width:0px;"></a>            </li>            <li id="cherryMoonFarmsLink">                <a class="brandLogo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/TransparentPixel.gif" alt="" style="border-width:0px;"></a>                <a class="displayMoreInfo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/CMF_dropdown.gif" alt="" style="border-width:0px;"></a>            </li>            <li id="berriesLink">                <a class="brandLogo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/TransparentPixel.gif" alt="" style="border-width:0px;"></a>                <a class="displayMoreInfo" rel="nofollow" href="#" target="_blank"><img src="<?php //echo URL; ?>/images/SB_dropdown.gif" alt="" style="border-width:0px;"></a></li></ul>
		
		</div>-->
		
	
	
	
		  <!--<tr>
			<td align="left" valign="top" class="top-link pad_1 pad_2 pad_left" >
			<?php
				/*$count=0;
					
				mysqli_query($conn,"select * from ".$sufix."top_navigation where parent='0' and menuposition ='Top' and `displayflag`='1' order by sortid asc") ;
				
				$numnavhead1=$db->numRows();
				if($numnavhead1>0)
				{ //start first query condition							
					
					while($rownavhead1=mysqli_fetch_assoc())
					{ //start loop for parent menu name 
					$count++;*/
				?>
				<a href="<?php //echo $url; ?>/<?php //$query->subquery($sufix.'static_pages','id',$rownavhead1['pageid'],'link_name'); ?>"><?php //echo $rownavhead1['itemname']; ?></a> <?php //if($numnavhead1 !=$count) { ?> | <?php //} ?>
				<?php  //} } ?>-->
			
			
		</td>
		  </tr>
		</table></td>
	</tr>
	
	
<tr>
<td height="45">&nbsp;</td>
</tr>
<tr>
	<td align="center" >
	
		<table width="990" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		  <tr>
			<td align="right"><!--<div id="main-tab"><div id="tabs">-->

<!--<div id="tabs-1">-->
<div><img src="images/blue-signup.jpg" width="213" height="30" /></div>
<div class="top-head">
  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
      <td width="30%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
		 <tr>
          <td><img src="images/specer.gif" width="5" height="5" /></td>
        </tr>
		
        <tr>
          <td class="pad_1 pad_2" style="padding-left:20px;"><a href="<?php echo URL; ?>/index.php"><img src="images/new-logo1.png" width="227" height="70" border="0" /></a></td>
        </tr>
      
      </table></td>
      <td width="70%" class="pad_1"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="top-link1">
        <tr>
          <td align="right" class="pad_2"><table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center">Phone Orders call 1.800.938.0333 </td>
              <td align="center"><img src="images/line.gif" width="1" height="13" /></td>
              <td align="center"><a href="#">buy-kart.com</a></td>
              <td align="center"><img src="images/line.gif" width="1" height="13" /></td>
              <td align="center"><a href="#">Customer Service</a></td>
              <td align="center"><img src="images/line.gif" width="1" height="13" /></td>
              <td align="center"><?php if($_SESSION['emailid']!='') { ?><a href="<?php echo URL; ?>/logout.php">Logout</a> <?php } else { ?> <?php include("login.php"); ?><a id="login_a" href="#">Sign In</a><?php } ?></td>
              <td align="center"><img src="images/line.gif" width="1" height="13" /></td>
              <td align="center"><?php if($_SESSION['emailid']!='') { ?><a href="<?php echo URL; ?>/myorders.php">Track Orders</a> <?php } else { ?> <a id="login_b" href="#">Track Orders</a><?php } ?><a href="#"></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="5%">&nbsp;</td>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="40%" style="padding-top:3px;"><form action="<?php echo URL; ?>/keywordsearch.php" method="get" name="search">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td style="padding-top:0px; padding-left:3px;"><input style=" width:255px; height:24px; padding-left:5px;" type="text" id="ksearch" name="ksearch" onfocus="if (this.value == 'Search by the typing the product'){this.value='';}" onblur="if (this.value == ''){this.value='Search by the typing the product';}" placeholder="Search by the typing the product"/></td>
						 <td width="12%" valign="top" style="padding-right:10px;">
						 <input name="search" type="image" src="<?php echo URL; ?>/images/search.gif" width="65" height="28" align="absmiddle" />
						 <!--<a href="search.html"><img src="images/search.gif" width="65" height="28" border="0" align="texttop" /></a>--></td>
					  </tr>
					</table>
</form></td>
                  <td width="47%" valign="top" style="padding-top:4px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                       <td width="21%" align="right"><a href="<?php echo URL; ?>/basket/cart"><img src="images/btn_cart.png" width="18" height="17" border="0" /></a></td>
                      <td width="54%" align="center"><?php 	$sql=$basket->selectcart($sufix);
							$num=$basket->num($sql);
							$totalcost=0;
								while($rows = mysqli_fetch_assoc($sql))
								{
									$pwieght=$pwieght + $rows['totalweight'];
								   	$totalweight=$totalweight + $rows['totalweight'];
								   	$qty=$qty + $rows['quantity'];
									
									$totalcost=$totalcost + $rows['subtotal'];
								}
								
									if($_SESSION['shopid']!='')
								{
									$shipcharge=$basket->shipchargeheader($sufix,$pwieght,$_SESSION['city']);
								}	
									$grandtotal=($totalcost + $shipcharge);
						?>	Shopping Cart  (<?php echo $num; ?>) <?php echo Currency; ?> <?php echo $grandtotal; ?></td>
                      <td width="25%" align="left"><a href="<?php echo URL; ?>/basket/cart"><img src="images/checkout.gif" width="78" height="28" border="0" /></a></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="top_menu1" style="background-color:#CC0000;">
  
  <tr>
  <?php
	
	$count=0;
	//echo "select * from ".$sufix."top_navigation where parent='0' and menuposition IN 'Header' order by sortid asc";
	
	mysqli_query($conn,"select * from ".$sufix."top_navigation where parent='0' and menuposition ='Header' and `displayflag`='1' order by sortid asc") ;
	
	$numnavhead=$db->numRows();
	if($numnavhead>0)
	{ //start first query condition							
		
		while($rownavhead=mysqli_fetch_assoc())
		{ //start loop for parent menu name 
	?>
  
  <td class="right-bdr" style="padding:10px 0px 9px 0px;" onMouseover="this.bgColor='#FF0000'" onMouseout="this.bgColor='#CC0000'"><a href="<?php echo $url; ?>/<?php $query->subquery($sufix.'static_pages','id',$rownavhead['pageid'],'link_name'); ?>"><?php echo $rownavhead['itemname']; ?></a></td>
    
 
	  
	 <?php } } ?>
    </tr>
  </table>
</div>

<!--</div>--><!--</div>--></td>
		  </tr>
  <tr>
	  <td align="center">
	  <?php 
$sql1=mysqli_query($conn,"$query->querybanner($sufix,'Index Top','id','0,1')) ;
$num=$query->num($sql1); 
if($num > 0)
{
while($rowsbanner=mysqli_fetch_assoc($sql1))
{ // 
?>
	<img src="<?php echo URL; ?>/bannerimages/<?php echo $rowsbanner['uploadimage']; ?>" border="0" width="994" height="34" />  
	  <!--<img src="images/top-ads.jpg" alt="" width="994" height="34" />-->
<?php } } ?>	  
	  
	  </td>
	  </tr>		  