<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
  
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
    $employe= $this->Model->getRequeteOne(" SELECT rh_employe_affectation.ID_DIRECTION, organigramme_direction.DESCRIPTION AS DIRECTION, organigramme_direction.ACCORDE_CONGE AS ACORD_DIRECTION, rh_responsabilite.DESCRIPTION AS ID_RESPONSABILITE, rh_employe_affectation.ID_DEPARTEMENT, organigramme_departement.DESCRIPTION AS DEPARTEMENT, organigramme_departement.ACCORDE_CONGE AS ACORD_DEPARTEMENT, rh_employe_affectation.ID_SERVICE, organigramme_service.DESCRIPTION AS SERVICE, organigramme_service.ACCORDE_CONGE AS ACORD_SERVICE, rh_employe.NOM, rh_employe.PRENOM , rh_employe.ID_EMPLOYE FROM rh_employe_affectation JOIN organigramme_direction ON organigramme_direction.ID_DIRECTION = rh_employe_affectation.ID_DIRECTION LEFT JOIN organigramme_departement ON organigramme_departement.ID_DEPARTEMENT = rh_employe_affectation.ID_DEPARTEMENT LEFT JOIN organigramme_service ON organigramme_service.ID_SERVICE = rh_employe_affectation.ID_SERVICE JOIN rh_employe ON rh_employe.ID_EMPLOYE = rh_employe_affectation.ID_EMPLOYE JOIN rh_responsabilite ON rh_responsabilite.ID_RESPONSABILITE = rh_employe_affectation.ID_RESPONSABILITE WHERE rh_employe_affectation.STATUS_AFFECTATION = 1 AND rh_employe_affectation.ID_EMPLOYE =  ".$this->session->userdata('BANCOBU_ID_USER')." ");
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $nouveau_url?>dist/icons.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $employe['NOM'] ?> <?php echo $employe['PRENOM'] ?></h3>

                <p class="text-muted text-center"><?php echo $employe['ID_RESPONSABILITE'] ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Dir.</b> <a class="float-right"><?php echo $employe['DIRECTION'] ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Dep.</b> <a class="float-right"><?php echo $employe['DEPARTEMENT'] ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Ser.</b> <a class="float-right"><?php echo $employe['SERVICE'] ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-success card-tabs">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link  active" href="#activity" data-toggle="tab">Cong&eacute;</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Mes donnes</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    

                    <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>Exercice</th>
                    <th>Type conge</th>
                    <th>Date Demande</th>
                    <th>Nb jours</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($listconge as $key) 
                    {
                      
                     echo "<tr>
                     <td>".$key['EXERCICE']."</td>
                     <td>".$key['NOM_CONGE']."</td>
                     <td>".$key['DATE_SYSTEME_DEMANDE']."</td>                
                     <td>".$key['NB_JOURS_ACCORDE']."</td>
                     <td>".$key['DESCRIPTION']."</td>
                   </tr>";
                }
                  ?>
                  </tbody>
                </table>



                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->

                    
                    <?php
                    $empl_donnes=$this->Model->getRequeteOne('SELECT NOM, PRENOM, DESCRIPTION, EMAIL, TEL, DATE_ENTRE_SERVICE FROM rh_employe JOIN rh_sexe ON rh_sexe.ID_SEXE = rh_employe.ID_SEXE WHERE  1 AND '.$this->session->userdata('BANCOBU_ID_USER').' ');

                    ?>

                    <table class="table">
                      <tr>
                        <td>Nom & Pr&eacute;nom</td>
                        <td><?php echo $empl_donnes['NOM'] ?> <?php echo $empl_donnes['PRENOM'] ?></td>
                        <td>Sexe</td>
                        <td><?php echo $empl_donnes['DESCRIPTION'] ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $empl_donnes['EMAIL'] ?></td>
                        <td>T&eacute;l&eacute;phone</td>
                        <td><?php echo $empl_donnes['TEL'] ?></td>
                      </tr>
                      <tr>
                        <td>Date entre service</td>
                        <td colspan="3"><?php echo $empl_donnes['DATE_ENTRE_SERVICE'] ?></td>
                        
                      </tr>
                    </table>
                    
                  </div>
                  <!-- /.tab-pane -->

                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
 include VIEWPATH.'includes/new_copy_footer.php';  
  ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
  include VIEWPATH.'includes/new_script.php';
  ?>

<!-- jQuery UI -->
<script src="<?php echo $nouveau_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->

<!-- fullCalendar 2.2.5 -->

<script src="<?php echo $nouveau_url ?>plugins/fullcalendar/main.js"></script>
<script src='<?php echo $nouveau_url ?>plugins/fullcalendar/locales/fr.js'></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->

<!--  -->
</body>
</html>
