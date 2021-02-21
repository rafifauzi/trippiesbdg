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
    if (isset($_POST['keranjang'])) {
        $idUser=$_POST['id_user'];
        $id_barang=$_POST['id_barang'];
        if ($idUser!=null) {
            $cekUser=mysql_fetch_array(mysql_query("SELECT pemilik FROM tb_barang WHERE id_barang='$id_barang'"));
            $pemilik=$cekUser['pemilik'];
            if ($idUser==$pemilik) { ?>
                <script type="text/javascript">
                    alertify.alert("Anda Tidak Diperbolehkan Membeli Barang Sendiri", function(){ window.location.assign('../detail-store?id=<?=$id_barang;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }else{
                $keranjang=mysql_fetch_array(mysql_query("SELECT id_keranjang FROM tb_keranjang WHERE id_user='$idUser'"));
                $id_keranjang=$keranjang['id_keranjang'];            
                $cekKeranjang=mysql_num_rows(mysql_query("SELECT id_barang FROM `tb_detail-keranjang` WHERE id_keranjang='$id_keranjang' AND id_barang='$id_barang'"));               
                $qty=$_POST['qty'];
                $harga_jual=$_POST['harga_jual'];
                $rStok=mysql_query("UPDATE tb_barang SET stok=stok-'$qty' WHERE id_barang='$id_barang'") or die(mysql_error());
                if ($cekKeranjang>0) {
                    $qtyAwal=mysql_fetch_array(mysql_query("SELECT qty FROM `tb_detail-keranjang` WHERE id_keranjang='$id_keranjang' AND id_barang='$id_barang'"));
                    $qtyAkhir=$qtyAwal['qty']+$qty;
                    $subtotal=$qtyAkhir*$harga_jual;
                    $updateKeranjang=mysql_query("UPDATE `tb_detail-keranjang` SET `qty`='$qtyAkhir', `subtotal`='$subtotal' WHERE id_keranjang='$id_keranjang' AND id_barang='$id_barang'");
                    
                    if ($updateKeranjang&&$rStok) { ?>
                        <script type="text/javascript">
                        alertify.alert("Barang Keranjang Ditambahkan", function(){ window.location.assign('keranjang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }else{ ?>
                        <script type="text/javascript">
                        alertify.alert("Barang Keranjang Gagal Ditambahkan", function(){ window.location.assign('../detail-store?id=<?=$id_barang;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }
                }else{
                    $date=date('Y-m-d');
                    $subtotal=$qty*$harga_jual;
                    $masuk=mysql_query("INSERT INTO `tb_detail-keranjang` (`id_keranjang`, `id_barang`, `tgl_masuk`, `qty`, `subtotal`) VALUES ('$id_keranjang', '$id_barang', '$date', '$qty', '$subtotal');") or die(mysql_error());
                    if ($masuk&&$rStok) { ?>
                        <script type="text/javascript">
                        alertify.alert("Barang Keranjang Ditambahkan", function(){ window.location.assign('keranjang'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }else{ ?>
                        <script type="text/javascript">
                        alertify.alert("Barang Keranjang Gagal Ditambahkan", function(){ window.location.assign('../detail-store?id=<?=$id_barang;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }
                }
            }
        }else{
            echo "<script>window.location.assign('../login')</script>";
        }
    }
?>
</body>
</html>