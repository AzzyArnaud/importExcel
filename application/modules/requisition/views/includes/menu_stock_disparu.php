<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6 text-right">
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="<?=base_url('requisition/Stock_disparu')?>">Sortie globale</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'detail') echo 'active';?>" href="<?=base_url('requisition/Stock_disparu/detail')?>">Détail Sortie</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'nouveau') echo 'active';?>" href="<?=base_url('requisition/Stock_disparu/nouveau')?>">Nouvelle</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>