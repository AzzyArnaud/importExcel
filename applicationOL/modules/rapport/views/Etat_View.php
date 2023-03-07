<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Rapport</title>
        <?php
        meta_tags();
    ?>
        <!-- Bootstrap CSS -->
        <?php
    $active1="";
    $active2="";
    $active3="";
    $active4="active";
    $active5="";
    $active6="";
    $active7="";
    $active8="";
    $active9="";
    $active10="";
    $active11="";

    ?>
        <?php
    
       include VIEWPATH.'includes/header.php';

    ?>
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <?php
       include VIEWPATH.'includes/menu_principal.php';
        ?>
<div id="presentation" class="container-fluid" >
<!-- <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content">
                        <h2>Rapport Annuel</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="<?=base_url()?>rapport/Annuel">Rapport annuel</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <div class="container" style="margin-bottom:0px; background: white">

        <!-- <?=$breadcrumb?> -->
        <p></p>
    
     <?= $this->session->flashdata('message') ?>
     <?php if($this->session->userdata('PROFIL')){ ?>
             <form method="post" id='myform' action="<?php echo base_url('rapport/Etat_financier/add')?>"  enctype="multipart/form-data">
                <fieldset class="border p-2"><legend class="w-auto" >Ajout </legend>

               <div class="container-fluid row" >
                   <!--   <div class="col-md-2 sm-12 xs-12 form-group">
                        <label>Titre du rapport:</label>
                    </div> -->
                    <!-- <div class="col-md-4 sm-12 xs-12 form-group"> -->
                    
                      
                    <!-- </div> -->
                                        <div class="col-md-1 sm-12 xs-12 form-group">
                        <label>Titre:</label>
                    </div>
                    <div class="col-md-4 sm-12 xs-12 form-group">
                    <input type="text" name="titre" id="titre" class="form-control input-sm" autocomplete="off" value="" required>      
                    </div>
                    <div class="col-md-2 sm-12 xs-12 form-group">
                        <label>Fichier à télécharger:</label>
                    </div>
                    <div class="col-md-4 sm-12 xs-12 form-group">
                    
                <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" accept="application/pdf" required>     
                    </div>
                </div>
                
                <div class="col-md-12 form-group">

                    <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer">    
                    
                </div>
            </fieldset>
            </form><p>
            <?php } ?>
            <h2 style="text-align: center;">Historique des Etats financiers</h2>
            <div class="row" style="min-height: 400px">

<?php

foreach ($rapport as $value) {
    ?>

<div class="col-md-4" >
      
    <a href="<?=base_url()?>uploads/rapport/<?=$value['FILE']?>" target="_blank">
  <div style=" width: 90%
  padding: 10px 10px 20px 10px;
  margin: 5px 5px 15px 5px;
  border: 1px solid #BFBFBF;
  background-color: white;
  box-shadow: 10px 10px 5px #aaaaaa; border-bottom: 2px solid red">



<!-- <i class="fas fa-file-pdf">aaa</i> -->
<center>
    <span><?=$value['TITRE']?></span> <p>


<img src="<?=base_url()?>fotos/PDF.png" style="width: 15%; margin-bottom: 5px">
</center>
</a>
   <?php
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
     ?>
        <a  href="#" data-toggle='modal' data-target='#suppression<?=$value['ID_RAPPORT']?>'><span class="lnr lnr-trash" style='color:red'></span></a><p>

        <!-- SUPPRESTION STAFF -->
                        <div class='modal fade' id='suppression<?=$value['ID_RAPPORT']?>' tabindex="-1">
                            <div class='modal-dialog '>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Suppression</h3>
                                  <!-- <button class="close" data_dismiss="modal">&times;</button> -->
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>

                                <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
                          height:100%;
                          background-size:10px 10px;}">
                                  <span id="msg"></span>
                                <h5>Voulez-vous variment supprimer?</h5>

                              </div>
                              <div class='modal-footer'>
                                                                            <a class='btn btn-danger btn-md' href='<?= base_url()?>rapport/Etat_financier/delete/<?=$value['ID_RAPPORT']?>'>Supprimer</a>
                                                                            <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                                        </div>
                            </div>
                          </div>
                        </div> 
    <?php
        }
     ?>
</div>


</div>


<?php
}
?>

</div>
</div>
    </div>
      
     
        
        <!--================ start footer Area  =================-->	
        <?php
        include VIEWPATH.'includes/footer.php';
        ?>
    </body>
</html>
<script>
       $(document).ready(function(){
        // $('#DATE').datetimepicker({format: 'd-m-Y'});

    // var row_count ="1000000";
     // alert(row_count);
$("#mytable").DataTable({
     "ordering": false,
        
                language: {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                  "sFirst":      "Premier",
                  "sPrevious":   "Pr&eacute;c&eacute;dent",
                  "sNext":       "Suivant",
                  "sLast":       "Dernier"
                },
                "oAria": {
                  "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                  "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            }


            }); 

  
}); 
  </script>
