<?php
 $sql_product = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where id='".$_REQUEST['id']."'")) ; 
?>
<script type="text/javascript">
function parent(val1)
{ 
    $("#sub_category").val(val1);
    var insertAfter = $(this).parent().parent().parent();
    $(this).nextAll('.parent').remove();
    $(this).nextAll('label').remove(); 
    $('#show_sub_categories').append('<img src="loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
    $.post("get_chid_categories.php", {
    parent_id: val1,
    }, function(response){  					
    var jd = JSON.parse(response);   
    setTimeout("finishAjax('show_sub_categories', '"+escape(jd.category)+"')", 400);
    //insertAfter.append(jd.attribute); 
    }); 
    return false;
}
function finishAjax(id, response){
    $('#loader').remove();
    $('#'+id).append(unescape(response));
} 
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        
    $('textarea').each(function(){
        		CKEDITOR.replace(this.name,{
        		toolbar: [
        			{ name: 'document', items: [ 'Source','-','Print','-','Preview','-','Bold','-', 'Italic','-','Underline','-','list','-','align','-','NumberedList','-','BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','-','JustifyCenter','-','JustifyRight','-','JustifyBlock','-','Maximize','-','spellchecker','-','Link','-','Image','-','Table','-','Smiley','-','SpecialChar','-','TextColor', 'BGColor','Format', 'Font','FontSize','-'] }        		
        			
        		]
        	});
        });    
        
    $('.product').click(function(){
        
	var color = $('#color').val(); 
	var productname = $('#productname').val();   
	var seller_id = $('#seller_id').val();  
	var sellingprice = $('#sellingprice').val();    
	var bundle_total_unit = $('#bundle_total_unit').val();     
	var bundle_price = $('#bundle_price').val();     
	var in_stock_qty = $('#in_stock_qty').val();     
	var cod = $('#cod').val();       
         
	if(color == '')
	{  
		$('#color').css("border","1px solid red");
		$('#color').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please select color</div>");
		return false;
	}
	else
	{ 
		$('#color').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
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
	
	if(bundle_total_unit == '')
	{  
		$('#bundle_total_unit').css("border","1px solid red");
		$('#bundle_total_unit').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter bundle unit</div>");
		return false;
	}
	else
	{ 
		$('#bundle_total_unit').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	} 
	
	if(bundle_price == '')
	{  
		$('#bundle_price').css("border","1px solid red");
		$('#bundle_price').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter bundle price</div>");
		return false;
	}
	else
	{ 
		$('#bundle_price').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	if(in_stock_qty == '')
	{  
		$('#in_stock_qty').css("border","1px solid red");
		$('#in_stock_qty').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter stock quantity</div>");
		return false;
	}
	else
	{ 
		$('#in_stock_qty').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
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
            var bundle_total_unit = $('#bundle_total_unit').val(); 
            var discount = $(this).val();  
            if(costprice != '')
            { 
                var discount_value = costprice * discount / 100;
                var sell_price = costprice - discount_value; 
                var total_amount = sell_price * bundle_total_unit; 
                $('#discount_value').val(discount_value);
                $('#sellingprice').val(sell_price);  
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
function GetDynamicTextBox(value) {
var value12 = value;
var sizecharthtml = $(".sizecharthtml").html();
//alert(sizecharthtml);
    return '<div class="input-group mb-3">'+sizecharthtml+'<span class="input-group-text remove">-</span></div>';
}
function variant(val)
{
    var current_color = val;
    var prodname = $("#prod_name").val();
    var new_name  = prodname + ' ' + current_color;
    $("#productname").val(new_name);
}
</script>
<span class="sizecharthtml" style="display:none;"> 
    <span class="input-group-text">Size</span><input type="text" name="size[]" placeholder="" class="form-control"> &nbsp;&nbsp;
    <span class="input-group-text">MRP</span><input type="text" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
    <span class="input-group-text">Disc %</span><input type="text" name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
    <span class="input-group-text">Disc Amt</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
    <span class="input-group-text">Sale rs</span><input type="text" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
    <span class="input-group-text">stock</span><input type="text" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
    <span class="input-group-text">Min. Stock Qty</span><input type="text" name="min_stock_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
</span>
<div id="content" class="flex"> 
<!-- ############ Main START-->
<div>
<div class="page-hero page-container" id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Add PRODUCT VARIANT</h2> </div>
        <div class="flex"></div> 
    </div>
</div>

<form name="addForm" id="addForm" action="product-variant-process.php?option=<?php echo $option; ?>&main_product_id=<?php echo $_REQUEST['id']; ?>" method="POST" enctype="multipart/form-data">	
<input type="hidden" name="catid" value="<?php echo $sql_product['cat_id']; ?>" />
<div class="page-content page-container" id="page-content">
        
        <div class="padding"> 
            <div class="card">
                <input type="hidden" name="sub_category" id="sub_category" value="" >
                <div class="row" id="show_sub_categories">
                    <div class="col-md-3">
                        <div class="card-header"><strong>Select Flavour</strong></div> 
                        <div class="card-body" > 
                            <div class="input-group mb-3"> 
                                <select class="custom-select" onchange="variant(this.value);" id="color" name="color"  >
                                    <option value="">Select</option>
                                    <?php
                                    $sql_variant = "select * from shopurneeds_flavour order by name asc";
                                    $results = mysqli_query($conn,$sql_variant);
                                    while ($rows_variant = mysqli_fetch_assoc($results))
                                    {?>
                                    <option value="<?php echo $rows_variant['name']; ?>" <?php if($rows_variant['name']==$sql_product['color']) { ?> selected<?php } ?>><?php echo $rows_variant['name']; ?></option>	 
                                    <?php } ?> 	 
                                </select>
                            </div> 
                        </div>
                    </div> 
                </div>
            </div> 
            <div class="card">
                <div class="card-header"><strong>PRODUCT SIZE</strong></div>
                <div class="card-body">  
                    <?php  
                        $sql_product_size = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$_REQUEST['id']."'");
                        while($rows_size = mysqli_fetch_assoc($sql_product_size))
                        {
                    ?>
                        <div>
                        <div class="input-group mb-3"> 
                            <span class="input-group-text">Size</span><input type="text" name="size[]" value="<?php echo $rows_size['product_size']; ?>" placeholder="Enter Size Like" class="form-control"> &nbsp;&nbsp;
                            <span class="input-group-text">MRP</span><input type="text" name="mrp[]" value="<?php echo $rows_size['product_mrp']; ?>" placeholder="Enter MRP" class="form-control mrp">&nbsp;&nbsp;
                            <span class="input-group-text">Disc %</span><input type="text" name="discount[]" value="<?php echo $rows_size['discount_percent']; ?>" placeholder="" class="form-control discount">&nbsp;&nbsp;
                            <span class="input-group-text">Disc Amt</span><input type="text" name="discount_amount[]" value="<?php echo $rows_size['discount_value']; ?>" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
                            <span class="input-group-text">Sale rs</span><input type="text" name="sale_price[]" value="<?php echo $rows_size['product_sellingprice']; ?>" placeholder="Enter Sale Price" class="form-control sale_price">&nbsp;&nbsp;
                            <span class="input-group-text">Stock</span><input type="text" name="avl_qty[]" value="<?php echo $rows_size['qty']; ?>" placeholder="Available Qty" class="form-control">&nbsp;&nbsp;
                            <span class="input-group-text">Min. Stock Qty</span><input type="text" name="min_stock_qty[]" value="<?php echo $rows_size['min_stock_qty']; ?>"  placeholder="" class="form-control">&nbsp;&nbsp;
                             &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
                        </div>  
                        </div>
                    <?php } ?>
                    <div>
                    <div class="input-group mb-3"> 
                        <span class="input-group-text">Size</span><input type="text" name="size[]" placeholder="" class="form-control"> &nbsp;&nbsp;
                        <span class="input-group-text">MRP</span><input type="text" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
                        <span class="input-group-text">Disc %</span><input type="text" name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
                        <span class="input-group-text">Disc Amt</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
                        <span class="input-group-text">Sale rs</span><input type="text" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
                        <span class="input-group-text">Stock</span><input type="text" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
                        <span class="input-group-text">Min. Stock Qty</span><input type="text" name="min_stock_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
                        <span class="input-group-text" id="EventbtnAdd" style="background: #4f92fe; color: #fff;">+</span>
                    </div> 
                    </div>
                    
                    <div id="EventTextBoxContainer"></div>
                </div>
            </div> 
        </div>
        
        <div class="padding"> 
            <div class="card"> 
                <div class="row col-md-12 cat_attr" id="cat_attr" style="margin-top:10px;">
    			<?php  
    				$querys  = mysqli_query($conn,"select categoryname,attribute from shopurneeds_category where cat_id = '".$sql_product['cat_id']."'");
    				$selecat  = mysqli_fetch_array($querys);
    				$atribute = $selecat['attribute'];  
    				$sql_attr  = mysqli_query($conn,"select * from shopurneeds_attributes where atr_id IN (".$atribute.")");
    				
    				if(@mysqli_num_rows($sql_attr) > 0)
    				{
    					while($rows_attr = mysqli_fetch_assoc($sql_attr))
    					{	 
    						$attr_val = ''; 						
    						$sql_prod_attr = mysqli_query($conn,"select atr_val_id from ".$sufix."product_attribute where pid='".$_REQUEST['id']."' and atr_id ='".$rows_attr['atr_id']."' ");
    						while($rows11 = mysqli_fetch_assoc($sql_prod_attr))
    						{
    							$attr_val .= $rows11['atr_val_id'].","; 
    						}
    						  $attr_val1 = substr($attr_val,0,-1);	
    						$attr_val = explode(',',$attr_val1);
    				
    				?>
    				
    					<div class="col-md-6">
    						<div class="input-group mb-3">
    							<div class="input-group-prepend">
    								<label class="input-group-text" for="inputGroupSelect01"><?php echo $rows_attr['attributename']; ?></label>
    							</div>
    							<INPUT TYPE="hidden" NAME="atr_id[]" value="<?php echo $rows_attr['atr_id']; ?>" size=25 class="inputtext" />
    							<select class="custom-select" name="<?php echo  $rows_attr['atr_id']; ?>_atr_val_id[]" multiple="multiple" required >
    								<option value="">Select</option>
    								<?php 
    								
    								$sql_atr_val  = mysqli_query($conn,"select atr_val_id,attributevaluename from ".$sufix."attributevalue where atr_id='".$rows_attr['atr_id']."' and displayflag='1' order by attributevaluename ASC") ;
    								while($rows_atr_val= mysqli_fetch_assoc($sql_atr_val))
    								{ 
    								?>							
    									<option value="<?php echo $rows_atr_val['atr_val_id']; ?>"  <?php if(in_array($rows_atr_val['atr_val_id'],$attr_val)) { echo "selected='selected'"; } ?> ><?php echo $rows_atr_val['attributevaluename']; ?></option>
    								<?php } ?>	
    							</select>
    						</div>
    					</div>
    				<?php	}
    				}
    				?>	 
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
                                        <input type="hidden"  id="prod_name" value="<?php echo $sql_product['productname']; ?>"  >
                                   
                                        <input type="text" class="form-control" name="productname" id="productname" value="<?php echo $sql_product['productname']; ?>" placeholder="Product Name" required>
                                    </div> 
                                     
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id="">SKU  </span></div>
                                        <input type="text" class="form-control" name="sku" id="sku" value="<?php echo $sql_product['sku']; ?>"  placeholder="Ex: INV0001" required>
                                    </div> 
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id="">Barcode</span></div>
                                        <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo $sql_product['barcode']; ?>" placeholder="Ex: 2345672890">
                                    </div>  
                                </div> 
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend"><span class="input-group-text" id="">HSN Code</span></div>
                                        <input type="text" class="form-control" name="hsncode" id="hsncode" value="<?php echo $sql_product['hsncode']; ?>" placeholder="Ex: 345678">
                                    </div>
                                
                                 
                           
                                    <div class="input-group mb-3"><div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">Select Brand</label></div>
                                        <select class="custom-select" name="brand" id="brand">
                                            <option value="">Select</option>
                                            <?php  
            				                $sqlbrand = mysqli_query($conn,"select bid,brandname from ".$sufix."brand where displayflag='1' order by brandname ASC") ;
                    						while($rows_brand= mysqli_fetch_assoc($sqlbrand))
                    						{																				
                    						?>
                    						<option value="<?php echo $rows_brand['bid']; ?>" <?php if($rows_brand['bid']==$sql_product['bid']) { ?> selected<?php } ?>><?php echo $rows_brand['brandname']; ?></option>	
                    						<?php } ?>	
                                        </select>
                                    </div> 
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
                
             </div>
        </div>  
        
        <div class="padding">
            <div class="row"> 
                <div class="col-md-12">
     
                    <div class="card">
                        <div class="card-header"><strong>SEO & DESCRIPTIONS</strong></div>
                        <div class="card-body"> 
                         
                    
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="7" id="longdescription" name="longdescription"><?php echo $sql_product['longdescription']; ?></textarea> 
                                </div> 
                            </div>   
                            <div class="form-group row"> 
                                <label class="col-sm-3 col-form-label">Meta Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="metatitle" name="metatitle" value="<?php echo $sql_product['metatitle']; ?>" > 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Meta Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="metadescription" name="metadescription" value="<?php echo $sql_product['metadescription']; ?>" > 
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Meta Keyword</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="metakeyword" name="metakeyword" value="<?php echo $sql_product['metakeyword']; ?>" > 
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
                             
                             
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="status">Status</label></div>
                                <select class="custom-select" name="status" id="status">
                                    
				                    <option value="1" <?php if($sql_product['displayflag']=="1") echo "Selected";?>>Enable</option>
				                    <option value="0" <?php if($sql_product['displayflag']=="0") echo "Selected";?>>Disable</option>	
                                </select>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <button class="product btn w-sm mb-1 btn-success" style="float: right;    margin-right: 12px;">SAVE & NEXT</button>
            </div> 
        </div>
     </div>
</div>
</form>
  
     <!-- DETAILED SECTIONS -->
</div>
