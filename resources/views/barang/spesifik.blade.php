@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold leading-loose">Detail </h1>
            <div >
                <a href="/barang/detail/{{ $data->id_barang}}" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <hr class="border mb-4">
        <div class="">
            <div class="lg:w-10/12 mx-auto">
                <div class="flex border">
                    <span class="p-3 basis-2/5 text-right bg-base-200 font-semibold">Nama Barang</span>
                    <span class="p-3 basis-3/5 md:basis-3/4 bg-base-100">{{ $data->nama_barang }}</span>
                </div>
                <div class="flex border">
                    <span class="p-3 basis-2/5 text-right bg-base-200 font-semibold">Kode Barang</span>
                    <span class="p-3 basis-3/5 md:basis-3/4 bg-base-100">{{ $data->kode_barang }}</span>
                </div>
                <div class="flex border">
                    <span class="p-3 basis-2/5 text-right bg-base-200 font-semibold">Jenis Barang</span>
                    <span class="p-3 basis-3/5 md:basis-3/4 bg-base-100">{{ $data->nama_jenis }}</span>
                </div>
                <div class="flex border">
                    <span class="p-3 basis-2/5 text-right bg-base-200 font-semibold">Spesifikasi</span>
                    <span class="p-3 basis-3/5 md:basis-3/4 bg-base-100">{{ $data->spesifikasi }} </span>
                </div>
                <div class="flex border">
                    <div class="p-3 basis-2/5 text-right bg-base-200 font-semibold">Foto Barang</div>
                    <div class="p-3 basis-3/5 md:basis-3/4 bg-base-100 grid place-content-center md:place-content-start">
                        <a href="{{ asset('storage/'.$data->foto_barang) }}" target="_blank" class="group">
                            <img src="{{ asset('storage/'.$data->foto_barang) }}" class="w-52 shadow  group-hover:brightness-50 "/>
                        </a>
                    </div>
                </div>
                <div class="flex flex-row-reverse my-2">
                    <label for="editdetailbarang{{$data->kode_barang}}"class="btn btn-warning btn-outline gap-2"> EDIT
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </label>
                </div>
            </div>

        </div>

    </div>
    <br>
</div>

@endsection
@section('modal')


@foreach($modal as $key)
    <input type="checkbox" id="editdetailbarang{{ $key->kode_barang }}" class="modal-toggle" />
    <label for="editdetailbarang{{ $key->kode_barang }}" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <form action="/barang/detail/update/{{ $key->kode_barang }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-bold">Edit Detail Barang</h2>
            <br>
            <div class="form-control">
                <label class="label">
                <span class="label-text">Spesifikasi</span>
                </label>
                <input type="text" name="spesifikasi" class="input input-bordered"
                value="{{ old('spesifikasi', $key->spesifikasi) }}"/>
                <input type="hidden"  name="kode_barang" value="{{$key->kode_barang}}" />
                {{-- <input type="hidden"  name="id_barang" value="{{$key->id_barang}}" /> --}}
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Gambar</span>
                </label>

                <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage()"/>
                <br>
                <input type="hidden" name="oldImage" value="{{ $key->foto_barang }}">

                @if($key->foto_barang)
                    <img src="{{ asset('storage/'.$key->foto_barang) }}" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
                @else
                <img class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">

                @endif
            </div>

                <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </label>
    </label>

@endforeach
@endsection
