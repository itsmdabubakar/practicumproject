<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand bg-gradient-dark">
  <!-- Brand Logo -->
  <a href="<?php echo base_url ?>admin" class="brand-link bg-dark-primary text-sm border-info shadow-sm bg-primary">
    <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-black" style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item dropdown">
                <a href="./" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=repairs" class="nav-link nav-repairs">
                  <i class="nav-icon fas fa-microchip"></i>
                  <p>Repair List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=Blank" class="nav-link nav-blank">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Technician List</p>
                </a>
              </li>

              <?php if($_settings->userdata('type') == 1): ?>
              <li class="nav-item">
                <a href="http://localhost/leave_system/admin/login.php" target="_blank" class="nav-link nav-blank">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Employee Management</p>
                </a>
              </li>
              <?php endif; ?>

              <?php if($_settings->userdata('type') == 2 || $_settings->userdata('type') == 1): ?>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=clients" class="nav-link nav-clients">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Client List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=inquiries" class="nav-link nav-inquiries">
                  <i class="nav-icon fas fa-question-circle"></i>
                  <p>Inquiries</p>
                </a>
              </li>
              <?php endif; ?>

              <?php if($_settings->userdata('type') == 2 || $_settings->userdata('type') == 1): ?>
              <li class="nav-header">Maintenance</li>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=services" class="nav-link nav-services">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>Computer Service List</p>
                </a>
              </li>

              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=mservices" class="nav-link nav-mservices">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>Mobile Service List</p>
                </a>
              </li>
              <?php endif; ?>


              <?php if($_settings->userdata('type') == 1): ?>
              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>Admin User List</p>
                </a>
              </li>

              <li class="nav-item dropdown">
                <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>Settings</p>
                </a>
              </li>
              <?php endif; ?>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  var page;
  $(document).ready(function(){
    page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    page = page.replace(/\//gi,'_');

    if($('.nav-link.nav-'+page).length > 0){
      $('.nav-link.nav-'+page).addClass('active');
      if($('.nav-link.nav-'+page).hasClass('tree-item')) {
        $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active');
        $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open');
      }
      if($('.nav-link.nav-'+page).hasClass('nav-is-tree')) {
        $('.nav-link.nav-'+page).parent().addClass('menu-open');
      }
    }

    $('#receive-nav').click(function(){
      $('#uni_modal').on('shown.bs.modal', function(){
        $('#find-transaction [name="tracking_code"]').focus();
      });
      uni_modal("Enter Tracking Number", "transaction/find_transaction.php");
    });
  });
</script>
