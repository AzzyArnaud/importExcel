<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <div class="text-center">
      <img src="<?php echo base_url()?>dist/straphael_favicon.png" alt="AdminLTE Logo" class="text-center" width="100">
    </div>
    
    <div class="text-center" style="color: #fff;">
      Stock & Vente
    </div>
    <!-- brand-text font-weight-light brand-link -->
   
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>dist/icons.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="" style="color:#fff">
          &nbsp;&nbsp;&nbsp;<?=$this->session->userdata('STRAPH_NOM')?> <?=$this->session->userdata('STRAPH_PRENOM')?>
        </div>
      </div>
     <!--  -->
      <!-- Sidebar Menu -->
      <nav class="mt-2" style="margin-bottom: 100px">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p> Acceuil </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('View_Stock')?>" class="nav-link <?php if($this->router->class == 'View_Stock'){ echo 'active';} else{ echo '';}  ?>">
              <i class="nav-icon fas fa-search"></i>
              <p> Recherche </p>
            </a>
          </li>

          
          <?php
      if (in_array('3',$this->session->userdata('STRAPH_DROIT'))){
      ?>
          <li class="nav-item <?php if($this->router->class == 'Stat_Vente_Med' || $this->router->class == 'Useras'|| $this->router->class == 'Barcodeasd'|| $this->router->class == 'RAPPORT_PRODUIT_VENTE'|| $this->router->class == 'Rapport_vente_text'){ echo 'menu-open';} else{ echo '';}  ?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Rapports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="<?=base_url()?>rapport/RAPPORT_PRODUIT_VENTE" class="nav-link <?php if($this->router->class == 'RAPPORT_PRODUIT_VENTE' ){ echo 'active';} else{ echo '';}  ?>">
                <i class="far fa-circle nav-icon"></i>
                <p> Vente produit </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url('vente/Stat_Vente_Med')?>" class="nav-link <?php if($this->router->class == 'Stat_Vente_Med' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vente Medicament</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('vente/Rapport_vente_text')?>" class="nav-link <?php if($this->router->class == 'Rapport_vente_text' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapport text vente</p>
                </a>
              </li>

           <!--  <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Achat </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Reduction </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Peremption </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Requisition </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Livraison </p>
              </a>
            </li> -->

  
            </ul>
          </li>
          <?php }?>

          <?php
          if (in_array('6',$this->session->userdata('STRAPH_DROIT')) || in_array('1',$this->session->userdata('STRAPH_DROIT')) || in_array('2',$this->session->userdata('STRAPH_DROIT')) || in_array('5',$this->session->userdata('STRAPH_DROIT'))){
          ?>
          <li class="nav-item <?php if($this->router->class == 'Profil_Droit' || $this->router->class == 'User'|| $this->router->class == 'Barcode'){ echo 'menu-open';} else{ echo '';}  ?>">
          
            <a href="#" class="nav-link <?php if($this->router->class == 'Profil_Droit' || $this->router->class == 'User'){ echo 'active';} else{ echo '';}  ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Configuration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
      if (in_array('1',$this->session->userdata('STRAPH_DROIT'))){
      ?>
              
              <li class="nav-item">
                <a href="<?=base_url('configuration/Profil_Droit/listing')?>" class="nav-link <?php if($this->router->class == 'Profil_Droit' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Droits & Profil</p>
                </a>
              </li>
            <?php }
            if (in_array('2',$this->session->userdata('STRAPH_DROIT'))){
              ?>
              
              <li class="nav-item">
                <a href="<?=base_url('configuration/User/listing')?>" class="nav-link <?php if($this->router->class == 'User' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>
            <?php }
            if (in_array('5',$this->session->userdata('STRAPH_DROIT'))){
              ?>

              <li class="nav-item">
                <a href="<?=base_url('configuration/Barcode')?>" class="nav-link <?php if($this->router->class == 'Barcode' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barcode</p>
                </a>
              </li>
            <?php }
            if (in_array('6',$this->session->userdata('STRAPH_DROIT'))){
              ?>
              

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotion</p>
                </a>
              </li>
            <?php }?>
              
            </ul>
          </li>
        <?php }?>

        <?php
          if (in_array('7',$this->session->userdata('STRAPH_DROIT')) || in_array('8',$this->session->userdata('STRAPH_DROIT')) || in_array('9',$this->session->userdata('STRAPH_DROIT')) || in_array('10',$this->session->userdata('STRAPH_DROIT')) || in_array('11',$this->session->userdata('STRAPH_DROIT')) || in_array('12',$this->session->userdata('STRAPH_DROIT'))){
          ?>
          <li class="nav-item <?php if( $this->router->class == 'Fournisseur'|| $this->router->class == 'Assurance'|| $this->router->class == 'Client'||$this->router->class == 'Societe'||$this->router->class == 'Type_Remise'||$this->router->class == 'Produit' ){ echo 'menu-open';} else{ echo '';}  ?>">
          
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gifts"></i>
              <p>
                Donn&eacute;es
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
              if (in_array('7',$this->session->userdata('STRAPH_DROIT'))){
              ?>
              
              <li class="nav-item">
                <a href="<?=base_url('configuration/Assurance')?>" class="nav-link <?php if($this->router->class == 'Assurance' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assurances</p>
                </a>
              </li>
            <?php }
            if (in_array('8',$this->session->userdata('STRAPH_DROIT'))){
            ?>

              <li class="nav-item">
                <a href="<?=base_url('configuration/Client')?>" class="nav-link <?php if($this->router->class == 'Client' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients</p>
                </a>
              </li>
              <?php }
            if (in_array('10',$this->session->userdata('STRAPH_DROIT'))){
            ?>
              <li class="nav-item">
                <a href="<?=base_url('configuration/Fournisseur')?>" class="nav-link <?php if($this->router->class == 'Fournisseur' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fournisseurs</p>
                </a>
              </li>
              <?php }
            if (in_array('9',$this->session->userdata('STRAPH_DROIT'))){
            ?>
              <li class="nav-item">
                <a href="<?=base_url('configuration/Societe')?>" class="nav-link <?php if($this->router->class == 'Societe' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Societés</p>
                </a>
              </li>
              <?php }
            if (in_array('11',$this->session->userdata('STRAPH_DROIT'))){
            ?>
              <li class="nav-item">
                <a href="<?=base_url('configuration/Type_Remise')?>" class="nav-link <?php if($this->router->class == 'Type_Remise' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Type Remises</p>
                </a>
              </li>
              <?php }
            if (in_array('12',$this->session->userdata('STRAPH_DROIT'))){
            ?>
              <li class="nav-item">
                <a href="<?=base_url('configuration/Produit')?>" class="nav-link <?php if($this->router->class == 'Produit' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produit</p>
                </a>
              </li>
              <?php }
            ?>

            </ul>
          </li>
          <?php }
            ?>
             <?php 
            if (in_array('13',$this->session->userdata('STRAPH_DROIT'))){
            ?>
          
          <li class="nav-item <?php if($this->router->class == 'Requisition' || $this->router->class == 'Entree_Stock'|| $this->router->class == 'Rapport_requisition' || $this->router->class == 'Stock' || $this->router->class == 'Sortie_Stock' || $this->router->class == 'Sortie_Stock' || $this->router->class == 'Declassement'|| $this->router->class == 'Stock_general'||$this->router->class == 'Stock_disparu'||$this->router->class == 'Stock_entre_ajustement'){ echo 'menu-open';} else{ echo '';}  ?>">

            <a href="#" class="nav-link <?php if($this->router->class == 'Requisition' || $this->router->class == 'Entree_Stock' || $this->router->class == 'Stock' || $this->router->class == 'Rapport_requisition' || $this->router->class == 'Sortie_Stock' || $this->router->class == 'Sortie_Stock' || $this->router->class == 'Declassement'|| $this->router->class == 'Rapport_requisition_text'|| $this->router->class == 'Stock_general'){ echo 'active';} else{ echo '';}  ?>">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Requisition & Stock
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?=base_url('requisition/Requisition')?>" class="nav-link <?php if($this->router->class == 'Requisition' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Requisition</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="<?=base_url('requisition/Entree_Stock')?>" class="nav-link <?php if($this->router->class == 'Entree_Stock' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entrées Stock</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?=base_url('requisition/Stock')?>" class="nav-link <?php if($this->router->class == 'Stock' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Actuel</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?=base_url('requisition/Stock_general')?>" class="nav-link <?php if($this->router->class == 'Stock_general' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Général</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="<?=base_url('requisition/Sortie_Stock')?>" class="nav-link <?php if($this->router->class == 'Sortie_Stock' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historique Sortie Stock</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="<?=base_url('requisition/Declassement')?>" class="nav-link <?php if($this->router->class == 'Declassement' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Endomag&eacute;</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('requisition/Stock_disparu')?>" class="nav-link <?php if($this->router->class == 'Stock_disparu' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sortie Stock ajustement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('requisition/Stock_entre_ajustement')?>" class="nav-link <?php if($this->router->class == 'Stock_entre_ajustement' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entré Stock ajustement</p>
                </a>
              </li>
              
              <!-- <li class="nav-item">
                <a href="<?=base_url('requisition/Rapport_requisition')?>" class="nav-link <?php if($this->router->class == 'Rapport_requisition' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapports graphique</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?=base_url('requisition/Rapport_requisition_text')?>" class="nav-link <?php if($this->router->class == 'Rapport_requisition_text' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapports textes</p>
                </a>
              </li>
             
              
            </ul>
          </li>
           <?php }
            if (in_array('4',$this->session->userdata('STRAPH_DROIT'))){
            ?>
          
          <li class="nav-item <?php if($this->router->class == 'Vente' || $this->router->class == 'Liste_Vente'|| $this->router->class == 'Rapport_vente' || $this->router->class == 'Retour_Vente'|| $this->router->class == 'Rapport_vente_par_utilisateur' || $this->router->class == 'Vente_List_Livraison' || $this->router->class == 'Vente_List_Dette' ){ echo 'menu-open';} else{ echo '';}  ?>">
            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Vente
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item ">
                 <a href="<?=base_url('vente/Vente')?>" class="nav-link <?php if($this->router->class == 'Vente' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nouveau</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="<?=base_url('vente/Liste_Vente')?>" class="nav-link <?php if($this->router->class == 'Liste_Vente' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url('vente/Retour_Vente')?>" class="nav-link <?php if($this->router->class == 'Retour_Vente' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Retour Vente</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url('vente/Vente_List_Dette')?>" class="nav-link <?php if($this->router->class == 'Vente_List_Dette' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dettes</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url('vente/Vente_List_Livraison')?>" class="nav-link <?php if($this->router->class == 'Vente_List_Livraison' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Livraison</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url('vente/Retour_Vente')?>" class="nav-link <?php if($this->router->class == 'Retour_Vente' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Retour Vente</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="<?=base_url('vente/Rapport_vente')?>" class="nav-link <?php if($this->router->class == 'Rapport_vente' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapports graphique</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('vente/Rapport_vente_par_utilisateur/index/').date("Y-m-d")?>" class="nav-link <?php if($this->router->class == 'Rapport_vente_par_utilisateur' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ventes par utilisateur</p>
                </a>
              </li>
            </ul>
          </li>
           

          <li class="nav-item <?php if($this->router->class == 'OBR'  ){ echo 'menu-open';} else{ echo '';}  ?>">
            <a href="<?=base_url('OBR/list_OBR')?>" class="nav-link">

              <i class=""></i>
              <p>
                VENTES DEJA ENVOYEES
                
              </p>
            </a>
           
          </li>
          <li class="nav-item <?php if($this->router->class == 'Assc_Controller'  ){ echo 'menu-open';} else{ echo '';}  ?>">
            <a href="<?=base_url('assc_liste/Assc_Controller')?>" class="nav-link">

              <i class=""></i>
              <p>
                MONTANT ASSURANCE
                
              </p>
            </a>
           
          </li> 
          <li class="nav-item <?php if($this->router->class == 'Facture'  ){ echo 'menu-open';} else{ echo '';}  ?>">
            <a href="<?=base_url('facture/Facture')?>" class="nav-link">

              <i class=""></i>
              <p>
                FACTURE ASSURANCE
                
              </p>
            </a>
           
          </li> 
          <?php 
        }
            // if (in_array('13',$this->session->userdata('STRAPH_DROIT'))){
            ?>
          
          
         
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gifts"></i>
              <p>
                Donn&eacute;es
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assurances</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medicaments</p>
                </a>
              </li>
            </ul>
          </li> -->



          
          
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
