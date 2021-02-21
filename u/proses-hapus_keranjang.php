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
include ("../database/koneksi.php");
	$id_barang=$_GET['ib'];
	$id_keranjang=$_GET['ik'];
	$qty=$_GET['q'];
	$query="DELETE FROM `tb_detail-keranjang` WHERE id_barang='$id_barang' AND id_keranjang='$id_keranjang'";
	
	$a=mysql_query($query);
	if ($a) {
		$query=mysql_query("UPDATE tb_barang SET stok=stok+$qty WHERE id_barang='$id_barang' ");
		?>
			<script language="JavaScript">
			alertify.alert("Barang Keranjang Dihapus", function(){ window.location.assign('keranjang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
			</script>
		<?PHP
	}
	else{
		?>
			<script language="JavaScript">
			alertify.alert("Barang Keranjang Gagal Dihapus", function(){ window.location.assign('keranjang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
			</script>
		<?PHP
	}
?>

</body>
</html>