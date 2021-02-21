<!DOCTYPE html>
<html>
<head>
	<title>Pembukuan</title>
</head>
<body>
    <form method="POST">
                <div class="col-lg-7 form-inline">
                    Tampilkan Dari Tanggal 
                    <input type="date" name="tglAwal" class="form-control">
                    Sampai
                    <input type="date" name="tglAkhir" class="form-control">
                    <button type="submit" name="tampil" class="btn btn-dark waves-effect waves-light text-xs-center">Tampilkan</button>
                </div>
    </form>
    <?php
        if (isset($_POST['tampil'])) {
           $tglAwal=$_POST['tglAwal'];
           $tglAkhir=$_POST['tglAkhir'];

           echo $tglAwal;
           echo $tglAkhir;
    
    ?>
    <h4>Barang Admin (Pendapatan)</h4>
	<table border="2">
		<thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Ongkir</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>SubTotal</th>
                <th>Admin (2%)</th>
                <th>Total</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>

        <tbody>
            <?php
            	include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_barang`.`pemilik`='$pemilik' AND `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                while ($r=mysql_fetch_array($q)) { 
                   	$sub_total = ($r['harga_beli']) * ($r['qty']);
                    $admin = ($r['harga_beli']) * 0.02;
                    $admin_untung = ($r['qty']) * $admin;

                    if ($r['status']==4) {
            ?>
        	            <tr>
        	                <th><?=$r['no_invoice']?></th>
        	                <th><?=$r['nama_barang']?></th>
        	                <th><?=$r['qty']?></th>
                            <th><?=$r['ongkir']?></th>
        	                <th><?=$r['harga_beli']?></th>
        	                <th><?=$r['harga_jual']?></th>
        	                <th><?=$sub_total?></th>
        	                <th><?=$admin_untung?></th>
                            <th><?=$r['total']?></th>
        	                <th><?=$r['tgl_bayar']?></th>
        	            </tr>
        	<?php
                	}
                    else{
                    $admin_untung = 0;
                   }
                    $jumlah = $jumlah + $admin_untung;
                }
        	?>
        </tbody>
	</table>
    <?php
        echo "total keuntungan admin :".$jumlah;
    ?>
    <br>

        <h4>Barang Admin (Pengeluaran)</h4>
    <table border="2">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Ongkir</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>SubTotal</th>
                <th>Admin (2%)</th>
                <th>Total</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>

        <tbody>
            <?php
                include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_barang`.`pemilik`='$pemilik' AND `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                while ($r=mysql_fetch_array($q)) { 
                    $sub_total = ($r['harga_beli']) * ($r['qty']);
                    $admin = ($r['harga_beli']) * 0.02;
                    $admin_untung = ($r['qty']) * $admin;
                    $total = $sub_total + $admin_untung + $r['ongkir'];

                    if ($r['status']==5) {
            ?>
                        <tr>
                            <th><?=$r['no_invoice']?></th>
                            <th><?=$r['nama_barang']?></th>
                            <th><?=$r['qty']?></th>
                            <th><?=$r['ongkir']?></th>
                            <th><?=$r['harga_beli']?></th>
                            <th><?=$r['harga_jual']?></th>
                            <th><?=$sub_total?></th>
                            <th><?=$admin_untung?></th>
                            <th><?=$r['total']?></th>
                            <th><?=$r['tgl_bayar']?></th>
                        </tr>
            <?php
                    }
                    else{
                    $total = 0;
                   }
                    $gagal = $gagal + $total;
                }
            ?>
        </tbody>
    </table>
    <?php
        echo "total pengeluaran ke pelanggan (gagal) :".$gagal;
    ?>
    <br>
    
    <h4>Barang Tripper (Pendapatan)</h4>
	<table border="2">
		<thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Ongkir</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Sub Total</th>
                <th>Admin (2%)</th>
                <th>Total</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>

        <tbody>
            <?php
            	include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_barang`.`pemilik`!='$pemilik' AND `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 
                    $sub_total = ($r['harga_beli']) * ($r['qty']);
                    $admin = ($r['harga_beli']) * 0.02;
                    $admin_untung = ($r['qty']) * $admin;
                
                    if ($r['status']==4) {
            ?>
        	            <tr>
        	                <th><?=$r['no_invoice']?></th>
        	                <th><?=$r['nama_barang']?></th>
        	                <th><?=$r['qty']?></th>
                            <th><?=$r['ongkir']?></th>
        	                <th><?=$r['harga_beli']?></th>
        	                <th><?=$r['harga_jual']?></th>
        	                <th><?=$sub_total?></th>
        	                <th><?=$admin_untung?></th>
                            <th><?=$r['total']?></th>
        	                <th><?=$r['tgl_bayar']?></th>
        	            </tr>
        	<?php
            	   }
                   else{
                    $admin_untung = 0;
                   }
                    $jumlah1 = $jumlah1 + $admin_untung;
                }
        	?>
        </tbody>
	</table>
    <?php
        echo "total keuntungan admin :".$jumlah1;
    ?>
    <br>

    <h4>Barang Tripper (Pengeluaran (Berhasil))</h4>
    <table border="2">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Ongkir</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Sub Total</th>
                <th>Admin (2%)</th>
                <th>Total</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>

        <tbody>
            <?php
                include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_barang`.`pemilik`!='$pemilik' AND `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 
                    $sub_total = ($r['harga_beli']) * ($r['qty']);
                    $admin = ($r['harga_beli']) * 0.02;
                    $admin_untung = ($r['qty']) * $admin;
                    $total1 = $sub_total + $r['ongkir'];
                
                    if ($r['status']==4) {
            ?>
                        <tr>
                            <th><?=$r['no_invoice']?></th>
                            <th><?=$r['nama_barang']?></th>
                            <th><?=$r['qty']?></th>
                            <th><?=$r['ongkir']?></th>
                            <th><?=$r['harga_beli']?></th>
                            <th><?=$r['harga_jual']?></th>
                            <th><?=$sub_total?></th>
                            <th><?=$admin_untung?></th>
                            <th><?=$r['total']?></th>
                            <th><?=$r['tgl_bayar']?></th>
                        </tr>
            <?php
                   }
                   else{
                    $total1 = 0;
                   }
                    $gagal1 = $gagal1 + $total1;
                }
            ?>
        </tbody>
    </table>
    <?php
        echo "total pengeluaran ke tripper (berhasil) :".$gagal1;
    ?>
    <br>

        <h4>Barang Tripper (Pengeluaran (Gagal))</h4>
    <table border="2">
        <thead>
            <tr>
                <th>No Invoice</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Ongkir</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Sub Total</th>
                <th>Admin (2%)</th>
                <th>Total</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>

        <tbody>
            <?php
                include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE `tb_barang`.`pemilik`!='$pemilik' AND `tb_transaksi`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_transaksi`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 
                    $sub_total = ($r['harga_beli']) * ($r['qty']);
                    $admin = ($r['harga_beli']) * 0.02;
                    $admin_untung = ($r['qty']) * $admin;
                    $total2 = $sub_total + $admin_untung + $r['ongkir'];
                
                    if ($r['status']==5) {
            ?>
                        <tr>
                            <th><?=$r['no_invoice']?></th>
                            <th><?=$r['nama_barang']?></th>
                            <th><?=$r['qty']?></th>
                            <th><?=$r['ongkir']?></th>
                            <th><?=$r['harga_beli']?></th>
                            <th><?=$r['harga_jual']?></th>
                            <th><?=$sub_total?></th>
                            <th><?=$admin_untung?></th>
                            <th><?=$r['total']?></th>
                            <th><?=$r['tgl_bayar']?></th>
                        </tr>
            <?php
                   }
                   else{
                    $total2 = 0;
                   }
                    $gagal2 = $gagal2 + $total2;
                }
            ?>
        </tbody>
    </table>
    <?php
        echo "total pengeluaran ke pembeli (gagal) :".$gagal2;
    ?>
    <br>

    <h4>Opentrip (Pendapatan)</h4>
	<table border="2">
		<thead>
            <tr>
                <th>Id Trip</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Admin (2%)</th>
                <th>Tanggal Berangkat</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>

        <tbody>
            <?php
            	include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_booking` JOIN tb_opentrip ON `tb_booking`.`id_trip`=`tb_opentrip`.`id_trip` WHERE `tb_booking`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_booking`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 

                    $admin = ($r['harga']) * 0.02;
                
                    if ($r['status']==2) {
            ?>
    	            <tr>
    	                <th><?=$r['id_booking']?></th>
    	                <th><?=$r['nama_paket']?></th>
    	                <th><?=$r['harga']?></th>
    	                <th><?=$admin?></th>
    	                <th><?=$r['periodeAkhir']?></th>
                        <th><?=$r['tgl_bayar']?></th>
    	            </tr>
        	<?php
            	   }
                   else{
                    $admin = 0;
                   }
                $jumlah2 = $jumlah2 + $admin;
                }
        	?>
        </tbody>
	</table>
    <?php
        echo "total keuntungan admin :".$jumlah2;
    ?>
    <br>
    <br>

    <h4>Opentrip (gagal)</h4>
    <table border="2">
        <thead>
            <tr>
                <th>Id Trip</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Admin (2%)</th>
                <th>Tanggal Berangkat</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>

        <tbody>
            <?php
                include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_booking` JOIN tb_opentrip ON `tb_booking`.`id_trip`=`tb_opentrip`.`id_trip` WHERE `tb_booking`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_booking`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 

                    $admin = ($r['harga']) * 0.02;
                    $total3 = $total3 + $r['harga'];
                
                    if ($r['status']==3) {
            ?>
                    <tr>
                        <th><?=$r['id_booking']?></th>
                        <th><?=$r['nama_paket']?></th>
                        <th><?=$r['harga']?></th>
                        <th><?=$admin?></th>
                        <th><?=$r['periodeAkhir']?></th>
                        <th><?=$r['tgl_bayar']?></th>
                    </tr>
            <?php
                   }
                   else{
                    $total3 = 0;
                   }
                $gagal4 = $gagal4 + $total3;
                }
            ?>
        </tbody>
    </table>
    <?php
        echo "total pengeluaran ke pelanggan (gagal) :".$gagal4;
    ?>
    <br>
    <br>

       <h4>Iklan</h4>
    <table border="2">
        <thead>
            <tr>
                <th>No Iklan</th>
                <th>Nama Iklan</th>
                <th>Harga</th>
                <th>Admin (2%)</th>
                <th>Lama Pasang</th>
                <th>Tanggal Pasang</th>
                <th>Tanggal Habis</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
                include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_ngiklan` JOIN `tb_detail-ngiklan` ON `tb_ngiklan`.`no_iklan`=`tb_detail-ngiklan`.`no_iklan` JOIN tb_iklan ON `tb_detail-ngiklan`.`id_iklan`=`tb_iklan`.`id_iklan` WHERE `tb_ngiklan`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_ngiklan`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 

                    $admin = ($r['harga']) * 0.02;
                
                    if ($r['status']==3) {
            ?>
                    <tr>
                        <th><?=$r['no_iklan']?></th>
                        <th><?=$r['nama_iklan']?></th>
                        <th><?=$r['harga']?></th>
                        <th><?=$admin?></th>
                        <th><?=$r['lama_pasang']."hari"?></th>
                        <th><?=$r['tgl_pasang']?></th>
                        <th><?=$r['tgl_habis']?></th>
                        <th><?=$r['tgl_transaksi']?></th>
                    </tr>
            <?php
                   }
                   else{
                    $admin = 0;
                   }
                $jumlah3 = $jumlah3 + $admin;
                }
            ?>
        </tbody>
    </table>
    <?php
        echo "total keuntungan admin :".$jumlah3;
    ?>
    <br>
    <br>

    <h4>Iklan (Gagal)</h4>
    <table border="2">
        <thead>
            <tr>
                <th>No Iklan</th>
                <th>Nama Iklan</th>
                <th>Harga</th>
                <th>Admin (2%)</th>
                <th>Lama Pasang</th>
                <th>Tanggal Pasang</th>
                <th>Tanggal Habis</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
                include '../database/koneksi.php';  
                $pemilik="admin";
                $q=mysql_query("SELECT * FROM `tb_ngiklan` JOIN `tb_detail-ngiklan` ON `tb_ngiklan`.`no_iklan`=`tb_detail-ngiklan`.`no_iklan` JOIN tb_iklan ON `tb_detail-ngiklan`.`id_iklan`=`tb_iklan`.`id_iklan` WHERE `tb_ngiklan`.`tgl_bayar` BETWEEN '$tglAwal' AND '$tglAkhir' ORDER BY `tb_ngiklan`.`tgl_bayar`");

                
                while ($r=mysql_fetch_array($q)) { 

                    $admin = ($r['harga']) * 0.02;
                    $total4 = $total4 + $r['harga'];
                    if ($r['status']==4) {
            ?>
                    <tr>
                        <th><?=$r['no_iklan']?></th>
                        <th><?=$r['nama_iklan']?></th>
                        <th><?=$r['harga']?></th>
                        <th><?=$admin?></th>
                        <th><?=$r['lama_pasang']."hari"?></th>
                        <th><?=$r['tgl_pasang']?></th>
                        <th><?=$r['tgl_habis']?></th>
                        <th><?=$r['tgl_transaksi']?></th>
                    </tr>
            <?php
                   }
                   else{
                    $total4 = 0;
                   }
                $gagal5 = $gagal5 + $total4;
                }
            ?>
        </tbody>
    </table>
    <?php
        echo "total pengeluaran ke pelanggan (gagal) :".$gagal5;
    ?>
    <br>
    <br>
    
    <?php
        $jumlah_total = $jumlah + $jumlah1 + $jumlah2 + $jumlah3;
        echo "total keuntungan total admin :".$jumlah_total;

        $keluar_total = $gagal + $gagal1 + $gagal2 + $gagal4 + $gagal5;
        echo " total pengeluaran admin :".$keluar_total;
    ?>
<?php
}
?>
</body>
</html>