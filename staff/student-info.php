<?php
include_once('header.php');
$user_id = $_GET['user_id'];
?>
<div class="card mb-4">
        <h5 class="card-header">Student BioData</h5>
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
                    <td><img src="../student/images/<?php echo $passp; ?>" width="150px"/></td>
                    </tr>
                    <tr>
                    <td>
                        Birth Certificate
                    </td>
                    <td><img src="../student/images/<?php echo $bc; ?>" width="150px"/></td>
                    </tr>
                    <tr>
                    <td>
                        O'Level
                    </td>
                    <td><img src="../student/images/<?php echo $olevel; ?>" width="150px"/></td>
                    
                    </tr>
                    <tr>
                    <td>
                        State of Origin
                    </td>
                    <td><img src="../student/images/<?php echo $origin; ?>" width="150px"/></td>
                    
                    </tr>
                    <tr>
                    <td>
                        Letter of Attestation
                    </td>
                    <td><img src="../student/images/<?php echo $attest; ?>" width="150px"/></td>
                    
                    </tr>
                </tbody>
                <?php } } ?>
                </table>
            </div>
            <?php
            $chkv = verify_stat($user_id,$sector);
            if($chkv==true){
                echo '<h4 class="mt-4 text-primary">Student is Verified by '.strtoupper($sector).'</h4>';
            }else{ ?>
        
            <form id="vstd" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                <input type="hidden" name="staff_id" value="<?php echo $aid; ?>"/>
                <input type="hidden" name="sector" value="<?php echo $sector?>"/>
            <button type="submit" class="sid btn btn-primary me-2 mt-4"><input type="hidden" name="verifysd"/> Approve by <?php echo ucfirst($sector); ?> <div class="spinner-border spinner-border-sm text-white" role="status" style="display: none;">
                <span class="visually-hidden">Loading...</span>
            </div></button>
            </form>
            <?php } ?>
        </div>
            
        </div>
        </div>
</div>
<script src="../assets/js/jquery.3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#vstd').submit(function(e){
        e.preventDefault()
        $('.spinner-border').show();
            setTimeout(function(){
                $('.spinner-border').hide();
                },3000);
        var datas = new FormData(this);
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: datas,
            success: function(data){
                alert(data);
                console.log(data);
                setTimeout(function(){
                    window.location.href = "home.php";
                },1000);
            },
            cache: false,
            contentType: false,
            processData: false
        })
    })
    })
</script>
<?php
include_once('footer.php');
?>