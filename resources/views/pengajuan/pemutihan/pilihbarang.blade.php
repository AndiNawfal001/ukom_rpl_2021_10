@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">
        <div class="flex justify-between items-center">
            <h1 class="h1-judul">Pilih Barang yang rusak</h1>
            <a href="/pemutihan" class="btn btn-sm btn-square">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </a>
        </div>
        <form action="/pemutihan/pilihbarang" method="GET">
            @csrf
                <div class="form-control mb-2">
                    <div class="flex gap-2 items-center  ">
                    <input type="text" name="search" placeholder="Search Kode Barang…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off" />
                    <button class="btn btn-sm btn-primary btn-square" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                    </div>
                </div>
        </form>
        <div class="">
            <div class=" gap-5">
                <div class="overflow-x-auto overflow-y-auto ">
                    <table class="table-primary ">
                        <thead class="bg-base-200">
                            <tr>
                                <x-table-header class="w-5">No</x-table-header>
                                <x-table-header>Barang</x-table-header>
                                <x-table-header>Tgl Selesai Perbaikan</x-table-header>
                                <x-table-header>Status Perbaikan</x-table-header>
                                <x-table-header>Approve Perbaikan</x-table-header>
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
                                        <div class="text-sm opacity-50">{{ $item->asli }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-table">{{ $item->tgl_selesai_perbaikan }}</td>
                            <td class="border-table"><p class=" badge badge-outline w-20 badge-warning">{{ $item->status_perbaikan }}</p></td>
                            <td class="border-table"><p class=" badge badge-outline w-20 badge-error">{{ $item->approve_perbaikan }}</p></td>
                            <td class="border-table">
                                <label for="pemutihan{{ $item->kode_barang }}" class="btn btn-sm btn-warning btn-square btn-outline">
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

                </div>

            </div>
        </div>
    </div>
    <br>
</div>

@endsection

@section('modal')

{{-- pemutihan --}}
@foreach($data as $key)
<input type="checkbox" id="pemutihan{{ $key->kode_barang }}" class="modal-toggle" />
<label for="pemutihan{{ $key->kode_barang }}" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <form action="/pemutihan/pemutihan/simpanpemutihan" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-between">
                <div class="order-last">
                    Kode barang :
                    <div class="btn btn-sm btn-outline no-animation">{{ $key->asli }}</div>

                </div>
                <h2 class="h1-judul">Form pemutihan</h2>
            </div>
            <br>
            <div class="form-control hidden">
                <label class="label">
                <span class="label-text">Kode Barang</span>
                </label><input type="text" name="id_perbaikan" class="input input-sm input-bordered "
                value="{{ old('nama', $key->id_perbaikan) }}"/>
                <input type="text" name="kode_barang" class="input input-sm input-bordered "
                value="{{ old('nama', $key->asli) }}"/>
            </div>
            <div class="form-control hidden">
                <label class="label">
                <span class="label-text">Kontak</span>
                </label>
                <input type="text" name="submitter" class="input input-sm input-bordered"
                value="{{ $submitter }}"/>
            </div>
            <div class="form-control">
                <label class="label">
                <span class="label-text">Keterangan Pemutihan</span>
                </label>
                <textarea name="ket_pemutihan" cols="20" rows="5" class="textarea textarea-bordered" placeholder="contoh : barang sudah rusak" required></textarea>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Foto kondisi terakhir barang</span>
                </label>
                <input type="file" name="image" id="image" class="file-input file-input-sm file-input-bordered w-full max-w-xs" onchange="previewImage()" required/>
                <br>
                <img src="" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
            </div>
                <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </label>
</label>
@endforeach
@endsection
