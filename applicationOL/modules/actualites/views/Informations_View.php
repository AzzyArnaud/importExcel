<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Informations</title>
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
    $active6="";
    $active7="active";
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
 <!-- <div class="container-fluid" style="border-top: 20px solid #B3001B;"> -->
<div id="presentation" class="container-fluid">
<!-- <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content">
                        <h2>Publication d’Information </h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">Information</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
    <div class="container" style="margin-bottom:0px; background: white;">
        
 <?= $this->session->flashdata('message') ?>
<!-- MODAL DELETE -->
<div class='modal fade' id='mydelete'>
            <div class='modal-dialog'>
                <div class='modal-content'>

                    <div class='modal-body'>
                        <h5>  Voulez-vous vraiment Supprimer cette actualité?</h5>
                    </div>

                    <div class='modal-footer'>
                        <a class='btn btn-danger btn-md' id="delete_modal" href="">Supprimer</a>
                        <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                    </div>

                </div>
            </div>
        </div>
<!-- MODAL AJOUT -->
<div class='modal fade' id='srcs' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Ajout d'une actualité</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('Actualite/ajout') ?>" method="POST" enctype="multipart/form-data">
  

<div class="container-fluid row" >
  
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Titre de l'actualité:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    
  <input type="text" name="titre" id="titre" class="form-control input-sm" autocomplete="off" required>   
    </div>
    
  </div>
  <div class="container-fluid row" >
     <div class="col-md-12 sm-12 xs-12 form-group">
      <label>Description de l'actualité:</label>
    <!-- </div>
    <div class="col-md-8 sm-12 xs-12 form-group"> -->
    <textarea name="description" id="description" class="form-control description" required></textarea>
      
    </div>
  
  </div>
  
  <div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Les photos representant l'actualité:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    <input type="file" name="foto[]" multiple id="gallery-photo-add" required>

  
  <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" style="display: none;">

      
    </div>
    <div class="gallery"></div>
  </div>
  <div class="container-fluid row" >
     
    
    
  </div>
  <!-- <div class="row" > -->
  
  <!-- </div> -->
  <div class="image-upload" style="margin-top: 20px">
   
    <label for="pj">
 <i class="fas fa-paperclip" style="font-size: 40px" align='right'></i>
 
 </label><label id="piece_jointe"></label>
    <input id="file-input" type="file" style="display: none" />
    
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

<!-- MODAL MODIFICTION -->
<div class='modal fade' id='modification' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modification d'une activité</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('actualite/modifier') ?>" method="POST" enctype="multipart/form-data">
  

<div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Titre de l'actualité:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    
  <input type="hidden" name="id" id="id" class="form-control input-sm" autocomplete="off" required>   
  <input type="text" name="titre1" id="titre1" class="form-control input-sm" autocomplete="off" required>   
    </div>
    
  </div>
  <div class="container-fluid row" >
     <div class="col-md-12 sm-12 xs-12 form-group">
      <label>Description de l'actualité:</label>
    <!-- </div>
    <div class="col-md-8 sm-12 xs-12 form-group"> -->
    <textarea name="description1" id="description1" class="form-control description" required></textarea>
      
    </div>
  
  </div>
  <div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Les photos representant l'actualité:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    <input type="file" name="foto1[]" multiple id="gallery-photo-add1">

  
  <input type="file" name="p_j" id="p_j" class="form-control input-sm" autocomplete="off" style="display: none;">

      
    </div>
    <div class="gallery1"></div>
  </div>
  <!-- <div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Foto representant l'actualité:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    
  <input type="file" name="foto1" id="foto1" accept="image/*" class="form-control input-sm" autocomplete="off" style="display: none;">
<input type="file" name="p_j" id="p_j" class="form-control input-sm" autocomplete="off" style="display: none;">

   <img id="image_modif" src="" class="container image" >    
    </div>
    
  </div> -->
  <div class="image-upload">
    
    <label for="p_j">
 <i class="fas fa-paperclip" style="font-size: 40px" align='right'></i>
 
 </label><label id="pieceJointe"></label>
    <input id="file-input" type="file" style="display: none" />
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

<div>.</div>
  <?php if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
  # code...
?>
    <div  class="col-md-2"  style="background: ">
   <a href="" data-toggle="modal" data-target="#srcs"> <div id='srvc' class="inner-block"  style="background: ;width: 100% ; border: 1px solid  #DCDCDC;border-radius: 25px;text-align: center; margin-bottom: 10px;margin-top: 10px ">
        Ajouter
    </div></a>


</div>
<?php } ?>
<div class="row" style="">
<!-- 
  <div id="" class="outer">
    <div id="" class="inner">
<img width="100%" src="http://media.indiatimes.in/media/photogallery/2012/Dec/best_images_of_2012_1355117665_1355117684.jpg"/></div>

</div> -->

  <div class="col-md-8" style="text-align: left;"><h1 style="color: #266C67">Actualités</h1></div><div class="col-md-4" style="text-align: left;">
     <form id="myform" action="<?= base_url('Actualite/recherche_actualite') ?>" method="POST" enctype="multipart/form-data">
      
            <div class="input-group mb-3">
      <input type="text" name="mot_cle" class="form-control" placeholder="Recherche" required >
      <div class="input-group-append">
        <button class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></button>
      </div>
    </div>
     </form>
  </div>
