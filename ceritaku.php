<?php 
include 'database/koneksi.php'; 
$row=mysql_num_rows(mysql_query("SELECT id_keranjang FROM tb_keranjang"));
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
        <title>Ceritaku</title>

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
            $query = mysql_query("SELECT tgl_upload, harga_max, harga_min, foto_profil, nama, judul, cerita, tb_blog.id_user, lokasi, gambar1, gambar2, gambar3, gambar4, SUBSTR(gambar1,2,11) AS idGambar FROM tb_blog JOIN tb_user ON tb_blog.id_user=tb_user.id_user LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT tb_blog.id_user FROM tb_blog JOIN tb_user ON tb_blog.id_user=tb_user.id_user") or die(mysql_error);     
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
                    <div class="col-sm-12 col-lg-6">
                        <h4 class="page-title">Ceritaku</h4>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <h4 class="page-title pull-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="<?=$panggil;?>">
                                <span class="btn-label"><i class="fa fa-plus"></i>
                                </span>Tambah Cerita
                            </button>
                        </h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-inline">
                                <?php 
                                while ($ceritaku=mysql_fetch_array($query)) { 
                                    
                                ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-3">
                                                    <img class="img-fluid img-circle" src="assets/images/users/<?=$ceritaku['foto_profil'];?>" alt="Card image cap" style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                                <div class="col-sm-12 col-lg-9">
                                                    <h4><?=$ceritaku['nama'];?></h4>
                                                    <small class="text-muted"><?=tanggal($ceritaku['tgl_upload']);?></small>
                                                </div>
                                            </div>
                                            <hr>
                                            <h4><?=$ceritaku['judul'];?></h4>
                                            <small><?=rupiah($ceritaku['harga_min'])." - ".rupiah($ceritaku['harga_max']);?></small><br>
                                            <small class="text-muted"><li class="ion ion-location"></li> <?=$ceritaku['lokasi'];?></small>
                                            <p class="card-text" style="text-align: justify;">
                                                <?=substr($ceritaku['cerita'], 0,100);?>
                                                <a href="detail-ceritaku?id=<?=$ceritaku['id_user']?>" class="text-muted"> | Detail...</a>  
                                            </p>
                                        </div>
                                        <div id="carousel-example-captions" data-ride="carousel" class="carousel slide slide-img">
                                            <div role="listbox" class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="assets/images/s/<?=$ceritaku['gambar1'];?>" alt="First slide image" style="width: 450px; height: 250px;">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/s/<?=$ceritaku['gambar2'];?>" alt="Second slide image" style="width: 450px; height: 250px;">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/s/<?=$ceritaku['gambar3'];?>" alt="Third slide image" style="width: 450px; height: 250px;">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="assets/images/s/<?=$ceritaku['gambar4'];?>" alt="Fourth slide image" style="width: 450px; height: 250px;">
                                                </div>
                                            </div>
                                        </div>
                                        <center>
                                            <button class="btn btn-dark form-control m-t-1 m-b-1 waves-effect" onclick="window.location.assign('detail-ceritaku?id=<?=$ceritaku['id_user'];?>&ig=<?=$ceritaku['idGambar'];?>')">Detail</button>
                                        </center>
                                        
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
            function addCerita() {
                window.location.assign('u/tambah-ceritaku');
            }
            function noneCerita() {
                window.location.assign('login');
            }
            function pageBaru(page){
                window.location.assign('?page='+page);
            }
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>