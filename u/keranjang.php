<?php 
include '../database/koneksi.php'; 
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
        <title>Keranjang</title>

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
                width: 150px;
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
                    <div class="col-sm-12 col-lg-6">                        
                        <?php 
                            $id_keranjang=mysql_query("SELECT id_keranjang FROM tb_keranjang WHERE id_user='$idUser'");
                            $tampung=mysql_fetch_array($id_keranjang);
                        ?>
                        <h4 class="page-title">Keranjang Belanja</h4>
                    </div>  
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                        <?php 
                        include '../database/koneksi.php'; 
                            $qPemilik=mysql_query("SELECT DISTINCT pemilik FROM tb_keranjang JOIN `tb_detail-keranjang` ON `tb_keranjang`.id_keranjang=`tb_detail-keranjang`.id_keranjang JOIN tb_barang ON `tb_detail-keranjang`.id_barang=tb_barang.id_barang WHERE tb_keranjang.id_user='$idUser'");
                            $pemilik=$rPemilik['pemilik'];

                            while ($rToko=mysql_fetch_array($qPemilik)) { 
                                $idToko = $rToko['pemilik'];       
                                $nm=mysql_fetch_array(mysql_query("SELECT nama FROM tb_user WHERE id_user='$idToko'"));
                                $nm1=mysql_fetch_array(mysql_query("SELECT pemilik FROM tb_barang WHERE pemilik='Admin'")); 
                                $semuaTotal=mysql_fetch_array(mysql_query("SELECT DISTINCT SUM(subtotal) AS semuaTotal FROM tb_keranjang JOIN `tb_detail-keranjang` ON `tb_keranjang`.id_keranjang=`tb_detail-keranjang`.id_keranjang JOIN tb_barang ON `tb_detail-keranjang`.id_barang=tb_barang.id_barang WHERE pemilik='$idToko'"));

                                if ($rToko['pemilik']!='Admin') {
                                    $namaPemilik=$nm['nama'];
                                }else{
                                    $namaPemilik=$nm1['pemilik'];
                                } ?>

                                <div class="card-box">
                                    <div class="row" style="margin-top: -2%;">
                                        <div class="col-sm-12 col-lg-6">  
                                            <h4 class="page-title">Penjual : <?=$namaPemilik;?> | Total : <?=rupiah($semuaTotal['semuaTotal']);?></h4>
                                        </div>                    
                                        <div class="col-sm-12 col-lg-6">
                                            <h4 class="page-title pull-right">
                                                <button type="button" class="btn btn-success waves-effect waves-light" onclick="bayarSemua('<?=$tampung['id_keranjang'];?>','<?=$idToko;?>')">
                                                    <span class="btn-label"><i class="fa fa-calculator"></i>
                                                    </span>Bayar Semua
                                                </button>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <?php
                                            $keranjang=mysql_query("SELECT tb_barang.id_barang, nama_barang, qty, subtotal, tb_keranjang.id_keranjang, pemilik FROM `tb_detail-keranjang` JOIN tb_keranjang ON `tb_detail-keranjang`.id_keranjang=tb_keranjang.id_keranjang JOIN tb_barang ON `tb_detail-keranjang`.id_barang=tb_barang.id_barang WHERE id_user='$idUser' AND pemilik='$idToko'");
                                            while ($bToko=mysql_fetch_array($keranjang)) { 
                                                $idbrg=$bToko['id_barang'];
                                                $gambar=mysql_fetch_array(mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$idbrg' LIMIT 1"));
                                                ?> 
                                                <div class="row keranjang-border">                          
                                                    <div class="col-lg-10">
                                                        <div class="row">
                                                            <div class="col-lg-2">
                                                                <img src="../assets/images/b/<?=$gambar['gambar'];?>" style="width: 150px; height: 150px" class="img-thumbnail">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <h4 class="m-t-1" style="color: #2b3d51 !important;"><?=$bToko['nama_barang'];?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2"><br>
                                                        <h5><?=rupiah($bToko['subtotal']);?><br>
                                                        <small><?=$bToko['qty'];?> Buah</small></h5>
                                                        <br>
                                                        <div>
                                                            <button class="btn btn-dark waves-effect waves-light form-control" onclick="window.location.assign('proses-hapus_keranjang?ib=<?=$bToko['id_barang'];?>&q=<?=$bToko['qty'];?>&ik=<?=$bToko['id_keranjang'];?>')">Hapus</button>
                                                            <button class="btn btn-success waves-effect waves-light form-control m-t-1" onclick="window.location.assign('transaksi?ib=<?=$bToko['id_barang'];?>&ik=<?=$bToko['id_keranjang'];?>')">Bayar</button>
                                                        </div>
                                                    </div> 
                                                </div>

                                            <?php
                                            }
                                        ?>

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
            function bayarSemua(ik, ip){
                window.location.assign('transaksi?ik='+ik+'&ip='+ip);
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