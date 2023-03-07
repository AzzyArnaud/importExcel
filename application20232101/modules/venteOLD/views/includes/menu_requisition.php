<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title?></h1>
          </div>
          <div class="col-sm-6 text-right">
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'index') echo 'active';?>" href="<?=base_url('requisition/Requisition/')?>">Nouvea requisition</a>
          <a class="btn btn-outline-success btn-sm <?php if($this->router->method == 'listing') echo 'active';?>" href="<?=base_url('requisition/Requisition/listing')?>">Liste</a>


          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>