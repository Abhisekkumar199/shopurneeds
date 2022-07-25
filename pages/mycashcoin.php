
<script src="<?php echo $url; ?>/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo $url; ?>/js/da_js.js"></script>
<script language="javascript"> 
function showonlyonev2(thechosenone) {

  var newboxes = document.getElementsByTagName("div");
  for(var x=0; x<newboxes.length; x++) {
		name = newboxes[x].getAttribute("name");
		if (name == 'newboxes-2') {
			  if (newboxes[x].id == thechosenone) {
					if (newboxes[x].style.display == 'block') {
						  newboxes[x].style.display = 'none';
					}
					else {
						  newboxes[x].style.display = 'block';
					}
			  }else {
					newboxes[x].style.display = 'none';
			  }
		}
  }
}

function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);

} //
</script>
<div id="content"> 
    <div class="container">  <div class="da_dashboard" style="margin-top:150px;">
        <?php include("includes/left_account.php"); ?> 
            <?php
                $sql=mysqli_query($conn,"select * from `".$sufix."user_registration` where emailid='".$_SESSION['emailid']."'") ; 
                if($rows = mysqli_fetch_assoc($sql)) 
                {   
            ?>
                
                <!--left dashboard sidebar ends here--> 
                
                <!--right dashboard starts here-->
                
                <div class="da_right_board fleft">
                <h1><img src="images/fav-showroom.png"> My shopurneeds Wallet
                 
                </h1>
                <div class="da_wel_dash">
                <h3>Hello, <?php echo $rows['fname'].'&nbsp;'.$rows['lname']; ?></h3>
                Here is snapshot for wallet in your Shop Ur needs. </div>
                <div class="da_cash_coins_cont">
                <h2>My shopurneeds Wallet</h2>
                <div class="cash_left"> <span class="big_cash"><?php echo Currency; ?> <?php echo floor($rows['wallet']*$_SESSION['conratio']); ?>  </span> </div>
                <div class="cash_right"> 
                
                <!--<a href="#" class="btn btn-primary" style="
                    background: #002b4f;
                    color: #fff;
                    border: 1px solid #002b4f;
                ">Redeem my Cash Coins</a> -->
                </div>
                <div class="clear"></div>
                </div>
                
                <!--Cash Calculator-->
                
                <!--div class="da_cash_coins_cont cash_calculator">
                <h2>Cash Coin Calculator</h2>
                <div class="cash_left"> <span class="big_cash">10,000 <small>Cash Coins = 100 Rs</small> </span> </div>
                <div class="cash_right mucash_calc">
                <h4>Calculate your Cash Coins</h4>
                I have,
                <input type="text" id="cash_calc" value="">
                Cash Coins, <br>
                <br>
                means i have,
                <div id="calculated_val"></div>
                <a href="javascript:void(0);" id="cal_but"  class="btn btn-primary">Calculate my Cash</a> </div>
                <div class="clear"></div>
                </div-->
                <!--Cash Calculator--> 
                </div>
                <!--right dashboard ends here-->
                <div class="clear"></div>

            <?php } ?>
        </div>            </div>
    </div>
</div>
<style>
@media (max-width: 640px) {
    .cash_left .big_cash small{ margin-top:20px;}
    .da_cash_coins_cont h2{left: 0;
    width: 100%;color: #000;
    position: relative;
    top: 0;
    display: inline-block;
    margin: 10px 0;}
    .cash_left, .cash_right{     width: 100%;
    display: inline-block;
    margin: 20px 0 0;}
    .da_cash_coins_cont{ padding:20px 0;}
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
.fix_height_tab .det{ margin:5px 0 !important;}
.fix_height_tab .btn.btn-success.det{ width:100%;}
.fix_height_tab .fav_items_dash > li {
    float: left;
    text-align: center;
    width: 100%;
}
.fix_height_tab ul.fav_items_dash img{ float:none !important}
	}

</style>
