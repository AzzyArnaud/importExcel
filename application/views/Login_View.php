<!DOCTYPE html>
<html lang="en">
<?php
  include VIEWPATH.'includes/new_header.php';
  ?>


<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0 bg-dark">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5 ">
              <div class="brand-logo text-center">
                <img src="<?=base_url()?>assets/images/invest_logo.png" alt="logo">
              </div>
              <!-- <h4>Hello! let's get started</h4>
              <h6 class="fw-light">Sign in to continue.</h6> -->
              <?php 
                          if(!empty($this->session->userdata('message')))
                             echo $this->session->userdata('message');
            ?>
              <form class="pt-3" action="<?= base_url('Login/do_login') ?>" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1"
                    placeholder="Username" name="USERNAME">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                    placeholder="Password" name="PASSWORD">
                </div>
                <div class="mt-3">
                  <!-- <a class="btn  btn-primary   "
                    href="<?=base_url('Login/password_recover')?>">SIGN IN</a> -->
                    <button type="submit" class="btn btn-primary btn-block">SIGN IN</button>

                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook me-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
  <!-- endinject -->
</body>

</html>