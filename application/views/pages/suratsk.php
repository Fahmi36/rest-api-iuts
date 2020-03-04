<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="overflow-x: hidden;">
	<div style="word-break:break-word">
		<div style="padding: 20px 20px 0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:15px;border-radius: 15px;">
			<div style="margin-top:10px!important;padding:10px;margin-top:10px;">
				<center align="center">
					<img class="CToWUd" height="52" src="<?=base_url('assets/img/logopemprov.png')?>" style="width: 100px;height: 100px;margin-top: -40px;">
				</center>
				<br>
				<center>
					<h4 align="center" style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14pt;line-height:1.2;">UNIT PENGELOLA PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU
						<br>KECAMATAN ……………………
					</h4>
				</center>
				<table style="width:100%;padding:10px;font-size:12pt;margin-top:10px;word-break:break-all;word-wrap:break-word;">
					<tr>
						<td colspan="3">
							<center>
								<h4 align="center" style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;line-height:1.2;margin-bottom: 20px;">IZIN USAHA TOKO SWALAYAN <br>
									<span style="font-weight: 400;">NOMOR .....................................</span><br>
								</h4>
							</center>
						</td>
					</tr>
					<?php foreach ($datauser->result() as $data): ?>		
						<tr>
							<td>Nama Perusahaan</td><td>:</td><td><?=$data->nama_badan_usaha?></td>
						</tr>
						<tr>
							<td>Nama penanggung Jawab dan Jabatan</td><td>:</td><td><?=$data->nama?> </td>
						</tr>
						<tr>
							<td>Alamat Perusahaan</td><td>:</td><td><?=$data->alamat_perusahaan?> </td>
						</tr>
						<tr>
							<td>Nama Usaha</td><td>:</td><td><?=$data->nama_toko?> </td>
						</tr>
						<tr>
							<td>Alamat Usaha</td><td>:</td><td><?=$data->alamat_usaha?> </td>
						</tr>
						<tr>
							<td>Nomor Telepon/Fax</td><td>:</td><td><?=$data->no_hp?> </td>
						</tr>
						<tr>
							<td>Luas Lantai Usaha</td><td>:</td><td><?=$data->luas_tapak?> </td>
						</tr>
						<tr>
							<td>Kegiatan Usaha</td><td>:</td><td><b>Toko Swalayan</b> </td>
						</tr>
						<!-- <tr>
							<td>Barang/Jasa Dagangan Utama</td><td>:</td><td><?=$data->jasa?> </td>
						</tr> -->
					<?php endforeach ?>
				</table>
				<!-- Buat Pemohon baru -->
				<p style="text-align:justify;font-size: 12pt;">Izin usaha ini berlaku untuk melakukan kegiatan usaha Toko Swalayan pada 1 (satu) lokasi dan wajib didaftarkan ulang setiap 5 (lima) tahun.</p>
				<p style="text-align:justify;font-size: 12pt;">Setiap perubahan jenis barang/jasa dagangan utama dan luas lantai usaha yang digunakan, terlebih dahulu harus mendapat persetujuan tertulis dari Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi DKI Jakarta.</p>
				<p style="text-align:justify;font-size: 12pt;margin-bottom: 10px;">Apabila setelah Izin Usaha Toko Swalayan diterbitkan pemegang izin tidak memenuhi persyaratan sebagaimana disebutkan di atas serta tidak memenuhi klausul yang menjadi bagian dari perizinan ini, maka Izin Usaha Toko Swalayan akan ditinjau kembali.</p>
			</div>
		</div>
		<div align="right" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;display: flex;">
			<div style="width: 50%;">
				<tcpdf method="write1DBarcode" params="<?= $data->barcode ?>" />
				</div>
				<div style="width: 50%;float: right;">
					<p align="right" style="text-align:left;float: right;margin: 0;">Ditetapkan di Jakarta</p>
					<p align="right" style="text-align: left;">pada tanggal ...... ..................... …… </p>
					<p align="right"><span style="text-align: center;float: right;margin-top: 8pt;">KEPALA UNIT PENGELOLA PENANAMAN MODAL<br> dan PELAYANAN TERPADU SATU PINTU<br>Kecamatan ………………………..</span><br>
					</p>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<p style="float: right;padding-right: 40px;">...........................................<br>
					NIP. ....................................</p>
				</div>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;width: 100%;">
				<p style="margin: 0;">Tembusan :</p>
				<ol style="padding-left: 16px;margin: 0;">
					<li>Kepala Dinas Koperasi, Usaha Mikro, Kecil dan Menengah, serta Perdagangan Provinsi DKI Jakarta;</li>
					<li>Kepala Satuan Polisi Pamong Praja Provinsi DKI Jakarta;</li>
					<li>Arsip.</li>
				</ol>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:11pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
				<center><h4 style="margin: 0;"><b>KLAUSUL</b></h4></center>
				<p>KEWAJIBAN</p>
				<ol style="padding-left: 16px;">
					<?php foreach ($kewajiban->result() as $key): ?>

						<li><?=$key->deskripsi?></li>
					<?php endforeach ?>

				</ol>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:11pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;">
				<p>Larangan</p>
				<ol style="padding-left: 16px;">
					<?php foreach ($larangan->result() as $larang): ?>

						<li><?=$larang->deksripsi?></li>
					<?php endforeach ?>

				</ol>
			</div>
		</div>
	</body>
	</html>