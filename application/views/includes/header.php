<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start bg-dark text-light">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="<?=base_url();?>">
        <img src="<?=base_url();?>assets/images/invest_logo.png" alt="logo" />
      </a>
      <!-- <a class="navbar-brand brand-logo-mini" href="<=base_url();?>index.html">
        <img src="<?=base_url();?>assets/images/invest_logo.png" alt="logo" />
      </a> -->
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h3 class="">Welcome, <span class="text-black fw-bold"><?=  $this->session->userdata('STRAPH1_NOM'). " " . $this->session->userdata('STRAPH1_PRENOM');?></span></h3>
        
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      
    <li class="nav-item d-none d-lg-block">
        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
          <span class="input-group-addon input-group-prepend border-right">
            <span class="icon-calendar input-group-text calendar-icon"></span>
          </span>
          <input type="text" class="form-control">
        </div>
      </li>
      
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="<?=base_url();?>assets/images/icons.png" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-xs rounded-circle" src="<?=base_url();?>assets/images/icons.png" alt="Profile image">
            <p class="mb-1 mt-3 font-weight-semibold">
              <?= $this->session->userdata('STRAPH1_NOM')?>
            </p>
            <p class="fw-light text-muted mb-0">
              <?= $this->session->userdata('STRAPH1_USERNAME')?>
            </p>
          </div>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
            Profile </a>
          
          <a href="<?=base_url()?>Login/do_logout" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>