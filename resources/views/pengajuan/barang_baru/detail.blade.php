@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl font-semibold leading-loose">Detail </h1>
        <div class="">
            <div class="p-5 lg:p-0 lg:w-3/4 mx-auto">
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Nama Barang</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->nama_barang }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Harga Satuan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">Rp. {{ $detail->harga_satuan }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Total Harga</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">Rp. {{ $detail->total_harga }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Jumlah Barang</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->jumlah }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Tanggal Pengajuan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->tgl }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Spesifikasi</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->spesifikasi }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Untuk Ruangan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->ruangan }}</span>
                </div>
                @if($detail->status_approval == "pending")
                    <div class="py-5 flex flex-row-reverse gap-3">
                        <a href="/BB/tidaksetuju/{{$detail->id_pengajuan_bb}}"><button class="btn btn-sm btn-outline btn-error">Tidak Setuju</button></a>
                        <a href="/BB/setuju/{{$detail->id_pengajuan_bb}}"><button class="btn btn-sm btn-outline btn-success">Setuju</button></a>
                    </div>
                @else

                @endif
            </div>
        </div>
    </div>
    <br>
</div>

@endsection
