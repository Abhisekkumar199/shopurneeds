<?php  
if(isset($_SESSION['id'])) 
{  
	$sqlssass=mysqli_query($conn,"select * from shopurneeds_admin where id='".$_SESSION['id']."'"); 
	$rowsql121=mysqli_fetch_assoc($sqlssass); 
	$_SESSION['id'] = $rowsql121['id'];	 
	$_SESSION['username'] = $rowsql121['username'];	 
	$_SESSION['usertype'] = $rowsql121['type']; 
	$permission = $rowsql121['permission'];
}
else
{
?>
	<script>window.location.href='<?php echo URL; ?>/admin-panel';</script> 
<?php } ?>
<?php
$url = $_SERVER['REQUEST_URI']; 
$url_array = explode('/',$url);
$current_page = $url_array[2];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <title>Super Admin Panel Perpetual Access Licence Active - Webkype</title>
    <meta name="description" content="Super Admin Panel Perpetual Access Licence Active - Webkype">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <!-- style -->
    <link rel="stylesheet" href="<?php echo URL; ?>/admin-panel/assets/css/site.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?php echo URL; ?>/admin-panel/ckeditor/ckeditor.js"></script>
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
        (function($) { $("a").addClass('no-pjax');}(jQuery));     
    </script>
</head>

