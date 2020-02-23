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
					<?php if ($key->fotoktp == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoktp == '2') {
						echo '<p>Silakan Bawa Berkas KTP Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fotonpwp == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotonpwp == '2') {
						echo '<p>Silakan Bawa Berkas NPWP Ke DPMPTSP</p>';
					}else {
						echo '<p>Tidak ada Berkas</p>';
					}

					if ($key->fotoakta == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoakta == '2') {
						echo '<p>Silakan Bawa Berkas FOTO AKTA PERUSAHAAN Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fotoluar == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoluar == '2') {
						echo '<p>Silakan Bawa Berkas FOTO LUAR BANGUNAN Ke DPMPTSP</p>';
					}else {
						echo '<p>Tidak ada Berkas</p>';
					}
					if ($key->fotodalam == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotodalam == '2') {
						echo '<p>Silakan Bawa Berkas FOTO DALAM BANGUNAN Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fotoimb == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoimb == '2') {
						echo '<p>Silakan Bawa Berkas IZIN MENDIRIKAN BANGUNAN Ke DPMPTSP</p>';
					}else {
						echo '<p>Tidak ada Berkas</p>';
					}
					if ($key->fotoslf == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoslf == '2') {
						echo '<p>Silakan Bawa Berkas SERTIFIKAT LAYAK FUNGSI Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fotodamkar == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotodamkar == '2') {
						echo '<p>Silakan Bawa Berkas Rekomendasi dari Dinas Penanggunlangan Kebakaran dan Penyelamatan Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fototkt == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fototkt == '2') {
						echo '<p>Silakan Bawa Berkas Rekomendasi dari Dinas Tenaga Kerja dan Transmigrasi Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fotoasuransi == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoasuransi == '2') {
						echo '<p>Silakan Bawa Berkas Berkas Asuransi Toko Ke DPMPTSP</p>';
					}else {
						echo '<p>Tidak ada Berkas</p>';
					}
					if ($key->fotopbb == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotopbb == '2') {
						echo '<p>Silakan Bawa Berkas Bukti Pemutahiran PBB Ke DPMPTSP</p>';
					}else {
					}
					if ($key->fotoperw == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotoperw == '2') {
						echo '<p>Silakan Bawa Berkas Persetujuan Warga Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 

					if ($key->fotorekumkm == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotorekumkm == '2') {
						echo '<p>Silakan Bawa Berkas UMKM Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					} 
					if ($key->fotokajian == '1') {
						echo '<p>Berkas di Terima</p>';
					}else if ($key->fotokajian == '2') {
						echo '<p>Silakan Bawa Berkas Kajian Sosek Ke DPMPTSP</p>';
					}else{
						echo '<p>Tidak ada Berkas</p>';
					}
					?>
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
