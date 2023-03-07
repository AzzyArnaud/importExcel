<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Financements</title>
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
                        <h2>Financements</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">Financement</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <div class="container" style="margin-bottom:0px; background: white">

        <!-- <?=$breadcrumb?> -->
        <p></p>

                       <section class="home_blog_area" style="margin-top: 50px;margin-bottom:30px;border-bottom: 1px solid #B3001B;">
            <center><h2 >Rapport des financements</h2></center><p></p>

                   <?= $this->session->flashdata('message') ?>
                <!-- MODAL AJOUT -->
<div class='modal fade' id='srcs' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Ajout d'un projet</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>

        <form id="myform3" action="<?=base_url('rapport/Financement/ajout_reduise') ?>" method="POST" enctype="multipart/form-data">
  

<!-- <div class="container-fluid row" > -->
  
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Nom du projet:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    
  <input type="text" name="titre" id="titre" class="form-control input-sm" autocomplete="off" required>   
    </div>
    
  <!-- </div> -->
  <div class="container-fluid row" >
     <div class="col-md-12 sm-12 xs-12 form-group">
      <label>Commentaire et détail:</label>
    <!-- </div>
    <div class="col-md-8 sm-12 xs-12 form-group"> -->
    <textarea name="description" id="description" class="form-control description" required></textarea>
      
    </div>
  
  </div>
  
  <div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Photo:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    <input type="file" name="fotos" accept="image/*" id="gallery-photo-addOLD" >
    <!--<input id="foto_blob" name="foto_blob" type="text" >-->
     <!-- <textarea name="foto_blob"  id="foto_blob"></textarea> -->

  
  <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" style="display: none;">

      
    </div>
    <!-- <div class="gallery"></div> -->
  </div>
  <div class="container-fluid row" >
     
    
    
  </div>
  <!-- <div class="row" > -->
  
  <!-- </div> -->
  <div class="image-upload" style="margin-top: 20px">

    
</div>
  
    
  <div class="col-md-12 form-group">

    

      <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
    
    </div>

</form>

      </div>
    </div>
  </div>
