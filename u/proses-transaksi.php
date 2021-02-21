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
include "../database/koneksi.php";
	session_start();
	if (isset($_POST['unggah'])) {
		$noInvoice=$_POST['noInv'];
		$tglBayar=date('Y-m-d');
		$ekstensi_diperbolehkan	= array('png','jpg');
		$nama = $_FILES['buktitrf']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		$namaBaru=$noInvoice."-buktitrf.".$ekstensi;
		$ukuran	= $_FILES['buktitrf']['size'];
		$file_tmp = $_FILES['buktitrf']['tmp_name'];
 
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, '../assets/images/t/'.$namaBaru);
				$query = mysql_query("UPDATE tb_transaksi SET bukti_trf='$namaBaru', tgl_bayar='$tglBayar', status='1' WHERE no_invoice='$noInvoice'");
				if($query){
					echo "<script>window.location.assign('list-transaksi-barang')</script>";
				}else{
					echo 'GAGAL MENGUPLOAD GAMBAR';
				}
			}else{
				echo 'UKURAN FILE TERLALU BESAR';
			}
		}else{
			echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
		}
	}
	if (isset($_POST['bayar'])) {
		$id_user=$_SESSION['id_user'];
		$id_barang=$_POST['id_barang'];
		$id_keranjang=$_POST['id_keranjang'];
		$nama_barang=$_POST['nama_barang'];
		$tgl_order=date('Y-m-d');
		$qty=$_POST['qty'];
		$harga=$_POST['harga'];
		$sub_harga=$_POST['sub_harga'];
		$ongkir=$_POST['ongkir'];
		$totBayar=$_POST['totBayar'];
		$bank=$_POST['bank'];
		$ceki=0;
		$cekj=0;

		$date=date('dmY');
	    $sql1=mysql_query("SELECT no_invoice FROM tb_transaksi WHERE SUBSTR(no_invoice,4,8)='$date'") or die(mysql_error());
	    $cek=mysql_num_rows($sql1);
	    $urutan=$cek+1;
	    if ($cek>=0) {
	        $id="INV".$date."".$urutan;
	    }   	
	    $insert=mysql_query("INSERT INTO tb_transaksi SET no_invoice='$id', id_user='$id_user', tgl_order='$tgl_order', tgl_bayar='' , tgl_kirim='', `sub_total`='$sub_harga', ongkir='$ongkir', total='$totBayar', id_bank='$bank', bukti_trf='#', no_resi='#', `status`='0', keterangan='-'") or die(mysql_error()); $cekj++;
	   	
	   	$count=count($qty);
    	for ($i=0; $i<$count ; $i++) {
	    	$insert=mysql_query("INSERT INTO `tb_detail-transaksi` SET no_invoice='$id', id_barang='$id_barang[$i]', qty='$qty[$i]' ") or die(mysql_error());
	    	$delKeranjang=mysql_query("DELETE FROM `tb_detail-keranjang` WHERE `id_barang`='$id_barang[$i]' AND `id_keranjang`='$id_keranjang'") or die(mysql_error());
	    	$ceki++;
   		}
		if ($insert&&$cekj>0&&$ceki>0) {
			echo "<script>window.location.assign('invoice?n=".$id."')</script>";
		}else{
			echo "<script>window.location.assign('list-transaksi-barang')</script>";
		}
	}


	if (isset($_POST['kirim'])) {
		$noInvoice=$_POST['noInvoice'];
		$noResi=$_POST['noResi'];
		$kirim=mysql_query("UPDATE tb_transaksi SET no_resi='$noResi', status='3' WHERE no_invoice='$noInvoice'");
		if ($kirim) {
			echo "<script>window.location.assign('detail-invoice?n=".$noInvoice."')</script>";
		}else{
			echo "<script>window.location.assign('detail-invoice?n=".$noInvoice."')</script>";
		}
	}

	if (isset($_POST['sampai'])) {
		$noInvoice=$_POST['noInvoice'];
		$sampai=mysql_query("UPDATE tb_transaksi SET status='4' WHERE no_invoice='$noInvoice'");
		if ($sampai) {?>
            <script type="text/javascript">
                alertify.alert("Terima Kasih", function(){ window.location.assign('list-transaksi-barang?st=4'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
          <?php
		}else{
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
?>
</body>
</html>