<body class="layout-row">
    <!-- ############ Aside START-->
    <div id="aside" class="page-sidenav no-shrink bg-light nav-dropdown fade" aria-hidden="true">
        <div class="sidenav h-100 modal-dialog bg-light">
            <!-- sidenav top -->
            <div class="navbar">
                <!-- brand -->
                <a href="<?php echo URL; ?>/admin-panel/dashboard" class="navbar-brand">
                    <img src="<?php echo URL; ?>/assets/images/logo.png" alt="...">
                </a>
                <!-- / brand -->
            </div>
            <!-- Flex nav content -->
            <div class="flex scrollable hover">
                <div class="nav-active-text-primary" data-nav> 
                    <ul class="nav">  
                        <li><a href="<?php echo URL; ?>/admin-panel/dashboard"><span class="nav-icon text-primary"><i data-feather="home"></i></span> <span class="nav-text">DASHBOARD  </span></a></li>
                        <?php 
                        if($_SESSION['usertype'] == "User")
                        { 
                            $sql=mysqli_query($conn,"select * from `".$sufix."menu_permission` where displayflag='1' and parent='0'  and id IN ($permission) order by sortid asc") ;
                        }
                        else
                        {
                            $sql=mysqli_query($conn,"select * from `".$sufix."menu_permission` where displayflag='1' and parent='0'   order by sortid asc") ;
                        } 
                        $num=$query->num($sql); 
                        ?> 
                        <?php
                        if($num > 0)
                        {
                            $catcount=1;
                            while($rows=mysqli_fetch_assoc($sql))
                            {
                            ?>
                                <li><a href="#" class=""><span class="nav-icon text-success"><?php if($rows['icon'] !=''){ ?><i data-feather="<?php echo $rows['icon']; ?>"></i> <?php } else { ?><i data-feather="grid"></i><?php } ?></span> <span class="nav-text"><?php echo $rows['menu']; ?></span> 
                                
                                    <?php 
                                    $sql_sub_menu=mysqli_query($conn,"select * from `".$sufix."menu_permission` where parent='".$rows['id']."' and displayflag='1'  order by sortid asc") ;	
                                    $num_sub_menu=$query->num($sql_sub_menu); 
                                    if($num_sub_menu > 0)
                                    {
                                    ?>
                                    <span class="nav-caret"></span></a> 
                                    <ul class="nav-sub nav-mega">
                                    <?php
                                    while($row_menu=mysqli_fetch_assoc($sql_sub_menu))
                                    {
                                    ?> 
                                        <li><a href="<?php echo $row_menu['link']; ?>" data-pjax="0" ><span class="nav-text"><?php echo $row_menu['menu']; ?></span></a></li> 
                                    <?php  } ?>  
                                        </ul>
                                    <?php  } else { ?>
                                        </a> 
                                    <?php } ?> 
                                </li> 
                        <?php } } ?> 
                    </ul>
                </div>
            </div>
            <!-- sidenav bottom -->
            <div class="no-shrink">
                <div class="p-3 d-flex align-items-center"> 
                    <div class="progress mx-2 flex" style="height:4px">
                        <div class="progress-bar gd-success" style="width: 35%"></div>
                    </div>
                </div>
                <p>© Webkype. All rights reserved.</p>
            </div>
        </div>
    </div>
    <!-- ############ Aside END-->
    <div id="main" class="layout-column flex">
        <!-- ############ Header START-->
        <div id="header" class="page-header">
            <div class="navbar navbar-expand-lg">
                <!-- brand -->
                <a href="index.html" class="navbar-brand d-lg-none">
                    <svg width="32" height="32" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <g class="loading-spin" style="transform-origin: 256px 256px">
                            <path d="M200.043 106.067c-40.631 15.171-73.434 46.382-90.717 85.933H256l-55.957-85.933zM412.797 288A160.723 160.723 0 0 0 416 256c0-36.624-12.314-70.367-33.016-97.334L311 288h101.797zM359.973 134.395C332.007 110.461 295.694 96 256 96c-7.966 0-15.794.591-23.448 1.715L310.852 224l49.121-89.605zM99.204 224A160.65 160.65 0 0 0 96 256c0 36.639 12.324 70.394 33.041 97.366L201 224H99.204zM311.959 405.932c40.631-15.171 73.433-46.382 90.715-85.932H256l55.959 85.932zM152.046 377.621C180.009 401.545 216.314 416 256 416c7.969 0 15.799-.592 23.456-1.716L201.164 288l-49.118 89.621z"></path>
                        </g>
                    </svg>
                    <!-- <img src="assets/img/logo.png" alt="..."> --><span class="hidden-folded d-inline l-s-n-1x d-lg-none">Basik</span> </a>
                <!-- / brand -->
                <!-- Navbar collapse -->
                <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarToggler">
                   
                </div>
                <ul class="nav navbar-menu order-1 order-lg-2"> 
                    <li class="nav-item dropdown"><a class="nav-link px-2" data-toggle="dropdown"><i data-feather="settings"></i> </a>
                        <!-- ############ Setting START-->
                        <div class="dropdown-menu dropdown-menu-center mt-3 w-md animate fadeIn">
                            <div class="setting px-3">
                                <div class="mb-2 text-muted"><strong>Setting:</strong></div>
                                <div class="mb-3" id="settingLayout">
                                    <label class="ui-check ui-check-rounded my-1 d-block">
                                        <input type="checkbox" name="stickyHeader"> <i></i> <small>Sticky header</small></label>
                                    <label class="ui-check ui-check-rounded my-1 d-block">
                                        <input type="checkbox" name="stickyAside"> <i></i> <small>Sticky aside</small></label>
                                    <label class="ui-check ui-check-rounded my-1 d-block">
                                        <input type="checkbox" name="foldedAside"> <i></i> <small>Folded Aside</small></label> 
                                </div>
                                <div class="mb-2 text-muted"><strong>Color:</strong></div>
                                <div class="mb-2">
                                    <label class="radio radio-inline ui-check ui-check-md">
                                        <input type="radio" name="bg" value=""> <i></i></label>
                                    <label class="radio radio-inline ui-check ui-check-color ui-check-md">
                                        <input type="radio" name="bg" value="bg-dark"> <i class="bg-dark"></i></label>
                                </div>
                                 
                            </div>
                        </div>
                        <!-- ############ Setting END-->
                    </li>
                    <!-- Notification --> 
                    <!-- User dropdown menu -->
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link d-flex align-items-center px-2 text-color"><span class="avatar w-24" style="margin: -2px"><img src="assets/img/user.png" alt="..."></span></a>
                        <div class="dropdown-menu dropdown-menu-right w mt-3 animate fadeIn">  
                            <a class="dropdown-item" href="<?php echo URL; ?>/admin-panel/logout">Sign out</a>
                        </div>
                    </li>
                    <!-- Navarbar toggle btn -->
                    <li class="nav-item d-lg-none"><a href="#" class="nav-link px-2" data-toggle="collapse" data-toggle-class data-target="#navbarToggler"><i data-feather="search"></i></a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link px-1" data-toggle="modal" data-target="#aside"><i data-feather="menu"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- ############ Footer END-->
        