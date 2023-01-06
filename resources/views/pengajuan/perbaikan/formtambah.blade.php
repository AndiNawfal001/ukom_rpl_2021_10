@extends('layouts.main')
@section('container')
<div class="p-5">

 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="simpan" method="POST">
 @csrf
    <h2 class="text-2xl font-bold">Form Tambah Pengajuan Perbaikan</h2>
    <br>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Manajemen</span>
                </label>
                <select class="select select-bordered w-full max-w-xs" name="manajemen" required>
                    <option disabled selected>-- Pilih Manajemen --</option>
                    @foreach ($manajemen as $item)
                        <option value="{{ $item->nama }} ">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-control">
                <label class="label">
                    <span class="label-text">Kaprog</span>
                </label>
                <select class="select select-bordered w-full max-w-xs" name="kaprog" required>
                    <option disabled selected>-- Pilih Nama Anda(Kaprog) --</option>
                    @foreach ($kaprog as $item)
                        <option value="{{ $item->nama }} ">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Untuk Ruangan..</span>
                </label>
                <input type="text" name="ruangan" class="input input-bordered" value="value="{{ $kode_baru }}" required/>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Pilih Barang</span>
                </label>
                <select class="select select-bordered w-full max-w-xs" name="nama_barang" required>
                    <option disabled selected>-- Pilih Barang --</option>
                    @foreach ($barang as $item)
                        <option value="{{ $item->nama_barang }} ">{{ $item->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Untuk Ruangan..</span>
                </label>
                <input type="text" name="ruangan" class="input input-bordered" required/>
            </div>
        <div class="form-control mt-6">
          <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>

</div>
@endsection
