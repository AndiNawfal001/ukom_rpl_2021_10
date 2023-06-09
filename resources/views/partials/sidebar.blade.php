<div class="relative flex-1 flex flex-col min-h-0 bg-base-100 lg:bg-transparent shadow-xl lg:shadow-none rounded-2xl px-2">
    <hr class="hidden lg:block border-0 h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent mt-1 -my-2">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
           <div class="flex-1 px-3 space-y-1">
                <ul class="">
                    <li class="rounded-lg group my-1 {{ request()->is('dashboard') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                        <a href="/dashboard" class="flex items-center p-2 ">
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('dashboard') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                                  </svg>

                            </div>

                        <span class="ml-3 {{ request()->is('dashboard') ? 'font-semibold opacity-100' : 'opacity-70' }}">Dashboard</span>
                        </a>
                    </li>
                    @can('admin')
                        <li class="rounded-lg group my-1 {{ request()->is('logging*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                            <a href="/logging" class="flex items-center p-2">
                                <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('logging*') ? 'bg-primary text-base-100 ' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                        <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                        <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                        <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                                      </svg>

                                </div>
                            <span class="flex-1 ml-3  {{ request()->is('logging*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Logging</span>
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
                        <li class="rounded-lg group my-1 {{ request()->is('barang Masuk*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                            <a href="/barang Masuk" class="flex items-center p-2">
                                <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('barangMasuk*') ? 'bg-primary text-base-100 ' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M19.5 21a3 3 0 003-3V9a3 3 0 00-3-3h-5.379a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H4.5a3 3 0 00-3 3v12a3 3 0 003 3h15zm-6.75-10.5a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V10.5z" clip-rule="evenodd" />
                                      </svg>

                                </div>
                            <span class="flex-1 ml-3  {{ request()->is('barang Masuk*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Barang Masuk</span>
                            @can('manajemen')
                                @if($approved_null >= 1)
                                    <span class="inline-flex justify-center items-center p-3 ml-3 w-3 h-3 text-sm font-medium text-info-content bg-info rounded-full">{{ $approved_null }}</span>
                                @endif
                            @endcan
                            </a>
                        </li>
                    @endcan

                    @can('admin+manajemen')
                    <li class="group rounded-lg my-1">
                        <button type="button" class="flex items-center p-2 w-full dropdown-btn" >
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('approval/BB*', 'approval/PB*' ,'approval/pemutihan*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zm9.586 4.594a.75.75 0 00-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.116-.062l3-3.75z" clip-rule="evenodd" />
                                  </svg>

                            </div>

                            <span  class="flex-1 ml-3 text-left  {{ request()->is('approval/BB*', 'approval/PB*' ,'approval/pemutihan*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap" sidebar-toggle-item>Approval</span>
                            @if($pemutihan >= 1 or $pengajuan_bb >=1 or $perbaikan >= 1)
                                <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info"></span>
                            @endif
                            <svg sidebar-toggle-item class="w-6 h-6 group-hover:text-base-content" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul class="dropdown-container {{ request()->is('approval/BB*', 'approval/PB*' ,'approval/pemutihan*') ? 'block' : 'hidden' }}">
                            <li >
                                <a href="/approval/BB" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group opacity-70 {{ request()->is('approval/BB*') ? 'bg-base-100 border-r-2 shadow-lg' : '' }}">
                                    Barang Baru
                                    @if($pengajuan_bb >= 1)
                                        <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info {{ request()->is('approval/BB*') ? 'mr-[6px]' : '' }}"></span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="/approval/PB" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group opacity-70 {{ request()->is('approval/PB*') ? 'bg-base-100 border-r-2 shadow-lg' : '' }}">
                                    Perbaikan
                                    @if($perbaikan >= 1)
                                        <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info {{ request()->is('approval/PB*') ? 'mr-[6px]' : '' }}"></span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="/approval/pemutihan" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group opacity-70 {{ request()->is('approval/pemutihan*') ? 'bg-base-100 border-r-2 shadow-lg' : '' }}">
                                    Pemutihan
                                    @if($pemutihan >= 1)
                                        <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info{{ request()->is('approval/pemutihan*') ? 'mr-[6px]' : '' }}"></span>
                                    @endif
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan

                    <li class="group rounded-lg my-1">
                        <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg dropdown-btn" >
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('pengajuan/BB*', 'pengajuan/PB*' ,'pemutihan*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                                  </svg>

                            </div>
                            <span  class="flex-1 ml-3 text-left  {{ request()->is('pengajuan/BB*', 'pengajuan/PB*' ,'pemutihan*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap" sidebar-toggle-item>Pengajuan</span>
                            @if($pemutihanKaprog >= 1 )
                                <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info"></span>
                            @endif
                            <svg sidebar-toggle-item class="w-6 h-6 group-hover:text-base-content" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul class="dropdown-container {{ request()->is('pengajuan/BB*', 'pengajuan/PB*' ,'pemutihan*') ? 'block' : 'hidden' }}">
                            <li>
                                <a href="/pengajuan/BB" class="flex items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group opacity-70 {{ request()->is('pengajuan/BB*') ? 'bg-base-100 border-r-2 shadow-lg' : '' }}">Barang Baru</a>
                            </li>
                            <li>
                                <a href="/pengajuan/PB" class="flex items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group opacity-70 {{ request()->is('pengajuan/PB*') ? 'bg-base-100 border-r-2 shadow-lg' : '' }}">Perbaikan</a>
                            </li>
                            <li>
                                <a href="/pemutihan" class="flex justify-between items-center py-3 px-2 pl-11 w-full text-base border-primary font-normal rounded-lg group opacity-70 {{ request()->is('pemutihan*') ? 'bg-base-100 border-r-2 shadow-lg' : '' }}">
                                    Pemutihan
                                    @if($pemutihanKaprog >= 1)
                                        <span class="inline-flex mx-2 justify-center items-center p-1 ml-1 w-1 h-1 text-sm font-medium rounded-full bg-info {{ request()->is('pemutihan*') ? 'mr-[6px]' : '' }}"></span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="rounded-lg group my-1 {{ request()->is('barang', 'barang/detail*', 'barang/search*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                        <a href="/barang" class="flex items-center p-2">
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('barang', 'barang/detail*', 'barang/search*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
                                  </svg>

                            </div>
                        <span class="flex-1 ml-3  {{ request()->is('barang', 'barang/detail*', 'barang/search*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Barang</span>
                        </a>
                    </li>

                    <li class="rounded-lg group my-1 {{ request()->is('perawatan*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                        <a href="/perawatan" class="flex items-center p-2">
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('perawatan*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.906 9c.382 0 .749.057 1.094.162V9a3 3 0 00-3-3h-3.879a.75.75 0 01-.53-.22L11.47 3.66A2.25 2.25 0 009.879 3H6a3 3 0 00-3 3v3.162A3.756 3.756 0 014.094 9h15.812zM4.094 10.5a2.25 2.25 0 00-2.227 2.568l.857 6A2.25 2.25 0 004.951 21H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-2.227-2.568H4.094z" />
                                  </svg>

                            </div>
                        <span class="flex-1 ml-3  {{ request()->is('perawatan*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Perawatan</span>
                        </a>
                    </li>

                    <li class="rounded-lg group my-1 {{ request()->is('pengguna*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                        <a href="/pengguna" class="flex items-center p-2">
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('pengguna*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                                    <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                  </svg>

                            </div>
                        <span class="flex-1 ml-3  {{ request()->is('pengguna*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Pengguna</span>
                        </a>
                    </li>

                    <li class="rounded-lg group my-1 {{ request()->is('supplier*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                        <a href="/supplier" class="flex items-center p-2">
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('supplier*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                                    <path d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                                    <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                  </svg>

                            </div>
                            <span class="flex-1 ml-3  {{ request()->is('supplier*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Supplier</span>
                            {{-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-info-content bg-info rounded-full">
                                {{ DB::table('supplier')->count('id_supplier') }}
                            </span> --}}
                        </a>
                    </li>

                    <li class="rounded-lg group my-1 {{ request()->is('ruangan*') ? 'bg-base-100 lg:shadow-lg' : '' }}">
                        <a href="/ruangan" class="flex items-center p-2 ">
                            <div class="bg-base-100 w-9 h-9 rounded-lg shadow-lg flex justify-center items-center {{ request()->is('ruangan*') ? 'bg-primary text-base-100 ' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 000 1.5v16.5h-.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5h-.75V3.75a.75.75 0 000-1.5h-15zM9 6a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm-.75 3.75A.75.75 0 019 9h1.5a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM9 12a.75.75 0 000 1.5h1.5a.75.75 0 000-1.5H9zm3.75-5.25A.75.75 0 0113.5 6H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM13.5 9a.75.75 0 000 1.5H15A.75.75 0 0015 9h-1.5zm-.75 3.75a.75.75 0 01.75-.75H15a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zM9 19.5v-2.25a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v2.25a.75.75 0 01-.75.75h-4.5A.75.75 0 019 19.5z" clip-rule="evenodd" />
                                  </svg>

                            </div>

                            <span class="flex-1 ml-3  {{ request()->is('ruangan*') ? 'font-semibold opacity-100' : 'opacity-70' }} whitespace-nowrap">Ruangan</span>
                        </a>
                    </li>


                </ul>

            </div>
        </div>
</div>
