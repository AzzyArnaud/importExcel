<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Historique</title>
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
    <style type="text/css">
      b{color: black}
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
                        <h2>Historique de BIJE</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">Historique</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    </div>


    <!-- MODAL MODIFICATION DE HISTORIQUE -->
    <div class='modal fade' id='modification' tabindex="-1">
    <div class='modal-dialog  modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          
          <h3 class="modal-title">Modification</h3>
          <!-- <button class="close" data_dismiss="modal">&times;</button> -->
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body" id="dialog" title="Enregistrement"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));height:100%;background-size:10px 10px;}">
            <span id="msg"></span>
         <form id="myform" action="<?= base_url('qui_sommes_nous/Historique/modifier/') ?>" method="POST" enctype="multipart/form-data">
    
        <div class="col-md-12 sm-12 xs-12 form-group">
            
        <textarea name="description" id="description" class="form-control description"><?=$descr['DESCRIPTION']?></textarea>
            
        </div>
       
        <div class="col-md-12 form-group">     

            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
        
        </div>

</form>

      </div>
    </div>
  </div>
</div>
     <div class="container" style="margin-bottom:0px; background: white;">
        <p style="margin-top: 20px"></p>
                        <h3 class="text-center" style="margin-top: 20px">
                            Historique 
                             <?php
                            if ($this->session->userdata('PROFIL')=='Super admin'||$this->session->userdata('PROFIL')=='admin') {
                            ?>
                            <a href='' data-toggle='modal' data-target='#modification'><span class="lnr lnr-pencil" style='color:#266C67'></span></a>
                            <a href='<?=base_url()?>qui_sommes_nous/Historique/vider' ><span class="lnr lnr-trash" style='color:red'></span></a>
                            <?php
                                }
                            ?>
                        </h3>
                        <p></p>
                        <div class="row">
                <div class="Columns col-lg-12" style="padding: 10px;">
                    
                    <?=$descr['DESCRIPTION']?>
    
                </div>
            <div class="col-lg-6"  id="contact"></div>
            </div>
     </div>
      
     
        
        <!--================ start footer Area  =================-->	
        <?php
        include VIEWPATH.'includes/footer.php';
        ?>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </body>
    
</html>
 </script>

 <script type="text/javascript">
      $(function() {

$('.description').summernote({
          toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'clear']],
    // ['font', ['strikethrough', 'superscript', 'subscript']],
    // ['fontsize', ['fontsize']],
    // ['color', ['color']],
    ['para', ['ul', 'ol']],
    // ['height', ['height']]
  ],
  dialogsInBody: true,


  height: "300px",
    callbacks: {
       onInit:function(){
    $('body > .note-popover').hide();
  },
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

            e.preventDefault();

            // Firefox fix
            setTimeout(function () {
                document.execCommand('insertText', false, bufferText);
            }, 10);
        },

    }
});

  })

  
  </script> 
 <!--  <script type="text/javascript">
         tinymce.init({
            selector:'#description',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 200,           
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });


// tinymce.init({
//   selector: 'textarea#description'
// });
  </script> -->
