<?php 
include '../database/koneksi.php';
session_start();
if (isset($_POST['simpanCeritaku'])) {
    $id=$_SESSION['id_user'];
    $time=date('s');
    $rowGambar=mysql_num_rows(mysql_query("SELECT id_user FROM tb_blog WHERE id_user='$id'"))+1;
    $jdStory=$_POST['jdStory'];
    $kotaKab=$_POST['kotaKab'];
    $prov=$_POST['prov'];
    $lokasi=$kotaKab." , ".$prov;
    $kategori=$_POST['kategori'];

    $hargaMax=str_replace(',00', '', str_replace('.', '',$_POST['hargaMax']));
    $hargaMin=str_replace(',00', '', str_replace('.', '',$_POST['hargaMin']));
    $cerita=$_POST['cerita'];
    $tgl_upload=date('Y-m-d');
    
    $ekstensi_diperbolehkan = array('jpg','jpeg','bmp','png');

    $format_file = array("jpg", "png", "gif", "bmp");
    $max_file_size = 1024*2000; //maksimal 2mb
    $path = "../assets/images/s/"; // Lokasi folder untuk menampung file
    $count = 0;

    $gambar=$_POST['gambar'];
    $cGambar=count($gambar);

    $simpan=mysql_query("INSERT INTO `tb_blog` (`id_user`, `judul`, `lokasi`, `harga_max`, `harga_min`, `cerita`, `tgl_upload`, `id_kategori`) VALUES ('$id', '$jdStory', '$lokasi', '$hargaMax', '$hargaMin', '$cerita', '$tgl_upload', '$kategori')");

    foreach ($_FILES['gambar']['name'] as $i => $namaFile) {
        $j=$i+1;
        $ekstensi=explode('.', $namaFile);
        $size=$_FILES['gambar']['size'][$i];
        $namaBaru=$id.$time."-".$j.".".$ekstensi[1];

        if ($i<=4) {
            if ($size < $max_file_size || $size!=0) {
                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
                    if(move_uploaded_file($_FILES["gambar"]["tmp_name"][$i], $path.$namaBaru)){
                        $inputGambar=mysql_query("UPDATE tb_blog SET `gambar$j`= '$namaBaru' WHERE id_user='$id' AND judul='$jdStory'");
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
}

if (isset($_POST['hapusCeritaku'])) {
    $iduser=$_POST['idUser'];
    $qGambar=mysql_fetch_array(mysql_query("SELECT gambar1, gambar2, gambar3, gambar4 FROM tb_blog WHERE id_user='$iduser'"));
    $gambar1=$qGambar['gambar1'];
    $gambar2=$qGambar['gambar2'];
    $gambar3=$qGambar['gambar3'];
    $gambar4=$qGambar['gambar4'];       
        $hGambar1=unlink("../assets/images/s/".$gambar1);
        $hGambar2=unlink("../assets/images/s/".$gambar2);
        $hGambar3=unlink("../assets/images/s/".$gambar3);
        $hGambar4=unlink("../assets/images/s/".$gambar4);
        $hapus=mysql_query("DELETE FROM tb_blog WHERE id_user='$iduser'");
        if ($hapus) {
            echo "<script>window.location.assign('list-ceritaku')</script>";
        }else{
            echo "<script>window.location.assign('list-ceritaku')</script>";
        }
}
?>