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
        <input type="hidden"  name="id_pengajuan_bb" value="{{$edit->id_pengajuan_pb}}" />
    </div>
    
    <div class="form-control">
        <label class="label">
        <span class="label-text">Dari ruangan..</span>
        </label>
        <input type="text" name="ruangan" class="input input-bordered"
        value="{{ old('ruangan', $edit->ruangan) }}"/>
    </div>
 
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
