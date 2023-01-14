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
        <span class="label-text">Nama Supplier</span>
        </label>
        <input type="text" name="nama_ruangan" class="input input-bordered"
        value="{{ old('nama', $edit->nama_ruangan) }}"/>
        <input type="hidden"  name="id_ruangan" value="{{$edit->id_ruangan}}" />
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">penanggung_jawab</span>
        </label>
        <input type="text" name="penanggung_jawab" class="input input-bordered"
        value="{{ old('penanggung_jawab', $edit->penanggung_jawab) }}"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">ket</span>
        </label>
        <input type="text" name="ket" class="input input-bordered"
        value="{{ old('ket', $edit->ket) }}"/>
    </div>
    {{-- <div class="form-control">
        <label class="label">
            <span class="label-text">Gambar</span>
        </label>

        <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage()" required/>
        <br>
        <input type="hidden" name="oldImage" value="{{ $edit->image }}">

        @if($edit->image)
            <img src="{{ asset('storage/'.$edit->image) }}" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
        @else
        <img class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">

        @endif
    </div> --}}

        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
