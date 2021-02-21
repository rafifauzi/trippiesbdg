<?php 
include '../database/koneksi.php';
session_start();
$qProfil=mysql_query("SELECT * FROM tb_admin JOIN tb_kota ON tb_admin.kota=tb_kota.id_kota") or die(mysql_error());
$rProfil=mysql_fetch_array($qProfil);
$qbank=mysql_query("SELECT * FROM tb_bank") or die(mysql_error());
$rbank=mysql_fetch_array($qbank);
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
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
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
                                    <div class="col-sm-12 col-lg-8">
                                        <div class="form-group">
                                            <label class="form-control-label">Username</label>
                                            <input type="text" name="userName" class="form-control" value="<?=$rProfil['username'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?=$rProfil['email'];?>">
                                        </div>
                                        <div class="form-group">                                            
                                            <label class="form-control-label">Password</label>
                                            <div class="row">
                                                <div class="col-sm-9 col-lg-9">
                                                    <div ng-app="myapp">
                                                        <div ng-controller="PasswordController">
                                                            <input type="password" ng-model="password" ng-change="analyze(password)" ng-style="passwordStrength" name="pass" class="form-control" placeholder="Password" id="password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-lg-3">
                                                    <button type="submit" name="ubahPass" class="form-control btn btn-dark waves-effect waves-light">Ubah</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                         <hr><label>Alamat</label>
                                         <div class="form-group">
                                            <label class="form-control-label">Kota / Kabupaten (Digunakan Untuk Pengiriman Barang Trippies)</label>
                                            <input type="text" name="kecamatan" class="form-control" value="<?=$rProfil['nama_kota'];?>">
                                            <input type="hidden" name="idKota" class="form-control" value="<?=$rProfil['kota'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Foto Profil (JPG / JPEG , Size Max 2Mb)</label>
                                            <input type="file" name="foto_profil" class="form-control" style="width: 100%;">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Foto Sampul (JPG / JPEG , Size Max 2Mb)</label>
                                            <input type="file" name="foto_sampul" class="form-control" style="width: 100%;">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <button type="submit" name="update" class="form-control btn btn-success waves-effect waves-light">Simpan</button>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <button class="form-control btn btn-danger waves-effect waves-light">Batal</button>
                                                </div>
                                            </div>
                                            
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

        <script>
            var resizefunc = [];
            function login(){
                window.location.assign('login');
            }
            var myApp = angular.module("myapp", []);
            myApp.controller("PasswordController", function($scope) {

                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                $scope.passwordStrength = {
                    "width": "100%"
                };

                $scope.analyze = function(value) {
                    var panjang=value.length;
                    if (panjang<=10&&panjang>0) {
                        if(strongRegex.test(value)) {
                            $scope.passwordStrength["background-color"] = "#CCFF90";
                            $scope.passwordStrength["border-color"] = "#CCFF90";
                            scope.passwordStrength["color"] = "#000";
                            $scope.passwordStrength["display"] = "block";
                        } else if(mediumRegex.test(value)) {
                            $scope.passwordStrength["background-color"] = "#F4FF81";
                            $scope.passwordStrength["border-color"] = "#F4FF81";
                            scope.passwordStrength["color"] = "#000";
                            $scope.passwordStrength["display"] = "block";
                        } else {
                           $scope.passwordStrength["background-color"] = "#EF9A9A";
                           $scope.passwordStrength["border-color"] = "#EF9A9A";
                           $scope.passwordStrength["color"] = "#000";
                           $scope.passwordStrength["display"] = "block";
                        }
                    }else{
                        alertify.alert("Password Minimal 10 Karakter", function(){ 
                            document.getElementById('password').value=''; 
                        }).setHeader(' ').set({closable:false,transition:'pulse'});
                    }
                };

            });
        </script>
    </body>
</html>
