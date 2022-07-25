    <!-- =====  FOOTER START  ===== -->
    <div class="footer section pt-40"  style="    background-color: #f2f2f2;">
      <div class="container">
        <div class="row">
            <?php
            $sql=mysqli_query($conn,"select * from ".$sufix."top_navigation where menuposition='Footer' and displayflag='1' order by sortid asc limit 2") ;
            while($rownav2=mysqli_fetch_array($sql))
            {
            ?>
                <div class="col-lg-3 footer-block">
                    <h4 class="footer-title py-2"><?php echo $rownav2['itemname']; ?></h4>
                    <ul>
                        <?php 
                        $sql2=mysqli_query($conn,"select * from `".$sufix."top_navigation` where parent='".$rownav2['id']."' and displayflag='1' order by sortid asc") ;	
                        $num2=mysqli_num_rows($sql2); 
                        if($num2 > 0)
                        {  
                        while($rowsub=mysqli_fetch_assoc($sql2))
                        {    
							if($rowsub['pageid']!='0')
							{ 
							$query2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."static_pages` where id='".$rowsub['pageid']."'   ")) ;
                        ?>
							<li><a href="<?php echo URL; ?>/<?php echo $query2['link_name']; ?>"> <?php echo $rowsub['itemname']; ?></a></li>
						<?php } } }  ?>  
                    </ul> 
                </div> 
            <?php } ?> 
            <div class="col-lg-3 footer-block">
                <h4 class="footer-title py-2">Contacts</h4>
                <ul>
                    <!--<li class="add">PLOT NO: 98 , NASIRPUR EXT, DWARKA, NEW DELHI SOUTH WEST DELHI, DELHI.110045</li> -->
                    <li class="email">INFO@SHOPURNEEDS.COM</li>
                </ul>
            </div>
        </div>
        <!-- =====  Newslatter ===== -->
        <div class="newsletters mt-30">
          <div class="news-head pull-left">
            <h2>Subscribe for our offer</h2>
          </div>
          <div class="news-form pull-right">
            <form  >
              <div class="form-group required">
                <input name="email" id="email" placeholder="Enter Your Email" class="form-control input-lg newsletter_email" required="" type="email">
                <button type="button" onClick="frmNewsLetter();" class="btn btn-default btn-lg">Subscribe</button>
                <div class="newsletter_message"></div> 
              </div>
              
            </form>
          </div>
          
        </div>
        <!-- =====  Newslatter End ===== -->
      </div>

      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-4 mt-20">
              <div class="section_title">payment option </div>
              <div class="payment-icon text-center">
                <img src="assets/image/Payment options.png" style="width:70%"></img>
              </div>
            </div>

            <div class="col-12 col-lg-4 mt-20">
              <div class="section_title">download app</div>
              <div class="app-download text-center">
                <ul class="app-icon">
                  <li><a href="https://play.google.com/store/apps/details?id=com.shopurneeds" title="playstore" target="_blank"><img src="<?php echo URL; ?>/assets/images/play-store.png" alt="playstore" class="img-responsive"></a></li>
                  <li><a href="https://apps.apple.com/in/app/shopurneeds/id1531651217" title="appstore" target="_blank"><img src="<?php echo URL; ?>/assets/images/app-store.png" alt="appstore" class="img-responsive"></a></li>
                </ul>
              </div>
            </div>
            <div class="col-12 col-lg-3 mt-20">
              <div class="section_title">Social media</div>
              <div class="social_icon text-center">
                <ul>
                  <li><a href="https://www.facebook.com/Shopurneeds-111791240588054/" target="_blank"><img src="assets/image/Facebook.png"></a></li>
                  <li><a href="https://instagram.com/shopurneedsindia?igshid=z69sb7bbaip6" target="_blank"><img src="assets/image/Instagram.png"></a></li> 
                  <li><a href="https://twitter.com/shopurneeds?s=09" target="_blank"><img src="assets/image/Twitter.png"></a></li> 
                </ul>
              </div>
            </div>
            <div class="col-12 col-lg-1 mt-20 text-center">
                <img src="assets/image/btn_swan_img.jpg" class="swam_img" style="width:100%">
            </div>
            <div class="col-12 ">
              <div class="copyright-part text-center pt-10 pb-10 mt-30">Copyright@2020 Shop Ur Needs </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- =====  FOOTER END  ===== -->
  </div>
  <a id="scrollup"></a>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="<?php echo URL; ?>/assets/js/modernizr.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jQuery_v3.1.1.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/owl.carousel.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/popper.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jquery.magnific-popup.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jquery.firstVisitPopup.js"></script>
  <script src="<?php echo URL; ?>/assets/js/custom.js"></script>
<script>
function addtocart(productid) 
{    
    var sizecheck = $(".selectsize"+productid).val();
    var Quantity = $(".quantity"+productid).val();
    if(sizecheck == '')
    {
        $('.selectsize'+productid).css("border","1px solid red");
		$('.selectsize'+productid).focus();
		return false;
    }
    else
    {
        $('.selectsize'+productid).css("border","1px solid #ced4da");
    }  
    $(".cartqty"+productid).html('');
	$(".loaderdiv"+productid).show();
    $.ajax({
    	type: "POST",
    	data: { productid: productid, sizeid: sizecheck, Quantity: Quantity },
    	url: "https://localhost/project/shopurneeds/process/addtocart_new.php",
    	success: function(response){  
	    	var jd = JSON.parse(response); 
    	    $(".loaderdiv"+productid).hide();
        	$(".cartqty"+productid).html(jd.basket);   
    	    jQuery(".showcartvalue").html(jd.cart);  
    	}
    });
   		
             
} 
function quantity(cartid,productid,status) 
{     
    $(".cartqty"+productid).html('');
	$(".loaderdiv"+productid).show();  
    $.ajax({
    	type: "POST",
    	data: { cartid: cartid, productid: productid, status: status },
    	url: "https://localhost/project/shopurneeds/process/ajaxquantityupdate.php",
    	success: function(response){   
    	    var jd = JSON.parse(response);   
    	    $(".loaderdiv"+productid).hide();
        	$(".cartqty"+productid).html(jd.basket);   
    	    jQuery(".showcartvalue").html(jd.cart);  
    	 
    	}
    });   
}
function frmNewsLetter() 
{  
    var strEmail = $(".newsletter_email").val().trim();  
    if(strEmail == '')
    {
        $(".newsletter_message").html("<font color='red' style='float: left;'>Please enter Email Id!</font>");
        return false
    } 
     
	$.ajax({  
	type: 'POST',  
	url: 'https://shopurneeds.com/ajax/ajax_inc_newsletter.php', 
	data: { strEmail: strEmail},
	success: function(Message) { 
		$(".newsletter_email").val(''); 
    	$(".newsletter_message").html(Message);
	}
	});
} 
</script>
</body>


</html>

 