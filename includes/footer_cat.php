 
  <a id="scrollup"></a>
  
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="<?php echo URL; ?>/assets/js/modernizr.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jQuery_v3.1.1.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/owl.carousel.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/popper.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jquery.magnific-popup.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jquery.firstVisitPopup.js"></script>
  <script src="<?php echo URL; ?>/assets/js/custom.js"></script>
  <script src="<?php echo URL; ?>/assets/js/jquery-ui.js"></script>
   <script>
function addtocart(productid) 
{    
    var sizecheck = $(".selectsize"+productid).val();
    var Quantity = $(".quantity"+productid).val();
    if(sizecheck == '')
    {
        $('.selectsize'+productid).css("border","1px solid red");
		$('.selectsize'+productid).focus();
		return false;
    }
    else
    {
        $('.selectsize'+productid).css("border","1px solid #ced4da");
    } 
    
    $(".cartqty"+productid).html('');
	$(".loaderdiv"+productid).show();
    $.ajax({
    	type: "POST",
    	data: { productid: productid, sizeid: sizecheck, Quantity: Quantity },
    	url: "https://localhost/project/shopurneeds/process/addtocart_new.php",
    	success: function(response){   
    	    	var jd = JSON.parse(response); 
        	    $(".loaderdiv"+productid).hide();
            	$(".cartqty"+productid).html(jd.basket);   
        	    jQuery(".showcartvalue").html(jd.cart); 
    	    
         
    		 
    	}
    });
   		
             
} 
function quantity(cartid,productid,status) 
{     
    $(".cartqty"+productid).html('');
	$(".loaderdiv"+productid).show();  
    $.ajax({
    	type: "POST",
    	data: { cartid: cartid, productid: productid, status: status },
    	url: "https://localhost/project/shopurneeds/process/ajaxquantityupdate.php",
    	success: function(response){   
    	    var jd = JSON.parse(response);   
    	    $(".loaderdiv"+productid).hide();
        	$(".cartqty"+productid).html(jd.basket);   
    	    jQuery(".showcartvalue").html(jd.cart);  
    	 
    	}
    });
   		
             
}
  </script>
  <script>
  $(function() {
    $("#slider-range").slider({
      range: true,
      min: 0,
      max: 500,
      values: [75, 300],
      slide: function(event, ui) {
        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
      " - $" + $("#slider-range").slider("values", 1));
  });
  </script>
</body>


</html>

 