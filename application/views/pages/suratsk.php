	<div style="word-break:break-word">
		<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:15px;border-radius: 15px;">
			<div align="center">
				<img class="CToWUd"  width="100" height="100" src="<?=base_url('assets/img/logopemprov.png')?>">
			</div>
			<center>
				<h4 align="center" style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;">UNIT PENGELOLA PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU
					<br>KECAMATAN ……………………
				</h4>
			</center>
			<table cellpadding="1" style="width:100%;padding:10px;font-size:12pt;margin-top:10px;word-break:break-all;word-wrap:break-word;">
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
					<tr style="padding: 0;">
						<td>Nama Perusahaan</td><td style="width: 20px;">:</td><td><?=$data->nama_badan_usaha?></td>
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
				<?php endforeach ?>
			</table>
			<p style="text-align:justify;font-size: 12pt;">Izin usaha ini berlaku untuk melakukan kegiatan usaha Toko Swalayan pada 1 (satu) lokasi dan wajib didaftarkan ulang setiap 5 (lima) tahun.</p>
			<p style="text-align:justify;font-size: 12pt;">Setiap perubahan jenis barang/jasa dagangan utama dan luas lantai usaha yang digunakan, terlebih dahulu harus mendapat persetujuan tertulis dari Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi DKI Jakarta.</p>
			<p style="text-align:justify;font-size: 12pt;">Apabila setelah Izin Usaha Toko Swalayan diterbitkan pemegang izin tidak memenuhi persyaratan sebagaimana disebutkan di atas serta tidak memenuhi klausul yang menjadi bagian dari perizinan ini, maka Izin Usaha Toko Swalayan akan ditinjau kembali.</p>
			<!-- <div></div><div></div> -->
			<div align="right" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;padding-left:20px;display: flex;">
				<table cellpadding="1" style="width:100%;padding:10px;font-size:12pt;margin-top:10px;word-break:break-all;word-wrap:break-word;">
					<tr>
						<td></td>
						<td>
							<p align="left">Ditetapkan di Jakarta <br>Pada tanggal .... .................... .....</p>
							<!-- <p align="right" style="text-align: left;float: right;"> </p> -->
							<p align="center"><span>KEPALA UNIT PENGELOLA PENANAMAN MODAL dan PTSP<br>Kecamatan ………………………..</span></p>
							<div></div><div></div><div></div>
							<p align="center">...........................................<br>
							NIP. ....................................</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>