<?php 
if(sizeof($actualites)!=0){
  // $i=0;
foreach ($actualites as $value) {
$ftos1=$this->Model->getList('actualites_foto',array('ACTUALITE_ID'=>$value->ID));  
  ?>
  <!--Modal: Name-->
    <div class="modal fade" id="modal1<?=$value->ID?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <!--Content-->
        <div class="modal-content">

          <!--Body-->
          <div class="modal-body mb-0 p-0" style="padding: 10px">
            <center>
            <?php
            foreach ($ftos1 as $key) {
              ?>
            
              <img src='<?=base_url()?>uploads/actualite/<?=$key['FOTO']?>' width='90%' height='' class='' style="margin: 10px">

              <?php
              }
            ?>
            </center>
          </div>

          <!--Footer-->
          <div class="modal-footer justify-content-center">
            <span class="mr-4">CHUK galerie photo</span>
            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
            <!--Twitter-->
            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
            <!--Google +-->
            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
            <!--Linkedin-->
            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

            <button type="button" class="btn btn-outline-success btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

          </div>

        </div>
        <!--/.Content-->

      </div>
    </div>
    <!--Modal: Name-->

<div class="col-md-12 admin" id='<?=$value->ID?>' style="margin: 0px 0px 2px 0px; padding: 10px 10px 10px 10px; background:  #EBF0EF;">
  <div class="row">
    <?php
    $ftos=$this->Model->getListLimit2('actualites_foto',4,array('ACTUALITE_ID'=>$value->ID));
    
    if( sizeof($ftos)==0){
    ?>
    <div class="col-md-9">

    <?php
    }else{
    ?>
    <div class="col-md-6">
      <?php
    }
        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
  
  echo "<div id='gestion' class='row ".$value->ID."' style='display:none'><a href='' data-toggle='modal' data-target='#modification'><div  class='col-md-6'><i class='fas fa-pencil-alt' style='color:#266C67'></i></div></a><div  class='col-md-6'><a href='' id='".$value->ID."' class='delete' data-toggle='modal' data-target='#mydelete'><i class='far fa-trash-alt' style='color:red'></i></div></a></div>";

  }
      ?>
      <div><b><?=$value->TITRE?></b></div>
      <div>
        <?php
        $date=new DateTime($value->DATE);
        echo $date->format('d/m/Y H:i');
        ?>
        </div>

      <div><article> <p><?=$value->DESCRIPTION?></p></article></div>
    </div>
    <div class="col-md-6">
    <div class="row">
      <div class="col-md-6 aa">
      <div class="row">
    <?php
    $count=sizeof($ftos);
    
    if ($count>1) {
      $i=1;
      
      foreach ($ftos as $key){
        $n="";
        $opacity="";
      if($i==4){$n.="+";$n.= sizeof($ftos1)-4;$opacity="0.7";}
    ?>
    <div id="" data-toggle="modal" data-target="#modal1<?=$value->ID?>" class="outer1 col-sm-6"  style="background:  #c2deff url('<?=base_url()?>uploads/actualite/<?=$key['FOTO']?>') ;background-size:cover;float: left;padding: 2px;background-position: center center; opacity:<?=$opacity?> ;">
    <div id="" class="inner1"><span style="font-size:26px; color:white"><?=$n?></span>
  
      </div>
    </div>
    <?php
    $i++;
    }
    }else{
    foreach ($ftos as $key){
    ?>
    <div id="" class="outer" data-toggle="modal" data-target="#modal1<?=$value->ID?>">
    <div id="" class="inner">
  <img class="foto" src="<?=base_url()?>uploads/actualite/<?=$key['FOTO']?>" width="100%" height="100%" >
      </div>
    </div>
    <?php
    }
    }
    ?>
    </div>
    </div>
    <?php
    if($value->PIECE_JOINTE){
    ?>
    <div class="col-md-6"><i class="fas fa-paperclip" style="font-size: 30px" ></i>
      <a href="<?=base_url()?>uploads/actualite/<?=$value->PIECE_JOINTE?>" download>
        <i class="fas fa-download"  style="color:#266C67';font-size:16px"></i> <?=$value->PIECE_JOINTE?>
      </a>
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
}else echo "<div class='col-md-12' style=' background:  #EBF0EF; min-height: 150px;text-align:left'><h1 style='color:red'>Il n'ya aucune actualité</h1></div>";
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
    <script type="text/javascript">
    $(document).ready( function () {
        // var id=$(this).attr("id");
        // alert(id);
        $(".blog_details").each(function(){
    var readMoreHtml=$(this).html();
      var lessText=readMoreHtml.substr(0,800);

      if(readMoreHtml.length >800){
        $(this).html(lessText+"<span style='color:red'>[...]</span>").append("<a href='' class='blog_btn read-more-link'>Afficher tout</a>");
      }else{
        $(this).html(readMoreHtml);
      }
$(this).on('click','.read-more-link',function(event){
    event.preventDefault();
     $(this).parent('.blog_details').html(readMoreHtml).append("<a href='' class='blog_btn show-less'>Diminuer</a>");
});

$(this).on('click','.show-less',function(event){
    event.preventDefault();
     $(this).parent('.blog_details').html(lessText +"<span style='color:red'>[...]</span>").append("<a href='' class='blog_btn read-more-link'>Afficher tout</a>");
});
});
  });
</script>
