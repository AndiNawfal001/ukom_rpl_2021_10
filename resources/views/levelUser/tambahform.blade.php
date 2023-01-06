@extends('layouts.main')
@section('container')
<div class="p-5">
 
 <div class="card mx-auto max-w-md shadow-2xl bg-base-100">
 <form method="POST" action="simpan">
 @csrf
      <div class="card-body">
      <h2 class="card-title text-2xl font-bold ">Form Tambah data Level User</h2>
      <div class="form-control">
          <label class="label">
            <span class="label-text">Id level user</span>
          </label>
          <input type="text" name="id_level" class="input input-bordered" />
        </div> 
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nama level user</span>
          </label>
          <input type="text" name="nama_level" class="input input-bordered" />
        </div> 
        <div class="form-control">
          <label class="label">
            <span class="label-text">Keterangan</span>
          </label>
          <textarea name="ket" cols="20" rows="5" class="textarea textarea-bordered"></textarea>
        </div>
        <div class="form-control mt-6">
          <button type="submit" value="Simpan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
    </div>

</div>
@endsection