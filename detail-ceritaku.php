<?php 
include 'database/koneksi.php';
session_start(); 
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $ig=$_GET['ig'];
    $cerita=mysql_query("SELECT judul, gambar1, gambar2, gambar3, gambar4, tgl_upload, lokasi, harga_min, harga_max, nama_kategori, cerita FROM tb_blog JOIN tb_kategori ON tb_blog.id_kategori=tb_kategori.id_kategori WHERE id_user='$id' AND SUBSTR(gambar1,2,11) ='$ig'");
    $ceritaku=mysql_fetch_array($cerita);    
}else{
    echo "<script>window.location.assign('ceritaku')</script>";
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
        <title>Trippies.</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/plugins/jquery.steps/demo/css/jquery.steps.css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

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
                <div class="row m-t-1">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card-box">
                            <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-captions" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-captions" data-slide-to="2"></li>
                                    <li data-target="#carousel-example-captions" data-slide-to="3"></li>
                                </ol>
                                    <div role="listbox" class="carousel-inner slide-box"> 
                                        <div class="carousel-item active">
                                            <img src="assets/images/s/<?=$ceritaku['gambar1'];?>" alt="First slide image" style="object-fit:contain;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/s/<?=$ceritaku['gambar2'];?>" alt="Second slide image" style="object-fit:contain;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/s/<?=$ceritaku['gambar3'];?>" alt="Third slide image" style="object-fit:contain;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/images/s/<?=$ceritaku['gambar4'];?>" alt="Fourth slide image" style="object-fit:contain;">
                                        </div>
                                    </div>
                                <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                                <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                        <div class="card-box"> 
                            <div class="row" style="margin-top: -2%; border-bottom: 1px solid #e5e5e5; margin-bottom: 12px;">
                                <div class="col-sm-12 col-lg-6"> 
                                    <h5 class="page-title"><?=$ceritaku['judul'];?></h5>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-lg-3" style="border-right: 1px solid #e5e5e5;">
                                    <h5 class="m-t-1"><li class="fa fa-calendar"></li> <?=tanggal($ceritaku['tgl_upload']);?></h5>
                                    <h5 class="m-t-1"><li class="ion ion-location"></li> <?=$ceritaku['lokasi'];?></h5>
                                </div>
                                <div class="col-lg-4" style="margin-left: 10px;">
                                    <h5 class="m-t-1"><i class="zmdi zmdi-balance-wallet noti-icon"></i> <?=rupiah($ceritaku['harga_min'])." - ".rupiah($ceritaku['harga_max']);?></h5>
                                    <h5 class="m-t-1"><li class="zmdi zmdi-bookmark"></li> <?=$ceritaku['nama_kategori'];?></h5>
                                </div>
                            </div>
                            <hr>
                            <h6 style="text-align: justify; "><?=$ceritaku['cerita'];?></h6>
                            <hr>
                            <center>
                                <button class="btn btn-dark waves-effect waves-light m-t-1" type="button" onclick="window.location.assign('ceritaku')">Kembali</button>
                            </center>
                        </div>
                    </div>
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
            function hitungTotal(qty,stok){
                if (qty<=stok) {
                    var harga_jual=document.getElementById('hg').value;
                    var total=qty*harga_jual;
                    document.getElementById('total').value=numberWithCommas(total);
                    document.getElementById('btnKeranjang').style.pointerEvents='auto';
                    document.getElementById('btnKeranjang').className = 'btn btn-primary waves-effect waves-light form-control';
                }else{
                    document.getElementById('total').value='Maksimal Pembelian '+stok+' Buah';
                    document.getElementById('btnKeranjang').style.pointerEvents='none';
                    document.getElementById('btnKeranjang').className = 'btn btn-danger waves-effect waves-light form-control';
                }
            }
            const numberWithCommas = (x) => {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            function addLogin(){
                window.location.assign('login');
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