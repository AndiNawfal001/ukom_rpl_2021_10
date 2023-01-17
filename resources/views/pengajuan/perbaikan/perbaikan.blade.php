@extends('layouts.main')
@section('container')
<div class="p-5">
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
    <form action="simpanperbaikan" method="POST">
        @csrf
        <div class="flex justify-between">
            <div class="order-last">
                Kode barang :
                <div class="btn btn-sm btn-outline no-animation">{{ $perbaikan->kode_barang }}</div>

            </div>
            <h2 class="text-2xl font-bold">Form Perbaikan</h2>
        </div>
        <br>
        <div class="form-control hidden">
            <label class="label">
            <span class="label-text">Kode Barang</span>
            </label>
            <input type="text" name="kode_barang" class="input input-bordered "
            value="{{ old('nama', $perbaikan->kode_barang) }}"/>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Dari Ruangan..</span>
            </label>
            <input type="text" name="ruangan" class="input input-bordered" required/>
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Keluhan</span>
            </label>
            <textarea name="keluhan" cols="20" rows="5" class="textarea textarea-bordered" " required></textarea>
        </div>
            <div class="form-control mt-6">
            <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
    </div>

</div>
@endsection
