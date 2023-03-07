
<?php

$rupture=$this->Model->getRequete("SELECT COUNT(*) AS N FROM (SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT  )-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE  FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))<=0) table1");


$seuil=$this->Model->getRequete("SELECT COUNT(*) AS N FROM (SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE  FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))>0 AND ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))<10) table2");


// $peremption=$this->Model->getRequete("SELECT COUNT(NOM_PRODUIT) AS N FROM (SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage)) table3");

$today=date("Y-m-d");

$peremption=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$today."'");

$date = new DateTime($today); // Y-m-d
$date->add(new DateInterval('P30D'));
$new_date=$date->format('Y-m-d');

$peremption_dat=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$new_date."' and DATE_PERAMPTION>='".$today."'");

$date1 = new DateTime($today); // Y-m-d
$date1->add(new DateInterval('P180D'));
$new_date1=$date1->format('Y-m-d');

$peremption_dat1=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$new_date1."' and DATE_PERAMPTION>='".$new_date."'");

// echo $date->format('Y-m-d') . "\n";

$tot=$rupture[0]['N']+$seuil[0]['N']+count($peremption)+count($peremption_dat)+count($peremption_dat1);

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
if ($tot>0) {

      ?>

      <li class="nav-item dropdown blink" style="width: ">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" style="color: green"><?=$tot?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$tot?> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/rupture" class="dropdown-item" style="color: red">
            <i class="nav-icon fas fa-gifts"></i> <?=$rupture[0]['N']?> Ruptures de stock
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/Seuil" class="dropdown-item" style="color: orange">
            <i class="nav-icon fas fa-gifts"></i> <?=$seuil[0]['N']?> seuil de sécurité
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/peremption" class="dropdown-item" style="color: red">
            <i class="nav-icon fas fa-gifts"></i> <?=count($peremption)?> Nouvelles peremptions
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url()?>Notification/peremption_day" class="dropdown-item" style="color: orange">
            <i class="nav-icon fas fa-gifts"></i> <?=count($peremption_dat)?> Perimés dans 30jours
          </a>
          <div class="dropdown-divider"></div>
          
          <a href="<?=base_url()?>Notification/peremption_day_180" class="dropdown-item" style="color: green">
            <i class="nav-icon fas fa-gifts"></i> <?=count($peremption_dat1)?> Perimés entre 30 et 180jours
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
          <a href="<?=base_url('Profil')?>" class="dropdown-item dropdown-footer">Mon Profil</a>
          <a href="<?=base_url('Login/do_logout')?>" class="dropdown-item dropdown-footer">Déconnexion</a>
        </div>
      </li>
    </ul>
  </nav>