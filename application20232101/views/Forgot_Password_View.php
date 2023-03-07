<?php
  include VIEWPATH.'includes/new_header.php';
  ?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <b class="h1 text-success">Bancobu</b><br>Gestion des Cong&eacute;s
    </div>
    <div class="card-body">
      <p class=" text-left">Vous avez oublié votre mot de passe ? Ici, vous pouvez facilement récupérer un nouveau mot de passe. En faisant un reset vous trouverais le nouveau mot de passe dans votre boite mail.<br></p>

      <?php if($message) echo $message ?>
      <form action="<?= base_url('Login/do_reset_password') ?>" method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="USERNAME">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Envoyer nouveau mot de passe</button>
          </div>
          <!-- /.col -->
        </div>
        
        
      </form>

    
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html" class="text-success">I forgot my password</a>
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
