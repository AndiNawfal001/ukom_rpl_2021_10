@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 border-t-2 border-primary shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Pengajuan Perbaikan untuk di Approve</h1>
        <form action="/approval/PB" method="GET">
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
                                    <p class=" badge badge-outline w-20 badge-warning">belum selesai</p>
                                @else
                                    <p class=" badge badge-outline w-20 badge-success">sudah selesai</p>
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
                                <label for="detail{{ $key->id_perbaikan }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </label>
                            </td>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="text-center">
                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                                    </div>
                                </td>
                            </tr>
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
            @if($key->approve_perbaikan == "pending")
                <div class="py-5 flex flex-row-reverse gap-3">
                    <a href="/approval/PB/tidaksetuju/{{$key->id_perbaikan}}/{{ $key->kode_barang }}"><button class="btn btn-sm btn-outline btn-error">Rusak</button></a>
                    <a href="/approval/PB/setuju/{{$key->id_perbaikan}}"><button class="btn btn-sm btn-outline btn-success">Sudah Diperbaiki</button></a>
                </div>
            @endif
        </div>
    </div>
    </label>
@endforeach
@endsection
