<?php  
 $sql_product = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."product where id='".$_REQUEST['id']."'")) ; 
 $sql_category = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."category where cat_id='".$sql_product['cat_id']."'")) ; 
?>
<script type="text/javascript">
function parent(val1)
{  
    $("#sub_category").val(val1);
    var insertAfter = $(this).parent().parent().parent();
    $(this).nextAll('.parent').remove();
    $(this).nextAll('label').remove(); 
    $('#show_sub_categories').append('<img src="loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
    $.post("https://localhost/project/shopurneeds/admin-panel/get_child_categories.php", {
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
        
    $('.product111').click(function(){   
	var productname = $('#productname').val();   
	var sku = $('#sku').val(); 
	var seller_id = $('#seller_id').val(); 
	var costprice = $('#costprice').val(); 
	var sellingprice = $('#sellingprice').val(); 
	var longdescription = $('#longdescription').val(); 
	 
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
	
	if(sku == '')
	{  
		$('#sku').css("border","1px solid red");
		$('#sku').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter sku</div>");
		return false;
	}
	else
	{ 
		$('#sku').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	} 
	
	if(seller_id == '')
	{  
		$('#seller_id').css("border","1px solid red");
		$('#seller_id').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter sku</div>");
		return false;
	}
	else
	{ 
		$('#seller_id').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	} 
	
	if(costprice == '')
	{  
		$('#costprice').css("border","1px solid red");
		$('#costprice').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter cost price</div>");
		return false;
	}
	else
	{ 
		$('#costprice').css("border","1px solid #bdb9b9"); 
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
	
	if(longdescription == '')
	{  
		$('#longdescription').css("border","1px solid red");
		$('#longdescription').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter description</div>");
		return false;
	}
	else
	{ 
		$('#longdescription').css("border","1px solid #bdb9b9"); 
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
               $('#discount_value').val(discount_value);
               $('#sellingprice').val(sell_price);
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
    return '<div class="input-group mb-3">'+sizecharthtml+'<span class="input-group-text remove" style="background: #4f92fe; color: #fff;">&nbsp;-</span></div>';
}
</script>
<span class="sizecharthtml" style="display:none;">  
    <span class="input-group-text">بحجم</span><input type="text" name="size[]" placeholder="" class="form-control"> &nbsp;&nbsp;
    <span class="input-group-text">السيد</span><input type="text" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
    <span class="input-group-text">خصم ٪</span><input type="text" name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
    <span class="input-group-text">دار الخصم</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
    <span class="input-group-text">سعر البيع</span><input type="text" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
    <span class="input-group-text">مخزون</span><input type="text" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
</span>
<div id="content" class="flex"> 
<!-- ############ Main START-->
<div>
<div class="page-hero page-container" id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">تعديل المنتج</h2>
            <small class="text-muted">أضف تفاصيل المنتج والتسعير والمتغيرات والصور</small>
        <div class="flex"></div>
        <div><a href="#" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">عرض جميع المنتجات</span> <i data-feather="arrow-right"></i></a></div>
    </div>
</div>

<form name="addForm" id="addForm" action="product-edit-process.php?option=<?php echo $option; ?>&id=<?php echo $_REQUEST['id']; ?>" method="POST" enctype="multipart/form-data">	
<div class="page-content page-container" id="page-content">
	<div class="padding"> 
        <div class="card">
            <div class="row"  >
                <div class="col-md-12  ">
                    <p> <strong>الفئة المختارة:&nbsp;</strong><?php echo $sql_category['categoryname']; ?></p>
                </div> 
            </div>
            <input type="hidden" name="sub_category" id="sub_category" value="<?php echo $sql_product['cat_id']; ?>" >
            <div class="row" id="show_sub_categories">
                <div class="col-md-3 next_sub">
                    
                    <div class="card-header" style="border-bottom:none;"><strong>تغيير الفئة</strong>&nbsp;</div> 
                    <div class="card-body" > 
                        <div class="input-group mb-3"> 
                            <select class="custom-select parent" id="search_category" name="search_category" style=" " onchange="parent(this.value);"  >
                                <option value="">تحديد</option>
                                <?php
                                $query = "select * from shopurneeds_category where parent =0";
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
        
        <div class="row col-md-12 cat_attr" id="cat_attr">
			
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
         <div class="card">
            <div class="card-header"><strong>PRODUCT VARIANTS</strong></div>
            <div class="card-body"> 
                <?php  
                if($sql_product['is_size'] == 1)
                {
                
                    $sql_product_size = mysqli_query($conn,"select * from ".$sufix."product_size where product_id='".$_REQUEST['id']."'");
                    while($rows_size = mysqli_fetch_assoc($sql_product_size))
                    {
                ?>
                    <div >
                    <div class="input-group mb-3"> 
                        <span class="input-group-text">بحجم</span><input type="text" name="size[]" value="<?php echo $rows_size['product_size']; ?>" placeholder="Enter Size Like" class="form-control"> &nbsp;&nbsp;
                        <span class="input-group-text">السيد</span><input type="text" name="mrp[]" value="<?php echo $rows_size['product_mrp']; ?>" placeholder="Enter MRP" class="form-control mrp">&nbsp;&nbsp;
                        <span class="input-group-text">خصم ٪<</span><input type="text" name="discount[]" value="<?php echo $rows_size['discount_percent']; ?>" placeholder="" class="form-control discount">&nbsp;&nbsp;
                        <span class="input-group-text">مقدار الخصم</span><input type="text" name="discount_amount[]" value="<?php echo $rows_size['discount_value']; ?>" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
                        <span class="input-group-text">سعر البيع</span><input type="text" name="sale_price[]" value="<?php echo $rows_size['product_sellingprice']; ?>" placeholder="Enter Sale Price" class="form-control sale_price">&nbsp;&nbsp;
                        <span class="input-group-text">مخزون</span><input type="text" name="avl_qty[]" value="<?php echo $rows_size['qty']; ?>" placeholder="Available Qty" class="form-control">&nbsp;&nbsp;
                         &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
                    </div>
                    </div> 
                <?php } ?>
                <div >
                <div class="input-group mb-3"> 
                        <span class="input-group-text">بحجم</span><input type="text" name="size[]" placeholder="1m x 1.5m " class="form-control"> &nbsp;&nbsp;
                        <span class="input-group-text">السيد</span><input type="text" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
                        <span class="input-group-text">خصم ٪</span><input type="text" name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
                        <span class="input-group-text">مقدار الخصم</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
                        <span class="input-group-text">سعر البيع </span><input type="text" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
                        <span class="input-group-text">مخزون</span><input type="text" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
                        <span class="input-group-text" id="EventbtnAdd" style="background: #4f92fe; color: #fff;">+</span>
                </div> 
                </div> 
                <div id="EventTextBoxContainer"></div>
                <?php } else { ?> 
                <?php } ?>
            </div>
        </div> 
    </div>
    <div class="padding">
        <div class="row">
            <div class="col-md-7"> 
                <div class="card">
                    <div class="card-header"><strong>معلومات المنتج الأساسية</strong></div>
                    <div class="card-body"> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">اسم المنتج</span></div>
                            <input type="text" class="form-control" name="productname" id="productname" value="<?php echo $sql_product['productname']; ?>" placeholder="اسم المنتج"  > 
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">اسم المنتج بالعربية</span></div> 
                            <input type="text" class="form-control" name="productname_in_arabic" id="productname_in_arabic" value="<?php echo $sql_product['productname_in_arabic']; ?>" placeholder="اسم المنتج بالعربية"  >
                        </div>  
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">سكو  </span></div>
                            <input type="text" class="form-control" name="sku" id="sku" value="<?php echo $sql_product['sku']; ?>"  placeholder="سكو"  >&nbsp;&nbsp;
                            <input type="text" class="form-control" name="sku_in_arabic" id="sku_in_arabic" value="<?php echo $sql_product['sku_in_arabic']; ?>" placeholder="سكو باللغة العربية"  >
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">الرمز الشريطي</span></div>
                            <input type="text" class="form-control" name="barcode" id="barcode" value="<?php echo $sql_product['barcode']; ?>" placeholder="الرمز الشريطي">&nbsp;&nbsp;
                            <input type="text" class="form-control" name="barcode_in_arabic" id="barcode_in_arabic" value="<?php echo $sql_product['barcode_in_arabic']; ?>" placeholder="الباركود باللغة العربية"  >
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">هسن كود</span></div>
                            <input type="text" class="form-control" name="hsncode" id="hsncode" value="<?php echo $sql_product['hsncode']; ?>" placeholder="هسن كود">&nbsp;&nbsp;
                            <input type="text" class="form-control" name="hsncode_in_arabic" id="hsncode_in_arabic" value="<?php echo $sql_product['hsncode_in_arabic']; ?>" placeholder="هسن كود  بالعربية"  >
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><label class="input-group-text" for="material">مواد</label></div> 
                            <input type="text" class="form-control" name="material" id="material" value="<?php echo $sql_product['material']; ?>" placeholder="مواد">  &nbsp;&nbsp;
                            <input type="text" class="form-control" name="material_in_arabic" id="material_in_arabic" value="<?php echo $sql_product['material_in_arabic']; ?>" placeholder="المواد باللغة العربية"  >
                        </div> 
                    </div> 
                </div> 
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><strong>سعر البيع والكمية</strong></div>
                    <div class="card-body"  > 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">MRP</span><span class="input-group-text">JD.</span> </div>
                            <input type="text" class="form-control" name="costprice" id="costprice"  value="<?php echo $sql_product['costprice']; ?>"  aria-label="Amount (to the nearest dollar)">
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">خصم</span></div>
                            <input type="text" name="discount_percent" id="discount_percent" class="form-control" value="<?php echo $sql_product['discount_percent']; ?>" placeholder="Enter %">
                            <input type="text" name="discount_value" id="discount_value" class="form-control" value="<?php echo $sql_product['discount_value']; ?>" placeholder="خصم القيمة">
                        </div>
                           <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">سعر البيع</span><span class="input-group-text">JD.</span> </div>
                            <input type="text" class="form-control" name="sellingprice" id="sellingprice" value="<?php echo $sql_product['sellingprice']; ?>" aria-label="سعر البيع">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text"> الكمية المتوفرة</span> </div>
                            <input type="text" name="in_stock_qty" id="in_stock_qty"  value="<?php echo $sql_product['in_stock_qty']; ?>"  class="form-control" aria-label="الكمية المتوفرة">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">الكمية النظام</span></div>
                            <input type="text" name="min_qty" id="min_qty" value="<?php echo $sql_product['min_qty']; ?>" placeholder="الكمية الدنيا" class="form-control"> 
                            <input type="text" name="max_qty" id="max_qty" value="<?php echo $sql_product['max_qty']; ?>" placeholder="الكمية القصوى" class="form-control">
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><label class="input-group-text" for="material">اللون</label></div> 
                            <input type="text" class="form-control" id="color" name="color" value="<?php echo $sql_product['color']; ?>" >  
                        </div>  
                    </div>
                </div> 
            </div> 
            <div class="col-md-12">
     
                <div class="card">
                    <div class="card-header"><strong>كبار المسئولين الاقتصاديين والأوصاف</strong></div>
                    <div class="card-body"> 
                    
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>وصف قصير</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="shortdescription" id="shortdescription" rows="4"><?php echo $sql_product['shortdescription']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>وصف قصير باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="shortdescription_in_arabic" id="shortdescription_in_arabic" rows="4"><?php echo $sql_product['shortdescription_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div> 
                    
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>وصف</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="longdescription" id="longdescription" rows="4"><?php echo $sql_product['longdescription']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>الوصف باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="longdescription_in_arabic" id="longdescription_in_arabic" rows="4"><?php echo $sql_product['longdescription_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>  
                        
                    
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>معلومات أخرى</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="other_information" id="other_information" rows="4"><?php echo $sql_product['other_information']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>معلومات أخرى باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="other_information_in_arabic" id="other_information_in_arabic" rows="4"><?php echo $sql_product['other_information_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                         
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>عنوان الفوقية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metatitle" id="metatitle" rows="4"><?php echo $sql_product['metatitle']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>العنوان الفوقي باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metatitle_in_arabic" id="metatitle_in_arabic" rows="4"><?php echo $sql_product['metatitle_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>ميتا الوصف</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metadescription" id="metadescription" rows="4"><?php echo $sql_product['metadescription']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>وصف ميتا باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metadescription_in_arabic" id="metadescription_in_arabic" rows="4"><?php echo $sql_product['metadescription_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>كلمة تعريف ميتا</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metakeyword" id="metakeyword" rows="4"><?php echo $sql_product['metakeyword']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>كلمة ميتا في اللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metakeyword_in_arabic" id="metakeyword_in_arabic" rows="4"><?php echo $sql_product['metakeyword_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>كلمات المنتج</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="searchkeyword" id="searchkeyword" rows="4"><?php echo $sql_product['searchkeyword']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>الكلمات الرئيسية للمنتج باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="searchkeyword_in_arabic" id="searchkeyword_in_arabic" rows="4"><?php echo $sql_product['searchkeyword_in_arabic']; ?></textarea> 
                                </div>
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
                    <div class="card-header"><strong>تفاصيل أخرى</strong></div>
                    <div class="card-body">
                        <div class="row"> 
                            
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="cod">COD</label></div>
                                <select class="custom-select" name="cod" id="cod">
                                    <option value="" >Select</option> 
				                    <option value="1"<?php if($sql_product['cod']=="1"){echo "selected";} ?>>Yes</option>
				                    <option value="0"<?php if($sql_product['cod']=="0"){echo "selected";} ?>>NO</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="stockavailability">OutStock/Instock</label></div>
                                <select class="custom-select" name="stockavailability" id="stockavailability"> 
                                    <option value="" >Select</option>
				                    <option value="1"<?php if($sql_product['stockavailability']=="1"){echo "selected";} ?>>Instock</option>
				                    <option value="0"<?php if($sql_product['stockavailability']=="0"){echo "selected";} ?>>OutStock</option>
                                </select>
                                </div>
                            </div>
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
                
                <button class="product btn w-sm mb-1 btn-success" style="float: right;    margin-right: 12px;">حفظ والتالي</button>
            </div> 
        </div>
     </div>
</div>
</form>
  
     <!-- DETAILED SECTIONS -->
</div>

