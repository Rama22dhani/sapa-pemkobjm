<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; line-height: 1.4; color: #333; }
        
        /* STYLE KHUSUS KOP SURAT */
        .kop-surat { width: 100%; padding-bottom: 5px; border-collapse: collapse; }
        .kop-surat td { border: none; padding: 0; vertical-align: middle; }
        .kop-surat h2 { font-size: 13px; margin: 0; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px; }
        .kop-surat h1 { font-size: 15px; margin: 2px 0; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px; white-space: nowrap; }
        .kop-surat p { font-size: 9.5px; margin: 1px 0 0 0; color: #333; line-height: 1.3; }
        .garis-kop { border-top: 2.5px solid #000; border-bottom: 1px solid #000; height: 1.5px; margin-bottom: 20px; margin-top: 4px; }

        .title { text-align: center; font-weight: bold; font-size: 11px; margin-bottom: 15px; text-transform: uppercase; text-decoration: underline; }
        
        /* STYLE TABEL DATA REKAP */
        table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.data-table th, table.data-table td { padding: 7px 5px; border: 1px solid #333; text-align: left; vertical-align: top; }
        table.data-table th { background-color: #f2f2f2; font-weight: bold; text-align: center; text-transform: uppercase; font-size: 10px; }
        
        .center { text-align: center; }
    </style>
</head>
<body>

    <table class="kop-surat">
        <tr>
            <td style="width: 10%; text-align: center;">
                <img src="{{ public_path('images/logo-bjm.png') }}" alt="Logo Banjarmasin" style="width: 60px; height: auto;">
            </td>
            <td style="width: 90%; text-align: center; padding-right: 10%;">
                <h2>PEMERINTAH KOTA BANJARMASIN</h2>
                <h1>MANAJEMEN PELAPORAN DAN PELANGGARAN PEGAWAI</h1>
                <p>Alamat : Jalan R. E. Martadinata No. 1 - Banjarmasin 70111<br>
                Website : banjarmasinkota.go.id, Email : inspektorat@banjarmasinkota.go.id</p>
            </td>
        </tr>
    </table>
    <div class="garis-kop"></div>

    <div class="title">{{ $title }}</div>

    @if($kategori == 'pegawai')
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Nama Pegawai</th>
                    <th style="width: 30%;">Alamat Email</th>
                    <th style="width: 30%;">Peran / Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $d)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td><strong>{{ $d->name }}</strong></td>
                        <td>{{ $d->email }}</td>
                        <td class="center">{{ strtoupper(str_replace('_', ' ', $d->peran)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="center" style="font-style: italic; color: #777; padding: 15px;">Belum ada data pegawai terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @elseif($kategori == 'pengguna')
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Nama Pelapor</th>
                    <th style="width: 35%;">Alamat Email</th>
                    <th style="width: 25%;">Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $d)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td><strong>{{ $d->name }}</strong></td>
                        <td>{{ $d->email }}</td>
                        <td class="center">{{ \Carbon\Carbon::parse($d->created_at)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="center" style="font-style: italic; color: #777; padding: 15px;">Belum ada pelapor yang mendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @elseif($kategori == 'master_pegawai')
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">NIP & Nama</th>
                    <th style="width: 20%;">Instansi & Status</th>
                    <th style="width: 25%;">Jabatan</th>
                    <th style="width: 25%;">Akun Terhubung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $d)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $d->nama_pegawai }}</strong><br>
                            <span style="font-size: 9px; color: #555;">{{ $d->nip }}</span>
                        </td>
                        <td>
                            {{ $d->asal_instansi }}<br>
                            <span style="font-size: 9px; color: #555;">{{ $d->status_kepegawaian }}</span>
                        </td>
                        <td>{{ $d->jabatan }}</td>
                        <td class="center">
                            @if($d->user)
                                {{ $d->user->name }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="center" style="font-style: italic; color: #777; padding: 15px;">Belum ada master data pegawai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @else
        <table class="data-table">
            <thead>
                @if($kategori == 'tanggapan')
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 20%;">Tiket Kasus</th>
                        <th style="width: 20%;">Nama Pengirim</th>
                        <th style="width: 20%;">Keterangan</th>
                        <th style="width: 35%;">Isi Informasi Tambahan</th>
                    </tr>
                @else
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">No Tiket</th>
                        <th style="width: 25%;">Judul Laporan / Kasus</th>
                        @if($kategori == 'kasus')
                            <th style="width: 15%;">Nama Pelapor</th>
                            <th style="width: 12%;">Tgl Masuk</th>
                            <th style="width: 15%;">Tingkat</th>
                            <th style="width: 13%;">Status</th>
                        @elseif($kategori == 'investigasi')
                            <th style="width: 25%;">Fakta Lapangan</th>
                            <th style="width: 30%;">Kesimpulan Akhir</th>
                        @elseif($kategori == 'tindaklanjut')
                            <th style="width: 25%;">Instansi Penindak</th>
                            <th style="width: 30%;">Sanksi / Keputusan Final</th>
                        @elseif($kategori == 'bukti')
                            <th style="width: 28%;">Status Bukti Pelapor</th>
                            <th style="width: 27%;">Status Bukti Investigasi</th>
                        @endif
                    </tr>
                @endif
            </thead>
            <tbody>
                @forelse($data as $index => $d)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        @if($kategori == 'tanggapan')
                            <td style="font-family: monospace; font-weight: bold;">{{ $d->kode_tiket }}</td>
                            <td>{{ $d->user->name ?? $d->nama_pelapor ?? 'Pelapor' }}</td>
                            <td>Informasi Susulan</td>
                            <td><em>"{{ $d->pesan_susulan }}"</em></td>
                        @else
                            <td style="font-family: monospace; font-weight: bold;">{{ $d->kode_tiket }}</td>
                            <td>{{ $d->judul_laporan }}</td>
                            
                            @if($kategori == 'kasus')
                                <td>{{ $d->user->name ?? 'Anonim' }}</td>
                                <td class="center">{{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}</td>
                                <td class="center" style="font-weight: bold;">{{ $d->tingkat_pelanggaran ?? '-' }}</td>
                                <td class="center" style="font-weight: bold; text-transform: uppercase;">{{ $d->status }}</td>
                            @elseif($kategori == 'investigasi')
                                <td>{{ $d->fakta_lapangan ?? '-' }}</td>
                                <td>{{ $d->kesimpulan ?? '-' }}</td>
                            @elseif($kategori == 'tindaklanjut')
                                <td>{{ $d->pihak_penindak ?? '-' }}</td>
                                <td>{{ $d->tindak_lanjut ?? '-' }}</td>
                            @elseif($kategori == 'bukti')
                                <td class="center" style="font-weight: bold;">
                                    {{ $d->lampiran_bukti ? '[ADA] Tersedia File' : '[-] Tidak Ada' }}
                                </td>
                                <td class="center" style="font-weight: bold;">
                                    {{ $d->bukti_investigasi ? '[ADA] Tersedia Foto' : '[-] Tidak Ada' }}
                                </td>
                            @endif
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="center" style="font-style: italic; color: #777; padding: 15px;">Belum ada arsip data untuk kategori rekapitulasi ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif

    <br><br>
    <table style="border-collapse: collapse; border: none; width: 100%;">
        <tr>
            <td style="border: none; width: 60%;"></td>
            <td style="border: none; width: 40%; text-align: center;">
                Banjarmasin, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>
                Mengetahui,<br>
                <strong>Kepala Inspektorat Kota Banjarmasin</strong><br><br><br><br><br>
                <strong>(...................................................)</strong><br>
                NIP. ........................................
            </td>
        </tr>
    </table>

</body>
</html>