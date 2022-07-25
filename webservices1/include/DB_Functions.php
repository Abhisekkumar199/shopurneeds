<?php
class DB_Functions {
    private $db;
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();

        $this->db->connect();
        
    }



    // destructor

    function __destruct() {

         

    }



    /**
	 * access public
	 * param ($fname,$lName,$email,$password)
     * Storing new user
     * returns user details
     */

    public function customerRegistration($fname,$lName,$email,$mobile,$password,$referralcode) {       

		$result = mysql_query("INSERT INTO shopurneeds_user_registration(fname,lname,emailid,password,email_hash,billing_mobile,displayflag,referalcode,adddate,addtime,wallet) VALUES('".$fname."','".$lName."', '".$email."', '".$password."','".base64_encode($email)."','".$mobile."','1','".$referralcode."',NOW(),NOW(),'50')") or die(mysql_error());
        // check for successful store
		
        if ($result) {

			$inserid=mysql_insert_id();
		    	$basketstatsude=mysql_query("insert into shopurneeds_user_wallet(user_id, orderid,`type`,credit,adddate) values('".$inserid."','','Registration Wallet','50',NOW())");

			$result12 = mysql_query("SELECT * FROM shopurneeds_user_registration WHERE id = \"$inserid\"");

			$result122 = mysql_fetch_array($result12);
	
			return $result122;

        } else {

            return false;

        }

    }

public function forgotpasswordsms($mobileno,$random) {       

	$str="Someone recently requested a password change for your shopurneed User account. Please use reset code ".$random;
$message=urlencode($str);


$username="shopurneeds";

$password="shopurneeds123@";

$senderid="SHOPUR";

$numbers=$mobileno;

 
 $url="http://sms.webkype.in/sms_api/sendsms.php?username=$username&password=$password&message=$message&sendername=$senderid&mobile=$numbers"; 

$ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $response = curl_exec($ch);	


    }
    
    public function sendordermsg($mobileno,$str) {       


	$message=urlencode($str);


$username="shopurneeds";

$password="shopurneeds123@";

$senderid="SHOPUR";

$numbers=$mobileno;

 
 $url="http://sms.webkype.in/sms_api/sendsms.php?username=$username&password=$password&message=$message&sendername=$senderid&mobile=$numbers"; 

$ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $response = curl_exec($ch);	


    }
	
	public function editProfileUserById($userId,$fname,$lname) { 
		
		 $result = mysql_query("UPDATE shopurneeds_user_registration set `fname`='".$fname."',`lname`='".$lname."' where id='".$userId."'") or die(mysql_error()); 

		// check for successful store

		if ($result) { 

						
				return true;

		} else {

				return false;

		}

	}
	

	public function validateUserBymobile($mobile) {       

        $result = mysql_query("SELECT * FROM buyde_user_registration WHERE billing_mobile = '$mobile'") or die(mysql_error());

        // check for result 

        $no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {

            $result = mysql_fetch_array($result);

			$oror=rand(100,999);

			$oror1=rand(100,999);

			$otpcds=$oror1.$oror;

			$resultsdf = mysql_query("update buyde_user_registration set fpassotp='$otpcds' WHERE id = '".$result['id']."'") or die(mysql_error());

			$str= $result['fname']." Welcome to the Mallfort.com. Your OTP is ".$otpcds;

			$message=urlencode($str);

			$username="mallfort";

			$password="39256";

			$senderid="MLLFRT";

			$numbers=$mobile;

			$url="http://smsleads.in/pushsms.php?username=$username&password=$password&message=$message&sender=$senderid&numbers=$numbers"; $ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $responsess = curl_exec($ch); 

			        $result12 = mysql_query("SELECT * FROM buyde_user_registration WHERE id = '".$result['id']."'") or die(mysql_error());

            $result12 = mysql_fetch_array($result12);



                return $result12;

        } else {

            // user not found

            return false;

        }

    }

	public function validateRegBymobile($mobile) {       

        $result = mysql_query("update  buyde_user_registration set displayflag='1',approveflag='1' WHERE billing_mobile = '$mobile'") or die(mysql_error());
     
		$result12 = mysql_query("SELECT * FROM buyde_user_registration WHERE billing_mobile = '".$mobile."'") or die(mysql_error());

		$no_of_rows = mysql_num_rows($result12);

        if ($no_of_rows > 0) {

             return mysql_fetch_array($result12);

        } else {

            // user not found

            return false;

        }

    }



