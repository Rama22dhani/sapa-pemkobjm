<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dasbor Verifikator - Sistem Pelaporan Pelanggaran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bjm-blue': '#0f172a',    // Biru Tua Identitas
                        'bjm-surface': '#1e293b', // Biru Aksen
                        'bjm-gold': '#d97706',    // Emas Identitas
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<!-- Latar Belakang Terang -->
<body class="bg-slate-50 font-sans text-slate-800 min-h-screen" x-data="{ tab: 'pending' }">

    <!-- NAVBAR BIRU TUA & EMAS -->
    <nav class="bg-bjm-blue border-b-4 border-bjm-gold sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="bg-bjm-gold p-1.5 rounded-lg shadow-md text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="font-bold text-lg tracking-wide text-white">RUANG VERIFIKASI</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-bjm-gold uppercase tracking-wider font-bold">Petugas Verifikasi</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white/10 hover:bg-red-500 text-red-400 hover:text-white p-2.5 rounded-full transition duration-300" title="Keluar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- HEADER & STATISTIK -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-bjm-blue">Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h1>
                <p class="text-slate-500 mt-1.5 text-lg">Silakan periksa dan verifikasi laporan yang masuk hari ini.</p>
            </div>
            
            <div class="flex gap-4 w-full md:w-auto">
                <!-- KOTAK STATISTIK DENGAN GRADASI -->
                <div class="bg-gradient-to-br from-white to-slate-100 px-5 py-3 rounded-xl border border-slate-200 border-l-4 border-l-bjm-gold shadow-md flex items-center gap-4 w-full md:w-auto">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Perlu Tindakan</p>
                        <p class="font-black text-bjm-blue text-2xl leading-none mt-0.5">{{ $pending->count() }}</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-white to-slate-100 px-5 py-3 rounded-xl border border-slate-200 border-l-4 border-l-bjm-gold shadow-md flex items-center gap-4 w-full md:w-auto">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">Sudah Diproses</p>
                        <p class="font-black text-bjm-blue text-2xl leading-none mt-0.5">{{ $riwayat->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl flex items-center gap-3 shadow-sm">
            <div class="bg-emerald-100 p-1.5 rounded-lg text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        @endif

        <!-- TAB MENU -->
        <div class="mb-8 border-b border-slate-200 flex gap-8">
            <button @click="tab = 'pending'" 
                :class="tab === 'pending' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-bjm-blue'"
                class="pb-4 font-bold text-sm transition flex items-center gap-2">
                ⏳ Tugas Masuk
                @if($pending->count() > 0)
                <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full ml-1">{{ $pending->count() }}</span>
                @endif
            </button>

            <button @click="tab = 'riwayat'" 
                :class="tab === 'riwayat' ? 'border-b-2 border-bjm-gold text-bjm-gold' : 'text-slate-500 hover:text-bjm-blue'"
                class="pb-4 font-bold text-sm transition flex items-center gap-2">
                📜 Riwayat Verifikasi
            </button>
        </div>

        <!-- KONTEN: TUGAS MASUK -->
        <div x-show="tab === 'pending'" x-transition.opacity>
            @if($pending->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pending as $p)
                    <!-- KARTU TUGAS DENGAN GRADASI -->
                    <div class="bg-gradient-to-b from-white to-slate-50 border border-slate-200 rounded-2xl p-6 shadow-md hover:shadow-xl hover:border-bjm-gold/50 transition duration-300 flex flex-col justify-between group">
                        
                        <div>
                            <div class="flex justify-between items-center mb-5">
                                <span class="bg-bjm-surface text-white font-bold text-xs px-3 py-1 rounded-md font-mono tracking-wider">{{ $p->kode_tiket }}</span>
                                <span class="text-xs font-semibold text-slate-400 bg-white border border-slate-200 shadow-sm px-2 py-1 rounded-md">{{ $p->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <h3 class="text-lg font-black text-bjm-blue mb-2 line-clamp-1" title="{{ $p->judul_laporan }}">{{ $p->judul_laporan }}</h3>
                            <p class="text-slate-600 text-sm mb-5 line-clamp-3 leading-relaxed">
                                {{ $p->isi_laporan }}
                            </p>
                        </div>
                        
                        <div>
                            <div class="flex items-center gap-2 mb-5 border-t border-slate-200 pt-4">
                                <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 border border-blue-100 text-xs font-extrabold uppercase tracking-wide">
                                    {{ $p->kategori_laporan }}
                                </span>
                            </div>

                            <a href="{{ route('verifikator.show', $p->id) }}" class="flex items-center justify-center gap-2 w-full bg-bjm-gold hover:bg-amber-600 text-white text-center font-bold py-3 rounded-xl transition shadow-md shadow-amber-500/20">
                                Periksa Laporan 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- KOTAK KOSONG DENGAN GRADASI -->
                <div class="bg-gradient-to-b from-white to-slate-100 border border-slate-200 rounded-2xl p-12 text-center shadow-md">
                    <div class="w-20 h-20 bg-white shadow-sm rounded-full flex items-center justify-center mx-auto mb-4 border border-emerald-100">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-bjm-blue mb-1">Semua Bersih!</h3>
                    <p class="text-slate-500">Tidak ada laporan baru yang perlu diverifikasi saat ini. Pekerjaan Anda selesai.</p>
                </div>
            @endif
        </div>

        <!-- KONTEN: RIWAYAT VERIFIKASI -->
        <div x-show="tab === 'riwayat'" x-transition.opacity style="display: none;">
            <!-- TABEL DENGAN GRADASI -->
            <div class="bg-gradient-to-b from-white to-slate-50 border border-slate-200 rounded-2xl overflow-hidden shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-bjm-blue text-white text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="p-5 pl-6">Tiket Kasus</th>
                                <th class="p-5">Tanggal Proses</th>
                                <th class="p-5">Judul Laporan</th>
                                <th class="p-5">Keputusan Anda</th>
                                <th class="p-5">Ditugaskan Kepada</th>
                                <th class="p-5 text-center pr-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 text-sm">
                            @forelse($riwayat as $r)
                            <tr class="hover:bg-slate-100/50 transition duration-200">
                                <td class="p-5 pl-6 font-mono font-bold text-bjm-gold">{{ $r->kode_tiket }}</td>
                                <td class="p-5 text-slate-500 font-medium">{{ $r->updated_at->format('d M Y, H:i') }}</td>
                                <td class="p-5 font-bold text-bjm-blue">{{ Str::limit($r->judul_laporan, 40) }}</td>
                                <td class="p-5">
                                    @if($r->status == 'ditolak')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-200 shadow-sm">
                                            ⛔ Ditolak
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 shadow-sm">
                                            ✅ Disetujui ({{ $r->tingkat_pelanggaran }})
                                        </span>
                                    @endif
                                </td>
                                <td class="p-5 text-slate-600 font-medium">
                                    @if($r->status == 'ditolak')
                                        <span class="text-slate-400 italic">-</span>
                                    @else
                                        {{ $r->investigator->name ?? 'Tim Lapangan' }}
                                    @endif
                                </td>
                                <td class="p-5 text-center pr-6">
                                    <a href="{{ route('verifikator.show', $r->id) }}" class="inline-flex items-center justify-center p-2 bg-bjm-blue/10 text-bjm-blue hover:bg-bjm-blue hover:text-white rounded-lg transition" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center">
                                    <div class="flex flex-col items-center opacity-60">
                                        <svg class="w-12 h-12 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                        <p class="text-slate-500 font-semibold italic text-base">Belum ada riwayat laporan yang diverifikasi.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>
</html>