</div> 

             <?php if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {

                               ?>
                    <div  class="col-md-2"  style="background: ; ">
                    <a href="" data-toggle="modal" data-target="#srcs"> <div id='srvc' class="inner-block"  style="background: ;width: 100% ; border: 1px solid  #DCDCDC;border-radius: 25px;text-align: center; margin-bottom: 10px; color:green">Ajouter

                    </div></a>


                    </div>
                    <?php } ?>

            <div class="row" style="margin-left: 10px">
                <?php  foreach ($services as $value) {
                 ?>
                 <div class='modal fade' id='suppression<?=$value['ID']?>' tabindex="-1">
    <div class='modal-dialog '>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Suppression d'un projet</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
        <h5>Supprimer vraiments cette projet?</h5>

      </div>
      <div class='modal-footer'>
                                                    <a class='btn btn-danger btn-md' href='<?= base_url()?>rapport/Financement/delete_type/<?=$value['ID']?>'>Supprimer</a>
                                                    <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                </div>
    </div>
  </div>
</div> 

                <!-- MODAL MODIFICATION -->
<div class='modal fade' id='modif<?=$value['ID']?>' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modification d'une section</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('rapport/Financement/update_reduise/')?><?=$value['ID']?>" method="POST" enctype="multipart/form-data">
  
  

<div class="container-fluid row" >
  
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Nom du projet:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    
  <input type="text" name="titre" id="titre" value="<?=$value['TITRE']?>" class="form-control input-sm" autocomplete="off" required>   
    </div>
    
  </div>
  <div class="container-fluid row" >
     <div class="col-md-12 sm-12 xs-12 form-group">
      <label>Commentaire et détail:</label>
    <!-- </div>
    <div class="col-md-8 sm-12 xs-12 form-group"> -->
    <textarea name="description" id="description" class="form-control description" required><?=$value['DESCRIPTION']?></textarea>
      
    </div>
  
  </div>
  
  <div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Photo:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    <input type="file" name="fotos" accept="image/*" multiple id="foto_mOLD<?=$value['ID']?>" class="foto_m">
    <!-- <input id="foto_blob_m<?=$value['ID']?>" name="foto_blob" type="text" value=""> -->


  
  <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" style="display: none;">

      
    </div>
    <div class="gallery"></div>
  </div>
  <div class="container-fluid row" >
     
    
    
  </div>
  <!-- <div class="row" > -->
  
  <!-- </div> -->
  <div class="image-upload" style="margin-top: 20px">

    
</div>
  
    
  <div class="col-md-12 form-group">

    

      <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" onclick="vider();">    
    
    </div>

</form>

      </div>
    </div>
  </div>
</div>
                <div class="col-lg-6 admin" style="margin-bottom: 20px;padding: 5px" id="<?=$value['ID']?>">
                   <div class='row  <?=$value['ID']?>' style='display:none;background: '>
                            <?php
                        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
                            ?>
                        
                       <div  class='col-lg-6' style="text-align: center;"><a href='' data-toggle='modal' data-target='#modif<?=$value['ID']?>'><span class="lnr lnr-pencil" style='color:#266C67'></span></a></div><div  class='col-lg-6'  style="text-align: center;"><a href='' data-toggle='modal' data-target='#suppression<?=$value['ID']?>'><span class="lnr lnr-trash" style='color:red'></span></a></div>

                       <?php

                        }
                        ?>
                        
                        </div>
                        
                        <div class="row">
                <div class="col-lg-6"  style="">
                    <div class="h_blog_img">
                        <img src="<?=base_url()?>uploads/financement_type/<?=$value['FOTO']?>" alt="" class='servic'>
                    </div>
                </div>
                <div class="col-lg-6" style="padding: 5px">
                    <div class="h_blog_text">
                        
                        <h4><?=$value['TITRE']?></h4>
                        <p><?=$value['DESCRIPTION']?></p>
                    </div>
                </div>
            </div>
                </div>

                <?php     
                }
                 ?>

                
            </div>

        </section>







    
     <?= $this->session->flashdata('message') ?>
     <?php if($this->session->userdata('PROFIL')){ ?>
            <form method="post" id='myform' action="<?php echo base_url('rapport/Financement/modifier/')?><?=$rapport['ID_RAPPORT']?>"  enctype="multipart/form-data">
                <fieldset class="border p-2"><legend class="w-auto" >Ajout d'un Rapport Financement</legend>

               <div class="container-fluid row" >
                     <div class="col-md-2 sm-12 xs-12 form-group">
                        <label>Titre du rapport:</label>
                    </div>
                    <div class="col-md-4 sm-12 xs-12 form-group">
                    
                <input type="text" name="titre" id="titre" class="form-control input-sm" value="<?=$rapport['TITRE']?>" autocomplete="off" required>       
                    </div>
                    <div class="col-md-2 sm-12 xs-12 form-group">
                        <label>Fichier à télécharger:</label>
                    </div>
                    <div class="col-md-4 sm-12 xs-12 form-group">
                    
                <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" required>     
                    </div>
                </div>
                
                <div class="col-md-12 form-group">

                        <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer">    
                    
                    </div>
            </fieldset>
            </form><p>
            <?php } ?>

            <?= $this->table->generate($table); ?>  

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
     "order": [[0, "desc" ]],
      
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
<script type="text/javascript">


$('.admin').mouseenter(function(){
  // $(document).on('click','.mail',function(){
   var id=$(this).attr("id"); 
   // alert(id);
 $('.'+id).show();

});

$('.admin').mouseleave(function(){
  // $(document).on('click','.mail',function(){
   var id=$(this).attr("id"); 
   // alert(id);
 $('.'+id).hide();
  // alert(id); 
});



        $('.servic').each(function(){

    var width=$(this).width()*60/100;

        $(this).height(width);
        // $(this).size('.star-size');
         

});
                $('.staff').each(function(){

    var width=$(this).width()*70/100;

        $(this).height(width);
        // $(this).size('.star-size');
         

});
    $(window ).resize(function(){
         $('.bando').each(function(){

    var width=$(this).width()*55/100;

        $(this).height(width);
        // $(this).size('.star-size');
         

});

                 $('.servic').each(function(){

    var width=$(this).width()*60/100;

        $(this).height(width);
        // $(this).size('.star-size');
         

});

          $('.staff').each(function(){

          var width=$(this).width()*70/100;

              $(this).height(width);

      });
    });

  </script>
