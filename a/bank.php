<?php 
include '../database/koneksi.php';
session_start();
$qProfil=mysql_query("SELECT * FROM tb_admin JOIN tb_kota ON tb_admin.kota=tb_kota.id_kota") or die(mysql_error());
$rProfil=mysql_fetch_array($qProfil);
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
        <title>Profil Admin</title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- X-editable css -->
        <link type="text/css" href="../assets/plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                $('#edit').on('show.bs.modal', function (e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'editBank.php',
                        data :  'rowid='+ rowid,
                        success : function(data){
                        $('.fetched-data').html(data);
                        }
                    });
                 });
            });
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
                    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 m-t-1">                    
                        <div class="card card-inverse">
                            <img class="card-img img-fluid sampul" src="../assets/images/users/<?=$rProfil['foto_sampul'];?>">
                            <div class="card-img-overlay">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-1">
                                <div>
                                    <img src="../assets/images/users/<?=$rProfil['foto_profil'];?>?t=<?=$idUser?>" alt="user" class="img-foto img-profil" style="border: 1px solid">

                                </div>
                            </div>
                            </div>
                        </div>
                </div>
                </div>



                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card-box">
                            <div class="row"> 
                                <form method="POST" action="proses-profil.php" enctype="multipart/form-data">
                                    <div class="col-sm-12 col-lg-12">                                        
                                        <div class="form-group">           
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-3">
                                                    <label class="form-control-label">Kode Bank (<a href="https://flip.id/kode-bank">Silahkan Lihat Disini</a>)</label>
                                                    <input type="text" name="kdBank" class="form-control">
                                                </div>
                                                <div class="col-sm-5 col-lg-5">
                                                    <label class="form-control-label">Nama Bank</label>
                                                    <input type="text" name="nmBank" class="form-control">
                                                </div>
                                                <div class="col-sm-4 col-lg-4">
                                                    <label class="form-control-label">Pemilik</label>
                                                    <input type="text" name="pemilik" class="form-control">
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="form-group">                                            
                                            <label class="form-control-label">Nomor Rekening</label>
                                            <div class="row">
                                                <div class="col-sm-9 col-lg-9">
                                                    <input type="text" name="noRek" class="form-control">
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <button type="submit" name="tambahBank" class="form-control btn btn-dark waves-effect waves-light">Simpan</button>
                                                </div>
                                            </div>                                            
                                        </div>
                                         <hr>                                         
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-box">
                            <h5>Daftar Bank</h5>
                            <hr>
                            <div style="overflow-y: scroll; overflow-x: scroll; height: 500px;">
                                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Id Bank</th>
                                            <th>Nama Bank</th>
                                            <th>Atas Nama</th>
                                            <th>No Rekening</th>
                                            <th colspan="2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $qbank=mysql_query("SELECT * FROM tb_bank") or die(mysql_error());
                                        $no=1;
                                        while ($r=mysql_fetch_array($qbank)) { ?>
                                            <tr>
                                                <th><?=$no;?></th>
                                                <th><?=$r['id_bank'];?></th>
                                                <th><?=$r['nama_bank'];?></th>
                                                <th><?=$r['nama_pemilik'];?></th>
                                                <th><?=$r['no_rek'];?></th>
                                                <th width="20">
                                                    <button class="btn btn-dark waves-effect waves-light" data-toggle='modal' data-target="#edit" data-id="<?=$r['id_bank']?>" ><span class="fa fa-edit"></span></button>
                                                </th>
                                                <th width="20">
                                                    <form method="POST" action="proses-profil">
                                                        <input type="hidden" name="kdBank" value="<?=$r['id_bank'];?>">
                                                        <button class="btn btn-danger waves-effect waves-light" name="hapusBank"><span class="fa fa-trash"></span></button>
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
                <!-- end row -->
            <div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Ubah Data Bank</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                </div>
            </div>
        </div
            <!-- Footer -->
            <?php include 'menu/footer.php'; ?>
                        <!-- End Footer -->


            </div> <!-- container -->



        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
        </script>

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
