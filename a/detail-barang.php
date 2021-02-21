<?php 
include '../database/koneksi.php'; 
if (isset($_GET['id'],$_GET['user'])) {
    $btnDisplay="style='display:none;'";
    $id=$_GET['id'];
    $q=mysql_query("SELECT * FROM tb_barang WHERE id_barang='$id'");
    $qGambar=mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$id'");
    $bGambar=mysql_num_rows( mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$id'"));
    $r=mysql_fetch_array($q);
    if ($r['kondisi']==1) {
        $kondisi='Baru';
    }else{
        $kondisi='Bekas';
    }
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
    $tgl_upload=date('d', strtotime($r['tgl_upload']))." ". $bulan[date('m', strtotime($r['tgl_upload']))]." ".date('Y', strtotime($r['tgl_upload']));
    function rupiah($angka){    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;     
    }
}
else if (isset($_GET['id'])) {
    $btnDisplay="style='display:block;'";
    $id=$_GET['id'];
    $q=mysql_query("SELECT * FROM tb_barang WHERE id_barang='$id'");
    $qGambar=mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$id'");
    $bGambar=mysql_num_rows( mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$id'"));
    $r=mysql_fetch_array($q);
    if ($r['kondisi']==1) {
        $kondisi='Baru';
    }else{
        $kondisi='Bekas';
    }
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
    $tgl_upload=date('d', strtotime($r['tgl_upload']))." ". $bulan[date('m', strtotime($r['tgl_upload']))]." ".date('Y', strtotime($r['tgl_upload']));
    function rupiah($angka){    
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;     
    }
}else{
    echo "<script>window.location.assign('store')</script>";
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

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../assets/plugins/jquery.steps/demo/css/jquery.steps.css" />

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
                        url : 'hasil.php',
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
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-4">
                        <div class="card-box">
                            <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <?php 
                                        for ($i=0; $i<$bGambar ; $i++) { 
                                            if ($i==0) {
                                                $active='class="active"';
                                            }else{
                                                $active='';
                                            } 
                                    ?>
                                        <li data-target="#carousel-example-captions" data-slide-to="<?=$i;?>" <?=$active;?>></li>
                                    <?php
                                        }
                                    ?>
                                </ol>
                                    <div role="listbox" class="carousel-inner">
                                        <?php 
                                            $no=0;
                                            $noo=1;
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
                                                    <img src="../assets/images/b/<?=$gambar['gambar'];?>" alt="<?=$cdName;?>" style="width: 400px; height: 400px;">
                                                </div>
                                                <?php
                                                $no++;
                                                $noo++;
                                            }
                                        ?>
                                    </div>
                                <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                                <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-16 col-sm-16 col-md-16 col-lg-8">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-10"><?=$r['nama_barang'];?></h4><hr>
                            <h4><?=rupiah($r['harga_jual']);?></h4>
                            <table class="table m-t-1" style="width: 100%;">
                                <tr>
                                    <td><label>Kondisi</label></td>
                                    <td>:</td>
                                    <td><?=$kondisi;?></td>
                                    <td><label>Stok</label></td>
                                    <td>:</td>
                                    <td><?=$r['stok'];?> Buah</td>
                                </tr>
                                <tr>
                                    <td><label>Dilihat</label></td>
                                    <td>:</td>
                                    <td><?=$r['dilihat'];?></td>
                                    <td><label>Terjual</label></td>
                                    <td>:</td>
                                    <td><?='0';?></td>
                                </tr>
                                <tr>
                                    <td><label>Berat</label></td>
                                    <td>:</td>
                                    <td><?=$r['berat'];?> Gram</td>
                                    <td><label>Tanggal Upload</label></td>
                                    <td>:</td>                                                
                                    <td><?=$tgl_upload;?></td>
                                </tr>
                            </table>
                            <hr>
                            <h4 class="m-t-2 header-title">Deskripsi</h4>
                            <p align="justify"><?=$r['deskripsi'];?></p>
                            <button class="form-control btn btn-danger waves-effect waves-light" data-toggle='modal' data-target="#edit" data-id="<?=$id?>" <?=$btnDisplay;?> >Ubah Data</button>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
        <div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Ubah Data Barang</b></h4>
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