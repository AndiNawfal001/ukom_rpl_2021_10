@extends('layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5">
        <h1 class="h1-judul">Daftar Supplier</h1>
        <div class="lg:flex justify-between mb-2">
            <form action="/supplier" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="flex gap-2 items-center  ">
                            <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered"  value="{{ request("search") }}" autocomplete="off"/>
                            <button class="btn btn-sm btn-primary btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                        </div>
                    </div>
            </form>
            <a href="/supplier/tambah">
                <button class="btn btn-sm btn-success gap-2">
                    Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </a>
        </div>
        <div class="">
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table-primary ">
                    <thead class="bg-base-200">
                        <tr>
                            <x-table-header class="w-5">No</x-table-header>
                            <x-table-header>Nama Supplier</x-table-header>
                            <x-table-header>Kontak</x-table-header>
                            <x-table-header>Alamat</x-table-header>
                            <x-table-header>Kontrol</x-table-header>
                        </tr>
                    </thead>
                    @forelse($data as $key => $item)
                    <tr>
                        <td class="border-table text-center">{{ $data->firstItem() + $key }}.</td>
                        <td class="border-table">{{ $item->nama }}</td>
                        <td class="border-table">{{ $item->kontak }}</td>
                        <td class="border-table">{{ $item->alamat }}</td>
                        <td class="border-table text-center">
                            <a href="/supplier/edit/{{ $item->id_supplier }}">
                                <button class="btn btn-sm btn-warning btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                            </a>
                            <label for="delete{{ $item->id_supplier }}" class="btn btn-sm btn-error btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </label>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="text-center">
                                <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </table>
            </div>
            <br>
            <div class="lg:flex flex-row-reverse">
                <div>
                    {{ $data->links('vendor.pagination.daisyui') }}
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection

@section('modal')
{{-- HAPUS --}}
@foreach($data as $key)
<input type="checkbox" id="delete{{ $key->id_supplier }}" class="modal-toggle" />
<label for="delete{{ $key->id_supplier }}" class="modal cursor-pointer">
  <div class="modal-box border-t-2 border-error">
    <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
    </svg>
    <div class="text-center">
        <h3 class="font-bold text-2xl">Anda yakin ?</h3>
        <p class="py-4 text-md">Menghapus supplier <b>permanen</b> akan berpengaruh ke data yang lain</p>
    </div>
    <div class="flex justify-center gap-3">
        <label for="delete{{ $key->id_supplier }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
        <label class="btn btn-sm btn-error btn-outline">
            <a href="/supplier/hapus/{{$key->id_supplier}}">
                Delete
            </a>
        </label>
    </div>
  </div>
</label>
@endforeach

{{-- @php
    if($errors->has('nama')) {
        flash()->addError('Nama tersebut sudah digunakan!');
    }
    if($errors->has('kontak')) {
        flash()->addError('Kontak tersebut sudah digunakan!');
    }
@endphp --}}
@endsection
