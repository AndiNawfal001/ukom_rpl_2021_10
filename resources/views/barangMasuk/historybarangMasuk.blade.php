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
    <div class="bg-base-100 shadow-xl rounded-2xl p-4 sm:p-4 xl:p-6 ">

        <div class="flex justify-between">
            <h1 class="text-xl pb-3 font-semibold leading-loose">Detail Progress</h1>
            <div >
                <a href="/barang Masuk" class="btn btn-sm btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </a>
            </div>
        </div>
        <div class="md:flex gap-4">
            <div class="mb-4 md:mb-0 md:w-2/5 bg-base-300 hover:shadow-xl duration-300 p-4 rounded-md ">
                @foreach ($card as $key)

                    <h3 class="text-xl font-semibold">{{ $key->nama_barang }}</h3>
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
                    <table class="table table-compact w-full ">
                            <tr class="font-medium opacity-80">
                                <td>Tgl Masuk</td>
                                <td>Jumlah Masuk</td>
                                <td>Supplier</td>
                                <td>Status Pembelian</td>
                            </tr>
                        <?php $no=1;?>
                        @forelse($data as $key)
                        <tr>
                        <td>{{ $key->tgl_masuk }}</td>
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
                                    <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z" /></svg>
                                    <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </table>
                </div>

            </div>
        </div>
    </div>
    <br><br>
</div>

@endsection
