<?php
include_once('header.php');
?>

<div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="../assets/img/avatars/user.jpg"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar" />
                        <div class="button-wrapper">
                          <p class="text-muted mb-3"><b>Username:</b> <?php echo $user; ?></p>
                          <p class="text-muted mb-3"><b>Email:</b> <?php echo $mail; ?></p>
                          <p class="text-muted mb-0"><b>Staff Sector:</b> <?php echo ucfirst($sector); ?></p>
                        </div>
                      </div>
                    </div>
        
                  </div>
<?php
include_once('footer.php');
?>