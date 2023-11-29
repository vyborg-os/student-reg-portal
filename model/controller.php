<?php
//Require config config file
include_once ('config.php');
	$stmt = $mysqli->prepare("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_assoc();
	$site_name = $data['site_name'];
	//$site_address = $data['site_address'];
	//$site_phone = $data['site_phone'];
	//$site_mail = $data['site_mail'];
	define('DS', DIRECTORY_SEPARATOR);

	/////site name
	define('SITE_NAME', $site_name);
	// define('SITE_ADDR', $site_address);
	//define('SITE_PHONE', $site_phone);

	/////App Root
	define('APP_ROOT', dirname(dirname(__FILE__)));
	define('URL_ROOT', '/student-reg-portal');
	define('URL_SUBFOLDER','student-reg-portal');

    function secure($string){
		$sec = htmlentities($string);
		return $sec;
	}
    function user_exist($username, $email, $table){
		//Require Databse config file
		require 'config.php';

		//Sanitize function variables
		$table = secure($table);

		//Check if email exist
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username = ? || email = ?");
		$stmt->bind_param("ss", $username,$email);
		if($stmt->execute()){
			$result = $stmt->get_result();

			if ($result->num_rows >0) {
				return true;
			}else{
				return false;
			}
		}else{
			die($mysqli->error);
		}
	}
	function deleteF($del, $table){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM ".$table." WHERE id='$del' LIMIT 1");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function getAdmin(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetchrecord($table){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table."");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	
    function getAdminUsr($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM staff where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['username'];
	}
	function getUsr($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['username'];
	}
	function getUsrInfo($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getchkAdminUsr($username){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM staff WHERE username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		$privilege = $data['sector'];
		if($privilege=='admin'){
			return true;
		}else{
			return false;
		}
	}
   function getAdminUsrz($username,$email){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM staff where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getAdminUsrzz($username){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM staff where username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getUsrz($username,$email){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getUsrz_exist($username,$email){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	// verifying user id exist in verification table
	function verify_stat($user_id,$sector){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM verification where user_id = '$user_id' && sector = '$sector'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	//verify if user id exist in a column before insertion
	function verify_uid($user_id,$table){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." where user_id = '$user_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	//verify completed field
	function verify_com($user_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT completed FROM users where id = '$user_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	/////verify if profile pics exist
	//verify completed field
	function verify_pics($user_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT passp FROM fileuploads where user_id = '$user_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	////fetch profile pics
	function getPp($user_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM fileuploads where user_id = '$user_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['passp'];
	}
	
	function add_user($username,$email,$phone,$passwordy){
		//Require Databse config file
		require 'config.php';
		//add user
		$stmt = $mysqli->prepare("INSERT INTO users(username, email, phone, passwordy) VALUES(?,?,?,?)");
		$stmt->bind_param("ssss",$username,$email,$phone,$passwordy);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}

////fetch user info via user_id
function fetch_userinfo($table,$user_id){
	//Require Databse config file
	require 'config.php';
	//fetch all user
	$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE user_id='$user_id'");
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
///user functions
    function fetch($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetch_stds(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE completed = '1' AND stat = '0' ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetch_stds_all(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE completed = '1' ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_data($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table."");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
/////////////////////the functions to add user info ///////////////////////////////////////

function add_userinfo($user_id,$firstname,$lastname,$gender,$religion,$address,$state,$lga){
		//Require Databse config file
		require 'config.php';

		//add user info
		$stmt = $mysqli->prepare("INSERT INTO userinfo(user_id,firstname,lastname,gender,religion,address,state,lga) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("isssssss",$user_id,$firstname,$lastname,$gender,$religion,$address,$state,$lga);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_user_moreinfo($user_id,$nokname,$nokmail,$nokphone,$nokaddress,$psgname,$psgmail,$psgphone,$psgaddress){
		//Require Databse config file
		require 'config.php';

		//add more info
		$stmt = $mysqli->prepare("INSERT INTO moreinfo(user_id,nokname,nokmail,nokphone,nokaddress,psgname,psgmail,psgphone,psgaddress) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("issssssss",$user_id,$nokname,$nokmail,$nokphone,$nokaddress,$psgname,$psgmail,$psgphone,$psgaddress);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_user_file($user_id,$passp,$bc,$olevel,$origin,$attest){
		//Require Databse config file
		require 'config.php';

		//add files
		$stmt = $mysqli->prepare("INSERT INTO fileuploads(user_id,passp,bc,olevel,origin,attest) VALUES(?,?,?,?,?,?)");
		$stmt->bind_param("isssss",$user_id,$passp,$bc,$olevel,$origin,$attest);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_new($username,$email,$phone,$sector,$passw){
		//Require Databse config file
		require 'config.php';

		//add admin
		$stmt = $mysqli->prepare("INSERT INTO staff(username,email,phone,sector,passw) VALUES(?,?,?,?,?)");
		$stmt->bind_param("sssss",$username,$email,$phone,$sector,$passw);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
////verify student
function stdverify($user_id,$staff_id,$sector){
	//Require Databse config file
	require 'config.php';

	//add admin
	$stmt = $mysqli->prepare("INSERT INTO verification(user_id,staff_id,sector) VALUES(?,?,?)");
	$stmt->bind_param("iis",$user_id,$staff_id,$sector);
	if($stmt->execute()){
		return true;
	}else{
		return false;
	}
	$result = $stmt->get_result();
	return $result;
}
//update completion of information
function update_com($completed,$uid){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE users SET completed = ? WHERE id = ?");
		if($stmt===false){
			trigger_error($mysqli->error, E_USER_ERROR);
		}
		$stmt->bind_param("ii",$completed,$uid);
        if($stmt->execute()){
            return true;
        }else{
            trigger_error($mysqli->error, E_USER_ERROR);
        }
		$result = $stmt->get_result();
		return $result;
}
function update_std_stat($user_id){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE users SET stat = '1' WHERE id = ?");
		if($stmt===false){
			trigger_error($mysqli->error, E_USER_ERROR);
		}
		$stmt->bind_param("i",$user_id);
        if($stmt->execute()){
            return true;
        }else{
            trigger_error($mysqli->error, E_USER_ERROR);
        }
		$result = $stmt->get_result();
		return $result;
}

///////////////////end dunno ///////////////////////////////////////////////
   function fetch_usr($table,$username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function updateStat($pid,$table,$status){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET status = '$status' WHERE id = '$pid'");
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}

	/////site settings
	function fetchsiteset(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM settings ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	function update_site_settings($token,$username){
		//Require Databse config file
		require 'config.php';
		$stmt = $mysqli->prepare("UPDATE settings SET token = '$token' WHERE username = '$username'");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
?>