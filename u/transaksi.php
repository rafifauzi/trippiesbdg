<?php 
include '../database/koneksi.php'; 
$row=mysql_num_rows(mysql_query("SELECT id_barang FROM tb_keranjang"));
if ($row>0) {
    $notif="<span class='noti-icon-badge'></span>";
}else{
    $notif="<span class='noti-icon-badge-none'></span>";
}
if (isset($_GET['ik'],$_GET['ib'])) {
    $ik=$_GET['ik'];
    $ib=$_GET['ib'];
    $belanja="SELECT tb_barang.id_barang,tb_barang.pemilik, tb_barang.berat, tb_keranjang.id_keranjang, nama_barang, qty, subtotal, total FROM `tb_keranjang` JOIN `tb_detail-keranjang` ON `tb_keranjang`.`id_keranjang`=`tb_detail-keranjang`.`id_keranjang` JOIN `tb_barang` ON `tb_detail-keranjang`.`id_barang`=`tb_barang`.`id_barang` WHERE tb_keranjang.id_keranjang='$ik' AND tb_barang.id_barang='$ib';";
    $total=mysql_fetch_array(mysql_query("SELECT SUM(subtotal) AS bayar FROM `tb_keranjang` JOIN `tb_detail-keranjang` ON `tb_keranjang`.`id_keranjang`=`tb_detail-keranjang`.`id_keranjang` JOIN `tb_barang` ON `tb_detail-keranjang`.`id_barang`=`tb_barang`.`id_barang` WHERE tb_keranjang.id_keranjang='$ik' AND tb_barang.id_barang='$ib';"));
}else if (isset($_GET['ik'],$_GET['ip'])) {
    $ik=$_GET['ik'];
    $ip=$_GET['ip'];
    $belanja="SELECT tb_barang.id_barang, tb_barang.pemilik, tb_barang.berat, tb_keranjang.id_keranjang, nama_barang, qty, subtotal, total FROM `tb_keranjang` JOIN `tb_detail-keranjang` ON `tb_keranjang`.`id_keranjang`=`tb_detail-keranjang`.`id_keranjang` JOIN `tb_barang` ON `tb_detail-keranjang`.`id_barang`=`tb_barang`.`id_barang` WHERE tb_keranjang.id_keranjang='$ik' AND tb_barang.pemilik='$ip'";
    $total=mysql_fetch_array(mysql_query("SELECT SUM(subtotal) AS bayar FROM `tb_keranjang` JOIN `tb_detail-keranjang` ON `tb_keranjang`.`id_keranjang`=`tb_detail-keranjang`.`id_keranjang` JOIN `tb_barang` ON `tb_detail-keranjang`.`id_barang`=`tb_barang`.`id_barang` WHERE tb_keranjang.id_keranjang='$ik' AND tb_barang.pemilik='$ip'"));
}else{
    echo "<script>window.location.assign('keranjang');</script>";
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
        <title>Transaksi</title>

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../assets/plugins/jquery.steps/demo/css/jquery.steps.css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
    </head>


    <body>

        <!-- Navigation Bar-->
        <?php include 'menu/header_user.php'; ?>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
                <div class="container">
                    <form method="POST" action="proses-transaksi.php">
                        <div class="row m-t-1">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                                <div class="card-box">
                                    <div class="form-group">
                                        <h4 class="header-title m-t-0 m-b-10">Data Penerima</h4><hr>
                                        <div id="dataFix">
                                            <h5 class="form-control-label"><?=$rUser['nama'];?></h5>                                
                                            <div class="form-group">
                                                <label class="form-control-label">Alamat</label>
                                                <textarea class="form-control" rows="3" style="width: 60%; resize: none; border: none; pointer-events: none; text-align: justify; overflow:hidden;"><?=$rUser['alamat']."\nKec.".$rUser['kecamatan']." / ".$rUser['kodepos'];?></textarea>
                                                <input type="textr" name="number" value="<?=$rUser['no_hp'];?>" class="form-control" style="width: 60%; resize: none; border: none; pointer-events: none; text-align: justify;">
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                                
                                <div class="card-box">
                                    <div class="form-group">
                                        <h4 class="header-title">Data Barang</h4><hr>
                                    </div>
                                    <div class="row">                  
                                    <?php
                                        $tampil=mysql_query($belanja);
                                        while ($hasil=mysql_fetch_array($tampil)) {  
                                            $hasil_harga = "Rp " . number_format($hasil['subtotal']);
                                            $idbrg=$hasil['id_barang'];
                                            $gambar=mysql_fetch_array(mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$idbrg' LIMIT 1"));
                                    ?>                                       
                                        <div class="col-lg-12 m-b-1">
                                            
                                            <input type="hidden" name="id_keranjang" value="<?=$hasil['id_keranjang'];?>">
                                            <div class="card-box bg-keranjang" onclick="window.location.assign('../detail-store?id=<?=$idbrg;?>')"> 
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-3 col-lg-4">
                                                        <img src="../assets/images/b/<?=$gambar['gambar'];?>" width="150" height="150" style="object-fit: cover;"><br>
                                                    </div>
                                                    <div class="col-sm-12 col-md-5 col-lg-5"><br>
                                                        <input type="hidden" name="id_barang[]" value="<?=$hasil['id_barang'];?>">
                                                        <h5><?=$hasil['nama_barang'];?><br></h5>
                                                        <input type="hidden" name="nama_barang[]" value="<?=$hasil['nama_barang'];?>">
                                                        <input type="hidden" name="harga[]" value="<?=$hasil_harga;?>">
                                                        <h5><?=$hasil_harga;?><br></h5>
                                                        <div class="form-inline">
                                                            <div class="form-group">
                                                                <input type="hidden" name="qty[]" value="<?=$hasil['qty'];?>">
                                                                <label><?=$hasil['qty'];?>&nbsp;Buah</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-10">Pembayaran</h4><hr>
                                    <?php
                                        $tampil=mysql_query($belanja);
                                        while ($hasil=mysql_fetch_array($tampil)) {  
                                            $hasil_harga = "Rp " . str_replace(',', '.', number_format($hasil['subtotal']));

                                                $ambil = $hasil['pemilik'];
                                                if ($ambil!='admin') {
                                                    $ada1 = "SELECT * FROM tb_user WHERE id_user = '$ambil'";
                                                }else{
                                                    $ada1 = "SELECT * FROM tb_admin WHERE username = '$ambil'";
                                                }
                                                $ada2=mysql_query($ada1);
                                                while ($mantap=mysql_fetch_array($ada2)) {
                                                    ?>
                                                    <input type="hidden" name="asal" id="asal" value="<?=$mantap['kota'];?>">
                                                <?php
                                                }
                                            ?>
                                            <input type="hidden" name="pemilik" value="<?=$ambil;?>">
                                        <?php
                                        $jumlah = $jumlah + $hasil['berat'];
                                    }
                                    ?>
                                            
                                    <?php
                                        $curl = curl_init();

                                        curl_setopt_array($curl, array(
                                        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => "",
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 30,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => "GET",
                                        CURLOPT_HTTPHEADER => array(
                                        "key:b6382502d38b84914aef2828a6a3ce51"
                                        ),
                                        ));

                                        $response = curl_exec($curl);
                                        $err = curl_error($curl);

                                        echo "
                                        <div class= \"form-group\">
                                            <label for=\"provinsi\">Provinsi Tujuan </label>
                                            <select class=\"form-control\" name='provinsi' id='provinsi'>";
                                                echo "<option>Pilih Provinsi Tujuan</option>";
                                                $data = json_decode($response, true);
                                                for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                                                    echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
                                                }
                                                echo "</select>
                                            </div>";
                                            //Get Data Provinsi
                                            ?>

                                            <div class="form-group">
                                                <label for="kabupaten">Kota/Kabupaten Tujuan</label><br>
                                                <select class="form-control" id="kabupaten" name="kabupaten"></select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kurir">Pengiriman</label><br>
                                                <select class="form-control" id="kurir" name="kurir">
                                                    <option value="jne">JNE</option>
                                                    <option value="tiki">TIKI</option>
                                                    <option value="pos">POS INDONESIA</option>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="berat">Berat (gram)</label><br>
                                                <input class="form-control" id="berat" type="text" name="berat" value="<?=$jumlah;?>" />
                                            </div>

                                            <button class="btn btn-success" id="cek" type="button" name="button">Cek Ongkir</button>
                                                            
                                            <div id="ongkir"></div>

                                    <table class="m-t-1" style="width: 100%; border: none;">
                                        <tr>
                                            <td><label>Total Harga Barang</label></td>
                                            <td width="10">:</td>
                                            <td>Rp <?=str_replace(',', '.', number_format($total['bayar']));?></td>
                                            <input type="hidden" id="totalHargaBarang" name="sub_harga" value="<?=$total['bayar'];?>">
                                        </tr>
                                    </table>
                                    <hr>
                                    <h4 class="m-t-2 header-title">Total Bayar</h4>                            
                                    <h4 id="totalBayar"></h4>
                                    <input type="hidden" name="totBayar" id="totBayar">
                                    <hr>
                                    <div class="form-group">
                                        <label>Transfer Bank</label>
                                        <select name="bank" class="form-control">
                                            <?php 
                                                $qBank=mysql_query("SELECT * FROM tb_bank");
                                                while ($bank=mysql_fetch_array($qBank)) { 
                                                    $dBank=$bank['nama_bank']." - ".$bank['nama_pemilik']." - ".$bank['no_rek'];
                                                ?>
                                                <option value="<?=$bank['id_bank'];?>"><?=$dBank;?></option>
                                                <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <button class="form-control btn btn-success waves-effect waves-light" name="bayar" >Bayar Sekarang</button>
                                </div>
                            </div>
                        </div> 
                    </form>        
                </div>
        </div>

                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->


            </div> <!-- container -->
        </div> <!-- End wrapper -->

        <script>
            var resizefunc = [];
            function hitungOngkir(harga){
                    document.getElementById('hargaOngkir').value=harga;
                    var totalHargaBarang = document.getElementById('totalHargaBarang').value; 
                    var totalBayar=parseInt(harga)+parseInt(totalHargaBarang);
                    document.getElementById('totBayar').value=totalBayar; 
                    document.getElementById('totalBayar').innerHTML='Rp '+rupiah(totalBayar);           
            }
            const rupiah = (x) => {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        </script>
        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
        <script src="../assets/plugins/morris/morris.min.js"></script>
        <script src="../assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="../assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="../assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="../assets/pages/jquery.dashboard.js"></script>

    </body>
</html>

<script type="text/javascript">

    $(document).ready(function(){
        $('#provinsi').change(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
            var prov = $('#provinsi').val();

            $.ajax({
                type : 'GET',
                url : 'http://localhost/trippies/ongkir/rajaongkir_2/cek_kabupaten.php',
                data :  'prov_id=' + prov,
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#kabupaten").html(data);
                }
            });
        });

        $("#cek").click(function(){
            //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
            var asal = $('#asal').val();
            var kab = $('#kabupaten').val();
            var kurir = $('#kurir').val();
            var berat = $('#berat').val();

            $.ajax({
                type : 'POST',
                url : 'http://localhost/trippies/ongkir/rajaongkir_2/cek_ongkir.php',
                data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
                    success: function (data) {

                    //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
                    $("#ongkir").html(data);
                }
            });
        });
    });
</script>