<?php
include_once('header.php');
if(isset($_POST['addinfo'])){
  $firstname = secure($_POST["firstname"]);
  $lastname = secure($_POST["lastname"]);
  $gender = secure($_POST["gender"]);
  $religion = secure($_POST["religion"]);
  $address = secure($_POST["address"]);
  $state = secure($_POST["state"]);
  $lga = secure($_POST["lga"]);
  $nokname = secure($_POST["nokname"]);
  $nokmail = secure($_POST["nokmail"]);
  $nokphone = secure($_POST["nokphone"]);
  $nokaddress = secure($_POST["nokaddress"]);
  $psgname = secure($_POST["psgname"]);
  $psgmail = secure($_POST["psgmail"]);
  $psgphone = secure($_POST["psgphone"]);
  $psgaddress = secure($_POST["psgaddress"]);
  $table1 = 'userinfo';
  $table2 = 'moreinfo';
  $table3 = 'fileuploads';
  $chk_1 =  verify_uid($user_id,$table1);
  $chk_2 =  verify_uid($user_id,$table2);
  $chk_3 =  verify_uid($user_id,$table3);
  $passp  = $_FILES["passp"]['name'];
  $bc = $_FILES["bc"]['name'];
  $olevel = $_FILES['olevel']['name'];
  $origin = $_FILES['origin']['name'];
  $attest = $_FILES['attest']['name'];
  $file1  = $_FILES['passp']['tmp_name'];
  $file2 = $_FILES['bc']['tmp_name'];
  $file3 = $_FILES['olevel']['tmp_name'];
  $file4 = $_FILES['origin']['tmp_name'];
  $file5 = $_FILES['attest']['tmp_name'];
 if($chk_1!=true && $chk_2!=true && $chk_3!=true){
    //$path = 'images/';
    $add1 = add_userinfo($user_id,$firstname,$lastname,$gender,$religion,$address,$state,$lga);
    $add2 = add_user_moreinfo($user_id,$nokname,$nokmail,$nokphone,$nokaddress,$psgname,$psgmail,$psgphone,$psgaddress);
    $add3 = add_user_file($user_id,$passp,$bc,$olevel,$origin,$attest);
    $path = 'images/'.$passp;
    if(move_uploaded_file($file1, $path)){
        copy($path, 'images/'.$bc);
    }
    if(move_uploaded_file($file2, $path)){
        copy($path, 'images/'.$olevel);
    }
    if(move_uploaded_file($file3, $path)){
        copy($path, 'images/'.$origin);
    }
    if(move_uploaded_file($file4, $path)){
        copy($path, 'images/'.$attest);
    }
    if(move_uploaded_file($file5, $path)){

    }
        if($add1==true && $add2==true && $add3==true){
            echo '<script>
            alert("Student Information Updated, Successfully")
            </script>';
            // header("Location: ./");
        }else{
            echo'<script>
            alert("Cannot update info, try again")
            </script>';
        }
  }else{
    echo'<script>
    alert("Cannot Upload Provided Information, contact the admin")
    </script>';
  }
}
?>
<div class="card mb-4">
<div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
    <?php
    $im = verify_pics($user_id);
    if($im==true){
        $uimg = 'images/'.getPp($user_id);
    }else{
        $uimg = '../assets/img/avatars/user.jpg';
    }
    ?>
    <img
        src="<?php echo $uimg; ?>"
        alt="user-avatar"
        class="d-block rounded"
        height="100"
        width="100"
        id="uploadedAvatar" />
    <div class="button-wrapper">
        <p class="text-muted mb-0"><?php echo $usn; ?></p>
        <p class="text-muted mb-0"><?php echo $mail; ?></p>
        <p class="text-muted mb-0"><?php echo $num; ?></p>
    </div>
    </div>
