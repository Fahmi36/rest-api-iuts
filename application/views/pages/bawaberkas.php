<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div align="right" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:15px;page-break-before: always;">
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
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;display: inline-block;">
		<p>Kepada pemegang dan/atau penerima Izin Usaha Toko Swalayan ini, dikenakan ketentuan untuk melengkapi berkas yang kurang sebagai berikut :</p>
		<ol style="padding-left: 16px;">
			<?php foreach ($bawa->result() as $key): ?>
				<?php
				if ($key->skorwarga != '3') {
					echo '<li>Bahwa harus sudah memiliki Surat Keterangan Persetujuan Warga Sekitar paling lambat dalam 3 atau 6 bulan, disesuaikan dengan data yang pemohon ajukan pada persyaratan Persetujuan Warga Sekitar</li>';
				} 

				if ($key->skorrekumkm != '3') {
					echo '<li>Bahwa harus sudah memiliki Surat Keterangan Rekomendasi dari UMKM paling lambat dalam 1 atau 3 bulan, disesuaikan dengan data yang pemohon ajukan pada persyaratan Ada Rekomendasi UMKM.</li>';
				} 
				if ($key->skorkajian != '3') {
					echo '<li>Bahwa harus sudah memiliki Dokumen Kajian Sosial Ekonomi paling lambat dalam 3 bulan.</li>';
				} 

				// if ($key->skortataruang != '3') {
				// 	echo '<li>Silakan Bawa Berkas FOTO LUAR BANGUNAN Ke DPMPTSP</li>';
				// }



				// if ($key->skorpenglahan != '3') {
				// 	echo '<li>Silakan Bawa Berkas IZIN MENDIRIKAN BANGUNAN Ke DPMPTSP</li>';
				// }

				// if ($key->skorjarakusaha != '3') {
				// 	echo '<li>Silakan Bawa Berkas SERTIFIKAT LAYAK FUNGSI Ke DPMPTSP</li>';
				// } 

				// if ($key->skorjarakpasar != '3') {
				// 	echo '<li>Silakan Bawa Berkas Rekomendasi dari Dinas Penanggunlangan Kebakaran dan Penyelamatan Ke DPMPTSP</li>';
				// } 
				// if ($key->skorpempbb != '3') {
				// 	echo '<li>Silakan Bawa Berkas KTP Ke DPMPTSP</li>';
				// } 

				// if ($key->skorketumkm != '3') {
				// 	echo '<li>Silakan Bawa Berkas NPWP Ke DPMPTSP</li>';
				// }
				?>
			<?php endforeach ?>
			<li style="text-align:justify;">Bahwa penetapan tenggat waktu terhitung sejak Surat Keputusan Izin Usaha Toko Swalayan ini diberikan kepada orang yang mengajukan permohonan dan tertanda pada Surat Keputusan Izin Usaha Toko Swalayan ini.</li>
			<li style="text-align:justify;">Terhadap tidak dipenuhi ketentuan-ketentuan sebagaimana tersebut di atas maka Pihak Berwenang, dalam hal ini PMPTSP DKI Jakarta, berhak mencabut Surat Keputusan Izin Usaha Toko Swalayan ini.</li>
		</ol>
	</div>
	<div align="right" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;">
		<div style="float: right;">
			<p style="float: right;">Ditetapkan di Jakarta <br>
				pada tanggal ...... ..................... …… <br><br>
				<span style="text-align: center;float: right;">KEPALA UNIT PENGELOLA PENANAMAN <br> MODAL DAN PELAYANAN TERPADU SATU<br>PINTU<br>Kecamatan ………………………..</span><br>
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
</body>
</html>
