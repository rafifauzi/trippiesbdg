<?php
include "../database/koneksi.php";
	session_start();
	if (isset($_POST['konfirmasi'])) {
		$noInvoice=$_POST['noInvoice'];
		$query = mysql_query("UPDATE tb_transaksi SET status='2' WHERE no_invoice='$noInvoice'");
		if($query){
			echo "<script>window.location.assign('list-transaksi-barang')</script>";
		}
	}
	if (isset($_POST['batal'])) {
		$noInvoice=$_POST['noInvoice'];
		$keterangan=$_POST['keterangan'];
		$query = mysql_query("UPDATE tb_transaksi SET status='5', keterangan='$keterangan' WHERE no_invoice='$noInvoice'");
		$stok=mysql_query("SELECT qty,id_barang FROM `tb_detail-transaksi` WHERE no_invoice='$noInvoice'");
		$no=0;
		while ($rStok=mysql_fetch_array($stok)) {
			$stokbr=$rStok['qty'];
			$idBarang=$rStok['id_barang'];
			$upBarang=mysql_query("UPDATE tb_barang SET stok=stok+'$stokbr' WHERE id_barang='$idBarang'");
		$no++;
		}
		if($query&&$no>0){
			echo "<script>window.location.assign('list-transaksi-barang')</script>";
		}
	}
	if (isset($_POST['kirimResi'])) {
		$noInvoice=$_POST['noInvoice'];
		$noResi=$_POST['noResi'];
		$kirim=mysql_query("UPDATE tb_transaksi SET no_resi='$noResi', status='3' WHERE no_invoice='$noInvoice'");
		if ($kirim) {
			echo "<script>window.location.assign('list-transaksi-barang')</script>";
		}else{
			echo "<script>window.location.assign('list-transaksi-barang')</script>";
		}
	}
?>