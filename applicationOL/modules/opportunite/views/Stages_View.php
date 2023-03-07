<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Stages</title>
        <?php
    meta_tags();
  ?>
        <!-- Bootstrap CSS -->
        <?php
    $active1="";
    $active2="";
    $active3="";
    $active4="";
    $active5="";
    $active6="active";
    $active7="";
    $active8="";
    $active9="";
    $active10="";
    $active11="";

    ?>
        <?php
    
       include VIEWPATH.'includes/header.php';

    ?>
    <style type="text/css">
        b{
            color: black;
        }
    </style>
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
                        <h2>Opportunités des stages</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">opportunités des stages</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
       <div id="corps" class="container " style="background: white;padding: 10px"><p>
        
<!-- <?= $breadcrumb ?>  -->
    <?= $this->session->flashdata('message') ?>

<!-- MODAL AJOUT -->
<div class='modal fade' id='srcs' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Ajout</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('opportunite/Stages/ajout') ?>" method="POST" enctype="multipart/form-data" style='text-align: left;'>
    

<div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Titre:</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
        
    <input type="text" name="titre" id="titre" class="form-control input-sm" autocomplete="off" required>       
        </div>
        
    </div>
    <div class="container-fluid row" >
         <div class="col-md-12 sm-12 xs-12 form-group">
            <label>Description:</label>
        <!-- </div>
        <div class="col-md-8 sm-12 xs-12 form-group"> -->
        <textarea name="description" id="description" class="form-control description" required></textarea>
            
        </div>
    
    </div>
    
    <div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Piece jointe PDF</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
    
    <input type="file" name="pj" id="pj" accept="application/pdf" class="form-control input-sm" autocomplete="off" style="display: ;" >
        
        </div>
        
    </div>
    <div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Date d'expiration de la publication</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
    
    <input type="texte" name="date" id="date" class="form-control input-sm" required autocomplete="off" style="display: ;" readonly>
        
        </div>
        
    </div>
    <div class="col-md-12 form-group">

        

            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
        
        </div>

</form>
<!-- <img id"crop" src="<?=base_url()?>uploads/19261795.jpg" style="width: 400px"> -->

      </div>
    </div>
  </div>
</div>  
<?php
foreach ($emploi as $value) {
    
    ?>
<!-- MODAL DELETE -->
<div class='modal fade' id='mydelete<?=$value->ID?>'>
            <div class='modal-dialog'>
                <div class='modal-content'>

                    <div class='modal-body'>
                        <h5>  Voulez-vous vraiment Supprimer cette publication?</h5>
                    </div>

                    <div class='modal-footer'>
                        <a class='btn btn-danger btn-md' id="delete_modal" href="<?=base_url()?>opportunite/Stages/delete/<?=$value->ID?>">Supprimer</a>
                        <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                    </div>

                </div>
            </div>
        </div>

<!-- MODAL MODIFICTION -->
<div class='modal fade' id='modification<?=$value->ID?>' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modification d'une publiation</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('opportunite/Stages/modifier/') ?><?=$value->ID?>" method="POST" enctype="multipart/form-data" style='text-align: left;'>
    

<div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Titre :</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
        
    <input type="hidden" name="id" id="id" class="form-control input-sm" autocomplete="off" value="<?=$value->ID?>" required>       
    <input type="text" name="titre1" id="titre1" value="<?=$value->TITRE?>" class="form-control input-sm" autocomplete="off" required>     
        </div>
        
    </div>
    <div class="container-fluid row" >
         <div class="col-md-12 sm-12 xs-12 form-group">
            <label>Description:</label>
        <!-- </div>
        <div class="col-md-8 sm-12 xs-12 form-group"> -->
        <textarea name="description1" id="description1" class="form-control description" required><?=$value->DESCRIPTION?></textarea>
            
        </div>
    
    </div>
    
    <div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Piece jointe PDF</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
    
    <input type="file" name="pj1" id="pj1" accept="application/pdf" class="form-control input-sm" autocomplete="off" style="display: ;">
        
        </div>
        
    </div>
    <div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Date d'expiration de la publication</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
    
    <input type="texte" name="date1" id="date1" value="<?=$value->EXPIRATION?>" class="form-control input-sm" autocomplete="off" style="display: ;" required readonly>
        
        </div>
        
    </div>
    
        
    <div class="col-md-12 form-group">

        

            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
        
        </div>

</form>
<!-- <img id"crop" src="<?=base_url()?>uploads/19261795.jpg" style="width: 400px"> -->

      </div>
    </div>
  </div>
</div>  
<?php } ?>

    <?php if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
    # code...
