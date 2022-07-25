
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
    <div class="container">  <div class="da_dashboard" style="margin-top: 152px;"> 
       <?php include("includes/left_account.php"); ?>
        
        <!--right dashboard starts here-->
        <div class="da_right_board fleft">
          <h1><img src="images/fav-showroom.png"> My Orders
            <p class="pull-right">Welcome :
              <?php if($_SESSION['fnamenew']!='') { echo $_SESSION['fnamenew']; } else { echo "GUEST"; } ?>
            </p>
          </h1>
          <?php echo session_msg(); ?>
          <?php
    	include_once('includes/classes/paging.inc.php');
    
    					include("admin/pagingconfig.php");
    ?>
          <div class="table-responsive">
            <?php
            $oid = $_REQUEST['oid'];
            $sellerorder = mysqli_query($conn,"select *from ".$sufix."order_seller where oid='".$oid."'");
            if(mysqli_num_rows($sellerorder)>0) { 
            ?>
            <table class="table">
              <thead>
                <tr>
                  <th width="95">Order Id</th>
                  <th width="150">Product Image</th>
                  <th width="230">Product Name</th>
                  <th width="37">Qty </th>
                  <th width="134">Unit Price</th>
                  <th width="134">Total Price</th> 
                  <th width="134">Status</th> 
                </tr>
              </thead>
              <tbody>
                <?php
                $x = 1;
                $sql_order=mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."order`  where oid ='".$oid."'"));
                while($sellerorderrows = mysqli_fetch_assoc($sellerorder)) 
                { 
                    $selectbasket = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."basket where oid_seller='".$sellerorderrows['id']."'"));
                ?>
                <tr>
                    <td style="font-size:13px;"><?php echo $sellerorderrows['oid']."-".$x;?></td>
                    <td>
                        <?php if($selectbasket['productimage']) { ?>
                        <img src="../uploads/productimage/thumb/<?php echo $selectbasket['productimage']; ?>"  height="60"/>
                        <?php } else { ?>
                        <img src="../images/default.png" width="60" height="60" />
                        <?php } ?>
                    </td>
                    <td style="font-size:13px;"><a href="<?php echo URL;?>/<?php echo $selectbasket['slug'];?>"><?php echo substr(ucwords(strtolower($selectbasket['productname'])), 0, 45);  ?> </a><br />
                   
                      
                    </td>
    				  <td  style="font-size:13px;"><?php echo $selectbasket['quantity'];?></td>
                  <td  style="font-size:13px;"><?php echo Currency; ?><?php echo $selectbasket['sellingprice'];?></td>
                  
                  <td  style="font-size:13px;"><?php echo Currency; ?><?php echo $selectbasket['subtotal'];?></td>
                  <td ><b><?php echo  $sql_order['approve_status']; ?></b> 
                     </td> 
                </tr>
                <?php $x++; } ?>
              </tbody>
            </table>
            <?php } ?>
          </div>
          <div> </div>
        </div>
        <!--right dashboard ends here-->
        <div class="clear"></div>
        </div>
    </div>
    
</div>

<style>

.btn-primary {
    color: #fff !important;
    background-color: #002b4f !important;
    border-color: #001d36 !important;
}
@media (max-width: 640px) {
    .table{    width: 800px;}
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
.table-responsive{ border:0 !important}
	}
</style>
