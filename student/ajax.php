<?php
include_once('../model/controller.php');
if(isset($_POST['uid'])){
    $uid = $_POST['uid'];
    $completed = '1';
    $chk = update_com($completed,$uid);
        if($chk==TRUE){
            echo 'Submitted for verification sucessful';
        }else{
            echo 'Error, try again';
        }
    }

?>