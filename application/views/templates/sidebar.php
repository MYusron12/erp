 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
     <div class="sidebar-brand-icon rotate-n-15">
       <i class="fas fa-money-bill"></i>
     </div>
     <div class="sidebar-brand-text mx-3">MNL</div>
   </a>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Query Menu -->

   <?php

    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT user_menu.id, menu
                      FROM user_menu JOIN user_access_menu 
                        ON user_menu.id = user_access_menu.menu_id
                     WHERE user_access_menu.role_id = $role_id
                     ORDER BY user_menu.idurut ASC
                     ";
   
    $menu = $this->db->query($queryMenu)->result_array();

    ?>

   <!-- looping Menu -->
   <?php foreach ($menu as $m) : ?>

     <div class="sidebar-heading">
       <?= $m['menu']; ?>
     </div>

     <!-- Submenu -->


     <?php

      $menuId = $m['id'];
      $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
      $subMenu = $this->db->query($querySubMenu)->result_array();

      ?>

     <?php
      $this->db->where('status', 1);
      $totalaju = $this->db->query('select * from permintaan_pembelian_header where status = 1 and id_bagian ='.$this->session->userdata('bagian_id').'')->num_rows();
      $totalajus = $this->db->query('select * from permintaan_jasa_all where status=1 and bagian_id ='.$this->session->userdata('bagian_id').'')->num_rows();
      $totalajusnew = $this->db->query('select * from permintaan_jasa_header where status=1 and bagian_id ='.$this->session->userdata('bagian_id').'')->num_rows();
      // var_dump($totalajusnew);
      ?>

     <?php foreach ($subMenu as $sm) : ?>

       <?php if ($title == $sm['title']) : ?>
         <li class="nav-item active">
         <?php else : ?>
         <li class="nav-item">
         <?php endif; ?>

         <?php if ($sm['st'] == 0) : ?>
           <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
             <i class="<?= $sm['icon']; ?>"></i>

        <?php if ($sm['title'] == 'PR Barang') : ?>
          <span><?= $sm['title'] . '<span class="badge badge-primary ml-3">Ada ' . $totalaju . '</span>'; ?></span></a>
        <?php elseif ($sm['title'] == 'PR Barang Jasa') : ?>
          <span><?= $sm['title'] . '<span class="badge badge-primary ml-3">Ada ' . $totalajus . '</span>'; ?></span></a>
        <?php elseif ($sm['title'] == 'PR Jasa New') : ?>
          <span><?= $sm['title'] . '<span class="badge badge-primary ml-3">Ada ' . $totalajusnew . '</span>'; ?></span></a>
        <?php else:?>
          <span><?= $sm['title']; ?></span></a>
        <?php endif; ?>
        </li>



       <?php else : ?>

         <!-- untuk sub menu dropdown collapse -->

         <?php
            $sx = $sm['idx'];

            $querySubMenu1 = "SELECT *
                               FROM `user_submenu1`
                              WHERE `user_submenu1`.`idsubmenu` = $sx
                        ";
            $subMenu1 = $this->db->query($querySubMenu1)->result_array();
          ?>


         <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities<?= $sm['idx']; ?>" aria-expanded="true" aria-controls="collapseUtilities">
             <i class="<?= $sm['icon']; ?>"></i>
             <span><?= $sm['title']; ?></span>
           </a>

           <div id="collapseUtilities<?= $sm['idx']; ?>" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
               <?php foreach ($subMenu1 as $sm1) : ?>
                 <a class="collapse-item" href="<?= base_url($sm1['url1']); ?>"><?= $sm1['namasubmenu'] ?></a>
               <?php endforeach; ?>
             </div>
           </div>
         </li>

       <?php endif ?>
     <?php endforeach; ?>
     <hr class="sidebar-divider mt-3">
   <?php endforeach; ?>

   <li class="nav-item">
     <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
       <i class="fas fa-fw fa-sign-out-alt"></i>
       <span>Logout</span></a>
   </li>


   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline">
     <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>

 </ul>
 <!-- End  of Sidebar -->