

<style>

.columns-container.page_not_found p {

    color: #ddd;

    font-size: 50px;

    padding-bottom: 50px;

    padding-top: 130px;

    text-align: center;

}



.columns-container.page_not_found a {

    border: 1px solid #fd337f;

    float: none;

    font-size: 20px;

    font-weight: normal;

    height: auto;

    line-height: normal !important;

    margin: 0 auto 100px;

    padding: 17px 20px;

    text-align: center;

    width: auto;

}

.columns-container.page_not_found a:hover{ background:none; border:1px solid #fd337f; color:#fd337f;}

</style>
<div class="container" style="margin-top:1%;">

  
<div class="text1" style="background-color: #fff; height: 100%;"><center>
<h1 style="font-size: 24px; background: #fff; color: #d09c01;">Oops! This is Awkward</h1>
<br />
<h1 style="font-size: 72px; height: 72px; background: #fff; color: #d7d7d7;">404</h1>
<br />
<h1 style="font-size: 15px; background: #fff; color: #000;">We are sorry, but the page you were looking for can`t be found. Don`t worry though,<strong> we will help get you to the right place.</strong></h1>
<br />
<h1 style="font-size: 15px; background: #fff; color: #000;">Here are some things you might find helpful:</h1>
</center><br />

</div>
</div>
<httpErrors>

       <remove statusCode="401" subStatusCode="-1" />

       <remove statusCode="403" subStatusCode="-1" />     

       <remove statusCode="404" subStatusCode="-1" />               

       <remove statusCode="500" subStatusCode="-1" />

          <!-- full url when responsemode is Redirect -->

       <error statusCode="401" path="http://foo.com/default.htm" responseMode="Redirect" />

          <!-- local relative path when responsemode is ExecuteURL -->

       <error statusCode="403" path="/errors/403.htm" responseMode="ExecuteURL" />

       <error statusCode="404" path="/somedir/oops404.htm" responseMode="ExecuteURL" />               

       <error statusCode="500" path="/somedir/500.asp" responseMode="ExecuteURL" />

</httpErrors>
<script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> 

<script>
$(document).ready(function(){
	setTimeout(function () {
   window.location.href= '<?php echo URL;?>'; // the redirect goes here

},5000);
	}); 
</script>

