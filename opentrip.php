<?php 
include 'database/koneksi.php'; 
$c=mysql_query("SELECT id_keranjang FROM tb_keranjang") or die(mysql_error());
$row=mysql_num_rows($c);
if ($row>0) {
    $notif="<span class='noti-icon-badge'></span>";
}else{
    $notif="<span class='noti-icon-badge-none'></span>";
}
function tanggal($a){
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
    $tgl=date('d', strtotime($a))." ". $bulan[date('m', strtotime($a))]." ".date('Y', strtotime($a));
    return $tgl;
}
function rupiah($x){
    $rp="Rp ".str_replace(",", ".",number_format($x));
    return $rp;
}
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="kodingkita" content="Trippies">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Open Trip</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
        <style type="text/css">
            .img-sm{
                width: 150px;
            }
            .story-title{
                padding: 15px;
                color: #fff;
                border-radius: 5px;
                background-color: rgba(0,0,0,0.3);
            }
        </style>

    </head>


    <body>

        <!-- Navigation Bar-->
        <?php 
            include 'menu/header.php';
            $halaman = 12;
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0; 
            $query = mysql_query("SELECT * FROM tb_opentrip LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT id_trip FROM tb_opentrip") or die(mysql_error);     
            $total = mysql_num_rows($result);
            $pages = ceil($total/$halaman); 
            $no =$mulai+1;
        ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Open Trip</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-inline">
                                <?php 
                                while ($openTrip=mysql_fetch_array($query)) {
                                ?>
                                <div class="col-lg-4">
                                    <div class="card" onclick="window.location.assign('detail-trip?id=<?=$openTrip['id_trip']?>')">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-9">
                                                    <h4><?=$openTrip['nama_paket'];?></h4>
                                                    <small class="text-muted"><?=tanggal($openTrip['tgl_upload']);?></small>
                                                </div>
                                            </div>
                                            <small>Periode : <?=tanggal($openTrip['periodeAwal'])." - ".tanggal($openTrip['periodeAkhir']);?></small><br>
                                            <small>Harga : <?=rupiah($openTrip['harga']);?></small><br>
                                            <small class="text-muted"><li class="ion ion-location"></li> <?=$openTrip['lokasi'];?></small>

                                            <p class="card-text"><?php
                                            if (strlen($openTrip['include'])>=100) {
                                                    echo str_pad(substr($openTrip['include'],0,48),52,".");
                                                }else{
                                                    echo $openTrip['include'];
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <img src="assets/images/o/<?=$openTrip['gambar1'];?>" class="tripImage">
                                        <div class="m-t-1 m-b-1" >
                                            <center>
                                                <a href="#"><button class="btn btn-dark waves-effect waves-light">Detail</button></a>                                                
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- end row -->
                <div class="row">
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-lg-6">                        
                        <div class="m-b-20">
                            <center>
                                <button type="button" class="btn btn-dark waves-effect m-t-1" onclick="pageBaru(1)"><<</button>
                                <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                    <button type="button" class="btn btn-secondary waves-effect m-t-1" onclick="pageBaru(<?=$i;?>)"><?=$i;?></button> 
                                <?php } ?>
                                <button type="button" class="btn btn-dark waves-effect m-t-1" onclick="pageBaru(<?=$pages;?>)">>></button>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                </div>

                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->


            </div> <!-- container -->

        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
            function pageBaru(page){
                window.location.assign('?page='+page);
            }
        </script>

        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

    </body>
</html>