<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <style>
 button.active {
    background-color: #f8f9fa;
    color: #000;
}
table.dataTable thead th,
table.dataTable thead td {
    white-space: nowrap;
}

@media screen and (max-width: 767px) {
    table.dataTable thead th,
    table.dataTable thead td {
        white-space: normal;
    }
}
  </style>
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
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <div></div>
                  <div>
                    <div class="btn-wrapper">
                      <!-- <a id="myButton" href="<?= base_url()?>configuration/Customer/add" class="btn btn-otline-dark align-items-center active"><i class="mdi mdi-account-plus"></i> Nouveau</a> -->
                      <a id="myButton" href="<?= base_url()?>configuration/Solde/Listing" class="btn btn-otline-dark"><i class="icon-printer"></i> List</a>
                      <a id="myButton" href="<?= base_url()?>configuration/Solde" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Import</a>
                    </div>
                  </div>
                </div>
                
             </div>
              </div>
            </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-12">


                  <section class="content-header ">
                  <div class="container-fluid">
                    <div class="row mb-2">
                    <section class="content mt-3">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
                          
                        <div class="container">
            <h2 >import un fichier excel</h2>
          
            <!-- Display status message -->
						<?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>
           

          
            <div class="row">
                
		
        <!-- File upload form -->
        <div class="col-md-12">
            <form action="<?php echo base_url()?>configuration/Solde/importFile" method="post" enctype="multipart/form-data">
            <div class="row">
						<div class="form-group col-md-5">
              <label for="exampleInputEmail1">Institution <spam class="text-danger">*</spam> </label>
              <select class="form-select text-center" name="NOM_INSTITUTION" id="PROFIL_ID">
                    <option value="">-- Select --</option>
                    <?php
                    foreach ($institution as $inst) {
                     echo"<option value='".$inst['ID_INSTITUTION']."'>".$inst['NOM_INSTITUTION']."</option>";
                    }
                    ?>
                  </select>
              
              <?php echo form_error('ID_INSTITUTION', '<div class="text-danger">', '</div>'); ?>
            </div> 
            <div class="form-group col-md-5">
              <label for="exampleInputEmail1">Annee <spam class="text-danger">*</spam> </label>
              <select class="form-select text-center" name="SEASON_NAME">
                    <option value="">-- Select --</option>
                    <?php
                    foreach ($season as $seas) {
                     echo"<option value='".$seas['ID_SAISON']."'>".$seas['SEASON_NAME']." (".$seas['YEAR'].")</option>";
                    }
                    ?>
                  </select>
              
              <?php echo form_error('ID_SAISON', '<div class="text-danger">', '</div>'); ?>
            </div> 
						<div class="group-form col-md-4 mb-5">
							<label for="type_collecte" class="form-label"> Type Collecte</label>
							<select  id="TYPE_COLLECTE" class="form-select" name="TYPE_COLLECTE">
								<option class="text-center">--select---</option>
								<option value="1" class="text-center">Avance</option>
								<option value="2" class="text-center">Solde</option>
							</select>
							<?php echo form_error('TYPE_COLLECTE', '<div class="text-danger">', '</div>'); ?>

						</div>
					</div>
            
               <input type="file" name="uploadFile" require accept=".xls,.xlsx,.csv"/>
                <input type="submit" class="btn btn-primary" name="submit" value="IMPORT">
								
            </form>
        </div>
       
    </div>
</div>
<?php
  include VIEWPATH.'includes/new_script.php';
  include VIEWPATH.'includes/js_site.php';
  ?>
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>

</html>
