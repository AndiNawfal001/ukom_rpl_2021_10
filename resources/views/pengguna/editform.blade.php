@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="editsimpan" method="POST">
        @csrf
        <h2 class="text-2xl font-bold">Form Edit Pengguna</h2>
        <input type="hidden"  name="kode" value="{{$edit->id_pengguna}}" />
        <br>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Username</span>
            </label>
            <input type="text" name="username" class="input input-bordered"
            value="{{ old('username', $edit->username) }}"/>
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" class="input input-bordered"
            value="{{ old('email', $edit->email) }}"/>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Nama</span>
            </label>
            <input type="text" name="nama" class="input input-bordered"
            value="{{ old('nama', $edit->nama) }}"/>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Kontak</span>
            </label>
            <input type="text" name="kontak" class="input input-bordered"
            value="{{ old('kontak', $edit->kontak) }}"/>
        </div>
            <div class="form-control mt-6">
            <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
    </div>

</div>
@endsection