</div>
<hr class="my-0" />
<?php
 $table1 = 'userinfo';
 $table2 = 'moreinfo';
 $table3 = 'fileuploads';
 $chk_1 =  verify_uid($user_id,$table1);
 $chk_2 =  verify_uid($user_id,$table2);
 $chk_3 =  verify_uid($user_id,$table3);
 if($chk_1!=true && $chk_2!=true && $chk_3!=true){
 ?>
        <h5 class="card-header">Profile Details</h5>
        <div class="card-body">
        <b>Personal Information</b>
        <hr class="my-0 mb-4" />
            <form id="formAccountSettings" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input
                    class="form-control"
                    type="text"
                    id="firstName"
                    name="firstname"
                    autofocus 
                    required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input class="form-control" type="text" name="lastname" id="lastName" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" class="select2 form-select" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
                </div>
                <div class="mb-3 col-md-6">
                <label for="religion" class="form-label">Religion</label>
                <select id="religion" class="select2 form-select" name="religion" required>
                    <option value="">Select Religion</option>
                    <option value="christain">Christain</option>
                    <option value="muslim">Muslim</option>
                    <option value="others">Others</option>
                </select>
                </div>
                <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="state" class="form-label">State</label>
                <input class="form-control" type="text" id="state" name="state" placeholder="State" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="LGA" class="form-label">LGA</label>
                <input
                    type="text"
                    class="form-control"
                    id="lga"
                    name="lga"
                    placeholder="Local Government Area"
                    required />
                </div>
    <b>Parent/Sponsor/Guardian Information (PSG)</b>
        <hr class="my-0 mb-4" />
            <div class="mb-3 col-md-6">
                <label for="fullname" class="form-label">P/S/G Fullname</label>
                <input type="text" class="form-control" id="psgname" name="psgname" placeholder="P/S/G Fullname" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="address" class="form-label">NOK Address</label>
                <input type="text" class="form-control" id="address" name="psgaddress" placeholder="P/S/G Address" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="email" class="form-label">P/S/G Email</label>
                <input type="email" class="form-control" id="email" name="psgmail" placeholder="P/S/G Email" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label class="form-label" for="phoneNumber">P/S/G Phone Number</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">NGA (+234)</span>
                    <input
                    type="number"
                    id="phoneNumber"
                    name="psgphone"
                    class="form-control"
                    placeholder="202 555 0111"
                    required />
                </div>
                </div>
        <b>Next of Kin Information (NOK)</b>
        <hr class="my-0 mb-4" />
            <div class="mb-3 col-md-6">
                <label for="fullname" class="form-label">NOK Fullname</label>
                <input type="text" class="form-control" id="nokname" name="nokname" placeholder="NOK Fullname" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="address" class="form-label">NOK Address</label>
                <input type="text" class="form-control" id="address" name="nokaddress" placeholder="NOK Address" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label for="email" class="form-label">NOK Email</label>
                <input type="email" class="form-control" id="email" name="nokmail" placeholder="NOK Email" required/>
                </div>
                <div class="mb-3 col-md-6">
                <label class="form-label" for="phoneNumber">NOK Phone Number</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">NGA (+234)</span>
                    <input
                    type="number"
                    id="phoneNumber"
                    name="nokphone"
                    class="form-control"
                    placeholder="202 555 0111"
                    required />
                </div>
                </div>
    <b>Documents Upload</b>
        <hr class="my-0 mb-4" />
        <div class="mb-3 input-group">
            <input type="file" class="form-control" name="passp" id="inputGroupFile02" accept="image/png, image/jpg, image/jpeg" required/>
            <label class="input-group-text" for="inputGroupFile02">Passport Photograph</label>
            </div>
            <div class="mb-3 input-group">
            <input type="file" class="form-control" name="bc" id="inputGroupFile02" accept="image/png, image/jpg, image/jpeg" required/>
            <label class="input-group-text" for="inputGroupFile02">Birth Certificate</label>
            </div>
            <div class="mb-3 input-group">
            <input type="file" class="form-control" name="olevel" id="inputGroupFile02" accept="image/png, image/jpg, image/jpeg" required/>
            <label class="input-group-text" for="inputGroupFile02">O'level Result</label>
            </div>
            <div class="mb-3 input-group">
            <input type="file" class="form-control" name="origin" id="inputGroupFile02" accept="image/png, image/jpg, image/jpeg" required/>
            <label class="input-group-text" for="inputGroupFile02">Origin Certificate</label>
            </div>
            <div class="mb-3 input-group">
            <input type="file" class="form-control" name="attest" id="inputGroupFile02" accept="image/png, image/jpg, image/jpeg" required/>
            <label class="input-group-text" for="inputGroupFile02">Attestation Letter</label>
            </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2"><input type="hidden" name="addinfo"/>Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
            </form>
        </div>
                    <!-- /Account -->
                  </div>
<?php }else{ ?>
        <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
                <!-- Bordered Table -->
        <div class="card">
            <h5 class="card-header">Personal Information</h5>
            <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                <tbody>
                    <?php
                    $table = 'userinfo';
                    $result = fetch_userinfo($table,$user_id);
                    if ($result->num_rows > 0) {
                       while ($fetch = $result->fetch_assoc()) { 
                          $firstname = $fetch['firstname'];
                          $lastname = $fetch['lastname'];
                          $gender = $fetch['gender'];
                          $religion = $fetch['religion'];
                          $address = $fetch['address'];
                          $state = $fetch['state'];
                          $lga = $fetch['lga'];
                    ?>
                    <tr>
                    <td>
                        Fullname
                    </td>
                    <td><?php echo $firstname.' '.$lastname; ?></td>
                    </tr>
                    <tr>
                    <td>
                        Gender
                    </td>
                    <td><?php echo $gender; ?></td>
                    </tr>
                    <tr>
                    <td>
                        Religion
                    </td>
                    <td><?php echo $religion; ?></td>
                    
                    </tr>
                    <tr>
                    <td>
                        Address
                    </td>
                    <td><?php echo $address; ?></td>
                    
                    </tr>
                    <tr>
                    <td>
                        State
                    </td>
                    <td><?php echo $state; ?></td>
                    
                    </tr>
                    <tr>
                    <td>
                        Local Govt.
                    </td>
                    <td><?php echo $lga; ?></td>
                    
                    </tr>
                    <?php } } ?>
                </tbody>
                </table>
            </div>
            </div>
            <h5 class="card-header">Parent/Sponsor/Guardian (PSG) - Section</h5>
            <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                <tbody>
                <?php
                    $table = 'moreinfo';
                    $result = fetch_userinfo($table,$user_id);
                    if ($result->num_rows > 0) {
                       while ($fetch = $result->fetch_assoc()) { 
                          $psgname = $fetch['psgname'];
                          $psgmail = $fetch['psgmail'];
                          $psgphone = $fetch['psgphone'];
                          $psgaddress = $fetch['psgaddress'];
                          $nokname = $fetch['nokname'];
                          $nokmail = $fetch['nokmail'];
                          $nokphone = $fetch['nokphone'];
                          $nokaddress = $fetch['nokaddress'];
                    ?>
                    <tr>
                    <td>
                        Fullname
                    </td>
                    <td><?php echo $psgname; ?></td>
                    </tr>
                    <tr>
                    <td>
                        Email
                    </td>
                    <td><?php echo $psgmail; ?></td>
                    </tr>
                    <tr>
                    <td>
                        Phone
                    </td>
                    <td><?php echo $psgphone; ?></td>
                    
                    </tr>
                    <tr>
                    <td>
                        Address
                    </td>
                    <td><?php echo $psgaddress; ?></td>
                    
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        <h5 class="card-header">Next of Kin - Section</h5>
            <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                <tbody>
                    <tr>
                    <td>
                        Fullname
                    </td>
                    <td><?php echo $nokname; ?></td>
                    </tr>
                    <tr>
                    <td>
                        Email
                    </td>
                    <td><?php echo $nokmail; ?></td>
                    </tr>
                    <tr>
                    <td>
                        Phone
                    </td>
                    <td><?php echo $nokphone; ?></td>
                    
                    </tr>
                    <tr>
                    <td>
                        Address
                    </td>
                    <td><?php echo $nokaddress; ?></td>
                    
                    </tr>
                </tbody>
                <?php } } ?>
                </table>
            </div>
            </div>
            <h5 class="card-header">Documents - Section</h5>
            <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                <tbody>
                <?php
                    $table = 'fileuploads';
                    $result = fetch_userinfo($table,$user_id);
                    if ($result->num_rows > 0) {
                       while ($fetch = $result->fetch_assoc()) { 
                          $passp = $fetch['passp'];
                          $bc = $fetch['bc'];
                          $olevel = $fetch['olevel'];
                          $attest = $fetch['attest'];
                          $origin = $fetch['origin'];
                    ?>
                    <tr>
                    <td>
                        Passport
                    </td>
                    <td><img src="images/<?php echo $passp; ?>" width="150px"/></td>
                    </tr>
                    <tr>
                    <td>
                        Birth Certificate
                    </td>
                    <td><img src="images/<?php echo $bc; ?>" width="150px"/></td>
                    </tr>
                    <tr>
                    <td>
                        O'Level
                    </td>
                    <td><img src="images/<?php echo $olevel; ?>" width="150px"/></td>
                    
                    </tr>
                    <tr>
                    <td>
                        State of Origin
                    </td>
                    <td><img src="images/<?php echo $origin; ?>" width="150px"/></td>
                    
                    </tr>
                    <tr>
                    <td>
                        Letter of Attestation
                    </td>
                    <td><img src="images/<?php echo $attest; ?>" width="150px"/></td>
                    
                    </tr>
                </tbody>
                <?php } } ?>
                </table>
            </div>
            <!-- <div
                class="alrt bs-toast toast fade show bg-success mt-3"
                role="alert"
                aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.
                </div>
            </div> -->
         </div>
         <?php 
            $cm = verify_com($user_id);
            if($cm){ ?>
              <center><h5><i class="mt-4">Submitted for Verification</i></h5></center>
           <?php }else{ ?>
            <button class="uid btn btn-primary me-2 mt-4" id="<?php echo $user_id; ?>">Send for Approval/Verification</button>
            <?php } ?>
    <!--/ Bordered Table -->
        </div>
        <!-- /Account -->
        </div>
<script src="../assets/js/jquery.3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $('.uid').click(function(){
    var uid = $(this).attr("id");
    if(confirm("Are you sure you want to submit?")){
        $.ajax({
        url:'ajax.php',
        method:'POST',
        data:'uid='+uid,
        success:function(data){
            alert(data);
            location.reload();
        },
        error: function(data){
            alert(data);
            location.reload();
        }
        });
                            
    }
});
 })
   </script> 
        <?php } ?>
<?php
include_once('footer.php');
?>