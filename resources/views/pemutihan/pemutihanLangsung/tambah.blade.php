@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">

 <form action="/pemutihan/pemutihanLangsung/simpanpemutihanLangsung" method="POST">
 @csrf
    <div class="flex justify-between">
        <div class="order-last">
            Kode barang :
            <div class="btn btn-sm btn-outline no-animation">{{ $pemutihanLangsung->kode_barang }}</div>

        </div>
        <h2 class="text-2xl font-bold">Form pemutihanLangsung</h2>
    </div>
    <br>
    <div class="form-control hidden">
        <label class="label">
        <span class="label-text">Kode Barang</span>
        <input type="text" name="kode_barang" class="input input-bordered "
        value="{{ old('nama', $pemutihanLangsung->kode_barang) }}"/>
    </div>
    <div class="form-control hidden">
        <label class="label">
        <span class="label-text">Kontak</span>
        </label>
        <input type="text" name="kaprog" class="input input-bordered"
        value="{{ $kode_baru }}"/>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Keterangan PemutihanLangsung</span>
        </label>
        <textarea name="ket_pemutihan" cols="20" rows="5" class="textarea textarea-bordered" placeholder="contoh : barang sudah tua" required></textarea>
    </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
