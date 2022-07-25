<link href="https://localhost/project/shopurneeds/datepicker_css.css" />
<?php
session_start();
include("includes/configuration.php");

$city = $_REQUEST['city'];
$email = $_REQUEST['email'];
$tdate = $_REQUEST['tdate'];
$pid = $_REQUEST['pid'];
$checkTry = mysqli_query($conn,"select * from ".$sufix."tryathome where product_id='".$pid."' and `date`='".$tdate."'");
$rowtry=mysqli_fetch_array($checkTry);
$numros=mysqli_num_rows($checkTry);
if($numros==0)
{
$tryid=$_REQUEST['pid'].rand(1000,99999);
$ins = mysqli_query($conn,"INSERT INTO ".$sufix."tryathome (`product_id`,`try_id`,`city`,`date`,`emailid`,`adddate`) values ('".$pid."','".$tryid."' ,'".$city."','".$tdate."','".$email."',NOW())");
$_SESSION['TryCity']=$city;
$_SESSION['TryDate']=$tdate;
$_SESSION['Tryemail']=$email;
$_SESSION['TryID']=$tryid;
?>
<div class="" style="color:#006600;">Product Successfully added on <?php echo $tdate; ?> for TRY @ HOME, You may add upto 6 products. Thank You!
<div class="clearfix"></div>
<input type="button" value="Add More Product" onclick="location.href='https://localhost/project/shopurneeds/shopurneeds-collection';" class="btn btn-primary pull-left">
<input type="button" value="Confirm Try @ Home" onclick="location.href='https://localhost/project/shopurneeds/tryathomedetails';"  class="btn btn-primary pull-right">
</div>

<?php
}
else if($numros==1)
{
if($rowtry['city']==$city)
{
$tryid=$_REQUEST['pid'].rand(1000,99999);
$ins = mysqli_query($conn,"INSERT INTO ".$sufix."tryathome (`product_id`,`try_id`,`city`,`date`,`emailid`,`adddate`) values ('".$pid."','".$tryid."' ,'".$city."','".$tdate."','".$email."',NOW())");
$_SESSION['TryCity']=$city;
$_SESSION['TryDate']=$tdate;
$_SESSION['Tryemail']=$email;
$_SESSION['TryID']=$tryid;

?>
<div class="" style="color:#006600;">Product Successfully added on <?php echo $tdate; ?> for TRY @ HOME, You may add upto 6 products. Thank You!
<div class="clearfix"></div>
<input type="button" value="Add More Product" onclick="location.href='https://localhost/project/shopurneeds/shopurneeds-collection';" class="btn btn-primary pull-left">
<input type="button" value="Confirm Try @ Home" onclick="location.href='https://localhost/project/shopurneeds/tryathomedetails';"  class="btn btn-primary pull-right">

</div>
<?php
}
else
{
?>
<div class="" style="color:#FF0000;">We do not have this product on <?php echo $tdate; ?> for TRY @ HOME</div>
<form method="post" id="Login-Form" role="form" novalidate="" >
            <input type="hidden" name="hiddenproductidtry" value="<?php echo $pid; ?>" class="hiddenproductidtry" />
            <div id="Login_divPassword" class="form-group uplabel">
			              

              <select name="city" class="form-control citytryathome" id="Login_txtPassword" required>
                <option value="">---Select City---</option>
                <option value="Delhi" <?php if($city=="Delhi") { echo "selected"; } ?>>Delhi</option>
                <option value="Mumbai" <?php if($city=="Mumbai") { echo "selected"; } ?>>Mumbai</option>
              </select>
              <div id="Login_divErrorMsg2" class="text-danger"></div>
            </div>
			<div id="Login_divPassword" class="form-group uplabel">
              <input type="email" name="emailid" id="Login_Email" value="<?php echo $email; ?>" placeholder="Email ID" class="form-control Login_Email" required />
              <div id="Login_divErrorMsg2" class="text-danger"></div>
            </div>
			<div id="Login_divPassword" class="form-group uplabel">
              <input type="text" name="calendar" id="Login_Calendar" autocomplete="off" value="<?php echo $tdate; ?>" placeholder="Booking Date" class="form-control datepicker Login_Calendar" required />
              <div id="Login_divErrorMsg2" class="text-danger"></div>
            </div>
			<button type="button" id="Shipping_btnSubmit2" class="btn btn-primary pull-right">Continue</button>
          </form>
<?php
}
}
else
{

?>
<div class="" style="color:#FF0000;">We do not have this product on <?php echo $tdate; ?> for TRY @ HOME</div>
<form method="post" id="Login-Form" role="form" novalidate="">
            <input type="hidden" name="hiddenproductidtry" value="<?php echo $pid; ?>" class="hiddenproductidtry" />
            <div id="Login_divPassword" class="form-group uplabel">
			              

              <select name="city" class="form-control citytryathome" id="Login_txtPassword" required>
                <option value="">---Select City---</option>
                <option value="Delhi" <?php if($city=="Delhi") { echo "selected"; } ?>>Delhi</option>
                <option value="Mumbai" <?php if($city=="Mumbai") { echo "selected"; } ?>>Mumbai</option>
              </select>
              <div id="Login_divErrorMsg2" class="text-danger"></div>
            </div>
			<div id="Login_divPassword" class="form-group uplabel">
              <input type="email" name="emailid" id="Login_Email" value="<?php echo $email; ?>" placeholder="Email ID" class="form-control Login_Email" required />
              <div id="Login_divErrorMsg2" class="text-danger"></div>
            </div>
			<div id="Login_divPassword" class="form-group uplabel"> 
              <input type="text" name="calendar" id="Login_Calendar" autocomplete="off" value="<?php echo $tdate; ?>" placeholder="Booking Date" class="form-control datepicker Login_Calendar" required />
              <div id="Login_divErrorMsg2" class="text-danger"></div>
            </div>
			<button type="button" id="Shipping_btnSubmit2" class="btn btn-primary pull-right">Continue</button>
          </form>
		  
		  
		  <?php } ?>
		  <script>
		  $(function() {
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
			minDate: +2,
        });

    });
		  </script>