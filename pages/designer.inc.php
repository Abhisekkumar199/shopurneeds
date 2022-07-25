
<style>
.shopurneedsdesigner_leftpart .filter-inner-cont ul {
  padding:0;
}
.shopurneedsdesigner_leftpart .filter-inner-cont li  {
    
    list-style-type: none; 
}
.shopurneedsdesigner_leftpart .filter-inner-cont li a {
   color: #002b4f;
    list-style-type: none;
    padding: 3px 0;
    display: inline-block; font-weight:500; font-size:15px;
}
.shopurneeds_alphabet-list{ width:100%; float:left; border-bottom:1px solid #002b4f; padding:0; }
.shopurneeds_alphabet-list li{ width:auto; float:left; display:inline-block; list-style-type:none;}
.shopurneeds_alphabet-list li a{ color:#002b4f;width:100%; float:left; display:inline-block; list-style-type:none; padding:10px; font-size:18px; font-weight:500;}
.shopurneedsdesigner_rightpart li{ list-style-type:none;}
.shopurneedsdesigner_rightpart ul.designer-listing {
    list-style: none;
    float: left;
    padding-left:0px; width:100%;
}
.shopurneedsdesigner_rightpart li.desc-block {
   display: inline-block;
    width: 100%;
    padding: 0 15px 0 0;
    vertical-align: top;
}
.shopurneedsdesigner_rightpart ul.designer-listing > li {
    width: 33.0%; float:left;
}
.shopurneedsdesigner_rightpart li.desc-block.title {
    font-weight: bold;color:#002b4f;border-top: 1px solid #fcd3c1;
    margin-top: 20px; padding-top:20px;
    width: 87.6%;
}
ul.shopurneeds_designer-name-list li.title:first-child {
    border: 0 !important;
}
.shopurneedsdesigner_rightpart ul.designer-listing li a{ font-size:14px;}
@media screen and (max-width:767px){.designer-listing li{ width:33% !important;}}
@media screen and (max-width:480px){.shopurneeds_alphabet-list li a{padding: 3px 10px;
    font-size: 14px;}.designer-listing li{ width:100% !important;}}


</style>

<script src="https://www.shopurneeds.fashion/Content/designerappjs.min.js"></script>
<main class="container">
<div ng-controller="ProductController" class="row">
  <div class="col-lg-11 col-xs-12 clearfix grid-center ot_20" style=" padding:20px 0;">
    <section class="categorybanner hidden-xs col-sm-12" >
      <h2> ALL Designers</h2>
    </section>
    <section class="col-xs-12 listingproduct">
      <div class="row">
       
			<form role="form" id="search_form" >
        <!--mobile end-->
        <div id="sidebar" class="filter-cont col-md-2 col-xs-12 shopurneedsdesigner_leftpart">
          
            <div class="filter-inner-cont">
			<ul>
			<li><a href="<?php $url; ?>/designers" <?php if($_REQUEST['type']=="") { ?>style="font-size:16px;font-weight:bold;" <?php } ?>>DESIGNERS</a></li>
			<?php $sqlcatr=mysqli_query($conn,"select * from shopurneeds_category where displayflag='1' and parent='0'");
			while($rowsas22=mysqli_fetch_array($sqlcatr))
			{
			?>
		<li><a href="<?php $url; ?>/designers/<?php echo $rowsas22['cat_slug']; ?>" <?php if($_REQUEST['type']==$rowsas22['cat_slug']) { ?>style="font-size:16px;font-weight:bold;" <?php } ?>><?php echo strtoupper($rowsas22['categoryname']); ?> </a></li>
			<?php } ?>
			</ul>
           
                  </div>                
              </div>			  
			  <div class="products-cont col-md-10 col-xs-12 shopurneedsdesigner_rightpart">         
		  <div class="col-sm-12">
		  <ul class="shopurneeds_alphabet-list "> 

                       <li><a href="#5">0-9</a></li>

                    <li><a href="#a">A</a></li>
                    <li><a href="#b">B</a></li>
                    <li><a href="#c">C</a></li>
                    <li><a href="#d">D</a></li>
                    <li><a href="#e">E</a></li>
                    <li><a href="#f">F</a></li>
                    <li><a href="#g">G</a></li>
                    <li><a href="#h">H</a></li>
                    <li><a href="#i">I</a></li>
                    <li><a href="#j">J</a></li>
                    <li><a href="#k">K</a></li>
                    <li><a href="#l">L</a></li>
                    <li><a href="#m">M</a></li>
                    <li><a href="#n">N</a></li>
                    <li><a href="#o">O</a></li>
                    <li><a href="#p">P</a></li>
                    <li><a href="#q">Q</a></li>
                    <li><a href="#r">R</a></li>
                    <li><a href="#s">S</a></li>
                    <li><a href="#t">T</a></li>
                    <li><a href="#u">U</a></li>
                    <li><a href="#v">V</a></li>
                    <li><a href="#w">W</a></li>
                    <li><a href="#x">X</a></li>
                    <li><a href="#y">Y</a></li>
                    <li><a href="#z">Z</a></li>

                </ul>


		  
				<ul class="shopurneeds_designer-name-list" id="shopurneeds_designer-name-list">
				    <?php
				    $dsscatt=$_REQUEST['type'];
				$i=1;

				if($dsscatt!="")
				{
				    $caslcs=mysqli_fetch_array(mysqli_query($conn,"select cat_id from shopurneeds_category where cat_slug='".$dsscatt."'"));
				   $urdss= "and bid in (select brandid from shopurneeds_category_brand where catid='".$caslcs['cat_id']."')"; 
				  				   				$i=2;

				}
				  $sqlnrsnum=mysqli_query($conn,"select * from shopurneeds_brand where displayflag='1' and pstatus='1' and  (brandname like '0%' or brandname like '1%' or brandname like '2%'or brandname like '3%'or brandname like '4%'or brandname like '5%'or brandname like '6%'or brandname like '7%'or brandname like '8%'or brandname like '9%') $urdss");
				  $ssanum=mysqli_num_rows($sqlnrsnum);
				  if($ssanum>0) {
				  				   				$i=1;

				?>
				<li class="title desc-block" id="5">0 to 9</li>
                   	<li class="desc-block 5-block">
                		<ul class="designer-listing" >
                            <?php while($rowsaaanum=mysqli_fetch_array($sqlnrsnum)) { ?>
                            <li style="width:200px;"><a href="<?php echo $url; ?>/<?php echo $rowsaaa['brandslug'] ?><?php echo $rowsaaanum['brandslug'] ?>"><?php echo ucwords(strtolower($rowsaaanum['brandname'])); ?></a></li>
                            <?php } ?>                        
                		</ul>
                	</li>
				<?php 
				}
				$sqlde=mysqli_query($conn,"select distinct substring(brandname,1,1) as brandname from shopurneeds_brand where displayflag='1' and pstatus='1' $urdss order by brandname asc");
				while($rowbra=mysqli_fetch_array($sqlde)) 
				{ 
				    
				    $dssss=$rowbra['brandname'];
				    $sqlnrs=mysqli_query($conn,"select * from shopurneeds_brand where brandname like '$dssss%' and displayflag='1' and pstatus='1' $urdss");
				  if($i>1) {  
				?>
				<li class="title desc-block" id="<?php echo strtolower($dssss); ?>"><?php echo $dssss; ?></li>
                   	<li class="desc-block <?php echo $dssss; ?>-block">
                		<ul class="designer-listing" >
                            <?php while($rowsaaa=mysqli_fetch_array($sqlnrs)) { ?>
                            <li style="width:200px;"><a href="<?php echo $url; ?>/<?php echo $rowsaaa['brandslug'] ?>"><?php echo $rowsaaa['brandname']; ?>&nbsp;</a></li>
                            <?php } ?>                        
                		</ul>
                	</li>
                
                  <?php } $i++; } ?>
               
                </ul>
				
				
				
            </div>
          </div>
        </div>
            </div>
          </div>
        </div>        
        
		</form>
      </div>
    </section>
  </div>
  
</div>
</main>
