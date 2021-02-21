<?php 
include 'database/koneksi.php';
session_start();
    if (isset($_SESSION['id_user'])) {
        $display="style='display:block;'";
        $display1="style='display:none;'";
        $panggil="addCerita()";
        $idUser=$_SESSION['id_user'];
        $qUser=mysql_query("SELECT * FROM tb_user WHERE id_user='$idUser'") or die(mysql_error());
        $rUser=mysql_fetch_array($qUser);
        $pisah = explode(" ",$rUser['nama']);

        $qkeranjang=mysql_num_rows(mysql_query("SELECT id_barang FROM `tb_detail-keranjang` JOIN tb_keranjang ON `tb_detail-keranjang`.id_keranjang=tb_keranjang.id_keranjang WHERE id_user='$idUser'"));
        if ($qkeranjang>0) {
            $notif="class='noti-icon-badge'";
        }else{
            $notif="";
        }

        $rNotif=mysql_num_rows(mysql_query("SELECT pemilik FROM tb_barang WHERE pemilik!='admin' AND pemilik='$idUser'"));
        if ($rNotif>0) {
            $tNotif="style='display:block;'";
        }else{            
            $tNotif="style='display:none;'";
        }

        $nNotif=mysql_num_rows(mysql_query("SELECT DISTINCT `pemilik` FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN `tb_barang` ON `tb_detail-transaksi`.`id_barang`=`tb_detail-transaksi`.`id_barang` WHERE pemilik!='admin' AND pemilik='$idUser'"));            
        if ($nNotif>0) {
            $pNotif="class='noti-icon-badge'";
        }else{               
            $pNotif=""; 
        }
    }else{
        $display="style='display:none;'";
        $display1="style='display:block;'";        
        $panggil="noneCerita()";
    }

?> 
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="index" class="logo logo-img">
                            <span><img src="assets/images/logo.png" class="logo-img"></span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras" <?=$display;?>>

                        <ul class="nav navbar-nav pull-right">

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="zmdi zmdi-shopping-cart noti-icon"></i>
                                    <span <?=$notif;?>></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5><small><span class="label label-danger pull-xs-right"></span>Keranjang</small></h5>
                                    </div>
                                    <?php 
                                        $keranjang=mysql_query("SELECT tb_barang.id_barang, nama_barang, qty, subtotal FROM `tb_detail-keranjang` JOIN tb_keranjang ON `tb_detail-keranjang`.id_keranjang=tb_keranjang.id_keranjang JOIN tb_barang ON `tb_detail-keranjang`.id_barang=tb_barang.id_barang WHERE id_user='$idUser' ORDER BY tgl_masuk  LIMIT 3 ");
                                        while ($hasil=mysql_fetch_array($keranjang)) { 
                                            if (strlen($hasil['nama_barang'])>25) {
                                                    $namaBarang=str_pad(substr($hasil['nama_barang'],0,25),30,".");
                                                }else{
                                                    $namaBarang=$hasil['nama_barang'];
                                                }
                                            ?>
                                            <a href="keranjang" class="dropdown-item notify-item">
                                                <label><?=$namaBarang;?></label><br>
                                                <label>Rp <?=number_format($hasil['subtotal']);?></label>
                                                <small class="text-muted pull-right"><?=$hasil['qty'];?> Buah</small>
                                            </a>
                                        <?php
                                        }
                                    ?>
                                    <a href="u/keranjang" class="dropdown-item notify-item notify-all">
                                        Lihat Barang Lainnya
                                    </a>

                                </div>
                            </li>

                            <li class="nav-item dropdown notification-list" <?=$tNotif;?>>
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" href="u/list-transaksi-penjual">
                                    <i class="zmdi zmdi-balance-wallet noti-icon"></i>
                                    <span <?=$pNotif;?>></span>
                                </a>
                            </li>

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/<?=$rUser['foto_profil'];?>" alt="user" class="img-circle img-profil">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Hai ! <?=$pisah[0];?></small></h5>
                                    </div>

                                    <!-- item-->
                                    <a href="u/profil" class="dropdown-item notify-item">
                                        <span>Profile</span>
                                    </a>

                                    <!-- item-->
                                    <a href="u/list-ceritaku" class="dropdown-item notify-item">
                                        <span>Ceritaku</span>
                                    </a>

                                    <!-- item-->
                                    <a href="u/list-barang" class="dropdown-item notify-item">
                                        <span>Jual Barang</span>
                                    </a> 

                                    <!-- item-->
                                    <a href="u/list-transaksi-barang" class="dropdown-item notify-item">
                                        <span>Transaksi</span>
                                    </a>

                                    <!-- item-->
                                    <a href="proses_logout" class="dropdown-item notify-item">
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
                    </div> <!-- end menu-extras -->
                    <div class="menu-extras" <?=$display1;?>>

                        <ul class="nav navbar-nav pull-right">
                            <li class="nav-item hidden-sm-down">
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                     <input type="text" placeholder="Search..." class="form-control" style="background-color: #fff; color: #000;">
                                </form>
                            </li>
                            <li class="nav-item navbar-item" onclick="window.location.assign('login')">Login</li>
                            <li class="nav-item navbar-item" style="pointer-events: none;">|</li>
                            <li class="nav-item navbar-item" onclick="window.location.assign('register')">Register</li>
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
                    <div class="clearfix"></div>
                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu">
                                <a href="store?page=1&k=all">Oleh - Oleh</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="store?page=1&k=KB1">Makanan Kering</a></li>
                                            <li><a href="store?page=1&k=KB2">Merchandise</a></li>
                                            <li><a href="store?page=1&k=KB3">Peralatan Travelling</a></li>
                                            <li><a href="store?page=1&k=KB4">Buku</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="pasar?page=1&k=all">Pasar Tripper</a></li>
                            <li><a href="penginapan?page=1">Penginapan</a></li>
                            <li><a href="opentrip?page=1">Open Trip</a></li>
                            <li><a href="ceritaku?page=1">CeritaKu</a></li>
                            <li><a href="u/iklan">Pasang Iklan</a></li>
                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>