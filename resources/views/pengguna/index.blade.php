@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-2xl pb-3 font-semibold leading-loose">Daftar Pengguna</h1>

        <div class="lg:hidden justify-between mb-2 ">
            <form action="/pengguna/search" method="GET">
                @csrf
                    <div class="form-control mb-2">
                        <div class="input-group ">
                        <input type="text" name="search" placeholder="Search…" class="input input-bordered" />
                        <button class="btn btn-square" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                        </div>
                    </div>
            </form>
            <label for="tambahpengguna" class="btn btn-success gap-2">
                Tambah Ruangan <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </label>

        </div>

        <div class="lg:flex gap-4 ">
            <div class="w-full lg:w-auto stats stats-horizontal lg:stats-vertical shadow">

                <div class="stat">
                  <div class="stat-title text-red-500 font-medium">Admin</div>
                  <div class="stat-value">{{ $admin }}</div>
                </div>

                <div class="stat">
                  <div class="stat-title text-green-500 font-medium">Manajemen</div>
                  <div class="stat-value">{{ $manajemen }}</div>
                </div>

                <div class="stat">
                  <div class="stat-title text-blue-500 font-medium">Kaprog</div>
                  <div class="stat-value">{{ $kaprog }}</div>
                </div>

            </div>
            <div class="basis-4/5 mt-4 lg:mt-0">
                <div class="hidden lg:flex justify-between mb-2 ">
                    <form action="/pengguna/search" method="GET">
                        @csrf
                            <div class="form-control mb-2">
                                <div class="input-group ">
                                <input type="text" name="search" placeholder="Search…" class="input input-bordered" />
                                <button class="btn btn-square" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </button>
                                </div>
                            </div>
                    </form>
                    {{-- <a href="/pengguna/tambah">
                        <button type="submit" class="btn btn-md btn-success gap-2">
                            Tambah Pengguna
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                    </a> --}}
                    <label for="tambahpengguna" class="btn btn-success gap-2">
                        Tambah Pengguna <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </label>
                </div>
                <div class="">
                    <div class="overflow-x-auto overflow-y-auto">
                        <table class="table w-full ">
                            <thead>
                                <tr>
                                    {{-- <th>NO</th> --}}
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level User</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php $no=1;?>
                            @foreach($data as $key)
                            <tr>
                                {{-- <th>{{ $no++ }}</th> --}}
                                <th>{{ $key->username }}</th>
                                <td>{{ $key->email }}</td>
                                <td>{{ $key->nama_level }}</td>
                                <td>
                                    <a href="pengguna/edit/{{$key->id_pengguna}}">
                                        {{-- EDIT --}}
                                        <button class="btn btn-sm btn-warning btn-square btn-outline">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                    </a>
                                    <a href="pengguna/hapus/{{$key->id_pengguna}}">
                                        {{-- DELETE --}}
                                        <button class="btn btn-sm btn-error btn-square btn-outline">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                    <div class="lg:flex flex-row-reverse">
                        <div>
                            {{ $data->links() }}
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
{{-- TAMBAH Ruangan --}}
<input type="checkbox" id="tambahpengguna" class="modal-toggle" />
<label for="tambahpengguna" class="modal cursor-pointer">
<div class="max-h-screen w-4/5 overflow-y-auto">
    <div class="bg-base-100 rounded-xl p-5 w-full" for="">
        <form action="pengguna/tambah" method="POST">
            @csrf
            <h2 class="text-2xl font-bold">Tambah Pengguna</h2>
            <br>
            <div class="lg:flex flex-row gap-5">
                <div class="basis-1/2">
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" class="input input-bordered" value="{{ old('username') }}"  required/>

                        @error('username')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Level User</span>
                        </label>
                        <select class="select select-bordered w-full max-w-xs" name="levelUser" required>
                            <option disabled selected>-- Pilih Level --</option>
                            @foreach ($levelUser as $item)
                                <option value="{{ $item->nama_level }}" {{ old('levelUser') == $item->nama_level ? 'selected' : null}}>{{ $item->nama_level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Email</span>
                        </label>
                        <input type="text" name="email" class="input input-bordered" value="{{ old('email') }}"  required/>
                        @error('email')

                        <p class="text-red-500">{{ $message }}</p>

                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Password</span>
                        </label>
                        <input type="text" name="password" class="input input-bordered" required/>
                    </div>
                </div>
                <div class="basis-1/2">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">NIP</span>
                        </label>
                        <input type="text" name="nip" class="input input-bordered" value="{{ old('nip') }}" placeholder="Silahkan dikosongkan jika user admin"/>
                        @error('nip')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input type="text" name="nama" class="input input-bordered" value="{{ old('nama') }}"  required/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Kontak</span>
                        </label>
                        <input type="text" name="kontak" class="input input-bordered" value="{{ old('kontak') }}"  placeholder="ex = 087654321234" required/>
                        @error('kontak')

                        <p class="text-red-500">{{ $message }}</p>

                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-control mt-6">
                <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</label>
@endsection
