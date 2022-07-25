<script type="text/javascript">  
function parent(val1)
{      
    $("#sub_category").val(val1);
    var insertAfter = $(this).parent().parent().parent();  
	$(this).closest('.next_sub').find('.next_sub').remove();;
    $(".next_sub").nextAll().hide();  
    $('#show_sub_categories').append('<img src="loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
    $.post("https://localhost/project/shopurneeds/admin-panel/get_child_categories.php", {
    parent_id: val1,
    }, function(response){   
    var jd = JSON.parse(response);   
    setTimeout("finishAjax('show_sub_categories', '"+escape(jd.category)+"')", 400);
	if(jd.attribute != '')
	{ 
		$(".cat_attr").html(jd.attribute); 
	}
	$(".cat_attr").html(jd.attribute); 
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
    
    // textarea editor
    $('textarea').each(function(){
    		CKEDITOR.replace(this.name,{
    		toolbar: [
    			{ name: 'document', items: [ 'Source','-','Print','-','Preview','-','Bold','-', 'Italic','-','Underline','-','list','-','align','-','NumberedList','-','BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','-','JustifyCenter','-','JustifyRight','-','JustifyBlock','-','Maximize','-','spellchecker','-','Link','-','Image','-','Table','-','Smiley','-','SpecialChar','-','TextColor', 'BGColor','Format', 'Font','FontSize','-'] }        		
    			
    		]
    	});
    }); 
    
    // product validation
    $('.product').click(function(){ 
    	var search_category = $('#search_category').val();   
    	var productname = $('#productname').val();   
    	var sku = $('#sku').val();  
    	var costprice = $('#costprice').val(); 
    	var sellingprice = $('#sellingprice').val();  
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
    $(document).on('change ', '.is_size', function() {  
        var is_size = $(this).val();  
        if(is_size == 1)
        {   
            $(".show_size").show(); 
            $(".show_comment").hide(); 
        } 
        else
        {
            $(".show_size").hide(); 
            $(".show_comment").show();  
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
            <h2 class="text-md text-highlight">إضافة منتج جديد</h2>
            <small class="text-muted">أضف تفاصيل المنتج والتسعير والمتغيرات والصور</small></div>
        <div class="flex"></div>
        <div><a href="#" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1">عرض جميع المنتجات</span> <i data-feather="arrow-right"></i></a></div>
    </div>
</div>

<form name="addForm" id="addForm" action="product-process.php?option=<?php echo $option; ?>&id=<?php echo $_REQUEST['id']; ?>" method="POST" enctype="multipart/form-data">	
<div class="page-content page-container" id="page-content">
    <div class="padding"> 
        <div class="card">
            <input type="hidden" name="sub_category" id="sub_category" value="" >
        <div class="row" id="show_sub_categories">
            <div class="col-md-3 next_sub">
                <div class="card-header" style="border-bottom:none;"><strong>اختر الفئة</strong></div> 
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
            <div class="card-header"><strong>متغيرات المنتج</strong></div>
            <div class="card-body"> 
                <div class="input-group mb-3">
                    <div class="input-group-prepend"> <label class="input-group-text" for="inputGroupSelect01">حدد متغير</label></div>
                    <select class="custom-select" id="variant" name="variant">
                    <option value="" >تحديد</option>
                    <option value="1">اللون</option> 
                    </select>
                </div>
                
                 
                <div class="show_size">
                    <div class="input-group mb-3"> 
                        <span class="input-group-text">بحجم</span><input type="text" name="size[]" placeholder="1m x 1.5m " class="form-control"> &nbsp;&nbsp;
                        <span class="input-group-text">السيد</span><input type="text" name="mrp[]" placeholder="" class="form-control mrp">&nbsp;&nbsp;
                        <span class="input-group-text">خصم ٪</span><input type="text" name="discount[]" placeholder="" class="form-control discount">&nbsp;&nbsp;
                        <span class="input-group-text">مقدار الخصم</span><input type="text" name="discount_amount[]" placeholder="" class="form-control discount_amount">&nbsp;&nbsp;
                        <span class="input-group-text">سعر البيع </span><input type="text" name="sale_price[]" placeholder="" class="form-control sale_price">&nbsp;&nbsp;
                        <span class="input-group-text">مخزون</span><input type="text" name="avl_qty[]" placeholder="" class="form-control">&nbsp;&nbsp;
                        <span class="input-group-text" id="EventbtnAdd" style="background: #4f92fe; color: #fff;">+</span>
                    </div> 
                    
                    <div id="EventTextBoxContainer"></div>
                </div> 
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
                            <input type="text" class="form-control" name="productname" id="productname" placeholder="اسم المنتج"  > 
                        </div>  
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">اسم المنتج بالعربية</span></div> 
                            <input type="text" class="form-control" name="productname_in_arabic" id="productname_in_arabic" placeholder="اسم المنتج بالعربية"  >
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">سكو  </span></div>
                            <input type="text" class="form-control" name="sku" id="sku"  placeholder="سكو"  >&nbsp;&nbsp;
                            <input type="text" class="form-control" name="sku_in_arabic" id="sku_in_arabic" placeholder="سكو باللغة العربية"  >
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">الرمز الشريطي</span></div>
                            <input type="text" class="form-control" name="barcode" id="barcode" placeholder="الرمز الشريطي">&nbsp;&nbsp;
                            <input type="text" class="form-control" name="barcode_in_arabic" id="barcode_in_arabic" placeholder="الباركود باللغة العربية"  >
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">هسن كود</span></div>
                            <input type="text" class="form-control" name="hsncode" id="hsncode" placeholder="هسن كود">&nbsp;&nbsp;
                            <input type="text" class="form-control" name="hsncode_in_arabic" id="hsncode_in_arabic" placeholder="هسن كود  بالعربية"  >
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><label class="input-group-text" for="material">مواد</label></div> 
                            <input type="text" class="form-control" id="material" name="material" placeholder="مواد">  &nbsp;&nbsp;
                            <input type="text" class="form-control" name="material_in_arabic" id="material_in_arabic" placeholder="المواد باللغة العربية"  >
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
                            <input type="text" class="form-control" name="costprice" id="costprice"   aria-label="MRP">
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">خصم</span></div>
                            <input type="text" name="discount_percent" id="discount_percent" class="form-control" placeholder="%">
                            <input type="text" name="discount_value" id="discount_value" class="form-control" placeholder="خصم القيمة">
                        </div>
                           <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">سعر البيع</span><span class="input-group-text">JD.</span> </div>
                            <input type="text" class="form-control" name="sellingprice" id="sellingprice" aria-label="سعر البيع">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text"> الكمية المتوفرة</span> </div>
                            <input type="text" name="in_stock_qty" id="in_stock_qty"   class="form-control" aria-label="الكمية المتوفرة">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text" id="">الكمية النظام</span></div>
                            <input type="text" name="min_qty" id="min_qty" placeholder="الكمية الدنيا" class="form-control"> 
                            <input type="text" name="max_qty" id="max_qty" placeholder="الكمية القصوى" class="form-control">
                        </div> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><label class="input-group-text" for="material">اللون</label></div> 
                            <input type="text" class="form-control" id="color" name="color">  
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
                                    <textarea class="form-control" name="shortdescription" id="shortdescription" rows="4"><?php echo $rows['shortdescription']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>وصف قصير باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="shortdescription_in_arabic" id="shortdescription_in_arabic" rows="4"><?php echo $rows['shortdescription_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div> 
                    
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>وصف</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="longdescription" id="longdescription" rows="4"><?php echo $rows['longdescription']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>الوصف باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="longdescription_in_arabic" id="longdescription_in_arabic" rows="4"><?php echo $rows['longdescription_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>  
                        
                    
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>معلومات أخرى</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="other_information" id="other_information" rows="4"><?php echo $rows['other_information']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>معلومات أخرى باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="other_information_in_arabic" id="other_information_in_arabic" rows="4"><?php echo $rows['other_information_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                         
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>عنوان الفوقية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metatitle" id="metatitle" rows="4"><?php echo $rows['metatitle']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>العنوان الفوقي باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metatitle_in_arabic" id="metatitle_in_arabic" rows="4"><?php echo $rows['metatitle_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>ميتا الوصف</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metadescription" id="metadescription" rows="4"><?php echo $rows['metadescription']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>وصف ميتا باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metadescription_in_arabic" id="metadescription_in_arabic" rows="4"><?php echo $rows['metadescription_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>كلمة تعريف ميتا</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metakeyword" id="metakeyword" rows="4"><?php echo $rows['metakeyword']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>كلمة ميتا في اللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="metakeyword_in_arabic" id="metakeyword_in_arabic" rows="4"><?php echo $rows['metakeyword_in_arabic']; ?></textarea> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6">
                                <span>كلمات المنتج</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="searchkeyword" id="searchkeyword" rows="4"><?php echo $rows['searchkeyword']; ?></textarea> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>الكلمات الرئيسية للمنتج باللغة العربية</span>
                                <div class="input-group mb-3">  
                                    <textarea class="form-control" name="searchkeyword_in_arabic" id="searchkeyword_in_arabic" rows="4"><?php echo $rows['searchkeyword_in_arabic']; ?></textarea> 
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
				                    <option value="1"<?php if($rows_pro['cod']=="1"){echo "selected";} ?>>Yes</option>
				                    <option value="0"<?php if($rows_pro['cod']=="0"){echo "selected";} ?>>NO</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend"><label class="input-group-text" for="stockavailability">OutStock/Instock</label></div>
                                <select class="custom-select" name="stockavailability" id="stockavailability"> 
                                    <option value="" >Select</option>
				                    <option value="1"<?php if($rows_pro['stockavailability']=="1"){echo "selected";} ?>>Instock</option>
				                    <option value="0"<?php if($rows_pro['stockavailability']=="0"){echo "selected";} ?>>OutStock</option>
                                </select>
                                </div>
                            </div>
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
                
                <button type="submit" class="product btn w-sm mb-1 btn-success" style="float: right;    margin-right: 12px;">حفظ والتالي</button>
            </div> 
        </div>
     </div>
</div>
</form>
  
     <!-- DETAILED SECTIONS -->
</div>
 