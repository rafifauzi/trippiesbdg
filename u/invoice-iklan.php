<?php 
include '../database/koneksi.php'; 
$row=mysql_num_rows(mysql_query("SELECT id_barang FROM tb_keranjang"));
if ($row>0) {
    $notif="<span class='noti-icon-badge'></span>";
}else{
    $notif="<span class='noti-icon-badge-none'></span>";
}
if (isset($_GET['n'])) {
    $noInvoice=$_GET['n'];
}else{
    echo "<script>window.location.assign('list-transaksi-barang')</script>";
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
        <title>Invoice</title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="../assets/js/modernizr.min.js"></script>
        <style type="text/css">
        *{
            color: #000;
        }
        .fa{
            color: #fff;
        }
        .logo-img{
            width: 130px;
        }
        @media print {
            #print{
                background-color: #fff;
                color: #000;
                border: none;
                font-size: 10pt;
                padding-left: 1px;
                font-weight: normal;
            }
        }}
        }
        </style>
    </head>


    <body>

        <!-- Navigation Bar
        <?php //include 'menu/header_user.php'; ?>-->
        <!-- End Navigation Bar-->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="m-t-1">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card-box">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <?php
                                    $qInvoice=mysql_query("SELECT * FROM `tb_ngiklan` JOIN `tb_detail-ngiklan` ON `tb_ngiklan`.`no_iklan`=`tb_detail-ngiklan`.`no_iklan` JOIN `tb_user` ON `tb_detail-ngiklan`.`id_user`=`tb_user`.`id_user` WHERE `tb_ngiklan`.`no_iklan`='$noInvoice'") or die(mysql_error());
                                    $rInvoice=mysql_fetch_array($qInvoice);

                                    //status transaksi
                                    if ($rInvoice['status']=='0') {
                                        $label="class='label label-warning'";
                                        $sInvoice="Belum Dibayar";
                                    }else if ($rInvoice['status']=='1') {
                                        $label="class='label label-warning'";
                                        $sInvoice="Konfirmasi Admin";
                                    }else if ($rInvoice['status']=='2') {
                                        $label="class='label label-success'";
                                        $sInvoice="Dibayar";
                                    }else if ($rInvoice['status']=='3') {
                                        $label="class='label label-info'";
                                        $sInvoice="Selesai";
                                    }else{
                                        $label="class='label label-danger'";
                                        $sInvoice="Gagal";
                                    }

                                ?>
                                <div class="clearfix">
                                    <div class="pull-left m-t-1">
                                        <img src="../assets/images/logo-invoice.png" class="logo" width="160">
                                    </div>
                                    <div class="pull-right m-t-1">
                                        <table>
                                            <tr>
                                                <td width="105"><h3>No Iklan</h3></td>
                                                <td width="20"><h3>:</h3></td>
                                                <td><h3><?=$rInvoice['no_iklan'];?></h3></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">

                                        <div class="pull-xs-left m-t-30">
                                            <address>
                                              <strong><?=$rInvoice['id_user'];?> | <?=$rInvoice['nama'];?></strong><br>
                                              <div style="width: 60%;">
                                                  <?=$rInvoice['alamat'];?><br>
                                                  <?=$rInvoice['no_hp'];?>
                                              </div>
                                              </address>
                                        </div>
                                        <div class="pull-xs-right m-t-30">
                                            <table>
                                                <tr>
                                                    <td width="120"><strong>Tanggal Transaksi</strong></td>
                                                    <td width="10"><strong>:</strong></td>
                                                    <td><?=tanggal($rInvoice['tgl_pasang']);?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status Transaksi</strong></td>
                                                    <td><strong>:</strong></td>
                                                    <td><span <?=$label;?> id="print"><?=$sInvoice;?></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="m-h-50"></div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead class="bg-faded">
                                                    <tr><th>#</th>
                                                    <th>Item</th>
                                                    <th>Periode</th>
                                                    <th>Lama Pasang</th>
                                                    <th>Unit Cost</th>
                                                </tr></thead>
                                                <tbody>
                                                    <?php
                                                    $qBarang=mysql_query("SELECT * FROM `tb_detail-ngiklan` JOIN `tb_ngiklan` ON `tb_detail-ngiklan`.`no_iklan`=`tb_ngiklan`.`no_iklan` JOIN `tb_iklan` ON `tb_detail-ngiklan`.`id_iklan`=`tb_iklan`.`id_iklan` WHERE `tb_ngiklan`.`no_iklan`='$noInvoice'");
                                                    $n=1;
                                                    while ($rBarang=mysql_fetch_array($qBarang)) { ?>                                                   
                                                    <tr>
                                                        <td><?=$n;?></td>
                                                        <td><?=$rBarang['nama_iklan'];?></td>
                                                        <td><?=tanggal($rBarang['tgl_pasang'])." - ".tanggal($rBarang['tgl_akhir']);?></td>
                                                        <td><?=$rBarang['lama_pasang']." Hari";?></td>
                                                        <td><?=rupiah($rBarang['harga']);?></td>
                                                    </tr>
                                                    <?php
                                                    $n++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="clearfix m-t-30">
                                            <h5 class="small text-inverse font-600"><b>PAYMENT TERMS AND POLICIES</b></h5>
                                            <div style="text-align: justify;">
                                                <small>
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                                </small>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                        <div class="pull-xs-right m-t-30">
                                            <?php 
                                            $subTotal=mysql_fetch_array(mysql_query("SELECT SUM(harga_jual*qty) AS subtotal FROM `tb_detail-transaksi` JOIN `tb_barang` ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE no_invoice='$noInvoice' "));
                                            ?>
                                            <h4>Total Bayar</h4>
                                            <hr>
                                            <h3 class="text-xs-right"><?=rupiah($rInvoice['total_pasang']);?></h3>
                                        </div>
                                        
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-xs-right">
                                        <button type="button" class="btn btn-dark waves-effect waves-light" onclick="window.print()">
                                            <span class="btn-label"><i class="fa fa-print"></i>
                                            </span>Cetak
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
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