<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6 text-right">
          <a class="btn btn-outline-primary btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="<?=base_url('facturer/Facture/')?>">Nouveau Facture</a>
          <!-- <a class="btn btn-outline-primary btn-sm <?php if($this->router->method == 'viewing') echo 'active';?>" href="<?=base_url('facturer/Facture/viewing')?>">Liste</a> -->
          <a class="btn btn-outline-primary btn-sm <?php if($this->router->method == 'listing') echo 'active';?>" href="<?=base_url('facturer/Facture/viewing')?>">Liste</a>



          </div>
        </div>
      </div>
    </section>