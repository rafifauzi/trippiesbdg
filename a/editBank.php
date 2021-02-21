<?php 
include '../database/koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM tb_bank WHERE id_bank = '$id'";
        $result = mysql_query($sql);
        while ($hasil=mysql_fetch_array($result)) { ?>
        <form method="POST" name="edit" action="proses-profil" enctype="multipart/form-data">
        	<div class="form-group">
                <label class="form-control-label">Kode Bank (<a href="https://flip.id/kode-bank">Silahkan Lihat Disini</a>)</label>
                <input type="text" name="kdBank" class="form-control" value="<?=$hasil['id_bank'];?>">
            </div>
        	<div class="form-group">
                <label class="form-control-label">Nama Bank</label>
                <input type="text" name="nmBank" class="form-control" value="<?=$hasil['nama_bank'];?>">
            </div>
            <div class="form-group">
                <label class="form-control-label">Pemilik</label>
                <input type="text" name="pemilik" class="form-control" value="<?=$hasil['nama_pemilik'];?>">
            </div>
            <div class="form-group">                                            
                <label class="form-control-label">Nomor Rekening</label>
                <input type="text" name="noRek" class="form-control" value="<?=$hasil['no_rek'];?>">                                            
            </div>            
            <div class="modal-footer">                
            	<button type="submit" name="editBank" class="form-control btn btn-primary btn-rounded waves-effect w-md waves-light m-b-5" id="field-1">Simpan</button>
            </div>
        </form>
        <?php
        }
    }
?>