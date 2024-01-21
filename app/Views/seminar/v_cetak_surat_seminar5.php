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

hr{
	border: 0;
	border-top: 4px double #8c8b8b;
}

</style>

<body>
	<div class='book'>
		<div class='page'>
			<div class='subpage'>
				<table size='100%' align='center' border="1">
					<tr>
						<td><img src="http://localhost:8080/template/unp.png" width="90" height="90" alt=""></td>
						<td width="400">
							<center>
								<font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</font><br>
								<font size="4">RISET DAN TEKNOLOGI</font><br>
								<font size="4">UNIVERSITAS NEGERI PADANG</font><br>
								<font size="4">FAKULTAS ILMU PENDIDIKAN</font><br>
								<font size="4"><b>DEPARTEMEN PENDIDIKAN ANAK USIA DINI</b></font><br>
								<font size="2">Jl. Prof.Dr. Hamka Kampus UNP Air Tawar Padang 25131, Telp.7058693</font><br>
								<font size="2">Jl. Prof.Dr. Hamka Kampus UNP Air Tawar Padang 25131, Telp.7058693</font>
							</center>
						</td>
					</tr>
				</table>
				<hr>
				<table class="no_surat">
					<tr>
						<td width='50'>Nomor</td>
						<td width='10'>:</td>
						<td width='350'>UN35/KM/2023</td>
						<td>21 Januari 2023</td>
					</tr>
					<tr>
						<td>Lampiran</td>
						<td>:</td>
						<td>1 Berkas</td>	
					</tr>
					<tr>
						<td>Hal</td>
						<td>:</td>
						<td>Undangan Seminar Proposal</td>	
					</tr>	
				</table>
				<p><br class='jrk'>Kepada: Yth, Bapak/Ibu</p>
				<table class='bordered' border="1 collapse">
					<thead>
							<th width='30'>No</th>
							<th width='170'>Nama</th>
							<th width='200'>NIP</th>
							<th width='100'>Jabatan</th>	
					</thead>
					<tbody>
						<tr>
							<td>  1</td>
							<td>  Deni Suardi</td>
							<td>  12312312313123213</td>
							<td>  Penguji 1</td>	
						</tr>
						<tr>
							<td>  2</td>
							<td>  Suardi Deni</td>
							<td>  13723712830102380</td>
							<td>  Penguji 2</td>	
						</tr>
					</tbody>
				</table>
						<p>Dengan hormat,</p>
						<p>Melalui surat ini kami mengundang Bapak/Ibu untuk dapat menghadiri kegiatan <b>Seminar Proposal</b> mahasiswa sebagai berikut:</p>
						<table class='hal'>
							<tr>
								<td width='20'></td>
								<td width='160'>Nama</td>
								<td width='10'>:</td>
								<td width='380'> <b> Deni Suardi </b></td>	
							</tr>
							<tr>
								<td width='20'></td>
								<td>Tahun Masuk/NIM </td>
								<td>:</td>
								<td> 2023 / 20203200</td>	
							</tr>
							<tr>
								<td width='20'></td>
								<td>Judul Skripsi</td>
								<td>:</td>
								<td>Berikut ini adalah judul skripsi yang saya gunakan untuk menamatkan kuliah saya</td>	
							</tr>
							<tr>
								<td width='20'></td>
								<td>Pembimbing</td>
								<td>:</td>
								<td>Dosen Pembimbing</td>	
							</tr>
							<tr>
								<td width='20'></td>
								<td>Hari/ Tanggal</td>
								<td>:</td>
								<td>Rabu, 23 Januar 2024</td>	
							</tr>
							<tr>
								<td width='20'></td>
								<td>Jenjang Program </td><td>:</td><td> S1</td>	
							</tr>
						</table>
						<p><span style='text-align:justify'>Berdasarkan data akademik yang ada, yang bersangkutan telah menyelesaikan seluruh mata kuliah yang disyaratkan untuk program studi tersebut diatas.</span></p>
						<p><span style='text-align:justify'>Berhubung yang bersangkutan akan diwisuda pada periode <b>test</b> yang akan dilaksanakan pada tanggal test, maka surat keterangan ini dapat dipergunakan sebagai <b>Surat Keterangan Lulus</b>.</span></p>
						<p>Demikian surat ini dikeluarkan, agar dapat dipergunakan sebagaimana mestinya.</p><br><br>
			<table>
				<tr>
					<td width='370'></td>
					<td width='350'>Padang, test</td>
				</tr>
				<tr>
					<td rowspan='2' align='left'><img width='100'/></td>
					<td>Kepala Biro Akademik dan Kemahasiswaan</td>
				</tr>
				<tr>
					<td><br class='ttd'><br class='ttd'>
						Deni Suardi</br>
						NIP. Testing</br>
						<font size='1px'>testing</font></br>
						<font size='1px'>testing</font></br>
						</td>
				</tr>
			</table>
			<p class='footer'><span style='text-align:justify'><i>Validitas data pada surat ini bisa di cek menggunakan Qr Code yang tersedia.<i></span></p>
			</div>
	</div>
</div>

</body>
</html>