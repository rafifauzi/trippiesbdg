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
                <form method="GET" action="list-pembukuan-opentrip">
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
                        $tglAwal='';
                        $tglAkhir='';
                    }
                ?>
            <h5><?=tanggal($tglAwal);?> - <?=tanggal($tglAkhir);?></h5><br>
            <div class="card-box">
                <h4>Pendapatan OpenTrip</h4><hr>
                <div style="width: 100%; height: 300px; overflow-x: scroll; overflow-y: scroll;">                    
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id Trip</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Admin (2%)</th>
                            <th>Tanggal Berangkat</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $q=mysql_query("SELECT * FROM `tb_booking` JOIN tb_opentrip ON `tb_booking`.`id_trip`=`tb_opentrip`.`id_trip` WHERE `tb_booking`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_booking`.`tgl_bayar`") or die(mysql_error());

                            while ($r=mysql_fetch_array($q)) {
                                $admin = ($r['harga']) * 0.02;                            
                                if ($r['status']==2) {
                                ?>
                                    <tr>
                                        <th><?=$r['id_booking']?></th>
                                        <th><?=$r['nama_paket']?></th>
                                        <th><?=$r['harga']?></th>
                                        <th><?=$admin?></th>
                                        <th><?=$r['periodeAkhir']?></th>
                                        <th><?=$r['tgl_bayar']?></th>
                                    </tr>
                                <?php
                                }
                                else{
                                $admin = 0;
                               }
                                $jumlah2 = $jumlah2 + $admin;
                            }
                        ?>
                    </tbody>
                </table>
                </div><br>
                <h5>Total Keuntungan Admin : <?=rupiah($jumlah2);?></h5>
            </div> 
            <div class="card-box">
                <h4>Pengeluaran OpenTrip (Transaksi Gagal)</h4><hr>
                <div style="width: 100%; height: 300px; overflow-x: scroll; overflow-y: scroll;">                    
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id Trip</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Tanggal Berangkat</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $q=mysql_query("SELECT * FROM `tb_booking` JOIN tb_opentrip ON `tb_booking`.`id_trip`=`tb_opentrip`.`id_trip` WHERE `tb_booking`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_booking`.`tgl_bayar`") or die(mysql_error());

                            while ($r=mysql_fetch_array($q)) {
                                $admin = ($r['harga']);
                                $total3 = $total3 + $r['harga'];                            
                                if ($r['status']==3) {
                                ?>
                                    <tr>
                                        <th><?=$r['id_booking']?></th>
                                        <th><?=$r['nama_paket']?></th>
                                        <th><?=$r['harga']?></th>
                                        <th><?=$r['periodeAkhir']?></th>
                                        <th><?=$r['tgl_bayar']?></th>
                                    </tr>
                                <?php
                                }
                                else{
                                $total3 = 0;
                                }
                                $gagal4 = $gagal4 + $total3;
                            }
                        ?>
                    </tbody>
                </table>
                </div><br>
                <h5>Total Keuntungan Admin : <?=rupiah($gagal4);?></h5>
            </div>            
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