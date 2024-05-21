@extends('layouts.main')
@section('container')
<div class="p-5">
    <!--<div class="alert alert-info rounded-md mb-4 shadow-lg">
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span>Bila Supplier atau Jenis Barang yang dimaksud tidak ada, silahkan isi terlebih dahulu</span>
        </div>
    </div>-->
 <div class="shadow-md rounded-md mx-auto  bg-base-100 p-5">
 <form action="simpan" method="POST"  enctype="multipart/form-data">
 @csrf
    <div class="flex justify-between">
        <div>
            <h2 class="h1-judul">Form Tambah Barang</h2>
            <p class="badge badge-lg badge-outline badge-info my-2">{{ $tambah->nama_barang }}</p>
        </div>
        <div>
            <a href="/barangMasuk" class="btn btn-sm btn-square">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </a>
        </div>
    </div>
    <br>
      <div class="lg:flex flex-row gap-5">
            <div class="basis-1/2">
                <div class="form-control hidden">
                    <label class="label">
                    <span class="label-text">Nama Barang</span>
                    </label>
                    <input type="text" name="nama_barang" class="input input-sm input-bordered"
                    value="{{ $tambah->nama_barang }}" required/>
                    @error('nama_barang')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Jumlah Barang</span>
                    </label>
                    <input type="number" value="{{ $max_input }}" min="1" max="{{ $max_input }}" name="jml_barang" class="input input-sm input-bordered" required/>
                </div>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Spesifikasi</span>
                    </label>
                    <textarea name="spesifikasi" cols="20" rows="5" class="textarea textarea-bordered" required>{{ $tambah->spesifikasi }}</textarea>
                </div>
            </div>

            <div class="basis-1/2">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Supplier</span>
                    </label>
                    <select class="select select-sm select-bordered w-full max-w-xs" id="supplier" name="supplier" required>
                        <option disabled selected>-- Pilih Supplier --</option>
                        @foreach ($supplier as $item)
                            <option value="{{ $item->id_supplier }}" {{ old('supplier') == $item->id_supplier ? 'selected' : null}}>{{ $item->nama }}</option>
                        @endforeach
                        @error('supplier')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </select>
                </div>

                <div class="form-control hidden">
                    <label class="label">
                    <span class="label-text">Nama Manejemen</span>
                    </label>
                    <input type="text" name="adder" class="input input-sm input-bordered" value="{{ $adder }}" required/>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Jenis Barang</span>
                    </label>
                    <select class="select select-sm select-bordered w-full max-w-xs" name="jenis_barang" required>
                        <option disabled selected>-- Pilih Jenis Barang --</option>
                        @foreach ($jenisBarang as $item)
                            <option value="{{ $item->id_jenis_brg }}" {{ old('jenis_barang') == $item->id_jenis_brg ? 'selected' : null}}>{{ $item->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Foto Barang</span>
                    </label>
                    <input type="file" name="image" id="image" class="file-input file-input-sm file-input-bordered w-full max-w-xs" onchange="previewImage()" required/>
                    @error('image')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <br>
                    <img src="" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
                    <input type="hidden" name="ruangan" class="input input-sm input-bordered" value="{{ $tambah->ruangan }}" required/>
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
