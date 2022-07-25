<?php  
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
	$keys="shopurneeds"; 
}
?> 
<?php if($_SESSION['emailid']=='') { ?>
	<script>window.location.href='https://localhost/project/shopurneeds';</script>
<?php } ?>
<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from html.lionode.com/bigmarket/bm002/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jun 2020 13:50:32 GMT -->
<head>

  <!-- =====  BASIC PAGE NEEDS  ===== -->
    <meta charset="utf-8">
    <title>Shopurneeds online grocery store!</title>
    
    <!-- =====  SEO MATE  ===== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="distribution" content="global">
    <meta name="revisit-after" content="2 Days">
    <meta name="robots" content="ALL">
    <meta name="rating mt-5 mb-5" content="8 YEARS">
    <meta name="GOOGLEBOT" content="NOARCHIVE">
    
    <!-- =====  MOBILE SPECIFICATION  ===== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- =====  CSS  ===== -->
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../../use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/style.css">  
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/styledashboard.css">
    <link rel="shortcut icon" href="<?php echo URL; ?>/assets/images/Favicon.png">
    <link rel="apple-touch-icon" href="<?php echo URL; ?>/assets/images/apple-touch-icon.html">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL; ?>/assets/images/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL; ?>/assets/images/apple-touch-icon-114x114.html"> 
    <script>  
        $(document).ready(function(){ 
            var d = new Date();  
            var fullYear =  d.getFullYear();
            var fullMonth =  d.getMonth() + 1;
            var fullDate =  d.getDate();
            var current_date = fullYear+"-"+fullMonth+"-"+fullDate;  
              
            var hour =  d.getHours();
            var minute =  d.getMinutes(); 
            if(minute < 10)
            {
                minute = "0"+minute;
            }
            var current_time = hour+":"+minute; 
            
            var data = { 'current_date' : current_date,'current_time' : current_time};
        	$.ajax({
            	url : "set-current-datetime.php",
            	type : "POST",
            	data : data,
            	success : function(data) {   
            	}
        	});  
        });      
    </script> 
</head>

