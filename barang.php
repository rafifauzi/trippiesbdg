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

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/plugins/jquery.steps/demo/css/jquery.steps.css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

    </head>
<body>
<?php include 'menu/header.php';?>
	<div class="wrapper">
        <div class="container">
        	<?php 
                $date=date('dmY');
                $sql=mysql_query("SELECT id_barang FROM tb_barang") or die(mysql_error());
                while ($hasil=mysql_fetch_array($sql)) {
                    echo $hasil['id_barang']."<br>";
                }

                $sql1=mysql_query("SELECT id_barang FROM tb_barang WHERE SUBSTR(id_barang,3,8)='$date'") or die(mysql_error());
                $cek=mysql_num_rows($sql1);
                $urutan=$cek+1;
                if ($cek==0) {
                    $idBarang="BR".$date."".$urutan;
                    echo $idBarang;
                }
            ?>
        </div>
    </div>
</body>
</html>