<?php 
      
    	$sql_rec = mysqli_query($conn,"select * from ".$sufix."user_registration where id='".$_REQUEST['id']."'") ;
    	$rows = mysqli_fetch_assoc($sql_rec); 
    	$option="Edit"; 
       
?>
<div id="content" class="flex"> 
    <!-- ############ Main START-->
    <div>
        <div class="page-hero page-container" id="page-hero">
            <div class="padding d-flex">
                <div class="page-title">
                    <h2 class="text-md text-highlight">User Wallet</h2>
                </div>
                <div class="flex"></div> 
            </div>
        </div>
        <div class="page-content page-container" id="page-content">
            <form name="addForm" id="addForm" action="user_wallet_process.php?option=<?php echo $option; ?>" method="POST" enctype="multipart/form-data"> 
             
            <div class="padding"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="col-md-3"> 
                                    <span id="message"> <?php echo $_SESSION["sessionMsg"]; ?> </span>
                                </div>
                                <div class="col-md-9"> 
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" name="userid" value="<?php echo $rows["id"]; ?>" />
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cname" id="" value="<?php echo $rows['fname']; ?>" class="form-control" placeholder="Title" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Emailid</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="emailid" id="" value="<?php echo $rows['emailid']; ?>" class="form-control" placeholder="Title" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Wallet</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="wallet" id="" value="<?php echo $rows['wallet']; ?>" class="form-control" placeholder="Title" readonly>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Credit</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="credit" id="" value="0" class="form-control" placeholder="Title">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Debit</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="debit" id="" value="0" class="form-control" placeholder="Title">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Orderid</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="orderid" id="" value="" class="form-control" placeholder="Orderid">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Reason</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="reason" id="" value="" class="form-control" placeholder="Reason">
                                    </div>
                                </div>
                                
                                
                                 
                                <button type="submit" class="banner btn w-sm mb-1 btn-success" style="float: right; margin-right: 12px;">SAVE</button> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>  
            
            </form>
        </div> 
        
        
         <div class="page-content page-container" id="page-content">
            
            <div class="padding"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="card"> 
                             <div class="card-header">
                                 <h4>Wallet History</h4>
                             </div>
                            <div class="card-body"> 
                               
                                
                                <table class="table table-theme table-row v-middle">
                                <thead>
                                    <tr>
                                        <th style="width:20px">
                                            <label class="ui-check m-0">
                                            <input type="checkbox"><i></i></label>
                                        </th> 
                                        <th class="text-muted">ID</th> 
                                        <th class="text-muted">Order Number</th>  
                                        <th class="text-muted">Reason</th>  
                                        <th class="text-muted">Credit</th>  
                                        <th class="text-muted">Debit</th>  
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $sqlusewal=mysqli_query($conn,"select * from `".$sufix."user_wallet` where user_id='".$_REQUEST['id']."' order by id desc");
										 
                                        if(mysqli_num_rows($sqlusewal) > 0)
										{ 
											while($row=mysqli_fetch_array($sqlusewal))
											{		 								
									?> 
                                    <tr class="v-middle" data-id="15">
                                        <td>
                                            <label class="ui-check m-0">
                                            <input type="checkbox" name="id[]" value="<?php echo $row['id']; ?>"  > <i></i></label>
                                        </td>
                                         
                                        <td class="flex"><?php echo $row['id'];	?></td>
                                        <td class="flex"><?php echo $row['orderid'];	?></td>
                                        <td class="flex"><?php echo $row['type'];	?></td>
                                        <td class="flex"><?php echo $row['credit'];	?></td>
                                        <td class="flex"><?php echo $row['debit'];	?></td>
                                         
                                        
                                    </tr>
                                    <?php } } ?> 
                                     
                                </tbody> 
                            </table>
                                 
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>  
            
             
        </div> 
        
        
    </div> 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('.banner').click(function(){ 
	var title = $('#title').val();   
	var sku_ids = $('#sku_ids').val();    
	
	if(title == '')
	{  
		$('#title').css("border","1px solid red");
		$('#title').focus();
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter title</div>");
		return false;
	}
	else
	{ 
		$('#title').css("border","1px solid #bdb9b9"); 
	} 
    
    
    if(sku_ids == '')
	{  
		$('#sku_ids').css("border","1px solid red");
		$('#sku_ids').focus(); 
		$('#message').html("<div class='alert alert-danger' role='alert'>Please enter sku</div>");
		return false;
	}
	else
	{ 
		$('#sku_ids').css("border","1px solid #bdb9b9"); 
        $('#message').html("");
	}  
	
	
     
	 
}); 
</script> 