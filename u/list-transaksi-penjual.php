<!DOCTYPE html>
<html>
<head>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="kodingkita" content="Trippies">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- App title -->
        
		<title>Transaksi Penjual</title>

        <!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

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
        <style type="text/css">
            .img-sm{
                width: 150px;
            }
        </style>
</head>
<body>
<?php
include '../database/koneksi.php';
include 'menu/header_user.php';
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
function rupiah($angka){    
    $hasil_rupiah = "Rp " . number_format($angka);
    $rupiah=str_replace(',', '.', $hasil_rupiah);
    return $rupiah;     
}
?>
	<div class="wrapper">
        <div class="container">
        	<div class="row">
                <div class="col-sm-12 col-lg-6"> 
                    <h4 class="page-title">Keranjang Belanja</h4>
                </div>  
                <div class="col-sm-12 col-lg-6"> 
                    <div class="pull-right page-title form-inline">
                            <label style="font-size: 14px;">Tampilkan Berdasarkan Status </label>
                            <select class="form-control" onchange="pindah(this.value)">
                                <option value="x" selected disabled>- - Pilih - -</option>
                                <option value="0">Belum Dibayar</option>
                                <option value="1">Diproses</option>
                                <option value="2">Dibayar</option>
                                <option value="3">Dikirim</option>
                                <option value="4">Selesai</option>
                                <option value="5">Gagal</option>
                                <option value="6">Tampilkan Semua</option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12">
						<?php
						if (isset($_GET['st'])) {
							$st=$_GET['st'];
							$q="SELECT DISTINCT `tb_transaksi`.`no_invoice`, sub_total, status, total, keterangan FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN `tb_barang` ON `tb_detail-transaksi`.`id_barang`=`tb_detail-transaksi`.`id_barang` WHERE pemilik!='admin' AND pemilik='$idUser' AND status='$st' ORDER BY `tgl_order`";
						}else{
							$q="SELECT DISTINCT `tb_transaksi`.`no_invoice`, sub_total, status, total, keterangan FROM `tb_transaksi` JOIN `tb_detail-transaksi` ON `tb_transaksi`.`no_invoice`=`tb_detail-transaksi`.`no_invoice` JOIN `tb_barang` ON `tb_detail-transaksi`.`id_barang`=`tb_detail-transaksi`.`id_barang` WHERE pemilik!='admin' AND pemilik='$idUser' ORDER BY `tgl_order`";
						}
						$r=mysql_query($q);
						while ($hasil=mysql_fetch_array($r)) { 
							if ($hasil['status']=='0') {
                                $label="class='label label-warning'";
                                $sInvoice="Belum Dibayar";
                            }else if ($hasil['status']=='1') {
                                $label="class='label label-warning'";
                                $sInvoice="Konfirmasi Admin";
                            }else if ($hasil['status']=='2') {
                                $label="class='label label-success'";
                                $sInvoice="Dibayar";
                            }else if ($hasil['status']=='3') {
                                $label="class='label label-info'";
                                $sInvoice="Dikirim";
                            }else if ($hasil['status']=='4') {
                                $label="class='label label-success'";
                                $sInvoice="Selesai";
                            }else{
                                $label="class='label label-danger'";
                                $sInvoice="Gagal";
                            }

							?>
							<div class="card-box">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
											<h4 class="page-title">Invoice : <?=$hasil['no_invoice'];?> | Total : <?=$hasil['total'];?></h4>
										</div>
										<div class="col-lg-6">
											<h4 class="pull-right page-title">Status : <span <?=$label;?>><?=$sInvoice;?></span></h4>
										</div>
									</div>
									<?php 
										$noInv=$hasil['no_invoice'];
										$qBarang=mysql_query("SELECT tgl_order, nama_barang, harga_jual, qty, (harga_jual*qty) AS subTotal, tb_barang.id_barang FROM `tb_detail-transaksi` JOIN tb_transaksi ON `tb_detail-transaksi`.`no_invoice`=tb_transaksi.no_invoice JOIN tb_barang ON `tb_detail-transaksi`.`id_barang`=tb_barang.id_barang WHERE `tb_detail-transaksi`.no_invoice='$noInv'");
										while ($rBarang=mysql_fetch_array($qBarang)) {
                                            $idbrg=$rBarang['id_barang'];
                                            $gambar=mysql_fetch_array(mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$idbrg' LIMIT 1"));
                                            ?>
											<div class="row  keranjang-border">                              
	                                            <div class="col-lg-2">
	                                                <div class="row">                                        
	                                                    <img src="../assets/images/b/<?=$gambar['gambar'];?>" class="img-thumbnail img-sm"> 
	                                                </div>                                  
	                                            </div>
	                                            <div class="col-lg-8"> 
	                                                <h6>Tanggal Transaksi : <?=tanggal($rBarang['tgl_order']);?></h6>
	                                                <div class="m-t-1">
	                                                    <h4><?=$rBarang['nama_barang'];?></h4>
	                                                    <h4><?=rupiah($rBarang['harga_jual']);?></h4>  
	                                                    <h4><small><?=$rBarang['qty'];?> Buah</small></h4>
	                                                </div>                                       
	                                            </div> 
                                        </div>
										<?php
										}
									?>
									<div class="row">
										<button class="btn btn-dark waves-light waves-effect pull-right" onclick="window.location.assign('detail-invoice?n=<?=$hasil['no_invoice'];?>')">Detail</button>
									</div>
								</div>		
							</div>
						<?php
						}
						?>                    	
					</div> 
                </div>                    
            </div>
        </div>
    </div>
        <script>
            var resizefunc = [];
            function pindah(x){
                if (x==6) {
                    window.location.assign('list-transaksi-penjual');
                }else{
                    window.location.assign('list-transaksi-penjual?st='+x);
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

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

    </body>
</html>