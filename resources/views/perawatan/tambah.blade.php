@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="/perawatan/simpanperawatan" method="POST" enctype="multipart/form-data">
 @csrf
    <div class="flex justify-between">
        <div class="order-last">
            Kode barang :
            <div class="btn btn-sm btn-outline no-animation">{{ $perawatan->kode_barang }}</div>

        </div>
        <h2 class="text-2xl font-bold">Form perawatan</h2>
    </div>
    <br>
    <div class="form-control hidden">
        <label class="label">
        <span class="label-text">Kode Barang</span>
        </label>
        <input type="text" name="kode_barang" class="input input-bordered "
        value="{{ old('nama', $perawatan->kode_barang) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Nama Pelaksana</span>
        </label>
        <input type="text" name="nama_pelaksana" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Keterangan Perawatan</span>
        </label>
        <textarea name="ket_perawatan" cols="20" rows="5" class="textarea textarea-bordered" " required></textarea>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Gambar saat perawatan</span>
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
