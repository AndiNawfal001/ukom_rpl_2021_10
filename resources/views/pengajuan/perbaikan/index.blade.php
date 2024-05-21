@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">
        <h1 class="h1-judul">Daftar Pengajuan Perbaikan Barang</h1>
        <div class="lg:flex justify-between mb-2">
            <form action="/pengajuan/PB" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="flex gap-2 items-center  ">
                            <input type="text" name="search" placeholder="Search Kode Barang…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                            <button class="btn btn-sm btn-primary btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                        </div>
                    </div>
            </form>
            <div class="">
                <a href="/pengajuan/PB/pilihBarang"><button type="submit" class="btn btn-sm btn-success gap-2">Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></button></a>
            </div>
        </div>
        <div class="">
            <div class="">
                <div class="overflow-x-auto overflow-y-auto">

                    <table class="table-primary">
                        <thead class="bg-base-200">
                            <tr>
                                <x-table-header class="w-5">No</x-table-header>
                                <x-table-header>Barang</x-table-header>
                                <x-table-header>Tgl Perbaikan</x-table-header>
                                <x-table-header>Selesai Perbaikan</x-table-header>
                                <x-table-header>Approval perbaikan</x-table-header>
                                <x-table-header>Kontrol</x-table-header>
                            </tr>
                        </thead>
                        <?php $no=1;?>
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
                            <td class="border-table">{{ $item->tgl_perbaikan }}</td>
                            <td class="border-table">
                                @if($item->tgl_selesai_perbaikan == NULL)
                                    <div class="badge badge-warning badge-outline">belum selesai</div>
                                @else
                                    <div class="badge badge-success badge-outline">sudah selesai</div>
                                @endif
                            </td>
                            <td class="border-table">
                                <p class=" badge badge-outline w-20
                                {{ ($item->approve_perbaikan === 'sudah diperbaiki') ? 'badge-success' : '' }}
                                {{ ($item->approve_perbaikan === 'pending') ? 'badge-warning' : '' }}
                                {{ ($item->approve_perbaikan === 'rusak') ? 'badge-error' : '' }}
                                ">{{ $item->approve_perbaikan }}</p>
                            </td>
                            <td class="border-table">
                                @if($item->tgl_selesai_perbaikan == NULL)
                                    <label for="selesaiperbaikan{{$item->id_perbaikan}}" class="btn btn-sm btn-success btn-square btn-outline">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </label>
                                @else
                                <label for="detail{{ $item->id_perbaikan }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </label>
                                @endif
                                @if($item->nama_teknisi == NULL)
                                <label for="delete{{ $item->id_perbaikan }}" class="btn btn-sm btn-error btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </label>
                                @endif
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

                </div>

            </div>
        </div>

    </div>
    <br>
</div>


@endsection


