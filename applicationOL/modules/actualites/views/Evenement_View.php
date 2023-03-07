<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Evenements</title>
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
<div id="presentation" class="container-fluid" >
<!-- <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content">
                        <h2>Publication des evenements </h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">Evenement</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
    <div class="container" style="margin-bottom:0px; background: white;">
        <p style="margin-top: 20px"></p>
        <section class="blog_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
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
         <form id="myform" action="<?= base_url('actualites/Evenement/add') ?>" method="POST" enctype="multipart/form-data">
    

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
            <label>Photos(si existe):</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
        <input type="file" name="fotos"  accept="image/*" multiple id="gallery-photo-add" >

    
    <!-- <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" style="display: none;"> -->

            
        </div>
        <div class="gallery"></div>
    </div>
    <div class="container-fluid row" >
         
        
        
    </div>
    <!-- <div class="row" > -->
    

    
        
    <div class="col-md-12 form-group">

        

            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
        
        </div>

</form>
<!-- <img id"crop" src="<?=base_url()?>uploads/19261795.jpg" style="width: 800px"> -->

      </div>
    </div>
  </div>
</div>

<?php
foreach ($info as $value) {
?>
<!-- SUPPRESSION -->
        <div class='modal fade' id='suppression<?=$value->ID?>' tabindex="-1">
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Suppréssion</h3>
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
                                                                            <a class='btn btn-danger btn-md' href='<?= base_url()?>actualites/Evenement/delete/<?=$value->ID?>'>Supprimer</a>
                                                                            <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                                        </div>
    </div>
  </div>
</div>                     

                        <!-- MODAL UPDATE -->
<div class='modal fade' id='modification<?=$value->ID?>' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modification d'une actualité</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>
         <form id="myform" action="<?= base_url('actualites/Evenement/update/') ?><?=$value->ID?>" method="POST" enctype="multipart/form-data">
    

<div class="container-fluid row" >
    
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Titre de l'actualité:</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
        
    <input type="text" name="titre" id="titre" value="<?=$value->TITRE?>" class="form-control input-sm" autocomplete="off" required>       
        </div>
        
    </div>
    <div class="container-fluid row" >
         <div class="col-md-12 sm-12 xs-12 form-group">
            <label>Description de l'actualité:</label>
        <!-- </div>
        <div class="col-md-8 sm-12 xs-12 form-group"> -->
        <textarea name="description" id="description"  class="form-control description" required><?=$value->DESCRIPTION?></textarea>
            
        </div>
    
    </div>
    
    <div class="container-fluid row" >
         <div class="col-md-4 sm-12 xs-12 form-group">
            <label>Photos(si existe):</label>
        </div>
        <div class="col-md-8 sm-12 xs-12 form-group">
        <input type="file" name="fotos"  accept="image/*" multiple id="gallery-photo-add" >

    
    <!-- <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" style="display: none;"> -->

            
        </div>
        <div class="gallery"></div>
    </div>
    <div class="container-fluid row" >
         
        
        
    </div>
    <!-- <div class="row" > -->
    

    
        
    <div class="col-md-12 form-group">

        

            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
        
        </div>

</form>
<!-- <img id"crop" src="<?=base_url()?>uploads/19261795.jpg" style="width: 800px"> -->

      </div>
    </div>
  </div>
</div>
<?php
}
?>

                                <?php if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
    
                                ?>
                                    <div  class="col-md-2"  style="background: ; ">
                                     <a href="" data-toggle="modal" data-target="#srcs"> <div id='srvc' class="inner-block"  style="background: ;width: 100% ; border: 1px solid  #DCDCDC;border-radius: 25px;text-align: center; margin-bottom: 10px">Ajouter

                                        </div></a>


                                </div>
                                <?php } ?>
                        <div class="blog_left_sidebar">
                            <div class="row">


    <div class="col-md-8" style="text-align: left;"></div><div class="col-md-4" style="text-align: left;">
         <form id="myform" action="<?= base_url('actualites/Evenement/recherche_info') ?>" method="POST" enctype="multipart/form-data">
            
            <div class="input-group mb-3">
          <input type="text" name="mot_cle" class="form-control" placeholder="Recherche" required >
          <div class="input-group-append">
            <button class="input-group-text" id="basic-addon2"><span class="lnr lnr-magnifier"></span></button>
          </div>
        </div>
         </form>
    </div></div>
                            <?= $this->session->flashdata('message') ?>
                            <?php
                            if (sizeof($info)>0) {
                              
                            
                            foreach ($info as $value) {
                             $views=$this->Model->getRequeteOne("SELECT count('*') as n FROM actualites_evenement_view WHERE ID_ACTUALITE=".$value->ID);
                             $date=new DateTime($value->DATE);
                
                            ?>
                            <article class="row blog_item admin" style=" margin-top: 20px">
                                <!-- <div class="col-lg-12"> -->
                                    
                               <div class="col-md-3">
                                   <div class="blog_info text-right">
                                        <div class="post_tag">
                                           
                                            <a class="active" href="#">Banque d'Investissement pour les jeunes</a>
                                            
                                        </div>
                                        <ul class="blog_meta list">

                                            <!-- <li><a href="#">Mark wiens<i class="lnr lnr-user"></i></a></li> -->
                                            <li><a ><?=$date->format('d/m/Y H:i:s');?><i class="lnr lnr-calendar-full"></i></a></li>
                                             <?php if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
    
                                            ?>
                                            <li><a ><?=$views['n']?> Views<i class="lnr lnr-eye"></i></a></li>
                                            
                                            <li><a href='' data-toggle='modal' data-target='#modification<?=$value->ID?>'><i class="lnr lnr-pencil" style='color:#266C67'></i></a></li>
                                            <li><a href='' data-toggle='modal' data-target='#suppression<?=$value->ID?>'><i class="lnr lnr-trash" style='color:red'></i></a></li>
                                            <?php
                                          }
                                            ?>
                                        </ul>
                                    </div>
                               </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="<?=base_url()?>uploads/actualite/<?=$value->FOTO?>" alt="">
                                        <div class="blog_details">
                                            <a href="#"><h2><?=$value->TITRE?></h2></a>
                                            <p><?=$value->DESCRIPTION?>.</p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </article>
                        <?php } }else echo "<div class='col-md-12' style=' background:  #EBF0EF; min-height: 150px;text-align:left'><h1 style='color:red'>Aucun évènement publié</h1></div>";

                        ?>
                            
                            <nav class="blog-pagination justify-content-center d-flex">
                                <?php
    echo"<p><div class=' row' style=' background:  #EBF0EF;'>". $this->pagination->create_links()."</div>";
?>
                                
                            </nav>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section> 
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
