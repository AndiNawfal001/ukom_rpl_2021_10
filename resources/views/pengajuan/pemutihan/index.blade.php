@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">

    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Barang untuk pemutihan</h1>

        <div class="">
                <ul class="grid gap-6 w-full md:grid-cols-2 mb-4">
                    <li>
                        <a href="/pemutihanLangsung/pilihBarang">
                            <label for="hosting-small" class="inline-flex justify-between items-center p-5 w-full bg-base-100 rounded-lg border cursor-pointer hover:bg-base-300">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Pemutihan langsung</div>
                                    <div class="w-full">seperti barang tua</div>
                                </div>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                        </a>
                    </li>
                    <li>

                        <a href="/pemutihan/pilihbarang">
                            <label for="hosting-small" class="inline-flex justify-between items-center p-5 w-full bg-base-100 rounded-lg border  cursor-pointer hover:bg-base-300
                            ">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Pemutihan dari perbaikan</div>
                                    <div class="w-full">lengkapi data untuk pemutihan</div>
                                </div>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                        </a>
                    </li>
                </ul>

            <div class="">
                <div class="overflow-x-auto overflow-y-auto">
                    <table class="table w-full ">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kode Barang</th>
                                <th>Tanggal Pemutihan</th>
                                <th>Keterangan Pemutihan</th>
                                <th>Penonaktifan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php $no=1;?>
                        @forelse($data as $key)
                        <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $key->kode_barang }}</td>
                        <td>{{ $key->tgl_pemutihan }}</td>
                        <td>{{ $key->ket_pemutihan }}</td>
                        <td>
                            <p class="badge badge-outline
                            {{ ($key->approve_penonaktifan === 'setuju') ? 'badge-success' : '' }}
                            {{ ($key->approve_penonaktifan === 'pending') ? 'badge-warning' : '' }}
                            {{ ($key->approve_penonaktifan === 'tidak setuju') ? 'badge-error' : '' }}
                            ">{{ $key->approve_penonaktifan }}</p>
                        </td>
                        <td>
                            <a href="pemutihan/detail/{{$key->id_pemutihan}}">
                                {{-- INFO --}}
                                <button class="btn btn-sm  btn-info btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </a>
                        </td>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="text-center">
                                    <svg class="mx-auto" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z" fill="#DCDFE6"/></svg>
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
    </div>
    <br>
</div>



@endsection
