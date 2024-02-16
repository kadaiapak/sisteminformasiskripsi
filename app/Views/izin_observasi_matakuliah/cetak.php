<html>
<head><title>Print</title></head>
<style>
	body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #ffffff solid;
        border-radius: 1px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 8mm 1cm 1mm 1.9cm;
        border: 1px #ffffff solid;
        height: 285mm;
        outline: 0cm #ffffff solid;
    }

    p.footer {
    position: absolute;
  	bottom: 0;
  	width: 100%;
  	height: 1.6rem;
	}
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 295mm;        
        }
        /*hr{
			border: 1;
			border-top: 10px double #8c8b8b;
		}*/
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
table.mytable {
    border-collapse: collapse;
}

.mytable th {
    border: 1px solid black;
}

.mytable td {
    border: 1px solid black;
}

br {
    line-height: 1px;
}

br.ttd{
	line-height: 28px;
}
br.jrk{
	line-height: 15px;
}
/*hr{
	border-top: 5px double #8c8b8b;
	text-align: center;
}*/

hr{
	border: 0;
	border-top: 4px double #8c8b8b;
}

</style>
<script language="JavaScript">
  function loadprint(){
  window.print();
}
</script>
<body onload="loadprint();">
<?php
	$logounp = base_url()."/unp.png";
	$dd = $nomor_surat;
	$datestring = $tanggal_surat;
	$tgl = $tanggal_surat;
	$tglhr = $tanggal_surat;
	$twisuda = $tanggal_surat;
	$kop = strtoupper('KEMENTERIAN PENDIDIKAN KEBUDAYAAN, RISET DAN TEKNOLOGI');
	$kopuniv = strtoupper('UNIVERSITAS NEGERI PADANG');
	$alamatinstitusi = 'Jln. Prof. Dr. Hamka Air Tawar Padang';
	$webmail = 'website: www.ditmawa.unp.ac.id e-mail: kemahasiswaan@unp.ac.id';
