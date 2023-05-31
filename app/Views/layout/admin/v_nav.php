<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
    $db = \Config\Database::connect();
    $user = $db->table('user')->where(
        'id_user',
        session()->get('id_user')
    )->get()->getRowArray();
    $id_user = session()->get('id_user');
    $count = $db->query("SELECT k.`id_kuesioner`, k.`nama_kuesioner`, k.`kd_kuesioner`, COUNT(k.`nama_kuesioner`) AS total FROM tbl_kuesioner k
    WHERE k.`id_kuesioner` NOT IN (SELECT a.kode_kuesioner FROM tbl_answer a WHERE kode_users = '$id_user') AND k.`status` = 'publish'")->getResultArray();
    ?>
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>/template/index3.html" class="brand-link">
        <img src="<?= base_url() ?>/assets/img/unnur.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Tracer Study</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                if (session()->get('foto') == null) {
                    echo '<img src="
                            ' . base_url('assets/img/avatar.png') . ' 
                        " class="img-circle elevation-2" alt="User Image">';
                } else {
                    echo '<img src="
                            ' . base_url('assets/img/' . $user['foto']) . ' 
                        " class="img-circle elevation-2" alt="User Image">';
                }
                ?>
                <!-- <img src="<?= base_url('assets/img/' . session()->get('foto')) ?>" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= explode(' ', session()->get('nama_lengkap'))[0] ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if (session()->idlevel == 1) : ?>
                    <li class="nav-header">Menu</li>
                    <li class="nav-item ">
                        <a href="<?= site_url('home') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-tachometer-alt text-light"></i>
                            <p class="text">Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $menu == 'users' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $menu == 'users' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-users text-light"></i>
                            <p>
                                Data Alumni
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('users/viewstatus') ?>" class="nav-link <?= $submenu == 'datastatus' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Status</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('users') ?>" class="nav-link <?= $submenu == 'datauser' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Alumni</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $menu == 'survey' ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $menu == 'survey' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-question-circle text-light"></i>
                            <p>
                                Survey Tracer
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('kuesioner') ?>" class="nav-link <?= $submenu == 'kuesioner' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kuesioner</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('question') ?>" class="nav-link <?= $submenu == 'quest' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pertanyaan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('hasil') ?>" class="nav-link <?= $menu == 'hasil' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-tasks text-light"></i>
                            <p class="text">Hasil Survey Tracer</p>
                        </a>
                    </li>

                    <li class="nav-header">Pengaturan</li>
                    <li class="nav-item">
                        <a href="<?= site_url('fakultas') ?>" class="nav-link <?= $menu == 'fakultas' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-landmark text-light"></i>
                            <p class="text">Fakultas & Prodi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('konten') ?>" class="nav-link <?= $menu == 'konten' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cogs text-light"></i>
                            <p class="text">Konten</p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (session()->idlevel == 2) : ?>
                    <li class="nav-header">Menu</li>
                    <li class="nav-item">
                        <a href="<?= site_url('HomeUsers') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-tachometer-alt text-light"></i>
                            <p class="text">Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('profil') ?>" class="nav-link <?= $menu == 'profil' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-user text-light"></i>
                            <p class="text">Profil</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('kuesionerUsers') ?>" class="nav-link <?= $menu == 'kuesionerUser' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-question-circle text-light"></i>
                            <p class="text">Survey Tracer <?php if ($count[0]['total'] == 0) {
                                                                echo '';
                                                            } else {
                                                                echo '<span class="right badge badge-danger">' . $count[0]['total'] . '</span>';
                                                            }
                                                            ?>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('HasilUsers') ?>" class="nav-link <?= $menu == 'hasilUsers' ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-tasks text-light"></i>
                            <p class="text">Hasil Survey Tracer</p>
                        </a>
                    </li>

                <?php endif; ?>
                <!-- <li class="nav-item">
                    <a href="<?= site_url('login/keluar') ?>" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li> -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>