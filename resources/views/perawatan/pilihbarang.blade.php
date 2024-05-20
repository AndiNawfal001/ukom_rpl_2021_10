@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="alert alert-info shadow-lg mb-4 rounded-md ">
        <div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>Pastikan dulu barangnya sudah ada</span>
        </div>
    </div>
    <div class="bg-base-100 static shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <div class="flex justify-between">
            <h1 class="text-xl pb-3 font-semibold leading-loose">Pilih Barang untuk dirawat</h1>
            <div class="">
                <a href="/perawatan" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <form action="/perawatan/pilihBarang" method="GET">
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
        <div class="">
            <div>
                <div >
                    <div class="overflow-x-auto overflow-y-auto">
                        <table class="table table-zebra w-full ">
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
                                        <div class="font-bold text-lg">{{ $item->nama_barang }}</div>
                                        <div class="text-sm opacity-50">{{ $item->kode_barang }}</div>
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
                                {{ ($item->status === 'nonaktif') ? 'badge-error' : '' }}
                                {{ ($item->status === 'aktif') ? 'badge-success' : '' }}
                                ">{{ $item->status }}</p>
                            </td>
                            <td>
                                  <div class="tooltip tooltip-warning" data-tip="lakukan perawatan">
                                    <label for="tambahperawatan{{ $item->kode_barang }}" class="btn btn-sm btn-warning btn-square btn-outline">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path></svg>
                                      </label>
                                  </div>
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

                    </div>
                    <br>
                    <div class="lg:flex flex-row-reverse">
                        <div class="mt-4">
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


@section('modal')
@foreach($data as $key)
<input type="checkbox" id="tambahperawatan{{ $key->kode_barang }}" class="modal-toggle" />
<label for="tambahperawatan{{ $key->kode_barang }}" class="modal cursor-pointer">
  <label class="modal-box relative" for="">
    <form action="/perawatan/simpanperawatan" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="lg:flex justify-between">
            <h2 class="text-2xl font-bold">Form perawatan</h2>
            <div class="my-2 lg:my-0">
                Kode barang :
                <div class="btn btn-sm btn-outline no-animation">{{ $key->kode_barang }}</div>
            </div>
        </div>
        <div class="form-control hidden">
            <label class="label">
            <span class="label-text">Kode Barang</span>
            </label>
            <input type="text" name="kode_barang" class="input input-bordered "
            value="{{ old('nama', $key->kode_barang) }}"/>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Nama Pelaksana</span>
            </label>
            <input type="text" name="nama_pelaksana" class="input input-bordered" required autocomplete="off"/>
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Keterangan Perawatan</span>
            </label>
            <textarea name="ket_perawatan" cols="20" rows="5" class="textarea textarea-bordered" " required></textarea>
        </div>
            <div class="form-control mt-6">
            <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
  </label>
</label>
@endforeach
@endsection
