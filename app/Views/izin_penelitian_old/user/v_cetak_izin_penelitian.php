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
		width: 370px;
	}

	.ttd_pejabat .td_mengetahui {
		width: 380px;
	}
    @page {
        size: A4;
        margin: 10mm 30mm 20mm 20mm;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 295mm;        
        }

		.no_surat .nomor_surat {
			width: 600px;
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
				<td width="600">
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
				<td>Izin Penelitian</td>	
			</tr>	
		</table>
		<table>
			<tr><td></td></tr>
			<tr><td></td></tr>
			<tr>
				<td>Yth,. <?= $satu_penelitian['tujuan_surat']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td><?= $satu_penelitian['alamat_tempat_penelitian']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
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
				<td style="text-indent: 35px; text-align: justify;" width="780">
					Dalam rangka penyelesaian studi akhir mahasiswa, kami mohon kesediaan Bapak/Ibu memberikan izin melaksanakan penelitian kepada mahasiswa berikut:
				</td>
			</tr>
		</table>
		<br class="jrk">
		<table >
			<tr>
				<td width='150'>Nama</td>
				<td width='7'>:</td>
				<td width='570'><?= $satu_penelitian['nama_pengajuan']; ?></td>	
			</tr>	
			<tr>
				<td width='150'>NIM</td>
				<td width='7'>:</td>
				<td width='570'><?= $satu_penelitian['nim_pengajuan']; ?></td>	
			</tr>	
			<tr>
				<td width='150'>Departemen</td>
				<td width='7'>:</td>
				<td width='570'><?= $satu_penelitian['nama_departemen']; ?></td>	
			</tr>	
			<tr>
				<td width='150' valign="top">Judul Penelitian/Skripsi</td>
				<td width='7' valign="top">:</td>
				<td width='570' style="text-align: justify;"><?= $satu_penelitian['judul']; ?></td>	
			</tr>	
			<tr>
				<td width='150'>Tempat Penelitian</td>
				<td width='7'>:</td>
				<td width='570'><?= $satu_penelitian['tempat_penelitian']; ?></td>	
			</tr>
			<tr>
				<td>Jadwal</td>
				<td>:</td>
				<td width="570"><?= tanggal_indo($satu_penelitian['tanggal_mulai']); ?> - <?= tanggal_indo($satu_penelitian['tanggal_selesai']) ; ?></td>	
			</tr>
			<tr>
				<td width='150'>Objek Penelitian</td>
				<td width='7'>:</td>
				<td width='570'><?= $satu_penelitian['objek_penelitian']; ?></td>	
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
				</td>
				<td>
				
				</td>
			</tr>
			<tr>
				<td>
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