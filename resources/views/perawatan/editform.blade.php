@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="editsimpan" method="POST" enctype="multipart/form-data">
 @csrf
    <h2 class="text-2xl font-bold">Form Edit Barang</h2>
    <br>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Nama Pelaksana</span>
        </label>
        <input type="text" name="nama_pelaksana" class="input input-bordered"
        value="{{ old('nama', $edit->nama_pelaksana) }}"/>
        <input type="hidden"  name="id_perawatan" value="{{$edit->id_perawatan}}" />
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">ket_perawatan</span>
        </label>
        <input type="text" name="ket_perawatan" class="input input-bordered"
        value="{{ old('ket_perawatan', $edit->ket_perawatan) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Foto Perawatan</span>
        </label>

        <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage()" required/>
        <br>
        <input type="hidden" name="oldImage" value="{{ $edit->foto_perawatan }}">

        @if($edit->foto_perawatan)
            <img src="{{ asset('storage/'.$edit->foto_perawatan) }}" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
        @else
        <img class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">

        @endif
    </div>

        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
