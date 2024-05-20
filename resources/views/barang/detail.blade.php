@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <div class="">
            <div class="flex justify-between">
                <form action="/barang/detail/{{ $id_barang }}" method="GET">
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
                <div>
                    <a href="/barang" class="btn btn-sm btn-square">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                </div>
            </div>
            <div class=" gap-5">
                <div class="overflow-x-auto overflow-y-auto ">
                    <table class="table-primary ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>Kontrol</th>
                            </tr>
                        </thead>
                        @forelse($data as $key => $item)
                        <tr>
                        <th>{{ $data->firstItem() + $key }}</th>
                        <th>
                            <div class="flex items-center space-x-3">
                                <div>
                                    <div class="font-bold  ">{{ $item->nama_barang }}</div>
                                    <div class="text-xs opacity-50">{{ $item->kode_barang }}</div>
                                </div>
                            </div>
                        </th>
                        <td>
                            <p class=" badge badge-outline w-20
                            {{ ($item->kondisi_barang === 'baik') ? 'badge-info' : '' }}
                            {{ ($item->kondisi_barang === 'rusak') ? 'badge-warning' : '' }}
                            ">{{ $item->kondisi_barang }}</p>
                        </td>
                        <td>
                            <p class=" badge badge-outline w-20
                            {{ ($item->status === 'aktif') ? 'badge-success' : '' }}
                            {{ ($item->status === 'nonaktif') ? 'badge-error' : '' }}
                            ">{{ $item->status }}</p>
                        </td>
                        <td>
                            <a href="/barang/detail/spesifik/{{$item->kode_barang}}">
                                <button class="btn btn-sm btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </a>
                            {{-- <label for="editdetailbarang{{$key->kode_barang}}" class="btn btn-sm btn-warning btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </label> --}}
                        </td>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="text-center">
                                    <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                                </div>
                            </td>
                        </tr>
                        </tr>
                        @endforelse

                    </table>
                    <br>
                    <div class="flex flex-row-reverse my-4">
                        <div class="bg-base-100 text-content">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br>
</div>

@endsection

{{-- @section('modal')


@foreach($data as $key)
    <input type="checkbox" id="editdetailbarang{{ $key->kode_barang }}" class="modal-toggle" />
    <label for="editdetailbarang{{ $key->kode_barang }}" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <form action="/barang/detail/update/{{ $key->kode_barang }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-bold">Edit Detail Barang</h2>
            <br>
            <div class="form-control">
                <label class="label">
                <span class="label-text">Spesifikasi</span>
                </label>
                <input type="text" name="spesifikasi" class="input input-bordered"
                value="{{ old('spesifikasi', $key->spesifikasi) }}"/>
                <input type="hidden"  name="kode_barang" value="{{$key->kode_barang}}" />
                <input type="hidden"  name="id_barang" value="{{$key->id_barang}}" />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Gambar</span>
                </label>

                <input type="file" name="image" id="image" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage()"/>
                <br>
                <input type="hidden" name="oldImage" value="{{ $key->foto_barang }}">

                @if($key->foto_barang)
                    <img src="{{ asset('storage/'.$key->foto_barang) }}" class="img-preview object-scale-down w-1/2 md:w-1/4" alt="">
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

@endforeach
@endsection --}}