@section('modal')
{{-- DETAIL --}}
@foreach($data as $key)
    <input type="checkbox" id="detail{{ $key->id_perbaikan }}" class="modal-toggle" />
    <label for="detail{{ $key->id_perbaikan }}" class="modal cursor-pointer">
    <div class="modal-box">
        <div>
            <p class="btn btn-sm btn-outline mb-3">{{ $key->kode_barang }}</p>
            <p class="text-2xl font-semibold">{{ $key->nama_barang }}</p>
            <div class="lg:flex gap-5">
                <p class="text-md lg:border-r-2 lg:pr-5">diajukan {{ $key->tgl_perbaikan }}</p>
                <p class="text-md font-medium">Selesai diperbaiki pada {{ $key->tgl_selesai_perbaikan }}</p>
            </div>
            <div class="pb-3">
                <p class="font-light">Dari Ruangan <span class="font-medium">{{ $key->nama_ruangan }}</span> </p>
            </div>
            <div class="pb-3">
                <p class="font-light">Keluhan</p>
                <p class="font-medium ">{{ $key->keluhan }} </p>
            </div>
            <div class="pb-3">
                <p class="font-light">Nama Teknisi</p>
                <p class="font-medium ">{{ $key->nama_teknisi }} </p>
            </div>
            <div class="pb-3">
                <p class="font-light">Penyebab Keluhan</p>
                <p class="font-medium ">{{ $key->penyebab_keluhan }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit perspiciatis consequuntur unde neque eaque laboriosam, corporis labore at inventore debitis, fuga autem dolor ut illum tempore iusto dignissimos corrupti doloremque!</p>
            </div>
            <div class="flex ">
                <div class="badge badge-lg badge-outline
                    {{ ($key->status_perbaikan === 'bisa diperbaiki') ? 'badge-success' : '' }}
                    {{ ($key->status_perbaikan === 'tidak bisa diperbaiki') ? 'badge-error' : '' }}
                    ">{{ $key->status_perbaikan}}
                </div>
            </div>
        </div>
    </div>
    </label>
@endforeach

{{-- SELESAI PERBAIKAN --}}
@foreach($data as $key)
<input type="checkbox" id="selesaiperbaikan{{$key->id_perbaikan}}" class="modal-toggle" />
<label for="selesaiperbaikan{{$key->id_perbaikan}}" class="modal cursor-pointer">
    <div class="modal-box w-11/12 max-w-5xl">
        <form action="/PB/selesaiPerbaikan/simpanSelesaiPerbaikan" method="POST">
            @csrf
            <h2 class="h1-judul">Form Selesai Perbaikan</h2>
                <div class="pt-2">
                    Kode barang :
                    <div class="btn btn-sm btn-outline no-animation">{{ $key->kode_barang }}</div>
                </div>
            <br>
            <div class="form-control hidden">
                <label class="label">
                <span class="label-text">Kode Barang</span>
                </label>
                <input type="text" name="id_perbaikan" class="input input-sm input-bordered "
                value="{{ old('id_perbaikan', $key->id_perbaikan) }}"/>
            </div>
            <div class="lg:flex gap-5">
                <div class="basis-1/2">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Teknisi</span>
                        </label>
                        <input type="text" name="nama_teknisi" class="input input-sm input-bordered" required autocomplete="off"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Penyebab Keluhan</span>
                        </label>
                        <textarea name="penyebab_keluhan" cols="20" rows="5" class="textarea textarea-bordered" required></textarea>
                    </div>
                </div>
                <div class="basis-1/2">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status Barang</span>
                            </label>
                        <div class="flex items-center pl-4 rounded-t border">
                            <input id="bordered-radio-1" type="radio" value="bisa diperbaiki" name="status_perbaikan" class="radio radio-success" required>
                            <label for="bordered-radio-1" class="py-4 ml-2 text-success w-full text-sm font-medium ">Bisa Diperbaiki</label>
                        </div>
                        <div class="flex items-center pl-4 rounded-b border">
                            <input id="bordered-radio-2" type="radio" value="tidak bisa diperbaiki" name="status_perbaikan" class="radio radio-error" required>
                            <label for="bordered-radio-2" class="py-4 ml-2 text-error w-full text-sm font-medium ">Tidak Bisa Diperbaiki</label>
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Solusi Keluhan</span>
                        </label>
                        <textarea name="solusi_barang" cols="20" rows="5" class="textarea textarea-bordered" placeholder="Silahkan Dikosongkan Jika Status Barang tidak bisa diperbaiki" ></textarea>
                    </div>
                </div>
            </div>
                <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
</label>
@endforeach

{{-- HAPUS --}}
@foreach($data as $key)
    <input type="checkbox" id="delete{{ $key->id_perbaikan }}" class="modal-toggle" />
    <label for="delete{{ $key->id_perbaikan }}" class="modal cursor-pointer">
    <div class="modal-box border-t-2 border-error">
        <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
        </svg>
        <div class="text-center">
            <h3 class="font-bold text-2xl">Anda yakin ?</h3>
            {{-- <p class="py-4 text-md">Menghapus pengguna <b>permanen</b> membuat pengguna tersebut tidak bisa lagi login</p> --}}
        </div>
        <div class="flex justify-center pt-4 gap-3">
            <label for="delete{{ $key->id_perbaikan }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
            <label class="btn btn-sm btn-error btn-outline">
                <a href="/pengajuan/PB/hapus/{{$key->id_perbaikan}}">
                    Delete
                </a>
            </label>
        </div>
    </div>
    </label>
@endforeach
@endsection
