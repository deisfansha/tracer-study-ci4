<?php
$db = \Config\Database::connect();
$user = $db->table('user')->where(
    'id_user',
    session()->get('id_user')
)->join(
    "level",
    "level.id_level=user.level"
)->get()->getRowArray();
?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if (session()->get('foto') == null) {
                            echo '<img src="
                                            ' . base_url('assets/img/avatar.png') . ' 
                                        " class="user-image img-circle elevation-2" alt="User Image">';
                        } else {
                            echo '<img src="
                                            ' . base_url('assets/img/' . $user['foto']) . ' 
                                        " class="user-image img-circle elevation-2" alt="User Image">';
                        }
                        ?>
                        <!-- <img src="<?= base_url('assets/img/' . session()->get('foto')) ?>" class="user-image img-circle elevation-2" alt="User Image"> -->
                        <span class="hidden-xs"><?= session()->get('nama'); ?></span>
                    </a>
                    <ul class="dropdown-menu border-0 mt-2">
                        <!-- User image -->
                        <li class="user-header bg-info">
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
                            <p>
                                <?= session()->get('username'); ?>
                                <small><?= $user['nama_level'] ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="float-left">
                                <a href="<?= base_url('password') ?>" class="btn btn-primary btn-sm"><i class="fa fa-cogs"></i> Password</a>
                            </div>
                            <div class="float-right">
                                <a href="<?= base_url('login/keluar') ?>" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>