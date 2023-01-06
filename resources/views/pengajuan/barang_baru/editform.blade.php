@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="editsimpan" method="POST">
 @csrf
    <h2 class="text-2xl font-bold">Form Edit Barang</h2>
    <br>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Nama Barang</span>
        </label>
        <input type="text" name="nama_barang" class="input input-bordered"
        value="{{ old('nama_barang', $edit->nama_barang) }}"/>
        <input type="hidden"  name="id_pengajuan_bb" value="{{$edit->id_pengajuan_bb}}" />
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">spesifikasi</span>
        </label>
        <input type="text" name="spesifikasi" class="input input-bordered"
        value="{{ old('spesifikasi', $edit->spesifikasi) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">harga_satuan</span>
        </label>
        <input type="text" name="harga_satuan" class="input input-bordered"
        value="{{ old('harga_satuan', $edit->harga_satuan) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">total_harga</span>
        </label>
        <input type="text" name="total_harga" class="input input-bordered"
        value="{{ old('total_harga', $edit->total_harga) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">jumlah</span>
        </label>
        <input type="number" name="jumlah" class="input input-bordered"
        value="{{ old('jumlah', $edit->jumlah) }}"/>
    </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
