@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="simpan" method="POST">
 @csrf
    <h2 class="text-2xl font-bold">Form Tambah Supplier</h2>
    <br>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Nama Supplier</span>
        </label>
        <input type="text" name="nama" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Kontak</span>
        </label>
        <input type="number" name="kontak" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Alamat</span>
        </label>
        <input type="text" name="alamat" class="input input-bordered" required/>
    </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
