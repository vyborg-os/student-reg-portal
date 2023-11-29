<?php
include_once('../model/controller.php');
if(isset($_POST['verifysd'])){
    $user_id = $_POST['user_id'];
    $staff_id = $_POST['staff_id'];
    $sector = $_POST['sector'];
    $chk = stdverify($user_id,$staff_id,$sector);
        if($chk==TRUE){
            echo 'Student Verified';
        }else{
            echo 'Error, try again';
        }
    }
if(isset($_POST['addstaff'])){
    $username = secure($_POST["username"]);
    $email = secure($_POST["email"]);
    $phone = secure($_POST["phone"]);
    $sector = secure($_POST["sector"]);
    $pass = secure($_POST["passw"]);
    $passw = md5($pass);
    $chk_u =  user_exist($username,$email, 'staff');
    if($chk_u==true){
        echo 'Account already exist, try again';
    }
    else{
        $ins = add_new($username,$email,$phone,$sector,$passw);
        if($ins==true){
            echo 'Staff Account created successfully';
        }else{
            echo 'Cannot create account, try again';
        }
    }
    }

?>