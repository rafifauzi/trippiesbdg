<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="kodingkita" content="Trippies">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style-custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/css/alertify.min.css" type='text/css' />
		<script src="assets/js/alertify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/plugins/jquery.steps/demo/css/jquery.steps.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
		<title>Trippies | Register</title>
</head>
<body>
	<div class="m-t-0">
        <div class="container">

		<h2 class="bg-logo m-t-1" align="center" onclick="window.location.assign('index');"><img src="assets/images/logo.png" width="200"></h2>
		<h4 class="header-title m-t-1" align="center">Join for free</h4>
        	<div class="card-box">
		<div class="form-registera">
			<form method="POST" name="register" action="proses_register.php">
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="form-group">							
							<label>Name</label>
							<input type="text" name="firstName" placeholder="First Name" class="form-control" required autocomplete="off" autofocus>							
							<input type="text" name="lastName" placeholder="Last Name" class="form-control m-t-1" required autocomplete="off">
						</div>
						<div class="form-group">						
							<label>Gender</label>				
							<select name="gender" placeholder="Gender" class="form-control select" required>
								<option value="" disabled selected>Gender</option>
								<option value="1">Pria</option>
								<option value="0">Wanita</option>
							</select>
						</div>
						<div class="form-group">							
							<label>Birthday</label>
							<select name="day" class="form-control select" required  autofocus>
								<option value="" disabled selected>Day</option>
								<?php 
									for ($i=1; $i<=31 ; $i++) { ?> 
									<option value="<?=$i;?>"><?=$i;?></option>
									<?php
									}
								?>
							</select>
							<select name="month" class="form-control select" required>
								<option value="" disabled selected>Month</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
							<select name="year" class="form-control select" required>
						    		<option value="" disabled selected>Year</option>
						    		<?php 
						    		$dateY=date("Y")-17;
						    		for ($i=1960; $i<=$dateY; $i++) { ?>
						    			<option><?=$i;?></option>
						    		<?php
						    		}
						    		?>
						  	</select>
						</div>	
<!-- 						<div class="form-group">							
							<label>Kecamatan</label>
							<input type="text" name="kecamatan" placeholder="Kecamatan" class="form-control" required autocomplete="off">
						</div> -->

						<?php
									//Get Data Kabupaten
									$curl = curl_init();
									curl_setopt_array($curl, array(
										CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => "",
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 30,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => "GET",
										CURLOPT_HTTPHEADER => array(
											"key:40f0a9630accaaeb348c41b1cbfdd36a"
										),
									));

									$response = curl_exec($curl);
									$err = curl_error($curl);

									curl_close($curl);
									echo "
									<div class= \"form-group\">
									<label for=\"asal\">Kota/Kabupaten Asal </label>
									<select class=\"form-control\" name='kecamatan' id='asal' onchange='ambilKota(this.value)'>";
									echo "<option>Pilih Kota Asal</option>";
									$data = json_decode($response, true);
									for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
										echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
									}
									echo "</select>
									</div>";
							?>
						<input type="hidden" name="nmKota" id="nmKota">
						<div class="form-group">							
							<label>Kode Pos</label>
							<input type="number" name="kodepos" placeholder="Kode POS" class="form-control" required autocomplete="off">
						</div>			
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="form-group">						
							<label>Alamat Lengkap</label>		
							<textarea name="place" class="form-control" id="exampleTextarea" rows="4" style="resize: none; padding-bottom: 20px;" placeholder="Alamat Detail"></textarea>
						</div>
						<div class="form-group">						
							<label>Phone Number</label>
							<input type="number" name="no_hp" placeholder="No Handphone" class="form-control" required autocomplete="off">
						</div>				
						<div class="form-group">						
							<label>Account</label>
							<input type="text" name="username" placeholder="Username" class="form-control" required autocomplete="off">
							<input type="email" name="email" placeholder="Email" class="form-control m-t-1" required autocomplete="off">
							<div ng-app="myapp" class="m-t-1">
						        <div ng-controller="PasswordController">
						                <input type="password" ng-model="password" maxlength="8"  ng-change="analyze(password)" ng-style="passwordStrength" name="password" class="form-control" placeholder="Password" id="password">
						                <small class="text-muted">* Password Harus 8 Karakter</small>
						        </div>
						    </div>
						</div>
						<center>
							<div class="row">
								<div class="col-sm-12 col-lg-4">									
									<button type="submit" name="register" value="JOIN" class="btn form-control btn-primary waves-effect waves-light">Join</button>
								</div>
								<div class="col-sm-12 col-lg-4">								
									<span>atau Anda Sudah Memiliki Akun ?</span>
								</div>
								<div class="col-sm-12 col-lg-4">									
									<button name="register" value="login" class="btn form-control btn-success waves-effect waves-light" onclick="login();">Login</button>
								</div>
							</div>
						</center>
					</div>
				</div>
			</form>			
		</div>
	</div>
        </div>
    </div>
    	<script>
            var resizefunc = [];
            function login(){
            	window.location.assign('login');
            }
            var myApp = angular.module("myapp", []);
            myApp.controller("PasswordController", function($scope) {

                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                $scope.passwordStrength = {
                    "width": "100%"
                };

                $scope.analyze = function(value) {
                	var panjang=value.length;
                	if (panjang<=8&&panjang>0) {
	                    if(strongRegex.test(value)) {
	                        $scope.passwordStrength["background-color"] = "#CCFF90";
                            $scope.passwordStrength["border-color"] = "#CCFF90";
	                        scope.passwordStrength["color"] = "#000";
	                        $scope.passwordStrength["display"] = "block";
	                    } else if(mediumRegex.test(value)) {
                            $scope.passwordStrength["background-color"] = "#F4FF81";
                            $scope.passwordStrength["border-color"] = "#F4FF81";
                            scope.passwordStrength["color"] = "#000";
                            $scope.passwordStrength["display"] = "block";
                        } else {
                           $scope.passwordStrength["background-color"] = "#EF9A9A";
                           $scope.passwordStrength["border-color"] = "#EF9A9A";
                           $scope.passwordStrength["color"] = "#000";
                           $scope.passwordStrength["display"] = "block";
                        }
                	}else{
                		alertify.alert("Password Minimal 8 Karakter", function(){ 
                			document.getElementById('password').value=''; 
                		}).setHeader(' ').set({closable:false,transition:'pulse'});
                	}
                };

            });

            function ambilKota(id){
            	var a = $("#asal option[value="+id+"]").text();
            	document.getElementById('nmKota').value=a;
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
<!-- <script type="text/javascript">
	function cekPass(password){
		var Lpass=password.length;
		if (Lpass!=8) {
			alertify.set('notifier','position', 'top-center');
			alertify.error('Password Harus 8 Karakter');
		}
	}
</script> -->
</html>