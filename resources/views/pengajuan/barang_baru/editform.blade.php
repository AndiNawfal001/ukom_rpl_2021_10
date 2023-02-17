@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="/pengajuan/BB/update/{{$edit->id_pengajuan_bb}}" method="POST">
        @csrf
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold">Edit Pengajuan</h2>
            <div class="">
                <a href="/pengajuan/BB" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <br>
        <div class="lg:flex flex-row gap-5">
            <div class="basis-1/2">
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Nama Barang</span>
                    </label>
                    <input type="text" name="nama_barang" class="input input-bordered @error('nama_barang') input-error @enderror"
                    value="{{ old('nama_barang', $edit->nama_barang) }}" required autocomplete="off"/>
                    @error('nama_barang')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <input type="hidden"  name="id_pengajuan_bb" value="{{$edit->id_pengajuan_bb}}" />
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Spesifikasi</span>
                    </label>
                    <textarea name="spesifikasi" cols="20" rows="5" class="textarea textarea-bordered" required>{{ $edit->spesifikasi }}</textarea>
                </div>
            </div>
            <div class="basis-1/2">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Harga Satuan</span>
                    </label>
                    <input type="number" name="harga_satuan" class="input input-bordered"
                    value="{{ old('harga_satuan', $edit->harga_satuan) }}" required autocomplete="off"/>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">jumlah</span>
                    </label>
                    <input type="number" name="jumlah" class="input input-bordered"
                    value="{{ old('jumlah', $edit->jumlah) }}" required autocomplete="off"/>
                </div>
            </div>
        </div>
            <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
    </div>

</div>
@endsection
