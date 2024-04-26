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
                      <a id="myButton" href="<?= base_url()?>configuration/Customer/add" class="btn btn-otline-dark align-items-center active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a id="myButton" href="<?= base_url()?>configuration/Customer/Listing" class="btn btn-otline-dark"><i class="icon-printer"></i> List</a>
                      <a id="myButton" href="<?= base_url()?>configuration/Customer/Listing" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Import</a>
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
            <?php if($this->session->flashdata("message"))echo $this->session->flashdata("message");?>
           

          
            <div class="row">
                
		
        <!-- File upload form -->
        <div class="col-md-12">
            <form action="<?php echo base_url(); ?>configuration/Import/importFile" method="post" enctype="multipart/form-data">
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