<body>
    <!-- =====  LODER  ===== -->
    <div class="loder"></div>
    <div class="wrapper"> 
        <!-- Modal -->
        <div id="subscribe-me-" class="modal animated" role="dialog" data-keyboard="true" tabindex="-1">
          <div class="newsletter-popup row align-items-center py-4  px-2"> 
            <img src="images/newsbg.html" alt="offer" class="offer col d-none d-sm-block">
            <div class="col-auto newsletter-popup-static newsletter-popup-top">
              <div class="popup-text">
                <div class="popup-title">50% <span>off</span></div>
                <div class="popup-desc mb-30">
                  <div>Sign up and get 50% off your next Order</div>
                </div>
              </div>
              <form onsubmit="return  validatpopupemail();" method="post">
                <div class="form-group required">
                  <input type="email" name="email-popup" id="email-popup" placeholder="Enter Your Email" class="form-control input-lg" required="">
                </div>
                <div class="form-group required">
                  <button type="submit" class="btn" id="email-popup-submit">Subscribe</button>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="checkme">
                  <label class="form-check-label" for="checkme">Dont show again</label>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Modal End -->

        <!-- =====  Nav START  ===== -->
        <nav id="top">
          <div class="container">
            <div class="row"> <span class="responsive-bar"><i class="fa fa-bars"></i></span>
              <div class="header-middle-outer closetoggle">
                <div id="responsive-menu" class="nav-container1 nav-responsive navbar">
                    <div class="navbar-collapse navbar-ex1-collapse collapse">
                    <ul class="nav navbar-nav"> 
                        <?php 
                        $sql=mysqli_query($conn,"select * from `".$sufix."category` where displayflag='1' and parent='0' order by sortid asc") ;
                        $num=mysqli_num_rows($sql); 
                        if($num > 0)
                        { 
                        while($rows=mysqli_fetch_assoc($sql))
                        {
                            $sql2=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rows['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                            $num2=mysqli_num_rows($sql2); 
                        ?>  
                            <li <?php if($num2 > 0) {   ?>  class="collapsed" data-toggle="collapse" data-target="#div<?php echo $rows['cat_id']; ?>" <?php } ?> > 
                                <a href="<?php echo URL; ?>/<?php echo $rows['cat_slug']; ?>"><?php echo $rows['categoryname']; ?></a>  
                                <?php if($num2 > 0) {   ?> 
                                <span><i class="fa fa-plus"></i></span>
                                <ul class="menu-dropdown collapse" id="div<?php echo $rows['cat_id']; ?>">
                                    <?php	
            			            while($rowsub2=mysqli_fetch_assoc($sql2))
                    				{   
                    			    ?>  
                                        <li class="dropdown"><a href="<?php echo URL; ?>/<?php echo $rowsub2['cat_slug']; ?>"><?php echo $rowsub2['categoryname']; ?></a>
                                        <?php 
                                        $sql3=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rowsub2['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                                        $num3=mysqli_num_rows($sql3); 
                                        if($num3 > 0)
                                        {   
                                        ?>
                                            <ul class="list-unstyled childs_2">
                                                <?php  
                					            while($rowsub3=mysqli_fetch_assoc($sql3))
                                				{   
                                			    ?> 
                                                    <li class="active"><a href="<?php echo URL; ?>/<?php echo $rowsub3['cat_slug']; ?>"><?php echo $rowsub3['categoryname']; ?></a></li>
                                                <?php } ?>     
                                            </ul> 
                                        <?php } ?>
                                        </li>  
                                    <?php } ?>
                                </ul> 
                                <?php } ?>  
                            </li>  
                        <?php } } ?>  
                    </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
        <!-- =====  Nav END  ===== -->
    
        <!-- =====  HEADER START  ===== -->
        <header id="header" class="section">
          <div class="container">
            <div class="header-top py-1">
              <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Welcome to shopurneeds!</p>
                  <!--<ul class="header-top-left pull-left">              
                    <li class="language dropdown px-2"> <span class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Language <span class="caret"></span> </span>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">English</a></li>
                        <li><a href="#">French</a></li>
                        <li><a href="#">German</a></li>
                      </ul>
                    </li>
                    <li class="currency dropdown pr-2"> <span class="dropdown-toggle" id="dropdownMenu12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Currency <span class="caret"></span> </span>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu12">
                        <li><a href="#">€ Euro</a></li>
                        <li><a href="#">£ Pound Sterling</a></li>
                        <li><a href="#">$ US Dollar</a></li>
                      </ul>
                    </li>
                  </ul> -->
                </div>
                <div class="col-md-6">
                  <ul class="header-top-right pull-right">
                      <li class="telephone" style="margin-right: 23px;">
                      <a href="<?php echo URL; ?>/register-seller"><i class="fa fa-user"></i> Sell On Shopurneeds</a> 
                    </li> 
                    <li class="telephone">
                      <a href="#"><i class="fa fa-phone"></i> 9711567607</a> 
                    </li>
                    
                    <?php if($_SESSION['emailid']=='') { ?>
                    <li class="login"><a   href="javascript:void(0);"  data-toggle="modal" data-target="#loginModal" ><i class="fa fa-user"></i> LOGIN / REGISTER</a></li> 
                    <?php } else { ?>
                    <li class="login" >
                      <a href="<?php echo URL; ?>/mydashboard" class="ng-binding"><i class="fa fa-user"></i> Hi, <?php echo $_SESSION['fnamenew']; ?> </a> 
                    </li>
                    <?php } ?>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="header section pt-15 pb-15">
            <div class="container">
              <div class="row">
                <div class="navbar-header col-2 header-bottom-left"> <a class="navbar-brand" href="<?php echo URL; ?>"> <img style="height: 60px;" alt="Bigmarket" src="<?php echo URL; ?>/assets/images/logo.png"> </a> </div>
                <div class="col-10 header-bottom-right">
                    <div class="header-menu">
                        <div class="responsive-menubar-block">
                          <span>Shop By<br> Category</span>
                          <span class="menu-bar collapsed" data-target=".navbar-ex1-collapse" data-toggle="collapse"><i class="fa fa-bars"></i></span>
                        </div>
                        <nav id="menu" class="navbar">
                            <div class="collapse navbar-collapse navbar-ex1-collapse">
                                <ul class="nav navbar-nav main-navigation"> 
                                 <?php 
                                $sql=mysqli_query($conn,"select * from `".$sufix."category` where displayflag='1' and parent='0' order by sortid asc") ;
                                $num=mysqli_num_rows($sql); 
                                if($num > 0)
                                { 
                                while($rows=mysqli_fetch_assoc($sql))
                                {
                                    $sql2=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rows['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                                    $num2=mysqli_num_rows($sql2); 
                                ?> 
                                    <li class="main_cat dropdown  "> <a href="<?php echo URL; ?>/<?php echo $rows['cat_slug']; ?>"><?php echo $rows['categoryname']; ?></a>
                                        <?php if($num2 > 0) {   ?> 
                                        <div class="dropdown-menu megamenu column4">
                                            <div class="dropdown-inner">
                                                <?php	
                        			            while($rowsub2=mysqli_fetch_assoc($sql2))
                                				{   
                                			    ?> 
                                                <ul class="list-unstyled childs_1"> 
                                                    <!-- 2 Level Sub Categories START -->
                                                    <li class="dropdown active"><a href="<?php echo URL; ?>/<?php echo $rowsub2['cat_slug']; ?>"><?php echo $rowsub2['categoryname']; ?></a>
                                                        <?php 
                                                        $sql3=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rowsub2['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                                                        $num3=mysqli_num_rows($sql3); 
                                                        if($num3 > 0)
                                                        {   
                                                        ?>
                                                            <div class="dropdown-menu">
                                                                <div class="dropdown-inner">
                                                                    <ul class="list-unstyled childs_2">
                                                                        <?php  
                                        					            while($rowsub3=mysqli_fetch_assoc($sql3))
                                                        				{   
                                                        			    ?> 
                                                                            <li class="active"><a href="<?php echo URL; ?>/<?php echo $rowsub3['cat_slug']; ?>"><?php echo $rowsub3['categoryname']; ?></a></li>
                                                                        <?php } ?>     
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </li> 
                                                    <!-- 2 Level Sub Categories END --> 
                                                </ul> 
                                                <?php } ?> 
                                                <div class="menu-image"> <img src="images/13.jpg" alt="" title="" class="img-thumbnail"> </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </li>  
                                <?php } } ?>   
                                </ul>
                          </div>
                        </nav>
                    </div>
                    <div class="header-link-search">
                        <div class="header-search">
                            <div class="actions">
                              <button type="submit" title="Search" class="action search" id="head-search"></button>
                            </div>
                            <div id="search" class="input-group">
                                <form action="<?php echo URL;?>/ksearch" id="searchForm" method="get">  
                                    <input type="text" name="ksearch" id="search-input" value="<?php echo $_REQUEST['ksearch']; ?>"   placeholder="Search" class="form-control input-lg" autocomplete="off">
                                    <span class="input-group-btn">
                                      <button type="submit" class="btn btn-default btn-lg">Search</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                        <div class="header-link">
                         <ul class="list-unstyled"> 
                            <?php   
                            $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Header' order by id asc limit 0,4");
                            $num1=mysqli_num_rows($sql1); 
                            if($num1 > 0)
                            { 
                                $j = 0;
                            while($rowsbanner1=mysqli_fetch_assoc($sql1))
                            {
                            ?>  
                                <li style="background:url(<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>) no-repeat 0 4px;"><a href="#"><?php echo $rowsbanner1['bannername']; ?></a></li> 
                				 
                            <?php $j++;  } } ?>  
                        </ul>
                        </div>
                    </div>
                    <div class="shopcart showcartvalue"> 
                        <div id="cart" class="btn-block mt-40 mb-30 ">
                            <button type="button" class="btn" data-target="#cart-dropdown" data-toggle="collapse" aria-expanded="true">
                              <span id="shippingcart">My basket</span>
                              <span id="cart-total">Item <?php echo $sqlcd=mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'")); ?></span>
                            </button>
                          <a href="<?php echo URL; ?>/basket/cart" class="cart_responsive btn"><span id="cart-text">My basket</span><span id="cart-total-res"><?php echo $sqlcd; ?></span> </a>
                        </div>
                        <div id="cart-dropdown" class="cart-menu collapse">
                          <ul>
                            <li>
                              <table class="table table-striped">
                                <tbody>
                                    <?php 
									if(isset($_SESSION['shopid']))
									{
                                    $grandtotal = 0;
                                    $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                                    while($rowcs=mysqli_fetch_array($sqlcd))
                                    { 
                                        $totalamount =  ($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                                        $grandtotal = $grandtotal + $totalamount; 
                                    ?>   
                                        <tr>
                                            <td class="text-center"><a href="#"><img style="width: 60px;" src="<?php echo URL;?>/uploads/productimage/thumb/<?php echo $rowcs['productimage']; ?>" alt="iPod Classic" title="iPod Classic"></a></td>
                                            <td style="width: 240px;" class="text-left product-name"><a href="<?php echo $rowcs['slug']; ?>"><?php echo $rowcs['productname']; ?></a> <span class="text-left price"><?php echo $rowcs['quantity']; ?> x <?php echo Currency.$rowcs['sellingprice']; ?></span>
                                              
                                            </td>
                                            <td class="text-center"><a class="close-cart"  href="<?php echo URL; ?>/process/delete_basket.php?id=<?php echo $rowcs['id']; ?>&pid=<?php echo $rowcs['productid']; ?>" onClick="return confirm('Are you sure delete product?')"><i class="fa fa-times-circle"></i></a></td>
                                        </tr> 
                                    <?php } } ?>  
                                </tbody>
                              </table>
                            </li>
                            <li>
                              <table class="table">
                                <tbody>
                                
                                  <tr>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td class="text-right"><?php echo Currency.$grandtotal; ?></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                            <li>
                              <form action="<?php echo URL; ?>/basket/cart">
                                <input class="btn pull-left" value="View cart" type="submit">
                              </form>
                              <form action="<?php echo URL; ?>/basket/cart">
                                <input class="btn pull-right" value="Checkout" type="submit">
                              </form>
                            </li>
                          </ul>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="header-static-block">
            <div class="container">
              <div class="row">
                <div class="icon-block">
                  <div class="home_icon">
                  <a href="index-2.html"><i class="fa fa-home"></i>Home</a>
                  </div>
                  <div class="search_icon">
                  <a href="#"><i class="fa fa-search"></i>Search</a>
                  </div>
                  <div class="cart_icon">
                  </div>
                  <div class="login_icon">
                    <a href="login.html"><i class="fa fa-user"></i>Login</a>
                  </div>
                  <!--div class="telephone_icon">
                    <a href="contact_us.html"><i class="fa fa-phone"></i>Contact</a>
                  </div-->
                </div>
              </div>
            </div>
          </div>
        </header>
        <!-- =====  HEADER END  ===== --> 
        
<?php include("header_popup_new.php");?>
 
 
      