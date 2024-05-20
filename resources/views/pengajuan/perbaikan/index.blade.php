@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Pengajuan Perbaikan Barang</h1>
        <div class="lg:flex justify-between mb-2">
            <form action="/pengajuan/PB" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="flex gap-2 items-center  ">
                            <input type="text" name="search" placeholder="Search Kode Barang…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                            <button class="btn btn-sm btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                        </div>
                    </div>
            </form>
            <div class="">
                <a href="/pengajuan/PB/pilihBarang"><button type="submit" class="btn btn-sm btn-success gap-2">Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></button></a>
            </div>
        </div>
        <div class="">
            <div class="">
                <div class="overflow-x-auto overflow-y-auto">

                    <table class="table-primary">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Tgl Perbaikan</th>
                                <th>Selesai Perbaikan</th>
                                <th>Approval perbaikan</th>
                                <th>Kontrol</th>
                            </tr>
                        </thead>
                        <?php $no=1;?>
                        @forelse($data as $key)
                        <tr>
                            <th>
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <div class="font-bold text-lg">{{ $key->nama_barang }}</div>
                                        <div class="text-sm opacity-50">{{ $key->kode_barang }}</div>
                                    </div>
                                </div>
                            </th>
                            <td>{{ $key->tgl_perbaikan }}</td>
                            <td>
                                @if($key->tgl_selesai_perbaikan == NULL)
                                    <div class="badge badge-warning badge-outline">belum selesai</div>
                                @else
                                    <div class="badge badge-success badge-outline">sudah selesai</div>
                                @endif
                            </td>
                            <td>
                                <p class=" badge badge-outline w-20
                                {{ ($key->approve_perbaikan === 'sudah diperbaiki') ? 'badge-success' : '' }}
                                {{ ($key->approve_perbaikan === 'pending') ? 'badge-warning' : '' }}
                                {{ ($key->approve_perbaikan === 'rusak') ? 'badge-error' : '' }}
                                ">{{ $key->approve_perbaikan }}</p>
                            </td>
                            <td>
                                @if($key->tgl_selesai_perbaikan == NULL)
                                    <label for="selesaiperbaikan{{$key->id_perbaikan}}" class="btn btn-sm btn-success btn-square btn-outline">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </label>
                                @else
                                <label for="detail{{ $key->id_perbaikan }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </label>
                                @endif
                                @if($key->nama_teknisi == NULL)
                                <label for="delete{{ $key->id_perbaikan }}" class="btn btn-sm btn-error btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </label>
                                @endif
                            </td>

                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="text-center">
                                        <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                        <p class="font-semibold text-base-content text-2xl opacity-50">Data Kosong</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </table>

                </div>

            </div>
        </div>

    </div>
    <br>
</div>


@endsection


