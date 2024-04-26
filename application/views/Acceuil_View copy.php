<?php
  include VIEWPATH.'includes/new_header.php';
  ?>


<body class="with-welcome-text">
  <div class="container-scroller">

  <?php
    include VIEWPATH.'includes/header.php';
  ?>

    <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    
    <?php
      include VIEWPATH.'includes/setting_color.php';
    ?>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->


    <?php
      include VIEWPATH.'includes/new_menu_principal.php';
    ?>
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-12">
                  <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1>Acceuil</h1>
                      </div>
                      <div class="col-sm-6">
                      
                      </div>


                    </div>
                    <?php 
                                      if(!empty($this->session->flashdata('message')))
                                        echo $this->session->flashdata('message');
                        ?>
                  </div>
                </section>
                
           
                  </div>
                </div>
              </div>
      </div>
     </div>
   </div>

        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

    
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
</body>

</html>