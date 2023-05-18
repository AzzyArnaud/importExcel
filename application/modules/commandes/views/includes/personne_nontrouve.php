<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-12 text-right">
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="<?=base_url('commandes/Commande/')?>">Liste Des Toutes Commandes</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'commande_non_traite') echo 'active';?>" href="<?=base_url('commandes/Commande/commande_non_traite')?>">Liste Des Commandes Non Traitées</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>