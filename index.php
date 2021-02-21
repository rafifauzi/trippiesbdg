<?php 
function rupiah($angka){    
    $hasil_rupiah = "Rp " . number_format($angka);
    $rupiah=str_replace(',', '.', $hasil_rupiah);
    return $rupiah;     
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

session_start();
ob_start();
if (isset($_SESSION['id_user'])) {
    echo "<script>alertify.success('Selamat Datang');</script>";
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
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Trippies.</title>
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="assets/js/alertify.min.js"></script>
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
        <script src="assets/js/modernizr.min.js"></script>
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#iklan').modal('show');
            });
            $(document).ready(
                function(){
                $('#booking').on('show.bs.modal', function (e) {
                    var rowid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'booking.php',
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
                <div class="row m-t-1"> 
                    <div class="col-sm-12 col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="card card-inverse">
                            <?php 
                            $slide1=mysql_fetch_array(mysql_query("SELECT image_iklan FROM tb_iklan WHERE id_iklan='IK2A'"));
                            $slide2=mysql_fetch_array(mysql_query("SELECT image_iklan FROM tb_iklan WHERE id_iklan='IK2B'"));
                            $slide3=mysql_fetch_array(mysql_query("SELECT image_iklan FROM tb_iklan WHERE id_iklan='IK2C'"));
                            $slide4=mysql_fetch_array(mysql_query("SELECT image_iklan FROM tb_iklan WHERE id_iklan='IK2D'"));
                            ?>
                            <div id="carousel-example-captions" data-ride="carousel" class="carousel slide slide-img">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-captions" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-captions" data-slide-to="2"></li>
                                            <li data-target="#carousel-example-captions" data-slide-to="3"></li>
                                        </ol>
                                        <div role="listbox" class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="assets/images/i/<?=$slide1['image_iklan'];?>" alt="First slide image">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/i/<?=$slide2['image_iklan'];?>" alt="Second slide image">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/i/<?=$slide3['image_iklan'];?>" alt="Third slide image">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="assets/images/i/<?=$slide4['image_iklan'];?>" alt="Fourth slide image">
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
                <div class="row">
                    <?php
                        $iklan2=mysql_query("SELECT image_iklan FROM tb_iklan WHERE SUBSTR(id_iklan,1,3)='IK3'");
                        while ($pasang2=mysql_fetch_array($iklan2)) { ?>
                            <div class="col-sm-2 col-xs-4">
                                <div class="card card-inverse">
                                    <img class="card-img img-fluid" src="assets/images/i/<?=$pasang2['image_iklan'];?>" alt=" Card image">
                                    <div class="card-img-overlay">
                                        <h4 class="card-title"></h4>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    ?>
                </div><!-- end col-->


            <!--content barang-->
            <div class="card-box">
                <h5>Store</h5>
                <div class="form-inline">
                    <div class="row">
                        <?php 
                            $qBarang=mysql_query("SELECT DISTINCT id_barang, nama_barang, harga_jual, tgl_upload FROM tb_barang ORDER BY tgl_upload DESC LIMIT 10");
                            while ($rBarang=mysql_fetch_array($qBarang)) { 
                                $idBarang=$rBarang['id_barang'];
                                $gambar=mysql_fetch_array(mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$idBarang' LIMIT 1"));
                                if (strlen($rBarang['nama_barang'])>25) {
                                    $namaBarang=str_pad(substr($rBarang['nama_barang'],0,25),30,".");
                                }else{
                                    $namaBarang=$rBarang['nama_barang'];
                                }
                                ?>
                                
                                <div class="col-sm-4 col-lg-2 col-xs-12 m-t-1">
                                    <div class="form-group card" onclick="window.location.assign('detail-store?id=<?=$rBarang['id_barang']?>')">
                                        <img src="assets/images/b/<?=$gambar['gambar'];?>" class="card-img-top img-thumbnail img-sampul"><br>
                                        <div class="card-block">
                                            <p class="card-title"><?=$namaBarang;?></p>
                                            <p class="card-text"><b><?=rupiah($rBarang['harga_jual']);?></b></p>
                                            <a href="detail-store?id=<?=$rBarang['id_barang']?>"><button class="btn btn-primary waves-effect waves-light">Detail</button></a>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!--end content barang-->
            <!--content open trip-->
            <div class="card-box">
                <h5>Open Trip</h5>
                <div class="form-inline">
                    <div class="row">
                        <?php 
                            $qTrip=mysql_query("SELECT * FROM tb_opentrip ORDER BY tgl_upload DESC LIMIT 10");
                            while ($rTrip=mysql_fetch_array($qTrip)) { ?>
                                
                                <div class="col-sm-4 col-lg-2 col-xs-12 m-t-1">
                                    <div class="form-group card" onclick="window.location.assign('detail-trip?id=<?=$rTrip['id_trip']?>')">
                                        <img src="assets/images/o/<?=$rTrip['gambar1'];?>" class="card-img-top img-thumbnail img-sampul"><br>
                                        <div class="card-block">
                                            <span class="card-title"><?=$rTrip['nama_paket'];?></span><br>
                                            <span class="card-text"><b><?=rupiah($rTrip['harga']);?></b></span><br>
                                            <span class="card-title">Periode : <br><?=tanggal($rTrip['periodeAwal'])." - ".tanggal($rTrip['periodeAkhir']);?></span><br><br>
                                            <a href="detail-trip?id=<?=$rTrip['id_trip']?>"><button class="btn btn-primary waves-effect waves-light">Detail</button></a>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!--end content open trip-->
            <!--content Penginapan-->
            <div class="card-box">
                <h5>Penginapan</h5>
                <div class="form-inline">
                    <div class="row">
                        <?php 
                            $qPenginapan=mysql_query("SELECT * FROM tb_penginapan ORDER BY tanggal_upload DESC LIMIT 10");
                            while ($rPenginapan=mysql_fetch_array($qPenginapan)) { 
                                $idPenginapan=$rPenginapan['id_penginapan'];
                                $gambar=mysql_fetch_array(mysql_query("SELECT gambar FROM tb_gambar_penginapan WHERE id_penginapan='$idPenginapan' LIMIT 1"));
                                if (strlen($rPenginapan['nama_penginapan'])>25) {
                                    $namaBarang=str_pad(substr($rPenginapan['nama_penginapan'],0,25),30,".");
                                }else{
                                    $namaBarang=$rPenginapan['nama_penginapan'];
                                }
                                ?>
                                
                                <div class="col-sm-4 col-lg-2 col-xs-12 m-t-1">
                                    <div class="form-group card">
                                        <img src="assets/images/p/<?=$gambar['gambar'];?>" class="card-img-top img-thumbnail img-sampul"><br>
                                        <div class="card-block"><?=$idPenginapan;?>
                                            <span class="card-title"><?=$namaBarang;?></span><br>
                                            <span class="card-text"><b><?=rupiah($rPenginapan['harga']);?></b></span><br>
                                            <button class="btn btn-primary waves-effect waves-light" data-toggle='modal' data-target='#booking' data-id="<?=$rPenginapan['id_penginapan'];?>">Booking Now</button>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!--end content Penginapan-->
            </div>
                <!-- end row -->
        <div class="modal fade modal-custom" id="iklan">
            <div class="modal-dialog">
              <div class="modal-content modal-content-custom">      
                <!-- Modal Header -->                
                <!-- Modal body -->
                <div class="modal-body ">
                    <?php
                        $iklan1="SELECT image_iklan FROM `tb_detail-ngiklan` JOIN tb_iklan ON `tb_detail-ngiklan`.`id_iklan`=`tb_iklan`.`id_iklan` WHERE `tb_detail-ngiklan`.`id_iklan`='IK1'";
                        $pasang1=mysql_fetch_array(mysql_query($iklan1));
                    ?>
                    <img src="assets/images/i/<?=$pasang1['image_iklan'];?>" class="iklan-img img-responsive">
                </div>             
              </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="booking" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Booking Info</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!--<div class="modal fade modal-custom" id="register">
            <div class="modal-dialog">
              <div class="modal-content modal-content-custom">      
                Modal Header
                <div class="modal-header">
                  <center><h5>Register</h5></center>
                </div>
                
                Modal body
                <div class="modal-body ">
                    <form method="POST" name="register" action="proses_register">
                        <input type="text" name="firstName" placeholder="First Name" class="form-control" required autocomplete="off" autofocus>
                        <input type="text" name="lastName" placeholder="Last Name" class="form-control" required autocomplete="off">
                        <select name="gender" class="form-control select" required>
                            <option value="" selected class="placeholder">Gender</option>
                            <option value="1">Pria</option>
                            <option value="0">Wanita</option>
                        </select>
                        <input type="text" name="place" placeholder="Where do you live ?" class="form-control" required autocomplete="off">
                        <input type="email" name="email" placeholder="Email" class="form-control" required autocomplete="off">
                        <input type="password" name="password" placeholder="Password" class="form-control" onchange="cekPass(this.value)" required autocomplete="off">
                        <center>
                            <button type="submit" class="btn btn-primary-outline waves-effect waves-light" name="register">Register</button>
                      </center>
                    </form>
                </div>             
              </div>
            </div>
        </div> -->


                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->


            </div> <!-- container -->
        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

    </body>
</html>