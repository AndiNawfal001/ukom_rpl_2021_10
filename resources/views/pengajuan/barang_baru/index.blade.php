@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Pengajuan Barang Baru</h1>
        <div class="lg:flex justify-between mb-2">
            <form action="/pengajuan/BB" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="flex gap-2 items-center  ">
                        <input type="text" name="search" placeholder="Search Nama Barang…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off" />
                        <button class="btn btn-sm btn-square" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                        </div>
                    </div>
            </form>
            <a href="/pengajuan/BB/tambah">
                <button class="btn btn-sm btn-success gap-2">
                    Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </a>
        </div>
            <div class="">
                <div class="">
                    <div class="overflow-x-auto overflow-y-auto">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pengajuan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <?php $no=1;?>
                            @forelse($data as $key)
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $no++ }}.</td>
                                    <td>{{ $key->nama_barang }}</td>
                                    <td class="text-right">{{ number_format($key->total_harga, 0, '.', '.') }}</td>
                                    <td class="text-center">{{ $key->tgl }}</td>
                                    <td class="text-center">
                                        <p class=" badge badge-outline w-20
                                        {{ ($key->status_approval === 'setuju') ? 'badge-success' : '' }}
                                        {{ ($key->status_approval === 'pending') ? 'badge-warning' : '' }}
                                        {{ ($key->status_approval === 'tidak') ? 'badge-error' : '' }}
                                        ">{{ $key->status_approval }}</p>
                                    </td>
                                    <td class="text-center">
                                        <label for="pengajuanbbdetail{{ $key->id_pengajuan_bb }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </label>
                                        @if($key->status_approval == "pending" || $key->status_approval == "tidak")
                                                @if ($key->status_approval == "pending")
                                                    <a href="/pengajuan/BB/edit/{{$key->id_pengajuan_bb}}">
                                                        <button class="btn btn-sm btn-warning btn-square btn-outline">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                        </button>
                                                    </a>
                                                @endif
                                                <label for="delete{{ $key->id_pengajuan_bb }}" class="btn btn-sm btn-error btn-square btn-outline">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </label>
                                        @endif
                                    </a>
                                    </td>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                                            </div>
                                        </td>
                                    </tr>
                                </tr>
                            </tbody>
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
    @foreach ($data as $key)
    <input type="checkbox" id="pengajuanbbdetail{{ $key->id_pengajuan_bb }}" class="modal-toggle" />
    <label for="pengajuanbbdetail{{ $key->id_pengajuan_bb }}" class="modal cursor-pointer">
        <label class="modal-box relative rounded-md" for="">
            <div class="badge badge-lg badge-outline mb-5
            {{ ($key->status_approval === 'setuju') ? 'badge-success' : '' }}
            {{ ($key->status_approval === 'pending') ? 'badge-warning' : '' }}
            {{ ($key->status_approval === 'tidak') ? 'badge-error' : '' }}
            ">{{ $key->status_approval }}</div><br>
            <h3 class="text-xl font-bold">{{ $key->nama_barang }}</h3>
            <div class="xl:flex gap-5">
                <p class="text-sm">diajukan {{ $key->tgl }}</p>
                @if($key->tgl_approve !== NULL)
                    <p class="text-sm xl:border-l-2 xl:pl-5 font-medium">
                        <span>disetujui pada {{ $key->tgl_approve }}</span>
                    </p>
                @endif
            </div>

            <div class="py-4">
                <p class="font-light">Spesifikasi</p>
                <p class="font-medium ">{{ $key->spesifikasi }} </p>
            </div>
            <div class="py-4">
                <p class="font-light">Untuk Ruangan</p>
                <p class="font-medium ">{{ $key->nama_ruangan }} </p>
            </div>
            <div class="py-4 flex gap-7">
                <div>
                    <span class="text-md font-light">Harga Satuan</span>
                    <p class="font-semibold">{{ number_format($key->harga_satuan, 0, '.', '.') }}</p>
                </div>
                <div>
                    <span class="text-md font-light">Jumlah</span>
                    <p class="font-semibold">{{ $key->jumlah }}</p>
                </div>
                <div>
                    <span class="text-md font-light">Total Harga</span>
                    <p class="font-semibold">{{ number_format($key->total_harga, 0, '.', '.') }}</p>
                </div>
            </div>

        </label>
    </label>
    @endforeach

    {{-- HAPUS --}}

    @foreach($data as $key)
    <input type="checkbox" id="delete{{ $key->id_pengajuan_bb }}" class="modal-toggle" />
    <label for="delete{{ $key->id_pengajuan_bb }}" class="modal cursor-pointer">
    <div class="modal-box border-t-2 border-error">
        <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
        </svg>
        <div class="text-center">
            <h3 class="font-bold text-2xl">Anda yakin ?</h3>
        </div>
        <div class="flex justify-center pt-4 gap-3">
            <label for="delete{{ $key->id_pengajuan_bb }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
            <label class="btn btn-sm btn-error btn-outline">
                <a href="/pengajuan/BB/hapus/{{$key->id_pengajuan_bb}}">
                    Delete
                </a>
            </label>
        </div>
    </div>
    </label>
    @endforeach

@endsection