?>
	<div class='book'>
	<div class='page'>
	<div class='subpage'>
	<table size='100%' align='center' >
	<tr>
		<td width='10%' valign='bottom'><img src='$logounp' width='90' height='90' valign='bottom' /></td>
		<td align='center' WIDTH='90%' style='font-size:17px' valign='bottom'><?= $kop; ?> <br>
		<b style='font-size:21px'><?= $kopuniv ; ?> </b><br>
		<font size='3'><?= $alamatinstitusi; ?> </font><br>
		<font size='3'><?= $webmail; ?> </font>
		</td>
	</tr>
	</table>
	<hr>
				<p align='center' style='font-size:18px'><u><b><br class='jrk'>SURAT KETERANGAN </b></u><br>
				Nomor : <?= $nomor_surat; ?> </p>
				<p><br class='jrk'>Kepala Biro Akademik dan Kemahasiswaan Universitas Negeri Padang, dengan ini menerangkan bahwa :</p>
				<table class='hal'>
					<tr>
						<td width='20'></td><td width='160'>Nama</td><td width='10'>:</td><td width='380'> <b><?=  $satu_observasi['nama_pengajuan']; ?> </b></td>	
					</tr>
					<tr>
						<td width='20'></td><td>Tahun Masuk/NIM </td><td>:</td><td> <?= $satu_observasi['nim_pengajuan']; ?> </td>	
					</tr>
					<tr>
						<td width='20'></td><td>Tempat/Tanggal Lahir </td><td>:</td><td> Padang / 20/05/1992</td>	
					</tr>
					<tr>
						<td width='20'></td><td>Fakultas </td><td>:</td><td> Fakultas Ilmu Pendidikan</td>	
					</tr>
					<tr>
						<td width='20'></td><td>Program Studi </td><td>:</td><td> <?= $satu_observasi['nama_departemen']; ?></td>	
					</tr>
					<tr>
						<td width='20'></td><td>Jenjang Program </td><td>:</td><td> S1</td>	
					</tr>
				</table>
				<p><span style='text-align:justify'>Berdasarkan data akademik yang ada, yang bersangkutan telah menyelesaikan seluruh mata kuliah yang disyaratkan untuk program studi tersebut diatas.</span></p>
				<p><span style='text-align:justify'>Berhubung yang bersangkutan akan diwisuda pada periode <b>1 Maret 2024</b> yang akan dilaksanakan pada tanggal $twisuda, maka surat keterangan ini dapat dipergunakan sebagai <b>Surat Keterangan Lulus</b>.</span></p>
				<?php   foreach($anggota as $a) { ?>
                    <table class='hal'>
					<tr>
						<td width='20'></td><td width='160'>Nama</td><td width='10'>:</td><td width='380'> <b> <?= $satu_observasi['nama_pengajuan']; ?>  </b></td>	
					</tr>
					<tr>
						<td width='20'></td><td>Tahun Masuk/NIM </td><td>:</td><td> <?= $satu_observasi['nim_pengajuan']; ?> </td>	
					</tr>
					<tr>
						<td width='20'></td><td>Tempat/Tanggal Lahir </td><td>:</td><td> Padang / 20/05/1992</td>	
					</tr>
					<tr>
						<td width='20'></td><td>Fakultas </td><td>:</td><td> Fakultas Ilmu Pendidikan</td>	
					</tr>
					<tr>
						<td width='20'></td><td>Program Studi </td><td>:</td><td> <?= $satu_observasi['nama_departemen']; ?> </td>	
					</tr>
					<tr>
						<td width='20'></td><td>Jenjang Program </td><td>:</td><td> S1</td>	
					</tr>
				</table>
                <?php   } ?>
                "<table class='hal'>
					<tr>
						<td width='20'></td><td width='160'>Nama</td><td width='10'>:</td><td width='380'> <b> <?= $satu_observasi['nama_pengajuan']; ?>  </b></td>	
					</tr>
					<tr>
						<td width='20'></td><td>Tahun Masuk/NIM </td><td>:</td><td> <?= $satu_observasi['nim_pengajuan']; ?> </td>	
					</tr>
					<tr>
						<td width='20'></td><td>Tempat/Tanggal Lahir </td><td>:</td><td> Padang / 20/05/1992</td>	
					</tr>
					<tr>
						<td width='20'></td><td>Fakultas </td><td>:</td><td> Fakultas Ilmu Pendidikan</td>	
					</tr>
					<tr>
						<td width='20'></td><td>Program Studi </td><td>:</td><td> <?= $satu_observasi['nama_departemen']; ?> </td>	
					</tr>
					<tr>
						<td width='20'></td><td>Jenjang Program </td><td>:</td><td> S1</td>	
					</tr>
				</table>
                <p>Demikian surat ini dikeluarkan, agar dapat dipergunakan sebagaimana mestinya.</p><br><br>
	<table>
		<tr>
			<td width='370'></td>
			<td width='350'>Padang, <?= $tgl ; ?></td>
		</tr>
		<tr>
			<td rowspan='2' align='left'><img width='100' src='<?= $satu_observasi['qr_code']; ?>'/></td>
			<td>Kepala Biro Akademik dan Kemahasiswaan</td>
		</tr>
		<tr>
			<td><br class='ttd'><br class='ttd'>
            $satu_observasi[nama_kadep_departemen]</br>
				NIP. $satu_observasi[nip_kadep_departemen]</br>
				<font size='1px'><?= $satu_observasi['nip_kadep_departemen']; ?> </font></br>
				<font size='1px'><?= $satu_observasi['nip_kadep_departemen']; ?> </font></br>
				</td>
		</tr>
	</table>
	<p class='footer'><span style='text-align:justify'><i>Validitas data pada surat ini bisa di cek menggunakan Qr Code yang tersedia.<i></span></p>
	</div></div></div>";
?>
</body>
</html>