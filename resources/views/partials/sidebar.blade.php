<div class="relative flex-1 flex flex-col min-h-0 shadow-xl bg-base-100 pt-0">
    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
       <div class="flex-1 px-3 space-y-1">
            <ul>
                <li class="rounded-lg group {{ request()->is('dashboard') ? 'bg-base-200 shadow-md' : 'hover:bg-base-300' }}">
                    <a href="/dashboard" class="flex items-center p-2 ">
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('dashboard') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
                            </svg>
                        </div>

                    <span class="ml-3 text-md">Dashboard</span>
                    </a>
                </li>
                @can('admin')
                    <li class="rounded-lg group {{ request()->is('log*') ? 'bg-base-200  shadow-md' : 'hover:bg-base-300' }}">
                        <a href="/log" class="flex items-center p-2">
                            <div class="btn btn-sm btn-active btn-square {{ request()->is('log*') ? 'btn-primary' : 'btn-ghost' }}">
                                <svg class="w-5 h-w-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"></path>
                                </svg>
                            </div>
                        <span class="flex-1 ml-3 text-md whitespace-nowrap">Logging</span>
                        <span class="inline-flex justify-center items-center px-2 ml-3 text-sm font-medium bg-base-content text-base-100 rounded-full duration-300">Pro</span>
                        </a>
                    </li>
                @endcan
                @php
                    $approved_null = DB::table('pengajuan_bb')
                                ->whereNull('status_pembelian')
                                ->where('status_approval', 'setuju')
                                ->count();

                    $pengajuan_bb =  DB::table('pengajuan_bb')
                                ->whereNull('approver')
                                ->count('id_pengajuan_bb');

                    $perbaikan =  DB::table('perbaikan')
                                ->whereNull('approver')
                                ->where('approve_perbaikan', 'pending')
                                ->whereNotNull('tgl_selesai_perbaikan')
                                ->count('id_perbaikan');

                    $pemutihan =  DB::table('pemutihan')
                                ->whereNull('approver')
                                ->count('id_pemutihan');

                    $submitter = Auth::user()->id_pengguna;
                    $pemutihanKaprog = DB::table('perbaikan_pemutihan')
                                ->join('nama_kode_barang', 'perbaikan_pemutihan.asli', '=', 'nama_kode_barang.kode_barang')
                                ->select('perbaikan_pemutihan.*', 'nama_kode_barang.nama_barang')
                                ->whereNull('perbaikan_pemutihan.kode_barang')
                                ->where('perbaikan_pemutihan.submitter', $submitter)
                                ->where('perbaikan_pemutihan.approve_perbaikan', 'rusak')
                                ->count();
                @endphp
                @can('admin+manajemen')
                    <li class="border-primary rounded-lg group {{ request()->is('barangMasuk*') ? 'bg-base-200 shadow-md' : 'hover:bg-base-300' }}">
                        <a href="/barangMasuk" class="flex items-center p-2">
                            <div class="btn btn-sm btn-active btn-square {{ request()->is('barangMasuk*') ? 'btn-primary' : 'btn-ghost' }}">
                                <svg class="w-5 h-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"></path>
                                </svg>
                            </div>
                        <span class="flex-1 ml-3 whitespace-nowrap">Barang Masuk</span>
                        @can('manajemen')
                            @if($approved_null != 0)
                                <span class="inline-flex justify-center items-center p-3 ml-3 w-3 h-3 text-sm font-medium text-info-content bg-info rounded-full">{{ $approved_null }}</span>
                            @endif
                        @endcan
                        </a>
                    </li>
                @endcan

                @can('admin+manajemen')
                <li class="group">
                    <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg hover:bg-base-300 dropdown-btn" >
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('approval/BB*', 'approval/PB*' ,'approval/pemutihan*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"></path>
                            </svg>
                        </div>

                        <span class="flex-1 ml-3 text-left whitespace-nowrap " sidebar-toggle-item>Approval</span>
                        @if($pemutihan >= 1 or $pengajuan_bb >=1 or $perbaikan >= 1)
                            <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info"></span>
                        @endif
                        <svg sidebar-toggle-item class="w-6 h-6 group-hover:text-base-content" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul class="dropdown-container {{ request()->is('approval/BB*', 'approval/PB*' ,'approval/pemutihan*') ? 'block' : 'hidden' }}">
                        <li >
                            <a href="/approval/BB" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group {{ request()->is('approval/BB*') ? 'bg-base-200 border-r-2 shadow-md' : 'hover:bg-base-300' }}">
                                Barang Baru
                                @if($pengajuan_bb >= 1)
                                    <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info {{ request()->is('approval/BB*') ? 'mr-[6px]' : '' }}"></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="/approval/PB" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group {{ request()->is('approval/PB*') ? 'bg-base-200 border-r-2 shadow-md' : 'hover:bg-base-300' }}">
                                Perbaikan
                                @if($perbaikan >= 1)
                                    <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info {{ request()->is('approval/PB*') ? 'mr-[6px]' : '' }}"></span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="/approval/pemutihan" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group {{ request()->is('approval/pemutihan*') ? 'bg-base-200 border-r-2 shadow-md' : 'hover:bg-base-300' }}">
                                Pemutihan
                                @if($pemutihan >= 1)
                                    <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info{{ request()->is('approval/pemutihan*') ? 'mr-[6px]' : '' }}"></span>
                                @endif
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan

                <li class="group">
                    <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg hover:bg-base-300 dropdown-btn" >
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('pengajuan/BB*', 'pengajuan/PB*' ,'pemutihan*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                            </svg>
                        </div>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap " sidebar-toggle-item>Pengajuan</span>
                        @if($pemutihanKaprog >= 1 )
                            <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info"></span>
                        @endif
                        <svg sidebar-toggle-item class="w-6 h-6 group-hover:text-base-content" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul class="dropdown-container {{ request()->is('pengajuan/BB*', 'pengajuan/PB*' ,'pemutihan*') ? 'block' : 'hidden' }}">
                        <li>
                            <a href="/pengajuan/BB" class="flex items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group {{ request()->is('pengajuan/BB*') ? 'bg-base-200 border-r-2 shadow-md' : 'hover:bg-base-300' }}">Barang Baru</a>
                        </li>
                        <li>
                            <a href="/pengajuan/PB" class="flex items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group {{ request()->is('pengajuan/PB*') ? 'bg-base-200 border-r-2 shadow-md' : 'hover:bg-base-300' }}">Perbaikan</a>
                        </li>
                        <li>
                            <a href="/pemutihan" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group {{ request()->is('pemutihan*') ? 'bg-base-200 border-r-2 shadow-md' : 'hover:bg-base-300' }}">
                                Pemutihan
                                @if($pemutihanKaprog >= 1)
                                    <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info {{ request()->is('pemutihan*') ? 'mr-[6px]' : '' }}"></span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="rounded-lg group {{ request()->is('barang', 'barang/detail*', 'barang/search*') ? 'bg-base-200 shadow-md': 'hover:bg-base-300' }}">
                    <a href="/barang" class="flex items-center p-2">
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('barang', 'barang/detail*', 'barang/search*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"></path>
                            </svg>
                        </div>
                    <span class="flex-1 ml-3 whitespace-nowrap">Barang</span>
                    </a>
                </li>

                <li class="rounded-lg group {{ request()->is('perawatan*') ? 'bg-base-200 shadow-md': 'hover:bg-base-300' }}">
                    <a href="/perawatan" class="flex items-center p-2">
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('perawatan*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"></path>
                            </svg>
                        </div>
                    <span class="flex-1 ml-3 whitespace-nowrap">Perawatan</span>
                    </a>
                </li>

                <li class="rounded-lg group {{ request()->is('pengguna*') ? 'bg-base-200 shadow-md': 'hover:bg-base-300' }}">
                    <a href="/pengguna" class="flex items-center p-2">
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('pengguna*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                            </svg>
                        </div>
                    <span class="flex-1 ml-3 whitespace-nowrap">Pengguna</span>
                    </a>
                </li>

                <li class="rounded-lg group {{ request()->is('supplier*') ? 'bg-base-200 shadow-md': 'hover:bg-base-300' }}">
                    <a href="/supplier" class="flex items-center p-2">
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('supplier*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 flex-shrink-0 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
                            </svg>
                        </div>
                        <span class="flex-1 ml-3 whitespace-nowrap">Supplier</span>
                        {{-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-info-content bg-info rounded-full">
                            {{ DB::table('supplier')->count('id_supplier') }}
                        </span> --}}
                    </a>
                </li>

                <li class="rounded-lg group {{ request()->is('ruangan*') ? 'bg-base-200 shadow-md': 'hover:bg-base-300' }}">
                    <a href="/ruangan" class="flex items-center p-2 ">
                        <div class="btn btn-sm btn-active btn-square {{ request()->is('ruangan*') ? 'btn-primary' : 'btn-ghost' }}">
                            <svg class="w-5 h-5 flex-shrink-0 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"></path>
                            </svg>
                        </div>

                        <span class="flex-1 ml-3 whitespace-nowrap">Ruangan</span>
                    </a>
                </li>


            </ul>


            <div class="lg:hidden">
            {{-- line --}}
            <hr class="border-0 h-px bg-gradient-to-r from-base-100 via-primary to-base-100 my-2">
                @auth
                    <div class="p-3 text-center">
                        {{Auth::user()->username}}
                        -
                        <span class="font-semibold
                            {{ (Auth::user()->level_user->nama_level === 'admin') ? 'text-error' : '' }}
                            {{ (Auth::user()->level_user->nama_level === 'manajemen') ? 'text-success' : '' }}
                            {{ (Auth::user()->level_user->nama_level === 'kaprog') ? 'text-info' : '' }}
                        ">
                            {{ Auth::user()->level_user->nama_level }}
                        </span>
                    </div>
                @endauth
            </div>

        </div>
    </div>
 </div>
