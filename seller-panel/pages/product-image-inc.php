<?php 

$sql=mysqli_query($conn,"select * from ".$sufix."product where id='".$_REQUEST['id']."' or id='".$_REQUEST['pid']."'"); 
$row_product = mysqli_fetch_assoc($sql);

$sql_image="select * from ".$sufix."imageupload where pid='".$_REQUEST['id']."' order by sortid asc";  
$result=mysqli_query($conn,$sql_image);

$num=mysqli_num_rows($result); 		
$sql_image1 = mysqli_query($conn,"select id from ".$sufix."imageupload where pid='".$_REQUEST['id']."'");
$count=0;
while($row1= mysqli_fetch_assoc($sql_image1))
{ 	
	$num2=$row1['id'];
	$count++;
}	

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
function upimage()
{
	document.image.action="imagemain_process.php";
	document.image.submit();
}
function upsort()
{
	document.image.action='sort_image_update.php';
	document.image.submit();
}  
</script>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    
                    <h2 class="text-md text-highlight"><?php if($_SESSION['admin_language'] == 'HE') { ?>העלה תמונות מוצר<?php } else { ?>Upload Product Images<?php } ?> </h2>
                </div>
                <div class="flex"></div>
                <div><a href="product-list" class="btn btn-md text-muted"><span class="d-none d-sm-inline mx-1"><?php if($_SESSION['admin_language'] == 'HE') { ?>רשימת מוצרים<?php } else { ?>Product List<?php } ?></span> <i data-feather="arrow-right"></i></a></div>
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="product-image-process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="id"  value="<?php echo $_REQUEST['id']; ?>"  />
            <div class="padding"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="col-md-3"> 
                                    <span id="message"> </span>
                                </div>
                                <div class="col-md-9"> 
                                </div>
                                <div class="clearfix"></div>
                                 
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label"><h5><?php if($_SESSION['admin_language'] == 'HE') { ?>מוצר<?php } else { ?>Product<?php } ?> : -<?php if($_SESSION['admin_language'] == 'HE') { ?> <?php echo $row_product['productname_in_hebrew']; ?> <?php } else { ?> <?php echo $row_product['productname']; ?> <?php } ?>></h5></label> 
                                    <label class="col-sm-3 col-form-label"><?php if($_SESSION['admin_language'] == 'HE') { ?>תמונות מוצר<?php } else { ?>Product Images<?php } ?></label>
                                    <div class="col-sm-9">
                                        <input name="image[]" type="file" id="file-input" size=20 class="form-control col-md-5" required  multiple /> &nbsp; 
 										 	  
                                    </div>
                                </div> 
                                <button type="submit" class="brand btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;"><?php if($_SESSION['admin_language'] == 'HE') { ?>לשמור<?php } else { ?>SAVE<?php } ?></button>
                                 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>  
            
            </form>
            <form  name="image" method="post" action="#" style="width:100%;">  
            <div class="padding">
                <div class="row">
                    <?php 
                    if($num > 0)
                    { 
                    while($row=mysqli_fetch_array($result))
                    {
                    
                    ?>
                    <?php $image_name=$row['productimage'];?>
                    <div class="col-sm-3">
                        <div class="card rt-20">
                            <div class="media web-30 text-center">
                                    <label class="ui-check ui-check-color" STYLE=" left: 0px;margin: 10px;    position: absolute;">
                                        <input type="radio" name="mainimage" value="<?php echo $row['id']; ?>"<?php if($row['mainimage']=="1"){echo "checked";} ?> > 
                                        <i class="bg-success"></i>
                                    </label>
                                    <img src="../uploads/productimage/thumb/<?php echo $image_name; ?>" alt="..." style="    padding-top: 35px;height: 200px;width:100%;margin-left: -9px;"> 
									<input name="ids[]" type="hidden" value="<?php echo $row['id']; ?>" />
									<input name="productcode" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
                            </div>
                            <div class="card-body"> 
                                <div class="card-body">
                                    <a class="btn btn-icon rt-30 rt-40" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&pid=<?php echo $_REQUEST['id'];?>&link=product-image.php&tb=<?php echo $sufix; ?>imageupload&option=id" onclick="return confirm('Are you sure to delete this?')">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                           <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18">
                                               </line>
                                            </svg>
                                    </a>
                                    <!--<a href="#" class="btn btn-icon rt-30 rt-50" title="Facebook" style="margin-left: 10px;    margin-right: 10px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                            <polyline points="20 6 9 17 4 12"></polyline></svg></a>-->
                                    <input class="rt-30 rt-60" type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" style="text-align:center;float: right;" > 
                                    <input name="ids1[]" type="hidden" value="<?php echo $row['id']; ?>" />  
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php }  } else { echo "<div align='center'>NO RECORD FOUNDS HERE!!!</div>"; } ?> 
                </div>
            </div> 
            <div class="padding">
				    <button type="button" onclick="upimage();" class="btn  bg-primary-lt pull-right"><?php if($_SESSION['admin_language'] == 'HE') { ?>עדכן את התמונה הראשית<?php } else { ?>Update Main Image<?php } ?></button>  
				    <button type="button" onclick="upsort();" class="btn  bg-primary-lt pull-right"><?php if($_SESSION['admin_language'] == 'HE') { ?>עדכן מיון<?php } else { ?>Update Sorting<?php } ?></button>   
			</div>
             </form>
           <!--- <div class="padding">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                               <div class="card-body"> 
                               <div class="table-responsive"> 
				                <form name="image" method="post" action="#" style="width:100%;">   
                                <table class="table table-theme table-row "  >
                                    <thead>
                                        <tr>										  
							                <th class="text-muted sortable"></th>   
							                <th class="text-muted sortable">ID</th> 
							                <th class="text-muted sortable">Product Image</th> 	
							                <th class="text-muted sortable">Product Name</th> 								 
							                <th class="text-muted sortable">Sort</th> 
							                <th class="text-muted sortable">Action</th> 
							            </tr>
							        </thead>
							        <tbody>
                                        <?php if($num > 0)
                                        { 
                                        while($row=mysqli_fetch_array($result))
                                        {
                                        
                                        ?>
                                        
						                <tr  data-id="15">							  
									
								  <td class="flex" style="width: 20px;">
									<input type="radio" name="mainimage" value="<?php echo $row['id']; ?>"<?php if($row['mainimage']=="1"){echo "checked";} ?> />
									<input name="ids[]" type="hidden" value="<?php echo $row['id']; ?>" />
									<input name="productcode" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
								  </td>
								  
								  
								  <td class="flex">													
									<?php echo $row['id']; ?>
								  </td>
								  <td class="flex">	
								    <div class="avatar-group web-1" style="width: 84px;">
    								    <?php $image_name=$row['productimage'];?>												
    									<a class="avatar ajax w-80"> <img style="border-radius: 0px!important;" src="../uploads/productimage/thumb/<?php echo $image_name; ?>"    /></a>
									</div>
								  </td>
								  <td class="flex">
									<?php echo $row_product['productname']; ?>
									
								  </td>	
								  
                                <td class="flex">
                                    <input type="text" name="sortid[]" value="<?php echo $row['sortid'];?>" size="2" />
                                    <input name="ids1[]" type="hidden" value="<?php echo $row['id']; ?>" /> 
                                </td>         
							    <td class="flex">
							        
							        <div class="item-action dropdown">
                                        <a href="#" data-toggle="dropdown" class="text-muted"><i data-feather="more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right bg-black" role="menu"> 
                                            <?php if($row['displayflag']==1) { ?>
											    <a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&pid=<?php echo $_REQUEST['id'];?>&status=0&link=product-image.php&tb=<?php echo $sufix; ?>imageupload&option=id">Disable</a> 
											<?php } elseif($row['displayflag']==0) { ?>												
												<a class="dropdown-item edit" href="enable_disable_process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&pid=<?php echo $_REQUEST['id'];?>&status=1&link=product-image.php&tb=<?php echo $sufix; ?>imageupload&option=id">Enable</a>
											<?php } ?>
											
											<a class="dropdown-item edit" href="delete-process.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&pid=<?php echo $_REQUEST['id'];?>&status=1&link=product-image.php&tb=<?php echo $sufix; ?>imageupload&option=id" onclick="return confirm('Are you sure to delete this?')" >Delete</a>
			 
                                        </div>
                                    </div>	
							    </td>
						</tr> 
					<?php } ?>	
								
						
							 	
								<?php }						
												
								else 
								{
									echo "<tr class='v-middle' data-id='15'><td colspan='5' class='error-message'><div align='center'>NO RECORD FOUNDS HERE!!!</div></td></tr>";
								 }
							 ?>	
							 
							 
					 </tbody>
	            </table>
	            <table>
	                <tbody>
	                    <tr class="v-middle" data-id="15">
						    <td class="flex"></td>
							<td class="flex">
							    <button type="button" onclick="upimage();" class="btn  bg-primary-lt pull-right">Update Main Image</button> 
						    </td>
						    <td class="flex"></td>
						    <td class="flex"></td>
							<td class="flex">
							    <button type="button" onclick="upsort();" class="btn  bg-primary-lt pull-right">Update Sorting</button> 
							</td>
						</tr>
	                    
	                </tbody>
	            </table>
					            </form>
                                </div>
                            </div> 
                        </div>
                    </div>  
            </div>
        </div> --->
    </div> 
</div>
 
