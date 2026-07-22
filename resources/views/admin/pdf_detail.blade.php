<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kasus - {{ $pengaduan->kode_tiket }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; color: #333; }
        
        /* STYLE KHUSUS KOP SURAT */
        .kop-surat { width: 100%; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; border-collapse: collapse; }
        .kop-surat td { border: none; padding: 0; vertical-align: middle; }
        .kop-surat h2, .kop-surat h3, .kop-surat p { margin: 0; }
        .kop-surat h2 { font-size: 20px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h3 { font-size: 16px; margin-top: 4px; font-weight: bold; }
        .kop-surat p { font-size: 12px; font-style: italic; margin-top: 4px; color: #555; }

        /* STYLE TABEL DATA KASUS */
        table.data-table { border-collapse: collapse; margin-bottom: 20px; width: 100%; }
        table.data-table th, table.data-table td { padding: 8px; border: 1px solid #ddd; text-align: left; vertical-align: top; }
        table.data-table th { background-color: #f4f4f4; width: 30%; }
        
        .title { text-align: center; font-weight: bold; font-size: 14px; text-decoration: underline; margin-bottom: 20px; }
        .section-title { font-weight: bold; background-color: #333; color: #fff; padding: 5px 10px; margin-top: 20px; margin-bottom: 10px;}
    </style>
</head>
<body>
    
    <!-- KOP SURAT BERLOGO -->
    <table class="kop-surat">
        <tr>
            <td style="width: 15%; text-align: center;">
                <!-- Pemanggilan gambar logo menggunakan public_path() -->
                <img src="{{ public_path('images/logo-bjm.png') }}" alt="Logo Banjarmasin" style="width: 80px; height: auto;">
            </td>
            <!-- padding-right 15% ditambahkan agar teks benar-benar di tengah kertas, seimbang dengan logo di kiri -->
            <td style="width: 85%; text-align: center; padding-right: 15%;">
                <h2>PEMERINTAH KOTA BANJARMASIN</h2>
                <h3>MANAJEMEN PELANGGARAN DAN PELAPORAN PEGAWAI</h3>
                <p>Dokumen Laporan Hasil Investigasi & Tindak Lanjut</p>
            </td>
        </tr>
    </table>

    <div class="title">
        BERITA ACARA PEMERIKSAAN KASUS<br>
        Nomor Tiket: {{ $pengaduan->kode_tiket }}
    </div>

    <div class="section-title">1. IDENTITAS PELAPOR & DATA KASUS</div>
    <table class="data-table">
        <tr>
            <th>Identitas Pelapor</th>
            <td>{{ $pengaduan->nama_pelapor ?? 'Anonim' }} ({{ $pengaduan->nomor_hp ?? '-' }} | {{ $pengaduan->email ?? '-' }}) {{ $pengaduan->nip ? '- NIP: '.$pengaduan->nip : '' }}</td>
        </tr>
        <tr>
            <th>Judul Laporan</th>
            <td>{{ $pengaduan->judul_laporan }}</td>
        </tr>
        <tr>
            <th>Kategori & Waktu Kejadian</th>
            <td>{{ $pengaduan->kategori_laporan }} | {{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Lokasi Kejadian</th>
            <td>{{ $pengaduan->lokasi_kejadian }}</td>
        </tr>
        <tr>
            <th>Tingkat Pelanggaran</th>
            <td>{{ $pengaduan->tingkat_pelanggaran ?? 'Belum Ditentukan' }}</td>
        </tr>
        <tr>
            <th>Kronologi Laporan</th>
            <td>{{ $pengaduan->isi_laporan }}</td>
        </tr>
        @if($pengaduan->pesan_susulan)
        <tr>
            <th>Informasi Tambahan Pelapor</th>
            <td><em>"{{ $pengaduan->pesan_susulan }}"</em></td>
        </tr>
        @endif
    </table>

    <div class="section-title">2. HASIL INVESTIGASI LAPANGAN</div>
    <table class="data-table">
        <tr>
            <th>Investigator Lapangan</th>
            <td>{{ $pengaduan->investigator->name ?? 'Belum Ditugaskan' }}</td>
        </tr>
        <tr>
            <th>Fakta Lapangan</th>
            <td>{{ $pengaduan->fakta_lapangan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Pihak Terkait / Saksi</th>
            <td>{{ $pengaduan->pihak_terlibat ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kesimpulan & Rekomendasi</th>
            <td>{{ $pengaduan->kesimpulan ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">3. ARSIP BUKTI TERLAMPIR</div>
    <table class="data-table">
        <tr>
            <th>Status Bukti Awal</th>
            <td>{{ $pengaduan->lampiran_bukti ? 'Tersedia [Terlampir di Sistem]' : 'Tidak Ada Bukti Awal' }}</td>
        </tr>
        <tr>
            <th>Status Bukti Tambahan</th>
            <td>{{ $pengaduan->lampiran_susulan ? 'Tersedia [Terlampir di Sistem]' : 'Tidak Ada Bukti Tambahan' }}</td>
        </tr>
        <tr>
            <th>Status Bukti Temuan (Investigasi)</th>
            <td>{{ $pengaduan->bukti_investigasi ? 'Tersedia [Terlampir di Sistem]' : 'Tidak Ada Bukti Investigasi' }}</td>
        </tr>
    </table>

    <div class="section-title">4. KEPUTUSAN & EKSEKUSI TINDAK LANJUT</div>
    <table class="data-table">
        <tr>
            <th>Instansi Penindak</th>
            <td>{{ $pengaduan->pihak_penindak ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Eksekusi Keputusan</th>
            <td>{{ $pengaduan->tanggal_tindak_lanjut ? \Carbon\Carbon::parse($pengaduan->tanggal_tindak_lanjut)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <th>Detail Sanksi / Tindak Lanjut</th>
            <td>{{ $pengaduan->tindak_lanjut ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status Kasus Akhir</th>
            <td style="text-transform: uppercase; font-weight: bold;">{{ $pengaduan->status }}</td>
        </tr>
    </table>

    <br><br>
    <!-- TABEL TANDA TANGAN (Tanpa Border) -->
    <table style="border-collapse: collapse; border: none; margin-top: 40px; width: 100%;">
        <tr>
            <td style="border: none; width: 33%; text-align: center; vertical-align: bottom;">
                Pelapor,<br><br><br><br><br><br>
                <strong>{{ $pengaduan->nama_pelapor ?? '_______________________' }}</strong>
            </td>
            <td style="border: none; width: 33%; text-align: center; vertical-align: bottom;">
                Investigator Lapangan,<br><br><br><br><br><br>
                <strong>{{ $pengaduan->investigator->name ?? '_______________________' }}</strong>
            </td>
            <td style="border: none; width: 34%; text-align: center; vertical-align: bottom;">
                Banjarmasin, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>
                Administrator Sistem,<br><br><br><br><br>
                <strong>{{ Auth::user()->name }}</strong>
            </td>
        </tr>
    </table>

</body>
</html>