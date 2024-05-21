@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="/ruangan/simpan" method="POST">
 @csrf
    <div class="flex justify-between">
        <h1 class="h1-judul">Form Tambah Ruangan</h1>
        <div >
            <a href="/ruangan" class="btn btn-sm btn-square">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </a>
        </div>
    </div> 
    <div class="form-control">
        <label class="label">
        <span class="label-text">Nama Ruangan</span>
        </label>
        <input type="text" name="nama_ruangan" class="input input-sm input-bordered @error('nama_ruangan') input-error @enderror" value="{{ old('nama_ruangan') }}" required autocomplete="off"/>
        @error('nama_ruangan')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Penanggung jawab</span>
        </label>
        <input type="text" name="penanggung_jawab" class="input input-sm input-bordered"  value="{{ old('penanggung_jawab') }}" required autocomplete="off"/>
    </div>
    <div class="form-control">
        <label class="label">
        <span class="label-text">Keterangan</span>
        </label>
        <textarea name="ket" cols="20" rows="5" class="textarea textarea-bordered" required>{{ old('ket') }}</textarea>
    </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
