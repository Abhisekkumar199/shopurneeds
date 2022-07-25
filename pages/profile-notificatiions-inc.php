<div class="profilebar shadow mt-2 border-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="balance-area">
                        <a href="recharge-summary.html#">
                            <div class="header-pro-thumb">
                                <img class="rounded-circle" src="recharge/images/profile.jpg" alt="">
                            </div> 
                            <span class="pl-4 pt-1"><b>Jhone Due</b></span>
                        </a>
                    

                    </div>
                </div>
                <div class="col">
                    <div class="local-time">
                        <p><b>Local Time:</b> 12:00PM</p>
                    </div>
                </div>
                <div class="col">
                    <div class="local-time">
                        <p><b>Last Visit:</b>1/12/2020 - 12:00PM</p>
                    </div>
                </div>
                <div class="col notify-col text-right">
                    <div class="notify-btn"><a href="profile-notifications.html"><i class="far fa-bell"></i></a></div>
                </div>
            </div>
        </div>
    </div>
 <div id="content" class="py-4">
            <div class="container">
                <div class="row">

                    <!-- Left sidebar -->
                    <aside class="col-lg-3 sidebar">
                        <div class="widget admin-widget p-0">
                            <div class="Profile-menu">
                                <ul class="nav secondary-nav">
                                   <?php echo include("left_account.php");  ?>
                                </ul>
                            </div>
                        </div>

                        <div class="widget admin-widget">
                            <i class="fas fa-coins admin-overlay-icon"></i>
                            <h2>Earn $25</h2>
                            <p>Have questions or concerns regrading</p>
                            <a href="profile-notifications.html#" class="btn btn-default btn-center"><span>Refer A friend</span></a>
                        </div>

                        <div class="widget admin-widget">
                            <i class="fas fa-comments admin-overlay-icon"></i>
                            <h2>Need Help?</h2>
                            <p>Have questions or concerns regrading your account?<br>
                                Our experts are here to help!.</p>
                            <a href="profile-notifications.html#" class="btn btn-default btn-center"><span>Start Chat</span></a>
                        </div>

                    </aside>
                    <!-- Left Panel End -->

                    <div class="col-lg-9">
                        <h3 class="admin-heading">Notifications Setting</h3>
                        <div class="notifications-area">
                            <!-- Notifications  -->
                            <div class="content-area">
                                <p class="text-muted">Select subscriptions to be delivered to <span class="text-body">demo@company.com</span></p>
                                <form id="notifications-box" method="post">

                                    <div class="noti-items bg-offwhite">
                                        <div class="row">
                                            <div class="col"><span class="">Notifications</span></div>
                                            <div class="col">Email</div>
                                            <div class="col">Push</div>
                                        </div>
                                    </div>

                                    <div class="noti-items">
                                        <div class="row">
                                            <div class="col">
                                                <p class="text-muted">Be the first to know about new features and other news.</p>
                                                <p class="text-muted">Mobile Recharge .</p>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="mobile-email" name="notifications" class="custom-control-input" type="checkbox" checked="">
                                                    <label class="custom-control-label" for="mobile-email"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="mobile-push" name="notifications" class="custom-control-input" type="checkbox">
                                                    <label class="custom-control-label" for="mobile-push"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="noti-items">
                                        <div class="row">
                                            <div class="col">
                                                <p class="text-muted">Send me an email when our bill payment successfully.</p>
                                                <p class="text-muted">Bill Payment</p>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="bill-pay-email" name="notifications" class="custom-control-input" type="checkbox">
                                                    <label class="custom-control-label" for="bill-pay-email"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="bill-pay-push" name="notifications" class="custom-control-input" type="checkbox" checked="">
                                                    <label class="custom-control-label" for="bill-pay-push"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="noti-items">
                                        <div class="row">
                                            <div class="col">
                                                <p class="text-muted">Send me an email when have a problem with a payment.</p>
                                                <p class="text-muted">Have a problem with a payment</p>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="bill-paypro-email" name="notifications" class="custom-control-input" type="checkbox" checked="">
                                                    <label class="custom-control-label" for="bill-paypro-email"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="bill-paypro-push" name="notifications" class="custom-control-input" type="checkbox">
                                                    <label class="custom-control-label" for="bill-paypro-push"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="noti-items">
                                        <div class="row">
                                            <div class="col">
                                                <p class="text-muted">Receive last-minute offers from us.</p>
                                                <p class="text-muted">Special Offers </p>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="special-offer-email" name="notifications" class="custom-control-input" type="checkbox">
                                                    <label class="custom-control-label" for="special-offer-email"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="special-offer-push" name="notifications" class="custom-control-input" type="checkbox" checked="">
                                                    <label class="custom-control-label" for="special-offer-push"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="noti-items">
                                        <div class="row">
                                            <div class="col">
                                                <p class="text-muted">Share your payment experience to better inform users.</p>
                                                <p class="text-muted">Review Surveys</p>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="review-email" name="notifications" class="custom-control-input" type="checkbox" checked="">
                                                    <label class="custom-control-label" for="review-email"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="review-push" name="notifications" class="custom-control-input" type="checkbox">
                                                    <label class="custom-control-label" for="review-push"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="noti-items">
                                        <div class="row">
                                            <div class="col">
                                                <p class="text-muted">When you're chnage the Password</p>
                                                <p class="text-muted">Password change</p>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="pass-chnage-email" name="notifications" class="custom-control-input" type="checkbox">
                                                    <label class="custom-control-label" for="pass-chnage-email"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check custom-control custom-checkbox">
                                                    <input id="pass-chnage-push" name="notifications" class="custom-control-input" type="checkbox" checked="">
                                                    <label class="custom-control-label" for="pass-chnage-push"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                  

                                    <button class="btn btn-default btn-center mt-4" type="submit">
                                        <span class="bh"></span>
                                        <span>Save Changes</span>
                                    </button>
                                </form>
                            </div>
                            <!-- Notifications End -->

                        </div>
                    </div>
                </div>

            </div>
        </div>