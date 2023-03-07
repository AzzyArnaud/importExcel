<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Fonds</title>
        <?php
    meta_tags();
  ?>
        <!-- Bootstrap CSS -->
        <?php
    $active1="";
    $active2="active";
    $active3="";
    $active4="";
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
  <!-- <div class="container-fluid" style="border-top: 20px solid #B3001B;"> -->
  <div id="presentation" class="container-fluid" >
 
<!-- <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content">
                        <h2>Partenaires de fonds</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">Partenaires de fonds</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
<div class="container" style="margin-bottom:0px; background: white;margin-top: 10px; padding: 10px">
    <?= $this->session->flashdata('message') ?>
    <h3 class="text-center" style="margin-top: 20px">Nos partenaires</h3>

    <!-- MODAL ADD-->
<div class='modal fade' id='srcs' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Ajout d'un partenaire de fonds'</h3>
          <!-- <button class="close" data_dimdiss="modal">&times;</button> -->
          <button type="button" class="close" data-dimdiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Authentification"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('qui_sommes_nous/Fonds/add') ?>" method="POST" enctype="multipart/form-data" style='text-align: left;'>
    <div class="container-fluid row" >
     <div class="col-md-4 md-12 xs-12 form-group">
      <label>Nom:</label>
    </div>
    <div class="col-md-8 md-12 xs-12 form-group">
    
  <input type="text" name="nom" id="nom" class="form-control input-md" autocomplete="off" required>   
    </div>
    
  </div>
    <div class="container-fluid row" >
         <div class="col-md-4 md-12 xs-12 form-group">
            <label>Photo ou logo:</label>
        </div>
        <div class="col-md-8 md-12 xs-12 form-group">
        
    <input type="file" name="fotos" accept="image/*" class="form-control input-md" required>
   
            
        </div>
    <div class="gallery"></div> 
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
<!-- FIN MODAL -->
<?php
foreach ($partenaire as $v) { 
?>
<!-- SUPPRESTION PARTENAIRE -->
                        <div class='modal fade' id='suppression<?=$v['ID']?>' tabindex="-1">
                            <div class='modal-dialog '>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Suppression d'un partenaire</h3>
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
                                                                            <a class='btn btn-danger btn-md' href='<?= base_url()?>qui_sommes_nous/Fonds/delete/<?=$v['ID']?>'>Supprimer</a>
                                                                            <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                                        </div>
                            </div>
                          </div>
                        </div>
<!-- MODAL update-->
<div class='modal fade' id='modif<?=$v['ID']?>' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modification d'un partenaire de fonds'</h3>
          <!-- <button class="close" data_dimdiss="modal">&times;</button> -->
          <button type="button" class="close" data-dimdiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Authentification"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('qui_sommes_nous/Fonds/update/') ?><?=$v['ID']?>" method="POST" enctype="multipart/form-data" style='text-align: left;'>
    <div class="container-fluid row" >
     <div class="col-md-4 md-12 xs-12 form-group">
      <label>Nom:</label>
    </div>
    <div class="col-md-8 md-12 xs-12 form-group">
    
  <input type="text" name="nom" id="nom" class="form-control input-md" value="<?=$v['NOM']?>" autocomplete="off" required>   
    </div>
    
  </div>
    <div class="container-fluid row" >
         <div class="col-md-4 md-12 xs-12 form-group">
            <label>Photo ou logo:</label>
        </div>
        <div class="col-md-8 md-12 xs-12 form-group">
        
    <input type="file" name="fotos" accept="image/*" class="form-control input-md" >
   
            
        </div>
    <div class="gallery"></div> 
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
<!-- FIN MODAL -->
<?php
}
?>

     <?php if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
    # code...
?>
    <div  class="col-md-2"  style="background: ;  text-align:center; margin-bottom: 10px ">
     <a href="" data-toggle="modal" data-target="#srcs"> <div id='' class="inner-block"  style="background: ;width: 100% ; border: 1px solid  #DCDCDC;border-radius: 25px;">
<!-- <i class="fas fa-plus " style="color:#DCDCDC;"></i> -->+</div></a>

</div>
<?php } ?>
<div class="row">
<?php
if(sizeof($partenaire)!=0){
// print_r($fotos);
  foreach ($partenaire as $v) { 
    $id=$v['ID'];

     echo "<div  class='col-md-2 admin'  id='".$v['ID']."'><div class='container row ".$v['ID']."' style='display:none'>";
    if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {

     echo "<div id='gestion' class='row ".$v['ID']."' style='display:none'><a href='' data-toggle='modal' data-target='#modif".$v['ID']."'><div  class='col-md-3'><span class='lnr lnr-pencil' style='color:#266C67'></span></div></a><div  class='col-md-3'><a href='' id='".$v['ID']."' class='delete' data-toggle='modal' data-target='#suppression".$v['ID']."'><span class='lnr lnr-trash' style='color:red'></span></div></a></div>";

     }
    ?>

       
     </div>
     <div> 
     <!-- Grid column -->
  <!-- <div class="col-lg-3 col-md-12"> -->

    
 <a><img src="<?=base_url()?>uploads/partenaire/<?=$v['FOTO']?>" class="staff" width='100%'>
        </a><a href='#'><!--  --></a></div><div style='background:#EBF0EF;margin-bottom:20px;text-align: center'><?=$v['NOM']?></div></div>
    

  <!-- </div> -->
  <!-- Grid column -->
     <?php
  }
}else echo "<h3 style='color:red'>Aucun partenaire enregistré </h3>"; 
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
$('.staff').each(function(){

    var width=$(this).width()*70/100;

        $(this).height(width);

});

$(window ).resize(function(){
              $('.staff').each(function(){

          var width=$(this).width()*70/100;

              $(this).height(width);

      });
    });
</script>
<script>
    
$('.admin').mouseenter(function(){
  // $(document).on('click','.mail',function(){
   var id=$(this).attr("id"); 
   // alert(id);
 $('.'+id).show();
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
