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
session_start();
$idUser=$_SESSION['id_user'];   
if (isset($_POST['update'])) {   
    $qProfil=mysql_query("SELECT foto_profil, foto_sampul FROM tb_user WHERE id_user='$idUser' ") or die(mysql_error());
    $rProfil=mysql_fetch_array($qProfil);
    $nama=$_POST['nama'];
    $tglLahir=$_POST['tgllahir'];
    $jk=$_POST['jk'];
    $email=$_POST['email'];
    $noHp=$_POST['noHp'];
    $kecamatan=$_POST['kecamatan'];
    $kodepos=$_POST['kodePos'];
    $alamat=$_POST['alamat'];
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
        $namaBaru1=$idUser."-fp.".$ekstensi1;
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
        $sampul=$idUser."-sampul.".$ekstensi2;
        $ukuran2 = $_FILES['foto_sampul']['size'];
        $file_tmp2 = $_FILES['foto_sampul']['tmp_name'];        
    }

    if(in_array($ekstensi1, $ekstensi_diperbolehkan) === true&&in_array($ekstensi2, $ekstensi_diperbolehkan) === true){
        if($ukuran1<2097152&&$ukuran2<2097152){ 
          move_uploaded_file($file_tmp1, '../assets/images/users/'.$namaBaru1);
          move_uploaded_file($file_tmp2, '../assets/images/users/'.$sampul);
          $simpan="UPDATE tb_user SET nama='$nama', birthday='$tglLahir', jk='$jk', alamat='$alamat', kota='$idKota', kodepos='$kodepos', no_hp='$noHp', foto_profil='$namaBaru1', foto_sampul='$sampul' WHERE id_user='$idUser'";
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
?>
</body>
</html>