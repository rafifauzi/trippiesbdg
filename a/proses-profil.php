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
include '../database/koneksi.php';  
if (isset($_POST['update'])) {   
    $qProfil=mysql_query("SELECT foto_profil, foto_sampul FROM tb_admin") or die(mysql_error());
    $rProfil=mysql_fetch_array($qProfil);
    $userName=$_POST['userName'];
    $email=$_POST['email'];
    $idKota=$_POST['idKota'];
    $ekstensi_diperbolehkan = array('jpg','jpeg','bmp','png');
    $file1 = $_FILES['foto_profil']['name'];
    if ($file1==null) {        
        $namaBaru1=$rProfil['foto_profil'];
        $ekstensi1='jpg';
        $ukuran1=2000;

    }else{
        $x1 = explode('.', $file1);
        $nama1=strtolower(current($x1));
        $ekstensi1 = strtolower(end($x1));
        $namaBaru1="admin-fp.".$ekstensi1;
        $ukuran1 = $_FILES['foto_profil']['size'];
        $file_tmp1 = $_FILES['foto_profil']['tmp_name'];        
    }
    $file2 = $_FILES['foto_sampul']['name'];
    if ($file2==null) {        
        $sampul=$rProfil['foto_sampul'];
        $ekstensi2='jpg';
        $ukuran2=2000;
    }else{
        $x2 = explode('.', $file2);
        $nama2=strtolower(current($x2));
        $ekstensi2 = strtolower(end($x2));
        $sampul="admin-sampul.".$ekstensi2;
        $ukuran2 = $_FILES['foto_sampul']['size'];
        $file_tmp2 = $_FILES['foto_sampul']['tmp_name'];        
    }

    if(in_array($ekstensi1, $ekstensi_diperbolehkan) === true&&in_array($ekstensi2, $ekstensi_diperbolehkan) === true){
        if($ukuran1<2097152&&$ukuran2<2097152){ 
          move_uploaded_file($file_tmp1, '../assets/images/users/'.$namaBaru1);
          move_uploaded_file($file_tmp2, '../assets/images/users/'.$sampul);
          $simpan="UPDATE tb_admin SET  userName='$userName', email='$email', kota='$idKota', foto_profil='$namaBaru1', foto_sampul='$sampul'";
          $result=mysql_query($simpan) or die(mysql_error()); 
          if ($result) {                   
            ?>
            <script language="JavaScript">
                alertify.alert("Profil Berhasil DiUbah", function(){ window.location.assign('profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
          }else{
            ?>
            <script language="JavaScript">
                alertify.alert("Profil Gagal DiUbah", function(){ window.location.assign('profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
          }     
        }else{
        ?>
            <script language="JavaScript">
                alertify.alert("File Terlalu Besar", function(){ window.location.assign('profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
        }
    }else{
        ?>
            <script language="JavaScript">
                alertify.alert("File Tidak Didukung", function(){ window.location.assign('profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
    }
}

if (isset($_POST['ubahPass'])) {    
    $pass=$_POST['pass'];
    $simpan="UPDATE tb_admin SET password='$pass' ";
          $result=mysql_query($simpan) or die(mysql_error()); 
          if ($result) {                   
            ?>
            <script language="JavaScript">
                alertify.alert("Profil Berhasil DiUbah", function(){ window.location.assign('profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
          }else{
            ?>
            <script language="JavaScript">
                alertify.alert("Profil Gagal DiUbah", function(){ window.location.assign('profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
          }
}

if (isset($_POST['tambahBank'])) {
    $kdBank=$_POST['kdBank'];
    $nmBank=$_POST['nmBank'];
    $pemilik=$_POST['pemilik'];
    $noRek=$_POST['noRek'];
    $tambahBank=mysql_query("INSERT INTO tb_bank(`id_bank`, `nama_bank`, `nama_pemilik`, `no_rek`) VALUES ('$kdBank','$nmBank','$pemilik','$noRek')");
    if ($tambahBank) {                   
        ?>
        <script language="JavaScript">
            alertify.alert("Data Bank Telah Ditambahkan", function(){ window.location.assign('bank'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script language="JavaScript">
            alertify.alert("Data Bank Gagal Ditambahkan", function(){ window.location.assign('bank'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }
}

if (isset($_POST['hapusBank'])) {
    $kdBank=$_POST['kdBank'];
    $tambahBank=mysql_query("DELETE tb_bank WHERE `id_bank`='$kdBank'");
    if ($tambahBank) {                   
        ?>
        <script language="JavaScript">
            alertify.alert("Data Bank Telah Dihapus", function(){ window.location.assign('bank'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script language="JavaScript">
            alertify.alert("Data Bank Gagal Dihapus", function(){ window.location.assign('bank'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }
}

if (isset($_POST['editBank'])) {
    $kdBank=$_POST['kdBank'];
    $nmBank=$_POST['nmBank'];
    $pemilik=$_POST['pemilik'];
    $noRek=$_POST['noRek'];
    $tambahBank=mysql_query("UPDATE tb_bank SET `id_bank`='$kdBank', `nama_bank`='$nmBank', `nama_pemilik`='$pemilik', `no_rek`='$noRek' WHERE `id_bank`='$kdBank'");
    if ($tambahBank) {                   
        ?>
        <script language="JavaScript">
            alertify.alert("Data Bank Telah DiUbah", function(){ window.location.assign('bank'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script language="JavaScript">
            alertify.alert("Data Bank Gagal DiUbah", function(){ window.location.assign('bank'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }
}
?>
</body>
</html>