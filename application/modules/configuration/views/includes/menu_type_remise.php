<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6 text-right">
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'inserting') echo 'active';?>" href="<?=base_url('configuration/Type_Remise/inserting')?>">Nouveau</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="<?=base_url('configuration/Type_Remise')?>">Liste</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>