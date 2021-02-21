<?php 
include '../database/koneksi.php'; 
function rupiah($angka){    
    $hasil_rupiah = "Rp " . number_format($angka);
    return $hasil_rupiah;     
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
        <title>Jual Barang</title>

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
                        <h4 class="page-title">Barang Dijual</h4>
                    </div>
                    <div class="col-sm-12 col-lg-6">                        
                        <h4 class="page-title pull-right">
                            <button type="button" class="btn btn-primary waves-effect waves-light" onclick="<?=$panggil;?>">
                                <span class="btn-label"><i class="fa fa-plus"></i>
                                </span>Tambah Barang
                            </button>
                        </h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok (buah)</th>
                                        <th>Berat (gram)</th>
                                        <th>Harga Barang</th>
                                        <th>Biaya Admin (2%)</th>
                                        <th>Harga Jual</th>
                                        <th>Kondisi</th>
                                        <th>Dilihat</th>
                                        <th>Tanggal Upload</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $q=mysql_query("SELECT * FROM tb_barang WHERE pemilik!='admin' AND pemilik='$idUser' ORDER BY tgl_upload DESC");
                                    while ($r=mysql_fetch_array($q)) { 
                                        $biayaAdmin=$r['harga_jual']-$r['harga_beli'];
                                        if ($r['kondisi']==1) {
                                            $kondisi='Baru';
                                        }else{
                                            $kondisi='Bekas';
                                        }
                                    ?>
                                    <tr>
                                        <th><?=$r['id_barang']?></th>
                                        <th><?=$r['nama_barang']?></th>
                                        <th><?=$r['stok']?></th>
                                        <th><?=$r['berat']?></th>
                                        <th><?=rupiah($r['harga_beli'])?></th>
                                        <th><?=rupiah($biayaAdmin)?></th>
                                        <th><?=rupiah($r['harga_jual'])?></th>
                                        <th><?=$kondisi?></th>
                                        <th><?=$r['dilihat']?></th>
                                        <th><?=date('d-m-Y',strtotime($r['tgl_upload']))?></th>
                                        <th>
                                            <a href="../detail-store?id=<?=$r['id_barang']?>"><button class="form-control btn btn-sm btn-primary waves-effect waves-light" style="margin-top: 2px;">Detail</button></a>
                                            <form method="POST" action="proses-barang">
                                                <input type="hidden" name="idBarang" value="<?=$r['id_barang']?>">
                                                <button type="submit" name="hapusBarang" class="form-control btn btn-sm btn-danger waves-effect waves-light" style="margin-top: 2px;">Hapus</button>
                                            </form>
                                        </th>
                                    </tr>
                                    <?php
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

        <script>
            var resizefunc = [];
            function addCerita() {
                window.location.assign('tambah-barang');
            }
            function noneCerita() {
                window.location.assign('../login');
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

        </script>

    </body>
</html>