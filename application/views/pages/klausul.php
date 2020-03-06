<div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:12pt;">
	<p>TEMBUSAN :</p>
	<ol>
		<li align="left">Kepala Dinas Koperasi, Usaha Mikro, Kecil dan Menengah, serta Perdagangan Provinsi DKI Jakarta;</li>
		<li>Kepala Satuan Polisi Pamong Praja Provinsi DKI Jakarta;</li>
		<li>Arsip.</li>
	</ol>
	<center><h4 align="center"><b>KLAUSUL</b></h4></center>
	<p>KEWAJIBAN</p>
	<ol>
		<?php foreach ($kewajiban->result() as $key): ?>
			<li><?=$key->deskripsi?></li>
		<?php endforeach ?>
	</ol>
	<div></div>
	<div></div>
	<div></div>
	<p>LARANGAN</p>
	<ol>
		<?php foreach ($larangan->result() as $larang): ?>

			<li><?=$larang->deksripsi?></li>
		<?php endforeach ?>

	</ol>
</div>