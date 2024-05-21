@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    {{-- <div class="text-sm breadcrumbs">
        <ul>
          <li><a>Home</a></li>
          <li><a>Documents</a></li>
          <li>Add Document</li>
        </ul>
      </div> --}}
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">

        <div class="flex justify-between">
            <h1 class="h1-judul">Detail Progress</h1>
            <div >
                <a href="/barangMasuk" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <div class="md:flex gap-4">
            <div class="mb-4 md:mb-0 md:w-2/5 bg-base-300 hover:shadow-xl duration-300 p-4 rounded-md ">
                @foreach ($card as $key)

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

                @endforeach
            </div>
            <div class="md:w-3/5">

                <div class="overflow-x-auto overflow-y-auto">
                    <table class="table-primary ">
                        <thead>
                            <tr>
                                <th>Tgl Masuk</th>
                                <th>Jumlah Masuk</th>
                                <th>Supplier</th>
                                <th>Status Pembelian</th>
                            </tr>
                        </thead>
                        <?php $no=1;?>
                        @forelse($data as $key)
                        <tr>
                        <th>{{ $key->tgl_masuk }}</th>
                        <td>{{ $key->jml_masuk }}</td>
                        <td>{{ $key->nama }}</td> {{-- supplier --}}
                        <td>
                            <p class="badge badge-md badge-outline
                            {{ ($key->status_pembelian === 'outstanding') ? 'badge-warning' : '' }}
                            {{ ($key->status_pembelian === 'selesai') ? 'badge-success' : '' }}
                            ">
                                {{ $key->status_pembelian }}
                            </p>
                        </td>
                        <td>
                        </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center">
                                    <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
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
