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

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p> Acceuil </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Rapports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Vente </p>
              </a>
            </li>

            <li class="nav-item">
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
            </li>

  
            </ul>
          </li>

          
          <li class="nav-item <?php if($this->router->class == 'Profil_Droit' || $this->router->class == 'User'|| $this->router->class == 'Barcode'|| $this->router->class == 'Assurance'|| $this->router->class == 'Client'){ echo 'menu-open';} else{ echo '';}  ?>">
          
            <a href="#" class="nav-link <?php if($this->router->class == 'Profil_Droit' || $this->router->class == 'User'){ echo 'active';} else{ echo '';}  ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Configuration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="<?=base_url('configuration/Profil_Droit/listing')?>" class="nav-link <?php if($this->router->class == 'Profil_Droit' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Droits & Profil</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?=base_url('configuration/User/listing')?>" class="nav-link <?php if($this->router->class == 'User' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url('configuration/Barcode')?>" class="nav-link <?php if($this->router->class == 'Barcode' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barcode</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('configuration/Assurance')?>" class="nav-link <?php if($this->router->class == 'Assurance' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assurances</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=base_url('configuration/Client')?>" class="nav-link <?php if($this->router->class == 'Client' ){ echo 'active';} else{ echo '';}  ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Clients</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotion</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-item <?php if($this->router->class == 'Requisition' || $this->router->class == 'Entree_Stock'){ echo 'menu-open';} else{ echo '';}  ?>">

            <a href="#" class="nav-link <?php if($this->router->class == 'Requisition' || $this->router->class == 'Entree_Stock'){ echo 'active';} else{ echo '';}  ?>">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Requisition & Stock
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?=base_url('requisition/Requisition/listing')?>" class="nav-link <?php if($this->router->class == 'Requisition' ){ echo 'active';} else{ echo '';}  ?>">
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

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sortie Stock</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapports</p>
                </a>
              </li>
             
              
            </ul>
          </li>
          
          <li class="nav-item <?php if($this->router->class == 'Vente' || $this->router->class == 'Liste_Vente'){ echo 'menu-open';} else{ echo '';}  ?>">
            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-users"></i>
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
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rapport</p>
                </a>
              </li>
            </ul>
          </li>
          
          
         
          <li class="nav-item">
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
          </li>



          
          
          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
