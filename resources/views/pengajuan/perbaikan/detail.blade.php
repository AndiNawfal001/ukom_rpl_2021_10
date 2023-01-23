@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
            <div class="flex justify-between">
                <h1 class="text-xl font-semibold leading-loose">Detail </h1>
                <div>
                    <a href="/pengajuan/PB" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                </div>
            </div>
        <div class="lg:flex gap-10">
            <div class="basis-1/2 mb-5 lg:mb-0">
                <div class=" border-2 border-base-300 rounded-md p-3 bg-base-200">
                    <a href="{{ asset('storage/'.$detail->gambar_pelaksanaan) }}" target="_blank" class="group">
                        <img src="{{ asset('storage/'.$detail->gambar_pelaksanaan) }}" class="mx-auto shadow  group-hover:brightness-50 ">
                    </a>
                </div>
            </div>
            <div class="basis-1/2">
                <p class="btn btn-sm btn-outline mb-3">{{ $detail->asli }}</p>
                <p class="text-2xl font-semibold">{{ $detail->nama_barang }}</p>
                <div class="lg:flex gap-5">
                    <p class="text-md lg:border-r-2 lg:pr-5">diajukan {{ $detail->tgl_perbaikan }}</p>
                    <p class="text-md font-medium">Selesai diperbaiki pada {{ $detail->tgl_selesai_perbaikan }}</p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Dari Ruangan <span class="font-medium">{{ $detail->ruangan }}</span> </p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Keluhan</p>
                    <p class="font-medium ">{{ $detail->keluhan }} </p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Nama Teknisi</p>
                    <p class="font-medium ">{{ $detail->nama_teknisi }} </p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Penyebab Keluhan</p>
                    <p class="font-medium ">{{ $detail->penyebab_keluhan }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit perspiciatis consequuntur unde neque eaque laboriosam, corporis labore at inventore debitis, fuga autem dolor ut illum tempore iusto dignissimos corrupti doloremque!</p>
                </div>
                <div class="flex ">
                    <div class="badge badge-lg badge-outline
                        {{ ($detail->status_perbaikan === 'bisa diperbaiki') ? 'badge-success' : '' }}
                        {{ ($detail->status_perbaikan === 'tidak bisa diperbaiki') ? 'badge-error' : '' }}
                        ">{{ $detail->status_perbaikan}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection
