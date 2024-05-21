@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        <div>
            <div class="bg-base-100 shadow-md rounded-lg p-4 mb-4 sm:p-5 hover:shadow-2xl duration-300">
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
            <div class="bg-base-100 shadow rounded-lg p-4 sm:p-6 duration-300">
                <h1 class="h1-judul">Pengajuan yang sudah disetujui</h1>
                <form action="/barangMasuk" method="GET">
                    @csrf
                        <div class="form-control mb-2">
                            <div class="flex gap-2 items-center  ">
                            <input type="text" name="searchApproved" placeholder="Search Nama Barang…" class="input input-sm input-bordered"  value="{{ request("searchApproved") }}" autocomplete="off"/>
                            <button class="btn btn-sm btn-primary btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                            </div>
                        </div>
                </form>
                <div class="">

                    <div class="overflow-x-auto overflow-y-auto mb-4">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tgl Approve</th>
                                    <th>Kontrol</th>
                                </tr>
                            </thead>
                            @forelse($approved as $key)
                            <tr>
                                <th>
                                    <div class="flex items-center space-x-3">

                                    <div>
                                        <div class="font-bold">{{ $key->nama_barang }}</div>
                                        @if($key->status_pembelian == 'selesai')
                                            <div class="badge badge-sm badge-outline badge-success my-2">Completed</div>
                                        @else
                                            <div class="badge badge-sm badge-outline badge-warning my-2">In Progress</div>
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
                                        <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
        <div class="bg-base-100 shadow rounded-lg p-4 sm:p-5 duration-300">
            <h1 class="h1-judul">Barang yang sudah masuk</h1>
            <form action="/barangMasuk" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="flex gap-2 items-center  ">
                            <input type="text" name="searchData" placeholder="Search…" class="input input-sm input-bordered"  value="{{ request("searchData") }}" autocomplete="off"/>
                            <button class="btn btn-sm btn-primary btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                        </div>
                    </div>
            </form>
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table-primary">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Progress</th>
                            <th>Status Pembelian</th>
                            <th>Kontrol</th>
                        </tr>
                    </thead>
                    @forelse($data as $key)
                    <tr>
                        <td>{{ $key->nama_barang }}</td>
                        <td>{{ $key->progress }} / {{ $key->target }}</td>
                        <td>
                            @if($key->progress < $key->target)
                                <p class=" badge badge-outline w-20 badge-warning">outstanding</p>
                            @else
                                <p class=" badge badge-outline w-20 badge-success">selesai</p>
                            @endif
                        </td>
                        <td>
                            <a href="/barangMasuk/history/{{ $key->id_pengajuan_bb }}" class="btn btn-sm btn-info btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
                    @endforelse

                </table>
            </div>
        </div>
    </div>
    <br>
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
                <a href="/barangMasuk/tambah/{{ $key->id_pengajuan_bb }}"><button class="btn btn-sm btn-outline btn-success">Tambah Barang</button></a>
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
                <h2 class="h1-judul">Tambah Jenis Barang</h2>
                <br>
                <div class="form-control">
                    <label class="label">
                    <span class="label-text">Nama Jenis Barang</span>
                    </label>
                    <input type="text" name="nama_jenis" class="input input-sm input-bordered" required autocomplete="off"/>
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
            <table class="table-primary">
                <thead>
                    <tr>
                        <th>Jenis Barang</th>
                        <th>Jumlah</th>
                        <th>Kontrol</th>
                    </tr>
                </thead>
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
                                <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
        <h3 class="font-bold text-2xl">Anda yakin ? {{ $key->id_jenis_brg }}</h3>
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
