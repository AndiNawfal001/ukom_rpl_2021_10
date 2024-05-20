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
                        <table class="min-w-full table-xs divide-y">
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
                                                <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
                                <table class="min-w-full table-xs divide-y">
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
                                                <p class=" badge badge-outline w-20
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
                                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
                                <table class="min-w-full table-xs divide-y">
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
                                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
                                <table class="min-w-full table-xs divide-y">
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
                                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
