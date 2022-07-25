  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script> 
    $( document ).ready(function() { 
        // product validation
        $('.product').click(function(){ 
        	var search_category = $('#search_category').val();   
        	var productname = $('#productname').val();   
        	var seller_id = $('#seller_id').val(); 
        	
        	var sellingprice = $('#sellingprice').val();     
        	var cod = $('#cod').val();       
        	var size = $('#size').val();       
        	var mrp = $('#mrp').val();       
        	var size_sale_price = $('#size_sale_price').val();       
        	var size_avl_qty = $('#size_avl_qty').val();          
        	var variant = $('#variant').val();    
        	
        	if(search_category == '')
        	{  
        		$('#search_category').css("border","1px solid red");
        		$('#search_category').focus();
        		$('#message').html("<div class='alert alert-danger' role='alert'>Please select category</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#search_category').css("border","1px solid #bdb9b9"); 
        	} 
            
            
            if(productname == '')
        	{  
        		$('#productname').css("border","1px solid red");
        		$('#productname').focus(); 
        		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter product name</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#productname').css("border","1px solid #bdb9b9"); 
                $('#message').html("");
        	}  
        	
        	if(seller_id == '')
        	{  
        		$('#seller_id').css("border","1px solid red");
        		$('#seller_id').focus(); 
        		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter seller</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#seller_id').css("border","1px solid #bdb9b9"); 
                $('#message').html("");
        	}  
        
        	
        	if(sellingprice == '')
        	{  
        		$('#sellingprice').css("border","1px solid red");
        		$('#sellingprice').focus(); 
        		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter selling price</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#sellingprice').css("border","1px solid #bdb9b9"); 
                $('#message').html("");
        	}  
        	
         
         
         
        	
        	  
        	
        	if(variant != 1)
        	{
            	if(size == '')
            	{  
            		$('#size').css("border","1px solid red");
            		$('#size').focus(); 
            		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter size</div>");
            		return false;
            	}
            	else
            	{ 
            		$('#size').css("border","1px solid #bdb9b9"); 
                    $('#message').html("");
            	} 
            	
            	if(mrp == '')
            	{  
            		$('#mrp').css("border","1px solid red");
            		$('#mrp').focus(); 
            		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter mrp</div>");
            		return false;
            	}
            	else
            	{ 
            		$('#mrp').css("border","1px solid #bdb9b9"); 
                    $('#message').html("");
            	} 
            	
            	if(size_sale_price == '')
            	{  
            		$('#size_sale_price').css("border","1px solid red");
            		$('#size_sale_price').focus(); 
            		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter size sale price</div>");
            		return false;
            	}
            	else
            	{ 
            		$('#size_sale_price').css("border","1px solid #bdb9b9"); 
                    $('#message').html("");
            	} 
            	
            	if(size_avl_qty == '')
            	{  
            		$('#size_avl_qty').css("border","1px solid red");
            		$('#size_avl_qty').focus(); 
            		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter size available quantity</div>");
            		return false;
            	}
            	else
            	{ 
            		$('#size_avl_qty').css("border","1px solid #bdb9b9"); 
                    $('#message').html("");
            	} 
        	}
        	
        	if(cod == '')
        	{  
        		$('#cod').css("border","1px solid red");
        		$('#cod').focus(); 
        		$('#message').html("<div class='alert alert-danger' role='alert'>Please select cod</div>");
        		return false;
        	}
        	else
        	{ 
        		$('#cod').css("border","1px solid #bdb9b9"); 
                $('#message').html("");
        	}
            
        }); 
        $("#discount_percent").keyup(function(){ 
            var costprice = $('#costprice').val(); 
            var discount = $(this).val(); 
            if(costprice != '')
            { 
               var discount_value = costprice * discount / 100;
               var sell_price = costprice - discount_value;  
               $('#discount_value').val(Math.round(discount_value));
               $('#sellingprice').val(Math.round(sell_price));
               $('#bundle_total_unit').val(1);
               $('#bundle_price').val(Math.round(sell_price));
            }
        }); 
        $("#bundle_total_unit").keyup(function(){ 
            var sellingprice = $('#sellingprice').val(); 
            var bundle_total_unit = $(this).val();  
            if(sellingprice != '')
            { 
               var total_amount = sellingprice * bundle_total_unit; 
               $('#bundle_price').val(total_amount);
            }
        });
        $(document).on('keyup ', '.discount', function() {  
            var mrp = $(this).parent().parent().find('.mrp').val(); 
            var discount = $(this).val();  
            if(mrp != '')
            { 
                var discount = mrp * discount / 100;
                var sell_price = mrp - discount;   
                $(this).parent().parent().find('.discount_amount').val(discount);
                $(this).parent().parent().find('.sale_price').val(sell_price);  
            } 
        }); 
    }); 
</script> 
<script type="text/javascript">
jQuery(function ($) 
{    
    var i=1;
    jQuery("#EventbtnAdd").bind("click", function () { 
	if(i==10) {
	alert("Not allowed add more"); 
	return false
	} else {
        var div = $("<div />");
        div.html(GetDynamicTextBox(i));
        jQuery("#EventTextBoxContainer").append(div);
		}
		i=i+1;
    });
    jQuery("body").on("click", ".remove", function () { 
        jQuery(this).closest("div").remove();
		i = i-1;
    });
});
function GetDynamicTextBox(value) 
{
    var value12 = value;
    var sizecharthtml = $(".sizecharthtml").html();
    //alert(sizecharthtml);
    return '<div class="input-group mb-3">'+sizecharthtml+'<span class="input-group-text remove red " style="background: #4f92fe; color: #fff;">&nbsp;-</span></div>';
}
function hidesize(val1)
{
    if(val1 == 1)
    {
        $('#hidesize').hide();
        $('.showmsg').show();
        
    }
    else
    {
        $('#hidesize').show();
        $('.showmsg').hide();
    }
    
}
</script> 

<span class="sizecharthtml" style="display:none;"> 
    <span class="input-group-text">Size</span><input type="text" name="size[]" placeholder="Ex: 500 Gm" class="form-control size"> &nbsp;&nbsp;
    <span class="input-group-text">MRP</span><input type="text" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
    <span class="input-group-text">Disc %</span><input type="text" name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
    <span class="input-group-text">Disc Amt</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
    <span class="input-group-text">Sale rs </span><input type="text" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
    <span class="input-group-text">stock</span><input type="text" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
    <span class="input-group-text">Min. Stock Qty</span><input type="text" name="min_stock_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
</span>

<div id="content" class="flex"> 
<!-- ############ Main START-->
<div>
<div class="page-hero page-container" id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">ADD NEW PRODUCT</h2><small class="text-muted">Add Product details, pricing, Variants and images</small></div>
        <div class="flex"></div> 
    </div>
</div>

<form name="addForm" id="addForm" action="product-process.php?option=<?php echo $option; ?>&id=<?php echo $_REQUEST['id']; ?>" method="POST" enctype="multipart/form-data">	
<div class="page-content page-container" id="page-content">
    <div class="padding"> 
        <div class="card">
            <input type="hidden" name="sub_category" id="sub_category" value="" >
            <div class="row" id="show_sub_categories">
                <div class="col-md-3 next_sub">
                    <div class="card-header" style="border-bottom:none;"><strong>SELECT CATEGORY</strong></div> 
                    <div class="card-body" > 
                        <div class="input-group mb-3"> 
                            <select class="custom-select parent" id="search_category" name="search_category" style=" " onchange="parent(this.value);"  >
                                <option value="">Select</option>
                                <?php
                                $query = "select * from shopurneeds_category where parent =0 and categoryname != ''";
                                $results = mysqli_query($conn,$query);
                                while ($rows = mysqli_fetch_assoc(@$results))
                                {?>
                                <option value="<?php echo $rows['cat_id'];?>"><?php echo $rows['categoryname'];?></option>
                                <?php
                                }?> 	
                            </select>
                        </div> 
                    </div>
                </div> 
            </div>
            <div class="row"  >
    			<ul class="allcategory"></ul>
    		</div>
            <div class="row col-md-12 cat_attr" id="cat_attr">
    			
    		</div>
        </div>
     </div>
    <div class="padding">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header"><strong>PRODUCT BASIC INFOMRMATION</strong></div>
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">Product Name</span></div>
                                    <input type="text" class="form-control" name="productname" id="productname" placeholder="Product Name"  >
                                </div> 
                                 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">SKU  </span></div>
                                    <input type="text" class="form-control" name="sku" id="sku"  placeholder="Ex: INV0001"  >
                                </div> 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">GST (In %)</span></div>
                                    <input type="text" class="form-control" name="gst" id="gst" placeholder="Ex: 2345672890">
                                </div> 
                            </div> 
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"><span class="input-group-text" id="">HSN Code</span></div>
                                    <input type="text" class="form-control" name="hsncode" id="hsncode" placeholder="Ex: 345678">
                                </div>
                            
                              
                       
                                <div class="input-group mb-3"><div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">Select Brand</label></div>
                                    <select class="custom-select" name="brand" id="brand">
                                        <option value="">Select</option>
                                        <?php  
        				                $sqlbrand = mysqli_query($conn,"select bid,brandname from ".$sufix."brand where displayflag='1' order by brandname ASC") ;
                						while($rows_brand= mysqli_fetch_assoc($sqlbrand))
                						{																				
                						?>
                						<option value="<?php echo $rows_brand['bid']; ?>" ><?php echo $rows_brand['brandname']; ?></option>	
                						<?php } ?>	
                                    </select>
                                </div> 
                            </div>
                            </div>
                    </div> 
                </div> 
            </div>
            <!--<div class="col-md-6">
                <div class="card">
                    <div class="card-header"><strong> </strong></div>
                    <div class="card-body"  >
                         
                    
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">MRP</span><span class="input-group-text">Rs.</span> </div>
                            <input type="text" class="form-control" name="costprice" id="costprice"   aria-label="Amount (to the nearest dollar)">
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">Discount</span></div>
                            <input type="text" name="discount_percent" id="discount_percent" class="form-control" placeholder="Enter %">
                            <input type="text" name="discount_value" id="discount_value" class="form-control" placeholder="Enter Value">
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Sale Price</span><span class="input-group-text">Rs.</span> </div>
                            <input type="text" class="form-control" name="sellingprice" id="sellingprice" aria-label="Amount (to the nearest dollar)">
                        </div>
                       
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text"> IN-Stock Qty</span> </div>
                            <input type="text" name="in_stock_qty" id="in_stock_qty"   class="form-control" aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">Order Qty</span></div>
                            <input type="text" name="min_qty" id="min_qty" placeholder="Min Qty" class="form-control"> 
                            <input type="text" name="max_qty" id="max_qty" placeholder="Max Qty" class="form-control">
                        </div>
                        
                        
                    </div>
                </div> 
            </div>  -->
            <div class="col-md-12">
               
                <div class="card">
                    <div class="card-header"><strong>PRODUCT VARIANTS</strong> <font color="green">(If Product have no Colour or Flavour -Please Add Sizes & Rates Ex 500 Gm @ 300 )</font> </div>
                    <div class="card-body"> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"> <label class="input-group-text" for="inputGroupSelect01">Have Flavour or Colour ? </label></div>
                            <select class="custom-select" onchange="hidesize(this.value);" id="variant" name="variant">
                            <option value="" >No</option>
                            <option value="1">Yes</option> 
                            </select>
                        </div>
                         
                        <div class="input-group mb-3" id="hidesize"> 
                            <span class="input-group-text">Size</span><input type="text" id="size" name="size[]" placeholder="Ex: 500 Gm" class="form-control"> &nbsp;&nbsp;
                            <span class="input-group-text">MRP</span><input type="text" id="mrp" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
                            <span class="input-group-text">Disc %</span><input type="text"  name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
                            <span class="input-group-text">Disc Amt</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
                            <span class="input-group-text">Sale rs </span><input type="text" id="size_sale_price" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
                            <span class="input-group-text">stock</span><input type="text" id="size_avl_qty" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
                            <span class="input-group-text">Min. Stock Qty</span><input type="text" name="min_stock_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
                            <span class="input-group-text" id="EventbtnAdd" style="background: #4f92fe; color: #fff;">+</span>
                        </div> 
                        
                        <p style="display:none;" class="showmsg"><font color="green">(Please Enter Flavour, Colour, Sizes and Rates of this product in Next Page. )</font></p>
                        <div id="EventTextBoxContainer"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><strong>SEO & DESCRIPTIONS</strong></div>
                    <div class="card-body"> 
                       
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="7" id="longdescription" name="longdescription"></textarea> 
                            </div> 
                        </div>   
                    
                        <div class="form-group row"> 
                            <label class="col-sm-3 col-form-label">Meta Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="metatitle" name="metatitle" > 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Meta Keyword</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="metakeyword" name="metakeyword" > 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Meta Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="metadescription" name="metadescription" > 
                            </div>
                        </div> 
                         
                    </div>
                </div>
                   
              </div>
         </div>
    </div>  
      <!-- DETAILED SECTIONS -->
    
     <div class="padding">
        <div class="row">
            <div class="col-md-12">  
                 <div class="card"> 
                    <div class="card-header"><strong>Other Details</strong></div>
                    <div class="card-body">
                        <div class="row">  
                            <!--<div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="cod">COD</label></div>
                                <select class="custom-select" name="cod" id="cod">
                                    <option value="" >Select</option> 
				                    <option value="1"<?php if($rows_pro['cod']=="1" or $rows_pro['cod']==""){echo "selected";} ?>>Yes</option>
				                    <option value="0"<?php if($rows_pro['cod']=="0"){echo "selected";} ?>>NO</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="stockavailability">OutStock/Instock</label></div>
                                <select class="custom-select" name="stockavailability" id="stockavailability"> 
                                    <option value="" >Select</option>
				                    <option value="1" selected >Stock</option>
				                    <option value="0" >Out of Stock</option>
                                </select>
                                </div>
                            </div>-->
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="status">Status</label></div>
                                <select class="custom-select" name="status" id="status">
                                    
				                    <option value="1" <?php if($rows_pro['displayflag']=="1") echo "Selected";?>>Enable</option>
				                    <option value="0" <?php if($rows_pro['displayflag']=="0") echo "Selected";?>>Disable</option>	
                                </select>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <button type="submit" class="product btn w-sm mb-1 btn-success" style="float: right;    margin-right: 12px;">SAVE & NEXT</button>
            </div> 
        </div>
     </div>
</div>
</form>
  
     <!-- DETAILED SECTIONS -->
</div>
 