<?php 
include 'database/koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM tb_penginapan WHERE id_penginapan = '$id'";
        $result = mysql_query($sql);
        $hasil=mysql_fetch_array($result);
        $pisah = explode(" - ",$hasil['booking']);

        ?>
        <p>Anda dapat melakukan booking tempat dengan menghubungi kontak dibawah ini</p>
        <table>
            <tr>
                <td width="120">Nama Penginapan</td>
                <td width="10">:</td>
                <td><?=$hasil['nama_penginapan']?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?=$hasil['alamat_penginapan']?></td>
            </tr>
            <tr>
                <td>Pemilik</td>
                <td>:</td>
                <td><?=$pisah[0];?></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td><?=$pisah[1];?></td>
            </tr>
        </table>
        <?php
    }
?>