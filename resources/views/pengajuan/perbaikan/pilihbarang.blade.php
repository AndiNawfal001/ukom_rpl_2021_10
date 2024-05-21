@extends('layouts.main')
@section('container')

<div class="pt-6 px-4"> 
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">
        <div class="flex justify-between">
            <h1 class="h1-judul">Pilih Barang yang ingin diperbaiki</h1>
            <div >
                <a href="/pengajuan/PB" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <form action="/pengajuan/PB/pilihBarang" method="GET">
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
                                <x-table-header>No</x-table-header>
                                <x-table-header>Barang</x-table-header>
                                <x-table-header>Kondisi</x-table-header>
                                <x-table-header>Status</x-table-header>
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
                                        {{-- <div class="text-sm opacity-50">{{ $item->kode_barang }}</div> --}}
                                        <div class="text-sm opacity-50">{{ $item->kode_barang }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-table">
                                <p class=" badge badge-outline w-20
                                {{ ($item->kondisi_barang === 'baik') ? 'badge-info' : '' }}
                                {{ ($item->kondisi_barang === 'rusak') ? 'badge-warning' : '' }}
                                ">{{ $item->kondisi_barang }}</p>
                            </td>
                            <td class="border-table">
                                <p class=" badge badge-outline w-20
                                {{ ($item->status === 'aktif') ? 'badge-success' : '' }}
                                {{ ($item->status === 'nonaktif') ? 'badge-error' : '' }}
                                ">{{ $item->status }}</p>
                            </td>
                            @php
                                $t = DB::table('perbaikan')
                                    ->where('perbaikan.approve_perbaikan', 'pending')
                                    ->where('perbaikan.kode_barang', $item->kode_barang)
                                    ->count();
                            @endphp
                            <td class="border-table">
                                <label for="perbaikan{{ $item->kode_barang }}" class="btn btn-sm btn-warning btn-square btn-outline" @if($t != 0) disabled @endif>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg>
                                </label>
                            </td> 
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="text-center">
                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </table>
                    <br>
                    <div class="lg:flex flex-row-reverse">
                        <div>
                            {{ $data->links('vendor.pagination.daisyui') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <br>
</div>



@endsection

@section('modal')

{{-- perbaikan --}}
@foreach($data as $key)
<input type="checkbox" id="perbaikan{{ $key->kode_barang }}" class="modal-toggle" />
<label for="perbaikan{{ $key->kode_barang }}" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <form action="/pengajuan/PB/perbaikan/simpanperbaikan" method="POST">
            @csrf
            <div class="lg:flex justify-between">
                <h2 class="h1-judul">Form Perbaikan</h2>
                <div class="my-2 lg:my-0">
                    Kode barang :
                    <div class="btn btn-sm btn-outline no-animation">{{ $key->kode_barang }}</div>
                </div>
            </div>
            <br>
            <div class="form-control hidden">
                <label class="label">
                <span class="label-text">Kode Barang</span>
                </label>
                <input type="text" name="kode_barang" class="input input-sm input-bordered "
                value="{{ old('nama', $key->kode_barang) }}"/>
            </div>
            <div class="form-control">
                <label class="label">
                <span class="label-text">Keluhan</span>
                </label>
                <textarea name="keluhan" cols="20" rows="5" class="textarea textarea-bordered" " required></textarea>
            </div>
                <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </label>
</label>
@endforeach
@endsection
