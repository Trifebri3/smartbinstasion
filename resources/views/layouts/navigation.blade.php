<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Brand Logo: UIN Bandung -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-win-green flex items-center justify-center text-white font-black text-xs tracking-wider shadow-sm group-hover:scale-105 transition">
                        UIN
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1.5">
                            <span class="font-extrabold text-base tracking-tight text-win-dark">SmartBin</span>
                            <span class="text-[10px] font-bold px-1.5 py-0.2 rounded bg-win-green-light text-win-green border border-emerald-200">Admin</span>
                        </div>
                        <span class="text-[10px] text-win-slate font-medium hidden sm:inline">UIN Sunan Gunung Djati Bandung</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <!-- 1. Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ request()->routeIs('dashboard') ? 'bg-win-green-light text-win-green font-extrabold' : 'text-slate-600 hover:text-win-dark hover:bg-slate-100' }}">
                        <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- 2. Auto-Sort (AI) -->
                    <a href="{{ route('auto.sort') }}" 
                       class="px-3 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ request()->routeIs('auto.sort') ? 'bg-win-green-light text-win-green font-extrabold' : 'text-slate-600 hover:text-win-dark hover:bg-slate-100' }}">
                        <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span>Auto-Sort AI</span>
                    </a>

                    <!-- 3. Kontrol Servo -->
                    <a href="{{ route('servos.index') }}" 
                       class="px-3 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ request()->routeIs('servos.*') ? 'bg-win-green-light text-win-green font-extrabold' : 'text-slate-600 hover:text-win-dark hover:bg-slate-100' }}">
                        <svg class="w-4 h-4 text-win-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                        <span>Kontrol Servo</span>
                    </a>

                    <!-- 4. Live Monitor IoT -->
                    <a href="{{ route('public.monitor') }}" target="_blank"
                       class="px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-win-dark hover:bg-slate-100 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span>Live Monitor</span>
                    </a>

                    <!-- 5. Peta Stasiun -->
                    <a href="{{ route('public.locations') }}" target="_blank"
                       class="px-3 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-win-dark hover:bg-slate-100 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Peta</span>
                    </a>
                </div>
            </div>

            <!-- Akun Admin Dropdown (Desktop) -->
            <div class="hidden md:flex md:items-center md:gap-3">
                <!-- Portal Pengguna Quick Link -->
                <a href="{{ route('user.portal') }}" class="text-xs font-semibold text-win-slate hover:text-win-green px-2.5 py-1.5 rounded-lg border border-slate-200 hover:border-win-green transition flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Tampilan Pengguna</span>
                </a>

                <!-- Profile Dropdown Component -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" 
                            class="inline-flex items-center gap-2 p-1.5 pr-3 rounded-xl border border-slate-200/80 hover:border-win-green bg-white shadow-sm transition">
                        <div class="w-8 h-8 rounded-lg bg-win-green text-white font-bold text-xs flex items-center justify-center">
                            {{ strtoupper(substr(Auth::user()?->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="text-left hidden lg:block">
                            <div class="text-xs font-bold text-win-dark truncate max-w-[120px]">{{ Auth::user()?->name ?? 'Admin UIN' }}</div>
                            <div class="text-[10px] text-win-green font-semibold">Administrator UIN</div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="dropdownOpen" 
                         @click.outside="dropdownOpen = false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-64 rounded-2xl bg-white border border-slate-200 shadow-xl py-2 z-50 text-xs">
                        
                        <!-- Account Details Card -->
                        <div class="px-4 py-3 border-b border-slate-100">
                            <div class="font-extrabold text-sm text-win-dark">{{ Auth::user()?->name ?? 'Administrator UIN' }}</div>
                            <div class="text-slate-500 text-[11px] truncate">{{ Auth::user()?->email ?? 'admin@smartbin.myoin.id' }}</div>
                            <div class="mt-2 flex items-center justify-between text-[10px]">
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-800 font-bold border border-emerald-200">
                                    Super Admin UIN
                                </span>
                                <code class="font-mono text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">
                                    {{ Auth::user()?->qr_code_token ?? 'SB-ADM-MASTER99' }}
                                </code>
                            </div>
                        </div>

                        <!-- Menu Links -->
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-50 hover:text-win-green transition font-medium">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Pengaturan Profil</span>
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 text-slate-700 hover:bg-slate-50 hover:text-win-green transition font-medium">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                <span>Beranda Publik SmartBin</span>
                            </a>
                        </div>

                        <!-- Logout -->
                        <div class="pt-1 border-t border-slate-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-rose-600 hover:bg-rose-50 font-bold transition">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Keluar (Log Out)</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="p-2 rounded-xl text-slate-600 hover:text-win-dark hover:bg-slate-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden border-t border-slate-200 bg-white px-4 py-3 space-y-3">
        <!-- User Info Header -->
        <div class="p-3 bg-slate-50 rounded-xl flex items-center justify-between">
            <div>
                <div class="font-extrabold text-sm text-win-dark">{{ Auth::user()?->name ?? 'Administrator UIN' }}</div>
                <div class="text-[11px] text-slate-500">{{ Auth::user()?->email ?? 'admin@smartbin.myoin.id' }}</div>
            </div>
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-win-green text-white">Admin UIN</span>
        </div>

        <!-- Links -->
        <div class="space-y-1 text-xs font-semibold">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-win-green-light text-win-green font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
                Dashboard Utama
            </a>
            <a href="{{ route('auto.sort') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('auto.sort') ? 'bg-win-green-light text-win-green font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
                Auto-Sort AI
            </a>
            <a href="{{ route('servos.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('servos.*') ? 'bg-win-green-light text-win-green font-bold' : 'text-slate-700 hover:bg-slate-50' }}">
                Kontrol Servo
            </a>
            <a href="{{ route('public.monitor') }}" target="_blank" class="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50">
                Live Monitor IoT
            </a>
            <a href="{{ route('public.locations') }}" target="_blank" class="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50">
                Peta Stasiun
            </a>
            <a href="{{ route('user.portal') }}" class="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50">
                Tampilan Pengguna (Portal)
            </a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-slate-700 hover:bg-slate-50">
                Pengaturan Profil
            </a>
        </div>

        <!-- Logout -->
        <div class="pt-2 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 text-xs font-bold text-rose-600 hover:bg-rose-50 rounded-lg transition">
                    Keluar (Log Out)
                </button>
            </form>
        </div>
    </div>
</nav>
