@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">

    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">

        <h1 class="h1-judul">Daftar Pengguna</h1>
        {{-- MOBILE --}}
        <div class="lg:hidden justify-between mb-2 ">
            <form action="/pengguna" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="flex gap-2 items-center  ">
                            <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                            <select name="filter_status" class="select select-sm select-bordered w-40 max-w-xs">
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
            @can('admin')
            <a href="/pengguna/tambah">
                <button class="btn btn-sm btn-success gap-2">
                    Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </a>
            @endcan

        </div>

        <div class="gap-4 ">
            <div class="basis-4/5 mt-4 lg:mt-0">
                {{-- DESKTOP --}}
                <div class="hidden lg:flex justify-between mb-2 ">
                    <form action="/pengguna" method="GET">
                        @csrf
                            <div class="form-control mb-2">
                                <div class="flex gap-2 items-center  ">
                                    <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                                    <select name="filter_level" class="select select-sm select-bordered w-40 max-w-xs">
                                        <option disabled {{ request('filter_level') ? '' : 'selected' }}>-- All Level --</option>
                                        <?php
                                        $levels = DB::table('pengguna_admin_manajemen_kaprog')
                                                    ->select('id_level', DB::raw('MAX(nama_level) as nama_level'))
                                                    ->groupBy('id_level')
                                                    ->get(); 
                                    
                                        foreach ($levels as $lv) {
                                            $selected = request('filter_level') == $lv->id_level ? 'selected' : '';
                                            echo "<option value='$lv->id_level' $selected>$lv->nama_level</option>";
                                        }
                                        ?>
                                    </select>
                                    <button class="btn btn-sm btn-primary btn-square" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                    </button>
                                </div>
                            </div>
                    </form>
                    @can('admin')
                        <a href="/pengguna/tambah">
                            <button class="btn btn-sm btn-success gap-2">
                                Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </a>
                    @endcan
                </div>
                <div class="">
                    <div class="overflow-x-auto overflow-y-auto">
                        <table class="table-primary rounded-sm">
                            <thead class="bg-base-200">
                                <tr>
                                    <x-table-header class="w-5">No</x-table-header>
                                    <x-table-header>Username</x-table-header>
                                    <x-table-header>Email</x-table-header>
                                    <x-table-header >Level User</x-table-header>
                                    @can('admin')
                                        <x-table-header>Kontrol</x-table-header>
                                    @endcan
                                </tr>
                            </thead>
                            @forelse($data as $key => $item)
                            <tr>
                                <td class="border-table ">{{ $data->firstItem() + $key }}.</td>
                                <td class="border-table ">{{ $item->username }}</td>
                                <td class="border-table ">{{ $item->email }}</td>
                                <td class="border-table text-center">
                                    <p class=" badge badge-outline w-20
                                    {{ ($item->nama_level === 'kaprog') ? 'badge-info' : '' }}
                                    {{ ($item->nama_level === 'manajemen') ? 'badge-success' : '' }}
                                    {{ ($item->nama_level === 'admin') ? 'badge-error' : '' }}
                                    ">{{ $item->nama_level }}</p>
                                </td>
                                @can('admin')
                                    <td class="border-table text-center">
                                        <a href="/pengguna/edit/{{$item->id_pengguna}}">
                                            {{-- EDIT --}}
                                            <button class="btn btn-sm btn-warning btn-square btn-outline">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                        </a>
                                        <label for="delete{{ $item->id_pengguna }}" class="btn btn-sm btn-error btn-square btn-outline">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </label>
                                    </td>
                                @endcan
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

        </div>
        </div>
    </div>
</div>

    <br>
</div>

@endsection
@section('modal')

{{-- KONFIRMASI DELETE --}}
@foreach($data as $key)
<input type="checkbox" id="delete{{ $key->id_pengguna }}" class="modal-toggle" />
<label for="delete{{ $key->id_pengguna }}" class="modal cursor-pointer">
  <div class="modal-box border-t-2 border-error">
    <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
    </svg>
    <div class="text-center">
        <h3 class="font-bold text-2xl">Anda yakin ?</h3>
        <p class="py-4 text-md">Menghapus pengguna <b>permanen</b> membuat pengguna tersebut tidak bisa lagi login</p>
    </div>
    <div class="flex justify-center gap-3">
        <label for="delete{{ $key->id_pengguna }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
        <label class="btn btn-sm btn-error btn-outline">
            <a href="/pengguna/hapus/{{$key->id_pengguna}}">
                Delete
            </a>
        </label>
    </div>
  </div>
</label>
@endforeach
@endsection
