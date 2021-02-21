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
        <title>List Transaksi Barang</title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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

        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script>
            $(document).ready(
                function(){
                $('#buktiTrf').on('show.bs.modal', function (e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'buktitrf.php',
                        data :  'rowid='+ rowid,
                        success : function(data){
                        $('.fetched-data').html(data);
                        }
                    });
                 });
            } );
            $(document).ready(
                function(){
                $('#dtTrx').on('show.bs.modal', function (e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'dtTransaksi.php',
                        data :  'rowid='+ rowid,
                        success : function(data){
                        $('.fetched-data1').html(data);
                        }
                    });
                 });
            });
            $(document).ready(
                function(){
                $("#buktiTrf").on("hidden.bs.modal", function () {
                  window.location.reload();
                });
            } );
            
        </script>
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

                <!-- Page-Title -->
                <div class="row m-t-1">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-12 m-b-1">
                                    <h4 class="pull-left">Pasang Iklan</h4>
                                    <button class="btn btn-dark waves-effect waves-light pull-right" onclick="window.location.assign('list-transaksi-iklan')">Detail</button>                                    
                                </div>
                                <div class="card-box table-responsive" style="overflow-y: scroll; overflow-x: scroll;">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Iklan</th>
                                                <th>Nama Iklan</th>
                                                <th>Tanggal Pasang</th>
                                                <th>Tanggal Habis</th>
                                                <th>status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $dateNow=date('Y-m-d');
                                            if (isset($_GET['st'])) {
                                                $st=$_GET['st'];                                                             
                                                $q=mysql_query("SELECT * FROM tb_ngiklan JOIN `tb_detail-ngiklan` ON tb_ngiklan.no_iklan=`tb_detail-ngiklan`.`no_iklan` JOIN tb_iklan ON `tb_detail-ngiklan`.`id_iklan`=tb_iklan.id_iklan WHERE status='$st'");                         # code...
                                            }else{                                                             
                                                $q=mysql_query("SELECT * FROM tb_ngiklan JOIN `tb_detail-ngiklan` ON tb_ngiklan.no_iklan=`tb_detail-ngiklan`.`no_iklan` JOIN tb_iklan ON `tb_detail-ngiklan`.`id_iklan`=tb_iklan.id_iklan");
                                            }
                                                    $no=1;
                                            while ($r=mysql_fetch_array($q)) { 
                                                if ($dateNow>=$r['tgl_habis'] && $r['status-aktif']=='2') {
                                                    $sNonaktif='Kadaluarsa';
                                                    $btnNonaktif='style="pointer-events:none; background-color:#E57373; margin-top:2px;"';
                                                }else if($dateNow>=$r['tgl_habis']){
                                                    $sNonaktif='Kadaluarsa';
                                                    $btnNonaktif='style="pointer-events:none; background-color:#E57373; margin-top:2px;"';
                                                }else{
                                                    $sNonaktif='Aktif';
                                                    $btnNonaktif='style="pointer-events:none; background-color:#E57373; margin-top:2px;"';
                                                    $dis='';
                                                }
                                            ?>
                                            <tr>
                                                <th><?=$no;?></th>
                                                <th><?=$r['no_iklan'];?></th>
                                                <th><?=$r['nama_iklan'];?></th>
                                                <th><?=tanggal($r['tgl_pasang'])?></th>
                                                <th><?=tanggal($r['tgl_habis'])?></th>
                                                <th><?=$sNonaktif;?></th>
                                                <th>
                                                    <form action="proses-iklan" method="POST">
                                                        <input type="hidden" name="noIklan" value="<?=$r['no_iklan'];?>">
                                                        <input type="hidden" name="idIklan" value="<?=$r['id_iklan'];?>">
                                                        <button type="submit" name="nonAKtif" class="form-control btn btn-sm btn-danger waves-effect waves-light" <?=$btnNonaktif;?> >Hapus Iklan</button>                                         
                                                    </form>
                                                    <!--<form action="proses-iklan" method="POST">
                                                        <input type="hidden" name="noIklan" value="<?=$r['no_iklan'];?>">
                                                        <button type="submit" name="nonAKtif" class="form-control btn btn-sm btn-danger waves-effect waves-light" <?=$btnNonaktif;?> >Non Aktifkan</button> -->                                        
                                                    </form>
                                                </th>
                                            </tr>
                                            <?php
                                            $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- Barang -->
                    <div class="col-sm-12 col-lg-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-12 m-b-1">
                                    <h4 class="pull-left">Penjualan Barang</h4>
                                    <button class="btn btn-dark waves-effect waves-light pull-right" onclick="window.location.assign('list-transaksi-barang')">Detail</button>
                                </div>
                                <div class="card-box table-responsive" style="overflow-y: scroll; overflow-x: scroll;">
                                    <table id="datatable-buttons1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Invoice</th>
                                                <th>Tgl Transaksi</th>
                                                <th>Total</th>
                                                <th>status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (isset($_GET['st'])) {
                                                $st=$_GET['st'];                                                             
                                                $q=mysql_query("SELECT `tb_transaksi`.`no_invoice`, `tgl_order`, `bukti_trf`, `no_resi`, `total`, `status`, `keterangan`, `tb_transaksi`.`id_user` FROM `tb_transaksi`  WHERE status='$st'");                         # code...
                                            }else{                                                             
                                                $q=mysql_query("SELECT `tb_transaksi`.`no_invoice`, `tgl_order`, `bukti_trf`, `no_resi`, `total`, `status`, `keterangan`, `tb_transaksi`.`id_user` FROM `tb_transaksi`");
                                            }
                                                    $no=1;
                                            while ($r=mysql_fetch_array($q)) { 
                                                if ($r['status']=='0') {
                                                    $sInvoice="Belum Dibayar";
                                                }else if ($r['status']=='1') {
                                                    $sInvoice="Konfirmasi Admin";
                                                }else if ($r['status']=='2') {
                                                    $sInvoice="Dibayar";
                                                }else if ($r['status']=='3') {
                                                    $sInvoice="Dikirim";
                                                }else if ($r['status']=='4') {
                                                    $sInvoice="Selesai";
                                                }else{
                                                    $sInvoice="Gagal";
                                                }
                                            ?>
                                            <tr>
                                                <th><?=$no;?></th>
                                                <th><?=$r['no_invoice'];?></th>
                                                <th><?=tanggal($r['tgl_order'])?></th>
                                                <th><?=rupiah($r['total'])?></th>
                                                <th><?=$sInvoice;?></th>
                                                <th>
                                                    <button class="form-control btn btn-sm btn-primary waves-effect waves-light" style="margin-top: 2px;" onclick="window.location.assign('detail-transaksi?id=<?=$r['no_invoice'];?>')">Detail</button>
                                                </th>
                                            </tr>
                                            <?php
                                            $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- opentrip -->
                    <div class="col-sm-12 col-lg-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-12 m-b-1">
                                    <h4 class="pull-left">Open trip</h4>
                                    <button class="btn btn-dark waves-effect waves-light pull-right" onclick="window.location.assign('list-transaksi-opentrip')">Detail</button>                     
                                </div>
                                <div class="card-box table-responsive" style="overflow-y: scroll; overflow-x: scroll;">
                                    <table id="datatable-buttons1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Invoice</th>
                                                <th>Nama Paket</th>
                                                <th>Total</th>
                                                <th>Bukti Transfer</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (isset($_GET['st'])) {
                                                $st=$_GET['st'];                                                             
                                                $q=mysql_query("SELECT * FROM tb_booking JOIN tb_opentrip ON tb_booking.id_trip=tb_opentrip.id_trip WHERE status='$st'");
                                            }else{                                                             
                                                $q=mysql_query("SELECT * FROM tb_booking JOIN tb_opentrip ON tb_booking.id_trip=tb_opentrip.id_trip");
                                            }
                                                    $no=1;
                                            while ($r=mysql_fetch_array($q)) { 
                                                if ($r['status']=='0') {
                                                    $sInvoice="Belum Dibayar";
                                                }else if ($r['status']=='1') {
                                                    $sInvoice="Konfirmasi Admin";
                                                }else if ($r['status']=='2') {
                                                    $sInvoice="Dibayar";
                                                }else{
                                                    $sInvoice="Gagal";
                                                }
                                            ?>
                                            <tr>
                                                <th><?=$no;?></th>
                                                <th><?=$r['id_booking'];?></th>
                                                <th><?=$r['nama_paket']?></th>
                                                <th><?=rupiah($r['harga'])?></th>
                                                <th><?=$r['bukti_trf']?></th>
                                                <th><?=$sInvoice;?></th>
                                                <th><?=$r['keterangan'];?></th>
                                                <th>
                                                    <button class="form-control btn btn-sm btn-primary waves-effect waves-light" style="margin-top: 2px;" onclick="window.location.assign('detail-transaksi?id=<?=$r['id_booking'];?>')">Detail</button>
                                                </th>
                                            </tr>
                                            <?php
                                            $no++;
                                            }
                                            ?>
                                        </tbody>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        
                    </div>
                </div>
                <!-- end row -->

                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->

            </div> <!-- container -->
        </div> <!-- End wrapper -->
            <!-- Modal -->
                <div class="modal fade" id="buktiTrf" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>Bukti Transfer</b></h4>
                            </div>
                            <div class="modal-body">
                                <div class="fetched-data"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->
                 <!-- Modal -->
                <div class="modal fade" id="dtTrx" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><b>Detail Transaksi</b></h4>
                            </div>
                            <div class="modal-body">
                                <div class="fetched-data1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
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

            $(document).ready(function() {
                $('#datatable1').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons1').DataTable({
                    lengthChange: false,
                    buttons: ['excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons1_wrapper .col-md-6:eq(0)');
            } );
        </script>

    </body>
</html>