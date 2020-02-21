<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="overflow-x: hidden;">
	<div style="word-break:break-word">
		<div style="padding: 20px 20px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:15px;border-radius: 15px;">
			<div style="margin-top:10px!important;padding:10px;margin-top:10px;">
				<center>
					<img class="CToWUd" height="52" src="../../../assets/img/logopemprov.png" style="width: 100px;height: 100px;">
				</center>
				<br>
				<center>
					<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.2">UNIT PENGELOLA PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU
						<br>KECAMATAN ……………………
					</h4>
				</center>
				<table style="width:100%;padding:10px;margin-top:10px;word-break:break-all;word-wrap:break-word;">
					<tr>
						<td colspan="3">
							<center>
								<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.2;margin-bottom: 20px;">IZIN USAHA TOKO SWALAYAN <br>
									NOMOR .....................................<br>
								</h4>
							</center>
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
					<?php endforeach ?>
				</table>
				<!-- Buat Pemohon baru -->
				<p style="text-align:justify;">Izin usaha ini berlaku untuk melakukan kegiatan usaha Toko Swalayan pada 1 (satu) lokasi dan wajib didaftarkan ulang setiap 5 (lima) tahun.</p>
				<p style="text-align:justify;">Setiap perubahan jenis barang/jasa dagangan utama dan luas lantai usaha yang digunakan, terlebih dahulu harus mendapat persetujuan tertulis dari Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi DKI Jakarta.</p>
				<p style="text-align:justify;">Apabila setelah Izin Usaha Toko Swalayan diterbitkan pemegang izin tidak memenuhi persyaratan sebagaimana disebutkan di atas serta tidak memenuhi klausul yang menjadi bagian dari perizinan ini, maka Izin Usaha Toko Swalayan akan ditinjau kembali.</p>
			</div>
		</div>
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;display: flex;">
			<div style="width: 50%;">
				<tcpdf method="write2DBarcode" params="<?= $data->barcode ?>" />
				</div>
				<div style="width: 50%;float: right;">
					<p style="float: right;">Ditetapkan di Jakarta <br>
						pada tanggal ...... ..................... …… <br><br>
						<span style="text-align: center;">Kepala Unit Pengelola Penanaman Modal<br> dan PTSP</span><br>
						Kecamatan ...... ..................... ……
					</p>
					<br>
					<br>
					<br>
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
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;width: 100%;">
				<p>Tembusan :</p>
				<ol style="padding-left: 16px;">
					<li>Kepala Dinas Koperasi, Usaha Mikro, Kecil dan Menengah, serta Perdagangan Provinsi DKI Jakarta;</li>
					<li>Kepala Satuan Polisi Pamong Praja Provinsi DKI Jakarta;</li>
					<li>Arsip.</li>
				</ol>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
				<center><h4><b>KLAUSUL</b></h4></center>
				<p><b>KEWAJIBAN</b></p>
				<ol>
					<?php foreach ($kewajiban->result() as $key): ?>

						<li><?=$key->deskripsi?></li>
					<?php endforeach ?>

				</ol>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;">
				<p><b>Larangan</b></p>
				<ol>
					<?php foreach ($larangan->result() as $larang): ?>

						<li><?=$larang->deksripsi?></li>
					<?php endforeach ?>

				</ol>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;">
				<div style="float: right;">
					<p style="float: right;"><span style="font-weight: bold;">Lampiran I</span>	:<br>
						Keputusan Kepala Unit Pengelola Penanaman<br>
						Modal dan Pelayanan Terpadu Satu Pintu<br>
						Kecamatan ........................<br>
						Nomor	: ......................................<br>
						Tanggal	: .... ................... .....<br>
					</p>
				</div>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;display: inline-block;">
				<p>Kepada pemegang dan/atau penerima Izin Usaha Toko Swalayan ini, dikenakan ketentuan untuk melengkapi berkas yang kurang sebagai berikut :</p>
				<ol style="padding-left: 16px;">
					<li style="text-align:justify;">Bahwa harus sudah memiliki Surat Keterangan Persetujuan Warga Sekitar paling lambat dalam 3 atau 6 bulan, disesuaikan dengan data yang pemohon ajukan pada persyaratan Persetujuan Warga Sekitar.</li>
					<li style="text-align:justify;">Bahwa harus sudah memiliki Surat Keterangan Rekomendasi dari UMKM paling lambat dalam 1 atau 3 bulan, disesuaikan dengan data yang pemohon ajukan pada persyaratan Ada Rekomendasi UMKM.</li>
					<li style="text-align:justify;">Bahwa harus sudah memiliki Dokumen Kajian Sosial Ekonomi paling lambat dalam 3 bulan.</li>
					<li style="text-align:justify;">Bahwa penetapan tenggat waktu terhitung sejak Surat Keputusan Izin Usaha Toko Swalayan ini diberikan kepada orang yang mengajukan permohonan dan tertanda pada Surat Keputusan Izin Usaha Toko Swalayan ini.</li>
					<li style="text-align:justify;"	>Terhadap tidak dipenuhi ketentuan-ketentuan sebagaimana tersebut di atas maka Pihak Berwenang, dalam hal ini PMPTSP DKI Jakarta, berhak mencabut Surat Keputusan Izin Usaha Toko Swalayan ini.</li>
				</ol>
			</div>
			<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;">
				<div style="float: right;">
					<p style="float: right;">Ditetapkan di Jakarta <br>
						pada tanggal ...... ..................... …… <br><br>
						<span style="text-align: center;">Kepala Unit Pengelola Penanaman Modal<br> dan PTSP</span><br>
						Kecamatan ...... ..................... ……
					</p>
					<br>
					<br>
					<br>
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
		</div>

	</body>
	</html>
