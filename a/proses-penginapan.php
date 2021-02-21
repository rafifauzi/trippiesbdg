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
include '../database/koneksi.php';
if (isset($_POST['pasarkan'])) {
    $date=date('dmY');
    $sql1=mysql_query("SELECT id_penginapan FROM tb_penginapan WHERE SUBSTR(id_penginapan,3,8)='$date'") or die(mysql_error());
    $cek=mysql_num_rows($sql1);
    $urutan=$cek+1;
    if ($cek>=0) {
        $idPenginapan="PE".$date."".date('s')."".$urutan;
    }
    $nmPenginapan=$_POST['nmPenginapan'];
    $hgSewa=str_replace(',00','',str_replace('.','',$_POST['hgSewa']));
    $alamat=$_POST['alamat'];
    $jmlMin=$_POST['jmlMin'];
    $jmlMax=$_POST['jmlMax'];
    $jmlOrang=$jmlMin." - ".$jmlMax;
    $jnamaPemilik=$_POST['namaPemilik'];
    $noTelpPemilik=$_POST['noTelpPemilik'];
    $booking=$jnamaPemilik." - ".$noTelpPemilik;
    $deskripsi=$_POST['deskripsi'];
    $date=date('Y-m-d');

    $ekstensi_diperbolehkan = array('jpg','jpeg','bmp','png');

    $format_file = array("jpg", "png", "gif", "bmp");
    $max_file_size = 1024*2000; //maksimal 2mb
    $path = "../assets/images/p/"; // Lokasi folder untuk menampung file
    $count = 0;

    $gambar=$_POST['gambar'];
    $cGambar=count($gambar);
    
    
    $simpan=mysql_query("INSERT INTO `tb_penginapan` (`id_penginapan`, `nama_penginapan`, `alamat_penginapan`, `minOrang`, `maxOrang`, `harga`, `deskripsi_penginapan`, `tanggal_upload`, `booking`) VALUES ('$idPenginapan', '$nmPenginapan', '$alamat', '$jmlMin', '$jmlMax', '$hgSewa', '$deskripsi', '$date', '$booking');");

    foreach ($_FILES['gambar']['name'] as $i => $namaFile) {
        $j=$i+1;
        $ekstensi=explode('.', $namaFile);
        $size=$_FILES['gambar']['size'][$i];
        $namaBaru=$idPenginapan."-".$j.".".$ekstensi[1];

        if ($i<=5) {
            if ($size < $max_file_size || $size!=0) {
                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
                    if(move_uploaded_file($_FILES["gambar"]["tmp_name"][$i], $path.$namaBaru)){
                        $inputGambar=mysql_query("INSERT INTO `tb_gambar_penginapan`(`id_penginapan`,`gambar`) VALUE ('$idPenginapan','$namaBaru')");
                        if ($inputGambar) {
                            $count++;
                        }else{
                            $count=0;
                        }
                   }else{
                    ?>
                        <script type="text/javascript">
                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('tambah-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php  
                   }                
                }else{
                    ?>
                    <script type="text/javascript">
                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('tambah-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                    </script>
                <?php  
                }
            }else{
                ?>
                    <script type="text/javascript">
                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('tambah-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                    </script>
                <?php    
            }
        }else{
            break;
        }
    }

    if ($simpan && $count>0) {
        ?>
        <script type="text/javascript">
            alertify.alert("Penginapan Telah Ditambahkan", function(){ window.location.assign('list-Penginapan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alertify.alert("Penginapan Gagal Ditambahkan", function(){ window.location.assign('tambah-Penginapan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }
        
}

if (isset($_POST['hapusPenginapan'])) {
    $idPenginapan=$_POST['idPenginapan'];
    $path = "../assets/images/p/";
    $count=0;
    $hapusPenginapan=mysql_query("DELETE FROM tb_penginapan WHERE id_penginapan='$idPenginapan'");
    $ambilGambar=mysql_query("SELECT gambar FROM tb_gambar_penginapan WHERE id_penginapan='$idPenginapan'");
    while ($hapusGambar=mysql_fetch_array($ambilGambar)) {
        $namaGambar=$hapusGambar['gambar'];
        unlink($path.$namaGambar);
    $count++;
    }
    $hapusDetailPenginapan=mysql_query("DELETE FROM tb_gambar_penginapan WHERE id_penginapan='$idPenginapan'");

    if ($count>0 && $hapusPenginapan && $hapusDetailPenginapan) {
        ?>
        <script type="text/javascript">
            alertify.alert("Penginapan Telah Dihapus", function(){ window.location.assign('list-penginapan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alertify.alert("Penginapan Gagal Dihapus", function(){ window.location.assign('list-penginapan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }
    
}
?>
</body>
</html>