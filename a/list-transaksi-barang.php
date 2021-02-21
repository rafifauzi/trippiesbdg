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
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <h4 class="page-title">Data Penjualan Barang</h4>
                    </div>
                    <div class="col-sm-12 col-lg-4">
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
                            <label style="font-size: 14px;">Tampilkan Transaksi Sesuai </label>
                            <select class="form-control" onchange="pindah(this.value)">
                                <option value="x" selected disabled>- - Pilih - -</option>
                                <option value="0">Belum Dibayar</option>
                                <option value="1">Diproses</option>
                                <option value="2">Dibayar</option>
                                <option value="3">Dikirim</option>
                                <option value="4">Selesai</option>
                                <option value="5">Gagal</option>
                                <option value="6">Tampilkan Semua</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive" style="overflow-y: scroll; overflow-x: scroll;">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No Invoice</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Total</th>
                                        <th>Bukti Transfer</th>
                                        <th>No Resi</th>
                                        <th>status</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (isset($_GET['st'])) {
                                        $st=$_GET['st'];                                                             
                                        $q=mysql_query("SELECT `tb_transaksi`.`no_invoice`, `tgl_order`, `bukti_trf`, `no_resi`, `total`, `status`, `keterangan`, `tb_transaksi`.`id_user` FROM `tb_transaksi` WHERE status='$st' ORDER BY tgl_order DESC");
                                    }else{                                                             
                                        $q=mysql_query("SELECT `tb_transaksi`.`no_invoice`, `tgl_order`, `bukti_trf`, `no_resi`, `total`, `status`, `keterangan`, `tb_transaksi`.`id_user` FROM `tb_transaksi` ORDER BY tgl_order DESC");
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
                                        <th><?=$r['bukti_trf']?></th>
                                        <th><?=$r['no_resi'];?></th>
                                        <th><?=$sInvoice;?></th>
                                        <th><?=$r['keterangan'];?></th>
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
            function pindah(x){
                if (x==6) {
                    window.location.assign('list-transaksi-barang');
                }else{
                    window.location.assign('list-transaksi-barang?st='+x);
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
            function tampil(a){
                if (a=='1') {
                    document.getElementById('batal').style.display='block';
                    document.getElementById('kirim').style.display='none'; 
                }else{
                    document.getElementById('kirim').style.display='block';
                    document.getElementById('batal').style.display='none'; 
                }
            }
        </script>

    </body>
</html>