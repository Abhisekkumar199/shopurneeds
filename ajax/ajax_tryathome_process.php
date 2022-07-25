<link href="<?php echo URL; ?>/datepicker_css.css" />

<?php
session_start();
include("includes/configuration.php");

$city = $_REQUEST['city'];
$productidtry = $_REQUEST['productidtry'];
?>
<div class="modal-content" id="login-modal-content">
            <div class="modal-header">
                <h4 class="modal-title playfair">Try @ Home</h4>
                
            </div>
            <div class="modal-body" id="tryResponse">
                <div id="Login_divMsg" class="text-danger" style="text-align: center;"></div>
                <form method="post" id="FormTryAtHome" role="form" novalidate="">
				<input type="hidden" name="Tproductid" value="<?php echo $productidtry;?>" class="Tproductid" id="Tproductid" />
				<span class="otpResponse"></span>
                    
                    <div id="Login_divPassword" class="form-group uplabel">
                         <label class="label-txt active" for="try_city">City</label>
						<select name="city" class="form-control" id="try_city">
						<option value="Delhi" <?php if($city=='Delhi') { echo "selected"; } ?> >Delhi</option>
						<option value="Mumbai" <?php if($city=='Mumbai') { echo "selected"; } ?>>Mumbai</option>
						</select>
                       
                    </div>
                    <div id="Login_divEmail" class="form-group uplabel">
                        <label class="label-txt" for="try_date">Date</label>
                        <input name="try_Date" id="try_date"  class="form-control datepicker" maxlength="50" type="text">
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<div id="Login_divEmail" class="form-group uplabel">
                       <label class="label-txt active" for="try_time">Time</label> 
                   
						<select name="try_Time" class="form-control" id="try_time">
						<option value="">---Select Time---</option>
						<option value="12:00 PM">12:00 PM</option>
						<option value="1:00 PM">1:00 PM</option>
						<option value="2:00 PM">2:00 PM</option>
						<option value="3:00 PM">3:00 PM</option>
						<option value="4:00 PM">4:00 PM</option>
						<option value="5:00 PM">5:00 PM</option>
						<option value="6:00 PM">6:00 PM</option>
						</select>
						
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<div id="Login_divEmail" class="form-group uplabel">
                        <label class="label-txt" for="try_name">Name</label>
                        <input name="try_Name" id="try_name" class="form-control " maxlength="50" type="text">
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<div id="Login_divEmail" class="form-group uplabel">
                        <label class="label-txt" for="try_email">Email</label>
                        <input name="try_Emailid" id="try_email" class="form-control " maxlength="50" type="text">
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<div id="Login_divEmail" class="form-group uplabel">
                        <label class="label-txt" for="try_mobile">Mobile No.</label>
                        <input name="try_Mobileno" id="try_mobile" class="form-control " maxlength="50" type="text" onblur="getOTP(this.value);">
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<span class="otpHTML2"></span>
					<div id="Login_divEmail" class="form-group uplabel">
                        <label class="label-txt" for="try_address">Address</label>
                        <input name="try_Address" id="try_address" class="form-control " maxlength="50" type="text">
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<div id="Login_divEmail" class="form-group uplabel">
                        <label class="label-txt" for="try_pincode">Pincode</label>
                        <input name="try_Pincode" id="try_pincode" class="form-control " maxlength="50" type="text">
                        <div id="Login_divErrorMsg1" class="text-danger"></div>
                    </div>
					<button type="submit" id="Shipping_btnSubmit" class="btn btn-primary pull-right" onClick="return ValidateShipping();">Continue</button>
                </form>              
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
		<?php
		$checkTry = mysqli_query($conn,"select `date` from ".$sufix."tryathome where product_id='".$productidtry."' group by `date` order by `date` asc");
		if(mysqli_num_rows($checkTry)>0) { 
		while($getDate = mysqli_fetch_assoc($checkTry)) {
		$checkTry1 = mysqli_query($conn,"select `date`,`city` from ".$sufix."tryathome where product_id='".$productidtry."'  and `date`='".$getDate['date']."' order by `date` asc");
		$numdates=mysqli_num_rows($checkTry1);
		if($numdates==1)
		{	
		 $cityche=mysqli_fetch_array($checkTry1);
$cirtch=$cityche['city'];
if($cirtch!=$city)
{
		$ds=$getDate['date'];
		$ds1=explode('-',$ds);
		$ds2=$ds1[0].'-'.intval($ds1[1]).'-'.intval($ds1[2]);
		$ddds .="'".$ds2."'".', ';
		}
		}
		else
		{
		$ds=$getDate['date'];
		$ds1=explode('-',$ds);
		$ds2=$ds1[0].'-'.intval($ds1[1]).'-'.intval($ds1[2]);
		$ddds .="'".$ds2."'".', ';
		}
		
		}
		}
		
		 $dddsss=substr($ddds,0,-2);
		if($checkTry['date']!='') { 
$datet = date('Y-m-d');
		$datetime1 = new DateTime($checkTry['date']);

$datetime2 = new DateTime($datet);

$difference = $datetime1->diff($datetime2);

$days =  ($difference->d)+1;

			
		} else {
			$days = '7';
			//$days = '9';
		}
		$num = mysqli_num_rows($checkTry);
		
		?>
		<script>
		/*var dateToday = new Date(); 
		$(function () {
			$(".datepicker").datepicker({
        		dateFormat: "yy-mm-dd",
        		minDate: +<?php echo $days; ?>,
				maxDate: new Date(new Date().setMonth(new Date().getMonth() + 2)),
				
    		});
		});*/
		</script>
		
		<script>

    var unavailableDates = [<?php echo $dddsss; ?>];

    function unavailable(date) {
      //  dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
		
		dmy = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
		
        if ($.inArray(dmy, unavailableDates) == -1) {
            return [true, ""];
        } else {
            return [false, "", "Unavailable"];
        }
    }

    $(function() {
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",
			minDate: +<?php echo $days; ?>,
			maxDate: new Date(new Date().setMonth(new Date().getMonth() + 2)),
            beforeShowDay: unavailable
        });

    });


 </script>
		
		<script>
		$('#FormTryAtHome').validate({
   		 rules: {
		try_Date: {
			 required: true
		},
		try_Time: {
            required: true,
        },
        try_Name: {
            required: true,
            pattern: /^[a-zA-Z\s]+$/
        },
		try_Emailid: { 
			required: true,
            email: true
		},
		 try_Mobileno: {
            required: true,
            pattern: /^\+?[0-9][0-9\s-]{8,16}$/,
            maxlength: 10,
			minlength:10
        },
		try_OTP: {
			required: true,
			equalTo : "#checkotp"
		}, 
		try_Address: {
            required: true
        },

		try_Pincode: {
		required: true,
		}
	
       
		

    },

    messages: {
		try_Date: {
			required: "Plaese select date.",	
		},
		try_Time: {
			required: "Plaese enter time.",
		},
        try_Name: {

            required: "Plaese enter first name.",

            pattern: "Only alphabet are required."

        },

         try_Emailid: {
            required: "Plaese enter email address.",
            email: "Please enter valid email address."
        },
		try_Mobileno: {

            required: "Plaese enter mobile number.",
            pattern: "Please enter valid mobile number.",
            maxlength: "Please enter valid mobile number.",
			minlength: "Please enter valid mobile number."

        },
		try_OTP: {
			required: "Plaese enter valid OTP."
		},
       try_Address: {
	   		required: "Plaese enter address."
	   },
	   
		try_Pincode: {
			required: "Plaese enter pincode."
		}

    },

    submitHandler: function(form) {
    	var Tcity = $("#try_city").val();
		var Tdate = $("#try_date").val();
		var Ttime = $("#try_time").val();
		var Tname = $("#try_name").val();
		var Temail = $("#try_email").val();
		var Tmobile = $("#try_mobile").val();
		var Taddress = $("#try_address").val();
		var Tpincode = $("#try_pincode").val();
		var Tproductid = $("#Tproductid").val();
		$.ajax({
		 type: "POST",
		 url:  '<?php echo URL;?>/ajax_insert_tryathome.php',
		 data: {Tcity: Tcity, Tdate: Tdate, Ttime: Ttime, Tname: Tname, Temail: Temail, Tmobile: Tmobile, Taddress: Taddress, Tpincode: Tpincode, Tproductid: Tproductid},
		 success: function(response)
		 { 
			$("#tryResponse").html(response);
		 }               
	   });
    //form.submit();
  }

});

function getOTP(mobilep) {
	$.ajax({
		 type: "POST",
		 url:  '<?php echo URL;?>/ajax_mobileOTP_tryathome.php',
		 data: {mobileNo: mobilep},
		 success: function(response)
		 { 
			var jd = JSON.parse(response);
			$(".otpResponse").html(jd.checkOTP);
			$(".otpHTML2").html(jd.otpHTML);
		 }               
	   });
}

		</script>
		