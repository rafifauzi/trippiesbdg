<?php
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
        <title>Pembukuan</title>
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="../assets/js/alertify.min.js"></script>
        <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="../assets/js/modernizr.min.js"></script>
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#iklan').modal('show');
            });
        </script>
    </head>
<body>
    <!-- Navigation Bar-->
        <?php include 'menu/header.php'; ?>
        <!-- End Navigation Bar-->
    <div class="modal fade modal-custom" id="iklan">
        <div class="modal-dialog">
            <div class="modal-content modal-content-custom">      
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b>Masukan Rentang Tanggal</b></h4>
                </div>
            <div class="modal-body ">
                <form method="GET" action="list-pembukuan">
                    <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tglAwal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tglAkhir" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Tampilkan</button>
                    </div>
                </form>
            </div>             
            </div>
        </div>
    </div>
    <div class="wrapper m-t-1">
        <div class="container">
                <?php 
                    if (isset($_GET['tglAwal'],$_GET['tglAkhir'])) {
                        $tglAwal=$_GET['tglAwal'];
                        $tglAkhir=$_GET['tglAkhir'];
                    }else{
                        $tglAwal='01-11-2018';
                        $tglAkhir='30-11-2018';
                    }
                ?>
            <h5><?=tanggal($tglAwal);?> - <?=tanggal($tglAkhir);?></h5><br>
            <div class="card-box">
                <h4>Pendapatan Penjualan Barang</h4><hr>
                <div style="width: 100%; height: 300px; overflow-x: scroll; overflow-y: scroll;">                    
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Ongkir</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>SubTotal</th>
                            <th>Admin (2%)</th>
                            <th>Total</th>
                            <th>Tanggal Beli</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                            while ($r=mysql_fetch_array($q)) {
                                    if ($r['status']=='0') {
                                        $st="Belum Dibayar";
                                    }else if ($r['status']=='1') {
                                        $st="Konfirmasi Admin";
                                    }else if ($r['status']=='2') {
                                        $st="Dibayar";
                                    }else if ($r['status']=='3') {
                                        $st="Dikirim";
                                    }else if ($r['status']=='4') {
                                        $st="Selesai";
                                    }else{
                                        $st="Gagal";
                                    } 
                                    $sub_total = ($r['harga_beli']) * ($r['qty']);
                                    $admin = ($r['harga_beli']) * 0.02;
                                    $admin_untung = ($r['qty']) * $admin;
                                    $total = $sub_total + $admin_untung + $r['ongkir'];
                                ?>
                                    <tr>
                                        <th><?=$r['no_invoice']?></th>
                                        <th><?=$r['nama_barang']?></th>
                                        <th><?=$r['qty']?></th>
                                        <th><?=$r['ongkir']?></th>
                                        <th><?=$r['harga_beli']?></th>
                                        <th><?=$r['harga_jual']?></th>
                                        <th><?=$sub_total?></th>
                                        <th><?=$admin_untung?></th>
                                        <th><?=$r['total']?></th>
                                        <th><?=$r['tgl_bayar']?></th>
                                        <th><?=$st?></th>
                                    </tr>
                        <?php
                                if ($r['status']==4) {
                                    $jumlah = $jumlah + $admin_untung;
                                }
                                elseif ($r['status']==5) {
                                    $gagal = $gagal + $total;
                                }
                                else{
                                    $total = 0;
                                    $admin_untung = 0;
                                }
                            }
                        ?>
                </table>
                </div><br>
                <h5>Total Keuntungan Admin : <?=rupiah($jumlah);?></h5><br>
                <h5>Total Pengeluaran Ke Pelanggan : <?=rupiah($gagal);?></h5>
            </div>                
            <div class="card-box">
                <h4>Pengeluaran Penjualan Barang - User</h4><hr>
                <div style="width: 100%; height: 300px; overflow-x: scroll; overflow-y: scroll;">                    
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Ongkir</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Sub Total</th>
                            <th>Admin (2%)</th>
                            <th>Total</th>
                            <th>Tanggal Beli</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include '../database/koneksi.php';  
                        $pemilik="admin";
                        $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_barang`.`pemilik`!='$pemilik' AND `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                        
                        while ($r=mysql_fetch_array($q)) { 
                            $sub_total = ($r['harga_beli']) * ($r['qty']);
                            $admin = ($r['harga_beli']) * 0.02;
                            $admin_untung = ($r['qty']) * $admin;
                            $total1 = $sub_total + $r['ongkir'];
                            $total2 = $sub_total + $admin_untung + $r['ongkir'];
                            if ($r['status']=='0') {
                                        $st="Belum Dibayar";
                                    }else if ($r['status']=='1') {
                                        $st="Konfirmasi Admin";
                                    }else if ($r['status']=='2') {
                                        $st="Dibayar";
                                    }else if ($r['status']=='3') {
                                        $st="Dikirim";
                                    }else if ($r['status']=='4') {
                                        $st="Selesai";
                                    }else{
                                        $st="Gagal";
                                    }
                        
                    ?>
                                <tr>
                                    <th><?=$r['no_invoice']?></th>
                                    <th><?=$r['nama_barang']?></th>
                                    <th><?=$r['qty']?></th>
                                    <th><?=$r['ongkir']?></th>
                                    <th><?=$r['harga_beli']?></th>
                                    <th><?=$r['harga_jual']?></th>
                                    <th><?=$sub_total?></th>
                                    <th><?=$admin_untung?></th>
                                    <th><?=$r['total']?></th>
                                    <th><?=$r['tgl_bayar']?></th>
                                    <th><?=$st?></th>
                                </tr>
                    <?php
                            if ($r['status']==4) {
                                $jumlah1 = $jumlah1 + $admin_untung;
                                $gagal1 = $gagal1 + $total1;
                            }
                            elseif ($r['status']==5) {
                                $gagal2 = $gagal2 + $total2;
                            }
                            else{
                                $total1 = 0;
                                $total2 = 0;
                                $admin_untung = 0;
                            }
                        }
                    ?>
                    </tbody>
                </table>
                </div><br>
                <h5>Total Keuntungan Admin : <?=rupiah($jumlah1);?></h5><br>
                <h5>Total Pengeluaran Ke Penjual : <?=rupiah($gagal1);?></h5><br>
                <h5>Total Pengeluaran Ke Pembeli : <?=rupiah($gaga2);?></h5><br>
            </div>
    </div>
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

        <!-- Required datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );
        </script>
</body>
</html>