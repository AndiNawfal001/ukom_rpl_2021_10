@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <div class="">
            <div class="flex justify-between">
                <form action="/barang/detail/{{ $id_barang }}" method="GET">
                    @csrf
                        <div class="form-control mb-2">
                            <div class="input-group ">
                            <input type="text" name="search" placeholder="Search…" class="input input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                            <button class="btn btn-square" type="submit">
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
                    <table class="table table-zebra w-full ">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th> Barang</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php $no=1;?>
                        @forelse($data as $key)
                        <tr>
                        {{-- <th>{{ $no++ }}</th> --}}
                        <th>
                            <div class="flex items-center space-x-3">
                                <div>
                                    <div class="font-bold text-lg">{{ $key->nama_barang }}</div>
                                    <div class="text-sm opacity-50">{{ $key->kode_barang }}</div>
                                </div>
                            </div>
                        </th>
                        <td>
                            <p class="badge badge-outline
                            {{ ($key->kondisi_barang === 'baik') ? 'badge-info' : '' }}
                            {{ ($key->kondisi_barang === 'rusak') ? 'badge-warning' : '' }}
                            ">{{ $key->kondisi_barang }}</p>
                        </td>
                        <td>
                            <p class="badge badge-outline
                            {{ ($key->status === 'aktif') ? 'badge-success' : '' }}
                            {{ ($key->status === 'nonaktif') ? 'badge-error' : '' }}
                            ">{{ $key->status }}</p>
                        </td>
                        <td>
                            <a href="/barang/detail/spesifik/{{$key->kode_barang}}">
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
                                    <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z" /></svg>
                                    <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
                                </div>
                            </td>
                        </tr>
                        </tr>
                        @endforelse

                    </table>

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
