<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div style="text-align:left;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;page-break-before: always;">
			<p style="text-align:left;float: right;font-size: 10pt;">Lampiran VI	:<br>
				Keputusan Kepala Unit Pengelola Penanaman<br>
				Modal dan Pelayanan Terpadu Satu Pintu<br>
				Kecamatan ........................<br>
				Nomor	: ......................................<br>
				Tanggal	: .... ................... .....<br>
			</p>
			<br><br><br>
			<p style="font-size: 12pt;">Kepada pemegang dan/atau penerima Sertifikat Layak Fungsi ini, dikenakan ketentuan sebagai berikut :</p>
	</div>
	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px;display: inline-block;">
		<p>Kepada pemegang dan/atau penerima Izin Usaha Toko Swalayan ini, dikenakan ketentuan untuk melengkapi berkas yang kurang sebagai berikut :</p>
		<ol style="padding-left: 16px;">
			<?php foreach ($bawa->result() as $key): ?>
				<?php
				if ($key->skorkondisikdh != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Koefisien Dasar Hijau (KDH) hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3 bulan.</li>';
				} 

				if ($key->skorkondisisumur != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki sumur resapan yang sesuai dengan ketentuan yang tercantum pada Peraturan Gubernur Provinsi DKI Jakarta Nomor 20 Tahun 2013 paling lambat dalam 3 bulan.</li>';
				} 
				if ($key->skorpetandaan != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Kondisi Pertandaan Toko hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				} 

				if ($key->skordrainase != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Drainase Sekeliling Tapak hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				}

				if ($key->skorimb != '3') {
					echo '<li style="text-align:justify;">Bahwa harus sudah memiliki Izin Mendirikan Bangunan paling lambat dalam 12 bulan.</li>';
				}
				if ($key->skordamkar != '3') {
					echo '<li style="text-align:justify;">Bahwa harus sudah memiliki dokumen Rekomendasi dari Dinas Penanggulangan Kebakaran dan Penyelamatan paling lambat dalam 6 bulan.</li>';
				} 

				if ($key->skortkt != '3') {
					echo '<li style="text-align:justify;">Bahwa harus sudah memiliki dokumen Rekomendasi dari Dinas Tenaga Kerja dan Transmigrasi paling lambat dalam 6 bulan.</li>';
				} 
				if ($key->skorfdamkar != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Fasilitas Penanggulangan Kebakaran hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				} 
				if ($key->skorasuransi != '3') {
					echo '<li style="text-align:justify;">Bahwa harus sudah memiliki Asuransi Toko paling lambat dalam 12 bulan.</li>
				';
				}
				if ($key->skorketersediaan != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Ketersediaan Air Bersih hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				}
				if ($key->skorlimbah != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Pengelolaan Air Kotor/Limbah hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				}
				if ($key->skorsampah != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Pengelolaan Sampah hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				}
				if ($key->skorlistrik != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Ketersediaan Listrik hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				}
				if ($key->skortoilet != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Ketersediaan Toilet hingga memenuhi ketentuan yang telah ditetapkan paling lambat dalam 3  bulan.</li>';
				}
				if ($key->skorparkir != '3') {
					echo '<li style="text-align:justify;">Bahwa harus menyediakan dan atau memperbaiki Ketersediaan Parkir yang sesuai dengan ketentuan yang tercantum pada Peraturan Presiden  Republik Indonesia Nomor  112 Tahun 2007 tentang Penataan dan Pembinaan Pasar Tradisional Pusat Perbelanjaan dan Toko Modern paling lambat dalam 3 bulan.</li>
				';
				}
				?>
			<?php endforeach ?>
				<li style="text-align:justify;">Bahwa penetapan tenggat waktu terhitung sejak Surat Keputusan Sertifikat Layak Fungsi ini diberikan kepada orang yang mengajukan permohonan dan tertanda pada Surat Keputusan Sertifikat Layak Fungsi ini.</li>
				<li style="text-align:justify;">Terhadap tidak dipenuhi ketentuan-ketentuan sebagaimana tersebut di atas maka Pihak Berwenang, dalam hal ini PMPTSP DKI Jakarta, berhak mencabut Sertifikat Layak Fungsi ini.</li>
		</ol>
	</div>
	<br>
			<p align="right" style="text-align:left;float: right;font-size: 12pt;">Ditetapkan di Jakarta </p>
			<p align="right" style="text-align:left;float: right;font-size: 12pt;">pada tanggal ..................... </p>
			<p><span align="right" style="float: right;">KEPALA UNIT PENGELOLA PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU<br> KECAMATAN ................... </span><br>
			</p>
			<br><br><br><br><br><br><br><br><br><br>
			<p align="right" style="float: right;padding-right: 40px;">...........................................<br>
			NIP. ....................................</p><br>
</body>
</html>
