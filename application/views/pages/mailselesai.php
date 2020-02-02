<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td></td>
				<td>
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#f5f5f5;padding:22px 16px;margin-bottom:6px;direction:ltr;padding-bottom:7px" width="100%">
						<tbody>
							<tr>
								<td align="left" width="52"><img class="CToWUd" height="52" src="http://iuts.pkkmart.com/assets/img/logopemprov.png" width="52"></td>
								<td align="left" style="font-family:Roboto-Light,Helvetica,Arial,sans-serif"><label style="font-family:Roboto-Light,Helvetica,Arial,sans-serif">Perizinan DKI</label></td>
								<td align="right"  style="font-family:Roboto-Light,Helvetica,Arial,sans-serif"><label style="font-family:Roboto-Light,Helvetica,Arial,sans-serif">
									Informasi
								</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td></td>
			</tr>
			<tr>
				<td><p style="margin:10px 0;"></p></td>
			</tr>
			<tr>
				<td style="" width="6">
					<p>&nbsp;</p>
				</td>
				<td style="box-shadow: 0 0 15px 2px rgba(0,0,0,.4);">
					<div style="word-break:break-word">
						<div style="padding: 20px 20px;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:15px;color: rgba(255, 255, 255, 0.87);background-color: rgb(36, 186, 24);border-radius: 15px;">

							<table style="border: solid 1px rgb(36, 186, 24);width:100%;padding:10px;margin-top:10px;word-break:break-all;word-wrap:break-word;">
								<tr>
									<td colspan="3">
										<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:16px;line-height:1.8">Halo <?=$data->nama?>,</h4>
									</td>
								</tr>
							</table>


							<!-- Buat Pemohon baru -->
<!-- 						<table style="border:solid 1px rgba(0,0,0,.2);width:100%;padding:10px;margin-top:10px;word-break: break-all;word-wrap:break-word;">
							<tr>
								<td colspan="3">
									<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:16px;line-height:1.8">Summary Permohonan</h4>
								</td>
							</tr>
							<tr>
								<td width="30%">Luas Tanah</td><td style="width: 20px">:</td><td><?=$data->luas_tanah?> M<sup>2</sup></td>
							</tr>
							<tr>
								<td>Kondisi Lahan</td><td style="width: 20px">:</td><td><?=($data->kondisi_lahan==0)?"Lahan Kosong":"Lahan ada bangunan"?></td>
							</tr>
							<tr>
								<td style="width:50%">Jumlah Bidang Tanah</td><td style="width: 20px">:</td><td><?=$data->jumlah_bidang_tanah?></td>
							</tr>
							<tr>
								<td>Total Luas Tanah</td><td style="width: 20px">:</td><td><?=$data->total_luas_tanah?> M<sup>2</sup></td>
							</tr>
							<tr>
								<td>Jumlah Objek Tanah PBB</td><td style="width: 20px">:</td><td><?=$data->jumlah_objek_tanah_pbb?></td>
							</tr>
							<tr>
								<td>Total Luas Bumi PBB</td><td style="width: 20px">:</td><td><?=$data->total_luas_bumi_pbb?> M<sup>2</sup></td>
							</tr>
							<tr>
								<td>Fungsi</td><td style="width: 20px">:</td><td><?=($data->fungsi_bangunan==0)?"Non-Rumah Tinggal":"Rumah Tinggal"?></td>
							</tr>
							<tr>
								<td>Jumlah Lantai</td><td style="width: 20px">:</td><td><?=$data->jumlah_lantai?></td>
							</tr>
							<tr>
								<td>Rencana Digunakan Pada Tahun</td><td style="width: 20px">:</td><td><?=$data->tahun_rencana_penggunaan?></td>
							</tr>
							<tr>
								<td>Jumlah Basement</td><td style="width: 20px">:</td><td><?=$data->jumlah_basement?></td>
							</tr>
							<tr>
								<td>Luas Basement</td><td style="width: 20px">:</td><td><?=$data->luas_basement?> M<sup>2</sup></td>
							</tr>
							<tr>
								<td>Luas Seluruh Lantai</td><td style="width: 20px">:</td><td><?=$data->luas_keseluruhan_lantai?> M<sup>2</sup></td>
							</tr>
							<tr>
								<td>Koefisien Dasar Bangunan</td><td style="width: 20px">:</td><td><?=$data->kdb?></td>
							</tr>
							<tr>
								<td>Koefisien Lantai Bangunan</td><td style="width: 20px">:</td><td><?=$data->klb?></td>
							</tr>
							<tr>
								<td>Koefisien Dasar Hijau</td><td style="width: 20px">:</td><td><?=$data->kdh?></td>
							</tr>
						</table> -->

						<div style="background: rgb(36, 186, 24);border: solid 1px rgb(36, 186, 24);margin-top:10px!important;padding:10px;margin-top:10px;">
							<?php if ($data->status == 4) { ?>
								<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:16px;line-height:1.8">Selamat Data Anda Di Terima Oleh Kepala Dinas DPMPTSP, Silakan cek detail dan tanggal serah terima Surat Keputusan Izin di Halaman Perizinan Anda</h4>
							<?php }elseif ($data->status == 5) { ?>
								<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:16px;line-height:1.8">Maaf Data Bangunan Anda Di Tolak Karena Tidak Sesuai</h4>
							<?php } ?>
							<center>
								<a href="https://iuts.pkkmart.com/admin/login.html">
									<button style="cursor:pointer;background: #335589;height:auto;padding:20px;width:auto;border: none;border-radius: 2px;color:#f9f9f9;box-shadow: 0 0 8px 2px rgba(0,0,0,0.2)">Klik Disini
									</button>
								</a>
							</center>
							<table style="border: solid 1px rgb(36, 186, 24);width:100%;padding:10px;margin-top:10px;word-break:break-all;word-wrap:break-word;">
								<tr>
									<td colspan="3">
										<h4 style="margin:0;font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:16px;line-height:1.8">Data Bangunan Anda</h4>
									</td>
								</tr>
								<tr>
									<td>Nomor Objek Pajak</td><td style="width: 20px">:</td><td><?=$data->nop?></td>
								</tr>
								<tr>
									<td>Nomor Registrasi Bangunan</td><td style="width: 20px">:</td><td><?=$data->no_reg_bangunan?> </td>
								</tr>
								<tr>
									<td>Alamat</td><td style="width: 20px">:</td><td><?=$data->alamat?> </td>
								</tr>
								<tr>
									<td>Kode</td><td style="width: 20px">:</td><td><?=$data->code?> </td>
								</tr>
							</table>
							<!-- Buat Pemohon baru -->
						</div>
					</div>
					<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:rgba(0,0,0,0.87);line-height:1.6;padding-left:20px;padding-right:20px;padding-bottom:12px;padding-top:24px">
					</div>
				</td>
				<td style="" width="6">
					<div></div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div style="text-align:left">
						<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:12px;line-height:20px;padding-top:10px">
							<div>
								Anda menerima email ini sebagai pemberitahuan tentang <?php echo $title; ?> yang tersedia di layanan system Perizinan DKI.
							</div>
							<div style="direction:ltr">
								&copy; <?=date('Y')?> Perizinan DKI.
							</div>
						</div>
						<div style="display:none!important;max-height:0px;max-width:0px">
							et:91
						</div>
					</div>
				</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>
