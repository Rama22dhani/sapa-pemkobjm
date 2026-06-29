<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dasbor Admin - Aplikasi Manajemen Pelaporan Pegawai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
<body class="bg-slate-50 font-sans text-slate-800 antialiased" x-data="{ tab: 'beranda', sidebarOpen: false }">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden" style="display: none;"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 w-64 bg-bjm-dark text-slate-300 transition-transform duration-300 z-50 lg:translate-x-0 flex flex-col shadow-xl">
        
        <div class="h-16 flex items-center gap-3 px-5 border-b border-slate-700/50 bg-slate-900/50">
            <img src="{{ asset('images/logo-bjm.png') }}" alt="Pemko Banjarmasin" class="w-10 h-auto">
            <div class="leading-tight">
                <span class="text-white font-bold text-[15px] tracking-wide block">Admin Pengawasan</span>
                <span class="text-bjm-gold text-[10px] uppercase font-bold tracking-widest block">Kota Banjarmasin</span>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            
            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>
            <button @click="tab = 'beranda'; sidebarOpen = false" :class="tab === 'beranda' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda Admin
            </button>

            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Master Data</p>
            <button @click="tab = 'pegawai'; sidebarOpen = false" :class="tab === 'pegawai' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Data Pegawai
            </button>
            <button @click="tab = 'pengguna'; sidebarOpen = false" :class="tab === 'pengguna' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Data Pelapor
            </button>

            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Data Layanan Pengaduan</p>
            <button @click="tab = 'kasus'; sidebarOpen = false" :class="tab === 'kasus' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Data Kasus
            </button>
            <button @click="tab = 'pelanggaran'; sidebarOpen = false" :class="tab === 'pelanggaran' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Data Pelanggaran
            </button>
            <button @click="tab = 'tanggapan'; sidebarOpen = false" :class="tab === 'tanggapan' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Data Tanggapan
            </button>
            <button @click="tab = 'investigasi'; sidebarOpen = false" :class="tab === 'investigasi' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Data Investigasi
            </button>
            <button @click="tab = 'tindaklanjut'; sidebarOpen = false" :class="tab === 'tindaklanjut' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                Data Tindak Lanjut
            </button>
            <button @click="tab = 'bukti'; sidebarOpen = false" :class="tab === 'bukti' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                Data Bukti
            </button>

            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Eksekusi Kasus</p>
            <button @click="tab = 'input_tindaklanjut'; sidebarOpen = false" :class="tab === 'input_tindaklanjut' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Input Tindak Lanjut
            </button>

            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Laporan & Rekap</p>
            <button @click="tab = 'laporan'; sidebarOpen = false" :class="tab === 'laporan' ? 'bg-bjm-gold/10 text-bjm-gold border-l-4 border-bjm-gold' : 'hover:bg-slate-800 hover:text-white border-l-4 border-transparent'" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-r-lg text-sm font-medium transition-colors">
                <svg class="w-5 h-5 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Cetak Rekapitulasi
            </button>

        </div>
    </aside>

    <div class="lg:ml-64 flex flex-col min-h-screen relative">
        
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8 z-10">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="hidden md:flex items-center bg-slate-100 px-3 py-2 rounded-lg text-slate-500 focus-within:ring-2 focus-within:ring-bjm-gold">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Cari data kasus..." class="bg-transparent border-none outline-none text-sm w-48">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500">Administrator Utama</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-slate-100 hover:bg-red-50 text-slate-500 hover:text-red-500 p-2 rounded-full transition duration-300" title="Keluar dari Admin">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </header>

        <div class="bg-bjm-dark pt-10 pb-24 px-4 sm:px-6 lg:px-8 border-b-4 border-bjm-gold">
            <div class="flex justify-between items-center">
                <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-white leading-tight">Aplikasi Manajemen Pelaporan dan Pelanggaran Pegawai</h1>
            </div>
        </div>

        <div class="-mt-16 px-4 sm:px-6 lg:px-8 pb-8">
            
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-center gap-3 font-bold text-emerald-700 text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm flex items-center gap-3 font-bold text-red-700 text-sm">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm text-red-700 font-bold mb-1">Ada kesalahan input:</p>
                        <ul class="list-disc list-inside text-xs text-red-600 space-y-0.5">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 mb-1">Total Kasus</p>
                            <h3 class="text-3xl font-bold text-slate-800">{{ $dataKasus->count() }}</h3>
                        </div>
                        <div class="p-3 bg-slate-100 text-slate-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Semua laporan pelanggaran terdaftar.</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 mb-1">Menunggu Verifikasi</p>
                            <h3 class="text-3xl font-bold text-slate-800">{{ $dataKasus->where('status', 'masuk')->count() }}</h3>
                        </div>
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Perlu tindakan verifikasi Admin.</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 mb-1">Proses Audit</p>
                            <h3 class="text-3xl font-bold text-slate-800">{{ $dataKasus->where('status', 'investigasi')->count() }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Ditangani tim investigator.</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-500 mb-1">Kasus Selesai</p>
                            <h3 class="text-3xl font-bold text-slate-800">{{ $dataKasus->where('status', 'selesai')->count() }}</h3>
                        </div>
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500">Penyidikan telah ditutup.</p>
                </div>
            </div>

            <div class="mt-8 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
                
                <div x-show="tab === 'beranda'" x-transition.opacity>
                    <div class="px-6 py-8 border-b border-slate-200 bg-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-bjm-gold/5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                        <div class="relative z-10">
                            <h2 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang di Portal Pengawasan 👋</h2>
                            <p class="text-slate-600 mb-8 max-w-2xl">Ini adalah pusat kendali Aplikasi Manajemen Pelaporan dan Pelanggaran Pegawai Pemerintah Kota Banjarmasin. Kelola pengaduan, pantau investigasi, dan tindak lanjuti kasus ASN dari satu portal terpadu.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 shadow-sm">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="bg-amber-100 p-3 rounded-xl text-amber-600 border border-amber-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-slate-800">Komitmen Pemko Banjarmasin</h3>
                                    </div>
                                    <p class="text-slate-600 leading-relaxed italic">
                                        "Sejalan dengan semangat <strong>Banjarmasin Baiman (Barasih wan Nyaman)</strong>, Pemerintah Kota berkomitmen menghadirkan birokrasi yang bersih, profesional, dan berintegritas. Aplikasi Manajemen Pelaporan ini hadir sebagai wujud nyata pengawasan kinerja pegawai dari praktik pelanggaran."
                                    </p>
                                </div>

                                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 shadow-sm">
                                    <div class="flex items-center gap-4 mb-6">
                                        <div class="bg-blue-100 p-3 rounded-xl text-blue-600 border border-blue-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-slate-800">Standar Pengawasan Internal</h3>
                                    </div>
                                    <ul class="space-y-4 text-slate-600 text-sm">
                                        <li class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span><strong>Anonimitas Terproteksi:</strong> Sistem mengenkripsi identitas pelapor untuk menghindari benturan kepentingan.</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span><strong>Independensi Audit:</strong> Telaah kasus dijalankan secara objektif oleh tim Verifikator dan Investigator.</span>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span><strong>Transparansi Putusan:</strong> Progres penindakan kasus dapat dipantau oleh pelapor menggunakan kode kasus.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'pegawai'" x-transition.opacity style="display: none;" 
                    x-data="{ showModal: false, editMode: false, form: { id: '', name: '', email: '', peran: 'investigator' } }">
                    <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Data Pegawai Pengawas Internal</h3>
                            <span class="bg-slate-100 text-slate-700 border border-slate-200 text-xs font-bold px-3 py-1 rounded-full mt-2 inline-block">Total: {{ count($dataPegawai) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.rekap.cetak', 'pegawai') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-bold shadow-sm transition">
                                🖨️ Cetak PDF
                            </a>
                            <button @click="showModal = true; editMode = false; form = { id: '', name: '', email: '', peran: 'investigator' }" class="bg-bjm-dark hover:bg-slate-800 text-white text-sm font-bold px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-sm">
                                <svg class="w-4 h-4 text-bjm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Pegawai
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Nama Lengkap</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Jabatan Pengawasan</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @foreach($dataPegawai as $p)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-semibold text-slate-800">{{ $p->name }}</td>
                                    <td class="p-4 text-slate-500">{{ $p->email }}</td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">{{ strtoupper(str_replace('_', ' ', $p->peran)) }}</span>
                                    </td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="showModal = true; editMode = true; form = { id: '{{ $p->id }}', name: '{{ addslashes($p->name) }}', email: '{{ $p->email }}', peran: '{{ $p->peran }}' }" class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.pegawai.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pegawai ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center">
                                <h3 class="text-white font-bold text-lg" x-text="editMode ? 'Edit Data Pegawai' : 'Tambah Pegawai Baru'"></h3>
                                <button @click="showModal = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="editMode ? '/admin/pegawai/' + form.id : '{{ route('admin.pegawai.store') }}'" method="POST" class="p-6">
                                @csrf
                                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="name" x-model="form.name" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Email Aktif</label>
                                        <input type="email" name="email" x-model="form.email" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Peran / Jabatan</label>
                                        <select name="peran" x-model="form.peran" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                            <option value="investigator">Investigator (Tim Lapangan)</option>
                                            <option value="admin">Administrator</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Kata Sandi <span x-show="editMode" class="text-xs text-slate-400 font-normal">(Kosongkan jika tidak diganti)</span></label>
                                        <input type="password" name="password" :required="!editMode" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none" placeholder="Minimal 8 karakter">
                                    </div>
                                </div>
                                <div class="mt-8 flex justify-end gap-3">
                                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'pengguna'" x-transition.opacity style="display: none;"
                    x-data="{ showModal: false, editMode: false, form: { id: '', name: '', email: '' } }">
                    <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Data Pelapor Terdaftar</h3>
                            <span class="bg-slate-100 text-slate-700 border border-slate-200 text-xs font-bold px-3 py-1 rounded-full mt-2 inline-block">Total: {{ count($dataPengguna) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.rekap.cetak', 'pengguna') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-bold shadow-sm transition">
                                🖨️ Cetak PDF
                            </a>
                            <button @click="showModal = true; editMode = false; form = { id: '', name: '', email: '' }" class="bg-bjm-dark hover:bg-slate-800 text-white text-sm font-bold px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-sm">
                                <svg class="w-4 h-4 text-bjm-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Pelapor
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Nama Lengkap</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Tgl Mendaftar</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @foreach($dataPengguna as $u)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-semibold text-slate-800">{{ $u->name }}</td>
                                    <td class="p-4 text-slate-500">{{ $u->email }}</td>
                                    <td class="p-4 text-slate-500">{{ $u->created_at->format('d M Y') }}</td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="showModal = true; editMode = true; form = { id: '{{ $u->id }}', name: '{{ addslashes($u->name) }}', email: '{{ $u->email }}' }" class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.pengguna.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pelapor ini? Laporan miliknya mungkin akan terdampak.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModal = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center">
                                <h3 class="text-white font-bold text-lg" x-text="editMode ? 'Edit Data Pelapor' : 'Tambah Pelapor Baru'"></h3>
                                <button @click="showModal = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="editMode ? '/admin/pengguna/' + form.id : '{{ route('admin.pengguna.store') }}'" method="POST" class="p-6">
                                @csrf
                                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="name" x-model="form.name" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Email Aktif</label>
                                        <input type="email" name="email" x-model="form.email" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Kata Sandi <span x-show="editMode" class="text-xs text-slate-400 font-normal">(Kosongkan jika tidak diganti)</span></label>
                                        <input type="password" name="password" :required="!editMode" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none" placeholder="Minimal 8 karakter">
                                    </div>
                                </div>
                                <div class="mt-8 flex justify-end gap-3">
                                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'kasus'" x-transition.opacity style="display: none;"
                    x-data="{ 
                        showModalEditKasus: false, 
                        showModalVerifikasi: false,
                        formKasus: { id: '', judul_laporan: '', kategori_laporan: '', tanggal_kejadian: '', lokasi_kejadian: '', status: '', isi_laporan: '' },
                        formVerif: { id: '', judul: '', pelapor: '', keputusan: 'terima', tingkat_pelanggaran: '', investigator_id: '', catatan_verifikator: '' }
                    }">
                    <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-white">
                        <h3 class="text-lg font-bold text-slate-800">Semua Data Laporan Pengaduan Kasus</h3>
                        <a href="{{ route('admin.rekap.cetak', 'kasus') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                            🖨️ Cetak Rekap PDF
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Pelapor</th>
                                    <th class="p-4">Judul Laporan</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($dataKasus as $k)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-700">{{ $k->kode_tiket }}</td>
                                    <td class="p-4 text-slate-700 font-medium">{{ $k->user->name ?? 'Anonim' }}</td>
                                    <td class="p-4 text-slate-600">{{ Str::limit($k->judul_laporan, 30) }}</td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 text-xs rounded-full font-bold border 
                                            {{ $k->status == 'selesai' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 
                                                ($k->status == 'investigasi' ? 'bg-blue-50 text-blue-700 border-blue-200' : 
                                                ($k->status == 'ditolak' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-amber-50 text-amber-700 border-amber-200')) }}">
                                            {{ ucfirst($k->status) }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-1.5">
                                            
                                            @if($k->status === 'masuk')
                                                <button @click='showModalVerifikasi = true; formVerif = {
                                                    id: {{ $k->id }},
                                                    judul: {{ json_encode($k->judul_laporan) }},
                                                    pelapor: {{ json_encode($k->user->name ?? "Anonim") }},
                                                    keputusan: "terima",
                                                    tingkat_pelanggaran: "",
                                                    investigator_id: "",
                                                    catatan_verifikator: ""
                                                }' class="inline-flex items-center gap-1 px-2.5 py-1 bg-gradient-to-r from-amber-500 to-bjm-gold hover:from-amber-600 hover:to-amber-700 text-white rounded-md text-[11px] font-black tracking-wide shadow-sm hover:scale-105 transition" title="Verifikasi & Disposisi">
                                                    🛡️ VERIFIKASI
                                                </button>
                                            @endif

                                            <a href="{{ route('admin.show', $k->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md transition" title="Lihat Detail Berkas">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <button @click='showModalEditKasus = true; formKasus = { 
                                                id: {{ $k->id }}, judul_laporan: {{ json_encode($k->judul_laporan) }}, kategori_laporan: {{ json_encode($k->kategori_laporan) }}, tanggal_kejadian: {{ json_encode(\Carbon\Carbon::parse($k->tanggal_kejadian)->format("Y-m-d")) }}, lokasi_kejadian: {{ json_encode($k->lokasi_kejadian) }}, status: {{ json_encode($k->status) }}, isi_laporan: {{ json_encode($k->isi_laporan) }} 
                                            }' class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit Kasus Manual">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.kasus.destroy', $k->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kasus ini secara permanen?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus Permanen">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="p-8 text-center text-slate-500 italic">Belum ada data kasus masuk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModalVerifikasi" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;" x-transition>
                        <div @click.away="showModalVerifikasi = false" class="bg-white rounded-2xl shadow-xl w-full max-w-xl overflow-hidden transform transition-all flex flex-col max-h-[90vh]">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center sticky top-0 z-10">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">🛡️</span>
                                    <h3 class="text-white font-bold text-lg">Panel Verifikasi & Disposisi Laporan</h3>
                                </div>
                                <button @click="showModalVerifikasi = false" class="text-slate-300 hover:text-white font-bold">✕</button>
                            </div>

                            <form :action="'/admin/kasus/' + formVerif.id + '/verifikasi'" method="POST" class="p-6 overflow-y-auto space-y-4">
                                @csrf
                                @method('PUT')

                                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 leading-tight">
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pelapor: <span class="text-bjm-gold" x-text="formVerif.pelapor"></span></span>
                                    <p class="text-sm font-black text-slate-800 mt-1 line-clamp-2" x-text="formVerif.judul"></p>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Ambil Keputusan <span class="text-red-500">*</span></label>
                                    <select name="keputusan" x-model="formVerif.keputusan" class="w-full bg-white border-2 border-slate-300 focus:border-bjm-gold rounded-xl px-3 py-2.5 font-extrabold text-xs outline-none transition">
                                        <option value="terima">🟢 TERIMA & DISPOSISIKAN KE INVESTIGATOR</option>
                                        <option value="tolak">🔴 TOLAK & TUTUP KASUS INI</option>
                                    </select>
                                </div>

                                <div x-show="formVerif.keputusan === 'terima'" x-transition class="space-y-4 pt-2 border-t border-slate-100">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Tingkat Kasus <span class="text-red-500">*</span></label>
                                            <select name="tingkat_pelanggaran" x-model="formVerif.tingkat_pelanggaran" :required="formVerif.keputusan === 'terima'" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2.5 text-xs font-bold focus:border-bjm-gold outline-none">
                                                <option value="">-- Pilih Tingkat --</option>
                                                <option value="Ringan">Ringan (Administrasi/Teguran)</option>
                                                <option value="Sedang">Sedang (Etika/Disiplin)</option>
                                                <option value="Berat">Berat (Pidana/Korupsi/Pungli)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Tugaskan Investigator <span class="text-red-500">*</span></label>
                                            <select name="investigator_id" x-model="formVerif.investigator_id" :required="formVerif.keputusan === 'terima'" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3 py-2.5 text-xs font-bold focus:border-bjm-gold outline-none">
                                                <option value="">-- Pilih Investigator --</option>
                                                @foreach($dataPegawai->where('peran', 'investigator') as $inv)
                                                    <option value="{{ $inv->id }}">{{ $inv->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1" x-text="formVerif.keputusan === 'terima' ? 'Instruksi Khusus untuk Investigator' : 'Alasan Laporan Pengaduan Ditolak'"></label>
                                    <textarea name="catatan_verifikator" x-model="formVerif.catatan_verifikator" rows="3" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2 text-xs focus:border-bjm-gold outline-none" :placeholder="formVerif.keputusan === 'terima' ? 'Contoh: Segera periksa bukti rekaman CCTV di lokasi...' : 'Contoh: Bukti foto buram dan tidak menunjukkan identitas terlapor...'"></textarea>
                                </div>

                                <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-slate-100">
                                    <button type="button" @click="showModalVerifikasi = false" class="px-5 py-2 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition">Batal</button>
                                    <button type="submit" class="px-6 py-2.5 text-xs font-black text-white rounded-xl shadow-md transition"
                                        :class="formVerif.keputusan === 'terima' ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-500/20' : 'bg-red-600 hover:bg-red-700 shadow-red-500/20'"
                                        x-text="formVerif.keputusan === 'terima' ? 'ACC & DISPOSISI KE INVESTIGATOR' : 'KONFIRMASI TOLAK LAPORAN'">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div x-show="showModalEditKasus" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModalEditKasus = false" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all max-h-[90vh] flex flex-col">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center sticky top-0 z-10">
                                <h3 class="text-white font-bold text-lg">Koreksi Data Laporan Kasus</h3>
                                <button @click="showModalEditKasus = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="'/admin/kasus/' + formKasus.id" method="POST" class="p-6 overflow-y-auto">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Judul Laporan</label>
                                        <input type="text" name="judul_laporan" x-model="formKasus.judul_laporan" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Kategori Pelanggaran</label>
                                        <select name="kategori_laporan" x-model="formKasus.kategori_laporan" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none text-xs">
                                            <option value="Pungli">Pungli</option>
                                            <option value="Korupsi">Korupsi</option>
                                            <option value="Gratifikasi">Gratifikasi / Suap</option>
                                            <option value="Pelanggaran Disiplin">Pelanggaran Disiplin ASN</option>
                                            <option value="Benturan Kepentingan">Benturan Kepentingan</option>
                                            <option value="Penyalahgunaan Wewenang">Penyalahgunaan Wewenang</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Kejadian</label>
                                        <input type="date" name="tanggal_kejadian" x-model="formKasus.tanggal_kejadian" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Lokasi Kejadian</label>
                                        <input type="text" name="lokasi_kejadian" x-model="formKasus.lokasi_kejadian" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Kronologi / Isi Laporan</label>
                                    <textarea name="isi_laporan" x-model="formKasus.isi_laporan" rows="4" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none"></textarea>
                                </div>

                                <div class="mb-4 bg-amber-50 p-3 rounded-lg border border-amber-200">
                                    <label class="block text-sm font-bold text-amber-800 mb-1">Status Kasus (Ubah Manual)</label>
                                    <select name="status" x-model="formKasus.status" required class="w-full bg-white border border-amber-300 text-amber-900 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                        <option value="masuk">Masuk / Menunggu Verifikasi</option>
                                        <option value="investigasi">Proses Audit</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                    <p class="text-xs text-amber-600 mt-1">*Ubah manual dapat melewati alur disposisi.</p>
                                </div>

                                <div class="mt-6 flex justify-end gap-3">
                                    <button type="button" @click="showModalEditKasus = false" class="px-5 py-2 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Perbarui Kasus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'pelanggaran'" x-transition.opacity style="display: none;"
                    x-data="{ showModalEditPelanggaran: false, formPelanggaran: { id: '', tingkat_pelanggaran: '', investigator_id: '', catatan_verifikator: '' } }">
                    <div class="px-6 py-5 border-b border-slate-200 bg-white flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800">Klasifikasi Tingkat Pelanggaran Kasus</h3>
                        <a href="{{ route('admin.rekap.cetak', 'pelanggaran') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                            🖨️ Cetak Rekap PDF
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Judul Kasus</th>
                                    <th class="p-4">Tingkat</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($dataPelanggaran as $dp)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-600">{{ $dp->kode_tiket }}</td>
                                    <td class="p-4 text-slate-800 font-medium">{{ Str::limit($dp->judul_laporan, 40) }}</td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $dp->tingkat_pelanggaran == 'Berat' ? 'bg-red-50 text-red-600 border-red-200' : ($dp->tingkat_pelanggaran == 'Sedang' ? 'bg-amber-50 text-amber-600 border-amber-200' : ($dp->tingkat_pelanggaran == 'Ringan' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-slate-100 text-slate-500 border-slate-200')) }}">
                                            {{ $dp->tingkat_pelanggaran ?? 'Belum Ditentukan' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.show', $dp->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md transition" title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <button @click='showModalEditPelanggaran = true; formPelanggaran = { 
                                                id: {{ $dp->id }}, 
                                                tingkat_pelanggaran: "{{ $dp->tingkat_pelanggaran }}",
                                                investigator_id: "{{ $dp->investigator_id }}",
                                                catatan_verifikator: {{ json_encode($dp->catatan_verifikator) }} 
                                            }' class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Ubah Verifikasi">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.pelanggaran.destroy', $dp->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin mereset klasifikasi ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Reset Verifikasi">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="p-8 text-center text-slate-500 italic">Belum ada data pelanggaran terverifikasi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModalEditPelanggaran" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModalEditPelanggaran = false" class="bg-white rounded-2xl shadow-xl w-full max-w-xl overflow-hidden transform transition-all">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center">
                                <h3 class="text-white font-bold text-lg">Ubah Hasil Verifikasi Laporan</h3>
                                <button @click="showModalEditPelanggaran = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="'/admin/pelanggaran/' + formPelanggaran.id" method="POST" class="p-6">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">Tingkat Pelanggaran</label>
                                        <select name="tingkat_pelanggaran" x-model="formPelanggaran.tingkat_pelanggaran" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                            <option value="">-- Pilih Tingkat --</option>
                                            <option value="Ringan">Ringan (Administrasi)</option>
                                            <option value="Sedang">Sedang (Etika/Disiplin)</option>
                                            <option value="Berat">Berat (Pidana/Korupsi)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">Investigator Bertugas</label>
                                        <select name="investigator_id" x-model="formPelanggaran.investigator_id" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none">
                                            <option value="">-- Belum Ditugaskan --</option>
                                            @foreach($dataPegawai->where('peran', 'investigator') as $inv)
                                                <option value="{{ $inv->id }}">{{ $inv->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Instruksi Verifikator / Catatan Khusus</label>
                                    <textarea name="catatan_verifikator" x-model="formPelanggaran.catatan_verifikator" rows="3" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2.5 focus:border-bjm-gold outline-none"></textarea>
                                </div>

                                <div class="mt-8 flex justify-end gap-3">
                                    <button type="button" @click="showModalEditPelanggaran = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Simpan Pembaruan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'tanggapan'" x-transition.opacity style="display: none;"
                    x-data="{ showModalEditTanggapan: false, formTanggapan: { id: '', kategori_tanggapan: '', pesan: '' } }">
                    <div class="px-6 py-5 border-b border-slate-200 bg-white shadow-sm flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Manajemen Data Tanggapan Pelapor</h3>
                            <p class="text-xs text-slate-500">Riwayat pesan susulan dan desakan penindakan kasus.</p>
                        </div>
                        <a href="{{ route('admin.rekap.cetak', 'tanggapan') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                            🖨️ Cetak Rekap PDF
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Pengirim & Kategori</th>
                                    <th class="p-4">Isi Pesan</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($dataTanggapan as $tgn)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-700">
                                        {{ $tgn->pengaduan->kode_tiket ?? 'KASUS DIHAPUS' }}
                                    </td>
                                    <td class="p-4">
                                        <p class="font-bold text-slate-700">{{ $tgn->user->name ?? 'Pelapor' }}</p>
                                        <span class="inline-block mt-1 px-2 py-0.5 text-[10px] uppercase tracking-wide font-bold rounded bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $tgn->kategori_tanggapan ?? 'Pesan / Progres' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-slate-600">
                                        <p class="line-clamp-2 italic">"{{ $tgn->pesan }}"</p>
                                        @if($tgn->lampiran_tambahan)
                                            <a href="{{ asset('storage/' . $tgn->lampiran_tambahan) }}" target="_blank" class="inline-flex items-center gap-1 mt-2 text-[11px] text-blue-600 hover:text-blue-800 font-semibold">
                                                📎 Ada Lampiran Susulan
                                            </a>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click='showModalEditTanggapan = true; formTanggapan = { 
                                                id: {{ $tgn->id }}, 
                                                kategori_tanggapan: {{ json_encode($tgn->kategori_tanggapan) }},
                                                pesan: {{ json_encode($tgn->pesan) }} 
                                            }' class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit Pesan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.tanggapan.destroy', $tgn->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan tanggapan ini permanen?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="p-12 text-center text-slate-500 italic">Belum ada riwayat pesan/tanggapan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModalEditTanggapan" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModalEditTanggapan = false" class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden transform transition-all flex flex-col max-h-[90vh]">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center sticky top-0 z-10">
                                <h3 class="text-white font-bold text-lg">Koreksi Pesan Tanggapan</h3>
                                <button @click="showModalEditTanggapan = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="'/admin/tanggapan/' + formTanggapan.id" method="POST" class="p-6 overflow-y-auto">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Kategori Tanggapan</label>
                                    <input type="text" name="kategori_tanggapan" x-model="formTanggapan.kategori_tanggapan" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Isi Pesan</label>
                                    <textarea name="pesan" x-model="formTanggapan.pesan" rows="4" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none"></textarea>
                                </div>

                                <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                                    <button type="button" @click="showModalEditTanggapan = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Simpan Pembaruan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'investigasi'" x-transition.opacity style="display: none;"
                    x-data="{ showModalEditInvestigasi: false, formInvestigasi: { id: '', fakta_lapangan: '', pihak_terlibat: '', kesimpulan: '' } }">
                    <div class="px-6 py-5 border-b border-slate-200 bg-white flex justify-between items-center">
                        <h3 class="text-lg font-bold text-slate-800">Data Kertas Kerja Investigasi</h3>
                        <a href="{{ route('admin.rekap.cetak', 'investigasi') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                            🖨️ Cetak Rekap PDF
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Investigator Lapangan</th>
                                    <th class="p-4">Fakta Temuan</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($dataInvestigasi as $i)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-600">{{ $i->kode_tiket }}</td>
                                    <td class="p-4 text-slate-800 font-medium">{{ $i->investigator->name ?? 'Tim Lapangan' }}</td>
                                    <td class="p-4 text-slate-600 italic">"{{ Str::limit($i->fakta_lapangan ?? $i->hasil_investigasi, 40) }}"</td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.show', $i->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md transition" title="Lihat Berkas Lengkap">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <button @click='showModalEditInvestigasi = true; formInvestigasi = { 
                                                id: {{ $i->id }}, 
                                                fakta_lapangan: {{ json_encode($i->fakta_lapangan) }},
                                                pihak_terlibat: {{ json_encode($i->pihak_terlibat) }},
                                                kesimpulan: {{ json_encode($i->kesimpulan) }} 
                                            }' class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit Investigasi">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.investigasi.destroy', $i->id) }}" method="POST" class="inline" onsubmit="return confirm('Reset hasil investigasi ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Reset">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="p-8 text-center text-slate-500 italic">Belum ada data hasil investigasi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModalEditInvestigasi" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModalEditInvestigasi = false" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all max-h-[90vh] flex flex-col">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center sticky top-0 z-10">
                                <h3 class="text-white font-bold text-lg">Edit Kertas Kerja Investigasi</h3>
                                <button @click="showModalEditInvestigasi = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="'/admin/investigasi/' + formInvestigasi.id" method="POST" class="p-6 overflow-y-auto">
                                @csrf
                                @method('PUT')
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Fakta di Lapangan</label>
                                        <textarea name="fakta_lapangan" x-model="formInvestigasi.fakta_lapangan" rows="3" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Pihak Terlibat / Saksi</label>
                                        <textarea name="pihak_terlibat" x-model="formInvestigasi.pihak_terlibat" rows="2" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Kesimpulan Akhir & Rekomendasi</label>
                                        <textarea name="kesimpulan" x-model="formInvestigasi.kesimpulan" rows="3" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none"></textarea>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                                    <button type="button" @click="showModalEditInvestigasi = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Simpan Koreksi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'tindaklanjut'" x-transition.opacity style="display: none;"
                    x-data="{ showModalEditTindakLanjut: false, formTindakLanjut: { id: '', pihak_penindak: '', tanggal_tindak_lanjut: '', tindak_lanjut: '' } }">
                    <div class="px-6 py-5 border-b border-slate-200 bg-white shadow-sm flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Arsip Keputusan & Tindak Lanjut Final</h3>
                            <p class="text-xs text-slate-500">Daftar kasus pegawai yang telah selesai diproses eksekusi keputusannya.</p>
                        </div>
                        <a href="{{ route('admin.rekap.cetak', 'tindaklanjut') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                            🖨️ Cetak Rekap PDF
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Instansi Penindak</th>
                                    <th class="p-4">Tanggal Eksekusi</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($dataTindakLanjut as $dt)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-700">{{ $dt->kode_tiket }}</td>
                                    <td class="p-4 text-slate-700 font-medium">{{ $dt->pihak_penindak ?? '-' }}</td>
                                    <td class="p-4 text-slate-600">
                                        {{ $dt->tanggal_tindak_lanjut ? \Carbon\Carbon::parse($dt->tanggal_tindak_lanjut)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.show', $dt->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md transition" title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <button @click='showModalEditTindakLanjut = true; formTindakLanjut = { 
                                                id: {{ $dt->id }}, 
                                                pihak_penindak: {{ json_encode($dt->pihak_penindak) }},
                                                tanggal_tindak_lanjut: "{{ $dt->tanggal_tindak_lanjut ? \Carbon\Carbon::parse($dt->tanggal_tindak_lanjut)->format('Y-m-d') : '' }}",
                                                tindak_lanjut: {{ json_encode($dt->tindak_lanjut) }} 
                                            }' class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Edit Keputusan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.tindaklanjut.destroy', $dt->id) }}" method="POST" class="inline" onsubmit="return confirm('Batalkan keputusan ini? Status kasus akan kembali ke tahap Investigasi.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Batalkan">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="p-12 text-center text-slate-500 italic">Belum ada data tindak lanjut yang diinput.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModalEditTindakLanjut" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModalEditTindakLanjut = false" class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all flex flex-col max-h-[90vh]">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center sticky top-0 z-10">
                                <h3 class="text-white font-bold text-lg">Koreksi Data Keputusan Tindak Lanjut</h3>
                                <button @click="showModalEditTindakLanjut = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="'/admin/tindaklanjut/' + formTindakLanjut.id" method="POST" class="p-6 overflow-y-auto">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Pihak Penindak / Instansi</label>
                                        <input type="text" name="pihak_penindak" x-model="formTindakLanjut.pihak_penindak" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Eksekusi</label>
                                        <input type="date" name="tanggal_tindak_lanjut" x-model="formTindakLanjut.tanggal_tindak_lanjut" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Detail Keputusan & Sanksi</label>
                                    <textarea name="tindak_lanjut" x-model="formTindakLanjut.tindak_lanjut" rows="4" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-4 py-2 focus:border-bjm-gold outline-none"></textarea>
                                </div>

                                <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                                    <button type="button" @click="showModalEditTindakLanjut = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Perbarui Keputusan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'bukti'" x-transition.opacity style="display: none;"
                    x-data="{ showModalEditBukti: false, formBukti: { id: '' } }">
                    <div class="px-6 py-5 border-b border-slate-200 bg-white shadow-sm flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Manajemen Arsip Bukti Kasus</h3>
                            <p class="text-xs text-slate-500">Pusat kontrol file fisik temuan pelanggaran pegawai.</p>
                        </div>
                        <a href="{{ route('admin.rekap.cetak', 'bukti') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition">
                            🖨️ Cetak Rekap PDF
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Bukti Awal Pelapor</th>
                                    <th class="p-4">Bukti Investigasi Lapangan</th>
                                    <th class="p-4 text-center pr-6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($dataBukti as $db)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-slate-700">{{ $db->kode_tiket }}</td>
                                    <td class="p-4">
                                        @if($db->lampiran_bukti)
                                            <a href="{{ asset('storage/' . $db->lampiran_bukti) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 rounded-lg text-xs font-bold transition shadow-sm">
                                                📎 Lihat Berkas Pelapor
                                            </a>
                                        @else
                                            <span class="text-slate-400 italic text-xs">Kosong</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if($db->bukti_investigasi)
                                            <a href="{{ asset('storage/' . $db->bukti_investigasi) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-50 hover:bg-purple-600 text-purple-600 hover:text-white border border-purple-200 hover:border-purple-600 rounded-lg text-xs font-bold transition shadow-sm">
                                                📷 Foto Temuan Tim
                                            </a>
                                        @else
                                            <span class="text-slate-400 italic text-xs">Kosong</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center pr-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="showModalEditBukti = true; formBukti.id = {{ $db->id }}" class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-md transition" title="Ganti Berkas">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.bukti.destroy', $db->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus seluruh berkas bukti pada kasus ini permanen?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition" title="Hapus Permanen">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="p-12 text-center text-slate-500 italic">Tidak ada file bukti pelanggaran yang terlampir.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div x-show="showModalEditBukti" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4" style="display: none;">
                        <div @click.away="showModalEditBukti = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
                            <div class="bg-bjm-dark p-5 border-b-4 border-bjm-gold flex justify-between items-center">
                                <h3 class="text-white font-bold text-lg">Perbarui Berkas Bukti</h3>
                                <button @click="showModalEditBukti = false" class="text-slate-300 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                            </div>
                            <form :action="'/admin/bukti/' + formBukti.id" method="POST" enctype="multipart/form-data" class="p-6">
                                @csrf
                                @method('PUT')
                                
                                <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg mb-4 text-xs text-blue-700">
                                    File lama akan tertimpa otomatis oleh unggahan baru Anda. Kosongkan jika tidak ingin mengubah.
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Ganti Bukti Pelapor</label>
                                    <input type="file" name="lampiran_bukti" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>

                                <div class="mb-4 pt-4 border-t border-slate-100">
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Ganti Foto Investigasi Lapangan</label>
                                    <input type="file" name="bukti_investigasi" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                </div>

                                <div class="mt-8 flex justify-end gap-3">
                                    <button type="button" @click="showModalEditBukti = false" class="px-5 py-2.5 text-sm font-bold text-slate-600 hover:bg-slate-100 rounded-lg transition">Batal</button>
                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-bjm-gold hover:bg-amber-600 rounded-lg transition shadow-md">Simpan Berkas</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'input_tindaklanjut'" x-transition.opacity style="display: none;">
                    <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Antrean Penjatuhan Keputusan Kasus</h3>
                            <p class="text-xs text-slate-500 mt-1">Daftar kasus pegawai yang telah selesai diselidiki dan menunggu putusan sanksi akhir.</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-4 pl-6">Kode Kasus</th>
                                    <th class="p-4">Kesimpulan Hasil Audit</th>
                                    <th class="p-4 text-center pr-6">Aksi Penindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse($kasusPerluTindakLanjut as $kpt)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 pl-6 font-mono font-bold text-amber-600">{{ $kpt->kode_tiket }}</td>
                                    <td class="p-4 text-slate-600 italic">"{{ Str::limit($kpt->kesimpulan, 80) }}"</td>
                                    <td class="p-4 text-center pr-6">
                                        <a href="{{ route('admin.tindaklanjut.edit', $kpt->id) }}" class="inline-flex items-center gap-1.5 bg-bjm-dark hover:bg-slate-800 text-white text-xs font-bold px-4 py-2 rounded-lg transition shadow-sm">
                                            ⚖️ Ketok Putusan Final
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="p-8 text-center text-slate-500 italic">Antrean penindakan kasus bersih.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="tab === 'laporan'" x-transition.opacity style="display: none;">
                    <div class="px-6 py-5 border-b border-slate-200 bg-white flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Pusat Unduh Arsip & Rekapitulasi Kasus</h3>
                            <p class="text-xs text-slate-500 mt-1">Unduh seluruh berkas laporan pelanggaran pegawai dalam format dokumen PDF resmi.</p>
                        </div>
                    </div>
                    
                    <div class="p-6 bg-slate-50">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                            
                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 text-xl">👥</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Daftar Pegawai Pengawas</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Rekap data Admin & Investigator.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'pegawai') }}" target="_blank" class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 text-xl">🙋‍♂️</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Data Akun Pelapor</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Daftar pengguna pelapor terdaftar.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'pengguna') }}" target="_blank" class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-3 text-xl">📁</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Rekap Seluruh Kasus</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Arsip lengkap pengaduan masuk.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'kasus') }}" target="_blank" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mb-3 text-xl">⚠️</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Rekap Pelanggaran</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Hasil verifikasi & klasifikasi kasus.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'pelanggaran') }}" target="_blank" class="w-full py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center mb-3 text-xl">💬</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Rekap Tanggapan</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Arsip obrolan & bukti susulan.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'tanggapan') }}" target="_blank" class="w-full py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mb-3 text-xl">🔍</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Rekap Investigasi</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Kertas kerja lapangan penyidik.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'investigasi') }}" target="_blank" class="w-full py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center mb-3 text-xl">🔨</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Rekap Putusan Final</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Daftar sanksi akhir & eksekusi.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'tindaklanjut') }}" target="_blank" class="w-full py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between items-center text-center hover:shadow-md transition">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center mb-3 text-xl">📎</div>
                                <div class="mb-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1">Rekap File Bukti</h4>
                                    <p class="text-xs text-slate-500 leading-relaxed">Arsip ketersediaan lampiran kasus.</p>
                                </div>
                                <a href="{{ route('admin.rekap.cetak', 'bukti') }}" target="_blank" class="w-full py-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg text-xs font-bold transition text-center shadow-sm">🖨️ Cetak PDF</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>