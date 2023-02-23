@extends('layouts.main')
@section('container')
{{-- <div class="bg-base-content opacity-50 h-2/6 left-0 right-0 fixed -z-50"></div> --}}
<div class="pt-6 px-4">

    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-base-100 border-t-2 border-primary shadow-md rounded-lg p-4 sm:p-6 xl:p-8 hover:shadow-2xl duration-300">
            <div class="flex items-center">
               <div class="flex-shrink-0">
                  <span class="text-2xl sm:text-3xl leading-none font-bold">
                    @if($barang_masuk == NULL)
                         0
                     @else
                     {{ $barang_masuk }}
                     @endif
                  </span>
                  <h3 class="text-base font-normal">Total Barang</h3>
               </div>
               <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                  <a href="/barangMasuk" class="text-sm font-medium text-cyan-600 hover:bg-base-200 rounded-lg p-2">Details</a>
               </div>
            </div>
        </div>
        <div class="bg-base-100 shadow-md rounded-lg p-4 sm:p-6 xl:p-8 hover:shadow-2xl duration-300">
            <div class="flex items-center">
               <div class="flex-shrink-0">
                  <span class="text-2xl sm:text-3xl leading-none font-bold">
                    @if($pengajuan_bb == NULL)
                         0
                     @else
                         {{ $pengajuan_bb }}
                     @endif
                  </span>
                  <h3 class="text-base font-normal">Pengajuan Barang disetujui</h3>
               </div>
               <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                  <a href="/pengajuan/BB" class="text-sm font-medium text-cyan-600 hover:bg-base-200 rounded-lg p-2">Details</a>
               </div>
            </div>
        </div>
    </div>
    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-base-100 shadow-md rounded-lg p-4 sm:p-6 xl:p-8 hover:shadow-2xl duration-300">
           <div class="flex items-center">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold">{{ $supplier }}</span>
                 <h3 class="text-base font-normal">Jumlah Supplier</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                 <a href="/supplier" class="text-sm font-medium text-cyan-600 hover:bg-base-200 rounded-lg p-2">Details</a>
              </div>
           </div>
        </div>
        <div class="bg-base-100 shadow-md rounded-lg p-4 sm:p-6 xl:p-8 hover:shadow-2xl duration-300">
           <div class="flex items-center">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold">{{ $ruangan }}</span>
                 <h3 class="text-base font-normal">Jumlah Ruangan</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                 <a href="/ruangan" class="text-sm font-medium text-cyan-600 hover:bg-base-200 rounded-lg p-2">Details</a>
              </div>
           </div>
        </div>
        <div class="bg-base-100 shadow-md rounded-lg p-4 sm:p-6 xl:p-8 hover:shadow-2xl duration-300">
           <div class="flex items-center">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold">{{ $pemutihan }}</span>
                 <h3 class="text-base font-normal">Pemutihan disetujui</h3>
              </div>
              <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                 <a href="/pemutihan" class="text-sm font-medium text-cyan-600 hover:bg-base-200 rounded-lg p-2">Details</a>
              </div>
           </div>
        </div>
    </div>


    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        {{-- <div></div> --}}
        <div class="bg-base-100 shadow-md rounded-lg p-4 sm:p-6 xl:p-8 duration-300">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold mb-2">Latest Input Barang</h3>
                    <span class="text-base font-normal ">This is a list of latest input barang</span>
                </div>
            </div>
            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                <div class="align-middle inline-block min-w-full">
                    <div class="shadow-md overflow-hidden sm:rounded-lg">
                        <table class="min-w-full table-compact divide-y">
                            <thead class="font-semibold">
                            <tr>
                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Barang
                                </th>
                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Barang
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($latest_detail_barang as $key)
                            <tr>
                                    <td class="p-4 whitespace-nowrap text-sm font-medium">
                                    <span class="font-semibold">{{ $key->kode_barang }}</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-sm font-normal  ">
                                    {{ $key->nama_jenis }}
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <div class="text-center">
                                                <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                                <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
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
        </div>
        @can('admin')
                <div class="bg-base-100 shadow-md border-t-2 shad border-error rounded-lg p-3 h-full sm:p-5 xl:p-7 duration-300">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Latest logging activity</h3>
                            <span class="text-base font-normal ">This is a list of latest logging activity</span>
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow-md overflow-hidden sm:rounded-lg">
                                <table class="min-w-full table-compact divide-y">
                                    <thead class="font-semibold">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            id Log
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aktifitas
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($latest_logging as $key)
                                    <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-medium">
                                                <span class="font-semibold">{{ $key->id_log }}</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                <p class="badge badge-outline
                                                    {{ ($key->aktifitas === 'tambah barang') ? 'badge-success' : '' }}
                                                    {{ ($key->aktifitas === 'approve pemutihan' OR $key->aktifitas === 'disapprove pemutihan') ? 'badge-warning' : '' }}
                                                    {{ ($key->aktifitas === 'barang diperbaiki' OR $key->aktifitas === 'barang rusak') ? 'badge-info' : '' }}
                                                    ">
                                                        {{ $key->aktifitas }}
                                                </p>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                {{ $key->tgl }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <div class="text-center">
                                                        <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                                        <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
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
                </div>
            {{-- <div class="bg-gradient-to-r from-red-500 to-orange-500 shadow-md rounded-lg p-1">
            </div> --}}
        @endcan

        @can('manajemen')
                <div class="bg-base-100 shadow-md border-t-2 shad border-success rounded-lg p-3 h-full sm:p-5 xl:p-7 duration-300">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Pengajuan Barang Baru</h3>
                            <span class="text-base font-normal ">Yang <span class="font-semibold">belum selesai</span> ditambahkan</span>
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow-md overflow-hidden sm:rounded-lg">
                                <table class="min-w-full table-compact divide-y">
                                    <thead class="font-semibold">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Barang
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah barang
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Pengajuan
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($bb_outstanding as $key)
                                    <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-medium">
                                                <span class="font-semibold">{{ $key->nama_barang }}</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                {{ $key->jumlah }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                {{ $key->tgl }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <div class="text-center">
                                                        <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                                        <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
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
                </div>
            {{-- <div class="bg-gradient-to-r from-lime-400 to-lime-500 shadow-md rounded-lg p-1">
            </div> --}}
        @endcan

        @can('kaprog')
                <div class="bg-base-100 shadow-md border-t-2 shad border-info rounded-lg p-3 h-full sm:p-5 xl:p-7 duration-300">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Daftar Barang Rusak untuk Pemutihan</h3>
                            <span class="text-base font-normal ">Yang belum dilengkapi datanya</span>
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow-md overflow-hidden sm:rounded-lg">
                                <table class="min-w-full table-compact divide-y">
                                    <thead class="font-semibold">
                                    <tr>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kode Barang
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tgl Selesai Perbaikan
                                        </th>
                                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status Perbaikan
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($kode_rusak as $key)
                                    <tr>
                                            <td class="p-4 whitespace-nowrap text-sm font-medium">
                                                <span class="font-semibold">{{ $key->asli }}</span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                {{ $key->tgl_selesai_perbaikan }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                {{ $key->status_perbaikan }}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <div class="text-center">
                                                        <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                                        <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
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
                </div>
            {{-- <div class="bg-gradient-to-r from-indigo-400 to-cyan-400 shadow-md rounded-lg p-1">
            </div> --}}
        @endcan
    </div>




     <br>
</div>

@endsection
