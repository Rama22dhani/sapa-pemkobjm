<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Berkas Kasus - SAPA PEMKO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] }, colors: { 'bjm-dark': '#0f172a', 'bjm-gold': '#d97706', } } } }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen font-sans" x-data="{ tab: 'laporan' }">

    <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8 z-20 sticky top-0">
        <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-bjm-gold flex items-center gap-2 transition font-medium text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>
        <a href="{{ route('admin.kasus.cetak', $pengaduan->id) }}" target="_blank" class="bg-bjm-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 shadow-sm transition">
            🖨️ Cetak Laporan PDF
        </a>
    </header>

    <div class="bg-bjm-dark pt-8 pb-24 px-4 sm:px-6 lg:px-8 border-b-4 border-bjm-gold">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <div>
                <p class="text-slate-300 text-sm font-medium mb-1">Kode Kasus Pengaduan</p>
                <h1 class="text-3xl font-bold text-white">#{{ $pengaduan->kode_tiket }}</h1>
            </div>
            <span class="px-4 py-2 rounded-lg font-bold text-sm tracking-wide uppercase bg-white/10 text-white border border-white/20">
                {{ ucfirst($pengaduan->status) }}
            </span>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-12">
        
        <div class="mb-6 flex space-x-4 border-b border-slate-200 pb-px overflow-x-auto">
            <button @click="tab = 'laporan'" :class="tab === 'laporan' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 border-b-2 border-transparent'" class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2">Data Kasus</button>
            
            @if($pengaduan->status == 'selesai' || $pengaduan->status == 'investigasi')
            <button @click="tab = 'investigasi'" :class="tab === 'investigasi' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 border-b-2 border-transparent'" class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2">Hasil Investigasi</button>
            @endif
            
            @if($pengaduan->status == 'selesai')
            <button @click="tab = 'keputusan'" :class="tab === 'keputusan' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 border-b-2 border-transparent'" class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2">Tindak Lanjut</button>
            @endif
        </div>

        <!-- TAB: DATA KASUS -->
        <div x-show="tab === 'laporan'" class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-2">Identitas Pelapor</p>
                    <p class="text-slate-800 font-bold text-lg">{{ $pengaduan->nama_pelapor }}</p>
                    <p class="text-slate-600 text-sm mt-1">{{ $pengaduan->nomor_hp }} | {{ $pengaduan->email }}</p>
                    @if($pengaduan->nip)
                        <p class="text-slate-500 text-xs mt-1">NIP: {{ $pengaduan->nip }}</p>
                    @endif
                </div>
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-2">Detail Kejadian</p>
                    <p class="text-slate-800 font-semibold text-sm">Lokasi: <span class="font-normal text-slate-600">{{ $pengaduan->lokasi_kejadian }}</span></p>
                    <p class="text-slate-800 font-semibold text-sm mt-1">Tanggal: <span class="font-normal text-slate-600">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d M Y') }}</span></p>
                    <p class="text-slate-800 font-semibold text-sm mt-1">Kategori: <span class="font-normal text-slate-600">{{ $pengaduan->kategori_laporan }}</span></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-2">Tingkat Pelanggaran</p>
                    <span class="px-4 py-1.5 text-xs rounded-full font-bold border inline-block mt-1 {{ $pengaduan->tingkat_pelanggaran == 'Berat' ? 'bg-red-50 text-red-700 border-red-200' : ($pengaduan->tingkat_pelanggaran == 'Sedang' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200') }}">
                        {{ $pengaduan->tingkat_pelanggaran ?? 'Belum Ditentukan' }}
                    </span>
                </div>
            </div>

            <div>
                <p class="text-xs text-slate-500 uppercase font-bold mb-3">Isi Laporan</p>
                <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                    <p class="text-slate-800 font-bold mb-3 pb-3 border-b border-slate-200">{{ $pengaduan->judul_laporan }}</p>
                    <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->isi_laporan }}</p>
                </div>
            </div>

            @if($pengaduan->pesan_susulan)
            <div class="bg-cyan-50 border border-cyan-100 p-6 rounded-xl">
                <p class="text-xs text-cyan-800 uppercase font-bold mb-3">Informasi Tambahan Pelapor</p>
                <p class="text-cyan-900 italic font-medium">"{{ $pengaduan->pesan_susulan }}"</p>
                @if($pengaduan->lampiran_susulan)
                    <a href="{{ \Illuminate\Support\Str::startsWith($pengaduan->lampiran_susulan, ['bukti_susulan/', 'bukti_pengaduan/']) ? asset('storage/' . $pengaduan->lampiran_susulan) : asset('uploads/pengaduan/' . $pengaduan->lampiran_susulan) }}" target="_blank" class="mt-4 inline-block text-xs font-bold text-cyan-700 hover:underline">📎 Lihat Lampiran Bukti Tambahan</a>
                @endif
            </div>
            @endif

            <div class="flex gap-4 pt-4 border-t border-slate-100">
                @if($pengaduan->lampiran_bukti)
                <a href="{{ asset('storage/' . $pengaduan->lampiran_bukti) }}" target="_blank" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-bold px-5 py-2.5 rounded-lg text-sm transition shadow-sm">📎 Lihat Bukti Awal</a>
                @endif
            </div>
        </div>

        <!-- TAB: INVESTIGASI -->
        @if($pengaduan->status == 'selesai' || $pengaduan->status == 'investigasi')
        <div x-show="tab === 'investigasi'" style="display: none;" class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-slate-100 pb-6">
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-1">Investigator Lapangan</p>
                    <p class="text-slate-800 font-bold text-base flex items-center gap-2">
                        <span>🕵️‍♂️</span> {{ $pengaduan->investigator->name ?? 'Belum Ditugaskan' }}
                    </p>
                    <p class="text-slate-500 text-xs mt-0.5">{{ $pengaduan->investigator->email ?? '' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-2">Bukti Temuan Lapangan</p>
                    @if($pengaduan->bukti_investigasi)
                        <a href="{{ asset('storage/' . $pengaduan->bukti_investigasi) }}" target="_blank" class="inline-flex items-center gap-2 bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold px-4 py-2 rounded-lg text-xs border border-purple-200 transition shadow-sm">
                            📎 Lihat Lampiran Bukti Temuan
                        </a>
                    @else
                        <span class="text-slate-400 italic text-xs">Tidak ada lampiran bukti temuan</span>
                    @endif
                </div>
            </div>
            
            <div>
                <p class="text-xs text-bjm-gold uppercase font-bold mb-2">Fakta Lapangan</p>
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->fakta_lapangan ?? '-' }}</div>
            </div>
            <div>
                <p class="text-xs text-bjm-gold uppercase font-bold mb-2">Pihak Terkait / Saksi</p>
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->pihak_terlibat ?? '-' }}</div>
            </div>
            <div>
                <p class="text-xs text-bjm-gold uppercase font-bold mb-2">Kesimpulan & Rekomendasi</p>
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->kesimpulan ?? '-' }}</div>
            </div>
        </div>
        @endif

        <!-- TAB: TINDAK LANJUT -->
        @if($pengaduan->status == 'selesai')
        <div x-show="tab === 'keputusan'" style="display: none;" class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-8">
            <!-- REKAP DATA KASUS -->
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold mb-3 border-b border-slate-100 pb-2">1. Data Kasus Laporan</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50 p-5 rounded-xl border border-slate-100 mb-4">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Judul Laporan</p>
                        <p class="text-sm font-bold text-slate-800 mt-0.5">{{ $pengaduan->judul_laporan }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Kategori & Tanggal Kejadian</p>
                        <p class="text-sm font-medium text-slate-700 mt-0.5">{{ $pengaduan->kategori_laporan }} | {{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Tingkat Pelanggaran</p>
                        <p class="mt-1">
                            @if($pengaduan->tingkat_pelanggaran)
                                <span class="px-2.5 py-1 text-[10px] uppercase rounded font-bold border 
                                    {{ $pengaduan->tingkat_pelanggaran == 'Berat' ? 'bg-red-50 text-red-600 border-red-200' : 
                                    ($pengaduan->tingkat_pelanggaran == 'Sedang' ? 'bg-amber-50 text-amber-600 border-amber-200' : 
                                    'bg-emerald-50 text-emerald-600 border-emerald-200') }}">
                                    {{ $pengaduan->tingkat_pelanggaran }}
                                </span>
                            @else
                                <span class="text-slate-400 italic text-[10px] font-bold">-</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-slate-50 p-5 rounded-xl border border-slate-100">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Lokasi Kejadian</p>
                        <p class="text-sm font-medium text-slate-700 mt-0.5">{{ $pengaduan->lokasi_kejadian }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Kronologi Kejadian</p>
                        <p class="text-sm text-slate-700 mt-0.5 whitespace-pre-line">{{ $pengaduan->isi_laporan }}</p>
                    </div>
                </div>
            </div>

            <!-- REKAP HASIL INVESTIGASI -->
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold mb-3 border-b border-slate-100 pb-2">2. Hasil Investigasi</p>
                <div class="bg-blue-50/50 p-5 rounded-xl border border-blue-100/50 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-bold text-blue-500 uppercase">Fakta Lapangan</p>
                            <p class="text-sm text-slate-700 mt-1 whitespace-pre-line">{{ $pengaduan->fakta_lapangan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-blue-500 uppercase">Pihak Terlibat</p>
                            <p class="text-sm text-slate-700 mt-1 whitespace-pre-line">{{ $pengaduan->pihak_terlibat ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-blue-100/50">
                        <p class="text-[10px] font-bold text-blue-500 uppercase">Kesimpulan Tim Investigasi</p>
                        <p class="text-sm text-slate-800 mt-1 font-semibold italic">"{{ $pengaduan->kesimpulan ?? 'Tidak ada kesimpulan' }}"</p>
                        <p class="text-xs font-semibold text-slate-500 mt-2">Oleh: {{ $pengaduan->investigator->name ?? 'Tim Lapangan' }}</p>
                    </div>
                </div>
            </div>

            <!-- REKAP ARSIP BUKTI -->
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold mb-3 border-b border-slate-100 pb-2">3. Arsip Bukti Terlampir</p>
                <div class="flex flex-wrap gap-4">
                    @if($pengaduan->lampiran_bukti)
                    <a href="{{ asset('storage/' . $pengaduan->lampiran_bukti) }}" target="_blank" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-bold px-4 py-2 rounded-lg text-xs transition shadow-sm">
                        📎 Bukti Awal Laporan
                    </a>
                    @else
                    <span class="inline-flex items-center gap-2 bg-slate-50 text-slate-400 border border-slate-200 font-medium px-4 py-2 rounded-lg text-xs">
                        ❌ Tidak ada Bukti Awal
                    </span>
                    @endif

                    @if($pengaduan->lampiran_susulan)
                    <a href="{{ \Illuminate\Support\Str::startsWith($pengaduan->lampiran_susulan, ['bukti_susulan/', 'bukti_pengaduan/']) ? asset('storage/' . $pengaduan->lampiran_susulan) : asset('uploads/pengaduan/' . $pengaduan->lampiran_susulan) }}" target="_blank" class="inline-flex items-center gap-2 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 font-bold px-4 py-2 rounded-lg text-xs transition shadow-sm">
                        📎 Bukti Tambahan
                    </a>
                    @else
                    <span class="inline-flex items-center gap-2 bg-slate-50 text-slate-400 border border-slate-200 font-medium px-4 py-2 rounded-lg text-xs">
                        ❌ Tidak ada Bukti Tambahan
                    </span>
                    @endif

                    @if($pengaduan->bukti_investigasi)
                    <a href="{{ asset('storage/' . $pengaduan->bukti_investigasi) }}" target="_blank" class="inline-flex items-center gap-2 bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200 font-bold px-4 py-2 rounded-lg text-xs transition shadow-sm">
                        📷 Bukti Temuan Lapangan
                    </a>
                    @else
                    <span class="inline-flex items-center gap-2 bg-slate-50 text-slate-400 border border-slate-200 font-medium px-4 py-2 rounded-lg text-xs">
                        ❌ Tidak ada Bukti Investigasi
                    </span>
                    @endif
                </div>
            </div>

            <!-- EKSEKUSI TINDAK LANJUT -->
            <div>
                <p class="text-xs text-emerald-600 uppercase font-bold mb-3 border-b border-emerald-100 pb-2">4. Keputusan & Tindak Lanjut Eksekusi</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase">Instansi Penindak</p>
                        <p class="text-slate-800 font-bold text-base flex items-center gap-2 mt-1">
                            <span>⚖️</span> {{ $pengaduan->pihak_penindak ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-emerald-600 uppercase">Tanggal Eksekusi</p>
                        <p class="text-slate-800 font-bold text-base flex items-center gap-2 mt-1">
                            <span>📅</span> {{ $pengaduan->tanggal_tindak_lanjut ? \Carbon\Carbon::parse($pengaduan->tanggal_tindak_lanjut)->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>
                <div class="bg-emerald-50 p-6 rounded-xl border border-emerald-100 text-emerald-900 leading-relaxed whitespace-pre-line text-sm">{{ $pengaduan->tindak_lanjut ?? '-' }}</div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>