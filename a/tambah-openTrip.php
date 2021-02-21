<?php 
include '../database/koneksi.php'; 
$q=mysql_query("SELECT id_trip FROM tb_opentrip") or die(mysql_error());
$row=mysql_num_rows($q)+1;
$tgl=date('d');
$bln=date('m');
$thn=date('Y');
$id_trip="TR"."".$tgl."".$bln."".$thn."".$row;
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
                    <div class="col-sm-12">
                        <h4 class="page-title">Open Trip (ID : <?=$id_trip;?>)</h4>
                    </div>
                </div>
                <form method="POST" action="proses-opentrip.php" name="addBarang" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="card-box">
                            <h4 class="header-title m-t-0">Masukan Gambar</h4>
                            <p>(Format JPG, Size max 2MB)</p>
                                <div class="form-inline">
                                    <div class="form-group bg-image card-box">
                                        <label>Gambar Iklan 1</label><br>
                                        <input type="file" name="gambar1">
                                    </div>
                                </div>
                                <br>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Data Trip</h4>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Nama Paket</label> 
                                            <input type="text" name="nmPaket" class="form-control" placeholder="Nama Paket" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Harga Paket (Rp)</label>
                                             <input type="text" class="form-control autonumber" data-a-sep="." data-a-dec="," placeholder="Harga Paket" name="harga">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Periode</label> 
                                            <input type="date" class="form-control" name="periodeAwal" placeholder="Periode Awal" required>
                                            <input type="date" class="form-control m-t-1" name="periodeAkhir" placeholder="Periode Akhir" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Lokasi Tujuan</label> 
                                            <textarea name="lokasi" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Currency</label>
                                            <input type="text" name="currency" class="form-control" placeholder="Currency" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Deskripsi Lokasi</label> 
                                            <textarea name="deskripsi" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" required></textarea>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Rute Perjalanan</label> 
                                            <textarea name="rute" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Include (Didalam Paket)</label> 
                                            <textarea name="include" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Exclude (Diluar Paket)</label> 
                                            <textarea name="exclude" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelect1">Yang Tidak Boleh Dilakukan</label> 
                                            <textarea name="donts" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" required></textarea>
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
            
        </script>
        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>

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
        <script src="../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(function ($) {
                $('.autonumber').autoNumeric('init');
            });
        </script>

    </body>
</html>