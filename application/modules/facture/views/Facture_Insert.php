<?php
include VIEWPATH.'includes/new_header.php';
?>

<div class="wrapper">

  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
    include 'includes/facture_insert.php';
    ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Ajouer La Facture</h3>
              </div>
              <div class="card-body">
                <?=$this->session->flashdata('message')?>
                <form enctype="multipart/form-data" method="post" action="<?=base_url()?>facture/Facture/Insert">

                  <div class="row">

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">MOIS</label>
                      <input type="month" class="form-control float-right" name="MOIS" value="<?=set_value('MOIS');?>">
                      <?php echo form_error('MOIS', '<div class="text-danger">', '</div>'); ?>  
                    </div>

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">ASSURANCE</label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_ASSURANCE" id="ID_ASSURANCE" style="width: 100%;">
                        <option value="<?=set_value('ID_ASSURANCE'); ?>"> </option>
                        <?php 
                        $ID_ASSURANCE=$this->Model->getList('saisie_assurance',array());
                        foreach ($ID_ASSURANCE as $key) {
                          if ($ID_ASSURANCES == $key['ID_ASSURANCE'] ) {
                            echo "<option value=".$key['ID_ASSURANCE']." selected>".$key['NOM_ASSURANCE']."</option>";
                          }
                          else{
                            echo "<option value=".$key['ID_ASSURANCE'].">".$key['NOM_ASSURANCE']."</option>";
                          } 
                        }
                        ?>
                      </select>

                      <?php echo form_error('ID_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="form-group col-md-6">
                      <label style="font-weight: 900; color:#454545">FILE</label>
                      <input type="file" class="form-control" name="FILES" id="FILES" accept=".xlsx" value="<?=set_value('FILES');?>">
                      <?php echo form_error('FILES', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="col-md-12" style="margin-top: 31px;" >
                      <button style="float: center;width: 100%;" class="btn btn-success"> Enregistrer </button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
  include VIEWPATH.'includes/new_copy_footer.php';  
  ?>

  <aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<?php
include VIEWPATH.'includes/new_script.php';
?>

<script type="text/javascript">
  $('#reservation').daterangepicker({

    locale: {
      format: 'DD/MM/YYYY'
    }
  })
  $('.select').select2();

</script>

</body>
</html>
