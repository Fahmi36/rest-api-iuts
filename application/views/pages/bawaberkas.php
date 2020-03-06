	<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10pt;line-height:1.6;page-break-before: always;">
		<p align="right"><span style="font-weight: bold;">Lampiran I</span>	:<br>
			Keputusan Kepala Unit Pengelola Penanaman<br>
			Modal dan Pelayanan Terpadu Satu Pintu<br>
			Kecamatan ........................<br>
			Nomor	: ......................................<br>
			Tanggal	: .... ................... .....<br>
		</p>
		<p style="font-size:12pt;line-height:1.2;">Kepada pemegang dan/atau penerima Izin Usaha Toko Swalayan ini, dikenakan ketentuan untuk melengkapi berkas yang kurang sebagai berikut :</p>
		<ol style="font-size:12pt;line-height:1.2;">
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
	<div align="right" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;padding-left:20px;display: flex;">
		<table cellpadding="1" style="font-size:12pt;word-break:break-all;word-wrap:break-word;">
			<tr>
				<td></td>
				<td>
					<p align="left">Ditetapkan di Jakarta <br>Pada tanggal .... .................... .....</p>
					<!-- <p align="right" style="text-align: left;float: right;"> </p> -->
					<p align="center"><span>KEPALA UNIT PENGELOLA PENANAMAN <br>MODAL DAN PELAYANAN TERPADU SATU PINTU<br>Kecamatan ………………………..</span></p>
					<div></div><div></div><div></div>
					<p align="center">...........................................<br>
					NIP. ....................................</p>
				</td>
			</tr>
		</table>
	</div>