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
    $q=mysql_query("SELECT id_trip FROM tb_opentrip") or die(mysql_error());
    $row=mysql_num_rows($q)+1;
    $tgl=date('d');
    $bln=date('m');
    $thn=date('Y');
    $id="TR"."".$tgl."".$bln."".$thn."".$row;
    $nmPaket=$_POST['nmPaket'];
    $harga=$hargaMax=str_replace(',00', '', str_replace('.', '',$_POST['harga']));
    $periodeAwal=$_POST['periodeAwal'];
    $periodeAkhir=$_POST['periodeAkhir'];
    $lokasi=$_POST['lokasi'];
    $currency=$_POST['currency'];
    $deskripsi=$_POST['deskripsi'];
    $rute=$_POST['rute'];
    $include=$_POST['include'];
    $exclude=$_POST['exclude'];
    $donts=$_POST['donts'];
    $tglUpload=date('Y-m-d');
    $ekstensi_diperbolehkan = array('jpg','jpeg','bmp','png');

    //gambar1
    $file1 = $_FILES['gambar1']['name'];
    if ($file1!=null) {        
        $x1 = explode('.', $file1);
        $nama1=strtolower(current($x1));
        $ekstensi1 = strtolower(end($x1));
        $namaBaru1=$id."-1.".$ekstensi1;
        $ukuran1 = $_FILES['gambar1']['size'];
        $file_tmp1 = $_FILES['gambar1']['tmp_name'];
    }else{
        $namaBaru1='blank_image.jpg';
        $ekstensi1 = 'jpg';
        $ukuran1 = 100;
    }

    if(in_array($ekstensi1, $ekstensi_diperbolehkan) === true){
        if($ukuran1<2097152){      
          $upload = move_uploaded_file($file_tmp1, '../assets/images/o/'.$namaBaru1);
          $insert=mysql_query("INSERT INTO `tb_opentrip` (`id_trip`, `nama_paket`, `harga`, `periodeAwal`, `periodeAkhir`, `lokasi`, `deskripsi`, `rute`, `include`, `exclude`, `donts`, `currency`, `gambar1`, `tgl_upload`) VALUES ('$id', '$nmPaket', '$harga', '$periodeAwal', '$periodeAkhir', '$lokasi', '$deskripsi', '$rute', '$include', '$exclude', '$donts', '$currency', '$namaBaru1', '$tglUpload');") or die(mysql_error()); 
          if ($insert&&$upload) { ?>
                <script type="text/javascript">
                    alertify.alert("OpenTrip Telah Ditambahkan", function(){ window.location.assign('list-openTrip'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
          }else{?>
                <script type="text/javascript">
                    alertify.alert("OpenTrip Gagal Disimpan", function(){ window.location.assign('tambah-openTrip'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
          }     
        }else{
        echo "File Terlalu Besar";
        }
    }else{
        echo "File Tidak Didukung";
    }
}

if (isset($_POST['join'])) {
        $id_user=$_POST['id_user'];
        if ($id_user=='') {
            echo "<script>window.location.assign('../login')</script>";
        }else{          
            $id_trip=$_POST['id_trip'];
            $nama_paket=$_POST['nama_paket'];
            $harga=$_POST['harga'];
            $jumlahMax=$_POST['jumlahMax'];
            $status=1;

            $row=mysql_num_rows(mysql_query("SELECT id_booking FROM tb_booking"))+1;      
            $tgl=date('d');
            $bln=date('m');
            $thn=date('Y');
            $id="BOOK"."".$tgl."".$bln."".$thn."".$row;
            $konfirmasi=mysql_query("INSERT INTO `tb_booking` (`id_booking`, `id_trip`, `id_user`, `harga`, `status`) VALUES ('$id','$id_trip', '$id_user', '$harga', '$status');") or die(mysql_error());
            if ($konfirmasi) { ?>
                <script type="text/javascript">
                    alertify.alert("Berhasil Booking Trip", function(){ window.location.assign('../u/book-opentrip'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }else{ ?>
                <script type="text/javascript">
                    alertify.alert("Gagal Booking Trip", function(){ window.location.assign('../opentrip'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }  
        }
    }

if (isset($_GET['id'])) {
        $idTrip=$_GET['id'];
        $qGambar=mysql_fetch_array(mysql_query("SELECT gambar1 FROM tb_openTrip WHERE id_trip='$idTrip'"));
        $gambar1=$qGambar['gambar1'];
        if ($gambar1=='blank_image.jpg') {
            $hapus=mysql_query("DELETE FROM tb_openTrip WHERE id_trip='$idTrip'");
            if ($hapus) {
                echo $gambar1." Berhasil";
            }else{
                echo $gambar1." Gagal";
            }
        }else{           
            $hGambar1=unlink("../assets/images/o/".$gambar1);
            $hapus=mysql_query("DELETE FROM tb_openTrip WHERE id_trip='$idTrip'");
            if ($hapus&&$hGambar1) {
                echo "Berhasil";
            }else{
                echo "Gagal";
            } 
        }
    }

    if (isset($_POST['batal'])) {
        $id_booking=$_POST['noInvoice'];
        $keterangan=$_POST['keterangan'];
        $query = mysql_query("UPDATE tb_booking SET keterangan='$keterangan', status='3' WHERE id_booking='$id_booking'");
            if($query){
                echo "<script>window.location.assign('list-transaksi-openTrip')</script>";
            }else{
                echo "<script>alert('gagal upload'); window.location.assign('list-transaksi-openTrip')</script>";
            }
    }
    if (isset($_POST['konfirmasi'])) {
        $id_booking=$_POST['noInvoice'];
        $query = mysql_query("UPDATE tb_booking SET status='2' WHERE id_booking='$id_booking'");
            if($query){
                echo "<script>window.location.assign('list-transaksi-openTrip')</script>";
            }else{
                echo "<script>alert('gagal upload'); window.location.assign('list-transaksi-openTrip')</script>";
            }
    }
?>
</body>
</html>