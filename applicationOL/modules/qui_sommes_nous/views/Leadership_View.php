<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Leadership</title>
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
        <!--  <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content">
                        <h2>Notre Leadership</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">notre Leadership</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
<!-- <center>
<span class="lnr lnr-warning" style="font-size:70px;color: red">Interface Leadership en construction</span>
</center> -->
      <div class="container mt-40" style="background: white;padding-top: 20px">
            <!-- <h3 class="text-center">Staff</h3> -->

<?= $this->session->flashdata('message_staff') ?>
                  <!-- MODAL AJOUT STAFF-->
<div class='modal fade' id='ajout_staff' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Ajout d'un staff</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>

        <form id="myform3" action="<?=base_url('qui_sommes_nous/Leadership/ajout_staff_reduise') ?>" method="POST" enctype="multipart/form-data">

    <div class="row">
    <div class="col-md-6 sm-12 xs-12 form-group">
    <label>Nom:</label>
  <input type="text" name="nom" id="nom" class="form-control input-sm" autocomplete="off" required>   
    </div>
     <div class="col-md-6 sm-12 xs-12 form-group">
    <label>Prénom:</label>
  <input type="text" name="prenom" id="prenom" class="form-control input-sm" autocomplete="off" >   
    </div>
     <div class="col-md-6 sm-12 xs-12 form-group">
    <label>Poste:</label>
  <input type="text" name="post" id="post" class="form-control input-sm" autocomplete="off" required>   
    </div>
     <div class="col-md-6 sm-12 xs-12 form-group">
    <label>Lien facebook:</label>
  <input type="text" name="face" id="face" class="form-control input-sm" autocomplete="off" >   
    </div>
     <div class="col-md-6 sm-12 xs-12 form-group">
    <label>Lien twitter:</label>
  <input type="text" name="twitter" id="twitter" class="form-control input-sm" autocomplete="off" >   
    </div>
    <div class="col-md-6 sm-12 xs-12 form-group">
                <label>Son historique:</label>
                <textarea name="historique" id="historique" class="form-control input-sm" ></textarea>
                 
              </div>
  </div>
 
  
  <div class="container-fluid row" >
     <div class="col-md-4 sm-12 xs-12 form-group">
      <label>Photo:</label>
    </div>
    <div class="col-md-8 sm-12 xs-12 form-group">
    <input type="file" name="fotos" accept="image/*" id="gallery-photo-addOLD" >

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
                    <a href="" data-toggle="modal" data-target="#ajout_staff"> <div id='srvc' class="inner-block"  style="background: ;width: 100% ; border: 1px solid  #DCDCDC;border-radius: 25px;text-align: center; margin-bottom: 10px; color:green">Ajouter

                    </div></a>


                    </div>
                    <?php } ?>
            <div class="row mt-30">
                <?php
              foreach ($staff as $value) {
              if ($value['FACEBOOK']==NULL) {
                $face="href='#staff'";
              }else{
                $face="href='".$value['FACEBOOK']."' target='_blank'";
              }
             
              if ($value['TWITTER']==NULL) {
                $twit="href='#staff'";
              }else{
                $twit="href='".$value['TWITTER']."' target='_blank'";;
              } 
              ?>
              <!-- HISTORIQUESTAFF -->
                        <div class='modal fade' id='historique<?=$value['ID_STAFF']?>' tabindex="-1">
                            <div class='modal-dialog '>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Historique de <?=$value['PRENOM']?> <?=$value['NOM']?> </h3>
                                  
                                  <!-- <button class="close" data_dismiss="modal">&times;</button> -->
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>

                                <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
                          height:100%;
                          background-size:10px 10px;}">
                                  <span id="msg"></span>
                                <?=$value['HISTORIQUE']?>

                              </div>
                              <div class='modal-footer'>
                                                                          
                                                                            <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                                        </div>
                            </div>
                          </div>
                        </div>
