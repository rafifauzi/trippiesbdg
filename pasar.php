<?php 
function rupiah($angka){    
    $hasil_rupiah = "Rp " . number_format($angka);
    $rupiah=str_replace(',', '.', $hasil_rupiah);
    return $rupiah;     
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
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App title -->
    <title>Trippies | Store</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">

    <!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

    <!-- App CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/jquery.steps/demo/css/jquery.steps.css" />
    <script src="assets/js/modernizr.min.js"></script>
</head>
<body>
    <?php 
      include 'menu/header.php';
      $halaman = 32;
      $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
      $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;           
      $getK=$_GET['k'];
      $cari='';
      if ($getK!='all') { 
        $kb=$_GET['k'];
        $query = mysql_query("SELECT id_barang, nama_barang, harga_jual FROM tb_barang WHERE id_kategori='$kb' AND pemilik!='admin' LIMIT $mulai, $halaman")or die(mysql_error); 
        $result = mysql_query("SELECT id_barang FROM tb_barang WHERE id_kategori='$kb' AND pemilik!='admin'");
      } else { 
        $kb='all'; 
        $query = mysql_query("SELECT id_barang, nama_barang, harga_jual FROM tb_barang WHERE pemilik!='admin' LIMIT $mulai, $halaman")or die(mysql_error);
        $result = mysql_query("SELECT id_barang FROM tb_barang WHERE pemilik!='admin'");
      }    

      if (isset($_GET['search'])){        
        $cari=$_GET['search'];
        if ($getK!='all') { 
            $kb=$_GET['k'];
            $query = mysql_query("SELECT id_barang, nama_barang, harga_jual FROM tb_barang WHERE id_kategori='$kb' AND pemilik!='admin' AND nama_barang LIKE '%$cari%' LIMIT $mulai, $halaman")or die(mysql_error); 
            $result = mysql_query("SELECT id_barang FROM tb_barang WHERE id_kategori='$kb' AND pemilik!='admin'");
          } else { 
            $kb='all'; 
            $query = mysql_query("SELECT id_barang, nama_barang, harga_jual FROM tb_barang WHERE pemilik!='admin' AND nama_barang LIKE '%$cari%' LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT id_barang FROM tb_barang WHERE pemilik!='admin'");
          }
      } 

      $total = mysql_num_rows($result);
      $pages = ceil($total/$halaman); 
      $no =$mulai+1;
    ?>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-lg-2">
                        <div class="card-box filter m-t-1">
                            <div class="row"  style="border: 1px solid #e5e5e5; border-radius: 10px;">
                                <div class="col-sm-10">
                                    <div class="row">
                                    <input type="text" id="cari" placeholder="Search..." value="<?=$cari;?>" class="form-control" style="background-color: #fff; color: #000; border: none; border-radius: 10px;">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="row">
                                        <button class="btn form-control" style="border: none;" onclick="cari(<?=$page?>,'<?=$kb;?>',document.getElementById('cari').value)"><span class="fa fa-search"></span></button>
                                    </div>
                                                                        
                                </div>
                            </div>
                        </div>
                        <div class="card-box filter m-t-1">
                            <h4 class="header-title m-t-0 m-b-10" align="center">Filter</h4>
                            <div class="form-group">
                                <label for="exampleSelect1">Kategori</label><br>
                                <?php 
                                    $q1=mysql_query("SELECT * FROM tb_kategori WHERE SUBSTR(id_kategori,1,2)='KB'") or die(mysql_error());
                                    while ($r=mysql_fetch_array($q1)) { ?>
                                    <div class="radio radio-primary">
                                    <input type="radio" name="kb" id="radio" onclick="cekCoba(<?=$page?>,this.value)" value="<?=$r['id_kategori'];?>" <?php if ($kb==$r['id_kategori']) {echo "checked";} else {echo "";}?> >
                                    <label for="radio1"><?=$r['nama_kategori'];?></label>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <button class="btn btn-custom btn-sm form-control m-t-1 waves-effect" onclick="window.location.assign('pasar?page=1&k=all')">Tampilkan Semua</button>
                        </div>

                    </div>
                    <div class="col-sm-10 col-lg-10">
                        <div class="m-t-0">
                                <div class="form-inline">
                                    <div class="row">
                                        <?php 
                                            while ($rBarang = mysql_fetch_array($query)) { 
                                                $idBarang=$rBarang['id_barang'];
                                                $gambar=mysql_fetch_array(mysql_query("SELECT gambar FROM tb_gambar_barang WHERE id_barang='$idBarang' LIMIT 1"));
                                                if (strlen($rBarang['nama_barang'])>25) {
                                                    $namaBarang=str_pad(substr($rBarang['nama_barang'],0,25),30,".");
                                                }else{
                                                    $namaBarang=$rBarang['nama_barang'];
                                                }
                                                ?>                                             
                                                <div class="col-sm-6 col-lg-2 col-xs-6 m-t-1">
                                                    <div class="form-group card" onclick="window.location.assign('detail-store?id=<?=$rBarang['id_barang']?>')">
                                                        <img src="assets/images/b/<?=$gambar['gambar'];?>" class="card-img-top img-thumbnail img-sampul"><br>
                                                        <div class="card-block">
                                                            <p class="card-title"><?=$namaBarang;?></p>
                                                            <p class="card-text"><b><?=rupiah($rBarang['harga_jual']);?></b></p>
                                                            <a href="detail-store?id=<?=$rBarang['id_barang']?>"><button class="btn btn-primary waves-effect waves-light">Detail</button></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-lg-6">                        
                        <div class="m-b-20">
                            <center>
                                <button type="button" class="btn btn-dark waves-effect" onclick="pageBaru(1,'<?=$kb;?>')"><<</button>
                                <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                    <button type="button" class="btn btn-secondary waves-effect" onclick="pageBaru(<?=$i;?>,'<?=$kb;?>')"><?=$i;?></button> 
                                <?php } ?>
                                <button type="button" class="btn btn-dark waves-effect" onclick="pageBaru(<?=$pages;?>,'<?=$kb;?>')">>></button>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                </div>
            </div><!-- end col-->
        </div>
        <!-- Footer -->
            <?php include 'menu/footer.php'; ?>
       <!-- End Footer -->




        <script>
            var resizefunc = [];
            function pageBaru(page, kategori){
                window.location.assign('?page='+page+'&k='+kategori);
            }
            function cekCoba(b,v){
                window.location.assign('?page='+b+'&k='+v);
            }
            function cari(page, kategori, cari){
                window.location.assign('?page='+page+'&k='+kategori+'&search='+cari);
            }
        </script>
        <!-- jQuery  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

    </body>
</html>