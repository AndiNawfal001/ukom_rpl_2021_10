@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">
            <div class="flex justify-between">
                <h1 class="text-xl font-semibold leading-loose">Detail </h1>
                <div>
                    <a href="/barang/detail/{{ $data->id_barang }}" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                </div>
            </div>
        <div class="lg:flex gap-10">
            <div class="basis-1/2 mb-5 lg:mb-0">
                <div class=" border-2 border-base-300 rounded-md p-3 bg-base-200">
                    <a href="{{ asset('storage/'.$data->foto_barang) }}" target="_blank" class="group">
                        <img src="{{ asset('storage/'.$data->foto_barang) }}" class="mx-auto shadow  group-hover:brightness-50 ">
                    </a>
                </div>
            </div>
            <div class="basis-1/2">
                <p class="btn btn-sm btn-outline mb-3">{{ $data->kode_barang }}</p>
                <p class="text-2xl font-semibold">{{ $data->nama_barang }}</p>
                <div class="pb-3">
                    <p class="font-medium">{{ $data->nama_jenis }}</p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Dari Ruangan</p>
                    <p class="font-medium ">{{ $data->nama_ruangan }}</p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Spesifikasi</p>
                    <p class="font-medium ">{{ $data->spesifikasi }}</p>
                </div>
                <div class="pb-3 flex gap-5">
                    <div class="pb-3">
                        <p class="font-light">Kondisi</p>
                        <span class="badge badge-lg badge-outline
                            {{ ($data->kondisi_barang === 'baik') ? 'badge-info' : '' }}
                            {{ ($data->kondisi_barang === 'rusak') ? 'badge-warning' : '' }}
                            ">{{ $data->kondisi_barang}}
                        </span>
                    </div>
                    <div class="pb-3">
                        <p class="font-light">Status</p>
                        <span class="badge badge-lg badge-outline
                            {{ ($data->status === 'aktif') ? 'badge-success' : '' }}
                            {{ ($data->status === 'nonaktif') ? 'badge-error' : '' }}
                            ">{{ $data->status}}
                        </span>
                    </div>
                </div>
                <div class="flex flex-row-reverse">
                    <label for="editdetailbarang{{$data->kode_barang}}" class="btn btn-sm btn-outline btn-warning">
                        Edit
                    </label>
                    </div>
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
            <h2 class="h1-judul">Edit Detail Barang</h2>
            <br>
            <div class="form-control">
                <label class="label">
                <span class="label-text">Spesifikasi</span>
                </label>
                <textarea name="spesifikasi" cols="20" rows="5" class="textarea textarea-bordered" " required>{{ old('spesifikasi', $key->spesifikasi) }}</textarea>
                <input type="hidden"  name="kode_barang" value="{{$key->kode_barang}}" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Gambar</span>
                </label>

                <input type="file" name="image" id="image" class="file-input file-input-sm file-input-bordered w-full max-w-xs" onchange="previewImage()"/>
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
