<div class="ps-page--single">
      
  <div class="row" style="background: #f6f6f6;">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 eco-30" style="border-right: 1px solid #ddd;">
            <form class="ps-form--subscribe-popup" action="<?php echo URL; ?>/seller-login-process.php" method="post"> 
                <div class="ps-form__content">
                    <h4>Easy <strong>Vendors </strong>Login</h4>
                    <p>Access your seller account here. </p>
                    <span id="message"></span>
                    <div class="form-group">
                        <input type="email" name="emailid" class="form-control" id="emailid" type="text" placeholder="Email-id" required="">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required=""> 
                        <div class="ps-checkbox">
                            <input class="form-control" type="checkbox" id="not-show" name="not-show">
                            <label for="not-show">Remember me</label>
                        </div> 
                        <br>
                        <button type="submit" class="ps-btn login">Login</button><br>
                        <a class="ps-b" href="#">Forgot Password</a>
                    </div>
                </div>
            </form> 
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 eco-20" style="border-right: 1px solid #ddd;">
            <form class="ps-form--subscribe-popup" action="#" method="get"> 
                <div class="ps-form__content">
                <h4>Easy <strong>Vendors </strong>forget password</h4>
                <p>Access your seller account here. </p>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Email-id" required=""> 
                  <button class="ps-btn">submit</button>
                  <a class="ps-c" href="#">Back login</a>
                 
                </div>
                           
                </div>
            </form> 
        </div>
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ">
      <div class="ps-popup__content bg--cover" data-background="img/bg/subscribe.jpg" style="background: url(img/bg/subscribe.jpg);">
          
        <form class="ps-form--subscribe-popup" action="<?php echo URL; ?>/seller-register-process.php" method="get">
            
          <div class="ps-form__content">
            <h4>Easy <strong>Vendors </strong> Signup</h4>
            <p>Register to our seller zone & grow your sales. </p>
            <?php echo $_SESSION['sessionMsg']; ?> <?php unset($_SESSION['sessionMsg']);?>
            <span id="register_message"></span>
            <div class="form-group"> 
                <input class="form-control" type="text" name="business_name" class="form-control" id="business_name" placeholder="Business Name" required="">
                <input class="form-control" type="email" name="register_email" class="form-control" id="register_email" placeholder="Email Id" required=""> 
                <input class="form-control" type="password" name="register_password" class="form-control" id="register_password" placeholder="Password" required="">  
                <button type="submit" class="ps-btn register">Signup</button>
            </div>
                        
          </div>
        </form>
      </div>
       </div>
       
