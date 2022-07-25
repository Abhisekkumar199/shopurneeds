 
<div class="da_body"  style="width:100%; padding:10px;" >
<?php
    $sql=mysqli_query($conn,"select * from `".$sufix."user_registration` where emailid='".$_SESSION['emailid']."'");
    if($rows = mysqli_fetch_assoc($sql))
    {
?>
  <div class="da_dashboard">
    <!--left dashboard sidebar starts here-->
    <?php include("includes/left_account.php"); ?>
    <!--right dashboard starts here-->
    <div class="da_right_board fleft">
      <h1> My Dashboard
        
      </h1>
      <!--Fav Stores Starts here-->
      <div class="da_dashboard_cont">
        <div class="da_wel_dash">
          <h3>Hello, <?php echo $rows['fname'].'&nbsp;'.$rows['lname']; ?></h3>
          From Dashboard you have the ability to view a snapshot of your recent account activity and update your account
          information. Select a link below to view or edit information.</div>
        <!--more info starts here-->
        <div class="da_more_info_container">
            <div class="da_onehalf fleft" style="width:100%;">
                <h3>Contact Information <span><a href="editprofile.php">Edit</a></span></h3>
                <p> <span class="da_myname"><?php echo $rows['fname'].'&nbsp;'.$rows['lname']; ?></span> <span class="da_myemail">Email: <a href="#" style="color:#002b4f;"><?php echo $rows['emailid']; ?></a></span> <span class="da_myemail">Mobile no : <a href="#" style="color:#002b4f;"><?php echo $rows['billing_mobile']; ?></a></span></p>
            </div> 
            <div class="da_onehalf fleft pull-right">
                <h3>My Orders <span><a href="<?php echo $url; ?>/myorders">View more</a></span></h3>
                <div style="overflow-y:scroll; " class="fix_height_tab">
                    <ul class="fav_items_dash">
                    <?php  
                    $sql_orders = mysqli_query($conn,"select * from `".$sufix."order`  where emailid = '".$_SESSION['emailid']."' order by oid desc limit 5 ");
                    while($row_orders = mysqli_fetch_assoc($sql_orders))
                    { 
                    ?>
                        <li > 
                            <div class="row" style="padding: 5px;">
                                <div class="col-md-4">
                                    <div class="det" style="float:left;"> OID :  <?php echo $row_orders['oid'];?></div> <br>
                                    <div class="det" style="float:left;">O.Type :<?php echo $row_orders['paytype'];?></div>
                                </div>
                                <div class="col-md-6 ">
                                  
                                  <div class="det" style="float:left;">Date :<?php echo $row_orders['orderdate'];?></div><br>
                                  <div class="det" style="float:left;">Status :<?php echo $row_orders['approve_status'];?></div>
                                </div>
                                <div class="col-md-2  ">
                                  <a href="<?php echo $url; ?>/orderdetails.php?oid=<?php echo $row_orders['oid'];?>"><div class="btn btn-primary " style="float:right;   padding: 4px 4px; font-size: 13px; ">Details</div></a>
                                </div>
                            </div> 
                            <div class="clearfix"></div>
                            <hr / style="margin:5px 0">
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            
            <div class="da_onehalf fleft pull-right">
                <h3>Favourite Items <span><a href="myfavorite">View more</a></span></h3>
                <div style="overflow-y:scroll; " class="fix_height_tab">
                    <ul class="fav_items_dash">
                    <?php 
                    $favorite_product = mysqli_query($conn,"select * from ".$sufix."favorite_product where user_id = '".$_SESSION['useridse']."'");
                    while($row_favorite_product = mysqli_fetch_assoc($favorite_product))
                    {
                        $fprosql = mysqli_query($conn,"select * from ".$sufix."product where id =  '".$row_favorite_product['product_id']."'");
                        $row = mysqli_fetch_assoc($fprosql);
                        $sql4="select * from ".$sufix."imageupload where displayflag='1' and pid='".$row['id']."' order by mainimage desc Limit 1";
        				 $sqlimage=mysqli_query($conn,$sql4);
        				 $rowimage=mysqli_fetch_assoc($sqlimage)
                    ?>
                        <li style="padding-top:10px;">
                            
                            <div class="row">
                                <div class="col-md-2 "> <img src="<?php echo URL;?>/uploads/productimage/thumb/<?php echo $rowimage['productimage'];?>" style="padding-left:20px;height:50px; float:left;"/></div>
                                <div class="col-md-7 ">
                                  <div class="det" style="float:left;"><?php echo substr($row['productname'],0,25);?> <?php if(strlen($row['productname'])>25) { echo "..."; } ?> </div>
                                </div>
                                <div class="col-md-3  ">
                                  <a href="<?php echo $url; ?>/<?php echo $row['slug']; ?>"><div class="btn btn-primary " style="float:right;   padding: 4px 10px; font-size: 13px; ">Buy Now</div></a>
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>
                            <hr / style="margin:5px 0">
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            
            
             
            
            
            
            <!--<?php 
            $sql_user_address=mysqli_query($conn,"select * from ".$sufix."customer_address where user_id='".$_SESSION['useridse']."'");
            $totaladdress = mysqli_num_rows($sql_user_address);
            while($row_address = mysqli_fetch_assoc($sql_user_address))
            {
            ?> 
                <div class="da_onehalf fleft pull-right">
                    <h3><?php echo $row_address['addresstype']; ?> Address </h3>
                    <p> <span class="da_myname"><?php echo $row_address['fname']." ".$row_address['lname']; ?></span> 
                     <?php echo $row_address['address']; ?> <?php echo  $row_address['city'].", ".$row_address['zipcode']." ".$row_address['country']; ?> <br>
                      Mobile No: <?php echo $rows['mobileno']; ?> <br>
                    </p>
                </div> 
                <div class="clearfix"></div> 
            <?php } ?>-->
        </div>
        <!--more info ends here-->
      </div>
      <!--Fav Stores ends here-->
    </div>
    <!--right dashboard ends here-->
    <div class="clear"></div>
  </div>
  <?php } ?>
</div>
<style>
@media (max-width: 640px) {
    ul.fav_items_dash br {
    display: none;
}
	.da_dashboard{ width:100%; padding:0; margin-top:10px;}
	.da_left_dash {
    border-right: 0 none;
    padding-right: 0;
    width: 100%;
}
.da_left_dash ul li a{ text-align:center;}
.da_right_board {
    padding: 0 15px;
    width: 100%;
}
.da_dashboard_cont {
    float: left;
    width: 100%;
}	
	.da_right_board h1 p {
    float: left;
    margin-top: 20px;
    width: 100%;
}
.da_more_info_container .da_onehalf.fleft {
    float: left;
    width: 100%; min-height:100%;
}
.fix_height_tab{ height:auto !important; overflow:hidden !important}
.fix_height_tab .det{ margin:5px 0 !important;width:100%;}
.fix_height_tab .btn.btn-success.det{ width:100%;}
.fix_height_tab .fav_items_dash > li {
    float: left;
    text-align: center;
    width: 100%;
}
.fix_height_tab ul.fav_items_dash img{ float:none !important}
	}

</style>
