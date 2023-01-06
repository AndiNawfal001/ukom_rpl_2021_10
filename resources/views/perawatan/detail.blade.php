@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold leading-loose">Detail </h1>
            <div>hehe</div>
        </div>
        <div class="">
            <div class="p-5 lg:p-0 lg:w-3/4 mx-auto">
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Kode Barang</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->kode_barang }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Nama Pelaksana</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->nama_pelaksana }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Keterangan Perawatan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->ket_perawatan }}</span>
                </div>
                <div class="bg-primary-content flex flex-wrap border">
                    <div class="p-3 basis-4/4 w-full md:basis-1/4 md:text-right bg-base-200 font-semibold">Gambar Pelaksanaan</div>
                    <div class="p-3 basis-4/4 w-full md:basis-3/4 bg-base-100 grid place-content-center md:place-content-start">
                        <a href="{{ asset('storage/'.$detail->foto_perawatan) }}" target="_blank" class="group">
                            <img src="{{ asset('storage/'.$detail->foto_perawatan) }}" class="w-52 shadow  group-hover:brightness-50 ">
                    </div>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Tanggal Perawatan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->tgl_perawatan }}</span>
                </div>
            </div>
        </div>

        <a href="/perawatan/edit/{{$detail->id_perawatan}}">
            {{-- EDIT --}}
            <button class="btn btn-sm btn-warning btn-square btn-outline">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
        </a>
    </div>
    <br>
</div>
@endsection
