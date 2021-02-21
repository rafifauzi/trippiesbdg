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
$q=mysql_query("SELECT id_barang FROM tb_barang") or die(mysql_error());
$row=mysql_num_rows($q)+1;
$tgl=date('d');
$bln=date('m');
$thn=date('Y');
$id="BR"."".$tgl."".$bln."".$thn."".$row;
if (isset($_POST['pasarkan'])) {
	$nmBarang=$_POST['nmBarang'];
	$kBarang=$_POST['kBarang'];
	$hgBeli=str_replace(',00','',str_replace('.','',$_POST['hgBeli']));
	$hgJual=($hgBeli*0.02)+$hgBeli;
	$brtBarang=$_POST['brtBarang'];
	$qty=$_POST['stok'];
	$kondisi=$_POST['kondisi'];
	$deskripsi=$_POST['deskripsi'];
    $date=date('Y-m-d');
	$ekstensi_diperbolehkan = array('jpg','jpeg','bmp','png');

	//gambar1
    $file1 = $_FILES['gambar1']['name'];
    if ($file1==null) {
        $namaBaru1='blank.jpg';
        $ukuran1=100;
        $ekstensi1='jpg';
    }else{        
        $x1 = explode('.', $file1);
        $nama1=strtolower(current($x1));
        $ekstensi1 = strtolower(end($x1));
        $namaBaru1=$id."-1.".$ekstensi1;
        $ukuran1 = $_FILES['gambar1']['size'];
        $file_tmp1 = $_FILES['gambar1']['tmp_name'];
    }

    //gambar2
    $file2 = $_FILES['gambar2']['name'];
    if ($file2==null) {
        $namaBaru2='blank.jpg';
        $ukuran2=100;
        $ekstensi2='jpg';
    }else{        
        $x2 = explode('.', $file2);
        $nama2=strtolower(current($x2));
        $ekstensi2 = strtolower(end($x2));
        $namaBaru2=$id."-2.".$ekstensi2;
        $ukuran2 = $_FILES['gambar2']['size'];
        $file_tmp2 = $_FILES['gambar2']['tmp_name'];
    }

    //gambar3
    $file3 = $_FILES['gambar3']['name'];
    if ($file3==null) {
        $namaBaru3='blank.jpg';
        $ukuran3=100;
        $ekstensi3='jpg';
    }else{        
        $x3 = explode('.', $file3);
        $nama3=strtolower(current($x3));
        $ekstensi3 = strtolower(end($x3));
        $namaBaru3=$id."-3.".$ekstensi3;
        $ukuran3 = $_FILES['gambar3']['size'];
        $file_tmp3 = $_FILES['gambar3']['tmp_name'];
    }

    //gambar4
    $file4 = $_FILES['gambar4']['name'];
    if ($file4==null) {
        $namaBaru4='blank.jpg';
        $ukuran4=100;
        $ekstensi4='jpg';
    }else{        
        $x4 = explode('.', $file4);
        $nama4=strtolower(current($x4));
        $ekstensi4 = strtolower(end($x4));
        $namaBaru4=$id."-4.".$ekstensi4;
        $ukuran4 = $_FILES['gambar4']['size'];
        $file_tmp4 = $_FILES['gambar4']['tmp_name'];
    }

    if(in_array($ekstensi1, $ekstensi_diperbolehkan) === true&&in_array($ekstensi2, $ekstensi_diperbolehkan) === true&&in_array($ekstensi3, $ekstensi_diperbolehkan) === true&&in_array($ekstensi4, $ekstensi_diperbolehkan) === true){
	    if($ukuran1<=2097152&&$ukuran2<=2097152&&$ukuran3<2097152&&$ukuran4<=2097152){      
	      move_uploaded_file($file_tmp1, '../assets/images/b/'.$namaBaru1);
	      move_uploaded_file($file_tmp2, '../assets/images/b/'.$namaBaru2);
	      move_uploaded_file($file_tmp3, '../assets/images/b/'.$namaBaru3);
	      move_uploaded_file($file_tmp4, '../assets/images/b/'.$namaBaru4);
	      $simpan=mysql_query("INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `stok`, `berat`, `harga_beli`, `harga_jual`, `kondisi`, `dilihat`, `gambar1`, `gambar2`, `gambar3`, `gambar4`, `deskripsi`, `tgl_upload`, `id_kategori`, `pemilik`) VALUES ('$id', '$nmBarang', '$qty', '$brtBarang', '$hgBeli', '$hgJual', '$kondisi', '0', '$namaBaru1', '$namaBaru2', '$namaBaru3', '$namaBaru4', '$deskripsi', '$date', '$kBarang', '$idUser');");
          $update=mysql_query("UPDATE tb_user SET jual='1' WHERE id_user='$idUser'");
	      if ($simpan&&$update) { ?>
	      	<script type="text/javascript">
            alertify.alert("Barang Telah Ditambahkan", function(){ window.location.assign('list-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
	      <?php
	      }else{
	    	echo "Gagal Menyimpan";
	      }     
	    }else{
    	echo "File Terlalu Besar";
    	}
    }else{
    	echo "File Tidak Didukung";
    }
}
?>

</body>
</html>