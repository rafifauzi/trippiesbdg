<?php
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
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="../assets/plugins/morris/morris.css">
        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="../assets/js/alertify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <style>            
            .iklan-img{
                width: 100%;
            }
            .table tr td{
                transition: 0.3s;
            }
            .table tr td:hover{
                background-color: #64FFDA;
                transition: 0.3s;
                cursor: pointer;
            }
            .filter{
                transition: 0.3s;
            }   
            .filter:hover{
                filter:blur(15px);
                transition: 0.3s;
            }             
        </style>

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
                $('#prosesIklan').on('show.bs.modal', function (e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'trIklan.php',
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
        <?php include 'menu/header_user.php'; ?>
               <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <h4 class="page-title">Pasang Iklan</h4>
                        <div class="row m-t-1"> 
                        <div class="col-sm-12 col-lg-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <h5 class="text-xs-center">Iklan Slider</h5>
                            <div class="card card-inverse">
                                <div id="carousel-example-captions" data-ride="carousel" class="carousel slide slide-img">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-captions" data-slide-to="1"></li>
                                                <li data-target="#carousel-example-captions" data-slide-to="2"></li>
                                                <li data-target="#carousel-example-captions" data-slide-to="3"></li>
                                            </ol>
                                            <div role="listbox" class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="../assets/images/i/blank_iklan.jpg" alt="First slide image" class="filter">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="../assets/images/i/blank_iklan.jpg" alt="Second slide image" class="filter">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="../assets/images/i/blank_iklan.jpg" alt="Third slide image" class="filter">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="../assets/images/i/blank_iklan.jpg" alt="Fourth slide image">
                                                </div>
                                            </div>
                                            <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                                            <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            &nbsp;
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row m-t-1">
                        <center>
                            <button class="btn btn-sm btn-dark-outline waves-effect waves-light text-xs-center" data-toggle="modal" data-target='#iklan'><h5>Lihat Iklan Pop Up</h5></button>
                        </center>
                        
                        <h5 class="text-xs-center m-b-2 m-t-2">Footer Iklan</h5>
                        <div class="col-sm-2 col-xs-4">
                            <div class="card card-inverse">
                                <img class="card-img img-fluid" src="../assets/images/i/blank_iklan.jpg" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-4">
                            <div class="card card-inverse">
                                <img class="card-img img-fluid" src="../assets/images/i/blank_iklan.jpg" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-4">
                            <div class="card card-inverse">
                                <img class="card-img img-fluid" src="../assets/images/i/blank_iklan.jpg" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-4">
                            <div class="card card-inverse">
                                <img class="card-img img-fluid" src="../assets/images/i/blank_iklan.jpg" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-4">
                            <div class="card card-inverse">
                                <img class="card-img img-fluid" src="../assets/images/i/blank_iklan.jpg" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-4">
                            <div class="card card-inverse">
                                <img class="card-img img-fluid" src="../assets/images/i/blank_iklan.jpg" alt="Card image">
                                <div class="card-img-overlay">
                                    <h4 class="card-title">Card title</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="card-box" style="overflow-x: scroll;">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <th>#</th>
                                <th>Jenis Iklan</th>
                                <th>Resolusi (px)</th>
                                <th>Ukuran (MB)</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>                                
                            </tr>
                            <?php 
                            $no=1;
                            $qIklan=mysql_query("SELECT `tb_iklan`.`id_iklan`, nama_iklan, status, ukuran, size, harga FROM tb_iklan LEFT JOIN `tb_detail-ngiklan` ON `tb_iklan`.`id_iklan`=`tb_detail-ngiklan`.`id_iklan` LEFT JOIN tb_ngiklan ON `tb_detail-ngiklan`.`no_iklan`=`tb_ngiklan`.`no_iklan`");
                            while ($iklan=mysql_fetch_array($qIklan)) { 
                                $ukuran=explode(" x ", $iklan['ukuran']);
                                if ($iklan['status']=='3') {
                                    $txtAlert='Dipakai';
                                    $disabled='disabled';
                                }else if ($iklan['status']=='2') {
                                    $txtAlert='Dipesan';
                                    $disabled='disabled';
                                }else{
                                    $txtAlert='Tersedia';
                                    $disabled='';
                                }
                            ?>
                            <tr>
                                <td><?=$no;?></td>
                                <td><?=$iklan['nama_iklan'];?></td>
                                <td><?=$ukuran[0]."px x ".$ukuran[1]."px";?></td>
                                <td><?=$iklan['size']." MB";?></td>
                                <td><?=rupiah($iklan['harga']);?></td>
                                <td><?=$txtAlert;?></td>
                                <td><button class="btn btn-sm btn-primary waves-effect waves-light" data-toggle='modal' data-target="#prosesIklan" data-id="<?=$iklan['id_iklan']?>" <?=$disabled?>>Pasang</button></h5></td>                    
                            </tr>
                            <?php
                            $no++;
                            }
                            ?>
                    </div>
                    
            </div><!-- end col-->
        </div>
                <!-- end row -->
        <div class="modal fade modal-custom" id="iklan">
            <div class="modal-dialog">
              <div class="modal-content modal-content-custom">      
                <!-- Modal Header -->                
                <!-- Modal body -->
                <div class="modal-body ">
                    <h5 class="text-xs-center">Iklan Popup</h5>
                    <img src="../assets/images/i/blank_iklan.jpg" class="iklan-img img-responsive">
                </div>             
              </div>
            </div>
        </div>
        <div class="modal fade" id="prosesIklan" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Pasang Iklan</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
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
            document.getElementById('pasangIklan').style.pointerEvents='auto';
            }
        </script>
        <script type="text/javascript">
            function hitungIklan(){
                var tgl_awal = document.getElementById('tglAwal').value;
                var tgl_akhir = document.getElementById('tglAkhir').value;
                var harga = document.getElementById('hargaIklan').value;
                var intHarga = harga.replace('Rp ','');
                var hargaHari = intHarga .replace('.','');
                var tgl_awal_pisah=tgl_awal.split('-');
                var tgl_akhir_pisah=tgl_akhir.split('-');
                var objek_tgl = new Date();
                var tgl_awal_leave = objek_tgl.setFullYear(tgl_awal_pisah[0],tgl_awal_pisah[1],tgl_awal_pisah[2]);
                var tgl_akhir_leave= objek_tgl.setFullYear(tgl_akhir_pisah[0],tgl_akhir_pisah[1],tgl_akhir_pisah[2]);
                var durasi = (tgl_akhir_leave-tgl_awal_leave)/(60*60*24*1000);                               
                var total=parseInt(hargaHari)*parseInt(durasi);
                var sTotal=total.toString();
                document.getElementById('durasi').value=durasi;
                document.getElementById('txttotHarga').value=formatRupiah(sTotal,'Rp ');
                document.getElementById('pasangIklan').style.pointerEvents='auto';
                document.getElementById('pasangIklan').className = "form-control btn btn-primary waves-effect waves-light";
                document.getElementById('totDurasi').innerHTML=durasi+' Hari';
            }
            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
     
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
     
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
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