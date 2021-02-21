<?php
	$asal = $_POST['asal'];
	$id_kabupaten = $_POST['kab_id'];
	$kurir = $_POST['kurir'];
	$berat = $_POST['berat'];

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key:40f0a9630accaaeb348c41b1cbfdd36a"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  $data = json_decode($response, true);
	}
	?>
	<div style="display: none;">
	<?php echo $data['rajaongkir']['origin_details']['city_name'];?> ke <?php echo $data['rajaongkir']['destination_details']['city_name'];?> @<?php echo $berat;?>gram Kurir : <?php echo strtoupper($kurir); ?>
	</div>
	<?php
	 for ($k=0; $k < count($data['rajaongkir']['results']); $k++) {
	?>
		 <div title="<?php echo strtoupper($data['rajaongkir']['results'][$k]['name']);?>" class="m-t-1">
			<?php
			echo "
			 <div class= \"form-group\">
										
				<select class=\"form-control\" name='kurir' id='harga' onchange='hitungOngkir(this.value)'>";
					echo "<option value='0' disabled selected >Pilih harga</option>";
					$data = json_decode($response, true);
					for ($l=0; $l < count($data['rajaongkir']['results'][$k]['costs']); $l++) { ?>
						<option value="<?=$data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value'];?>"><?=$data['rajaongkir']['results'][$k]['costs'][$l]['service']." - Rp ".str_replace(',', '.', number_format($data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']));?></option>
					<?php
					}
					echo "</select>
					<input type='hidden' name='ongkir' id='hargaOngkir'>
				</div>";
				?>
		 </div>
	 <?php
	 }
	 ?>
