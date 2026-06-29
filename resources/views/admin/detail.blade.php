<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berkas Kasus Admin - SAPA PEMKO</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'bjm-dark': '#0f172a',
                        'bjm-light': '#1e293b',
                        'bjm-gold': '#d97706',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen font-sans" x-data="{ tab: 'laporan' }">

    <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8 z-20 sticky top-0">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="text-slate-500 hover:text-bjm-gold flex items-center gap-2 transition font-medium text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>
            <span class="text-slate-300 hidden sm:inline">|</span>
            <span class="font-bold text-lg text-bjm-dark hidden sm:inline">Manajemen Berkas</span>
        </div>
        
        <div>
            <a href="{{ route('admin.kasus.cetak', $pengaduan->id) }}" target="_blank" class="bg-bjm-gold hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan PDF
            </a>
        </div>
    </header>

    <div class="bg-bjm-dark pt-8 pb-24 px-4 sm:px-6 lg:px-8 border-b-4 border-bjm-gold">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <div>
                <p class="text-slate-300 text-sm font-medium mb-1">Tiket Pengaduan</p>
                <h1 class="text-3xl font-bold text-white">#{{ $pengaduan->kode_tiket }}</h1>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 pb-12">
        
        <div class="bg-white border border-slate-200 rounded-xl p-6 flex flex-col md:flex-row justify-between items-center shadow-sm gap-4 mb-6">
            <div>
                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Status Kasus Saat Ini:</p>
                @if($pengaduan->status == 'masuk' || $pengaduan->status == 'pending')
                    <span class="bg-slate-100 text-slate-700 border border-slate-200 px-4 py-2 rounded-lg font-bold text-sm tracking-wide uppercase flex items-center gap-2 inline-flex">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menunggu Verifikasi
                    </span>
                @elseif($pengaduan->status == 'investigasi')
                    <span class="bg-blue-50 text-blue-700 border border-blue-200 px-4 py-2 rounded-lg font-bold text-sm tracking-wide uppercase flex items-center gap-2 inline-flex">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Sedang Diinvestigasi
                    </span>
                @elseif($pengaduan->status == 'selesai')
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-2 rounded-lg font-bold text-sm tracking-wide uppercase flex items-center gap-2 inline-flex">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Kasus Selesai
                    </span>
                @elseif($pengaduan->status == 'ditolak')
                    <span class="bg-red-50 text-red-700 border border-red-200 px-4 py-2 rounded-lg font-bold text-sm tracking-wide uppercase flex items-center gap-2 inline-flex">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Laporan Ditolak
                    </span>
                @endif
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-1">Didaftarkan Pada:</p>
                <p class="text-slate-800 font-bold">{{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <div class="mb-6 flex space-x-4 border-b border-slate-200 pb-px overflow-x-auto">
            <button @click="tab = 'laporan'" 
                :class="tab === 'laporan' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 hover:border-slate-300 border-b-2 border-transparent'"
                class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Data Kasus
            </button>

            @if($pengaduan->status != 'masuk' && $pengaduan->status != 'pending')
            <button @click="tab = 'verifikasi'" 
                :class="tab === 'verifikasi' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 hover:border-slate-300 border-b-2 border-transparent'"
                class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                Verifikasi
            </button>
            @endif

            @if($pengaduan->status == 'selesai' || $pengaduan->status == 'investigasi')
            <button @click="tab = 'investigasi'" 
                :class="tab === 'investigasi' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 hover:border-slate-300 border-b-2 border-transparent'"
                class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Hasil Investigasi
            </button>
            @endif

            @if($pengaduan->status == 'selesai')
            <button @click="tab = 'keputusan'" 
                :class="tab === 'keputusan' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 hover:border-slate-300 border-b-2 border-transparent'"
                class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                Keputusan Akhir
            </button>
            @endif

            <button @click="tab = 'tanggapan'" 
                :class="tab === 'tanggapan' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-slate-800 hover:border-slate-300 border-b-2 border-transparent'"
                class="pb-3 px-2 font-semibold text-sm transition flex items-center gap-2 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Tanggapan Pelapor
                @if($pengaduan->tanggapans && $pengaduan->tanggapans->count() > 0)
                    <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full ml-1">{{ $pengaduan->tanggapans->count() }}</span>
                @endif
            </button>
        </div>

        <div x-show="tab === 'laporan'" x-transition.opacity class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Identitas Pelapor</p>
                        <p class="text-slate-800 font-bold text-lg">{{ $pengaduan->nama_pelapor }}</p>
                        <p class="text-slate-600 mt-1">{{ $pengaduan->nomor_hp }}</p>
                        <p class="text-slate-600">{{ $pengaduan->email }}</p>
                        @if($pengaduan->nip) <p class="text-slate-600 mt-1"><span class="font-medium">NIP:</span> {{ $pengaduan->nip }}</p> @endif
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Detail Kejadian</p>
                        <p class="text-slate-800 font-medium mb-1">{{ $pengaduan->kategori_laporan }}</p>
                        <p class="text-slate-600 mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d F Y') }}
                        </p>
                        <p class="text-slate-600 flex items-start gap-2">
                            <svg class="w-4 h-4 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $pengaduan->lokasi_kejadian }}
                        </p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-3">Judul & Kronologi Laporan</p>
                    <div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
                        <p class="text-slate-800 font-bold text-lg mb-3 pb-3 border-b border-slate-200">{{ $pengaduan->judul_laporan }}</p>
                        <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->isi_laporan }}</p>
                    </div>
                </div>

                @if($pengaduan->lampiran_bukti)
                <div class="pt-6 border-t border-slate-200">
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-3">Bukti dari Pelapor</p>
                    <a href="{{ asset('storage/' . $pengaduan->lampiran_bukti) }}" target="_blank" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-medium px-5 py-2.5 rounded-lg text-sm transition shadow-sm">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        Lihat Dokumen / Foto Lampiran
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if($pengaduan->status != 'masuk' && $pengaduan->status != 'pending')
        <div x-show="tab === 'verifikasi'" x-transition.opacity style="display: none;" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-8">
                @if($pengaduan->status == 'ditolak')
                    <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                        <p class="text-xs text-red-600 uppercase font-bold tracking-wider mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Alasan Penolakan
                        </p>
                        <p class="text-red-800 font-medium">{{ $pengaduan->alasan_penolakan }}</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Tingkat Pelanggaran</p>
                            <span class="text-sm font-bold px-4 py-1.5 rounded-full inline-block mt-1 border
                                {{ $pengaduan->tingkat_pelanggaran == 'Berat' ? 'bg-red-50 text-red-700 border-red-200' : 
                                    ($pengaduan->tingkat_pelanggaran == 'Sedang' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200') }}">
                                {{ $pengaduan->tingkat_pelanggaran }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Investigator Ditugaskan</p>
                            <div class="flex items-center gap-3 mt-1">
                                <div class="w-8 h-8 rounded-full bg-bjm-light text-white flex items-center justify-center font-bold">
                                    {{ substr($pengaduan->investigator->name ?? 'T', 0, 1) }}
                                </div>
                                <p class="text-slate-800 font-bold">{{ $pengaduan->investigator->name ?? 'Belum ada / Tim Lapangan' }}</p>
                            </div>
                        </div>
                    </div>
                    @if($pengaduan->catatan_verifikator)
                    <div class="bg-amber-50 p-6 rounded-xl border border-amber-200">
                        <p class="text-xs text-amber-700 uppercase font-bold tracking-wider mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Instruksi Khusus Verifikator
                        </p>
                        <p class="text-amber-900 italic font-medium">"{{ $pengaduan->catatan_verifikator }}"</p>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        @endif

        @if($pengaduan->status == 'selesai' || $pengaduan->status == 'investigasi')
        <div x-show="tab === 'investigasi'" x-transition.opacity style="display: none;" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-8">
                <div class="space-y-6">
                    <div>
                        <p class="text-xs text-bjm-gold uppercase font-bold tracking-wider mb-2">1. Fakta Ditemukan di Lapangan</p>
                        <div class="bg-slate-50 border border-slate-200 p-5 rounded-xl">
                            <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->fakta_lapangan ?? '-' }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-bjm-gold uppercase font-bold tracking-wider mb-2">2. Pihak Terlibat / Saksi</p>
                        <div class="bg-slate-50 border border-slate-200 p-5 rounded-xl">
                            <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->pihak_terlibat ?? '-' }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-bjm-gold uppercase font-bold tracking-wider mb-2">3. Kesimpulan & Rekomendasi</p>
                        <div class="bg-slate-50 border border-slate-200 p-5 rounded-xl">
                            <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->kesimpulan ?? '-' }}</p>
                        </div>
                    </div>

                    @if($pengaduan->bukti_investigasi)
                    <div class="pt-6 border-t border-slate-200">
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-3">Bukti Temuan Investigasi</p>
                        <a href="{{ asset('storage/' . $pengaduan->bukti_investigasi) }}" target="_blank" class="inline-flex items-center gap-2 bg-bjm-dark hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg text-sm transition font-bold shadow-sm border border-slate-700">
                            <svg class="w-5 h-5 opacity-90 text-bjm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Lihat Foto/Dokumen Lapangan
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($pengaduan->status == 'selesai')
        <div x-show="tab === 'keputusan'" x-transition.opacity style="display: none;" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-8">
                <div class="mb-8 flex items-center gap-4 border-b border-slate-200 pb-5">
                    <div class="bg-emerald-50 p-3 rounded-xl text-emerald-600 border border-emerald-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Keputusan Resmi & Sanksi</h3>
                        <p class="text-sm text-slate-500">Hasil akhir dari penanganan kasus berdasarkan verifikasi dan investigasi.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Instansi / Pihak Penindak</p>
                        <p class="text-slate-800 font-bold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5 text-bjm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            {{ $pengaduan->pihak_penindak ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-2">Tanggal Eksekusi Sanksi</p>
                        <p class="text-slate-800 font-bold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $pengaduan->tanggal_tindak_lanjut ? \Carbon\Carbon::parse($pengaduan->tanggal_tindak_lanjut)->format('d F Y') : '-' }}
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider mb-3">Rincian Keputusan Sanksi / Tindak Lanjut</p>
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <p class="text-slate-700 leading-relaxed whitespace-pre-line font-medium">{{ $pengaduan->tindak_lanjut ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div x-show="tab === 'tanggapan'" x-transition.opacity style="display: none;" class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-8">
                <div class="flex items-center gap-3 mb-6 border-b border-slate-200 pb-4">
                    <div class="bg-bjm-gold/10 p-2 rounded-lg text-bjm-gold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Riwayat Pesan & Tanggapan</h3>
                        <p class="text-xs text-slate-500">Pesan, desakan, dan lampiran bukti tambahan dari pelapor.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    @if(isset($pengaduan->tanggapans) && $pengaduan->tanggapans->count() > 0)
                        @foreach($pengaduan->tanggapans as $t)
                        <div class="bg-slate-50 border border-slate-200 p-5 rounded-xl flex gap-4">
                            <div class="w-10 h-10 rounded-full bg-bjm-gold text-white flex items-center justify-center font-bold flex-shrink-0 mt-1 shadow-sm">
                                {{ substr($t->user->name ?? 'P', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-2">
                                    <div class="flex items-center gap-3">
                                        <p class="text-slate-800 font-bold">{{ $t->user->name ?? 'Pelapor' }}</p>
                                        <span class="bg-bjm-gold/10 text-bjm-gold border border-bjm-gold/20 text-[10px] uppercase tracking-wide font-bold px-2.5 py-0.5 rounded-full">
                                            {{ $t->kategori_tanggapan ?? 'Pesan / Progres' }}
                                        </span>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-400 bg-white border border-slate-200 px-2 py-1 rounded-md inline-block">
                                        {{ $t->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg border border-slate-200 text-slate-700 leading-relaxed shadow-sm">
                                    <p>{{ $t->pesan }}</p>
                                    
                                    @if($t->lampiran_tambahan)
                                    <div class="mt-4 pt-3 border-t border-slate-100">
                                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-2">Lampiran Tersertakan:</p>
                                        <a href="{{ asset('storage/' . $t->lampiran_tambahan) }}" target="_blank" class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 font-medium px-4 py-2 rounded-lg text-sm transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                            Buka Dokumen / Bukti Susulan
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-10 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <p class="text-slate-500 font-medium">Belum ada tanggapan atau pesan masuk dari pelapor untuk tiket ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</body>
</html>