<?php
include_once('header.php');
?>

<div class="card mb-4">
    <h5 class="card-header">Staff Section</h5>
    <!-- Account -->
    <div class="card-body">
          <!-- Vertically Centered Modal -->
          <div class="col-lg-4 col-md-6">
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#modalCenter">
                         Add new staff
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <form id="staffadd" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input
                                class="form-control"
                                type="text"
                                id="username"
                                name="username"
                                autofocus 
                                required/>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" name="email" id="email" required/>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="phone" name="phone" id="phone" required/>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label for="sector" class="form-label">Sector</label>
                            <select id="sector" class="select2 form-select" name="sector" required>
                                <option value="">Select Sector</option>
                                <option value="academic">Academic</option>
                                <option value="institute">Institute</option>
                                <option value="senate">Senate</option>
                            </select>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="text" name="passw" id="password" required/>
                            </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn btn-primary"><input type="hidden" name="addstaff"/>Add Staff <div class="spinner-border spinner-border-sm text-white" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div></button>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Sector</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php
                    $count = 0;
                    $table = 'staff';
                    $result = fetchrecord($table);
                    if ($result->num_rows > 0) {
                        while ($fetch = $result->fetch_assoc()) { 
                           $sname = $fetch['username'];
                           $smail = $fetch['email'];
                           $sect = $fetch['sector'];
                           $sid = $fetch['id'];
                           $count = $count + 1;
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
                            echo $sect;
                        ?>
                        </td>
                      </tr>
                      <?php } 
                        }  else{ ?>
                        <tr><td><td>No Record!</td></td></tr>
                      <?php }  ?>
                    </tbody>
                  </table>
                </div>

                </div>
<script src="../assets/js/jquery.3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#staffadd').submit(function(e){
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
                    location.reload();
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