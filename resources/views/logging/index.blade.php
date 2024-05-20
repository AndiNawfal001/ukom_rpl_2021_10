@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">History Logging</h1>
        <form action="/log" method="GET">
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
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table-primary ">
                    <thead>
                        <tr>
                            <th>Id Log</th>
                            <th>Username</th>
                            <th>Aktifitas</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    @forelse($data as $key)
                    <tr>
                        <th>{{ $key->id_log }}</th>
                        <td>{{ $key->username }}</td>
                        <td>
                            <p class=" badge badge-outline w-20
                            {{ ($key->aktifitas === 'tambah barang') ? 'badge-success' : '' }}
                            {{ ($key->aktifitas === 'approve pemutihan' OR $key->aktifitas === 'disapprove pemutihan') ? 'badge-warning' : '' }}
                            {{ ($key->aktifitas === 'barang diperbaiki' OR $key->aktifitas === 'barang rusak') ? 'badge-info' : '' }}
                            ">{{ $key->aktifitas }}</p>
                        </td>
                        <td>{{ $key->tgl }}</td>
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
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    <br>
</div>




@endsection