/*	public function getTopCategory($catids) {       
    $categorySql = mysql_query("SELECT `cat_id`,`categoryname`,`uploadimage` FROM `buyde_category` WHERE `displayflag` = '1'") or die(mysql_error());
    $no_of_rows = mysql_num_rows($categorySql);
        if ($no_of_rows > 0) {
           return mysql_fetch_array($categorySql);
        } else {
            // user not found
            return false;
        }
    }
*/		

	

	public function changeUserpassword($userId,$oldPassword,$newPassword) {       

		$result12 = mysql_query("SELECT * FROM shopurneeds_user_registration WHERE password = '".$oldPassword."' and id='".$userId."'") or die(mysql_error());

		$no_of_rows = mysql_num_rows($result12);

        if ($no_of_rows > 0) {
				$update = mysql_query("UPDATE shopurneeds_user_registration set password='".$newPassword."' where id='".$userId."'");
                return true;

        } else {

            // user not found

            return false;

        }

    }

    /**
	
     * Get user by (email or mobile)and password

     */

    public function getUserByEmailAndPassword($email,$password) {
        
        
        $result = mysql_query("SELECT * FROM `shopurneeds_user_registration` WHERE `password`='".$password."' and is_verified='1' and  (`emailid`='".$email."' or billing_mobile='".$email."') ") or die(mysql_error());

        // check for result 

        $no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {
		
			$chsql = mysql_query("SELECT * FROM shopurneeds_user_registration WHERE password='".$password."' and  (emailid = '".$email."' or billing_mobile='".$email."') ");		

			$result = mysql_fetch_array($chsql); 
			return $result;

        } else { 
            // user not found
			return false;
        }

    }



    /**

     * Check user is existed or not

     */

    public function isUserExisted($email,$mobile) {
        $result = mysql_query("SELECT emailid from shopurneeds_user_registration WHERE emailid ='".$email."' or billing_mobile='".$mobile."'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



    /**

     * Encrypting password

     * @param password

     * returns salt and encrypted password

     */
      public function isSellerExisted($email) {
        $result = mysql_query("SELECT emailid FROM shopurneeds_suppliers WHERE emailid = '".$email."'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }
     	public function storeSeller($fname,$mobile, $email,$companyname,$password) { 
		$result = mysql_query("insert into `shopurneeds_suppliers` (`fname`,`password`,`emailid`,`mobile1`, `ppincode`,`othermarket`,`sellertype`,`noofsku`,`perinventory`,`cat_id`,`displayflag`,`approveflag`,`adddate`,`ptime`,suppliername) values ('".$fname."','".$password."', '".$email."','".$mobile."','','','','','','', '1','1', '".date("Y-m-d")."', '".date("H:i:s")."','".$companyname."')");
		
$isds=mysql_insert_id();
if ($result) {
			return true;
        } else {
            return false;
        }
    }


    public function hashSSHA($password) {



        $salt = sha1(rand());

        $salt = substr($salt, 0, 10);

        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);

        $hash = array("salt" => $salt, "encrypted" => $encrypted);

        return $hash;

    }



    /**

     * Decrypting password

     * @param salt, password

     * returns hash string

     */

    public function checkhashSSHA($salt, $password) {



        $hash = base64_encode(sha1($password . $salt, true) . $salt);



        return $hash;

    }

	

	public function getProductByCatidAndBrand($catid,$brand,$ksearch,$page,$price) {

		$catid1 = (!empty($catid)) ? " and cat_id='".$catid."'" : "";

		$brand1 = (!empty($brand)) ? " and bid='".$brand."'" : "";

		$ksearch1 = (!empty($ksearch)) ? " and MATCH(productname) AGAINST ('".$ksearch."' IN BOOLEAN MODE)" : "";

		$sellingprice = (!empty($sellingprice)) ? " and sellingprice between '".$price."' " : "";

		$lk = $page;

		$ed = $lk*20;

		$st = $ed-20;

		if($page!='') { 

			$limit = " limit $st,20";

		}
		$result = mysql_query("select * from buyde_product where displayflag='1' {$ksearch1} {$catid1} {$brand1}{$sellingprice} {$limit}");

			$no_of_rows = mysql_num_rows($result);

			if ($no_of_rows > 0) {

					return $result;

			} else {

				// user not existed

				return false;

			}

	}

	public function getProductDetailsForview($pid) {

		$result = mysql_query("select * from shopurneeds_product where displayflag='1' and id='".$pid."'");

		$no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {

				return mysql_fetch_array($result);

        } else {

            // user not existed

            return false;

        }

	}
	
	
	  public function getSellerByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM shopurneeds_suppliers WHERE emailid = '".$email."'  and password='".$password."' and displayflag='1'") or die(mysql_error());

        // check for result 

        $no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {
		
           $result2 = mysql_fetch_array($result); 
			return $result2;


        } else { 
            // user not found
			return false;
        }

    }


	public function getProductDetailsForviewByCategory($catid) {

		$result = mysql_query("select * from buyde_product where displayflag='1' and cat_id='".$catid."'");

		$no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {

				return mysql_fetch_array($result);

        } else {

            // user not existed

            return false;

        }

	}
	

	public function getProductCartDetails($pid) {

		$result = mysql_query("select * from buyde_product where displayflag='1' and id='".$pid."'");

		$no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {

				return mysql_fetch_array($result);

        } else {

            // user not existed

            return false;

        }

	}
	
	
	#-----------------------------------------------------------------------------Add To Cart
	
	public function addToCart($pid) {
	    
		$result = mysql_query("select * from shopurneeds_product where displayflag='1' and id='".$pid."'");
	
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

				return mysql_fetch_array($result);

        } else {

            // user not existed

            return false;

        }

	}
		
	public function userDetailsEnquiryById($clientId) {	
		$result = mysql_query("select * from shopurneeds_user_registration where id='".$clientId."'");
		
		$no_of_rows = mysql_num_rows($result);
			if ($no_of_rows > 0) {

					return mysql_fetch_array($result);

			} else {

				// user not existed

				return false;

			}

	}
	
	
	
	public function notificationEnquiryByUserId($userid) {	
	
		$result = mysql_query("select * from shopurneeds_notification_message where displayflag='1' order by id desc");
	
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
				return $result;
        } else {
            // user not existed
            return false;
        }

	}
	
	
	
	public function addBusinessListingByUserId($userId,$businessCategory,$businessSubCategory,$businessName,$contactPerson,$contactNumber,		$contactEmail,$contactAddress,$description,$businessLogo,$businessVisitingCard,$state,$city) {
	
		$explode = explode(',',$businessSubCategory);
	
		for($i=0;$i<count($explode);$i++) { 

			$subCategorySQL = mysql_query("select * from shopurneeds_listing_subcategory where list_catid='".$businessCategory."' and listing_subcat_name='".trim($explode[$i])."'");
			while($subCategoryRows = mysql_fetch_assoc($subCategorySQL)) { 
			$subcategryid[]= $subCategoryRows['id'];
		}
	}

	
		$subcategryid2 = implode(',',$subcategryid); 
	
		$result = mysql_query("INSERT INTO shopurneeds_business_listing (`user_id`,`businesstype`, `businesstype_subcategory`,`business_name`,`contact_person`,`contact_number`,`contact_email`,`contact_address`,`business_category`,`description`,`state_id`,`city`,`adddate`) VALUES ('".$userId."','".$businessCategory."', '".$subcategryid2."', '".$businessName."','".$contactPerson."','".$contactNumber."','".$contactEmail."','".$contactAddress."','".$businessCategory."','".$description."','".$state."','".$city."',NOW())");

        // check for successful store
		$lastId = mysql_insert_id();
		if ($result) {

			if($businessLogo!='') { 
				define('UPLOAD_PATH', '../userlogo/');
				$imagename = time().$businessLogo;
				move_uploaded_file($_FILES['businessLogo']['tmp_name'], UPLOAD_PATH . $imagename);
				$update = mysql_query("UPDATE shopurneeds_business_listing set logo='".$imagename."'  WHERE id = \"$lastId\"");
			}


			if($businessVisitingCard!='') { 
				define('UPLOAD_PATH2', '../visitingcardimages/');
				$imagename2 = time().$businessVisitingCard;
				move_uploaded_file($_FILES['businessVisitingCard']['tmp_name'], UPLOAD_PATH2 . $imagename2);
				$update = mysql_query("UPDATE shopurneeds_business_listing set visiting_card='".$imagename2."'  WHERE id = \"$lastId\"");
			}
							
					return true;

		} else {

					return false;

		}
	}
	
	public function labWorkshowListingById($userId,$city,$category,$subCategory) {
		if($city!='') { 
			$city2 = " and city='".$city."'";
		} 
		if($category) { 
			$category2 = " and businesstype='".$category."'";
		}
	
	
	
		$subcategory22 = mysql_fetch_assoc(mysql_query("select id from  shopurneeds_listing_subcategory where listing_subcat_name='".$subCategory."' and list_catid='".$category."'"));
		$subcategory2 = $subcategory22['id'];
		if($subcategory22['id']!='') { 
			$subcategory23 = $subcategory22['id'];
		} else { 
			$subcategory23 = '0';
		}  
	
		if($subCategory) {
			$subCategory2 = " and businesstype_subcategory like '%$subcategory23%'";
		}
		$result = mysql_query("SELECT * FROM shopurneeds_business_listing WHERE displayflag='1'{$city2}{$category2}{$subCategory2} order by id desc");
		$num = mysql_num_rows($result);
		if ($num>0) {
			return $result;
		} else { 
			return false;
		}
	}
	
	public function manufacterListingById($userId,$city,$category,$subCategory) {
		if($city!='') { 
			$city2 = " AND city='".$city."'";
		} 
		if($category!='') { 
			$category2 = " AND businesstype='".$category."'";
		}
	
	
	
		$subcategory22 = mysql_fetch_assoc(mysql_query("select id from  shopurneeds_listing_subcategory where listing_subcat_name='".$subCategory."' and list_catid='".$category."'"));
		$subcategory2 = $subcategory22['id'];
		if($subcategory22['id']!='') { 
			$subcategory2 = $subcategory22['id'];
		} else { 
			$subcategory2 = '0';
		}  
		if($subCategory!='') {
			$subCategory2 = " AND businesstype_subcategory like '%$subcategory2%'";
		}
		$result = mysql_query("SELECT * FROM shopurneeds_business_listing WHERE displayflag='1' AND businesstype='3' {$city2}{$category2}{$subCategory2} order by id desc");
		$num = mysql_num_rows($result);
		if ($num>0) {
			return $result;
		} else { 
			return false;
		}
	}
	

	
	public function paymentListingById($userId) {
		$result = mysql_query("SELECT * FROM shopurneeds_package WHERE displayflag='1'");
		if ($result) {
			return $result;
		} else { 
			return false;
		}
	}
	
	public function userProfileDetailsById($userId) { 
		$result = mysql_query("SELECT * FROM shopurneeds_user_registration WHERE id='".$userId."'");
		if ($result) {
			return mysql_fetch_array($result);
		} else { 
			return false;
		}
	}
	
	public function userEditProfileDetailsById($userId) { 
		$result = mysql_query("SELECT * FROM shopurneeds_user_registration WHERE id='".$userId."'");
		if ($result) {
			return mysql_fetch_array($result);
		} else { 
			return false;
		}
	}
	
	public function updateVistingCardById($userId,$visitingCard) {
		if($visitingCard!='') { 
			define('UPLOAD_PATH', '../visitingcardimages/');
			$imagename = time().$visitingCard;
			move_uploaded_file($_FILES['visitingCard']['tmp_name'], UPLOAD_PATH . $imagename);
			$update = mysql_query("UPDATE shopurneeds_user_registration set visiting_card='".$imagename."'  WHERE id = \"$userId\"");
			return true;
		} else {

            return false;

        }
	}
	
	
	public function getUserDetailsById($userId) { 
		$result = mysql_query("SELECT * FROM shopurneeds_user_registration WHERE id='".$userId."'");
		if ($result) {
			return mysql_fetch_array($result);
		} else { 
			return false;
		}
	}
		public function getSellerDetailsById($sellerid) { 
		$result = mysql_query("SELECT * FROM shopurneeds_suppliers WHERE id='".$sellerid."'");
		if ($result) {
			return mysql_fetch_array($result);
		} else { 
			return false;
		}
	}
	
	
	public function getFavouriteEnquiryList($userId) {
	
		$result = mysql_query("SELECT * FROM shopurneeds_favorite_product where  user_id='".$userId."' ORDER BY id DESC");
	
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

				return $result;

        } else {

            // user not existed

            return false;

        }
	}
	
	public function resetPassword($oldPassword,$newPassword,$emailId) {
		$select  = mysql_query("select id from shopurneeds_user_registration where `emailid`='".$emailId."' and `commcode`='".$oldPassword."' and `commcode`!=''");
		if(mysql_num_rows($select)>0) {
			$update = mysql_query("update shopurneeds_user_registration set password='".$newPassword."' where emailid='".$emailId."'");
			return true;
		} else {
			return false; 
		}
	}
	
	public function getUserType($userId) {
		$select  = mysql_query("select * from shopurneeds_user_registration where `id`='".$userId."'");
		if(mysql_num_rows($select)>0) {
			return mysql_fetch_assoc($select);
		} else { 
			return false; 
		}
	}
	
	public function getAllCustomer($userId) {
		$select  = mysql_query("select * from shopurneeds_user_registration where android_token!='' and device_name='Android'");
		if(mysql_num_rows($select)>0) {
			return $select ;
		} else { 
			return false; 
		}
	}
	public function getAllCustomerios($userId) {
		$select  = mysql_query("select * from shopurneeds_user_registration where ios_token!='' and device_name='ios'");
		if(mysql_num_rows($select)>0) {
			return $select ;
		} else { 
			return false; 
		}
	}
	
	/*
	 * access public
	 * param ($sellerId)
	 * return boolean true/false
	 * using for show details
	 */
	 
	public function sellerDetailById($sellerId){
	    
		
		$sellerRes=mysql_query("SELECT * from shopurneeds_suppliers where id='".$sellerId."' and displayflag='1'") or die(mysql_error());
		
		if(mysql_num_rows($sellerRes)>0){
			
			return mysql_fetch_assoc($sellerRes);
			
			
		}else{
			return false;
		}
	}
	
	/*
	 * access public
	 * param ($sellerId)
	 * return type boolean (true/false)
	 * using for seller about detail
	 */
	public function sellerAboutDetailById($sellerId){
		$sellerAboutRes=mysql_query("SELECT aboutus from shopurneeds_suppliers where id='".$sellerId."' ");
		if(mysql_num_rows($sellerAboutRes)>0){
			return mysql_fetch_assoc($sellerAboutRes);
		}else{
			return false;
		}
	}
	
	/*
	 * access public
	 * param ($sellerId)
	 * return type boolean (true/false)
	 * using for seller facilities
	 */
	public function sellerServiceDetailById($sellerId){
		$sellerServiceRes=mysql_query("SELECT customerservice from shopurneeds_suppliers where id='".$sellerId."' ");
		if(mysql_num_rows($sellerServiceRes)>0){
			return mysql_fetch_assoc($sellerServiceRes);
		}else{
			return false;
		}
	}
	
	/*
	 * access pubic
	 * param ($userId,$sellerId,$name,$rating,$comment)
	 * return type boolean true/false
	 * using for add reviews for particular seller
	 */
	 public function addSellerReview($userId,$sellerId,$name,$emailid,$rating,$comment){
	     
	     
	     $reviewAdd=mysql_query("insert into shopurneeds_seller_review set user_id='".$userId."',seller_id='".$sellerId."',user_emailid='".$emailid."',rating='".$rating."',user_name='".mysql_real_escape_string($name)."',message='".mysql_real_escape_string($comment)."',adddate='".date('Y-m-d')."'") or die(mysqli_error());
		 if($reviewAdd){
			 return true;
		 }else{
			 return false;
		 }
	 }
	 
	 /*
	  * access public
	  * params ($sellerId)
	  * return type boolean true/false
	  * using for fething all reviews for particular seller
	  */
	public function getReviewBySellerId($sellerId){
	   
		$reviewRes=mysql_query("select * from shopurneeds_seller_review where seller_id='".$sellerId."' order by id DESC ") or die(mysql_error());
		if(mysql_num_rows($reviewRes)>0){
			
			return $reviewRes;
		}else{
			return false;
		}
		
	}
	
	/*
	 * access public
	 * param ($otp,$email,$password)
	 * return type boolean true/false
	 * using for reset password by otp
	 */
		 
	public function resetPasswordByOtp($otp,$emailId,$password) {
	    
	    
		$select  = mysql_query("select id from shopurneeds_user_registration where  `commcode`='".$otp."'");
		if(mysql_num_rows($select)>0) {
			$update = mysql_query("update shopurneeds_user_registration set password='".$password."' ,commcode='' where commcode='".$otp."'");
			return true;
		} else {
			return false; 
		}
	}
	/*
	 * access public
	 * param 
	 * return boolean true/false
	 * using for getting restraunt list
	 */
	public function getAllRestaurant(){
				
		$resRes=mysql_query("SELECT * FROM `shopurneeds_suppliers` order by id limit 0,5");
		if(mysql_num_rows($resRes)>0){
			return $resRes;
		}else{
			 return false;
		}
		
	}
	
	/*
	 * access public
	 * param ($lat,$long,$sortby)
	 * return boolean true/false
	 * using for getting restraunt list by lotitude and longitude
	 */
	public function getAllRestaurantByLatLong($lat,$long,$sortby,$sellerType,$catid){
	    
	    
	    if($sortby!=""){
	        
	        $sortby1= " ORDER BY ".$sortby." ASC";
	        
	    }else{
	        $sortby1 = " ORDER BY id ASC";
	    }
	    
	    if($sellerType!=""){
	        
	        $sellerType1= " and sellertype='".$sellerType."'";
	        
	    }
	    
	    if($catid!=""){
	        
	        $catidseller= " and cat_id like '%".$catid."%'";
	        
	    }
	    

	
		
		$resRes=mysql_query("SELECT *, ( 3959 * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) AS distance FROM shopurneeds_suppliers WHERE `displayflag`='1' {$catidseller} {$sellerType1} HAVING distance <=15 {$sortby1}");
		if(mysql_num_rows($resRes)>0){
			return $resRes;
		}else{
			 return false;
		}
	}
		
	/*
	 * access public
	 * param ($mobile)
	 * return type boolean (true/false)
	 * using for checking mobile no is exist or not
	 */
	 
	  public function isUserMobileExist($mobile){
	     
	     $sqlRes=mysql_query("select billing_mobile from shopurneeds_user_registration where billing_mobile='".$mobile."' ");
	     
	     if(mysql_num_rows($sqlRes)>0){
	         return true;
	         
	     }else{
	         return false;
	     }
	     
	 }
	
	 /* 
	  * access public
	  * param ($fullname,$email,$mobile)
      * return type boolean(true/false) or mysql_result
      * using for google singup
      */
    public function googleSignup($fullname,$email){
        
        $expName = explode(" ",$fullname);
        
        $userRegRes=mysql_query("insert into shopurneeds_user_registration set `fname`='".$expName[0]."',`lname`='".$expName[1]."',`emailid`='".$email."', `isgoogle`=1,`billing_mobile`='".$mobile."', `displayflag`='1'");
        
        if($userRegRes){
            
            $last_id = mysql_insert_id();
            
            $userDetRes=mysql_query("select * from shopurneeds_user_registration where id='".$last_id."' ");
            
            return mysql_fetch_assoc($userDetRes);
            
        }else{
            return false;
        }
        
      
    }
		
	
	 
	#--------------------------------------------------------------------------Closed---------------------
	
	//get lat and long from address

    public function get_lat_long($address){

			$address = str_replace(" ", "+", $address);

			$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
			$json = json_decode($json);

			$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
			$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
			
			$latlong=array("lat"=>$lat,"lon"=>$long);
			return $latlong;
	}
	
	//convert degree to radian
	public function degrees_to_radians($degrees)
		{
		  return $degrees * (3.14/180);
		}
	//distance calculate from two locations
    public function distanceCalculate($lat1,$lat2,$lon1,$lon2){
    		//earth radius
    		$R=6371; //kms
    		
    		$a1=$this->degrees_to_radians($lat1);
    		$a2=$this->degrees_to_radians($lat2);
    		
    		$rad1=$this->degrees_to_radians($lat2-$lat1);
    		$rad2=$this->degrees_to_radians($lon2-$lon1);
    		
    		$a=sin($rad1/2) * sin($rad1/2) + cos($a1) * cos($a2) *sin($rad2/2) *sin($rad2/2);
    		$c=2*atan2(sqrt($a),sqrt(1-$a));
    		$d=$R*$c;
    		return $d;
    	
    	}
    	
    	
    	public function getdeliveryboybyusername($mobileno, $password) {
        $result = mysql_query("SELECT * FROM shopurneeds_driver WHERE driver_mobile = '".$mobileno."'  and password='".$password."' and displayflag='1'") or die(mysql_error());

        // check for result 

        $no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {
		
           $result2 = mysql_fetch_array($result); 
			return $result2;


        } else { 
            // user not found
			return false;
        }

    }
    
    
    public function getdeliveryboybyid($deliveryboyid, $lat,$lon) {
        $result = mysql_query("SELECT * FROM shopurneeds_driver WHERE id = '".$deliveryboyid."'  and displayflag='1'") or die(mysql_error());

        // check for result 

        $no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {
		
           $result2 = mysql_fetch_array($result); 
           $sqlssa=mysql_query("update shopurneeds_driver set lat='".$lat."', lon='".$lon."' where id='".$deliveryboyid."'");
			return $result2;


        } else { 
            // user not found
			return false;
        }

    }

    
    
    

}



?>

