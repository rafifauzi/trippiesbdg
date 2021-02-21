<?php 
include '../database/koneksi.php';
session_start(); 
if (isset($_GET['id'])) {
    $id_trip=$_GET['id'];
    $id_user=$_SESSION['id_user'];
    $q=mysql_query("SELECT * FROM tb_opentrip WHERE id_trip='$id_trip'");
    $r=mysql_fetch_array($q);
    $beli="data-target='#keranjang'";
}else{
    echo "<script>window.location.assign('opentrip')</script>";
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
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App title -->
        <title>Trippies.</title>

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
                <div class="row m-t-1">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-4">
                        <div class="card">
                            <div class="row">                                
                                <img src="../assets/images/o/<?=$r['gambar1'];?>" alt="First slide image" style="width: 400px; height: 530px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-16 col-sm-16 col-md-16 col-lg-8">
                        <form method="POST" action="u/proses-opentrip.php">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <h4 class="header-title m-t-0 m-b-10"><?=$r['nama_paket'];?></h4>
                                        <input type="hidden" name="id_user" value="<?=$id_user?>">
                                        <input type="hidden" name="id_trip" value="<?=$r['id_trip'];?>">
                                        <input type="hidden" name="nama_paket" value="<?=$r['nama_paket'];?>">
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <h4 class="header-title m-t-0 m-b-10 pull-right">
                                            Admin Trippies
                                        </h4>
                                     </div>
                                </div>
                                <hr>
                                <h4><?=rupiah($r['harga']);?></h4>
                                <input type="hidden" name="harga" value="<?=$r['harga'];?>">
                                <table class="table m-t-1" style="width: 100%;">
                                    <tr>
                                        <td><label>Periode</label></td>
                                        <td>:</td>
                                        <td><?=tanggal($r['periodeAwal'])." - ".tanggal($r['periodeAkhir']);?></td>
                                        </td>
                                        <td><label>Currency</label></td>
                                        <td>:</td>
                                        <td><?=$r['currency'];?></td>
                                    </tr>
                                    <tr>
                                        <td><label>Lokasi</label></td>
                                        <td>:</td>
                                        <td><?=$r['lokasi'];?></td>
                                        <td><label>Tanggal Upload</label></td>
                                        <td>:</td>                                                
                                        <td><?=tanggal($r['tgl_upload']);?></td>
                                    </tr>
                                </table>
                                <hr>
                                <h4 class="m-t-2 header-title">Deskripsi</h4>
                                <p align="justify"><?=$r['deskripsi'];?></p>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="border-right: 1px solid #e5e5e5;">
                                        <h4 class="m-t-2 header-title">Include</h4>
                                        <p align="justify"><?=$r['include'];?></p>
                                        <h4 class="m-t-2 header-title">Rute</h4>
                                        <p align="justify"><?=$r['rute'];?></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                        <h4 class="m-t-2 header-title">Exclude</h4>
                                        <p align="justify"><?=$r['exclude'];?></p>
                                        <h4 class="m-t-2 header-title">Larangan</h4>
                                        <p align="justify"><?=$r['donts'];?></p>
                                    </div>
                                </div>
                                <div class="row m-t-1">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <button type="submit" class="form-control btn btn-purple waves-effect waves-light" name="join" style="pointer-events: none;">Join</button>
                                    </div>
                                </div>
                            </div>
                        <form>
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

    </body>
</html>
