<?php
include ("../database/koneksi.php");
	$id_barang=$_GET['ib'];
	$qty=$_GET['q'];
	$query="DELETE FROM `tb_detail-keranjang` WHERE id_barang='$id_barang' AND id_keranjang='$id_keranjang'";
	
	$a=mysql_query($query);
	if ($a) {
		$query=mysql_query("UPDATE tb_barang SET stok=stok+$qty WHERE id_barang='$id_barang' ");
		?>
			<script language="JavaScript">
			alert('Produk berhasil di hapus');
			document.location='keranjang.php';
			</script>
		<?PHP
	}
	else{
		echo "Gagal";
	}
?>