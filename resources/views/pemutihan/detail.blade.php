@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl font-semibold leading-loose">Detail </h1>
        <div class="rounded-lg">
            <div class="p-5 lg:p-0 lg:w-3/4 mx-auto">
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Kode Barang</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->kode_barang }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Tanggal Pemutihan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->tgl_pemutihan }}</span>
                </div>
                <div class="bg-primary-content flex border">
                    <span class="p-3 basis-1/2 md:basis-1/4 text-right bg-base-200 font-semibold">Keterangan Pemutihan</span>
                    <span class="p-3 basis-1/2 md:basis-3/4 bg-base-100">{{ $detail->ket_pemutihan }}</span>
                </div
                @can('manajemen')
                    @if($detail->approve_penonaktifan == "pending")
                    <br>
                        <div class="py-5 flex flex-reverse gap-3">
                            <a href="/pemutihan/setuju/{{$detail->id_pemutihan}}/{{ $detail->kode_barang }}"><button class="btn btn-sm btn-outline btn-success">Setuju</button></a>
                            <a href="/pemutihan/tidaksetuju/{{$detail->id_pemutihan}}"><button class="btn btn-sm btn-outline btn-error">Tidak Setuju</button></a>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>
</div>

@endsection
