<?php 
session_start(); 
include("currency_display.php");

if($sitename=='')
{
	$sitename="shopurneeds";// 
}
if(!$desc)
{
	$desc="shopurneeds";
}
if(!$keys)
{
	$keys="shopurneeds"; //
}
?>
<?php 
	$sql = mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."' order by id desc");
			 
    $num=mysqli_num_rows($sql);
    $totalcost=0;
    while($rows = mysqli_fetch_assoc($sql))
    {
        $pweight=$pweight + $rows['totalweight'];
        $totalweight=$totalweight + $rows['totalweight'];
        $qty=$qty + $rows['quantity'];
        $totalcost=$totalcost + $rows['subtotal'];
    }
    if($_SESSION['shopid']!='')
	{
		
		//echo $pweight; 
			if($cityname!='')
			{
				$sql="select * from ".$sufix."shipping where cityname='".$_SESSION['city']."' and displayflag='1'";			
			
				
			//echo $sql; 
			$sql2=mysqli_query($conn,$sql); //
			
			$num=mysqli_num_rows($sql2);
			if($num > 0)
			{
			
					$row=mysqli_fetch_array($sql2);					
					if($pweight > 200)
					{
						$shipcharge1=$row['shipcharge'];
						$shipcharge2=0;
						$wg=($pweight / 200);
						
						for($i=1; $i<=$wg; $i++)
						{
							$shipcharge2=$shipcharge2 + $row['shipcharge2'];
						}
						
						$shipcharge=$shipcharge1 + $shipcharge2;
					
					}
					elseif($pweight == 0)
					{
						$shipcharge=$row['shipcharge'];			
					
					}
					else
					{
						$shipcharge=$row['shipcharge'];					
					
					}
					
				}
			else
			{
				 
			}	
		    $shipcharge = $shipcharge;
		
			}
		
		
		
		
	}
        $grandtotal=($totalcost + $shipcharge);
?>
<?php 
$selseo = mysqli_query($conn,"select * from ".$sufix."function_website where position='HOME' and displayflag='1'");
$seorows = mysqli_fetch_assoc($selseo);
?>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $sitename; ?></title>
    <meta name="description" content="<?php echo $desc; ?>">
    <meta name="keywords" content="<?php echo $keys; ?>">
    <meta name="robots" content="INDEX,FOLLOW">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo URL; ?>/assets/images/Favicon.png">

    <meta id="meta-viewport" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <script>window._trackJs = { token: '17e72e29e3c04ce7a4299a45e4a6a2e4', application: 'web' }; var littletags = littletags || {}; window.ajaxCart = {disabled: false}; window.lazySizesConfig = {loadMode: 1}; littletags.locale = 'en'; littletags.skinUrl = ''; littletags.baseUrl = ''; window['ga'] = window['ga']||function(){(window['ga'].q=window['ga'].q||[]).push(arguments)};window['ga'].l=1*new Date(); if(document.fonts) { (function(a,b){for(var c=0;c<a.length;c++){var d=new FontFace(a[c][0],"url("+b+a[c][1]+"), url("+b+a[c][2]+")",a[c][3]);document.fonts.add(d);d.load()}})([["Crimson Text","fonts\/CrimsonText\/subset-CrimsonText-Roman.woff2","fonts\/CrimsonText\/subset-CrimsonText-Roman.woff",null],["Source","fonts\/Source\/subset-SourceSansPro-Regular.woff2","fonts\/Source\/subset-SourceSansPro-Regular.woff",null]], littletags.skinUrl); } var csModule=function(){csModule.q.push(arguments)};csModule.q=[]; csModule('utilsConfig', function () { return { BASE_URL: 'api', CSRF_TOKEN: 'AXnYL2FRmY8u2eFO' } }); (function (w) { var ua = w.navigator.userAgent.toLowerCase(), match=/(edge)\/([\w.]+)/.exec(ua)||/(opr)[\/]([\w.]+)/.exec(ua)||/(chrome)[ \/]([\w.]+)/.exec(ua)||/(iemobile)[\/]([\w.]+)/.exec(ua)||/(version)(applewebkit)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(ua)||/(webkit)[ \/]([\w.]+).*(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(ua)||/(webkit)[ \/]([\w.]+)/.exec(ua)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua)||/(msie) ([\w.]+)/.exec(ua)||0<=ua.indexOf("trident")&&/(rv)(?::| )([\w.]+)/.exec(ua)||ua.indexOf("compatible")<0&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua)||[], platform_match=/(ipad)/.exec(ua)||/(ipod)/.exec(ua)||/(windows phone)/.exec(ua)||/(iphone)/.exec(ua)||/(kindle)/.exec(ua)||/(silk)/.exec(ua)||/(android)/.exec(ua)||/(win)/.exec(ua)||/(mac)/.exec(ua)||/(linux)/.exec(ua)||/(cros)/.exec(ua)||/(playbook)/.exec(ua)||/(bb)/.exec(ua)||/(blackberry)/.exec(ua)||[]; littletags.agent = { browser: match[ 5 ] || match[ 3 ] || match[ 1 ] || "", version: match[ 2 ] || match[ 4 ] || "0", versionNumber: match[ 4 ] || match[ 2 ] || "0", platform: platform_match[ 0 ] || "" }; })(window); window.ABTest={init:function(){var e,t=location.hash;if(-1!==t.indexOf("#ABTest=")&&(e=t.substring(8)),!e){var a;try{a=JSON.parse(window.localStorage.getItem("absgmt"))}catch(e){}a&&a.expiry>(new Date).getTime()&&a.value&&(e=a.value)}if(!e){e="seg"+(Math.floor(2*Math.random())+1);try{window.localStorage.setItem("absgmt",JSON.stringify({value:e,expiry:(new Date).getTime()+7776e6}))}catch(e){}}this.segment=e,document.body.className+=" "+e}};</script><!--[if lt IE 10]><script type="text/javascript" src="js/polyfills/ie9-oninput-polyfill.min.js"></script><script type="text/javascript" src="js/polyfills/polyfill-bind.min.js"></script><![endif]-->
    
    <!--[if lt IE 10]>
    <link rel="stylesheet" type="text/css" href="https://cdn.littletags.com/media/css/f3361948f3783435d7343f824459b911-SSL-1530625026.css" media="all" />
    <![endif]-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/cart.css">
    

<!-- Event snippet for Add to cart conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
  <style>
        .ruby-col-2:nth-child(odd) {
  background: #f9f9f9;
}
    </style>

	</head>
   
	<body >
	    <div class="container-fluid" style="background:#84c225;">
	        <div class="header__content" style="    padding: 15px 0;" >
                     <div class="row">
                         <div class="col-md-3">
                            <div class="menu--product-categories">
               <a class="ps-logo" href="https://localhost/project/shopurneeds"><img  src="https://localhost/project/shopurneeds/assets/images/logo.png" alt="" style="height: 55px;"></a>
            </div> 
                         </div>
                          <div class="col-md-9">
                          <h4 style="    float: right;">Great ! Your Order is almost placed.  Do not Refresh or Press back Button.</h4>   
                         </div>
                         </div> 
                         
                     </div>
                      </div>
<div class="clearfix"></div> 
