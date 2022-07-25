    </div>
    <!-- ############ Content END-->
        <!-- ############ Footer START-->
        <div id="footer" class="page-footer hide">
            <div class="d-flex p-3"><span class="text-sm text-muted flex">&copy; Copyright. TPI</span>
                <div class="text-sm text-muted">Version 1.1.2</div>
            </div>
        </div>
        <!-- ############ Footer END-->
     
    <script src="<?php echo URL; ?>/admin-panel/assets/js/site.min.js"></script>
    
    <script>
       $(document).ready(function(){
            $('#file-input').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    
                    var data = $(this)[0].files; //this file data
                    
                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                                $('#thumb-output').append(img); //append image to output element
                            };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });
                    
                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
          
            $(".remove").click(function (e) {
                e.preventDefault();
                data.splice(0, 1);
                $('#thumb-output a').eq(data.length).remove();
            });
            
            
            
             // textarea editor
            $('textarea').each(function(){
            		CKEDITOR.replace(this.name,{
            		toolbar: [
            			{ name: 'document', items: [ 'Source','-','Print','-','Preview','-','Bold','-', 'Italic','-','Underline','-','list','-','align','-','NumberedList','-','BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','-','JustifyCenter','-','JustifyRight','-','JustifyBlock','-','Maximize','-','spellchecker','-','Link','-','Image','-','Table','-','Smiley','-','SpecialChar','-','TextColor', 'BGColor','Format', 'Font','FontSize','-'] }        		
            			
            		]
            	});
            }); 
            
        });


    </script>
    
    <script type="text/javascript">  
    function parent(val1)
    {      
        $("#sub_category").val(val1);
        var insertAfter = $(this).parent().parent().parent();  
    	$(this).closest('.next_sub').find('.next_sub').remove();;
        $(".next_sub").nextAll().hide();  
        $('#show_sub_categories').append('<img src="loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
        $.post("https://localhost/project/shopurneeds/seller-panel/get_child_categories.php", {
        parent_id: val1,
        }, function(response){  
        var jd = JSON.parse(response);   
        setTimeout("finishAjax('show_sub_categories', '"+escape(jd.category)+"')", 400);
        $(".allcategory").html(jd.allcategory); 
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
</body>
<!-- Mirrored from flatfull.com/themes/basik/html/table.style.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 17 Jan 2020 05:56:06 GMT -->

</html>