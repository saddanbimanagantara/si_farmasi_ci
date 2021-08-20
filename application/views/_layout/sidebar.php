<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../../index3.html" class="brand-link d-flex align-items-center">
        <i class="brand-image img-circle elevation-3 fas fa-hospital-symbol text-light" style="font-size: 1.5em;"></i>
        <span class="brand-text font-weight-light">UPT PUSKESMAS</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>
                            Obat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>obat/data" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Gudang UPT
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>gudang/upt" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>gudang/upt/laporan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-code-branch"></i>
                        <p>
                            Gudang Satelit
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url()?>gudang/satelit/distribusi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Distribusi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url()?>gudang/satelit/transaksi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Satelit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url()?>gudang/satelit/laporanpersatelit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Per Satelit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url()?>gudang/satelit/laporansemuansatelit" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Semua Satelit</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Gudang Induk
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../../index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>
    <!-- javascript -->
    <?php $this->load->view('_layout/js') ?>
    <section class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4><?= $titledashboard ?></h1>
            </div>
            <div class="card-body">