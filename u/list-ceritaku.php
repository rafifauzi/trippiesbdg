<?php 
include '../database/koneksi.php'; 
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
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App title -->
        <title>Daftar Transaksi</title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="../assets/js/modernizr.min.js"></script>
        <style type="text/css">
            .img-sm{
                 width: 100%; 
                 height: 190px; 
                 object-fit: cover; 
            }
        </style>

    </head>


    <body>

        <!-- Navigation Bar-->
        <?php include 'menu/header_user.php'; ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-6 col-lg-6">                        
                        
                        <h4 class="page-title">Ceritaku</h4>
                    </div> 
                    <div class="col-sm-6 col-lg-6">
                        <h4 class="page-title pull-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="<?=$panggil;?>">
                                <span class="btn-label"><i class="fa fa-plus"></i>
                                </span>Tambah Cerita
                            </button>
                        </h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                                <?php
                                    $id_blog=mysql_query("SELECT judul, gambar1, tgl_upload, lokasi, harga_min, harga_max, nama_kategori, cerita FROM tb_blog JOIN tb_kategori ON tb_blog.id_kategori=tb_kategori.id_kategori WHERE id_user='$idUser'");
                                   while ($ceritaku=mysql_fetch_array($id_blog)) { ?>                                
                                    <div class="card-box">
                                        <div class="row" style="margin-top: -2%;">
                                            <div class="col-sm-12 col-lg-6"> 
                                                <h5 class="page-title"><?=$ceritaku['judul'];?></h5>
                                            </div>                    
                                            <div class="col-sm-12 col-lg-6">
                                                <h4 class="page-title pull-right">
                                                    <div class="row">
                                                        <form method="POST" action="proses-ceritaku">
                                                            <input type="hidden" name="idUser" value="<?=$idUser;?>">         
                                                            <button class="btn btn-danger waves-effect waves-light" type="submit" name="hapusCeritaku">Hapus</button>
                                                        </form>
                                                    </div>
                                                    
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="row keranjang-border">                             
                                            <div class="col-lg-2">
                                                <div class="m-t-1">                                        
                                                    <img src="../assets/images/s/<?=$ceritaku['gambar1'];?>" class="img-thumbnail img-sm"> 
                                                </div>                                  
                                            </div>
                                            <div class="col-lg-10">  
                                                <div class="row">
                                                    <div class="col-lg-3" style="border-right: 1px solid #e5e5e5;">
                                                        <h5 class="m-t-1"><li class="fa fa-calendar"></li> <?=tanggal($ceritaku['tgl_upload']);?></h5>
                                                        <h5 class="m-t-1"><li class="ion ion-location"></li> <?=$ceritaku['lokasi'];?></h5>
                                                    </div>
                                                    <div class="col-lg-3" style="margin-left: 10px;">
                                                        <h5 class="m-t-1"><i class="zmdi zmdi-balance-wallet noti-icon"></i> <?=rupiah($ceritaku['harga_min'])." - ".rupiah($ceritaku['harga_max']);?></h5>
                                                        <h5 class="m-t-1"><li class="zmdi zmdi-bookmark"></li> <?=$ceritaku['nama_kategori'];?></h5>
                                                    </div>
                                                </div>
                                                <hr>
                                                <h6 style="text-align: justify; "><?=$ceritaku['cerita'];?></h6>                                     
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <button class="btn btn-dark waves-effect waves-light pull-right" onclick="window.location.assign('../detail-ceritaku?id=<?=$idUser;?>')">Detail</button>
                                        </div>
                                        
                                    </div>
                                <?php
                                   }
                                ?>
                    </div> 
                    </div>                    
                </div>
                <!-- end row -->
                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->
            </div> <!-- container -->
        </div> <!-- End wrapper -->

        <script>
            var resizefunc = [];
            function bayarSemua(ik){
                window.location.assign('transaksi?ik='+ik);
            }
            function pindah(x){
                if (x==6) {
                    window.location.assign('list-transaksi');
                }else{
                    window.location.assign('list-transaksi?st='+x);
                }
            }
            function addCerita() {
                window.location.assign('tambah-ceritaku');
            }
            function noneCerita() {
                window.location.assign('login');
            }
        </script>

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

    </body>
</html>