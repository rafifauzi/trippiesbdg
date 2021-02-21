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
session_start();
$idUser=$_SESSION['id_user'];
    if (isset($_POST['pasangIklan'])) {
        $q=mysql_query("SELECT no_iklan FROM `tb_ngiklan`") or die(mysql_error());
        $row=mysql_num_rows($q)+1;
        $tgl=date('d');
        $bln=date('m');
        $thn=date('Y');
        $id="IK"."".$tgl."".$bln."".$thn."".$row;
        $idIklan=$_POST['idIklan'];
        $awalIklan=$_POST['awalIklan'];
        $akhirIklan=$_POST['akhirIklan'];
        $totHarga=str_replace('Rp ', '', str_replace('.','', $_POST['totHarga']));
        $durasi=$_POST['durasi'];
        if (isset($_SESSION['id_user'])) {
            $insertNgiklan=mysql_query("INSERT INTO tb_ngiklan(`no_iklan`,`bukti_trf`,`status`,`keterangan`) VALUES ('$id','-','0','-')");
            $insertDetail=mysql_query("INSERT INTO `tb_detail-ngiklan` (`no_iklan`,`id_iklan`,`id_user`,`tgl_pasang`, `tgl_habis`, `lama_pasang`, `total_pasang`) VALUES ('$id','$idIklan','$idUser','$awalIklan', '$akhirIklan', '$durasi', '$totHarga')");
            if ($insertNgiklan && $insertDetail) { ?>
                <script language="JavaScript">
                    alertify.alert("Silahkan Bayar Sesuai Tagihan", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }else{ ?>
                <script language="JavaScript">
                    alertify.alert("Permintaan Pemasangan Iklan Gagal", function(){ window.location.assign('iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }
        }else{
            echo "<script>window.location.assign('../login')</script>";
        }

    }
    if (isset($_POST['unggah'])) {
        $noIklan=$_POST['noIklan'];
        $tglBayar=date('Y-m-d');
        $ekstensi_diperbolehkan = array('png','jpg');
        $nama = $_FILES['buktitrf']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $namaBaru=$noIklan."-buktitrf.".$ekstensi;
        $ukuran = $_FILES['buktitrf']['size'];
        $file_tmp = $_FILES['buktitrf']['tmp_name'];
 
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){          
                move_uploaded_file($file_tmp, '../assets/images/t/'.$namaBaru);
                $query = mysql_query("UPDATE tb_ngiklan SET bukti_trf='$namaBaru', tgl_bayar='$tglBayar', status='1', keterangan='-' WHERE no_iklan='$noIklan'");
                if($query){ ?>
                    <script language="JavaScript">
                        alertify.alert("Tunggu Konfirmasi Dari Admin", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                    </script>
                <?php
                }else{
                    echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            }else{
                echo 'UKURAN FILE TERLALU BESAR';
            }
        }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }

   if (isset($_POST['unggahIklan'])) {
        $kdIklan=$_POST['noIklan'];
        $ekstensi_diperbolehkan = array('png','jpg', 'jpeg');
        $nama = $_FILES['iklan']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $namaBaru=$kdIklan."-iklan.".$ekstensi;
        $ukuran = $_FILES['iklan']['size'];
        $file_tmp = $_FILES['iklan']['tmp_name'];
        $id_iklan=mysql_fetch_array(mysql_query("SELECT id_iklan FROM `tb_detail-ngiklan` WHERE no_iklan='$kdIklan'"));
        $idIklan=$id_iklan['id_iklan'];
        $detailIklan=mysql_fetch_array(mysql_query("SELECT id_iklan, ukuran, size FROM `tb_iklan` WHERE id_iklan='$idIklan'"));
        
        $ukuranGambar=explode(' x ', $detailIklan['ukuran']);
        $ukuranIklan=getimagesize($file_tmp);
        $width=$ukuranGambar[0];
        $height=$ukuranGambar[1];
        $image_width = $ukuranIklan[0];
        $image_height = $ukuranIklan[1];

        if ($detailIklan['size']=='2') {
            $size=$detailIklan['size'];
            $sizeByte=1024*2000;

        }else{
            $size=$detailIklan['size'];
            $sizeByte=1024*1000;
        }

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if ($ukuran<=$sizeByte && $ukuran!=0) {
                if ($image_width==$width&&$image_height==$height) {
                    move_uploaded_file($file_tmp, '../assets/images/i/'.$namaBaru);
                    $upload = mysql_query("UPDATE `tb_iklan` SET image_iklan='$namaBaru' WHERE id_iklan='$idIklan'") or die(mysql_error());
                    $updateStatus=mysql_query("UPDATE tb_ngiklan SET status='3' WHERE no_iklan='$kdIklan'") or die(mysql_error());
                    if($upload&&$updateStatus){ ?>
                        <script language="JavaScript">
                            alertify.alert("Upload Selesai", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }else{?>
                        <script language="JavaScript">
                            alertify.alert("Gagal Upload", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }
                }else{ ?>
                    <script language="JavaScript">
                        alertify.alert("Resolusi Tidak Sesuai, Resolusi Harus <?=$detailIklan['ukuran'];?>", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                    </script>
                <?php
                }
            }else{?>
                <script language="JavaScript">
                    alertify.alert("Ukuran Tidak Sesuai, Ukuran Max <?=$size;?>", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }
        }else{?>
            <script language="JavaScript">
                alertify.alert("Format Tidak Sesuai, Format Harus PNG / JPG / JPEG", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?php                    
        }

        


        
   }
?>

</body>
</html>