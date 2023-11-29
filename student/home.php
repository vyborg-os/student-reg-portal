<?php
include_once('header.php');
?>
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome Back!, <?php echo $usn; ?> 🎉</h5>
                          <p class="mb-4">
                          If you are yet to complete your profile, kindly do so.
                          </p>

                          <a href="profile.php" class="btn btn-sm btn-outline-primary">Update Profile</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Biodata Verification</h5>
                          <h4> <i class="bx bx-cog bx-spin"></i> Verification Status: 
                            <?php
                            if($status=='1'){ ?>
                            <span class="badge bg-label-primary me-1">Verified <i class="bx bx-check"></i></span>
                            <?php
                            }else{ ?>
                           <span class="badge bg-label-danger me-1">Not-Verified <i class="bx bx-refresh"></i></span>
                           <?php } ?>
                          </h4>
                          <p class="mb-4">
                          Constantly check here for your biodata verification status
                          </p>
                <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sectors</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>
                          <i class="bx bx-home bx-sm text-primary me-3"></i>
                          <span class="fw-medium">Institute</span>
                        </td>
                        <td>
                          <?php
                          $sector = 'institute';
                          $chkv = verify_stat($user_id,$sector);
                          if($chkv==true){
                            ?>
                             <span class="badge bg-label-primary me-1">Verified</span>
                          <?php
                          }else{
                            ?>
                             <span class="badge bg-label-danger me-1">Not-Verified</span>
                            <?php
                          }
                          ?>
                       </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="bx bx-home bx-sm text-primary me-3"></i>
                          <span class="fw-medium">Academic</span>
                        </td>
                        <td>
                        <?php
                          $sector = 'academic';
                          $chkv = verify_stat($user_id,$sector);
                          if($chkv==true){
                            ?>
                             <span class="badge bg-label-primary me-1">Verified</span>
                          <?php
                          }else{
                            ?>
                             <span class="badge bg-label-danger me-1">Not-Verified</span>
                            <?php
                          }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="bx bx-home bx-sm text-primary me-3"></i>
                          <span class="fw-medium">Senate</span>
                        </td>
                        <td>
                        <?php
                          $sector = 'senate';
                          $chkv = verify_stat($user_id,$sector);
                          if($chkv==true){
                            ?>
                             <span class="badge bg-label-primary me-1">Verified</span>
                          <?php
                          }else{
                            ?>
                             <span class="badge bg-label-danger me-1">Not-Verified</span>
                            <?php
                          }
                          ?>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Striped Rows -->
            </div>
            </div>
          </div>
        </div>
      </div>
               
 <?php
include_once('footer.php');
?>