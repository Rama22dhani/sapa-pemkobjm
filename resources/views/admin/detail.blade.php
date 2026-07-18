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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-2">Identitas Pelapor</p>
                    <p class="text-slate-800 font-bold text-lg">{{ $pengaduan->nama_pelapor }}</p>
                    <p class="text-slate-600 text-sm">{{ $pengaduan->nomor_hp }} | {{ $pengaduan->email }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold mb-2">Tingkat Pelanggaran</p>
                    <span class="px-4 py-1.5 text-xs rounded-full font-bold border {{ $pengaduan->tingkat_pelanggaran == 'Berat' ? 'bg-red-50 text-red-700 border-red-200' : ($pengaduan->tingkat_pelanggaran == 'Sedang' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200') }}">
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
                    <a href="{{ asset('storage/' . $pengaduan->lampiran_susulan) }}" target="_blank" class="mt-4 inline-block text-xs font-bold text-cyan-700 hover:underline">📎 Lihat Lampiran Bukti Tambahan</a>
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
            <div>
                <p class="text-xs text-bjm-gold uppercase font-bold mb-2">Fakta Lapangan</p>
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->fakta_lapangan ?? '-' }}</div>
            </div>
            <div>
                <p class="text-xs text-bjm-gold uppercase font-bold mb-2">Kesimpulan & Rekomendasi</p>
                <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->kesimpulan ?? '-' }}</div>
            </div>
        </div>
        @endif

        <!-- TAB: TINDAK LANJUT -->
        @if($pengaduan->status == 'selesai')
        <div x-show="tab === 'keputusan'" style="display: none;" class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-6">
            <div>
                <p class="text-xs text-emerald-600 uppercase font-bold mb-2">Instansi Penindak</p>
                <p class="text-slate-800 font-bold text-lg">{{ $pengaduan->pihak_penindak ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-emerald-600 uppercase font-bold mb-2">Detail Keputusan / Sanksi</p>
                <div class="bg-emerald-50 p-6 rounded-xl border border-emerald-100 text-emerald-900 leading-relaxed whitespace-pre-line">{{ $pengaduan->tindak_lanjut ?? '-' }}</div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>