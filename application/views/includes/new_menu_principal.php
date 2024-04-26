
<nav class="sidebar sidebar-offcanvas bg-dark text-light" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url()?>">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Accueil</span>
      </a>
    </li>
    <!-- <li class="nav-item nav-category">UI Elements</li> -->

 
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Configuration</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Profil_Droit/listing">Droit & Profil</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/User/listing">Utilisateurs</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Produit/listing">Produits</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Customer/listing">Clients</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Season/listing">Seasons</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Institution_financiere/listing">Institution Financieres</a></li>
         
        </ul>
      </div>
    </li>
   
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
        aria-controls="form-elements">
        <i class="menu-icon mdi mdi-card-text-outline"></i>
        <span class="menu-title">Operations</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Avance/listing">Avance</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?=base_url();?>configuration/Solde/listing">Solde</a></li>
        </ul>
      </div>
    </li>
   
  </ul>
</nav>
