@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="/supplier/simpan" method="POST">
        @csrf
           <div class="flex justify-between">
                <h2 class="text-2xl font-bold">Tambah Supplier</h2>
                <div >
                    <a href="/supplier" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                </div>
           </div>
           <br>
           <div class="form-control">
               <label class="label">
               <span class="label-text">Nama Supplier</span>
               </label>
               <input type="text" name="nama" class="input input-bordered @error('nama') input-error @enderror" value="{{ old('nama') }}" required/>
               @error('nama')
                <p class="text-red-500">{{ $message }}</p>
               @enderror
           </div>
           <div class="form-control">
               <label class="label">
               <span class="label-text">Kontak</span>
               </label>
               <input type="number" name="kontak" class="input input-bordered @error('kontak') input-error @enderror" value="{{ old('kontak') }}" required/>
               @error('kontak')
                <p class="text-red-500">{{ $message }}</p>
               @enderror
           </div>
           <div class="form-control">
               <label class="label">
                   <span class="label-text">Alamat</span>
               </label>
               <input type="text" name="alamat" class="input input-bordered" value="{{ old('alamat') }}"  required/>
           </div>
               <div class="form-control mt-6">
                 <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
               </div>
           </form>
    </div>

</div>
@endsection
