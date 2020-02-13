<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div style="word-break:break-word">
		<div style="padding: 20px 20px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:15px;border-radius: 15px;">
			<div style="margin-top:10px!important;padding:10px;margin-top:10px;">
				<center>
					<img class="CToWUd" height="52" src="http://iuts.pkkmart.com/assets/img/logopemprov.png" width="52">
				</center>
				<center>
					<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.8">UNIT PENGELOLA PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU
						KECAMATAN
					</h4>
				</center>
				<table style="width:100%;padding:10px;margin-top:10px;word-break:break-all;word-wrap:break-word;">
					<tr>
						<td colspan="3">
							<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.8">IZIN USAHA TOKO SWALAYAN</h4>
						</td>
					</tr>
					<?php foreach ($datauser->result() as $data): ?>
						
					<tr>
						<td>Nama Perusahaan</td><td style="width: 20px">:</td><td><?=$data->nama_badan_usaha?></td>
					</tr>
					<tr>
						<td>Nama penanggung Jawab dan Jabatan</td><td style="width: 20px">:</td><td><?=$data->nama?> </td>
					</tr>
					<tr>
						<td>Alamat Perusahaan</td><td style="width: 20px">:</td><td><?=$data->alamat_perusahaan?> </td>
					</tr>
					<tr>
						<td>Nama Usaha</td><td style="width: 20px">:</td><td><?=$data->nama_usaha?> </td>
					</tr>
					<tr>
						<td>Alamat Usaha</td><td style="width: 20px">:</td><td><?=$data->alamat?> </td>
					</tr>
					<tr>
						<td>Nomor Telepon/Fax</td><td style="width: 20px">:</td><td><?=$data->no_hp?> </td>
					</tr>
					<tr>
						<td>Luas Lantai Usaha</td><td style="width: 20px">:</td><td><?=$data->luas_lantai?> </td>
					</tr>
					<tr>
						<td>Kegiatan Usaha</td><td style="width: 20px">:</td><td><b>Toko Swalayan</b> </td>
					</tr>
					<tr>
						<td>Barang/Jasa Dagangan Utama</td><td style="width: 20px">:</td><td><?=$data->jasa?> </td>
					</tr>
				</table>
					<?php endforeach ?>
				<!-- Buat Pemohon baru -->
				<p>Izin usaha ini berlaku untuk melakukan kegiatan usaha Toko Swalayan pada 1 (satu) lokasi dan wajib didaftarkan ulang setiap 5 (lima) tahun.</p>
				<p>Setiap perubahan jenis barang/jasa dagangan utama dan luas lantai usaha yang digunakan, terlebih dahulu harus mendapat persetujuan tertulis dari Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi DKI Jakarta.</p>
				<p>Apabila setelah Izin Usaha Toko Swalayan diterbitkan pemegang izin tidak memenuhi persyaratan sebagaimana disebutkan di atas serta tidak memenuhi klausul yang menjadi bagian dari perizinan ini, maka Izin Usaha Toko Swalayan akan ditinjau kembali.</p>
			</div>
		</div>
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
			<p style="float: right;">Ditetapkan di Jakarta</p>

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<?= $data->barcode ?>
			<p style="float: right;">......................</p>
			<p style="float: right;">NIP. ..................</p>
			<center><h4><b>KLAUSUL</b></h4></center>
		</div>
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
			<p>Tembusan :</p>
			<ol>
				<li>Kepala Dinas Koperasi, Usaha Mikro, Kecil dan Menengah, serta Perdagangan Provinsi DKI Jakarta;</li>
				<li>Kepala Satuan Polisi Pamong Praja Provinsi DKI Jakarta;</li>
				<li>Arsip.</li>
			</ol>
		</div>
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
			<p><b>KEWAJIBAN</b></p>
			<ol>
				<?php foreach ($kewajiban->result() as $key): ?>
					
				<li><?=$key->deskripsi?></li>
				<?php endforeach ?>
				
			</ol>
		</div>
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
			<p><b>Larangan</b></p>
			<ol>
				<?php foreach ($larangan->result() as $larang): ?>
					
				<li><?=$larang->deksripsi?></li>
				<?php endforeach ?>
				
			</ol>
		</div>
	</div>

	</body>
	</html>
