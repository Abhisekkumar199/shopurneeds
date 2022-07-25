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
    $sql=$basket->selectcart($sufix);
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
?>
<?php 
$selseo = mysqli_query($conn,"select * from ".$sufix."function_website where position='HOME' and displayflag='1'");
$seorows = mysqli_fetch_assoc($selseo);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Martfury - Multi Vendor &amp; Marketplace</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/asset/css/style.css">
</head> 
<body>
    <header class="header header--1" data-sticky="true">
        <div class="header__top">
            <div class="ps-container">
                <div class="header__left">
                    <div class="menu--product-categories">
                       <a class="ps-logo" href="<?php echo URL; ?>"><img src="asset/img/logo_light.png" alt=""></a>
                    </div>
                    <a class="ps-logo" href="<?php echo URL; ?>"><img src="asset/img/logo_light.png" alt=""></a>
                </div>
                <div class="header__center">
                    <form class="ps-form--quick-search" action="<?php echo URL; ?>" method="get">
                       
                      <input class="form-control" type="text" placeholder="I'm shopping for...">
                      <button>Search</button>
                    </form>
                </div>  
                <div class="header__right ">
                    <div class="header__actions"> 
                    <?php if($_SESSION['emailid']=='') { ?> 
                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#loginModal" class="header__extra" > <i class="icon-heart"></i><span><i></i></span></a> 
                    <?php } else { 
                        $numsql = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."favorite_product where user_id = '".$_SESSION['useridse']."'"));
                    ?>
                     <a href="<?php echo URL; ?>/myfavorite"  class="header__extra"  ><i class="icon-heart"></i><span><i><?php if($numsql>0) { echo $numsql; } ?></i></span></a> 
                    <?php } ?> 
                    <div class="ps-cart--mini showcartvalue">
                        <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i><?php echo $sqlcd=mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'")); ?></i></span></a>
                        <div class="ps-cart__content">
                            <?php if($sqlcd > 0) { ?>
                            <div class="ps-cart__items">
                                <?php 
                                $grandtotal = '';
                                $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                                while($rowcs=mysqli_fetch_array($sqlcd))
                                { 
                                    $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                                    $grandtotal = $grandtotal + $totalamount; 
                                ?>     
                                <div class="ps-product--cart-mobile">
                                    <div class="ps-product__thumbnail"><a href="#"><img src="<?php echo URL;?>/uploads/productimage/small/<?php echo $rowcs['productimage']; ?>" alt=""></a></div>
                                    <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html"><?php echo $rowcs['productname']; ?></a>
                                        <p><strong>Size:</strong>  <?php echo $rowcs['size']; ?></p>
                                        <small><?php echo $rowcs['quantity']; ?> x <?php echo Currency.$totalamount; ?></small>
                                    </div>
                                </div>
                                <?php } ?> 
                            
                            </div>
                            <div class="ps-cart__footer">
                                <h3>Sub Total:<strong><?php echo Currency.$grandtotal; ?></strong></h3>
                                <figure><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >View Cart</a><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >Checkout</a></figure>
                            </div>
                            <?php } else { ?>
                                <p>Your Cart is empty</p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="ps-block--user-header">
                        <?php if($_SESSION['emailid']=='') { ?>
                            <div class="ps-block__left"><i class="icon-user"></i></div><div class="ps-block__right"><a href="my-account.html">Login</a></div> 
                        <?php } else { ?> 
                          <div class="ps-block__left"><i class="icon-user"></i></div><a href="<?php echo URL; ?>/mydashboard" class="ng-binding">Hi, <?php echo $_SESSION['fnamenew']; ?></a></div>
                        <?php } ?> 
                    </div>
                </div>
            </div> 
        </div> 
        <nav class="navigation">
            <div class="ps-container">
                <div class="navigation__left">
                <div class="menu--product-categories">
                
                </div>
                </div>
                <div class="navigation__right">
                    <ul class="menu">
                    <?php 
                    $sql=mysqli_query($conn,"select * from `".$sufix."category` where displayflag='1' and parent='0' order by sortid asc") ;
                    $num=$query->num($sql); 
                    if($num > 0)
                    {
                    $catcount=1;
                    while($rows=mysqli_fetch_assoc($sql))
                    {
                    ?> 
                        <li class="menu-item-has-children has-mega-menu"><a href="<?php echo URL; ?>/<?php echo $rows['cat_slug']; ?>"><?php echo $rows['categoryname']; ?></a><span class="sub-toggle"></span>  
                        <?php 
                        $sql2=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rows['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                        $num2=$query->num($sql2); 
                        if($num2 > 0)
                        {   
                        ?> 
                            <div class="mega-menu"> 
                                <?php	
                                while($rowsub2=mysqli_fetch_assoc($sql2))
                    			{   
                    		    ?>  
                                    <div class="mega-menu__column">
                                    <h4> <a href="<?php echo URL; ?>/<?php echo $rowsub2['cat_slug']; ?>"><?php echo $rowsub2['categoryname']; ?></a><span class="sub-toggle"></span></h4>
                                    <?php 
                                    $sql3=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rowsub2['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                                    $num3=$query->num($sql3); 
                                    if($num3 > 0)
                                    {   
                                    ?>
                                        <ul class="mega-menu__list">
                                        <?php	
                    		            while($rowsub3=mysqli_fetch_assoc($sql3))
                        				{   
                        			    ?> 
                        			        <li class="current-menu-item "><a href="<?php echo $rowsub3['cat_slug']; ?>"><?php echo $rowsub3['categoryname']; ?></a> </li>
                        			    <?php } ?>
                        			    </ul>      
                                    <?php } ?>  
                                   </div> 
                                <?php } ?> 
                            </div>  
                        <?php } ?>
                        </li>
                    <?php } } ?> 
                    </ul>
                    <ul class="navigation__extra"> 
                        <li>
                        <div class="ps-dropdown"><a href="#">US Dollar</a>
                          <ul class="ps-dropdown-menu">
                            <li><a href="#">Us Dollar</a></li>
                            <li><a href="#">Euro</a></li>
                          </ul>
                        </div>
                        </li>
                        <li>
                        <div class="ps-dropdown language"><a href="#"><img src="asset/img/flag/en.png" alt="">English</a>
                          <ul class="ps-dropdown-menu">
                            <li><a href="#"><img src="asset/img/flag/germany.png" alt=""> Germany</a></li>
                            <li><a href="#"><img src="asset/img/flag/fr.png" alt=""> France</a></li>
                          </ul>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <header class="header header--mobile" data-sticky="true">
        <div class="header__top">
            <div class="header__left">
              <p>Welcome to Martfury Online Shopping Store !</p>
            </div>
            <div class="header__right">
                <ul class="navigation__extra">
                <li><a href="#">Sell on Martfury</a></li>
                <li><a href="#">Tract your order</a></li>
                <li>
                  <div class="ps-dropdown"><a href="#">US Dollar</a>
                    <ul class="ps-dropdown-menu">
                      <li><a href="#">Us Dollar</a></li>
                      <li><a href="#">Euro</a></li>
                    </ul>
                  </div>
                </li>
                <li>
                  <div class="ps-dropdown language"><a href="#"><img src="asset/img/flag/en.png" alt="">English</a>
                    <ul class="ps-dropdown-menu">
                      <li><a href="#"><img src="asset/img/flag/germany.png" alt=""> Germany</a></li>
                      <li><a href="#"><img src="asset/img/flag/fr.png" alt=""> France</a></li>
                    </ul>
                  </div>
                </li>
                </ul>
            </div>
        </div>
        <div class="navigation--mobile">
        <div class="navigation__left"><a class="ps-logo" href="<?php echo URL; ?>"><img src="asset/img/logo_light.png" alt=""></a></div>
            <div class="navigation__right">
              <div class="header__actions">
                
                <div class="ps-cart--mini showcartvalue">
                    <a class="header__extra" href="#"><i class="icon-bag2"></i><span><i><?php echo $sqlcd=mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'")); ?></i></span></a>
                    <div class="ps-cart__content">
                        <?php if($sqlcd > 0) { ?>
                        <div class="ps-cart__items">
                            <?php 
                            $grandtotal = '';
                            $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
                            while($rowcs=mysqli_fetch_array($sqlcd))
                            { 
                                $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                                $grandtotal = $grandtotal + $totalamount; 
                            ?>     
                            <div class="ps-product--cart-mobile">
                                <div class="ps-product__thumbnail"><a href="#"><img src="<?php echo URL;?>/uploads/productimage/small/<?php echo $rowcs['productimage']; ?>" alt=""></a></div>
                                <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html"><?php echo $rowcs['productname']; ?></a>
                                    <p><strong>Size:</strong>  <?php echo $rowcs['size']; ?></p>
                                    <small><?php echo $rowcs['quantity']; ?> x <?php echo Currency.$totalamount; ?></small>
                                </div>
                            </div>
                            <?php } ?> 
                        
                        </div>
                        <div class="ps-cart__footer">
                            <h3>Sub Total:<strong><?php echo Currency.$grandtotal; ?></strong></h3>
                            <figure><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >View Cart</a><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >Checkout</a></figure>
                        </div>
                        <?php } else { ?>
                            <p>Your Cart is empty</p>
                        <?php } ?>
                    </div>
                </div> 
                <div class="ps-block--user-header">
                    <?php if($_SESSION['emailid']=='') { ?>
                    <div class="ps-block__left"><i class="icon-user"></i></div><div class="ps-block__right"><a href="my-account.html">Login</a></div> 
                    <?php } else { ?> 
                    <div class="ps-block__left"><i class="icon-user"></i></div><a href="<?php echo URL; ?>/mydashboard" class="ng-binding">Hi, <?php echo $_SESSION['fnamenew']; ?></a></div>
                    <?php } ?>  
                </div>
              </div>
            </div>
        </div>
        <div class="ps-search--mobile">
            <form class="ps-form--search-mobile" action="<?php echo URL; ?>" method="get">
              <div class="form-group--nest">
                <input class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>
              </div>
            </form>
        </div>
    </header> 
    <div class="ps-panel--sidebar" id="cart-mobile">
        <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
        </div>
        <div class="navigation__content showcartvalue">
            <?php if($sqlcd > 0) { ?>
            <div class="ps-cart--mobile">
            <div class="ps-cart__content">
            <?php 
            $grandtotal = '';
            $sqlcd=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$_SESSION['shopid']."'");
            while($rowcs=mysqli_fetch_array($sqlcd))
            { 
                $totalamount = floor($rowcs['sellingprice']*$_SESSION['conratio']) * $rowcs['quantity'];
                $grandtotal = $grandtotal + $totalamount; 
            ?>     
            <div class="ps-product--cart-mobile">
                <div class="ps-product__thumbnail"><a href="#"><img src="<?php echo URL;?>/uploads/productimage/small/<?php echo $rowcs['productimage']; ?>" alt=""></a></div>
                <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html"><?php echo $rowcs['productname']; ?></a>
                    <p><strong>Size:</strong>  <?php echo $rowcs['size']; ?></p>
                    <small><?php echo $rowcs['quantity']; ?> x <?php echo Currency.$totalamount; ?></small>
                </div>
            </div>
            <?php } ?> 
            </div>
            <div class="ps-cart__footer">
                <h3>Sub Total:<strong><?php echo Currency.$grandtotal; ?></strong></h3>
                <figure><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >View Cart</a><a class="ps-btn" href="<?php echo URL; ?>/basket/cart" >Checkout</a></figure>
            </div>
            </div>
            <?php }  else { ?>
                <p>Your Cart is empty</p>
            <?php } ?>
        </div>
    </div> 
    
    <div class="ps-panel--sidebar" id="navigation-mobile">
        <div class="ps-panel__header">
            <h3>Categories</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">
                <?php 
                $sql_mobile_cat=mysqli_query($conn,"select * from `".$sufix."category` where displayflag='1' and parent='0' order by sortid asc") ;
                $num=$query->num($sql_mobile_cat); 
                if($num > 0)
                {
                $catcount=1;
                while($rows_mobile_cat=mysqli_fetch_assoc($sql_mobile_cat))
                {
                    $sql2=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rows_mobile_cat['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                    $num2=$query->num($sql2); 
                ?> 
                    <li class="current-menu-item  <?php if($num2 >0)  { ?>menu-item-has-children has-mega-menu <?php } ?>"><a href="<?php echo URL; ?>/<?php echo $rows_mobile_cat['cat_slug']; ?>"><?php echo $rows_mobile_cat['categoryname']; ?></a><span class="sub-toggle"></span>  
                    <?php 
                    
                    if($num2 > 0)
                    {   
                    ?> 
                        <div class="mega-menu"> 
                            <?php	
				            while($rowsub2=mysqli_fetch_assoc($sql2))
            				{   
            			    ?>  
                                <div class="mega-menu__column">
                                <h4> <a href="<?php echo URL; ?>/<?php echo $rowsub2['cat_slug']; ?>"><?php echo $rowsub2['categoryname']; ?></a><span class="sub-toggle"></span></h4>
                                <?php 
                                $sql3=mysqli_query($conn,"select * from `".$sufix."category` where parent='".$rowsub2['cat_id']."' and displayflag='1'  order by sortid asc") ; 	 
                                $num3=$query->num($sql3); 
                                if($num3 > 0)
                                {   
                                ?>
                                    <ul class="mega-menu__list">
                                    <?php	
    					            while($rowsub3=mysqli_fetch_assoc($sql3))
                    				{   
                    			    ?> 
                    			        <li class="current-menu-item "><a href="<?php echo $rowsub3['cat_slug']; ?>"><?php echo $rowsub3['categoryname']; ?></a> </li>
                    			    <?php } ?>
                    			    </ul>      
                                <?php } ?>  
                               </div> 
                            <?php } ?> 
                        </div>  
                    <?php } ?>
                    </li>
                <?php } } ?>  
            </ul>
        </div>
    </div>
    <div class="navigation--list">
        <div class="navigation__content"> 
          <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a>
          <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a>
          <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a>
        </div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
      <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="<?php echo URL; ?>" method="get">
          <div class="form-group--nest">
            <input class="form-control" type="text" placeholder="Search something...">
            <button><i class="icon-magnifier"></i></button>
          </div>
        </form>
      </div>
      <div class="navigation__content"></div>
    </div> 
    
     
<?php include("header_popup_new.php");?>