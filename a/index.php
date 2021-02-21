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
        <title>Trippies Admin | Login</title>

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../assets/js/modernizr.min.js"></script>

    </head>


    <body>
        <div class="container">            
            <h2 class="bg-logo m-t-1" align="center" onclick="window.location.assign('index.php');"><img src="../assets/images/logo.png" width="200"></h2>
            <div class="wrapper-page">
                <div class="row">
                    <div class="col-xs-12 text-xs-center m-b-1">
                        <h4 class="text-muted text-uppercase m-b-0 m-t-0">Admin | Trippies</h4>
                    </div>
                </div>
                <div class="card-box m-b-0">
                    <div class="m-t-10 p-20">
                        <form class="m-t-0" action="proses-login.php" method="POST">
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required name="email" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required name="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-10">
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group row m-t-30 m-b-0">
                                <div class="col-sm-12">
                                    <a href="pages-404.php" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <!-- end card-box-->
        </div>
        </div>        
        <!-- end wrapper page -->


        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
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