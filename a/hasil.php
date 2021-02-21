<?php 
include '../database/koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM tb_barang WHERE id_barang = '$id'";
        $result = mysql_query($sql);
        while ($hasil=mysql_fetch_array($result)) { ?>
        <form method="POST" name="edit" action="proses-store.php" enctype="multipart/form-data">
        	<div class="form-group" style="display: none;">
                <label for="field-1" class="control-label">ID</label>
                <input type="text" class="form-control" id="field-1" name="idBarang" value="<?=$hasil['id_barang'];?>">
            </div>
        	<div class="form-group">
                <label for="field-1" class="control-label">Nama Barang</label>
                <input type="text" class="form-control" id="field-1" name="nmBarang" value="<?=$hasil['nama_barang'];?>">
            </div>
            <div class="form-group">
                <label for="field-1" class="control-label">Stok (buah)</label>
                <input type="number" class="form-control" id="field-1" name="stok" value="<?=$hasil['stok'];?>">
            </div>
            <div class="form-group">
                <label for="field-1" class="control-label">Berat (gram)</label>
                <input type="number" class="form-control" id="field-1" name="brtBarang" value="<?=$hasil['berat'];?>">
            </div>
            <div class="form-group">
                <label for="field-1" class="control-label">Harga Beli</label>
                <input type="text" class="form-control" id="field-1" name="hgBeli" value="<?="Rp ".number_format($hasil['harga_beli']);?>">
            </div>
            <div class="form-group">
                <label for="field-1" class="control-label">Kondisi</label>
                <select class="form-control" id="exampleSelect1" name="kondisi">
                    <option value="1" <?php if ($hasil['kondisi']==1) {echo "selected";}?>> Baru </option>
                    <option value="0" <?php if ($hasil['kondisi']==0) {echo "selected";}?>> Bekas </option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Deskripsi Barang</label> 
                <textarea name="deskripsi" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;"><?=$hasil['deskripsi']?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Kategori</label>
                <select class="form-control" id="exampleSelect1" name="kBarang">
                <option selected disabled>Kategori</option>
                    <?php 
                        $q=mysql_query("SELECT * FROM tb_kategori") or die(mysql_error());
                        while ($r=mysql_fetch_array($q)) { ?>
                            <option value="<?=$r['id_kategori'];?>"><?=$r['nama_kategori'];?></option>
                        <?php
                        }
                    ?>
                </select>
            </div>
            <!--<div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="control-label">Gambar 1</label>
                        <input type="file" class="form-control" id="field-1" name="gambar1">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="control-label">Gambar 2</label>
                        <input type="file" class="form-control" id="field-1" name="gambar2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="control-label">Gambar 3</label>
                        <input type="file" class="form-control" id="field-1" name="gambar3">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="field-1" class="control-label">Gambar 4</label>
                        <input type="file" class="form-control" id="field-1" name="gambar4">
                    </div>
                </div>
            </div>-->
            <div class="modal-footer">                
            	<button type="submit" name="update" class="form-control btn btn-primary btn-rounded waves-effect w-md waves-light m-b-5" id="field-1">Simpan</button>
            </div>
        </form>
        <?php
        }
    }
?>