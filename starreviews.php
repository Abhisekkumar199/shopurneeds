<!DOCTYPE HTML>

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    
    <title></title>
    
    <meta name="viewport" content="width=device-width">	
    
    <!-- starReviews stylesheet -->
    <link href="https://localhost/project/shopurneeds/starreviews/assets/css/starReviews.css" rel="stylesheet" type="text/css"/>
    
    <!-- CSS below is for example purpose only -->
    <style>
        body {margin:0 !important; background:url("img/geometry.png");} /* Background color for body is only used in the example */
  .review_iframe iframe body{ margin:0 !important;}
        .product-example {
            background:#49C4A5;
            margin-top:-15px;
        }

        .product-example h1 {
            text-align:center;
            padding:50px;
            color:#1E7D65;
            font-size:15pt;
            font-family:Tahoma;
        }

        .rating-example {  
            background:#fff; 
            max-width:600px;
            margin:0 auto; 
            padding:15px; 
            -webkit-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.3);
            -moz-box-shadow:    0px 0px 15px 0px rgba(50, 50, 50, 0.3);
            box-shadow:         0px 0px 15px 0px rgba(50, 50, 50, 0.3); 
            -webkit-border-radius: 3px; 
            -moz-border-radius: 3px; 
            border-radius: 3px;     height: 600px;
    overflow-y: scroll;
        }
		
    </style>
</head>

<body>

<div class="rating-example">

 

  <!-- **** Start reviews **** -->
  <div class="starReviews">

    <!-- Show average-rating -->
  
    <!-- Add new review -->
    <div class="add-review"></div>
  
    <!-- This is where your product ID goes -->
    <div id="review-productId" class="review-productId" style=""><?php echo $_REQUEST['productid']; ?></div> 
  
    <hr>
  
    <!-- Show current reviews --> 
    <div class="show-reviews"> 
    
    </div> 
</div> 
<!-- **** End reviews **** -->

</div>

    <!-- Jquery -->
    <script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 
       
    <!-- jQuery Form Validator -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.34/jquery.form-validator.min.js"></script>
    
    <!-- jQuery Barrating plugin -->
    <script src="https://localhost/project/shopurneeds/starreviews/assets/js/jquery.barrating.js"></script>
    
    <!-- jQuery starReviews -->
    <script src="https://localhost/project/shopurneeds/starreviews/assets/js/starReviews.js"></script>
    
    <script type="text/javascript">
    
      $(document).ready(function() {
        
        /* Activate our reviews */
        $().reviews('.starReviews');
        
      });

    </script>
    
</body>

</html>