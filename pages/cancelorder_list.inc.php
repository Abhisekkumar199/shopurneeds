
<div id="content"> 
    <div class="container">  <div class="da_dashboard" style="margin-top:140px;"> 
       <?php include("includes/left_account.php"); ?>
        
         
            <!--left dashboard sidebar starts here--> 
            <!--left dashboard sidebar ends here--> 
            <!--right dashboard starts here-->
            <div class="da_right_board fleft">
              <h1><img src="images/fav-showroom.png"> Cancelled Orders
                <p class="pull-right">Welcome :
                  <?php if($_SESSION['fnamenew']!='') { echo $_SESSION['fnamenew']; } else { echo "GUEST"; } ?>
                </p>
              </h1>
              <span style="color:#FF0000; float: right; margin-top: -30px;"><?php echo session_msg(); ?></span>
              <form name="order" id="order" method="post" action="#" class="table-responsive">
                <table width="100%" cellpadding="2" cellspacing="2" border="0" class="table footable">
                  <tr>
                    <td   width="10%" align="left" class="grid">Order ID<br /></td>
                    <td width="15%" align="left" class="grid">Order Value<br />
                    <td width="10%" align="left" class="grid"> Status</td>
                  </tr>
                  <?php
        		$result = mysqli_query($conn,"select * from ".$sufix."order where userid = '".$_SESSION['emailid']."' and approve_status='Cancelled'") ;
        		$num = mysqli_num_rows($result);
        											if($num > 0)
                                                    {
                                                        while($row22=mysqli_fetch_array($result))
                                                        {       
        											         $id=$row22['oid'];
            											                 
                                                    ?>
                  <tr>
                    <td align="left" width="10%" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo $id; ?></td>
                    <td width="15%" align="left" valign="top" bgcolor="#FFFFFF" class="txt"><?php echo Currency." ".number_format($row22['totalcost'],2); ?></td>
                    
                    <td align="left" valign="top" width="10%" bgcolor="#FFFFFF" class="txt" style="color:#FF0000;"><?php echo $row22['approve_status']; ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="8"><!--  <input name="printo" type="button" id="printo" value="Print" class="button">--></td>
                  </tr>
                  <?php }  
                                        else //
                                        {
                                  echo "<tr bgcolor='White'><td colspan='9' class='error-message'><div align='center'><p style='color:red;'>NO RECORD FOUNDS HERE!!!</p></div></td></tr>";
        
                                         }
                                     ?>
                </table>
              </form>
              <div> </div>
            </div>
            <!--right dashboard ends here-->
            <div class="clear"></div>
          </div>
        </div>
    </div>
</div> 
<style>
@media (max-width: 640px) {
    .table{    width: 800px;}
	.da_dashboard{ width:100%; padding:0; margin-top:10px;}
	.da_left_dash {
    border-right: 0 none;
    padding-right: 0;
    width: 100%;
}
.da_left_dash ul li a{ text-align:center;}
.da_right_board {
    padding: 0 15px;
    width: 100%;
}
.da_dashboard_cont {
    float: left;
    width: 100%;
}	
	.da_right_board h1 p {
    float: left;
    margin-top: 20px;
    width: 100%;
}
.da_more_info_container .da_onehalf.fleft {
    float: left;
    width: 100%;
}
table td {
    border: 0 none !important;
}
.table-responsive{ border:0 !important}
	}
	table td {
    border: 0 none !important;
}
</style>
