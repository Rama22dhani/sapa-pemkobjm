<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Manajemen Pelaporan dan Pelanggaran</title>

    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Memanggil Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fallback CDN jika Vite belum di-build -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'bjm-dark': '#0f172a',
                        'bjm-gold': '#d97706',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-bjm-dark min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Efek Latar Belakang -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-bjm-gold/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden relative z-10">
        
        <!-- Header / Logo Area -->
        <div class="bg-slate-50 px-8 pt-10 pb-6 text-center border-b border-slate-100">
            <img src="{{ asset('images/logo-bjm.png') }}" alt="Logo Banjarmasin" class="w-20 h-auto mx-auto drop-shadow-md mb-4">
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang</h2>
            <p class="text-sm text-slate-500 mt-2 font-medium">Aplikasi Manajemen Pelaporan dan Pelanggaran Pegawai<br>Pemerintah Kota Banjarmasin</p>
        </div>

        <!-- Form Area -->
        <div class="px-8 py-8">
            
            <!-- Session Status (Pesan Error/Sukses bawaan Laravel) -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                        class="w-full bg-slate-50 border border-slate-300 text-slate-800 rounded-xl px-4 py-3 focus:border-bjm-gold focus:ring-2 focus:ring-bjm-gold/20 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Masukkan email Anda">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password" class="block text-sm font-bold text-slate-700">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-bjm-gold hover:text-amber-700 transition">
                                Lupa Sandi?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="w-full bg-slate-50 border border-slate-300 text-slate-800 rounded-xl px-4 py-3 focus:border-bjm-gold focus:ring-2 focus:ring-bjm-gold/20 outline-none transition-all placeholder:text-slate-400"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <!-- Remember Me & Submit -->
                <div class="flex items-center justify-between pt-2">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-bjm-gold focus:ring-bjm-gold transition cursor-pointer">
                        <span class="ms-2 text-sm font-medium text-slate-600 group-hover:text-slate-800 transition">Ingat saya</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center gap-2 bg-bjm-dark hover:bg-slate-800 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-bjm-dark focus:ring-offset-2">
                        Masuk ke Sistem
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>

                <!-- Link to Register -->
                @if (Route::has('register'))
                <p class="text-center text-sm text-slate-500 font-medium mt-6">
                    Belum memiliki akun pelapor? 
                    <a href="{{ route('register') }}" class="text-bjm-gold font-bold hover:text-amber-700 transition">Daftar sekarang</a>
                </p>
                @endif
            </form>
        </div>
    </div>
</body>
</html>