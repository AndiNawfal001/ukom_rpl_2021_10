@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl font-semibold leading-loose">Detail </h1>
        <div class="">
            <div class="p-5 lg:p-0 lg:w-3/4 mx-auto">
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Nama Barang</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->kode_barang }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Tanggal Perbaikan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->tgl_perbaikan }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Keluhan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->keluhan }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Dari Ruangan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->ruangan }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Tanggal Perbaikan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->tgl_perbaikan }}</span>
                </div>

                <br><hr class="border"><br>

                    <div class="bg-primary-content flex border">
                        <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Nama Teknisi</span>
                        <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->nama_teknisi }}</span>
                    </div>
                    <div class="bg-primary-content flex border">
                        <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Penyebab Keluhan</span>
                        <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->penyebab_keluhan }}</span>
                    </div>
                    <div class="bg-primary-content flex flex-wrap border">
                        <div class="p-3 basis-4/4 w-full md:basis-1/4 md:text-right bg-base-200 font-semibold">Gambar Pelaksanaan</div>
                        <div class="p-3 basis-4/4 w-full md:basis-3/4 bg-base-100 grid place-content-center md:place-content-start">
                            <a href="{{ asset('storage/'.$detail->gambar_pelaksanaan) }}" target="_blank" class="group">
                                <img src="{{ asset('storage/'.$detail->gambar_pelaksanaan) }}" class="w-52 shadow  group-hover:brightness-50 ">
                        </div>
                    </div>
                    <div class="bg-primary-content flex border">
                        <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Tanggal Selesai Perbaikan</span>
                        <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->tgl_selesai_perbaikan }}</span>
                    </div>
                    <div class="bg-primary-content flex border">
                        <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Status Perbaikan</span>
                        <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100
                        {{ ($detail->status_perbaikan === 'tidak bisa diperbaiki') ? 'text-red-500' : '' }}
                        {{ ($detail->status_perbaikan === 'bisa diperbaiki') ? 'text-green-500' : '' }}">
                            {{ $detail->status_perbaikan }}
                        </span>
                    </div>
                @can('manajemen')
                    @if($detail->approve_perbaikan == "pending")
                        <div class="py-5 flex flex-reverse gap-3">
                            <a href="/PB/setuju/{{$detail->id_perbaikan}}"><button class="btn btn-sm btn-outline btn-success">Sudah Diperbaiki</button></a>
                            <a href="/PB/tidaksetuju/{{$detail->id_perbaikan}}/{{ $detail->kode_barang }}"><button class="btn btn-sm btn-outline btn-error">Rusak</button></a>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>
    <br>
</div>
@endsection
