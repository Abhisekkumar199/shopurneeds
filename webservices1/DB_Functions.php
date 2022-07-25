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

    public function customerRegistration($fname,$lName,$email,$password) {       

		$result = mysql_query("INSERT INTO olio_user_registration(fname,lname,emailid, password,email_hash) VALUES('".$fname."','".$lName."', '".$email."', '".md5($password)."','".base64_encode($email)."')") or die(mysql_error());
        // check for successful store
		
        if ($result) {

			$inserid=mysql_insert_id();

			$result12 = mysql_query("SELECT * FROM olio_user_registration WHERE id = \"$inserid\"");

			$result122 = mysql_fetch_array($result12);
	
			return $result122;

        } else {

            return false;

        }

    }

	
	public function editProfileUserById($userId,$fname,$lname,$email,$birthday,$address,$userLogo,$mobileNo) { 
		
		 $result = mysql_query("UPDATE olio_user_registration set `fname`='".$fname."',`lname`='".$lname."', emailid='".$email."', dob='".$birthday."', `billing_address`='".mysql_real_escape_string($address)."',billing_mobile='".$mobileNo."' where id='".$userId."'") or die(mysql_error()); 

		// check for successful store

		if ($result) {

			if($userLogo!='') { 
				define('UPLOAD_PATH', '../userlogo/');
				$imagename = time().$_FILES['userLogo']['name'];
				if(move_uploaded_file($_FILES['userLogo']['tmp_name'], UPLOAD_PATH . $imagename)){
					$update = mysql_query("UPDATE olio_user_registration set user_image='".$imagename."'  WHERE id = \"$userId\"");
				}
			}
						
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

		$result12 = mysql_query("SELECT * FROM olio_user_registration WHERE password = '".md5($oldPassword)."' and id='".$userId."'") or die(mysql_error());

		$no_of_rows = mysql_num_rows($result12);

        if ($no_of_rows > 0) {
				$update = mysql_query("UPDATE olio_user_registration set password='".md5($newPassword)."' where id='".$userId."'");
                return true;

        } else {

            // user not found

            return false;

        }

    }

    /**
	
     * Get user by email and password

     */

    public function getUserByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM `olio_user_registration` WHERE `emailid`='".$email."' and `password`='".md5($password)."' ") or die(mysql_error());

        // check for result 

        $no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {
		
			$chsql = mysql_query("SELECT * FROM olio_user_registration WHERE emailid = '".$email."'");		

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

    public function isUserExisted($email) {
        $result = mysql_query("SELECT emailid from olio_user_registration WHERE emailid ='".$email."'");
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

		$result = mysql_query("select * from buyde_product where displayflag='1' and id='".$pid."'");

		$no_of_rows = mysql_num_rows($result);

        if ($no_of_rows > 0) {

				return mysql_fetch_array($result);

        } else {

            // user not existed

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
		$result = mysql_query("select * from buyde_master_product where displayflag='1' and id='".$pid."'");
	
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

				return mysql_fetch_array($result);

        } else {

            // user not existed

            return false;

        }

	}
		
	public function userDetailsEnquiryById($clientId) {	
		$result = mysql_query("select * from olio_user_registration where id='".$clientId."'");
		
		$no_of_rows = mysql_num_rows($result);
			if ($no_of_rows > 0) {

					return mysql_fetch_array($result);

			} else {

				// user not existed

				return false;

			}

	}
	
	
	
	public function notificationEnquiryByUserId($userid) {	
	
		$result = mysql_query("select * from olio_notification_message where displayflag='1' order by id desc");
	
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

			$subCategorySQL = mysql_query("select * from olio_listing_subcategory where list_catid='".$businessCategory."' and listing_subcat_name='".trim($explode[$i])."'");
			while($subCategoryRows = mysql_fetch_assoc($subCategorySQL)) { 
			$subcategryid[]= $subCategoryRows['id'];
		}
	}

	
		$subcategryid2 = implode(',',$subcategryid); 
	
		$result = mysql_query("INSERT INTO olio_business_listing (`user_id`,`businesstype`, `businesstype_subcategory`,`business_name`,`contact_person`,`contact_number`,`contact_email`,`contact_address`,`business_category`,`description`,`state_id`,`city`,`adddate`) VALUES ('".$userId."','".$businessCategory."', '".$subcategryid2."', '".$businessName."','".$contactPerson."','".$contactNumber."','".$contactEmail."','".$contactAddress."','".$businessCategory."','".$description."','".$state."','".$city."',NOW())");

        // check for successful store
		$lastId = mysql_insert_id();
		if ($result) {

			if($businessLogo!='') { 
				define('UPLOAD_PATH', '../userlogo/');
				$imagename = time().$businessLogo;
				move_uploaded_file($_FILES['businessLogo']['tmp_name'], UPLOAD_PATH . $imagename);
				$update = mysql_query("UPDATE olio_business_listing set logo='".$imagename."'  WHERE id = \"$lastId\"");
			}


			if($businessVisitingCard!='') { 
				define('UPLOAD_PATH2', '../visitingcardimages/');
				$imagename2 = time().$businessVisitingCard;
				move_uploaded_file($_FILES['businessVisitingCard']['tmp_name'], UPLOAD_PATH2 . $imagename2);
				$update = mysql_query("UPDATE olio_business_listing set visiting_card='".$imagename2."'  WHERE id = \"$lastId\"");
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
	
	
	
		$subcategory22 = mysql_fetch_assoc(mysql_query("select id from  olio_listing_subcategory where listing_subcat_name='".$subCategory."' and list_catid='".$category."'"));
		$subcategory2 = $subcategory22['id'];
		if($subcategory22['id']!='') { 
			$subcategory23 = $subcategory22['id'];
		} else { 
			$subcategory23 = '0';
		}  
	
		if($subCategory) {
			$subCategory2 = " and businesstype_subcategory like '%$subcategory23%'";
		}
		$result = mysql_query("SELECT * FROM olio_business_listing WHERE displayflag='1'{$city2}{$category2}{$subCategory2} order by id desc");
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
	
	
	
		$subcategory22 = mysql_fetch_assoc(mysql_query("select id from  olio_listing_subcategory where listing_subcat_name='".$subCategory."' and list_catid='".$category."'"));
		$subcategory2 = $subcategory22['id'];
		if($subcategory22['id']!='') { 
			$subcategory2 = $subcategory22['id'];
		} else { 
			$subcategory2 = '0';
		}  
		if($subCategory!='') {
			$subCategory2 = " AND businesstype_subcategory like '%$subcategory2%'";
		}
		$result = mysql_query("SELECT * FROM olio_business_listing WHERE displayflag='1' AND businesstype='3' {$city2}{$category2}{$subCategory2} order by id desc");
		$num = mysql_num_rows($result);
		if ($num>0) {
			return $result;
		} else { 
			return false;
		}
	}
	

	
	public function paymentListingById($userId) {
		$result = mysql_query("SELECT * FROM olio_package WHERE displayflag='1'");
		if ($result) {
			return $result;
		} else { 
			return false;
		}
	}
	
	public function userProfileDetailsById($userId) { 
		$result = mysql_query("SELECT * FROM olio_user_registration WHERE id='".$userId."'");
		if ($result) {
			return mysql_fetch_array($result);
		} else { 
			return false;
		}
	}
	
	public function userEditProfileDetailsById($userId) { 
		$result = mysql_query("SELECT * FROM olio_user_registration WHERE id='".$userId."'");
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
			$update = mysql_query("UPDATE olio_user_registration set visiting_card='".$imagename."'  WHERE id = \"$userId\"");
			return true;
		} else {

            return false;

        }
	}
	
	
	public function getUserDetailsById($userId) { 
		$result = mysql_query("SELECT * FROM olio_user_registration WHERE id='".$userId."'");
		if ($result) {
			return mysql_fetch_array($result);
		} else { 
			return false;
		}
	}
	
	
	
	public function getFavouriteEnquiryList($userId) {
	
		$result = mysql_query("SELECT * FROM olio_favorite_product where  user_id='".$userId."' ORDER BY id DESC");
	
		$no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

				return $result;

        } else {

            // user not existed

            return false;

        }
	}
	
	public function resetPassword($oldPassword,$newPassword,$emailId) {
		$select  = mysql_query("select id from olio_user_registration where `emailid`='".$emailId."' and `commcode`='".$oldPassword."' and `commcode`!=''");
		if(mysql_num_rows($select)>0) {
			$update = mysql_query("update olio_user_registration set password='".$newPassword."' where emailid='".$emailId."'");
			return true;
		} else {
			return false; 
		}
	}
	
	public function getUserType($userId) {
		$select  = mysql_query("select * from olio_user_registration where `id`='".$userId."'");
		if(mysql_num_rows($select)>0) {
			return mysql_fetch_assoc($select);
		} else { 
			return false; 
		}
	}
	
	public function getAllCustomer($userId) {
		$select  = mysql_query("select * from olio_user_registration where android_token!='' and device_name='Android'");
		if(mysql_num_rows($select)>0) {
			return $select ;
		} else { 
			return false; 
		}
	}
	public function getAllCustomerios($userId) {
		$select  = mysql_query("select * from olio_user_registration where ios_token!='' and device_name='ios'");
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
		
		$sellerRes=mysql_query("SELECT * from olio_suppliers where id='".$sellerId."'") or die(mysql_error());
		
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
		$sellerAboutRes=mysql_query("SELECT aboutus from olio_suppliers where id='".$sellerId."' ");
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
		$sellerServiceRes=mysql_query("SELECT customerservice from olio_suppliers where id='".$sellerId."' ");
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
	 public function addSellerReview($userId,$sellerId,$name,$rating,$comment){
	     $reviewAdd=mysql_query("insert into olio_reviews set user_id='".$userId."',productID=0,sellerID='".$sellerId."',rating='".$rating."',fullname='".$name."',comments='".$comment."',date='".date('Y-m-d')."'") or die(mysqli_error());
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
		$reviewRes=mysql_query("select * from olio_reviews where sellerID='".$sellerId."' and publish=1") or die(mysql_error());
		if(mysql_num_rows($reviewRes)>0){
			while($reviewRow=mysql_fetch_assoc($reviewRes)){
				$reviewData[]=$reviewRow;
			}
			return $reviewData;
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

}



?>

