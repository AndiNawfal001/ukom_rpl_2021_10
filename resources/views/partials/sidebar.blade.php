<div class="relative flex-1 flex flex-col min-h-0 shadow bg-base-100 pt-0">
    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
       <div class="flex-1 px-3 divide-y space-y-1">
        <ul class="space-y-2">
            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/dashboard" class="flex items-center p-2">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                <span class="ml-3">Dashboard</span>
                </a>
            </li>

            @can('admin')
                <li class="transition hover:bg-base-200 rounded-lg group">
                    <a href="#" class="flex items-center p-2">
                        <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Logging</span>
                    <span class="inline-flex justify-center items-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                    </a>
                </li>
            @endcan

            @can('manajemen', 'admin')
                <li class="transition hover:bg-base-200 rounded-lg group">
                    <a href="/barangMasuk" class="flex items-center p-2">
                        <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Barang Masuk</span>
                    {{-- <span class="inline-flex justify-center items-center p-3 ml-3 w-3 h-3 text-sm font-medium text-blue-600 bg-blue-200 rounded-full dark:bg-blue-900 dark:text-blue-200">0</span> --}}
                    </a>
                </li>
            @endcan

            <li class="transition group">
                <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg hover:bg-base-200 dropdown-btn" >
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap " sidebar-toggle-item>Pengajuan</span>
                    <svg sidebar-toggle-item class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <ul class="hidden py-2 space-y-2 dropdown-container">
                    <li>
                        <a href="/pengajuan/BB" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group hover:bg-base-200">Barang Baru</a>
                    </li>
                    <li>
                        <a href="/pengajuan/PB" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group hover:bg-base-200">Perbaikan</a>
                    </li>
                </ul>
            </li>

            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/barang" class="flex items-center p-2">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content"  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Barang</span>
                </a>
            </li>

            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/perawatan" class="flex items-center p-2">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Perawatan</span>
                </a>
            </li>

            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/pemutihan" class="flex items-center p-2">
                <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Pemutihan</span>
                {{-- @yield('pemutihanKaprog') --}}
                </a>
            </li>

            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/pengguna" class="flex items-center p-2">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Pengguna</span>
                </a>
            </li>
            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/supplier" class="flex items-center p-2">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Supplier</span>
                </a>
            </li>
            <li class="transition hover:bg-base-200 rounded-lg group">
                <a href="/ruangan" class="flex items-center p-2">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Ruangan</span>
                </a>
            </li>


        </ul>

        {{-- line--}}

        <ul class="pt-4 mt-4 space-y-2 place-content-end lg:hidden">
            <li class="transition select-none text-center">
                <span >
                    {{Auth::user()->username}}
                    -
                    <span class="font-semibold
                        {{ (Auth::user()->level_user->nama_level === 'admin') ? 'text-red-500' : '' }}
                        {{ (Auth::user()->level_user->nama_level === 'manajemen') ? 'text-green-500' : '' }}
                        {{ (Auth::user()->level_user->nama_level === 'kaprog') ? 'text-sky-500' : '' }}
                    ">
                        {{ Auth::user()->level_user->nama_level }}
                    </span>
                </span>
            </li>
        </ul>
       </div>
    </div>
 </div>
