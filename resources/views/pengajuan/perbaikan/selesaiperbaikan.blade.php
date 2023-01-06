@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="simpanSelesaiPerbaikan" method="POST" enctype="multipart/form-data">
 @csrf
    <div class="flex justify-between">
        <div class="order-last">
            Kode barang :
            <div class="btn btn-sm btn-outline no-animation">{{ $edit->kode_barang }}</div>
        </div>
        <h2 class="text-2xl font-bold">Form Selesai Perbaikan</h2>
    </div>
    <br>
    <div class="form-control hidden">
        <label class="label">
        <span class="label-text">Kode Barang</span>
        </label>
        <input type="text" name="id_perbaikan" class="input input-bordered "
        value="{{ old('nama', $edit->id_perbaikan) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Nama Teknisi</span>
        </label>
        <input type="text" name="nama_teknisi" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Penyebab Keluhan</span>
        </label>
        <textarea name="penyebab_keluhan" cols="20" rows="5" class="textarea textarea-bordered" required></textarea>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Status Barang</span>
            </label>
        <div class="flex items-center pl-4 rounded border">
            <input id="bordered-radio-1" type="radio" value="bisa diperbaiki" name="status_perbaikan" class="radio radio-success">
            <label for="bordered-radio-1" class="py-4 ml-2 text-success w-full text-sm font-medium ">Bisa Diperbaiki</label>
        </div>
        <div class="flex items-center pl-4 rounded border">
            <input id="bordered-radio-2" type="radio" value="tidak bisa diperbaiki" name="status_perbaikan" class="radio radio-error">
            <label for="bordered-radio-2" class="py-4 ml-2 text-error w-full text-sm font-medium ">Tidak Bisa Diperbaiki</label>
        </div>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Solusi Keluhan</span>
        </label>
        <textarea name="solusi_barang" cols="20" rows="5" class="textarea textarea-bordered" placeholder="Silahkan Dikosongkan Jika Status Barang tidak bisa diperbaiki" ></textarea>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Gambar saat perbaikan</span>
        </label>
        <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage()" required/>
        <br>
        <img src="" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
    </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
