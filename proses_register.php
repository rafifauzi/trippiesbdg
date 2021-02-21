<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/css/alertify.min.css" type='text/css' />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="assets/js/alertify.min.js"></script>
	<title></title>
</head>
<body>

<?php
include "database/koneksi.php";
if (isset($_POST['register'])) {
	$nama=$_POST['firstName'].' '.$_POST['lastName'];
	$gender=$_POST['gender'];
	$birthday=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
	$alamat=$_POST['place'];
	$kecamatan=$_POST['kecamatan'];
	$nmKota=$_POST['nmKota']
	$kodepos=$_POST['kodepos'];
	$no_hp=$_POST['no_hp'];
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];

	$cekAkun=mysql_num_rows(mysql_query("SELECT id_user FROM tb_user WHERE email='$email'"));
	if ($cekAkun>0) {
		echo "<script>alertify.alert('Akun Anda Sudah Terdaftar, Silahkan Login', function(){ 
		window.location.assign('register.php') }).set({transition:'zoom'}).set('closable',false).setHeader('Peringatan').show();</script>";
	}else{
        $rowKeranjang=mysql_num_rows(mysql_query("SELECT id_keranjang FROM tb_keranjang"))+1;
		$row=mysql_num_rows(mysql_query("SELECT id_user FROM tb_user"))+1;		
		$tgl=date('d');
	    $bln=date('m');
	    $thn=date('Y');
	    $id="S"."".$tgl."".$bln."".$thn."".$row;
	    $id_keranjang="K"."".$tgl."".$bln."".$thn."".$rowKeranjang;
		$insert=mysql_query("INSERT INTO tb_user SET id_user='$id', nama='$nama', birthday='$birthday', jk='$gender', alamat='$alamat', kota='$kecamatan', kodepos='$kodepos', no_hp='$no_hp', username='$username',password='$password',email='$email', foto_profil='blank_dp.jpg', foto_sampul='blank_sampul.jpg'") or die(mysql_error());

		$cekKota=mysql_num_rows(mysql_query("SELECT id_kota FROM tb_kota WHERE id_kota='$kecamatan'"));
		if ($cekKota>0) {
			$delKota=mysql_query("DELETE FROM tb_kota WHERE id_kota='$kecamatan'") or die(mysql_error());
			$insertKota=mysql_query("INSERT INTO tb_kota SET id_kota='$kecamatan', nama_kota='$nmKota'") or die(mysql_error());
		}else{
			$insertKota=mysql_query("INSERT INTO tb_kota SET id_kota='$kecamatan', nama_kota='$nmKota'") or die(mysql_error());
		}


		$keranjang=mysql_query("INSERT INTO tb_keranjang SET id_keranjang='$id_keranjang', id_user='$id', total='0'") or die(mysql_error());
		if ($insert&&$keranjang&&$insertKota) {?>
			<script language="JavaScript">
              alertify.alert("Anda Sudah Terdaftar, Silahkan Login", function(){ window.location.assign('login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
          	</script>
		<?php
		}else{ ?>
			<script language="JavaScript">
              alertify.alert("Register Gagal, Silahkan Coba Lagi", function(){ window.location.assign('register'); }).setHeader(' ').set({closable:false,transition:'pulse'});
          	</script>
		<?php
		}
	}
}
?>


</body>
</html>