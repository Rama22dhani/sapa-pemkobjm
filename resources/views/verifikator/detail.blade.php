<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Verifikasi - Sistem Pelaporan Pelanggaran</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bjm-blue': '#0f172a',
                        'bjm-surface': '#1e293b',
                        'bjm-gold': '#d97706',
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen font-sans">

    <nav class="bg-bjm-blue border-b-4 border-bjm-gold sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('verifikator.dashboard') }}" class="text-white/70 hover:text-white flex items-center gap-2 transition font-medium text-sm bg-white/10 px-3 py-1.5 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <span class="text-slate-500 mx-2">|</span>
                    <span class="font-extrabold text-lg text-white tracking-wide">Detail Tiket <span class="text-bjm-gold">#{{ $pengaduan->kode_tiket }}</span></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-gradient-to-b from-white to-slate-50 border border-slate-200 rounded-2xl p-8 shadow-md">
                    <h3 class="text-xl font-black text-bjm-blue mb-6 border-b border-slate-200 pb-4">Dokumen Laporan Masuk</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Identitas Pelapor</p>
                            <p class="font-bold text-slate-800 text-lg">{{ $pengaduan->nama_pelapor }}</p>
                            <p class="text-sm text-slate-500 font-medium">{{ $pengaduan->nomor_hp }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori Pelanggaran</p>
                            <span class="inline-block bg-blue-50 text-blue-600 border border-blue-100 font-bold px-3 py-1 rounded-lg text-sm">{{ $pengaduan->kategori_laporan }}</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal Kejadian</p>
                            <p class="font-bold text-slate-800 flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Lokasi Kejadian</p>
                            <p class="font-bold text-slate-800 flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $pengaduan->lokasi_kejadian }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-8 bg-slate-50 p-6 rounded-xl border border-slate-200 shadow-inner">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Kronologi / Uraian Kejadian</p>
                        <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $pengaduan->isi_laporan }}</p>
                    </div>

                    @if($pengaduan->lampiran_bukti)
                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Bukti Lampiran Fisik/Digital</p>
                        <a href="{{ asset('storage/' . $pengaduan->lampiran_bukti) }}" target="_blank" class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-5 py-2.5 rounded-xl border border-blue-200 hover:bg-blue-600 hover:text-white font-bold transition shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            Lihat / Unduh Dokumen Bukti
                        </a>
                    </div>
                    @else
                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Bukti Lampiran Fisik/Digital</p>
                        <div class="text-slate-400 italic text-sm bg-slate-50 py-3 px-4 rounded-lg inline-block border border-slate-100">Tidak ada file bukti yang dilampirkan pelapor.</div>
                    </div>
                    @endif
                </div>

                <div class="bg-gradient-to-b from-white to-slate-50 border border-slate-200 rounded-2xl overflow-hidden shadow-md mb-10">
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-6 border-b border-slate-200 pb-5">
                            <div class="bg-amber-50 p-2.5 rounded-xl text-bjm-gold border border-amber-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-bjm-blue">Riwayat Komunikasi & Tanggapan</h3>
                                <p class="text-sm text-slate-500 font-medium">Pesan, desakan, atau bukti susulan dari pihak pelapor.</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            @if(isset($pengaduan->tanggapans) && $pengaduan->tanggapans->count() > 0)
                                @foreach($pengaduan->tanggapans as $t)
                                <div class="bg-white border border-slate-200 p-5 rounded-2xl flex gap-4 shadow-sm">
                                    <div class="w-12 h-12 rounded-full bg-bjm-blue text-bjm-gold flex items-center justify-center font-black text-lg flex-shrink-0 shadow-inner border-2 border-slate-100">
                                        {{ substr($t->user->name ?? 'P', 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                            <div class="flex items-center gap-3">
                                                <p class="text-slate-800 font-bold text-lg">{{ $t->user->name ?? 'Pelapor' }}</p>
                                                <span class="bg-blue-50 text-blue-600 border border-blue-100 text-[10px] uppercase tracking-wider font-extrabold px-2.5 py-1 rounded-md">
                                                    {{ $t->kategori_tanggapan ?? 'Pesan / Progres' }}
                                                </span>
                                            </div>
                                            <p class="text-xs font-bold text-slate-500 bg-slate-50 border border-slate-200 px-2.5 py-1 rounded-md shadow-sm">
                                                {{ $t->created_at->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                        
                                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 text-slate-700 leading-relaxed text-sm">
                                            <p>{{ $t->pesan }}</p>
                                            
                                            @if($t->lampiran_tambahan)
                                            <div class="mt-4 pt-4 border-t border-slate-200">
                                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-2">Lampiran Tersertakan:</p>
                                                <a href="{{ asset('storage/' . $t->lampiran_tambahan) }}" target="_blank" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 font-bold px-4 py-2 rounded-lg text-xs transition shadow-sm">
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                                    Buka Dokumen / Bukti Susulan
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-10 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    <p class="text-slate-500 font-semibold text-sm">Belum ada tanggapan atau pesan masuk dari pelapor untuk tiket ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1" x-data="{ mode: 'proses' }"> 
                <div class="sticky top-24">
                    
                    <div class="flex bg-slate-200 p-1.5 rounded-xl mb-6 shadow-inner">
                        <button @click="mode = 'proses'" 
                            :class="mode === 'proses' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                            class="flex-1 py-2.5 text-sm font-bold rounded-lg transition duration-200">
                            ✅ SETUJUI (PROSES)
                        </button>
                        <button @click="mode = 'tolak'" 
                            :class="mode === 'tolak' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                            class="flex-1 py-2.5 text-sm font-bold rounded-lg transition duration-200">
                            ⛔ TOLAK LAPORAN
                        </button>
                    </div>

                    <div x-show="mode === 'proses'" x-transition>
                        <div class="bg-gradient-to-b from-white to-emerald-50/40 border border-slate-200 border-l-4 border-l-emerald-500 rounded-2xl p-6 shadow-lg relative overflow-hidden">
                            
                            <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2 border-b border-slate-200 pb-4">
                                Tindakan Verifikasi
                            </h3>

                            <form action="{{ route('verifikator.update', $pengaduan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-5">
                                    <label class="block text-sm font-bold mb-2 text-slate-700">Tentukan Tingkat Pelanggaran</label>
                                    <select name="tingkat_pelanggaran" class="w-full bg-white border border-slate-300 text-slate-800 rounded-xl p-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none shadow-sm transition" required>
                                        <option value="">-- Pilih Klasifikasi --</option>
                                        <option value="Ringan">🟢 Ringan (Administrasi)</option>
                                        <option value="Sedang">🟡 Sedang (Etika/Disiplin)</option>
                                        <option value="Berat">🔴 Berat (Pidana/Korupsi)</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label class="block text-sm font-bold mb-2 text-slate-700">Tugaskan Kepada Investigator</label>
                                    <select name="investigator_id" class="w-full bg-white border border-slate-300 text-slate-800 rounded-xl p-3 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none shadow-sm transition" required>
                                        <option value="">-- Pilih Investigator --</option>
                                        @foreach($investigators as $inv)
                                            <option value="{{ $inv->id }}">{{ $inv->name }} (Tim Lapangan)</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-8">
                                    <label class="block text-sm font-bold mb-2 text-slate-700">Instruksi Khusus (Opsional)</label>
                                    <textarea name="catatan_verifikator" rows="3" class="w-full bg-white border border-slate-300 text-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none shadow-sm transition" placeholder="Beri catatan panduan untuk investigator..."></textarea>
                                </div>

                                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-emerald-500/30 transition transform hover:-translate-y-1">
                                    🚀 Setujui & Teruskan
                                </button>
                            </form>
                        </div>
                    </div>

                    <div x-show="mode === 'tolak'" style="display: none;" x-transition>
                        <div class="bg-gradient-to-b from-white to-red-50/40 border border-slate-200 border-l-4 border-l-red-500 rounded-2xl p-6 shadow-lg relative overflow-hidden">

                            <h3 class="text-lg font-black text-red-600 mb-4 flex items-center gap-2 border-b border-red-100 pb-4">
                                Batalkan / Tolak Laporan
                            </h3>
                            
                            <div class="bg-red-50 border border-red-200 p-4 rounded-xl mb-6 text-sm text-red-700 font-medium shadow-sm">
                                ⚠️ Perhatian: Laporan akan ditutup dan statusnya menjadi <b>DITOLAK</b>. Tindakan ini akan menghentikan proses secara permanen.
                            </div>

                            <form action="{{ route('verifikator.tolak', $pengaduan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-8">
                                    <label class="block text-sm font-bold mb-2 text-slate-700">Alasan Penolakan (Wajib)</label>
                                    <textarea name="alasan_penolakan" rows="5" class="w-full bg-white border border-red-300 text-slate-800 rounded-xl p-3 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none shadow-sm transition" placeholder="Jelaskan secara detail mengapa laporan ini ditolak (misal: Bukti tidak valid, bukan wewenang Pemko, dll)..." required></textarea>
                                </div>

                                <button type="submit" onclick="return confirm('Apakah Anda sangat yakin ingin menolak laporan ini secara permanen?')" class="w-full bg-red-600 hover:bg-red-500 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-500/30 transition transform hover:-translate-y-1">
                                    ⛔ Eksekusi Penolakan
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>