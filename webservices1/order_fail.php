<?php session_start();
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
$sql2=mysql_query("select * from shopurneeds_order where oid ='".$_SESSION['oidapi']."'");
$roworder=mysql_fetch_array($sql2);
?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 thankyou_page">
      
      <div class="clearfix"></div>
      <h2>Transaction Failed</h2></h2>
      <div class="clearfix"></div>
  <div class="col-sm-3"></div>  <div class="col-sm-6">  <hr /></div>
        <div class="clearfix"></div>
      
        <div class="clearfix"></div>
       <div class="col-sm-3"></div>  <div class="col-sm-6">  <hr /></div>
        <div class="clearfix"></div>
      
            <div class="col-sm-4"></div>
      <div class="order_detail col-sm-6">
      
      <span>Order Number</span><span><?php echo $_SESSION['oidapi']; ?></span>
       <span>Shipping Charges</span><span>Rs. <?php echo $roworder['shipcharge'];?></span>
       <span>Total</span><span>Rs. <?php echo $roworder['totalcost']; ?></span>
      </div>
      </div>
      
    </div>
  
  </div>
</div>
<style>
.thankyou_page img {
    text-align: center;
    width: 20%;
    float: none;
    margin: 0 auto;
}

.thankyou_page{ padding:100px 0}
.thankyou_page h2 .fa{color: #00a249;
font-size: 26px;}
.thankyou_page h2 {
    width: 100%;
    float: left;
    text-align: center;
    font-size: 25px; margin:10px 0
}

.thankyou_page hr{border-top: 1px solid #e1d7d7 !important;}
.thankyou_page p {
    width: 100%;
    float: left;
    text-align: center;
    font-size: 14px; margin-bottom:30px;}
.order_detail span{ float:left; width:50%; line-height:25px;}
</style>
<?php
	 unset($_SESSION['oidapi']);	

?>