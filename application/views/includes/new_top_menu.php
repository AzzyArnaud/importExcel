
<?php


// print_r($peremption);
// echo ($new_date);
// exit();

?>
<style type="text/css">
  .blink{

  animation: blink 5s infinite;
}
@keyframes blink{
  0% {
    background: red;
  }
  20% {
    background: white;
  }
  40% {
    background: red;
  }
  60% {
    background: white;
  }
  80% {
    background: red;
  }
  100% {
    background: white;
  }
}

@-webkit-keyframes blink{
  0% {
    background: red;
  }
  20% {
    background: green;
  }
  40% {
    background: yellow;
  }
  60% {
    background: blue;
  }
  80% {
    background: orange;
  }
  100% {
    background: red;
  }
}
</style>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="<?=base_url('vente/Vente')?>" role="button"><i class="nav-icon fas fa-cart-plus"></i>VENTE</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
    
      <!-- Notifications Dropdown Menu -->
      <?php
if ($this->session->userdata('tot')>0) {

      ?>

      <?php
$commande_nontraite = $this->Model->getRequeteOne('SELECT COUNT(ID_COMMANDE) AS nontraite FROM commandes WHERE STATUT=0');

$commande_nontrouve = $this->Model->getRequeteOne('SELECT COUNT(ID_COMMANDE) AS nontrouve FROM commandes WHERE STATUT=2');

$commande_tot = $commande_nontraite['nontraite'] + $commande_nontrouve['nontrouve'];

?>

<li class="nav-item dropdown blink" style="width: ">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" style="color: green"><?=$commande_tot;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"> <?=$commande_nontraite['nontraite']?> Notifications</span>
          
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>commandes/Commande/commande_non_traite" class="dropdown-item" style="color: red">
            <i class="nav-icon fas fa-gifts"></i> <?=$commande_nontraite['nontraite']?> Commandes non traitées
          </a>
          <a href="<?=base_url()?>commandes/Commande/personne_non_trouve" class="dropdown-item" style="color: red">
            <i class="nav-icon fas fa-gifts"></i> <?=$commande_nontrouve['nontrouve']?> personnes non trouvées
          </a>
        </div>
      </li>
&nbsp;&nbsp;

      <li class="nav-item dropdown blink" style="width: ">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" style="color: green"><?=$this->session->userdata('tot')?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$this->session->userdata('tot')?> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/rupture" class="dropdown-item" style="color: red">
            <i class="nav-icon fas fa-gifts"></i> <?=$this->session->userdata('rupture')?> Ruptures de stock
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/Seuil" class="dropdown-item" style="color: orange">
            <i class="nav-icon fas fa-gifts"></i> <?=$this->session->userdata('seuil')?> seuil de sécurité
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/peremption" class="dropdown-item" style="color: red">
            <i class="nav-icon fas fa-gifts"></i> <?=$this->session->userdata('peremption')?> Nouvelles peremptions
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/peremption_day" class="dropdown-item" style="color: orange">
            <i class="nav-icon fas fa-gifts"></i> <?=$this->session->userdata('peremption_dat')?> Perimés dans 30jours
          </a>
          <div class="dropdown-divider"></div>
          
          <a href="<?=base_url()?>Notification/peremption_day_180" class="dropdown-item" style="color: green">
            <i class="nav-icon fas fa-gifts"></i> <?=$this->session->userdata('peremption_dat1')?> Perimés entre 30 et 180jours
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
        </div>
      </li>

      <?php
      }

      ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?=base_url('Change_Pwd')?>" class="dropdown-item dropdown-footer">Mot de passe</a>
          <a href="<?=base_url('Login/do_logout')?>" class="dropdown-item dropdown-footer">Déconnexion</a>
        </div>
      </li>
    </ul>
  </nav>