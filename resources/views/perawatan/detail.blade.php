@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
            <div class="flex justify-between">
                <h1 class="text-xl font-semibold leading-loose">Detail </h1>
                <div>
                    <a href="/perawatan" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                </div>
            </div>
        <div class="lg:flex gap-10">
            <div class="basis-1/2 mb-5 lg:mb-0">
                <div class=" border-2 border-base-300 rounded-md p-3 bg-base-200">
                    <a href="{{ asset('storage/'.$detail->foto_perawatan) }}" target="_blank" class="group">
                        <img src="{{ asset('storage/'.$detail->foto_perawatan) }}" class="mx-auto shadow  group-hover:brightness-50 ">
                    </a>
                </div>
            </div>
            <div class="basis-1/2">
                <p class="btn btn-sm btn-outline mb-3">{{ $detail->kode_barang }}</p>
                <p class="text-2xl font-semibold">{{ $detail->nama_barang }}</p>
                <div class="pb-3">
                    <p class="text-md ">diajukan {{ $detail->tgl_perawatan }}</p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Dari Ruangan <span class="font-medium">{{ $detail->nama_ruangan }}</span> </p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Nama Pelaksana</p>
                    <p class="font-medium ">{{ $detail->nama_pelaksana }} </p>
                </div>
                <div class="pb-3">
                    <p class="font-light">Keterangan Perawatan</p>
                    <p class="font-medium ">{{ $detail->ket_perawatan }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit perspiciatis consequuntur unde neque eaque laboriosam, corporis labore at inventore debitis, fuga autem dolor ut illum tempore iusto dignissimos corrupti doloremque!</p>
                </div>
                <div class="py-5 flex flex-row-reverse gap-3">
                    <label for="editperawatan{{$detail->kode_barang}}" class="btn btn-sm btn-outline btn-warning">
                        Edit
                    </label>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection

@section('modal')


{{-- @foreach($detail as $key) --}}
    <input type="checkbox" id="editperawatan{{ $detail->kode_barang }}" class="modal-toggle" />
    <label for="editperawatan{{ $detail->kode_barang }}" class="modal cursor-pointer">
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
                value="{{ old('nama_pelaksana', $detail->nama_pelaksana) }}" required/>
                <input type="hidden"  name="id_perawatan" value="{{$detail->id_perawatan}}" />
            </div>
            <div class="form-control">
                <label class="label">
                <span class="label-text">Keterangan Perawatan</span>
                </label>
                <input type="text" name="ket_perawatan" class="input input-bordered"
                value="{{ old('ket_perawatan', $detail->ket_perawatan) }}" required/>
                {{-- <input type="hidden"  name="id_barang" value="{{$detail->id_barang}}" /> --}}
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Gambar</span>
                </label>

                <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage()"/>
                <br>
                <input type="hidden" name="oldImage" value="{{ $detail->foto_perawatan }}">

                @if($detail->foto_perawatan)
                    <img src="{{ asset('storage/'.$detail->foto_perawatan) }}" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
                @else
                <img class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">

                @endif
            </div>

                <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </label>
    </label>

{{-- @endforeach --}}
@endsection
