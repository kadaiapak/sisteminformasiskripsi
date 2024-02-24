<html>
<style>
	body {
        width: 595px;
        height: 842px;
        margin-left: auto;
        margin-right: auto;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

	.no_surat .nomor_surat {
		width: 350px;
	}

	.ttd_pejabat .td_mengetahui {
		width: 380px;
	}
    @page {
        size: A4;
        margin: 10mm 20mm 20mm 20mm;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 295mm;        
        }

		.no_surat .nomor_surat {
			width: 550px;
		}

		p.footer {
		position: absolute;
		bottom: 0;
		width: 100%;
		height: 1.6rem;
		}
		.ttd_pejabat .td_mengetahui {
		width: 480px;
	}
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
        }

		
    }

br {
    line-height: 1px;
}

br.ttd{
	line-height: 28px;
}
br.jrk{
	line-height: 8px;
}

hr{
	border: 0;
	border-top: 4px double #8c8b8b;
}

.bordered {
	border : 1px solid black;
	border-collapse: collapse;
}
.bordered th {
	border : 1px solid black;
	border-collapse: collapse;
}
.bordered td{
	border : 1px solid black;
	border-collapse: collapse;
}

</style>

<body onload="window.print();">
	<div class='page'>
		<table size='100%' align='center'>
			<tr>
				<td><img src="<?= base_url('/unp.png'); ?>" width="90" height="90" alt=""></td>
				<td width="500">
					<center>
						<font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</font><br>
						<font size="4">RISET DAN TEKNOLOGI</font><br>
						<font size="4">UNIVERSITAS NEGERI PADANG</font><br>
						<font size="4">FAKULTAS ILMU PENDIDIKAN</font><br>
						<font size="4"><b>DEPARTEMEN <?= strtoupper($satu_penelitian['nama_departemen']); ?></b></font><br>
						<font size="2">Jl. Prof.Dr. Hamka Kampus UNP Air Tawar Padang 25131, Telp.7058693</font><br>
						<font size="2">Website: <?= $satu_penelitian['website_departemen']; ?> email: <?= $satu_penelitian['email_departemen']; ?></font>
					</center>
				</td>
			</tr>
		</table>
		<hr>
		<table class="no_surat">
			<tr>
				<td width='80px'>Nomor</td>
				<td width='10px'>:</td>
				<td class="nomor_surat"><?= $nomor_surat; ?></td>
				<td><?= $tanggal_surat ?></td>
			</tr>
			<tr>
				<td>Lampiran</td>
				<td>:</td>
				<td>-</td>	
			</tr>
			<tr>
				<td>Hal</td>
				<td>:</td>
				<td>Validasi Instrumen Penelitian</td>	
			</tr>	
		</table>
		<table>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr>
				<td>Kepada: Yth,. <?= $satu_penelitian['tujuan_surat']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Di</td>
				<td></td>
			</tr>
			<tr>
				<td>Tempat</td>
				<td></td>
			</tr>
		</table>
		<br class="jrk">
		<table>
			<tr>
				<td>
					Dengan hormat,
				</td>
			</tr>
		</table>
		<br class="jrk">
		<table class="isi">
			<tr>
				<td style="text-indent: 35px;" >
					Dalam rangka menunjang kelancaran pelaksanaan penelitian mahasiswa Departemen <?= $satu_penelitian['nama_departemen']; ?> FIP UNP, kami mohon bantuan bapak/ibu memberikan izin mahasiswa kami untuk melaksanakan validasi instrumen ditempat bapak/ibu pimpin, berikut data mahasiswa tersebut:
				</td>
			</tr>
		</table>
		<br class="jrk">
		<table>
			<tr>
				<td width='150'>Nama</td>
				<td width='7'>:</td>
				<td width='380'><?= $satu_penelitian['nama_pengajuan']; ?></td>	
			</tr>	
			<tr>
				<td width='150'>NIM</td>
				<td width='7'>:</td>
				<td width='380'><?= $satu_penelitian['nim_pengajuan']; ?></td>	
			</tr>	
			<tr>
				<td width='150'>Departemen</td>
				<td width='7'>:</td>
				<td width='380'><?= $satu_penelitian['nama_departemen']; ?></td>	
			</tr>	
			<tr>
				<td width='150'>Judul</td>
				<td width='7'>:</td>
				<td width='380'><?= $satu_penelitian['judul']; ?></td>	
			</tr>	
		</table>
		<table>
			<tr><td></td></tr>
			<tr>
				<td>Demikian permohonan ini kami sampaikan atas perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih.</td>
			</tr>
		</table>
		<br class="jrk">
		<br class="jrk">
		<table class="ttd_pejabat">
			<tr>
				<td class="td_mengetahui">
					Mengetahui,<br>
				</td>
				<td>
				
				</td>
			</tr>
			<tr>
				<td>
					Wakil Dekan I
				</td>
				<td>
					Kepala Departemen
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<img width='100' src='<?= $satu_penelitian['qr_code']; ?>' />
				</td>
			</tr>
			<tr>
				<td>
					Dr. Hanif Al Kadri, M.Pd</br>
					NIP. 19760921 200801 1 010
				</td>
				<td>
					<?= $satu_penelitian['nama_kadep_departemen']; ?></br>
					NIP. <?= $satu_penelitian['nip_kadep_departemen']; ?></br>
					</td>
			</tr>
		</table>
		<p class='footer'><span style='text-align:justify'><i>Validitas data pada surat ini bisa di cek menggunakan Qr Code yang tersedia.<i></span></p>
	</div>
</body>
</html>