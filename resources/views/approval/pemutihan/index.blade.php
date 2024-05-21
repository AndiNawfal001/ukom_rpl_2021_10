@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">

    <div class="bg-base-100 border-t-2 border-primary shadow rounded-md p-4 sm:p-5 ">
        <h1 class="h1-judul">Daftar Pengajuan pemutihan untuk di Approve</h1>
        <form action="/approval/pemutihan" method="GET">
            @csrf
                <div class="form-control mb-2">
                    <div class="flex gap-2 items-center  ">
                    <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                    <button class="btn btn-sm btn-primary btn-square" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                    </div>
                </div>
        </form>
        <div class="">
            <div class="">
                <div class="overflow-x-auto overflow-y-auto">
                    <table class="table-primary ">
                        <thead class="bg-base-200">
                            <tr>
                                <x-table-header class="w-5">No</x-table-header>
                                <x-table-header>Barang</x-table-header>
                                <x-table-header>Tanggal Pemutihan</x-table-header>
                                <x-table-header>Penonaktifan</x-table-header>
                                <x-table-header>Kontrol</x-table-header>
                            </tr>
                        </thead> 
                        @forelse($data as $key => $item)
                        <tr>
                            <td class="border-table">{{ $data->firstItem() + $key }}</td>
                            <td class="border-table">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <div class="font-bold text-lg">{{ $item->nama_barang }}</div>
                                        <div class="text-sm opacity-50">{{ $item->kode_barang }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-table">{{ $item->tgl_pemutihan }}</td>
                            <td class="border-table">
                                <p class=" badge badge-outline w-20
                                {{ ($item->approve_penonaktifan === 'setuju') ? 'badge-success' : '' }}
                                {{ ($item->approve_penonaktifan === 'pending') ? 'badge-warning' : '' }}
                                {{ ($item->approve_penonaktifan === 'tidak setuju') ? 'badge-error' : '' }}
                                ">{{ $item->approve_penonaktifan }}</p>
                            </td>
                            <td class="border-table">
                                <label for="detailpemutihan{{ $item->id_pemutihan }}" class="btn btn-sm btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </label>
                            </td>
                        </tr> 
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">
                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </table>

                </div>
            </div>
        </div>
    </div>
    <br>
</div>

@endsection

@section('modal')
@foreach ($data as $key)
    <input type="checkbox" id="detailpemutihan{{ $key->id_pemutihan }}" class="modal-toggle" />
    <label for="detailpemutihan{{ $key->id_pemutihan }}" class="modal cursor-pointer">
        <div class="modal-box max-w-5xl">
            <div class="lg:flex gap-10">
                <div class="basis-1/2">
                    <p class="font-light text-gray-500 pb-2">Foto Kondisi Terakhir Barang</p>
                    <div class=" border-2 border-base-300 rounded-md p-3 bg-base-200">
                        <a href="{{ asset('storage/'.$key->foto_kondisi_terakhir) }}" target="_blank" class="group">
                            <img src="{{ asset('storage/'.$key->foto_kondisi_terakhir) }}" class="mx-auto shadow  group-hover:brightness-50 ">
                        </a>
                    </div>
                </div>
                <div class="basis-1/2">
                    <div class="lg:flex justify-between items-center my-5">
                        <div class="mb-2 lg:mb-0">
                        @if($key->id_perbaikan == NULL)
                            <p class="badge badge-lg badge-outline badge-warning">Pemutihan langsung</p>
                        @else
                            <p class="badge badge-lg badge-outline badge-info">Pemutihan dari perbaikan</p>
                        @endif
                        </div>
                        <div>
                            <p class="btn btn-sm btn-outline">{{ $key->kode_barang }}</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold">{{ $key->nama_barang }}</h3>
                    <h3 class="text-md">diajukan {{ $key->tgl_pemutihan }}</h3>

                    <div class="py-4">
                        <p class="font-light text-gray-500">Keterangan Pemutihan</p>
                        <p class="font-medium">{{ $key->ket_pemutihan }}</p>
                    </div>

                    @if($key->id_perbaikan == NULL)
                    @else
                    <div class="py-2">
                        <p class="font-light text-gray-500">Nama Teknisi</p>
                        <p class="font-medium">{{ $key->nama_teknisi }}</p>
                    </div>
                    <div class="py-2">
                        <p class="font-light text-gray-500">Status Perbaikan</p>
                        <p class="badge badge-md badge-outline
                            {{ ($key->status_perbaikan === 'bisa diperbaiki') ? 'badge-success' : '' }}
                            {{ ($key->status_perbaikan === 'tidak bisa diperbaiki') ? 'badge-error' : '' }}
                        ">{{ $key->status_perbaikan }}</p>
                    </div>
                    <div class="py-2 flex gap-7">
                        <div>
                            <p class="font-light text-gray-500">Tgl Perbaikan</p>
                            <p class="font-medium">{{ $key->tgl_perbaikan }}</p>
                        </div>
                        <div>
                            <p class="font-light text-gray-500">Tgl Selesai</p>
                            <p class="font-medium">{{ $key->tgl_selesai_perbaikan }}</p>
                        </div>
                    </div>
                    @endif
                    @if($key->approve_penonaktifan == "pending")
                    <br>
                        <div class="flex flex-row-reverse gap-3">
                            <a href="/approval/pemutihan/tidaksetuju/{{$key->id_pemutihan}}"><button class="btn btn-sm btn-outline btn-error">Tidak Setuju</button></a>
                            <a href="/approval/pemutihan/setuju/{{$key->id_pemutihan}}/{{ $key->kode_barang }}"><button class="btn btn-sm btn-outline btn-success">Setuju</button></a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </label>
@endforeach
@endsection
