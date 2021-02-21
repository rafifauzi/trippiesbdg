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
    $sql1=mysql_query("SELECT id_barang FROM tb_barang WHERE SUBSTR(id_barang,3,8)='$date'") or die(mysql_error());
    $cek=mysql_num_rows($sql1);
    $urutan=$cek+1;
    if ($cek>=0) {
        $idBarang="BR".$date."".$urutan;
    }
    $nmBarang=$_POST['nmBarang'];
    $kBarang=$_POST['kBarang'];
    $hgBeli=str_replace(',00','',str_replace('.','',$_POST['hgBeli']));
    $hgJual=($hgBeli*0.02)+$hgBeli;
    $brtBarang=$_POST['brtBarang'];
    $qty=$_POST['stok'];
    $kondisi=$_POST['kondisi'];
    $deskripsi=$_POST['deskripsi'];
    $date=date('Y-m-d');

    $ekstensi_diperbolehkan = array('jpg','jpeg','bmp','png');

    $format_file = array("jpg", "png", "gif", "bmp");
    $max_file_size = 1024*2000; //maksimal 2mb
    $path = "../assets/images/b/"; // Lokasi folder untuk menampung file
    $count = 0;

    $gambar=$_POST['gambar'];
    $cGambar=count($gambar);
    
    $inputBarang=mysql_query("INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `stok`, `berat`, `harga_beli`, `harga_jual`, `kondisi`, `dilihat`, `deskripsi`, `tgl_upload`, `id_kategori`, `pemilik`) VALUES ('$idBarang', '$nmBarang', '$qty', '$brtBarang', '$hgBeli', '$hgJual', '$kondisi', '0', '$deskripsi', '$date', '$kBarang', 'admin');");

    foreach ($_FILES['gambar']['name'] as $i => $namaFile) {
        $j=$i+1;
        $ekstensi=explode('.', $namaFile);
        $size=$_FILES['gambar']['size'][$i];
        $namaBaru=$idBarang."-".$j.".".$ekstensi[1];

        if ($i<=4) {
            if ($size < $max_file_size || $size!=0) {
                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
                    if(move_uploaded_file($_FILES["gambar"]["tmp_name"][$i], $path.$namaBaru)){
                        $inputGambar=mysql_query("INSERT INTO `tb_gambar_barang`(`id_barang`,`gambar`) VALUE ('$idBarang','$namaBaru')");
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

    if ($inputBarang && $count>0) {
        ?>
        <script type="text/javascript">
            alertify.alert("Barang Telah Ditambahkan", function(){ window.location.assign('list-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alertify.alert("Barang Gagal Ditambahkan", function(){ window.location.assign('tambah-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }

}
if (isset($_POST['update'])) {
    $id=$_POST['idBarang'];
    $nmBarang=$_POST['nmBarang'];
    $kBarang=$_POST['kBarang'];    
    $a=str_replace(",","",$_POST['hgBeli']);
    $b=str_replace("Rp ","",$a);
    $hgBeli=$b;
    $hgJual=($hgBeli*0.02)+$hgBeli;
    $brtBarang=$_POST['brtBarang'];
    $qty=$_POST['stok'];
    $kondisi=$_POST['kondisi'];
    $deskripsi=$_POST['deskripsi'];
    $ekstensi_diperbolehkan = array('jpg');

    $update="UPDATE tb_barang SET `id_barang`='$id', `nama_barang`='$nmBarang', `stok`='$qty', `berat`='$brtBarang', `harga_beli`='$hgBeli', `harga_jual`='$hgJual', `kondisi`='$kondisi', `deskripsi`='$deskripsi', `id_kategori`='$kBarang' WHERE id_barang='$id'";
    $result=mysql_query($update) or die(mysql_error()); 
    if ($result) { 
        ?>
        <script type="text/javascript">
            alertify.alert("Barang Telah Diubah", function(){ window.location.assign('list-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alertify.alert("Barang Telah Diubah", function(){ window.location.assign('list-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    } 
}

if (isset($_POST['hapusBarang'])) {
    $idBarang=$_POST['idBarang'];
    $path = "../assets/images/b/";
    $count=0;
    $hapusBarang=mysql_query("DELETE FROM tb_barang WHERE id_barang='$idBarang'");
    $ambilGambar=mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$idBarang'");
    while ($hapusGambar=mysql_fetch_array($ambilGambar)) {
        $namaGambar=$hapusGambar['gambar'];
        unlink($path.$namaGambar);
    $count++;
    }
    $hapusDetailBarang=mysql_query("DELETE FROM tb_gambar_barang WHERE id_barang='$idBarang'");

    if ($count>0 && $hapusBarang && $hapusDetailBarang) {
        ?>
        <script type="text/javascript">
            alertify.alert("Barang Telah Dihapus", function(){ window.location.assign('list-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alertify.alert("Barang Gagal Dihapus", function(){ window.location.assign('list-barang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
        <?php
    }
    
}

?>

</body>
</html>
