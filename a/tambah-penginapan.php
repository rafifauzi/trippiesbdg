<?php 
include '../database/koneksi.php'; 
$bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
);
$date=date('d')." ".$bulan[date('m')]." ".date('Y');
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
        <title>Trippies-admin</title>

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
        <?php include 'menu/header.php'; ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <h4 class="page-title">Penginapan</h4>
                    </div>
                    <div class="col-sm-12 col-lg-6">                        
                        <h4 class="page-title pull-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="window.location.assign('list-penginapan')">
                                <span class="btn-label"><i class="fa fa-list"></i>
                                </span>List Penginapan
                            </button>
                        </h4>
                    </div>
                </div>
                <form method="POST" action="proses-penginapan.php" name="addBarang" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                    <div class="card-box">
                                            <h4 class="header-title m-t-0">Masukan Gambar</h4>
                                            <p>( Format JPG, Size max 2MB dan Maksimal 6 Gambar )</p>
                                            <div class="form-group bg-image card-box">
                                                <label>Gambar Barang</label><br>
                                                <input type="file" name="gambar[]" multiple="multiple" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Nama Penginapan</label> 
                                            <input type="text" name="nmPenginapan" id="nmPenginapan" class="form-control" placeholder="Nama Penginapan" onchange="cekNama(this.value)" required>
                                            <small id="ketNama"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Harga Sewa / Hari (Rp)</label> 
                                            <input type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," placeholder="Harga Barang" name="hgSewa" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Alamat Penginapan</label> 
                                            <textarea name="alamat" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" placeholder="Alamat Penginapan" required></textarea>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Pemilik Penginapan</label> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" placeholder="Nama Pemilik" name="namaPemilik" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" placeholder="No Telepon Pemilik" name="noTelpPemilik" required>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Jumlah Penyewa (Orang)</label> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" placeholder="Minimal Penghuni" name="jmlMin" required>
                                                </div>
                                                <div class="col-lg-6">
                                                        <input type="number" class="form-control" placeholder="Maksimal Penghuni" name="jmlMax" required>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Deskripsi Penginapan</label> <span id="sisaCerita">200 Karakter</span> 
                                            <textarea class="form-control" name="deskripsi" rows="5" maxlength="200" style="resize: none; padding-bottom: 14px;" required onkeyup="cekCerita(this.value)"></textarea>
                                        </div>
                                </div>
                            </div>                            
                            <br>                            
                                <center><button type="submit" name="pasarkan" class="btn btn-primary waves-effect waves-light">Pasarkan</button></center>
                        </div>
                    </div>
                </div>
            </form>
            </div>         
        </div>

                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->


            </div> <!-- container -->
        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
            function cekNama(namaPenginapan){
                if (namaPenginapan.length>=27) {
                    var ket ='Nama Barang Memiliki '+namaPenginapan.length+' Karakter Dan Hanya 27 Karakter Yang Akan Ditampilkan';
                }else if(namaPenginapan.length<20){
                    document.getElementById('nmPenginapan').value = '';
                    var ket ='Nama Barang Anda '+namaPenginapan.length+' Karakter, Minimal 20 karakter';
                }else{
                    var ket = namaPenginapan.length+' Nama Barang Sesuai';
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