<?php 
include '../database/koneksi.php';
function tanggal($a){
    $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    $tgl=date('d', strtotime($a))." ". $bulan[date('m', strtotime($a))]." ".date('Y', strtotime($a));
    return $tgl;
}
function rupiah($x){
    $rp="Rp ".str_replace(",", ".",number_format($x));
    return $rp;
}
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $jenisId=substr($id, 0,2);
        $sql = "SELECT `tb_transaksi`.`no_invoice`, `tgl_order`, `bukti_trf`, `no_resi`,`tgl_bayar`, `tgl_kirim`, `nama`, `total`, `status`, `keterangan`, `tb_transaksi`.`id_user` FROM `tb_transaksi` JOIN `tb_user` ON `tb_transaksi`.`id_user`=`tb_user`.`id_user` WHERE no_invoice = '$id'";
        $result = mysql_query($sql) or die(mysql_error());
        $hasil=mysql_fetch_array($result);
        $qPenjual=mysql_fetch_array(mysql_query("SELECT DISTINCT pemilik FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN `tb_barang` ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE  `tb_transaksi`.`no_invoice`='$id'"));
        $rPenjual=$qPenjual['pemilik'];
        $nm=mysql_fetch_array(mysql_query("SELECT nama FROM tb_user WHERE id_user='$rPenjual'"));
        if ($rPenjual!='Admin') {
            $penjual=$nm['nama'];
        }else{
            $penjual=$rPenjual;
        }
        if ($hasil['status']=='2'||$hasil['status']=='1') {
            $bayar='style="display:block"';
            $kirim='style="display:none"';
        }else if ($hasil['status']=='3') {
            $bayar='style="display:none"';
            $kirim='style="display:block"';
        }else if ($hasil['status']=='4') {
            $bayar='style="display:block"';
            $kirim='style="display:block"';
        }else{
            $kirim='style="display:none"';
            $bayar='style="display:none"';
        }
        ?>
        <form method="POST" action="proses-transaksi">
            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        <?=$jenisId;?>
                        <label>No Invoice</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=$id;?>">
                    </div> 
                    <div class="form-group">
                        <label>Penjual</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=$penjual;?>">
                    </div> 
                    <div class="form-group" <?=$bayar;?>>
                        <label>Tanggal Pembayaran</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=tanggal($hasil['tgl_bayar']);?>">
                    </div>     
                    <div class="form-group" <?=$kirim;?>>
                        <label>Tanggal Kirim</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=tanggal($hasil['tgl_kirim']);?>">
                    </div> 
                </div>
                <div class="col-sm-6 col-lg-6">                    
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=tanggal($hasil['tgl_order']);?>">
                    </div>
                    <div class="form-group">
                        <label>Pembeli</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=$hasil['nama'];?>">
                    </div> 
                    <div class="form-group" <?=$bayar;?>>
                        <label>Bukti Pembayaran</label>
                        <a href="#buktiTrf" data-toggle="modal" data-id="<?=$hasil['no_invoice'];?>"><button class="form-control btn btn-primary waves-effect waves-light" onclick="$('#dtTrx').hide();">Klik Untuk Melihat Bukti Pembayaran</button></a>
                    </div> 
                    <div class="form-group" <?=$kirim;?>>
                        <label>No Resi</label>
                        <input type="text" name="no_invoice" class="form-control" value="<?=$hasil['no_resi'];?>">
                    </div>
                </div>
            </div><hr>
            <h5>Total : <?=rupiah($hasil['total']);?></h5>
        </form>
        <?php
    }
    $koneksi->close();
?>