<?php 
include '../database/koneksi.php';
session_start();
    if (isset($_SESSION['id_admin'])) { 
        $idAdmin=$_SESSION['id_admin'];
        $q=mysql_fetch_array(mysql_query("SELECT * FROM tb_admin WHERE id_admin='$idAdmin'"));
        $pisah = explode(" ",$q['nama_admin']);       
        $panggil="addCerita()";
        $display="style='display:block;'";
        $display1="style='display:none;'";
    }else{       
        $panggil="noneCerita()";
        $display="style='display:none;'";
        $display1="style='display:block;'";
    }
?>
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="home.php" class="logo logo-img">
                            <span><img src="../assets/images/logo.png" class="logo-img"></span>
                        </a>
                    </div>
                    <!-- End Logo container-->

                    <!-- menu-extras login-->
                    <div class="menu-extras" <?=$display1;?>>
                        <ul class="nav navbar-nav pull-right">
                            <li class="nav-item navbar-item" data-toggle="modal" data-target="#login">Login</li>
                            <li class="nav-item navbar-item" style="pointer-events: none;">|</li>
                            <li class="nav-item navbar-item" data-toggle="modal" data-target="#register">Register</li>
                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>
                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <!-- menu-extras admin-->
                    <div class="menu-extras" <?=$display;?>>
                        <ul class="nav navbar-nav pull-right">

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="../assets/images/users/admin.jpg" alt="user" class="img-circle img-profil">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Hai ! <?=$pisah[0];?>-Admin</small></h5>
                                    </div>

                                    <!-- item-->
                                    <a href="profil" class="dropdown-item notify-item">
                                        <span>Profile</span>
                                    </a>

                                    <!-- item-->
                                    <a href="bank" class="dropdown-item notify-item">
                                        <span>Akun Bank</span>
                                    </a>

                                    <!-- item-->
                                    <a href="../proses_logout" class="dropdown-item notify-item">
                                        <span>Logout</span>
                                    </a>

                                </div>
                            </li>
                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>
                        </ul>
                    </div>
                    <!-- end menu-extras -->
                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->


            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!--Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu">
                                <a href="list-barang">Data Barang</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="tambah-barang.php">Jual Barang</a></li>
                                            <li><a href="list-barang">Barang Trippies</a></li>
                                            <li><a href="list-barang_user">Pasar Tripper</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="list-penginapan">Data Penginapan</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="list-penginapan">List Penginapan</a></li>
                                            <li><a href="tambah-penginapan">Tambah Penginapan</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="list-openTrip">Open Trip</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="list-openTrip">List Open Trip</a></li>
                                            <li><a href="tambah-openTrip">Tambah Trip</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="list-openTrip">Iklan</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="list-iklan">List Iklan</a></li>
                                            <li><a href="tambah-iklan">Update Harga</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="list-transaksi-barang">Transaksi</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="list-transaksi-barang">Penjualan Barang</a></li>
                                            <li><a href="list-transaksi-opentrip">Open Trip</a></li>
                                            <li><a href="list-transaksi-iklan">Pasang Iklan</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="list-pembukuan">Pembukuan</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="list-pembukuan">Penjualan Barang</a></li>
                                            <li><a href="list-pembukuan-opentrip">Open Trip</a></li>
                                            <li><a href="list-pembukuan-iklan">Pasang Iklan</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!--End navigation menu -->
                    </div>
                </div>
            </div>
        </header>