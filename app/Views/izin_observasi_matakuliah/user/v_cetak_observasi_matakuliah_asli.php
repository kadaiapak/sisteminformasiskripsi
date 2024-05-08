<html>
<!-- <head><title>Print</title></head> -->
<style>
	/* body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    } */
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
/* page {
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
    } */

 
    
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
        /*hr{
			border: 1;
			border-top: 10px double #8c8b8b;
		}*/
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
            page-break-after: always;
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
						<font size="4"><b>DEPARTEMEN <?= strtoupper($satu_observasi['nama_departemen']); ?></b></font><br>
						<font size="2">Jl. Prof.Dr. Hamka Kampus UNP Air Tawar Padang 25131, Telp.7058693</font><br>
						<font size="2">Website: <?= $satu_observasi['website_departemen']; ?> email: <?= $satu_observasi['email_departemen']; ?></font>
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
				<td>1 Berkas</td>	
			</tr>
			<tr>
				<td>Hal</td>
				<td>:</td>
				<td>Validator Instrumen</td>	
			</tr>	
		</table>
		<table>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr>
				<td>Kepada: Yth,. <?= $satu_observasi['tujuan_surat']; ?></td>
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
					Dalam rangka penyelesaian perkuliahan pada Departemen <?= $satu_observasi['nama_departemen']; ?> FIP UNP, kami mohon bantuan bapak/ibu memberikan izin observasi kepada mahasiswa terlampir:
				</td>
			</tr>
		</table>
		<br class="jrk">
		<table>
			<tr>
				<td width='150'>Tujuan Observasi</td>
				<td width='7'>:</td>
				<td width='380'><?= $satu_observasi['tujuan_observasi']; ?></td>	
			</tr>
			<tr>
				<td>Matakuliah </td>
				<td>:</td>
				<td><?= $satu_observasi['matakuliah']; ?></td>	
			</tr>
			<tr>
				<td>Jadwal</td>
				<td>:</td>
				<td><?= tanggal_indo($satu_observasi['tanggal_mulai']); ?> - <?= tanggal_indo($satu_observasi['tanggal_selesai']) ; ?></td>	
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
					<img width='100' src='<?= $satu_observasi['qr_code']; ?>' />
				</td>
			</tr>
			<tr>
				<td>
					Dr. Hanif Al Kadri, M.Pd</br>
					NIP. 19760921 200801 1 010
				</td>
				<td>
					<?= $satu_observasi['nama_kadep_departemen']; ?></br>
					NIP. <?= $satu_observasi['nip_kadep_departemen']; ?></br>
					</td>
			</tr>
		</table>
		<p class='footer'><span style='text-align:justify'><i>Validitas data pada surat ini bisa di cek menggunakan Qr Code yang tersedia.<i></span></p>
	</div>
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
						<font size="4"><b>DEPARTEMEN <?= strtoupper($satu_observasi['nama_departemen']); ?></b></font><br>
						<font size="2">Jl. Prof.Dr. Hamka Kampus UNP Air Tawar Padang 25131, Telp.7058693</font><br>
						<font size="2">Website: <?= $satu_observasi['website_departemen']; ?> email: <?= $satu_observasi['email_departemen']; ?></font>
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
				<td>Hal</td>
				<td>:</td>
				<td>Daftar Nama Mahasiswa Observasi</td>	
			</tr>
		</table>
		<br>
		<br>
		<table>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<table border="1" style="width: 100%; border-collapse:collapse;">
			<tr>
				<td width="25px" style="text-align: center;"><b>No</b></td>
				<td width="150px" style="text-align: center;"><b>Nama</b></td>
				<td width="70px" style="text-align: center;"><b>NIM</b></td>
				<td width="100px" style="text-align: center;"><b>Jenis Kelamin</b></td>
			</tr>
			<tr>
				<td style="text-align: center;">1.</td>
				<td style="padding-left: 10px;"><?= $satu_observasi['nama_pengajuan']; ?></td>
				<td style="padding-left: 10px;"><?= $satu_observasi['nim_pengajuan']; ?></td>
				<td style="padding-left: 10px;"><?= $satu_observasi['jenis_kelamin'] == 'L' ? 'Laki - laki' : ($satu_observasi['jenis_kelamin'] == 'P' ? 'Perempuan' : null); ?></td>
			</tr>
			<?php $no = 2; ?>
			<?php if ($anggota) { ?>
				<?php foreach ($anggota as $a) { ?>
				<tr>
					<td style="text-align: center;"><?= $no; ?>.</td>
					<td style="padding-left: 10px;"><?= $a['nama_anggota']; ?></td>
					<td style="padding-left: 10px;"><?= $a['nim_anggota']; ?></td>
					<td style="padding-left: 10px;"><?= $a['jenis_kelamin'] == 'L' ? 'Laki - laki' : ($a['jenis_kelamin'] == 'P' ? 'Perempuan' : null); ?></td>
				</tr>
				<?php $no ++ ?>
				<?php } ?>
			<?php } ?>
			
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
					<img width='100' src='<?= $satu_observasi['qr_code']; ?>' />
				</td>
			</tr>
			<tr>
				<td>
					Dr. Hanif Al Kadri, M.Pd</br>
					NIP. 19760921 200801 1 010
				</td>
				<td>
					<?= $satu_observasi['nama_kadep_departemen']; ?></br>
					NIP. <?= $satu_observasi['nip_kadep_departemen']; ?></br>
					</td>
			</tr>
		</table>
		<p class='footer'><span style='text-align:justify'><i>Validitas data pada surat ini bisa di cek menggunakan Qr Code yang tersedia.<i></span></p>
	</div>
</body>
</html>