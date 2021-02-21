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
function rupiah($angka){    
    $hasil_rupiah = "Rp " . number_format($angka);
    $rupiah=str_replace(',', '.', $hasil_rupiah);
    return $rupiah;     
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
                    <div class="col-sm-12 col-lg-2">                        
                        <?php 
                            $id_keranjang=mysql_query("SELECT id_keranjang FROM tb_keranjang WHERE id_user='$idUser'");
                            $tampung=mysql_fetch_array($id_keranjang);
                        ?>
                        <h4 class="page-title">Transaksi Anda</h4>
                    </div>                    
                    <div class="col-sm-12 col-lg-5">
                        <div class="pull-right page-title form-inline">
                            <label style="font-size: 14px;">Tampilkan Transaksi </label>
                            <select class="form-control" onchange="jenisTransaksi(this.value)">
                                <option value="x" selected disabled>- - Pilih - -</option>
                                <option value="1">Pembelian Barang</option>
                                <option value="2">Open Trip</option>
                                <option value="3">Pasang Iklan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-5">
                        <div class="pull-right page-title form-inline">
                            <label style="font-size: 14px;">Tampilkan Berdasarkan Status </label>
                            <select class="form-control" onchange="pindah(this.value)">
                                <option value="x" selected disabled>- - Pilih - -</option>
                                <option value="0">Belum Dibayar</option>
                                <option value="1">Diproses</option>
                                <option value="2">Dibayar</option>
                                <option value="3">Dikirim</option>
                                <option value="4">Selesai</option>
                                <option value="5">Gagal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                        <?php
                            if (isset($_GET['st'])) {   
                            $st=$_GET['st'];                                                           
                                $booking=mysql_query("SELECT * FROM tb_booking JOIN tb_opentrip ON tb_booking.id_trip=tb_opentrip.id_trip JOIN tb_user ON tb_booking.id_user=tb_user.id_user WHERE tb_booking.id_user='$idUser' AND status='$st' ORDER BY tb_booking.id_booking");
                            }else{                              
                                $booking=mysql_query("SELECT * FROM tb_booking JOIN tb_opentrip ON tb_booking.id_trip=tb_opentrip.id_trip JOIN tb_user ON tb_booking.id_user=tb_user.id_user WHERE tb_booking.id_user='$idUser' ORDER BY tb_booking.id_booking"); 
                            }
                            while ($rBooking=mysql_fetch_array($booking)) {
                                if ($rBooking['status']=='0') {
                                    $alert="alert alert-warning";
                                    $txtAlert="Booking Anda <strong>Belum Dibayar</strong>, Silahkan lakukan pembayaran dan unggah bukti transfer (format jpg/jpeg/png, ukuran max 1mb) ";
                                    $btnBayar="display:block";
                                    $btnKonfirm="display:none";
                                }else if ($rBooking['status']=='1') {
                                    $alert="alert alert-warning";
                                    $txtAlert="Transaksi Menunggu <strong>Konfirmasi</strong> Dari Admin";
                                    $btnBayar="display:none";
                                    $btnKonfirm="display:none";
                                }else if ($rBooking['status']=='2') {
                                    $alert="alert alert-info";
                                    $txtAlert="Booking Anda telah <strong>Dibayar</strong>";
                                    $btnBayar="display:none";
                                    $btnKonfirm="display:none";
                                }else{
                                    $alert="alert alert-danger";
                                    $txtAlert="Booking <strong>Gagal</strong> Dikarenakan <strong>".$rBooking['keterangan']."</strong>";
                                    $btnBayar="display:none";
                                    $btnKonfirm="display:none";
                                }
                                ?>
                                <div class="card-box">
                                    <div class="row" style="margin-top: -2%;">
                                        <div class="col-sm-12 col-lg-6"> 
                                            <h5 class="page-title">No Booking : <?=$rBooking['id_booking'];?></h5>
                                        </div>                    
                                        <div class="col-sm-12 col-lg-6">
                                            <h4 class="page-title pull-right">
                                                <button type="button" class="btn btn-dark waves-effect waves-light" onclick="window.location.assign('invoice-trip?n=<?=$rBooking['id_booking'];?>')">
                                                    <span class="btn-label"><i class="fa fa-file"></i>
                                                    </span>Lihat Invoice
                                                </button>
                                            </h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5><?=$rBooking['nama_paket'];?></h5>
                                        <div class="row m-t-1">                              
                                            <div class="col-lg-2">
                                                <div class="row">                                        
                                                    <img src="../assets/images/o/<?=$rBooking['gambar1'];?>" class="img-thumbnail img-sm"> 
                                                </div>                                  
                                            </div>
                                            <div class="col-lg-10"> 
                                                <table class="table m-t-1" style="width: 100%;">
                                                    <tr>
                                                        <td><label>Periode</label></td>
                                                        <td>:</td>
                                                        <td><?=tanggal($rBooking['periodeAwal'])." - ".tanggal($rBooking['periodeAkhir']);?></td>
                                                        </td>
                                                        <td><label>Harga</label></td>
                                                        <td>:</td>
                                                        <td><?=rupiah($rBooking['harga']);?></td> 
                                                    </tr>
                                                    <tr>
                                                        <td><label>Currency</label></td>
                                                        <td>:</td>
                                                        <td><?=$rBooking['currency'];?></td>
                                                        <td><label>Tanggal Upload</label></td>
                                                        <td>:</td>                                                
                                                        <td><?=tanggal($rBooking['tgl_upload']);?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label>Lokasi</label></td>
                                                        <td>:</td>
                                                        <td colspan="4"><?=$rBooking['lokasi'];?> | <?=$rBooking['rute'];?></td>
                                                    </tr>
                                                </table>                                       
                                            </div> 
                                        </div>
                                    <div class="<?=$alert;?> m-t-1" role="alert"><?=$txtAlert;?></div>
                                    <div class="row" style="<?=$btnBayar;?>">
                                        <form method="POST" action="proses-opentrip.php" enctype="multipart/form-data">
                                            <div class="col-sm-10 col-lg-10">
                                                <input type="file" name="buktitrf" class="form-control" style="width: 100%;">
                                                <input type="hidden" name="noInv" value="<?=$rBooking['id_booking'];?>">
                                            </div>
                                            <div class="col-sm-2 col-lg-2">
                                                <button class="btn btn-primary pull-right" name="unggah" style="width: 100%;">Unggah</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row" style="<?=$btnKonfirm;?>">                                        
                                        <form method="POST" action="proses-transaksi">
                                            <input type="hidden" name="noInvoice" class="form-control" value="<?=$rBooking['no_invoice'];?>">
                                            <button class="btn btn-primary waves-effect waves-light " name="sampai">Konfirmasi</button>
                                        </form>
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
                    window.location.assign('list-transaksi-openTrip');
                }else{
                    window.location.assign('list-transaksi-openTrip?st='+x);
                }
            }

            function jenisTransaksi(y){
                if (y==1) {
                    window.location.assign('list-transaksi-barang');
                }else if (y==2){
                    window.location.assign('list-transaksi-openTrip'); 
                }else{
                    window.location.assign('list-transaksi-iklan');
                }
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