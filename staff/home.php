<?php
include_once('header.php');
?>
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-12">
                <div class="card-body">
                  <h5 class="card-title text-primary">Biodata Verification</h5>
                   <p class="mb-4">
                  Constantly check below to verify student's biodata
                  </p>
                <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php
                    $count = 0;
                    $result = fetch_stds();
                    if ($result->num_rows > 0) {
                        while ($fetch = $result->fetch_assoc()) { 
                           $sname = $fetch['username'];
                           $smail = $fetch['email'];
                           $sstats = $fetch['stat'];
                           $sid = $fetch['id'];
                           $count = $count + 1;
                           $chkv = verify_stat($sid,$sector);
                           if($chkv!=true){
                    ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td>
                          <i class="bx bx-user bx-sm text-primary me-3"></i>
                          <span class="fw-medium"><?php echo $sname; ?></span>
                        </td>
                        <td><?php echo $smail; ?></td>
                        <td>
                        <?php
                        if($sstats=='1') {
                          ?>
                        <span class="badge bg-label-primary me-1">Verified</span>
                        <?php
                        } else{ ?>
                          <span class="badge bg-label-danger me-1">Not-verified</span>
                       <?php
                        }
                        ?>
                        </td>
                        <td><a href="student-info.php?user_id=<?php echo $sid; ?>" class="btn btn-primary text-white">View</a></td>
                      </tr>
                      <?php } 
                    }  }else{ ?>
                        <tr><td><td>No Record!</td></td></tr>
                      <?php }  ?>
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