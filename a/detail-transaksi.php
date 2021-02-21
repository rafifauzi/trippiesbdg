<?php 
include '../database/koneksi.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $cek=substr($id,0,2);
    if ($cek=='IN') {
        $sql = "SELECT tb_transaksi.no_invoice AS nomor, `total`, `bukti_trf`, `status`, `tb_transaksi`.`id_user` AS idUser, `nama` AS namaUser, `tgl_bayar`, keterangan FROM tb_transaksi JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user WHERE no_invoice = '$id'";
        $action = "proses-transaksi";
        $displayIn='';
        $displayIk='style="display:none;"';
        $displayBo='style="display:none;"';
        $cekPemilik=mysql_fetch_array(mysql_query("SELECT DISTINCT pemilik FROM `tb_detail-transaksi` JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=`tb_barang`.`id_barang` WHERE no_invoice='$id'"));
        if ($cekPemilik['pemilik']=='admin') {
            $btnResi='style="display:block;"';
            $btnKonfirmasi='style="display:none;"';
        }else{
            $btnResi='style="display:none;"';
            $btnKonfirmasi='style="display:block;"';
        }
    }else if($cek=='IK'){
        $sql = "SELECT `tb_user`.`id_user` AS idUser, `tb_user`.`nama` AS namaUser, `tb_ngiklan`.`no_iklan` AS nomor, `total_pasang` AS total, `bukti_trf`, `status`, `lama_pasang`, `tgl_pasang`, `tgl_habis`, `harga`, `nama_iklan`, keterangan FROM tb_ngiklan JOIN `tb_detail-ngiklan` ON tb_ngiklan.no_iklan=`tb_detail-ngiklan`.`no_iklan` JOIN tb_user ON `tb_detail-ngiklan`.`id_user`=`tb_user`.`id_user` JOIN tb_iklan ON `tb_detail-ngiklan`.`id_iklan`=`tb_iklan`.`id_iklan` WHERE tb_ngiklan.no_iklan = '$id'";
        $action = "proses-iklan";
        $displayIn='style="display:none;"';
        $displayIk='';
        $displayBo='style="display:none;"';
        $btnResi='style="display:none;"';
        $btnKonfirmasi='style="display:block;"';
    }else{
        $sql = "SELECT tb_booking.id_booking AS nomor, `tb_booking`.`harga` AS total, `bukti_trf`, `status`, `nama_paket`, tb_booking.id_user AS idUser, `nama` AS namaUser, keterangan FROM tb_booking JOIN tb_opentrip ON tb_booking.id_trip=tb_opentrip.id_trip JOIN tb_user ON tb_booking.id_user=tb_user.id_user WHERE id_booking = '$id'";
        $action = "proses-opentrip";
        $displayIn='style="display:none;"';
        $displayIk='style="display:none;"';
        $displayBo='';
        $btnResi='style="display:none;"';
        $btnKonfirmasi='style="display:block;"';
    }
    $result = mysql_query($sql);
    $hasil=mysql_fetch_array($result);
    if ($hasil['status']=='0') {
        $sInvoice="Belum Dibayar";
    }else if ($hasil['status']=='1') {
        $sInvoice="Konfirmasi Admin";
        $btnkonfirm='';
        $btnGagal='';
    }else if ($hasil['status']=='2') {
        $sInvoice="Dibayar";
        $btnkonfirm='style="pointer-events:none;"';
        $btnGagal='style="pointer-events:none;"';
    }else if ($hasil['status']=='3') {
        $sInvoice="Dikirim";
        $btnkonfirm='style="pointer-events:none;"';
        $btnGagal='style="pointer-events:none;"';
    }else if ($hasil['status']=='4') {
        $sInvoice="Selesai";
        $btnkonfirm='style="pointer-events:none;"';
        $btnGagal='style="pointer-events:none;"';
    }else{
        $sInvoice="Gagal";
        $btnkonfirm='style="pointer-events:none;"';
        $btnGagal='style="pointer-events:none;"';
    }
    function rupiah($angka){    
        $hasil_rupiah = "Rp " . number_format($angka);
        return str_replace(',', '.', $hasil_rupiah);     
    }
    function tanggal($a){
    $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    $tgl=date('d', strtotime($a))." ". $bulan[date('m', strtotime($a))]." ".date('Y', strtotime($a));
    return $tgl;
   } 
} else {
    echo "<script>window.location.assign('list-transaksi-barang')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="kodingkita" content="Trippies">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App title -->
        <title>Detail Transaksi</title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- DataTables -->
        <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="../assets/js/modernizr.min.js"></script>
    </head>
    <body>
        <!-- Navigation Bar-->
        <?php include 'menu/header.php'; ?>
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container">
                <div class="row m-t-1">
                    <div class="col-lg-4">
                        <img src="../assets/images/t/<?=$hasil['bukti_trf']?>" class="img-responsive img-thumbnail">
                    </div>
                    <div class="col-lg-8">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-10">No Transaksi : <?=$hasil['nomor'];?></h4><hr>
                            <h4><?=rupiah($hasil['total']);?></h4>
                            <table class="table m-t-1" style="width: 100%;">
                                <tr>
                                    <td><label>Id User</label></td>
                                    <td>:</td>
                                    <td><?=$hasil['idUser'];?></td>
                                    <td><label>Nama User</label></td>
                                    <td>:</td>
                                    <td><?=$hasil['namaUser'];?></td>
                                </tr>
                                <tr <?=$displayIn;?>>
                                    <td><label>Tanggal Bayar</label></td>
                                    <td>:</td>
                                    <td><?=tanggal($hasil['tgl_bayar']);?></td>
                                    <td><label>Status</label></td>
                                    <td>:</td>
                                    <td><?=$sInvoice;?></td>
                                </tr>
                                <tr <?=$displayIk;?>>
                                    <td><label>Lama Pasang</label></td>
                                    <td>:</td>
                                    <td><?=$hasil['lama_pasang']." Hari";?></td>
                                    <td><label>Periode</label></td>
                                    <td>:</td>
                                    <td><?=tanggal($hasil['tgl_pasang'])." - ".tanggal($hasil['tgl_habis']);?></td>
                                </tr>
                                <tr <?=$displayIk;?>>
                                    <td><label>Nama Iklan</label></td>
                                    <td>:</td>
                                    <td><?=$hasil['nama_iklan'];?></td>
                                    <td><label>Harga / Hari</label></td>
                                    <td>:</td>                                                
                                    <td><?=rupiah($hasil['harga']);?></td>
                                </tr>
                                <tr <?=$displayIk;?>>
                                    <td><label>Status</label></td>
                                    <td>:</td>
                                    <td><?=$sInvoice;?></td>
                                </tr>
                                <tr <?=$displayBo;?>>
                                    <td><label>Nama Paket</label></td>
                                    <td>:</td>
                                    <td><?=$hasil['nama_paket'];?></td>
                                    <td><label>Status</label></td>
                                    <td>:</td>                                                
                                    <td><?=$sInvoice;?></td>
                                </tr>
                                <tr>
                                    <td><label>Keterangan</label></td>
                                    <td>:</td>
                                    <td colspan="4"><?=$hasil['keterangan'];?></td>
                                </tr>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <button class="form-control btn btn-danger waves-effect waves-light" type="submit" name="batal" onclick="tampil(1)" <?=$btnGagal;?>>Gagal</button>  
                                    <form method="POST" action="<?=$action;?>" class="m-t-1" id="batal" style="display: none;">
                                        <input type="hidden" name="noInvoice" class="form-control" value="<?=$id;?>">
                                        <input type="text" name="keterangan" class="form-control" placeholder="Masukan Keterangan" style="margin-bottom: 5px;"  autocomplete="off">
                                        <button class="btn btn-danger waves-effect waves-light form-control" name="batal" type="submit">Simpan Keterangan</button>
                                    </form>   
                                </div>
                                <div class="col-sm-6 col-lg-6"> 

                                    <form method="POST" action="<?=$action;?>"> 
                                        <input type="hidden" name="noInvoice" class="form-control" value="<?=$id;?>"> 
                                        <div <?=$btnKonfirmasi;?>>
                                            <button class="form-control btn btn-primary waves-effect waves-light" type="submit" name="konfirmasi" onclick="tampil(2)" <?=$btnkonfirm;?>>Konfirmasi</button>
                                        </div>      
                                    </form>

                                    
                                    <button class="form-control btn btn-success waves-effect waves-light" type="button" onclick="tampil(3)" <?=$btnResi;?>>Kirim</button>
                                    <form method="POST" action="<?=$action;?>" class="m-t-1" id="resi" style="display: none;">
                                        <input type="hidden" name="noInvoice" class="form-control" value="<?=$id;?>">
                                        <input type="text" name="noResi" class="form-control" placeholder="Masukan Nomor Resi" style="margin-bottom: 5px;"  autocomplete="off">
                                        <button class="btn btn-success waves-effect waves-light form-control" name="kirimResi" type="submit">Kirim Barang</button>
                                    </form> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var resizefunc = [];
            function pindah(x){
                if (x==6) {
                    window.location.assign('list-transaksi-barang');
                }else{
                    window.location.assign('list-transaksi-barang?st='+x);
                }
            }
            function jenisTransaksi(y){
                if (y==1) {
                    window.location.assign('list-transaksi-barang');
                }else if (y==2){
                    window.location.assign('list-transaksi-openTrip'); 
                }else{
                    window.location.assign('list-transaksi-iklan');
                }
            }
            function tampil(a){
                if (a==1) {
                    document.getElementById('batal').style.display='block'; 
                    document.getElementById('resi').style.display='none';
                }else if(a==2){
                    document.getElementById('batal').style.display='none';
                    document.getElementById('resi').style.display='none'; 
                }else{
                    document.getElementById('resi').style.display='block';
                    document.getElementById('batal').style.display='none';
                }
            }
        </script>

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>

        <!-- Required datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>
</body>
</html>