</div>
      <div class="ps-section--vendor ps-vendor-about">
        <div class="container">
          <div class="ps-section__header">
            <p>WHY SELL ON MARTFURY</p>
            <h4>Join a marketplace where nearly 50 million buyers around <br> the world shop for unique items</h4>
          </div>
          <div class="ps-section__content">
            <div class="row">
                          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-block--icon-box-2">
                              <div class="ps-block__thumbnail"><img src="asset/img/icons/vendor-1.png" alt=""></div>
                              <div class="ps-block__content">
                                <h4>Low Fees</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                  <p>It doesn’t take much to list your items and once you make a sale, Martfury’s transaction fee is just 2.5%.</p>
                                </div><a href="#">Learn more</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-block--icon-box-2">
                              <div class="ps-block__thumbnail"><img src="asset/img/icons/vendor-2.png" alt=""></div>
                              <div class="ps-block__content">
                                <h4>Powerful Tools</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                  <p>Our tools and services make it easy to manage, promote and grow your business.</p>
                                </div><a href="#">Learn more</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <div class="ps-block--icon-box-2">
                              <div class="ps-block__thumbnail"><img src="asset/img/icons/vendor-3.png" alt=""></div>
                              <div class="ps-block__content">
                                <h4>Support 24/7</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                  <p>Our tools and services make it easy to manage, promote and grow your business.</p>
                                </div><a href="#">Learn more</a>
                              </div>
                            </div>
                          </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-section--vendor ps-vendor-milestone">
        <div class="container">
          <div class="ps-section__header">
            <p>How it works</p>
            <h4>Easy to start selling online on Martfury just 4 simple steps</h4>
          </div>
          <div class="ps-section__content">
            <div class="ps-block--vendor-milestone">
              <div class="ps-block__left">
                <h4>Register and list your products</h4>
                <ul>
                  <li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>
                  <li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>
                </ul>
              </div>
              <div class="ps-block__right"><img src="asset/img/vendor/milestone-1.png" alt=""></div>
              <div class="ps-block__number"><span>1</span></div>
            </div>
            <div class="ps-block--vendor-milestone reverse">
              <div class="ps-block__left">
                <h4>Receive orders and sell your product</h4>
                <ul>
                  <li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>
                  <li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>
                </ul>
              </div>
              <div class="ps-block__right"><img src="asset/img/vendor/milestone-2.png" alt=""></div>
              <div class="ps-block__number"><span>2</span></div>
            </div>
            <div class="ps-block--vendor-milestone">
              <div class="ps-block__left">
                <h4>Package and ship with ease</h4>
                <ul>
                  <li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>
                  <li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>
                </ul>
              </div>
              <div class="ps-block__right"><img src="asset/img/vendor/milestone-3.png" alt=""></div>
              <div class="ps-block__number"><span>3</span></div>
            </div>
            <div class="ps-block--vendor-milestone reverse">
              <div class="ps-block__left">
                <h4>Package and ship with ease</h4>
                <ul>
                  <li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>
                  <li>Our Martfury Advisors will help you at every step and fully assist you in taking your business online</li>
                </ul>
              </div>
              <div class="ps-block__right"><img src="asset/img/vendor/milestone-4.png" alt=""></div>
              <div class="ps-block__number"><span>4</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-section--vendor ps-vendor-best-fees">
        <div class="container">
          <div class="ps-section__header">
            <p>BEST FEES TO START</p>
            <h4>Affordable, transparent, and secure</h4>
          </div>
          <div class="ps-section__content">
            <h5>It doesn’t cost a thing to list up to 50 items a month, and you only pay after your stuff sells. It’s just a small percent of the money you earn</h5>
            <div class="ps-section__numbers">
              <figure>
                <h3>$0</h3><span>List Fee</span>
              </figure>
              <figure>
                <h3>5%</h3><span>Final Value Fee</span>
              </figure>
            </div>
            <div class="ps-section__desc">
              <figure>
                <figcaption>Here's what you get for your fee:</figcaption>
                <ul>
                  <li>A worldwide community of more than 160 million shoppers.</li>
                  <li>Shipping labels you can print at home, with big discounts on postage.</li>
                  <li>Seller protection and customer support to help you sell your stuff.</li>
                </ul>
              </figure>
            </div>
            <div class="ps-section__highlight"><img src="asset/img/icons/vendor-4.png" alt="">
              <figure>
                <p>We process payments with PayPal, an external payments platform that allows you to process transactions with a variety of payment methods. Funds from PayPal sales on Martfury will be deposited into your PayPal account.</p>
              </figure>
            </div>
            <div class="ps-section__footer">
              <p>Listing fees are billed for 0.20 USD, so if your bank’s currency is not USD, the amount in your currency may vary based on changes in the exchange rate.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-section--vendor ps-vendor-testimonials">
        <div class="container">
          <div class="ps-section__header">
            <p>SELLER STORIES</p>
            <h4>See Seller share about their successful on Martfury</h4>
          </div>
          <div class="ps-section__content">
            <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="2" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="2" data-owl-duration="1000" data-owl-mousedrag="on">
              <div class="ps-block--testimonial">
                <div class="ps-block__header"><img src="asset/img/users/1.jpg" alt=""></div>
                <div class="ps-block__content"><i class="icon-quote-close"></i>
                  <h4>Kanye West<span>Head Chef at BBQ Restaurant</span></h4>
                  <p>Sed elit quam, iaculis sed semper sit amet udin vitae nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima olatiup.</p>
                </div>
              </div>
              <div class="ps-block--testimonial">
                <div class="ps-block__header"><img src="asset/img/users/2.png" alt=""></div>
                <div class="ps-block__content"><i class="icon-quote-close"></i>
                  <h4>Anabella Kleva<span>Boss at TocoToco</span></h4>
                  <p>Sed elit quam, iaculis sed semper sit amet udin vitae nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima olatiup.</p>
                </div>
              </div>
              <div class="ps-block--testimonial">
                <div class="ps-block__header"><img src="asset/img/users/3.jpg" alt=""></div>
                <div class="ps-block__content"><i class="icon-quote-close"></i>
                  <h4>William Roles<span>Head Chef at BBQ Restaurant</span></h4>
                  <p>Sed elit quam, iaculis sed semper sit amet udin vitae nibh. at magna akal semperFusce commodo molestie luctus.Lorem ipsum Dolor tusima olatiup.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ps-section--vendor ps-vendor-faqs">
        <div class="container">
          <div class="ps-section__header">
            <p>FREQUENTLY ASKED QUESTIONS</p>
            <h4>Here are some common questions about selling on Martfury</h4>
          </div>
          <div class="ps-section__content">
            <div class="row">
                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <figure>
                              <figcaption>How do fees work on Martfury?</figcaption>
                              <p>Joining and starting a shop on Martfury is free. There are three basic selling fees: a listing fee, a transaction fee, and a payment processing fee.</p>
                              <p>It costs USD 0.20 to publish a listing to the marketplace. A listing lasts for four months or until the item is sold. Once an item sells, there is a 3.5% transaction fee on the sale price (not including shipping costs). If you accept payments with PayPal, there is also a payment processing fee based on their fee structure.</p>
                              <p>Listing fees are billed for $0.20 USD, so if your bank’s currency is not USD, the amount may differ based on changes in the exchange rate.</p>
                            </figure>
                            <figure>
                              <figcaption>What do I need to do to create a shop?</figcaption>
                              <p>It’s easy to set up a shop on Martfury. Create an Martfury account (if you don’t already have one), set your shop location and currency, choose a shop name, create a listing, set a payment method (how you want to be paid), and finally set a billing method (how you want to pay your Martfuryfees).</p>
                            </figure>
                          </div>
                          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <figure>
                              <figcaption>How do I get paid?</figcaption>
                              <p>If you accept payments with PayPal, funds from PayPal sales on Martfury will be deposited into your PayPal account. We encourage sellers to use a PayPal Business account and not a Personal account, as personal accounts are subject to monthly receiving limits and cannot accept payments from buyers that are funded by a credit card.</p>
                              <p>It costs USD 0.20 to publish a listing to the marketplace. A listing lasts for four months or until the item is sold. Once an item sells, there is a 3.5% transaction fee on the sale price (not including shipping costs). If you accept payments with PayPal, there is also a payment processing fee based on their fee structure.</p>
                              <p>Listing fees are billed for $0.20 USD, so if your bank’s currency is not USD, the amount may differ based on changes in the exchange rate.</p>
                            </figure>
                            <figure>
                              <figcaption>Do I need a credit or debit card to create a shop?</figcaption>
                              <p>No, a credit or debit card is not required to create a shop. To be verified as a seller you have the choice to use either a credit card or to register via PayPal. You will not incur any charges until you open your shop and publish your listings.</p>
                            </figure>
                            <figure>
                              <figcaption>What can I sell on Martfury?</figcaption>
                            </figure>
                            <p>Martfury provides a marketplace for crafters, artists and collectors to sell their handmade creations, vintage goods (at least 20 years old), and both handmade and non-handmade crafting supplies.</p>
                          </div>
            </div>
          </div>
          <div class="ps-section__footer">
            <p>Still have more questions? Feel free to contact us.</p><a class="ps-btn" href="#">Contact Us</a>
          </div>
        </div>
      </div>
      <div class="ps-vendor-banner bg--cover" data-background="asset/img/bg/vendor.jpg">
        <div class="container">
          <h2>It's time to start making money.</h2><a class="ps-btn ps-btn--lg" href="#">Start Selling</a>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('.login').click(function(){ 
    	var emailid = $('#emailid').val();   
    	var password = $('#password').val(); 
    	if(emailid == '')
    	{  
    		$('#emailid').css("border","1px solid red");
    		$('#emailid').focus();
    		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter email id</div>");
    		return false;
    	}
    	else
    	{ 
    		$('#emailid').css("border","1px solid #bdb9b9"); 
    	} 
        
        
        if(password == '')
    	{  
    		$('#password').css("border","1px solid red");
    		$('#password').focus(); 
    		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter password</div>");
    		return false;
    	}
    	else
    	{ 
    		$('#password').css("border","1px solid #bdb9b9"); 
            $('#message').html("");
    	}  
        
    }); 
        $('.register').click(function(){ 
    	var business_name = $('#business_name').val();   
    	var register_email = $('#register_email').val();   
    	var register_password = $('#register_password').val(); 
    	if(business_name == '')
    	{  
    		$('#business_name').css("border","1px solid red");
    		$('#business_name').focus();
    		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter business name</div>");
    		return false;
    	}
    	else
    	{ 
    		$('#business_name').css("border","1px solid #bdb9b9"); 
    	} 
        
        
        if(register_email == '')
    	{  
    		$('#register_email').css("border","1px solid red");
    		$('#register_email').focus(); 
    		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter email id</div>");
    		return false;
    	}
    	else
    	{ 
    		$('#register_email').css("border","1px solid #bdb9b9"); 
            $('#register_message').html("");
    	}  
    	
    	if(register_password == '')
    	{  
    		$('#register_password').css("border","1px solid red");
    		$('#register_password').focus(); 
    		$('#register_message').html("<div class='alert alert-danger' role='alert'>Please enter password</div>");
    		return false;
    	}
    	else
    	{ 
    		$('#register_password').css("border","1px solid #bdb9b9"); 
            $('#register_message').html("");
    	} 
        
    }); 
    </script> 