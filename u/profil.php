<?php 
include '../database/koneksi.php'; 
$row=mysql_num_rows(mysql_query("SELECT id_barang FROM tb_keranjang"));
if ($row>0) {
    $notif="<span class='noti-icon-badge'></span>";
}else{
    $notif="<span class='noti-icon-badge-none'></span>";
}
session_start();
$iduser=$_SESSION['id_user'];
$qProfil=mysql_query("SELECT * FROM tb_user JOIN tb_kota ON tb_user.kota=tb_kota.id_kota WHERE id_user='$iduser' ") or die(mysql_error());
$rProfil=mysql_fetch_array($qProfil);
if ($rProfil['jk']=='1') {
    $laki='selected';
}else{
    $laki='';
}
if ($rProfil['jk']=='0') {
    $perem='selected';
}else{
    $perem='';
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
        <title><?=$rProfil['nama'];?></title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- X-editable css -->
        <link type="text/css" href="../assets/plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet">

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
                                    <div class="col-sm-12 col-lg-8">
                                        <div class="form-group">
                                            <label class="form-control-label">Nama User</label>
                                            <input type="text" name="nama" class="form-control" value="<?=$rProfil['nama'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Tanggal Lahir</label>
                                            <input type="date" name="tgllahir" class="form-control" value="<?=date('Y-m-d',strtotime($rProfil['birthday']));?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Jenis Kelamin</label>
                                            <select class="form-control" name="jk">
                                                <option value="0" disabled selected>Jenis Kelamin</option>
                                                <option value="1" <?=$laki?>>Laki-Laki</option>
                                                   <option value="2" <?=$perem?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?=$rProfil['email'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">No. Hp</label>
                                            <input type="number" name="noHp" class="form-control" value="<?=$rProfil['no_hp'];?>">
                                        </div>
                                         <hr><label>Alamat</label>
                                         <div class="form-group">
                                            <label class="form-control-label">Kota / Kabupaten</label>
                                            <input type="text" name="kecamatan" class="form-control" value="<?=$rProfil['nama_kota'];?>">
                                            <input type="hidden" name="idKota" class="form-control" value="<?=$rProfil['kota'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Kode Pos</label>
                                            <input type="number" name="kodePos" class="form-control" value="<?=$rProfil['kodepos'];?>">
                                        </div>
                                        <div class="form-group">                        
                                            <label class="form-control-label">Alamat Lengkap</label>       
                                            <textarea name="alamat" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;"><?=$rProfil['alamat'];?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <div class="form-group txt-center">   
                                            <h4 class="m-t-1 text-xs-center">ID : <?=$rProfil['id_user'];?></h4><hr> 
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Foto Profil (JPG / JPEG , Size Max 2Mb)</label>
                                            <input type="file" name="foto_profil" class="form-control" style="width: 100%;">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Foto Sampul (JPG / JPEG , Size Max 2Mb)</label>
                                            <input type="file" name="foto_sampul" class="form-control" style="width: 100%;">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="update" class="form-control btn btn-success waves-effect waves-light">Simpan</button>
                                        </div>
                                        <div class="form-group">
                                            <button class="form-control btn btn-danger waves-effect waves-light">Batal</button>
                                        </div>
                                    </div>
                                </form>
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

        <!-- XEditable Plugin -->
        <script src="../assets/plugins/moment/moment.js"></script>
        <script type="text/javascript" src="../assets/plugins/x-editable/js/bootstrap-editable.min.js"></script>
        <script type="text/javascript" src="../assets/pages/jquery.xeditable.js"></script>


    </body>
</html>
