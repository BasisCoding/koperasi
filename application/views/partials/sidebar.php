
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-warning elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-navy">
      <img src="<?= base_url('assets/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light text-sm text-white">ZaisMart</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata('nama_lengkap'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <?php
              $link = end($this->uri->segments);
            // data main menu
              $main_menu = $this->db->get_where('menus', 
                                        array('sub_menu' => 0, 'level' => $this->session->userdata('level')));
              foreach ($main_menu->result() as $main) {
                  // Query untuk mencari data sub menu
                  $sub_menu = $this->db->get_where('menus', 
                                        array('sub_menu' => $main->id, 'level' => $this->session->userdata('level')));
                  // periksa apakah ada sub menu
                if ($sub_menu->num_rows() > 0) {?>     
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon <?= $main->icon .' '. $main->warna ?>"></i>
                      <p class="">
                        <?= $main->nama_menu ?>
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <?php foreach ($sub_menu->result() as $sub) {?>
                        <li class="nav-item">
                          <a href="<?= base_url($this->session->userdata('link').'/'.$sub->link) ?>" class="nav-link <?= $sub->link == $link ? 'active':''; ?>">
                            <i class="<?= $sub->icon ?> nav-icon"></i>
                            <p class="="><?= $sub->nama_menu ?></p>
                          </a>
                        </li>
                      <?php } ?>
                    </ul>
                  </li>
                <?php } else { ?>
                  <li class="nav-item">
                    <a href="<?= base_url($this->session->userdata('link').'/'.$main->link) ?>" class="nav-link <?= $main->link == $link ? 'active':''; ?>">
                      <i class="nav-icon <?= $main->icon .' '. $main->warna ?>"></i>
                      <p class="="><?= $main->nama_menu ?></p>
                    </a>
                  </li>
                <?php }
              } ?>
          <!-- <?php 
              $menu = $this->db->get_where('menus', array('level' => $this->session->userdata('level')));
              $last = $this->uri->total_segments();
              $record_num = $this->uri->segment($last);
              foreach ($menu->result() as $mn) {?>
                <li class="nav-item <?= $mn->link == $record_num ? 'active' : ''; ?>">
                  <a href="<?= base_url($this->session->userdata('link').'/'.$mn->link) ?>" class="nav-link">
                    <i class="nav-icon <?= $mn->icon .' '.$mn->warna ?>"></i>
                    <p>
                      <?= $mn->nama_menu?>
                      <span class="right badge badge-danger">New</span>
                    </p>
                  </a>
                </li>
            <?php }
          ?> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>