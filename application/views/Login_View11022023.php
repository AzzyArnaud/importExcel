<?php
  include VIEWPATH.'includes/new_header.php';
  ?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <b class="h3 text-success">Pharmacie St Raphael</b>
      <br>Stock & Vente
    </div>
    <div class="card-body">
      <p class="login-box-msg">Connectez-vous pour démarrer votre session</p>

      <?php if($message) echo $message ?>

      <form action="<?= base_url('Login/do_login') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="USERNAME">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="PASSWORD">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-7">
            <a href="<?php echo base_url('Login/password_recover')?>" class="text-success">Mot de passe oubli&eacute;?</a>
            
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-success btn-block">Se connecter</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html" class="text-primary">I forgot my password</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->

<?php
  include VIEWPATH.'includes/new_script.php';
  ?>

</body>
</html>
