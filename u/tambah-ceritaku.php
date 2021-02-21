<?php 
include '../database/koneksi.php'; 
$row=mysql_num_rows(mysql_query("SELECT id_barang FROM tb_keranjang"));
if ($row>0) {
    $notif="<span class='noti-icon-badge'></span>";
}else{
    $notif="<span class='noti-icon-badge-none'></span>";
}
session_start();
$idUser=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="kodingkita" content="Trippies">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App title -->
        <title>Story</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="../assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../assets/plugins/jquery.steps/demo/css/jquery.steps.css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="../assets/js/modernizr.min.js"></script>

    </head>


    <body>

        <!-- Navigation Bar-->
        <?php include 'menu/header_user.php'; ?>
        <!-- End Navigation Bar-->>



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <h4 class="page-title">Ceritaku</h4>
                        </div>
                        <div class="col-sm-12 col-lg-6">                        
                            <h4 class="page-title pull-right">
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.location.assign('../ceritaku?page=1')">
                                    <span class="btn-label"><i class="fa fa-list"></i>
                                    </span>List Barang
                                </button>
                            </h4>
                        </div>
                    <form method="POST" enctype="multipart/form-data" action="proses-ceritaku.php">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    <div class="card-box">
                                        <h4 class="header-title m-t-0">Masukan Gambar</h4>
                                        <p>( Size max 2MB dan Maksimal 4 Gambar )</p>
                                        <div class="form-group bg-image card-box">
                                            <label>Gambar Barang</label><br>
                                            <input type="file" name="gambar[]" multiple="multiple" required>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">Judul Story</label> 
                                        <input type="text" class="form-control" name="jdStory" id="jdStory" placeholder="Judul Story" onchange="cekNama(this.value)" required>
                                        <small id="ketNama"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">lokasi</label> 
                                        <input type="text" class="form-control" name="kotaKab" placeholder="Kota / Kabupaten" required>
                                        <input type="text" class="form-control m-t-1" name="prov" placeholder="Provinsi" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="exampleSelect1">Kategori Story</label>
                                        <select class="form-control" name="kategori" required>
                                            <option selected disabled>Kategori</option>
                                        <?php 
                                            $q=mysql_query("SELECT SUBSTRING(id_kategori, 1, 2) as idK, nama_kategori, id_kategori FROM tb_kategori WHERE SUBSTRING(id_kategori, 1, 2)='ks';");
                                            while ($r=mysql_fetch_array($q)) { ?>
                                                <option value="<?=$r['id_kategori'];?>"><?=$r['nama_kategori'];?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">Rentang Harga(Rp)</label> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," placeholder="Harga Min" name="hargaMin" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," placeholder="Harga Max" name="hargaMax" required>
                                                </div>
                                            </div>                                            
                                    </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Cerita Singkat </label> <span id="sisaCerita">200 Karakter</span> 
                                            <textarea class="form-control" name="cerita" rows="9" maxlength="200" style="resize: none; padding-bottom: 14px;" required onkeyup="cekCerita(this.value)"></textarea>
                                        </div>
                                </div>
                            </div>
                            <button type="submit" class="form-control btn btn-success waves-effect waves-light" name="simpanCeritaku">Simpan Story</button>                            
                            <br>
                        </div>
                    </div>
                </form>
                </div>
            </div>         
        </div>

                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->


            </div> <!-- container -->
        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
            function cekNama(namaBarang){
                if (namaBarang.length<=25) {                    
                    document.getElementById('jdStory').value = '';
                    var ket ='Nama Barang Anda '+namaBarang.length+' Karakter, Minimal 25 karakter';
                }else{
                    var ket = namaBarang.length+' Nama Barang Sesuai';
                }
                document.getElementById('ketNama').innerHTML = ket;
            }

            function cekCerita(cerita){
                var a=cerita.length;
                var b=200;
                var c=b-a;
                document.getElementById('sisaCerita').innerHTML = c+' /200';
            }
        </script>
        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>
        <!--Morris Chart-->
		<script src="../assets/plugins/morris/morris.min.js"></script>
		<script src="../assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="../assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="../assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="../assets/pages/jquery.dashboard.js"></script>
        <script type="text/javascript">
            jQuery(function ($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>
    </body>
</html>