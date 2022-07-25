<main class="container">
  <div class="row">
    <div class="col-lg-10 grid-center ot_20 clearfix">
      <div class="row">
        <div class="col-sm-12 shoping-gridLine">
          <div class="step2 shopping_step_col active"> <span class="step_num">1</span><span>Sign In / Sign Up</span> </div>
          <div class="step1 shopping_step_col"> <span class="step_num">2</span><span>Shopping Summary</span> </div>
          <div class="step3 shopping_step_col"> <span class="step_num">3</span><span>Shipping</span> </div>
          <div class="step4 shopping_step_col"> <span class="step_num">4</span><span>Payment</span> </div>
          <div class="step5 shopping_step_col"> <span class="step_num">5</span><span>Reciept</span> </div>
        </div>
        <div class="clearfix">
          <div class="card-wrap">
            <div class="col-sm-6 shopurneeds-shippingLeft pd-70">
              <h4>Enter Billing Address</h4>
              <p>
               <input class="ui-checkbox" id="deliveryAdd" type="checkbox">
              <label for="deliveryAdd" class="active">Other Delivery Address</label>
                              </p>
              <form novalidate="novalidate">
                <div id="Shipping_divEmail" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtEmail">EMAIL ID</label>
                  <input name="Shipping_txtEmail" id="Shipping_txtEmail" class="form-control valid" maxlength="50" type="email">
                </div>
                <div id="Shipping_divFirstName" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtFirstName">FIRST NAME</label>
                  <input name="Shipping_txtFirstName" id="Shipping_txtFirstName" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divLastName" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtLastName">LAST NAME</label>
                  <input name="Shipping_txtLastName" id="Shipping_txtLastName" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divAddress" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtAddress">SHIPPING ADDRESS</label>
                  <textarea name="Shipping_txtAddress" id="Shipping_txtAddress" class="form-control" maxlength="50" type="text" rows="4"></textarea>
                </div>
                <div id="Shipping_divCity" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtCity">CITY</label>
                  <input name="Shipping_txtCity" id="Shipping_txtCity" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divState" class="form-group uplabel">
                  <label class="label-txt active" for="Shipping_txtState">STATE/REGION</label>
                  <select name="Shipping_txtState" id="Shipping_txtState" class="form-control">
                    <option value="">----Select State-----</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telengana">Telengana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                  </select>
                </div>
                <div id="Shipping_divPincode" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtPincode">CITY</label>
                  <input name="Shipping_txtPincode" id="Shipping_txtPincode" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divState" class="form-group uplabel">
                  <label class="label-txt active" for="Shipping_txtState">COUNTRY</label>
                  <select name="Shipping_txtState" id="Shipping_txtState" class="form-control">
                    <option value="">----Select Country-----</option>
                    <option value="India">India</option>
                  </select>
                </div>
                <div id="Shipping_divMobile" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtMobile">MOBILE NUMBER</label>
                  <input name="Shipping_txtMobile" id="Shipping_txtMobile" class="form-control" maxlength="10" type="text">
                </div>
                
              </form>
            </div>
            
            
             <div class="col-sm-6 shopurneeds-shippingRight pd-70">
              <h4>Enter Delivery Address</h4>
              <p>
               <input class="ui-checkbox" id="billingAdd" type="checkbox">
              <label for="billingAdd" class="active gj-20">Same as Billing Address</label>
                              </p>
                              
                <form novalidate="novalidate">
                <div id="Shipping_divState" class="form-group uplabel">
                  <label class="label-txt active" for="Shipping_txtTitle">COUNTRY</label>
                  <select name="Shipping_txtTitle" id="Shipping_txtTitle" class="form-control">
                    <option value="">----Ms.-----</option>
                    <option value="Mr." selected="selected">Mr.</option>
                        <option value="Mrs." selected="selected">Mrs.</option>
                        <option value="Ms." selected="selected">Ms.</option>
                  </select>
                </div>
                <div id="Shipping_divFirstName" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtFirstName">FIRST NAME</label>
                  <input name="Shipping_txtFirstName" id="Shipping_txtFirstName" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divLastName" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtLastName">LAST NAME</label>
                  <input name="Shipping_txtLastName" id="Shipping_txtLastName" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divAddress" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtAddress">SHIPPING ADDRESS</label>
                  <textarea name="Shipping_txtAddress" id="Shipping_txtAddress" class="form-control" maxlength="50" type="text" rows="4"></textarea>
                </div>
                <div id="Shipping_divCity" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtCity">CITY</label>
                  <input name="Shipping_txtCity" id="Shipping_txtCity" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divState" class="form-group uplabel">
                  <label class="label-txt active" for="Shipping_txtState">STATE/REGION</label>
                  <select name="Shipping_txtState" id="Shipping_txtState" class="form-control">
                    <option value="">----Select State-----</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telengana">Telengana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                  </select>
                </div>
                <div id="Shipping_divPincode" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtPincode">CITY</label>
                  <input name="Shipping_txtPincode" id="Shipping_txtPincode" class="form-control" maxlength="50" type="text">
                </div>
                <div id="Shipping_divState" class="form-group uplabel">
                  <label class="label-txt active" for="Shipping_txtState">COUNTRY</label>
                  <select name="Shipping_txtState" id="Shipping_txtState" class="form-control">
                    <option value="">----Select Country-----</option>
                    <option value="India">India</option>
                  </select>
                </div>
                <div id="Shipping_divMobile" class="form-group uplabel">
                  <label class="label-txt" for="Shipping_txtMobile">MOBILE NUMBER</label>
                  <input name="Shipping_txtMobile" id="Shipping_txtMobile" class="form-control" maxlength="10" type="text">
                </div>
                
              </form>              
                              
                              
                              </div>
            <div class="col-sm-12  pd-70"><button type="submit" id="Shipping_btnSubmit" class="btn btn-primary pull-left">Continue</button></div>
          </div>
        </div>
      </div>
      <!-- <h3 class="pagetitle"> Shopping Bag <span>0</span> <i> item </i> </h3>--> 
      <!--<div class="addtocart row">
          <div class="col-sm-12 ">
            <h4 class="emptycart">Your Shopping Cart is Empty</h4>
          </div>
          <div class="text-center hidden-xs"> <a class="btn btn-primary" href="index.html" )'>SHOP MORE</a> </div>
        </div>--> 
    </div>
  </div>
  <script>

    $('#frmCheckandApply').validate({

        rules: {

            CouponCode: {

                required: true

            },

        },

        messages: {

            CouponCode: "Apply coupon code!"

        }

    });



</script> 
  <script type="text/javascript">

    $('#formUpdateCart').validate({

        rules: {

            ProductSizeId:

            {

                required: true,

            },

            //ProductColorId: {

            //    required: true

            //},

            quantity: {

                greaterThanZero: true,

            },

        },

        messages: {

            //ProductColorId: "Choose Color",

            quantity: "Invalid quantity",

            ProductSizeId: "Please select size"

        }

    });

    jQuery.validator.addMethod("greaterThanZero", function (value, element) {

        return (parseFloat(value) > 0);

    }, "* Invalid quantity");

    

</script> 
</main>
