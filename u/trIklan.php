<?php 
include '../database/koneksi.php';
if($_POST['rowid']) {
        function rupiah($angka){    
            $hasil_rupiah = "Rp " . number_format($angka);
            return str_replace(',', '.', $hasil_rupiah);     
        }
        $id = $_POST['rowid'];
        $q=mysql_query("SELECT * FROM tb_iklan WHERE id_iklan='$id'");
        $hasil=mysql_fetch_array($q);
        
        ?>
        <form method="POST" name="iklan" action="proses-iklan.php">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Id Iklan</label>
                        <input type="text" name="idIklan" class="form-control" value="<?=$hasil['id_iklan'];?>" readonly>
                        <input type="hidden" name="idUser" class="form-control" value="<?=$idUser;?>" readonly>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Jenis Iklan</label>
                        <input type="text" name="namaIklan" class="form-control" value="<?=$hasil['nama_iklan'];?>" readonly>
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Resolusi Iklan (px)</label>
                        <input type="text" name="ukuranIklan" class="form-control" value="<?=$hasil['ukuran'];?>" readonly>
                    </div> 
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Ukuran Iklan (MB)</label>
                        <input type="text" name="sizeIklan" class="form-control" value="<?=$hasil['size'];?> MB" readonly>
                    </div>                     
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Awal Pasang Iklan</label>
                        <input type="date" name="awalIklan" id="tglAwal" class="form-control" required>
                    </div>                     
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Akhir Pasang Iklan</label>
                        <input type="date" name="akhirIklan" id="tglAkhir" class="form-control" required>
                    </div>                     
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Harga / Hari</label>
                        <input type="text" name="hargaIklan" id="hargaIklan" class="form-control" value="<?=rupiah($hasil['harga']);?>" readonly>
                    </div> 
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Total Bayar Selama <span id='totDurasi'></span></label>
                        <input type="text" name="totHarga" class="form-control" id='txttotHarga' readonly>
                        <input type="hidden" name="durasi" class="form-control" id='durasi'>
                    </div> 
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="button" class="form-control btn btn-dark waves-effect waves-light" onclick="hitungIklan()">Hitung</button>
                    </div> 
                </div>
            </div>
            <center>
                <button type="submit" class="form-control btn btn-info waves-effect waves-light" name="pasangIklan" id="pasangIklan" style="pointer-events: none;" <?=$panggil;?>>Pasang Iklan</button>
            </center>
        </form>
        <?php
    }
?>
