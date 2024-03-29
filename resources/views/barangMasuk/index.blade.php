@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        <div>
            <div class="bg-base-100 shadow-xl rounded-2xl p-4 mb-4 sm:p-4 xl:p-6 ">
                <div class="flex items-center">
                   <div class="flex-shrink-0">
                    @php
                        $jml_JB = DB::table('jenis_barang')->count();
                    @endphp
                      <span class="text-2xl sm:text-3xl leading-none font-bold">{{ $jml_JB }}</span>
                      <h3 class="text-base font-normal">Jenis Barang</h3>
                   </div>
                   <div class="flex gap-2 items-center justify-end flex-1">
                        <label for="detailjenisbarang" class="btn btn-sm btn-info btn-square btn-outline">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </label>
                        <label for="tambahjenisBarang" class="btn btn-sm btn-success btn-square btn-outline">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </label>
                   </div>
                </div>
            </div>
            <div class="bg-base-100 shadow-xl rounded-2xl p-4 sm:p-4 xl:p-6">
                <h1 class="text-xl pb-3 font-semibold leading-loose">Pengajuan yang sudah disetujui</h1>
                {{-- <form action="/barangMasuk" method="GET">
                    @csrf
                        <div class="form-control mb-2">
                            <div class="input-group ">
                            <input type="text" name="searchApproved" placeholder="Search Nama Barang…" class="input input-bordered"  value="{{ request("searchApproved") }}" autocomplete="off"/>
                            <button class="btn btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                            </div>
                        </div>
                </form> --}}
                <div class="">

                    <div class="overflow-x-auto overflow-y-auto mb-4">
                        <table class="table table-compact w-full">
                                <tr class="font-medium opacity-80">
                                    <td>Nama Barang</td>
                                    <td>Jumlah</td>
                                    <td>Tgl Approve</td>
                                    <td>Aksi</td>
                                </tr>
                            @forelse($approved as $key)
                            <tr>
                                <th>
                                    <div class="flex items-center space-x-3">

                                    <div>
                                        <div class="font-semibold">{{ $key->nama_barang }}</div>
                                        @if($key->status_pembelian == 'selesai')
                                            <div class="badge badge-sm badge-outline badge-success my-1">Completed</div>
                                        @else
                                            <div class="badge badge-sm badge-outline badge-warning my-1">In Progress</div>
                                        @endif
                                    </div>
                                    </div>
                                </th>
                            <td>{{ $key->jumlah}}</td>
                            <td>{{ $key->tgl_approve }}</td>
                            <td>
                                <label for="detailPengajuanApproved{{ $key->id_pengajuan_bb }}" class="btn btn-sm btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </label>
                            </td>
                            {{-- <td>{{ $key->password }}</td> --}}
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="text-center">
                                        <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z" /></svg>
                                        <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            @endforelse

                        </table>
                        <div class="lg:flex flex-row-reverse">
                            <div>
                                {{-- {{ $approved->links('jenisBarang') }} --}}
                                {{-- {{$approved->appends(['approved' => $approved->currentPage()])->links()}} --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-base-100 shadow-xl rounded-2xl p-4 sm:p-4 xl:p-6">
            <h1 class="text-xl pb-3 font-semibold leading-loose">Barang yang sudah masuk</h1>
            {{-- <form action="/barangMasuk" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="input-group ">
                        <input type="text" name="searchData" placeholder="Search…" class="input input-bordered"  value="{{ request("searchData") }}" autocomplete="off"/>
                        <button class="btn btn-square" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                        </div>
                    </div>
            </form> --}}
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table table-compact w-full">
                        <tr class="font-medium opacity-80">
                            <td>Nama Barang</td>
                            <td>Progress</td>
                            <td>Status Pembelian</td>
                            <td>Aksi</td>
                        </tr>
                    @forelse($data as $key)
                    <tr>
                        <td>{{ $key->nama_barang }}</td>
                        <td>{{ $key->progress }} / {{ $key->target }}</td>
                        <td>
                            @if($key->progress < $key->target)
                                <p class="badge badge-outline badge-warning">outstanding</p>
                            @else
                                <p class="badge badge-outline badge-success">selesai</p>
                            @endif
                        </td>
                        <td>
                            <a href="/barang Masuk/history/{{ $key->id_pengajuan_bb }}" class="btn btn-sm btn-info btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </a>
                        </td>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center">
                                    <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                    <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
                                </div>
                            </td>
                        </tr>
                    </tr>
                    @endforelse

                </table>
            </div>
        </div>
    </div>
    <br><br>
</div>
@php
    if($errors->has('nama_jenis')) {
        flash()->addError('Nama tersebut sudah digunakan!');
    }
@endphp
@endsection

@section('modal')

{{-- DETAIL PENGAJUAN --}}
@foreach ($info as $key)
    <input type="checkbox" id="detailPengajuanApproved{{ $key->id_pengajuan_bb }}" class="modal-toggle" />
    <label for="detailPengajuanApproved{{ $key->id_pengajuan_bb }}" class="modal cursor-pointer">
    <label class="modal-box relative rounded-md" for="">
        @if($key->status_pembelian == 'selesai')
                <div class="badge badge-lg badge-outline badge-success my-2">Completed</div>
            @else
                <div class="badge badge-lg badge-outline badge-warning my-2">In Progress</div>
            @endif
        <br>
        <h3 class="text-xl font-bold">{{ $key->nama_barang }}</h3>
        <div class="xl:flex gap-5">
            <p class="text-sm xl:border-r-2 xl:pr-5">diajukan {{ $key->tgl }}</p>
            <p class="text-sm font-medium">
                <span>disetujui pada {{ $key->tgl_approve }}</span>
            </p>
        </div>
        <div class="py-4">
            <p class="font-light text-gray-500">Spesifikasi</p>
            <p class="font-medium">{{ $key->spesifikasi }} </p>
        </div>
        <div class="py-4">
            <p class="font-light text-gray-500">Untuk Ruangan</p>
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
        <div class="flex flex-row-reverse">
            @if($key->status_pembelian == "outstanding" OR $key->status_pembelian == "")
                <a href="/barang Masuk/tambah/{{ $key->id_pengajuan_bb }}"><button class="btn btn-sm btn-outline btn-success">Tambah Barang</button></a>
            @else
            @endif
        </div>

    </label>
    </label>
@endforeach


{{-- TAMBAH JENIS BARANG --}}
<input type="checkbox" id="tambahjenisBarang" class="modal-toggle" />
    <label for="tambahjenisBarang" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <form action="/jenisBarang/tambah" method="POST">
                @csrf
                <h2 class="text-xl font-semibold">Tambah Jenis Barang</h2>
                <br>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text font-medium">Nama Jenis Barang</span>
                    </label>
                    <input type="text" name="nama_jenis" class="input input-bordered" required autocomplete="off"/>
                </div>

                    <div class="form-control mt-6">
                        <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
            </form>
        </label>
    </label>

{{-- DETAIL JENIS BARANG --}}
<input type="checkbox" id="detailjenisbarang" class="modal-toggle" />
    <label for="detailjenisbarang" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <table class="table table-compact w-full">
                    <tr class="font-medium opacity-80">
                        <td>Jenis Barang</td>
                        <td>Jumlah</td>
                        <td>Aksi</td>
                    </tr>
                <?php $no=1;?>
                @forelse($jenisBarang as $key)
                <tr>
                    <th>{{ $key->nama_jenis }}</th>
                    <td>
                        @if($key->jml_barang == NULL)
                            0
                        @else
                            {{ $key->jml_barang }}
                        @endif
                        barang
                    </td>
                    <td>
                        <label for="delete{{ $key->id_jenis_brg }}" class="btn btn-sm btn-error btn-square btn-outline">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </label>
                    </td>
                    @empty
                    <tr>
                        <td colspan="2">
                            <div class="text-center">
                                <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
                            </div>
                        </td>
                    </tr>
                </tr>
                @endforelse

            </table>
        </label>
    </label>
{{-- HAPUS JENIS BARANG --}}

@foreach($jenisBarang as $key)
<input type="checkbox" id="delete{{ $key->id_jenis_brg }}" class="modal-toggle" />
<label for="delete{{ $key->id_jenis_brg }}" class="modal cursor-pointer">
  <div class="modal-box border-t-2 border-error">
    <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
    </svg>
    <div class="text-center">
        <h3 class="font-bold text-2xl">Anda yakin ?</h3>
    </div>
    <div class="flex justify-center pt-4 gap-3">
        <label for="delete{{ $key->id_jenis_brg }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
        <label class="btn btn-sm btn-error btn-outline">
            <a href="/jenisBarang/hapus/{{$key->id_jenis_brg}}">
                Delete
            </a>
        </label>
    </div>
  </div>
</label>
@endforeach
@endsection
