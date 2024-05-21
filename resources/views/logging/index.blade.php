@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">
        <h1 class="h1-judul">History Logging</h1>
        <form action="/log" method="GET">
            @csrf
                <div class="form-control mb-2">
                    <div class="flex gap-2 items-center  ">
                    <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                    <button class="btn btn-sm btn-primary btn-square" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                    </div>
                </div>
        </form>
        <div class="">
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table-primary ">
                    <thead class="bg-base-200">
                        <tr>
                            <x-table-header class="w-5">No</x-table-header>
                            <x-table-header>Id Log</x-table-header>
                            <x-table-header>Username</x-table-header>
                            <x-table-header>Aktifitas</x-table-header>
                            <x-table-header>Tanggal</x-table-header>
                        </tr>
                    </thead>

                    @forelse($data as $key => $item)
                    <tr>
                        <td class="border-table">{{ $data->firstItem() + $key }}</td>
                        <td class="border-table">{{ $item->id_log }}</td>
                        <td class="border-table">{{ $item->username }}</td>
                        <td class="border-table">
                            <p class=" badge badge-outline w-20
                            {{ ($item->aktifitas === 'tambah barang') ? 'badge-success' : '' }}
                            {{ ($item->aktifitas === 'approve pemutihan' OR $item->aktifitas === 'disapprove pemutihan') ? 'badge-warning' : '' }}
                            {{ ($item->aktifitas === 'barang diperbaiki' OR $item->aktifitas === 'barang rusak') ? 'badge-info' : '' }}
                            ">{{ $item->aktifitas }}</p>
                        </td>
                        <td class="border-table">{{ $item->tgl }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="text-center">
                                <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                            </div>
                        </td>
                    </tr>
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
    <br>
</div>




@endsection
