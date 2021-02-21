<?php 
include '../database/koneksi.php'; 
function rupiah($angka){    
    $hasil_rupiah = "Rp " . number_format($angka);
    return str_replace(',', '.', $hasil_rupiah);     
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
        <title>Update Iklan</title>

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

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <h4 class="page-title">Update Harga</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="POST" action="proses-iklan">                                        
                                    <label>Iklan Pop Up</label><hr>
                                    <?php 
                                        $popUp=mysql_fetch_array(mysql_query("SELECT * FROM tb_iklan WHERE id_iklan='IK1'"));
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Kode Iklan</label>
                                                <input type="text" name="kdIklan" class="form-control" value="<?=$popUp['id_iklan'];?>" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Nama Iklan</label>
                                                <input type="text" name="nmIklan" class="form-control" value="<?=$popUp['nama_iklan'];?>" readonly>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Ukuran (px)</label>
                                                <input type="text" name="ukIklan" class="form-control" value="<?=$popUp['ukuran'];?>" readonly>
                                            </div> 
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Size (MB)</label>
                                                <input type="text" name="usIklan" value="<?=$popUp['size']." MB";?>" class="form-control" readonly>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Lihat Iklan</label>
                                                <button type="button" class="form-control btn btn-dark waves-effect waves-light" data-toggle="modal" data-target='#iklanPopUp'>Lihat Iklan</button>
                                            </div> 
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Harga / Hari</label>
                                                <input type="text" name="hgIklan" value="<?=rupiah($popUp['harga']);?>" class="form-control">
                                            </div>                                            
                                        </div>
                                    </div>
                                    <button type="submit" name="update" class="form-control btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                    <div class="m-t-3">
                                        <form method="POST" action="proses-iklan">
                                            <label>Iklan Pop Up</label><hr>
                                            <?php 
                                                $footer=mysql_fetch_array(mysql_query("SELECT * FROM tb_iklan WHERE id_iklan='IK3'"));
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Kode Iklan</label>
                                                        <input type="text" name="kdIklan" class="form-control" value="<?=$footer['id_iklan'];?>" readonly>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Nama Iklan</label>
                                                        <input type="text" name="nmIklan" class="form-control" value="<?=$footer['nama_iklan'];?>" readonly>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Ukuran (px)</label>
                                                        <input type="text" name="ukIklan" class="form-control" value="<?=$footer['ukuran'];?>" readonly>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Size (MB)</label>
                                                        <input type="text" name="usIklan" value="<?=$footer['size']." MB";?>" class="form-control" readonly>
                                                    </div>                                           
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Lihat Iklan</label>
                                                        <button type="button" class="form-control btn btn-dark waves-effect waves-light" data-toggle="modal" data-target='#iklanFooter'>Lihat Iklan</button>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Harga / Hari</label>
                                                        <input type="text" name="hgIklan" value="<?=rupiah($footer['harga']);?>" class="form-control">
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <button type="submit" name="update" class="form-control btn btn-primary waves-effect waves-light">Update</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <form method="POST" action="proses-iklan">
                                        <label>Iklan Slider</label><hr>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Nama Iklan</label>
                                                    <input type="text" name="nmIklan" id="nmIklan1" class="form-control" placeholder="Silahkan Pilih Kode Iklan" readonly>
                                                </div> 
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Kode Iklan</label>
                                                    <select name="kdIklan" class="form-control" onchange="prosesIklan(this.value)">
                                                        <option value=0 disabled selected>--Pilih--</option>
                                                        <?php
                                                            $iklan=mysql_query("SELECT * FROM tb_iklan WHERE SUBSTR(id_iklan, 1, 3)='IK2'");
                                                            $dtiklan = "var dtiklan = new Array();\n";
                                                            while ($hasil=mysql_fetch_array($iklan)) {
                                                            $dtiklan .= "dtiklan['" . $hasil['id_iklan'] . "'] = {namaIklan:'" . addslashes($hasil['nama_iklan']) . "',hargaIklan:'" . addslashes($hasil['harga']) . "',ukuranIklan:'" . addslashes($hasil['ukuran']) . "',sizeIklan:'" . addslashes($hasil['size']) . "'};\n";
                                                        ?>
                                                        <option value="<?php echo $hasil['id_iklan'];?>"><?php echo $hasil['id_iklan']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Size (MB)</label>
                                                    <input type="text" name="usIklan" id="usIklan1" class="form-control" placeholder="Silahkan Pilih Kode Iklan" readonly>
                                                </div> 
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Ukuran (px)</label>
                                                    <input type="text" name="ukIklan" id="ukIklan1" class="form-control" placeholder="Silahkan Pilih Kode Iklan" readonly>
                                                </div>                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Harga / Hari</label>
                                                    <input type="text" name="hgIklan" id="hgIklan1" placeholder="Silahkan Pilih Kode Iklan" class="form-control">
                                                </div> 
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Lihat Iklan</label>
                                                    <button type="button" class="form-control btn btn-dark waves-effect waves-light" data-toggle="modal" data-target='#iklanSlider'>Lihat Iklan</button>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <button type="submit" name="update"  class="form-control btn btn-primary waves-effect waves-light">Update</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                <!-- end row -->

                <!-- Footer -->
                <?php include 'menu/footer.php'; ?>
                <!-- End Footer -->

            </div> <!-- container -->
        </div> <!-- End wrapper -->
        <div class="modal fade modal-custom" id="iklanPopUp">
            <div class="modal-dialog">
              <div class="modal-content modal-content-custom">      
                <!-- Modal Header -->                
                <!-- Modal body -->
                <div class="modal-body ">
                    <h5 class="text-xs-center">Iklan Popup</h5>
                    <img src="../assets/images/iklan/011020181.jpg" class="iklan-img img-responsive">
                </div>             
              </div>
            </div>
        </div>
        <div class="modal fade modal-custom" id="iklanFooter">
            <div class="modal-dialog">
              <div class="modal-content modal-content-custom">      
                <!-- Modal Header -->                
                <!-- Modal body -->
                <div class="modal-body ">
                    <h5 class="text-xs-center">Iklan Footer</h5>
                    <div class="row">
                        <div class="col-sm-2 col-xs-4 col-lg-4">
                        <div class="card card-inverse">
                            <img class="card-img img-fluid" src="../assets/images/gallery/2.jpg" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2 col-xs-4 col-lg-4">
                        <div class="card card-inverse">
                            <img class="card-img img-fluid" src="../assets/images/gallery/2.jpg" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2 col-xs-4 col-lg-4">
                        <div class="card card-inverse">
                            <img class="card-img img-fluid" src="../assets/images/gallery/2.jpg" alt="Card image">
                            <div class="card-img-overlay">
                                <h4 class="card-title">Card title</h4>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>             
              </div>
            </div>
        </div>
        <div class="modal fade modal-custom" id="iklanSlider">
            <div class="modal-dialog">
              <div class="modal-content modal-content-custom">      
                <!-- Modal Header -->                
                <!-- Modal body -->
                <div class="modal-body ">
                    <h5 class="text-xs-center">Iklan Slider</h5>
                    <div class="card card-inverse">
                        <div id="carousel-example-captions" data-ride="carousel" class="carousel slide slide-img">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="1"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="2"></li>
                                <li data-target="#carousel-example-captions" data-slide-to="3"></li>
                            </ol>
                            <div role="listbox" class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../assets/images/gallery/3.jpg" alt="First slide image" class="filter">
                                    <div class="carousel-caption">
                                        <h3 class="text-white font-600">First slide label</h3>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/images/gallery/8.jpg" alt="Second slide image" class="filter">
                                    <div class="carousel-caption">
                                        <h3 class="text-white font-600">Second slide label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/images/gallery/12.jpg" alt="Third slide image" class="filter">
                                    <div class="carousel-caption">
                                        <h3 class="text-white font-600">Third slide label</h3>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../assets/images/gallery/8.jpg" alt="Fourth slide image">
                                    <div class="carousel-caption">
                                        <h3 class="text-white font-600">Fourth slide label</h3>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a>
                            <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a>
                        </div>
                    </div>
                </div>             
              </div>
            </div>
        </div>
        <script>
            var resizefunc = [];
            <?php
                echo $dtiklan;
            ?>
            function prosesIklan(id){
                if (id == 0){
                document.getElementById('nmIklan1').value = ""; 
                } else {
                document.getElementById('nmIklan1').value = dtiklan[id].namaIklan;
                document.getElementById('ukIklan1').value = dtiklan[id].ukuranIklan;
                document.getElementById('usIklan1').value = dtiklan[id].sizeIklan+" MB";
                document.getElementById('hgIklan1').value = formatRupiah(dtiklan[id].hargaIklan, 'Rp '); 
                }
            }
            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
             
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
             
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
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

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>
</html>