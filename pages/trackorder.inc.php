
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
			  }		}
  }
}
function PopupCenter(pageURL2, title2,w2,h2) {
var left = (screen.width/2)-(w2/2);
var top = (screen.height/2)-(h2/2);
var targetWin = window.open (pageURL2, title2, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w2+', height='+h2+', top='+top+', left='+left);
} //
</script>


<link href="<?php echo $url; ?>/css/styledashboard.css" rel="stylesheet">
<div id="content"> 
    <div class="container">  <div class="da_dashboard" style="margin-top:140px;">
       <?php include("includes/left_account.php"); ?> 
            <!--left dashboard sidebar ends here--> 
            <!--right dashboard starts here-->
            <div class="da_right_board fleft">
              <h1><img src="images/fav-showroom.png"> Track Orders
                <p class="pull-right">Welcome :
                  <?php if($_SESSION['fnamenew']!='') { echo $_SESSION['fnamenew']; } else { echo "GUEST"; } ?>
                </p>
              </h1>
              <div>
                <form  method="get" action="<?php echo URL; ?>/orderdetails.php" style="margin-top:15%;">
                    <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                      <input type="text" name="oid" id="oid" class="form-control" placeholder="Enter Order ID" required>
                    </div>
                    <div class="col-lg-5">
                      <input type="submit"   class="btn btn-primary">
                    </div>
                    </div> 
                </form>
              </div>
            </div>
            <!--right dashboard ends here-->
            <div class="clear"></div>
          </div>
        </div>
    </div>
</div> 

<style>
@media (max-width: 640px) {
    .btn.btn-primary{width: 100%;
    margin: 10px 0;}
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
    width: 100%;
}
table td {
    border: 0 none !important;
}
.table-responsive{ border:0 !important}
	}
	table td {
    border: 0 none !important;
}
</style>