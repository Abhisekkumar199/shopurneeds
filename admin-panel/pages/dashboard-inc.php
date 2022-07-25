<?php 

if($_SESSION["current-date"] == '')
{
    $current_date = date("Y-m-d");
}
else
{
    $current_date = date("Y-m-d",$_SESSION["current-date"]);
}
 

$sql_today_all_order = mysqli_num_rows(mysqli_query($conn,"select sid from ".$sufix."order_seller where   orderdate='".$current_date."'"));
$sql_today_delivered = mysqli_num_rows(mysqli_query($conn,"select sid from ".$sufix."order_seller where approve_status ='Delivered' and  orderdate='".$current_date."'"));
$sql_today_cancelled = mysqli_num_rows(mysqli_query($conn,"select sid from ".$sufix."order_seller where approve_status ='Cancelled' and  orderdate='".$current_date."'"));


$sql_total_order = mysqli_num_rows(mysqli_query($conn,"select sid from ".$sufix."order_seller "));
$sql_total_delivered = mysqli_num_rows(mysqli_query($conn,"select sid from ".$sufix."order_seller where approve_status='Delivered'"));
$sql_total_cancelled = mysqli_num_rows(mysqli_query($conn,"select sid from ".$sufix."order_seller where approve_status='Cancelled'"));

$sql_total_customer = mysqli_num_rows(mysqli_query($conn,"select id from ".$sufix."user_registration ")); 
$sql_total_sku = mysqli_num_rows(mysqli_query($conn,"select id from ".$sufix."product where vartype=''")); 
$sql_wallet_amt = mysqli_fetch_assoc(mysqli_query($conn,"select sum(cashback) as total_wallet_amt from ".$sufix."user_registration")); 

$all_order_amt = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost  from ".$sufix."order_seller  where 1=1 ")); 
$all_cancelled_amt = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller where approve_status='Cancelled' "));
$all_delivered_amt = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller where approve_status='Delivered' "));

?>
<!-- ############ Content START-->
        <div id="content" class="flex">
            <!-- ############ Main START-->
            <div>
                <!--<div class="page-hero page-container" id="page-hero">
                    <div class="padding d-flex"> 
                        <div class="alert alert-info alert-dismissible fade show" role="alert" style="width: 100%;">
                            <div class="d-flex"><span class="w-40 avatar circle gd-info">G</span>
                                <div class="mx-3"><strong>Hello Super Admin!</strong> Today is <?php echo date("d-M-Y",$_SESSION["current-date"]); ?>, Time <?php echo date("H:i a",$_SESSION["current-time"]); ?>.</div>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
  
                    </div>
                </div>-->
                <div class="page-content page-container" id="page-content">
                    <div class="padding">
                        <div class="row row-sm sr">
                            <!--<div class="col-12">
                                <div class="alert bg-success mb-5 py-4" role="alert">
                                    <div class="d-flex"><i data-feather="check-circle" width="32" height="32"></i>
                                        <div class="px-3">
                                            <h5 class="alert-heading">Hello Super Admin,</h5>
                                            <p>You are using the super admin facilities of admin panel so please be sure what you delete, edit, hide and update. As your activities on admin panel may impact the business reports and operations.</p>
                                            <p></p><a href="#" class="btn text-white" data-dismiss="alert" aria-label="Close">Dismiss</a> <a href="#" class="btn btn-white mx-1">Ok <i data-feather="arrow-right"></i></a></div>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-12 col-lg-12">
                                <div class="row row-sm">
                                    <div class="col-md-8"> 
                                        <div class="row row-sm">
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Today's Orders: <strong class="text-primary"><?php echo $sql_today_all_order; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-primary" data-toggle="tooltip"   style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Today's Delivered: <strong class="text-primary"><?php echo $sql_today_delivered; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-success" data-toggle="tooltip"   style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Today's Cancelled: <strong class="text-primary"><?php echo $sql_today_cancelled; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-warning" data-toggle="tooltip" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Total Order: <strong class="text-primary"><?php echo $sql_total_order; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-success" data-toggle="tooltip"  style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Total Delivered: <strong class="text-primary"><?php echo $sql_total_delivered; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-warning" data-toggle="tooltip" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Total Cancelled: <strong class="text-primary"><?php echo $sql_total_cancelled; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-danger" data-toggle="tooltip"  style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Total SKU: <strong class="text-primary"><?php echo $sql_total_sku; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-danger" data-toggle="tooltip"  style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Total Customers: <strong class="text-primary"><?php echo $sql_total_customer; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-danger" data-toggle="tooltip"  style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="col-4 d-flex">
                                                <div class="card flex">
                                                    <div class="card-body"><small>Wallet Amount: <strong class="text-primary"><?php echo $sql_wallet_amt['total_wallet_amt']; ?></strong></small>
                                                        <div class="progress my-3 circle" style="height:6px">
                                                            <div class="progress-bar circle gd-danger" data-toggle="tooltip"  style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex">
                                        <div class="card flex">
                                            <div class="card-body text-center"><small class="text-muted"><strong>Total Sale</strong> </small>
                                                <div class="list list-row">
                                                    <div class="list-item text-left" style="padding:2px!important;" data-id="17"> 
                                                        <div><span class="badge badge-circle text-primary"></span></div>
                                                        <div class="flex"><a href="#" class="item-title text-color h-1x">Total Order Amount</a></div>
                                                        <div><span class="item-amount d-none d-sm-block text-sm text-muted"><?php echo Currency." ".$all_order_amt['totalcost']; ?></span></div>
                                                    </div>
                                                    
                                                    <div class="list-item text-left" style="padding:2px!important;" data-id="13"> 
                                                        <div><span class="badge badge-circle text-primary"></span></div>
                                                        <div class="flex"><a href="#" class="item-title text-color h-1x">Delivered Amount</a></div>
                                                        <div><span class="item-amount d-none d-sm-block text-sm text-muted"><?php echo Currency." ".$all_cancelled_amt['totalcost']; ?></span></div>
                                                    </div>
                                                    <div class="list-item text-left" style="padding:2px!important;" data-id="13"> 
                                                        <div><span class="badge badge-circle text-primary"></span></div>
                                                        <div class="flex"><a href="#" class="item-title text-color h-1x">Canclled Amount</a></div>
                                                        <div><span class="item-amount d-none d-sm-block text-sm text-muted"><?php echo Currency." ".$all_delivered_amt['totalcost']; ?></span></div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ############ Main END-->
        </div>