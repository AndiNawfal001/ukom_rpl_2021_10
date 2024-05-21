@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="/pengajuan/BB/simpan" method="POST">
        @csrf
        <div class="flex justify-between">
            <h2 class="h1-judul">Tambah Pengajuan</h2>
            <div class="">
                <a href="/pengajuan/BB" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div> 
        <div class="lg:flex flex-row gap-5">
            <div class="basis-1/2">
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Nama Barang</span>
                    </label>
                    <input type="text" name="nama_barang" class="input input-sm input-bordered @error('nama_barang') input-error @enderror" value="{{ old('nama_barang') }}" required autocomplete="off"/>
                    @error('nama_barang')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Spesifikasi</span>
                    </label>
                    <textarea name="spesifikasi" cols="20" rows="5" class="textarea textarea-bordered" " required>{{ old('spesifikasi') }}</textarea>
                </div>
            </div>

            <div class="basis-1/2">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Harga Satuan</span>
                    </label>
                    <input type="number" name="harga_satuan" class="input input-sm input-bordered" min="1000" value="{{ old('harga_satuan') }}" required autocomplete="off"/>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Jumlah Barang</span>
                    </label>
                    <input type="number" name="jumlah" class="input input-sm input-bordered" min="1" value="{{ old('jumlah') }}" required autocomplete="off"/>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Untuk Ruangan</span>
                    </label>
                    <select class="select select-sm select-bordered w-full max-w-xs" name="ruangan" required>
                        <option disabled selected>-- Pilih Ruangan --</option>
                        @foreach ($ruangan as $item)
                            <option value="{{ $item->id_ruangan }}" {{ old('ruangan') == $item->id_ruangan ? 'selected' : null}}>{{ $item->nama_ruangan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


            <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
    </div>

</div>
@endsection