@section('modal')
{{-- DETAIL --}}
@foreach($data as $key)
    <input type="checkbox" id="detail{{ $key->id_perbaikan }}" class="modal-toggle" />
    <label for="detail{{ $key->id_perbaikan }}" class="modal cursor-pointer">
    <div class="modal-box">
        <div>
            <p class="btn btn-sm btn-outline mb-3">{{ $key->kode_barang }}</p>
            <p class="text-2xl font-semibold">{{ $key->nama_barang }}</p>
            <div class="lg:flex gap-5">
                <p class="text-md lg:border-r-2 lg:pr-5">diajukan {{ $key->tgl_perbaikan }}</p>
                <p class="text-md font-medium">Selesai diperbaiki pada {{ $key->tgl_selesai_perbaikan }}</p>
            </div>
            <div class="pb-3">
                <p class="font-light">Dari Ruangan <span class="font-medium">{{ $key->nama_ruangan }}</span> </p>
            </div>
            <div class="pb-3">
                <p class="font-light">Keluhan</p>
                <p class="font-medium ">{{ $key->keluhan }} </p>
            </div>
            <div class="pb-3">
                <p class="font-light">Nama Teknisi</p>
                <p class="font-medium ">{{ $key->nama_teknisi }} </p>
            </div>
            <div class="pb-3">
                <p class="font-light">Penyebab Keluhan</p>
                <p class="font-medium ">{{ $key->penyebab_keluhan }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit perspiciatis consequuntur unde neque eaque laboriosam, corporis labore at inventore debitis, fuga autem dolor ut illum tempore iusto dignissimos corrupti doloremque!</p>
            </div>
            <div class="flex ">
                <div class="badge badge-lg badge-outline
                    {{ ($key->status_perbaikan === 'bisa diperbaiki') ? 'badge-success' : '' }}
                    {{ ($key->status_perbaikan === 'tidak bisa diperbaiki') ? 'badge-error' : '' }}
                    ">{{ $key->status_perbaikan}}
                </div>
            </div>
        </div>
    </div>
    </label>
@endforeach

{{-- SELESAI PERBAIKAN --}}
@foreach($data as $key)
<input type="checkbox" id="selesaiperbaikan{{$key->id_perbaikan}}" class="modal-toggle" />
<label for="selesaiperbaikan{{$key->id_perbaikan}}" class="modal cursor-pointer">
    <div class="modal-box w-11/12 max-w-5xl">
        <form action="/PB/selesaiPerbaikan/simpanSelesaiPerbaikan" method="POST">
            @csrf
            <h2 class="text-2xl font-bold">Form Selesai Perbaikan</h2>
                <div class="pt-2">
                    Kode barang :
                    <div class="btn btn-sm btn-outline no-animation">{{ $key->kode_barang }}</div>
                </div>
            <br>
            <div class="form-control hidden">
                <label class="label">
                <span class="label-text">Kode Barang</span>
                </label>
                <input type="text" name="id_perbaikan" class="input input-bordered "
                value="{{ old('id_perbaikan', $key->id_perbaikan) }}"/>
            </div>
            <div class="lg:flex gap-5">
                <div class="basis-1/2">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Teknisi</span>
                        </label>
                        <input type="text" name="nama_teknisi" class="input input-bordered" required autocomplete="off"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Penyebab Keluhan</span>
                        </label>
                        <textarea name="penyebab_keluhan" cols="20" rows="5" class="textarea textarea-bordered" required></textarea>
                    </div>
                </div>
                <div class="basis-1/2">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status Barang</span>
                            </label>
                        <div class="flex items-center pl-4 rounded-t border">
                            <input id="bordered-radio-1" type="radio" value="bisa diperbaiki" name="status_perbaikan" class="radio radio-success" required>
                            <label for="bordered-radio-1" class="py-4 ml-2 text-success w-full text-sm font-medium ">Bisa Diperbaiki</label>
                        </div>
                        <div class="flex items-center pl-4 rounded-b border">
                            <input id="bordered-radio-2" type="radio" value="tidak bisa diperbaiki" name="status_perbaikan" class="radio radio-error" required>
                            <label for="bordered-radio-2" class="py-4 ml-2 text-error w-full text-sm font-medium ">Tidak Bisa Diperbaiki</label>
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Solusi Keluhan</span>
                        </label>
                        <textarea name="solusi_barang" cols="20" rows="5" class="textarea textarea-bordered" placeholder="Silahkan Dikosongkan Jika Status Barang tidak bisa diperbaiki" ></textarea>
                    </div>
                </div>
            </div>
                <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
</label>
@endforeach

{{-- HAPUS --}}
@foreach($data as $key)
    <input type="checkbox" id="delete{{ $key->id_perbaikan }}" class="modal-toggle" />
    <label for="delete{{ $key->id_perbaikan }}" class="modal cursor-pointer">
    <div class="modal-box border-t-2 border-error">
        <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
        </svg>
        <div class="text-center">
            <h3 class="font-bold text-2xl">Anda yakin ?</h3>
            {{-- <p class="py-4 text-md">Menghapus pengguna <b>permanen</b> membuat pengguna tersebut tidak bisa lagi login</p> --}}
        </div>
        <div class="flex justify-center pt-4 gap-3">
            <label for="delete{{ $key->id_perbaikan }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
            <label class="btn btn-sm btn-error btn-outline">
                <a href="/pengajuan/PB/hapus/{{$key->id_perbaikan}}">
                    Delete
                </a>
            </label>
        </div>
    </div>
    </label>
@endforeach
@endsection
