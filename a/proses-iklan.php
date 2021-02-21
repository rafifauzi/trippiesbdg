<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="../assets/css/alertify.min.css" type='text/css' />
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <script src="../assets/js/alertify.min.js"></script>
</head>
<body>

</body>
</html>
<?php
  session_start();
   require_once("../database/koneksi.php");

   if (isset($_POST['update'])) {
   		$kdIklan=$_POST['kdIklan'];
  		$hgIklan=str_replace("Rp ","",str_replace('.','',$_POST['hgIklan']));
  		$updateHarga=mysql_query("UPDATE tb_iklan SET harga='$hgIklan' WHERE id_iklan='$kdIklan'");

  		if ($updateHarga) { ?>
  			<script language="JavaScript">
                  alertify.alert("Update Harga Berhasil", function(){ window.location.assign('list-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
              </script>
  		<?php
  		}
   }
   if (isset($_POST['konfirmasi'])) {
      $kdIklan=$_POST['noInvoice'];
      $updateStatus=mysql_query("UPDATE tb_ngiklan SET status='2' WHERE no_iklan='$kdIklan'") or die(mysql_error());

      if ($updateStatus) { ?>
        <script language="JavaScript">
                  alertify.alert("Konfirmasi Berhasil", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
              </script>
      <?php
      }
   }

   /*if (isset($_POST['nonAKtif'])) {
      $noIklan=$_POST['noIklan'];
      $updateStatus=mysql_query("UPDATE `tb_detail-ngiklan` SET status_aktif='0' WHERE no_iklan='$kdIklan'") or die(mysql_error());
      if ($updateStatus) { ?>
        <script language="JavaScript">
            alertify.alert("Iklan Di NonaKtifkan", function(){ window.location.assign('home'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
      <?php
      }
   }*/

   if (isset($_POST['batal'])) {
      $noIklan=$_POST['noInvoice'];
      $keterangan=$_POST['keterangan'];
      $updateStatus=mysql_query("UPDATE tb_ngiklan SET status='4', keterangan='$keterangan' WHERE no_iklan='$noIklan'") or die(mysql_error());

      if ($updateStatus) { ?>
        <script language="JavaScript">
                  alertify.alert("Konfirmasi Berhasil", function(){ window.location.assign('list-transaksi-iklan'); }).setHeader(' ').set({closable:false,transition:'pulse'});
              </script>
      <?php
      }
   }
   
   if (isset($_POST['nonAKtif'])) {
      $noIklan=$_POST['noIklan'];
      $path = "../assets/images/i/";
      $count=0;
      $namaGambar=$noIklan.'-iklan';
      unlink($path.$namaGambar);
      $idIklan=$_POST['idIklan'];
      $gantiGambar=mysql_query("UPDATE `tb_detail-ngiklan` SET status_aktif='2' WHERE no_iklan='$noIklan'");
      $gantiGambar=mysql_query("UPDATE tb_iklan SET image_iklan='blank_iklan.jpg' WHERE id_iklan='$idIklan'");

      if ($gantiGambar) {
          ?>
          <script type="text/javascript">
              alertify.alert("Iklan Telah Dihapus", function(){ window.location.assign('home'); }).setHeader(' ').set({closable:false,transition:'pulse'});
          </script>
          <?php
      }else{
          ?>
          <script type="text/javascript">
              alertify.alert("Iklan Gagal Dihapus", function(){ window.location.assign('home'); }).setHeader(' ').set({closable:false,transition:'pulse'});
          </script>
          <?php
      }
      
  }
?>