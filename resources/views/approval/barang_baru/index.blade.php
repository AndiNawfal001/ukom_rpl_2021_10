@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 border-t-2 border-primary shadow rounded-md p-4 sm:p-5">
        <h1 class="h1-judul">Daftar Pengajuan Barang Baru untuk di Approve</h1>  
            <div class="">
                <div class="">
                    <div class="overflow-x-auto overflow-y-auto">
                        <form action="/approval/BB" method="GET">
                            @csrf
                                <div class="form-control mb-2">
                                    <div class="flex gap-2 items-center">
                                        <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                                        <select name="filter_month" class="select select-sm select-bordered select-sm w-40 max-w-xs">
                                            <option disabled {{ request('filter_month') ? '' : 'selected' }}>-- All Months --</option>
                                            <?php
                                            for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                $nama_bulan = date("F", mktime(0, 0, 0, $bulan, 1));
                                                $selected = request('filter_month') == $bulan ? 'selected' : '';
                                                echo "<option value='$bulan' $selected>$nama_bulan</option>";
                                            }
                                            ?>
                                        </select>
                                        <select name="filter_year" class="select select-sm select-bordered select-sm w-40 max-w-xs">
                                            <option disabled {{ request('filter_year') ? '' : 'selected' }}>-- All Years --</option>
                                            <?php
                                            $years = DB::table('pengajuan_bb')
                                                        ->select(DB::raw('YEAR(tgl) AS year'))
                                                        ->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                                                        ->distinct()
                                                        ->orderBy('year', 'asc')
                                                        ->get();
                                        
                                            foreach ($years as $year) {
                                                $selected = request('filter_year') == $year->year ? 'selected' : '';
                                                echo "<option value='$year->year' $selected>$year->year</option>";
                                            }
                                            ?>
                                        </select>
                                        <select name="filter_status" class="select select-sm select-bordered select-sm w-40 max-w-xs">
                                            <option disabled {{ request('filter_status') ? '' : 'selected' }}>-- All Status --</option>
                                            <?php
                                            $statuses = DB::table('pengajuan_bb')
                                                            ->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                                                            ->select('status_approval')
                                                            ->distinct()
                                                            ->get();
                                        
                                            foreach ($statuses as $status) {
                                                $selected = request('filter_status') == $status->status_approval ? 'selected' : '';
                                                echo "<option value='$status->status_approval' $selected>$status->status_approval</option>";
                                            }
                                            ?>
                                        </select>
                                        <button class="btn btn-sm btn-primary btn-square" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </button>
                                    </div>
                                </div>
                        </form>
                        <table class="table-primary">
                            <thead class="bg-base-200">
                                <tr>
                                    <x-table-header class="w-5">No</x-table-header>
                                    <x-table-header>Nama Barang</x-table-header>
                                    <x-table-header class="w-40">Total Harga</x-table-header>
                                    <x-table-header class="w-20">Tanggal Pengajuan</x-table-header>
                                    <x-table-header class="w-20">Status</x-table-header>
                                    <x-table-header class="w-20">Kontrol</x-table-header>
                                </tr>
                            </thead> 
                            @forelse($data as $key => $item)
                            <tbody>
                                <tr>
                                    <td class="text-center border-table">{{ $data->firstItem() + $key }}.</td> 
                                    <td class="border-table">{{ $item->nama_barang }}</td>
                                    <td class="text-right border-table">{{ number_format($item->total_harga, 0, '.', '.') }}</td>
                                    <td class="text-center border-table">{{ $item->tgl }}</td>
                                    <td class="text-center border-table">
                                        <p class="badge badge-outline w-20
                                        {{ ($item->status_approval === 'setuju') ? 'badge-success' : '' }}
                                        {{ ($item->status_approval === 'pending') ? 'badge-warning' : '' }}
                                        {{ ($item->status_approval === 'tidak') ? 'badge-error' : '' }}
                                        ">{{ $item->status_approval }}</p>
                                    <td class="text-center border-table">
                                        <label for="approvalbbdetail{{ $item->id_pengajuan_bb }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 
                                        </label>
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
                    <br>
                    <div class="lg:flex flex-row-reverse">
                        <div>
                            {{ $data->links('vendor.pagination.daisyui') }}
                        </div>
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
    <input type="checkbox" id="approvalbbdetail{{ $key->id_pengajuan_bb }}" class="modal-toggle" />
    <label for="approvalbbdetail{{ $key->id_pengajuan_bb }}" class="modal cursor-pointer">
    <label class="modal-box relative rounded-md" for="">
        <div class="badge badge-lg badge-outline mb-4
        {{ ($key->status_approval === 'setuju') ? 'badge-success' : '' }}
        {{ ($key->status_approval === 'pending') ? 'badge-warning' : '' }}
        {{ ($key->status_approval === 'tidak') ? 'badge-error' : '' }}
        ">{{ $key->status_approval }}</div><br>
        <h3 class="text-xl font-bold">{{ $key->nama_barang }}</h3>
        <h3 class="text-md">diajukan {{ $key->tgl }}</h3>

        <div class="py-4">
            <p class="font-light">Spesifikasi</p>
            <p class="font-medium ">{{ $key->spesifikasi }}</p>
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
        <div class="flex flex-row-reverse">
            @if($key->status_approval == "pending")
                    <div class="py-5 flex flex-row-reverse gap-3">
                        <a href="/approval/BB/tidaksetuju/{{$key->id_pengajuan_bb}}"><button class="btn btn-sm btn-outline btn-error">Tidak Setuju</button></a>
                        <a href="/approval/BB/setuju/{{$key->id_pengajuan_bb}}"><button class="btn btn-sm btn-outline btn-success">Setuju</button></a>
                    </div>
                @else

                @endif
        </div>

    </label>
    </label>
@endforeach
@endsection
