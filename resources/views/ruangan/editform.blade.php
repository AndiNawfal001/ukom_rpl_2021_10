@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="/ruangan/editsimpan" method="POST">
        @csrf
           <div class="flex justify-between">
            <h2 class="text-2xl font-bold">Edit Ruangan</h2>
            <div class="modal-action fixed right-10 top-5">
                    <a href="/ruangan" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                </div>
           </div>
           <br>
        <input type="hidden" name="id_ruangan" class="input input-bordered"  value="{{ $edit->id_ruangan }}" required/>

           <div class="form-control">
               <label class="label">
               <span class="label-text">Nama Supplier</span>
               </label>
               <input type="text" name="nama_ruangan" class="input input-bordered"
               value="{{ old('nama', $edit->nama_ruangan) }}"/>
               <input type="hidden"  name="id_ruangan" value="{{$edit->id_ruangan}}" />
               @error('nama_ruangan')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
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
               <div class="form-control mt-6">
                 <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
               </div>
           </form>
    </div>

</div>
@endsection
