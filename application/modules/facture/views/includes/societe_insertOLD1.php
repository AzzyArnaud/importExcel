<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6 text-right">
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="#">Nouveau</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'listing') echo 'active';?>" href="<?=base_url('configuration/Societe')?>">Liste</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>