?>
<div class="row">
    <div  class="col-md-2"  style="background: ; text-align: center;" >
     <a href="" data-toggle="modal" data-target="#srcs"> <div id='srvc' class="inner-block"  style="background: ;width: 100% ; border: 1px solid  #DCDCDC;border-radius: 25px; margin-bottom: 10px">
+

        </div></a>


</div></div>
<?php } ?>
<div class="row">
    <div class="col-md-8" style="text-align: left;"><h1 style="color: rgba(31, 186, 96, 1);">Publications des opportunités des stages</h1><p></div>
        <div class="col-md-4" style="text-align: left;">
     <form id="myform" action="<?= base_url('opportunite/Stages/recherche_emploi') ?>" method="POST" enctype="multipart/form-data">
      
            <div class="input-group mb-3">
      <input type="text" name="mot_cle" class="form-control" placeholder="Recherche" required >
      <div class="input-group-append">
        <button class="input-group-text" id="basic-addon2"><i class="lnr lnr-magnifier"></i></button>
      </div>
    </div>
     </form>
  </div>
<?php 
if(sizeof($emploi)!=0){
foreach ($emploi as $value) {
    
    ?>
<div class="col-md-12 admin" id='<?=$value->ID?>' style="margin: 0px 10px 2px 10px;  background:  #EBF0EF;">
    <div class="row">
        <div class="col-md-9" style="text-align: left;">
            <?php
                if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
    
    echo "<div id='gestion' class='row ".$value->ID."' style='display:none'><a href='' data-toggle='modal' data-target='#modification".$value->ID."'><div  class='col-md-6'><i class='lnr lnr-pencil' style='color:#266C67'></i></div></a><div  class='col-md-6'><a href='' id='".$value->ID."' class='delete' data-toggle='modal' data-target='#mydelete".$value->ID."'><i class='lnr lnr-trash' style='color:red'></i></div></a></div>";

    }
            ?>
            <div><b><?=$value->TITRE?></b></div>
            <div><!-- <?=$value->DATE?> -->
                <?php
                $date=new DateTime($value->DATE);
                echo $date->format('d/m/Y h:i:s');
                ?>
            </div>

            <div><?=$value->DESCRIPTION?></div>
        </div>
        <div class="col-md-3">
        <div class="row">
            
        <?php
        if($value->PIECE_JOINTE){
        ?>
        <div class="col-md-12">Pour plus d'information, clicker ici<br><i class="lnr lnr-paperclip" style="font-size: 30px" ></i>
            <a href="<?=base_url()?>uploads/emploi/<?=$value->PIECE_JOINTE?>" target='_blank'>
                <i class="fas fa-download"  style="color:#266C67';font-size:16px"></i> <?=$value->PIECE_JOINTE?>
            </a>
            <?php
             date_default_timezone_set('Africa/Bujumbura');

            if (strtotime(date('Y-m-d H:i:s'))>strtotime($value->EXPIRATION)) {
                echo "<h3 style='color:red'>Publication expirée</h3>";
            }

            ?>
            </div>
        <?php
        }else{?>
<div class="col-md-12">
            <?php
             date_default_timezone_set('Africa/Bujumbura');

            if (strtotime(date('Y-m-d H:i:s'))>strtotime($value->EXPIRATION)) {
                echo "<h1 style='color:red'>Publication expirée</h1>";
            }

            ?>
    </div>
        <?php

        }
        ?>
        </div>
        </div>
    </div>
</div>
<?php
}
}else echo "<div class='col-md-12' style=' background:  #EBF0EF; min-height: 150px;text-align:left'><h1 style='color:red'>Il n'ya aucune opportunité de stage publiée</h1></div>";
?> 
</div>
<?php
    echo"<p><div class=' row' style=' background:  #EBF0EF;'>". $this->pagination->create_links()."</div>";
?>

        
    </div>
    </div>
      
     
        
        <!--================ start footer Area  =================-->    
        <?php
        include VIEWPATH.'includes/footer.php';
        ?>
    </body>
</html>

<script>

         $(document).ready( function () {
          const today = new Date()
const tomorrow = new Date(today)
tomorrow.setDate(tomorrow.getDate() + 1)
        $('#lien1').css('color', 'black');
         $('#date').datetimepicker({minDate: tomorrow});
         $('#date1').datetimepicker({minDate: tomorrow});
    });

    $('.admin').mouseenter(function(){
  // $(document).on('click','.mail',function(){
   var id=$(this).attr("id"); 
   // alert(id);
 $('.'+id).show();
 // alert(id);
  // alert(id); 
 
});

$('.admin').mouseleave(function(){
  // $(document).on('click','.mail',function(){
   var id=$(this).attr("id"); 
   // alert(id);
 $('.'+id).hide();
  // alert(id); 
});
</script>