<!-- SUPPRESTION STAFF -->
                        <div class='modal fade' id='suppression_staff<?=$value['ID_STAFF']?>' tabindex="-1">
                            <div class='modal-dialog '>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Suppression d'un staff</h3>
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
                                                                            <a class='btn btn-danger btn-md' href='<?= base_url()?>qui_sommes_nous/Leadership/delete_staff/<?=$value['ID_STAFF']?>'>Supprimer</a>
                                                                            <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                                        </div>
                            </div>
                          </div>
                        </div> 

                                <!-- MODAL AJOUT STAFF-->
<div class='modal fade' id='modif_staff<?=$value['ID_STAFF']?>' tabindex="-1">
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modiffication d'un staff</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
  height:100%;
  background-size:10px 10px;}">
          <span id="msg"></span>

                  <form id="myform3" action="<?=base_url('qui_sommes_nous/Leadership/update_staff_reduise/') ?><?=$value['ID_STAFF']?>" method="POST" enctype="multipart/form-data">

              <div class="row">
              <div class="col-md-6 sm-12 xs-12 form-group">
              <label>Nom:</label>
            <input type="text" name="nom" id="nom" class="form-control input-sm" autocomplete="off" value="<?=$value['NOM']?>" required>   
              </div>
               <div class="col-md-6 sm-12 xs-12 form-group">
              <label>Prénom:</label>
            <input type="text" name="prenom" value="<?=$value['PRENOM']?>" id="prenom" class="form-control input-sm" autocomplete="off" >   
              </div>
               <div class="col-md-6 sm-12 xs-12 form-group">
              <label>Poste:</label>
            <input type="text" name="post" id="post" value="<?=$value['POST']?>" class="form-control input-sm" autocomplete="off" required>   
              </div>
               <div class="col-md-6 sm-12 xs-12 form-group">
              <label>Lien facebook:</label>
            <input type="text" name="face" id="face" value="<?=$value['FACEBOOK']?>" class="form-control input-sm" autocomplete="off" >   
              </div>
               <div class="col-md-6 sm-12 xs-12 form-group">
              <label>Lien twitter:</label>
            <input type="text" name="twitter" id="twitter" value="<?=$value['TWITTER']?>" class="form-control input-sm" autocomplete="off" >   
              </div>
              <div class="col-md-6 sm-12 xs-12 form-group">
                <label>Son historique:</label>
                <textarea name="historique" id="historique" class="form-control input-sm" ><?=$value['HISTORIQUE']?></textarea>
                 
              </div>
            </div>
           
            
            <div class="container-fluid row" >
               <div class="col-md-4 sm-12 xs-12 form-group">
                <label>Photo:</label>
              </div>
              <div class="col-md-8 sm-12 xs-12 form-group">
              <input type="file" name="fotos" accept="image/*" id="gallery-photo-addOLD" >

            <input type="file" name="pj" id="pj" class="form-control input-sm" autocomplete="off" style="display: none;">

                
              </div>
              <!-- <div class="gallery"></div> -->
            </div>
            <div class="container-fluid row" >
               
              
              
            </div>
            
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


                <div class="col-md-4 col-sm-6" style="margin-bottom: 20px">
                    <div class="box16">
                        <img src="<?=base_url()?>uploads/staff/<?=$value['FOTO']?>" class="staff">
                        <div class="box-content">
                            <h3 class="title"><?=$value['PRENOM']?> <?=$value['NOM']?></h3>
                            <span class="post"><?=$value['POST']?></span>
                            <ul class="social">
                                <li><a <?=$face?>><i class="fa fa-facebook"></i></a></li>
                                <li><a <?=$twit?>><i class="fa fa-twitter"></i></a></li>
                                <li><a  href="#" data-toggle='modal' data-target='#historique<?=$value['ID_STAFF']?>'><i class="fa fa-eye"></i></a></li>
                                 <?php
                        if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
                            ?>
                                <li><a href="#" data-toggle='modal' data-target='#modif_staff<?=$value['ID_STAFF']?>'><i class="lnr lnr-pencil" style=''></i></a></li>
                                <li><a href="#" data-toggle='modal' data-target='#suppression_staff<?=$value['ID_STAFF']?>'><i class="lnr lnr-trash" style="color: red"></i></a></li>
                                 <?php
                                  }
                                  ?>
                            </ul>
                        </div>
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

