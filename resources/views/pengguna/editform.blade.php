@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="editsimpan" method="POST">
        @csrf
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold">Form Edit Pengguna</h2>
            <div >
                <a href="/pengguna" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <input type="hidden"  name="kode" value="{{$edit->id_pengguna}}" />
        <br>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Username</span>
            </label>
            <input type="text" name="username" class="input input-bordered"
            value="{{ old('username', $edit->username) }}" required/>
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" class="input input-bordered"
            value="{{ old('email', $edit->email) }}" required/>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Nama</span>
            </label>
            <input type="text" name="nama" class="input input-bordered"
            value="{{ old('nama', $edit->nama) }}" required/>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Kontak</span>
            </label>
            <input type="text" name="kontak" class="input input-bordered"
            value="{{ old('kontak', $edit->kontak) }}" required/>
        </div>
            <div class="form-control mt-6">
            <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
    </div>

</div>
@endsection
