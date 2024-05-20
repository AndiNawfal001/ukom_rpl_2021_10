@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-lg lg:text-xl pb-3 font-semibold leading-loose">Daftar Barang untuk perawatan</h1>
        <div class="">
            <div class="lg:flex justify-between mb-2">
                <form action="/perawatan" method="GET">
                    @csrf
                        <div class="form-control mb-2">
                            <div class="flex gap-2 items-center  ">
                            <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                            <button class="btn btn-sm btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                            </div>
                        </div>
                </form>
                <a href="/perawatan/pilihBarang">
                    <button type="submit" class="btn btn-sm btn-success gap-2" >
                        Tambah 
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                </a>
            </div>
            <div class="">
                <div class="overflow-x-auto overflow-y-auto">
                    <table class="table-primary ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Tanggal Perawatan</th>
                                <th>Nama Pelaksana</th>
                                <th>Kontrol</th>
                            </tr>
                        </thead>
                        @forelse($data as $key =>$item)
                        <tr>
                        <th>{{ $data->firstItem() + $key }}</th>
                        <th>
                            <div class="flex items-center space-x-3">
                                <div>
                                    <div class="font-bold text-lg">{{ $item->nama_barang }}</div>
                                    <div class="text-sm opacity-50">{{ $item->kode_barang }}</div>
                                </div>
                            </div>
                        </th>
                        <td>{{ $item->tgl_perawatan }}</td>
                        <td>{{ $item->nama_pelaksana }}</td>
                        <td>
                            <label for="detailperawatan{{ $item->id_perawatan }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <label for="delete{{ $item->id_perawatan }}" class="btn btn-sm btn-error btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </label>
                        </td>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center">
                                    <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                                </div>
                            </td>
                        </tr>
                        </tr>
                        @endforelse

                    </table>

                </div>
            </div>
            <br>
            <div class="lg:flex flex-row-reverse">
                <div >
                    {{ $data->links() }}
                </div>
            </div>
        </div>

    </div>
    <br>
</div>



@endsection




@section('modal')

{{-- DETAIL --}}
@foreach($data as $key)
<input type="checkbox" id="detailperawatan{{ $key->id_perawatan }}" class="modal-toggle" />
<label for="detailperawatan{{ $key->id_perawatan }}" class="modal cursor-pointer">
  <label class="modal-box relative" for="">
    <div >
        <p class="btn btn-sm btn-outline mb-3">{{ $key->kode_barang }}</p>
        <p class="text-2xl font-semibold">{{ $key->nama_barang }}</p>
        <div class="pb-3">
            <p class="text-md ">diajukan {{ $key->tgl_perawatan }}</p>
        </div>
        <div class="pb-3">
            <p class="font-light">Dari Ruangan <span class="font-medium">{{ $key->nama_ruangan }}</span> </p>
        </div>
        <div class="pb-3">
            <p class="font-light">Nama Pelaksana</p>
            <p class="font-medium ">{{ $key->nama_pelaksana }} </p>
        </div>
        <div class="pb-3">
            <p class="font-light">Keterangan Perawatan</p>
            <p class="font-medium ">{{ $key->ket_perawatan }}</p>
        </div>
        <div class="pt-5 flex flex-row-reverse gap-3">
                <label for="editperawatan{{$key->kode_barang}}" for="detailperawatan{{ $key->id_perawatan }}" class="btn btn-sm btn-outline btn-warning">
                    Edit
                </label>
        </div>
    </div>
  </label>
</label>
@endforeach


{{-- EDIT --}}
@foreach ( $data as  $key)
<input type="checkbox" id="editperawatan{{ $key->kode_barang }}" class="modal-toggle" />
<label for="editperawatan{{ $key->kode_barang }}" class="modal cursor-pointer">
  <label class="modal-box relative" for="">
    <form action="/perawatan/edit/editsimpan" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="text-2xl font-bold">Edit Perawatan</h2>
        <br>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Nama Pelaksana</span>
            </label>
            <input type="text" name="nama_pelaksana" class="input input-bordered"
            value="{{ old('nama_pelaksana', $key->nama_pelaksana) }}" required autocomplete="off" />
            <input type="hidden"  name="id_perawatan" value="{{$key->id_perawatan}}" />
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Keterangan Perawatan</span>
            </label>
            <textarea name="ket_perawatan" cols="20" rows="5" class="textarea textarea-bordered" " required>{{ old('ket_perawatan', $key->ket_perawatan) }}</textarea>
        </div>

            <div class="form-control mt-6">
            <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
  </label>
</label>
@endforeach


{{-- HAPUS --}}
@foreach($data as $key)
<input type="checkbox" id="delete{{ $key->id_perawatan }}" class="modal-toggle" />
<label for="delete{{ $key->id_perawatan }}" class="modal cursor-pointer">
  <div class="modal-box border-t-2 border-error">
    <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
    </svg>
    <div class="text-center">
        <h3 class="font-bold text-2xl">Anda yakin ?</h3>
        {{-- <p class="py-4 text-md">Menghapus pengguna <b>permanen</b> membuat pengguna tersebut tidak bisa lagi login</p> --}}
    </div>
    <div class="flex justify-center pt-4 gap-3">
        <label for="delete{{ $key->id_perawatan }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
        <label class="btn btn-sm btn-error btn-outline">
            <a href="/perawatan/hapus/{{$key->id_perawatan}}">
                Delete
            </a>
        </label>
    </div>
  </div>
</label>
@endforeach
@endsection
