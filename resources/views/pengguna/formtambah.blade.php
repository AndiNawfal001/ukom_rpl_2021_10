@extends('layouts.main')
@section('container')
<div class="p-5">

<div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="simpan" method="POST">
 @csrf
    <h2 class="text-2xl font-bold">Form Tambah Pengguna</h2>
    <br>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Username</span>
        </label>
        <input type="text" name="username" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Level User</span>
        </label>
        <select class="select select-bordered w-full max-w-xs" name="levelUser" required>
            <option disabled selected>-- Pilih Level --</option>
            @foreach ($levelUser as $item)
                <option value="{{ $item->nama_level }} ">{{ $item->nama_level }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Email</span>
        </label>
        <input type="text" name="email" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Password</span>
        </label>
        <input type="text" name="password" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">NIP</span>
        </label>
        <input type="text" name="nip" class="input input-bordered" placeholder="Silahkan dikosongkan jika user admin"/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Nama</span>
        </label>
        <input type="text" name="nama" class="input input-bordered" required/>
    </div>
    <div class="form-control">
        <label class="label">
            <span class="label-text">Kontak</span>
        </label>
        <input type="text" name="kontak" class="input input-bordered" placeholder="ex = 0876-5432-1234" required/>
    </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
