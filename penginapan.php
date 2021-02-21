<?php 
include 'database/koneksi.php'; 
$row=mysql_num_rows(mysql_query("SELECT id_keranjang FROM tb_keranjang"));
if ($row>0) {
    $notif="<span class='noti-icon-badge'></span>";
}else{
    $notif="<span class='noti-icon-badge-none'></span>";
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
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Penginapan</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script>
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
        <style type="text/css">
            .img-sm{
                width: 150px;
            }
            .story-title{
                padding: 15px;
                color: #fff;
                border-radius: 5px;
                background-color: rgba(0,0,0,0.3);
            }
        </style>

    </head>


    <body>

        <?php 
            include 'menu/header.php';
            $halaman = 12;
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0; 
            $query = mysql_query("SELECT * FROM tb_penginapan LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT id_penginapan FROM tb_penginapan ") or die(mysql_error);     
            $total = mysql_num_rows($result);
            $pages = ceil($total/$halaman); 
            $no =$mulai+1;
        ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Penginapan</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-inline">
                            <?php
                                while ($rPenginapan=mysql_fetch_array($query)) { 
                                    $kapasitas=$rPenginapan['minOrang']." Orang - ".$rPenginapan['maxOrang']." Orang";
                                    $idPenginapan=$rPenginapan['id_penginapan'];
                                    if (strlen($rPenginapan['nama_penginapan'])>25) {
                                        $namaPenginapan=str_pad(substr($rPenginapan['nama_penginapan'],0,25),30,".");
                                    }else{
                                        $namaPenginapan=$rPenginapan['nama_penginapan'];
                                    }
                            ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <h4><?=$namaPenginapan;?></h4>
                                                    <small class="text-muted"><?=tanggal($rPenginapan['tanggal_upload']);?></small><br>
                                                    <small><?=$kapasitas.", ".rupiah($rPenginapan['harga'])."/Hari";?></small><br>
                                                    <small class="text-muted"><li class="ion ion-location"></li> <?=$rPenginapan['alamat_penginapan'];?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="carousel-example-captions" data-ride="carousel" class="carousel slide slide-img">
                                            <div role="listbox" class="carousel-inner">
                                        <?php 
                                            $no=0;
                                            $noo=1;                                            
                                            $qGambar=mysql_query("SELECT gambar FROM tb_gambar_penginapan WHERE id_penginapan='$idPenginapan'");
                                            $bGambar=mysql_num_rows( mysql_query("SELECT gambar FROM tb_gambar_penginapan WHERE id_penginapan='$idPenginapan'"));
                                            while ($gambar=mysql_fetch_array($qGambar)) {
                                                if ($no==0) {
                                                    $active1='carousel-item active';
                                                }else{
                                                    $active1='carousel-item';
                                                }

                                                switch ($noo) {
                                                    case '1':
                                                        $cdName='First slide image';
                                                        break;
                                                    case '2':
                                                        $cdName='Second slide image';
                                                        break; 
                                                    case '3':
                                                        $cdName='Third slide image';
                                                        break; 
                                                    case '4':
                                                        $cdName='Fourth slide image';
                                                        break;
                                                }
                                                ?>
                                                <div class="<?=$active1;?>">
                                                    <img src="assets/images/p/<?=$gambar['gambar'];?>" alt="<?=$cdName;?>" style="width: 400px; height: 350px; object-fit: cover;">
                                                </div>
                                                <?php
                                                $no++;
                                                $noo++;
                                            }
                                        ?>
                                    </div>
                                        </div>
                                        <div class="m-t-1 m-b-1">
                                            <center>
                                                <a href="#booking" class="btn btn-primary waves-effect waves-light" data-toggle='modal' data-id="<?=$rPenginapan['id_penginapan'];?>">Booking Now</a>                                                
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-lg-6">                        
                        <div class="m-b-20">
                            <center>
                                <button type="button" class="btn btn-dark waves-effect m-t-1" onclick="pageBaru(1)"><<</button>
                                <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                    <button type="button" class="btn btn-secondary waves-effect m-t-1" onclick="pageBaru(<?=$i;?>)"><?=$i;?></button> 
                                <?php } ?>
                                <button type="button" class="btn btn-dark waves-effect m-t-1" onclick="pageBaru(<?=$pages;?>)">>></button>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                </div>
                <!-- end row -->


                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->

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

            </div> <!-- container -->

        </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
            function addCerita() {
                window.location.assign('u/story_add');
            }
            function pageBaru(page){
                window.location.assign('?page='+page);
            }
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>