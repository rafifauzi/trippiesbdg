<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="assets/css/alertify.min.css" type='text/css' />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <script src="assets/js/alertify.min.js"></script>
</head>
<body>

</body>
</html>
<?php
  session_start();
   require_once("database/koneksi.php");

   $email = $_POST['email'];
   $pass = $_POST['password'];

   $cekuser = mysql_query("SELECT * FROM tb_user WHERE email = '$email' ");
   $hasil = mysql_fetch_array($cekuser);
   // if ($pass=='admin' && $email=='admin@gmail.com') {
   //    $_SESSION['email'] = $email;
   //    $id=$hasil['id_user'];
   //    echo "<script>window.location.assign('a/openTrip_add.php')</script>";
   // }else{    
     if(mysql_num_rows($cekuser) == 0) {
        ?>
            <script language="JavaScript">
                alertify.alert("Username Belum Terdaftar", function(){ window.location.assign('login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?PHP
      } else{
        if($pass <> $hasil['password']) {
        ?>
            <script language="JavaScript">
                alertify.alert("Password Salah", function(){ window.location.assign('login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?PHP
        } else{
         $_SESSION['email'] = $hasil['email'];
         $_SESSION['id_user'] = $hasil['id_user'];
         ?>
            <script language="JavaScript">
                window.location.assign('index.php');
            </script>
        <?PHP
        }
      }
     // }
?>