<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1><?php echo $title?></h1>
          </div>
          <div class="col-sm-4 text-right">
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="<?=base_url('requisition/Entree_Stock/')?>">Nouveau</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index_annulation') echo 'active';?>" href="<?=base_url('requisition/Entree_Stock/index_annulation')?>">Annuler une requisition</a>


         <!--  <a class="btn btn-outline-primary btn-sm <?php if($this->router->method == 'listingmarque') echo 'active';?>" href="#">Vehicule</a>
          <a class="btn btn-outline-primary btn-sm <?php if($this->router->method == 'listingcat') echo 'active';?>" href="#">Garage</a>
          <a class="btn btn-outline-primary btn-sm <?php if($this->router->method == 'listingcat') echo 'active';?>" href="#">Chauffeur</a> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>