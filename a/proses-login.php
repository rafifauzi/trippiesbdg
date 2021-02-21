<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../assets/css/alertify.min.css" type='text/css' />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="../assets/js/alertify.min.js"></script>
</head>
<body>
<?php
  session_start();
   require_once("../database/koneksi.php");

   $email = $_POST['email'];
   $pass = $_POST['password'];

   $cekuser = mysql_query("SELECT * FROM tb_admin WHERE email = '$email' AND password='$pass' ");
   $hasil = mysql_fetch_array($cekuser);
    
     if(mysql_num_rows($cekuser) == 0) {
        ?>
            <script language="JavaScript">
                alertify.alert("Username Belum Terdaftar", function(){ window.location.assign('index'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?PHP
      } else{
        if($pass <> $hasil['password']) {
        ?>
            <script language="JavaScript">
                alertify.alert("Password Salah", function(){ window.location.assign('index'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?PHP
        } else{
         $_SESSION['email'] = $hasil['email'];
         $_SESSION['id_admin'] = $hasil['id_admin'];
         ?>
            <script language="JavaScript">
                window.location.assign('home.php');
            </script>
        <?PHP
        }
      }   
?>
</body>
</html>