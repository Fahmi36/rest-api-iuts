<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div style="word-break:break-word">
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
			<p><b>Berkas yang harus di bawa</b></p>
			<?php foreach ($bawa->result() as $key): ?>
				<?php
				if ($key->fotoktp == '2') {
					echo '<p>Silakan Bawa Berkas KTP Ke DPMPTSP</p>';
				} 

				if ($key->fotonpwp == '2') {
					echo '<p>Silakan Bawa Berkas NPWP Ke DPMPTSP</p>';
				}


				if ($key->fotoakta == '2') {
					echo '<p>Silakan Bawa Berkas FOTO AKTA PERUSAHAAN Ke DPMPTSP</p>';
				} 


				if ($key->fotoluar == '2') {
					echo '<p>Silakan Bawa Berkas FOTO LUAR BANGUNAN Ke DPMPTSP</p>';
				}

				if ($key->fotodalam == '2') {
					echo '<p>Silakan Bawa Berkas FOTO DALAM BANGUNAN Ke DPMPTSP</p>';
				} 


				if ($key->fotoimb == '2') {
					echo '<p>Silakan Bawa Berkas IZIN MENDIRIKAN BANGUNAN Ke DPMPTSP</p>';
				}

				if ($key->fotoslf == '2') {
					echo '<p>Silakan Bawa Berkas SERTIFIKAT LAYAK FUNGSI Ke DPMPTSP</p>';
				} 


				if ($key->fotodamkar == '2') {
					echo '<p>Silakan Bawa Berkas Rekomendasi dari Dinas Penanggunlangan Kebakaran dan Penyelamatan Ke DPMPTSP</p>';
				} 


				if ($key->fototkt == '2') {
					echo '<p>Silakan Bawa Berkas Rekomendasi dari Dinas Tenaga Kerja dan Transmigrasi Ke DPMPTSP</p>';
				} 


				if ($key->fotoasuransi == '2') {
					echo '<p>Silakan Bawa Berkas Berkas Asuransi Toko Ke DPMPTSP</p>';
				}

				if ($key->fotopbb == '2') {
					echo '<p>Silakan Bawa Berkas Bukti Pemutahiran PBB Ke DPMPTSP</p>';
				}

				if ($key->fotoperw == '2') {
					echo '<p>Silakan Bawa Berkas Persetujuan Warga Ke DPMPTSP</p>';
				} 


				if ($key->fotorekumkm == '2') {
					echo '<p>Silakan Bawa Berkas UMKM Ke DPMPTSP</p>';
				} 

				if ($key->fotokajian == '2') {
					echo '<p>Silakan Bawa Berkas Kajian Sosek Ke DPMPTSP</p>';
				}
				?>
			<?php endforeach ?>

		</ol>
	</div>
</div>

</body>
</html>
