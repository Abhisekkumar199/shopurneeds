
      <section id="slider" class="row">
         <div class="row sliderCont flexslider dark m0">
            <ul class="slides nav">
              
               <?php   
                $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Index Top' order by id asc limit 0,6");
                $num1=mysqli_num_rows($sql1); 
                if($num1 > 0)
                { 
                    $j = 0;
                while($rowsbanner1=mysqli_fetch_assoc($sql1))
                {
                ?>  
                
					<li <?php if($j == '1')  { ?>class="flex-active-slide" <?php } else { ?>class="" <?php } ?> style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; <?php if($j == '1')  { ?>z-index: 2;<?php } else { ?>z-index: 1;<?php } ?>" >
					  <img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>" alt="" draggable="false">
					  <div class="text_lines row m0">
						 <div class="container p0 text-left">
							<h3><?php echo $rowsbanner1['bannername']; ?></h3> 
							<h4><a class="theme_btn with_i" href="<?php echo $rowsbanner1['externallink']; ?>"><i class="fas fa-plus-circle"></i>Shop now</a></h4>
						 </div>
					  </div>
					  <!--Text Lines-->
					</li> 
                
                <?php $j++;  } } ?> 
               
               
            </ul>
         <ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="#"><i class="fas fa-angle-left"></i></a></li><li class="flex-nav-next"><a class="flex-next" href="#"><i class="fas fa-angle-right"></i></a></li></ul></div>
      </section>
      <!--Slider-->
       
      <section id="shopFeatures_new">
         <div class=" shopFeatures_new container">
           <div class="row mt30">
              <div class="col-md-12">
              <ul>
                <?php 
                $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Index Bottom Slider' order by id asc limit 0,8 ".$limit."") ;
                $num1=mysqli_num_rows($sql1); 
                if($num1 > 0)
                { 
                    $j = 0;
                while($rowsbanner1=mysqli_fetch_assoc($sql1))
                {
                ?>   
                    <li>
                      <a href="<?php echo $rowsbanner1['externallink']; ?>">
                         <img alt="" class="img-responsive"  src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>">
                         <div class="sf_box">
                            <div class="sf_box_inner">
                               
                            </div>
                         </div>
                      </a>
                      <h3 style="color:#000000;text-align: center;"><?php echo $rowsbanner1['bannername']; ?></h3>
                    </li>
                <?php $j++;  } } ?>    
              </ul>
              </div>
              
           </div>
           
         </div>
      </section>
       <!--Feature Categories-->
      <!--Feature Products 4 Collumn-->
      <section id="ring_sec" class="ring_sec">
            <?php 
            $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='About us' order by id asc limit 0,6") ;
            $num1=mysqli_num_rows($sql1); 
            if($num1 > 0)
            { 
                $j = 0;
            while($rowsbanner1=mysqli_fetch_assoc($sql1))
            {
            ?>   
                <div id="trigger" class="container ">
                    <div class="row">
                       <div class="col-md-6  diamond_j_cont">
                          <div  class="diamond_j">
                          </div>
                          <div class="diamond_b">
                             <img alt="" class="img-responsive"  src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>">
                          </div>
                       </div>
                       <div   class="col-md-6  ring_cont">
                          <h2><?php echo $rowsbanner1['bannername']; ?></h2>
                          <?php echo $rowsbanner1['description']; ?>
                          <a  class="com_btn" href="<?php echo $rowsbanner1['externallink']; ?>">Know More</a>
                       </div>
                    </div>
                 </div>
            <?php $j++;  } } ?>   
         
      </section>
      <section id="shopRings">
         <div class="sectionTitle">
            <h3>New arrivels</h3>
            <h5>know more about our latest collection</h5>
         </div>
         <div class="d-carousel-cener owl-carousel">
            
            <?php 
            $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='New Arrival' order by id asc limit 0,6 ") ;
            $num1=mysqli_num_rows($sql1); 
            if($num1 > 0)
            { 
                $j = 0;
            while($rowsbanner1=mysqli_fetch_assoc($sql1))
            {
            ?>   
                
                <div class="dc-inner">
                   <a href="<?php echo $rowsbanner1['externallink']; ?>">
                      <img alt="ring" src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>" >
                      <div class="dc-containt">
                         <h2><?php echo $rowsbanner1['bannername']; ?></h2>
                         <p><?php echo $rowsbanner1['description']; ?></p>
                      </div>
                   </a>
                </div>
            <?php $j++;  } } ?>    
         </div>
      </section>
     
      <section id="testimonialTabs" class="row contentRowPad">
         <div class="container">
            <div class="row sectionTitle">
               <h3>some words from our customers</h3>
               <h5>we satisfied more than 700 customers</h5>
            </div>
            <div class="row">
               <div class="tab-content testiTabContent">
                  <div role="tabpanel" class="tab-pane active" id="testi1">
                     <p><span class="t_q_start">“</span> D-Shine is really excellent site for jewellery. I am very happy with the D-Shine products and dedicated services from them. D-Shine is really excellent site for jewellery. <span class="t_q_end">”</span></p>
                     <h5 class="customerName">Dwayne johnson</h5>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="testi2">
                     <p><span class="t_q_start">“</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vestibulum justo accumsan felis faucibus vestibulum. Integer a ex orci. Cras sit amet efficitur nisl, et vestibulum orci. <span class="t_q_end">”</span></p>
                     <h5 class="customerName">Jonh add</h5>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="testi3">
                     <p><span class="t_q_start">“</span> D-Shine is really excellent site for jewellery. I am very happy with the D-Shine products and dedicated services from them. D-Shine is really excellent site for jewellery. <span class="t_q_end">”</span></p>
                     <h5 class="customerName">william parker</h5>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="testi4">
                     <p><span class="t_q_start">“</span> Donec in velit eget lacus convallis dapibus. Nulla ultrices nulla sit amet justo pretium, ut tristique diam ultrices. Nunc efficitur mauris sit amet imperdiet <span class="t_q_end">”</span></p>
                     <h5 class="customerName">Will smith</h5>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="testi5">
                     <p><span class="t_q_start">“</span> D-Shine is really excellent site for jewellery. I am very happy with the D-Shine products and dedicated services from them. D-Shine is really excellent site for jewellery. <span class="t_q_end">”</span></p>
                     <h5 class="customerName">Dwayne johnson</h5>
                  </div>
               </div>
               <ul class="nav nav-tabs" role="tablist" id="testiTab">
                  <li role="presentation" class="active">
                     <a href="#testi1" aria-controls="testi1" role="tab" data-toggle="tab">
                     <img src="<?php echo URL; ?>/assets//testimonial/1.png" alt="">
                     </a>
                     <div class="testi_rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                     </div>
                  </li>
                  <li role="presentation">
                     <a href="#testi2" aria-controls="testi2" role="tab" data-toggle="tab">
                     <img src="<?php echo URL; ?>/assets//testimonial/2.png" alt="">
                     </a>
                     <div class="testi_rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-o"></i>
                        <i class="fas fa-star-o"></i>
                     </div>
                  </li>
                  <li role="presentation">
                     <a href="#testi3" aria-controls="testi3" role="tab" data-toggle="tab">
                     <img src="<?php echo URL; ?>/assets//testimonial/3.png" alt="">
                     </a>
                     <div class="testi_rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                     </div>
                  </li>
                  <li role="presentation">
                     <a href="#testi4" aria-controls="testi4" role="tab" data-toggle="tab">
                     <img src="<?php echo URL; ?>/assets//testimonial/4.png" alt="">
                     </a>
                     <div class="testi_rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-o"></i>
                     </div>
                  </li>
                  <li role="presentation">
                     <a href="#testi5" aria-controls="testi5" role="tab" data-toggle="tab">
                     <img src="<?php echo URL; ?>/assets//testimonial/5.png" alt="">
                     </a>
                     <div class="testi_rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-o"></i>
                        <i class="fas fa-star-o"></i>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </section>
      <!--Testimonial Tabs-->
      <section id="brands" class="row contentRowPad">
         <div class="container">
            <div class="row sectionTitle">
               <h3>Our Promises</h3>
               <h5>choose best with our favorite brands</h5>
            </div>
            <div class="row brands">
               <ul class="nav navbar-nav">
                  <?php 
                    $sql1=mysqli_query($conn,"select * from `".$sufix."banners` where displayflag='1' and bposition='Brand' order by id asc limit 0,6") ;
                    $num1=mysqli_num_rows($sql1); 
                    if($num1 > 0)
                    { 
                        $j = 0;
                    while($rowsbanner1=mysqli_fetch_assoc($sql1))
                    {
                    ?>    
                        <li style="width: 19.90%;"><a href="<?php echo $rowsbanner1['externallink']; ?>"><img src="<?php echo $cdnurl;?>/uploads/bannerimages/<?php echo $rowsbanner1['uploadimage']; ?>" alt=""></a></li> 
                    <?php $j++;  } } ?>    
               </ul>
            </div>
         </div>
      </section>
      



