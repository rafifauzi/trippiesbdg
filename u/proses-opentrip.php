<?php
include '../database/koneksi.php';
$q=mysql_query("SELECT id_trip FROM tb_opentrip") or die(mysql_error());
$row=mysql_num_rows($q)+1;
$tgl=date('d');
$bln=date('m');
$thn=date('Y');
$id="TR"."".$tgl."".$bln."".$thn."".$row;
if (isset($_POST['join'])) {
        $id_user=$_POST['id_user'];
        if ($id_user=='') {
            echo "<script>window.location.assign('../login')</script>";
        }else{          
            $id_trip=$_POST['id_trip'];
            $cek=mysql_num_rows(mysql_query("SELECT id_booking FROM tb_booking WHERE id_trip='$id_trip' AND id_user='$id_user'"));
            $cek1=mysql_num_rows(mysql_query("SELECT id_booking FROM tb_booking WHERE id_trip='$id_trip' AND id_user='$id_user' AND status='3'"));
            if ($cek>0 || $cek1>0) {  
                echo "<script>alert('Gagal Booking'); window.location.assign('../opentrip');</script>";             
            }else{
                $nama_paket=$_POST['nama_paket'];
                $harga=$_POST['harga'];
                $jumlahMax=$_POST['jumlahMax'];
                $status=0;

                $row=mysql_num_rows(mysql_query("SELECT id_booking FROM tb_booking"))+1;      
                $tgl=date('d');
                $bln=date('m');
                $thn=date('Y');
                $id="BOOK"."".$tgl."".$bln."".$thn."".$row;
                $konfirmasi=mysql_query("INSERT INTO `tb_booking` (`id_booking`, `id_trip`, `id_user`, `harga`, `status`) VALUES ('$id','$id_trip', '$id_user', '$harga', '$status');");
                if ($konfirmasi) {
                    echo "<script>alert('Berhasil Booking Trip'); window.location.assign('book-opentrip')</script>";
                }else{
                    echo "<script>alert('Gagal Booking'); window.location.assign('book-opentrip')</script>";
                }                
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
    if (isset($_POST['unggah'])) {
        $id_booking=$_POST['noInv'];
        $ekstensi_diperbolehkan = array('png','jpg');
        $nama = $_FILES['buktitrf']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $namaBaru=$id_booking."-buktitrf.".$ekstensi;
        $ukuran = $_FILES['buktitrf']['size'];
        $file_tmp = $_FILES['buktitrf']['tmp_name'];
 
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1044070){          
                move_uploaded_file($file_tmp, '../assets/images/t/'.$namaBaru);
                $query = mysql_query("UPDATE tb_booking SET bukti_trf='$namaBaru', status='1' WHERE id_booking='$id_booking'");
                if($query){
                    echo "<script>window.location.assign('list-transaksi-openTrip')</script>";
                }else{
                     echo "<script>alert('gagal upload'); window.location.assign('list-transaksi-openTrip')</script>";
                }
            }else{
                echo 'UKURAN FILE TERLALU BESAR';
            }
        }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }
?>