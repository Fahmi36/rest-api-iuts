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