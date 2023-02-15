@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-6 xl:p-8 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Barang untuk perawatan</h1>
        <div class="">
            <div class="lg:flex justify-between mb-2">
                <form action="/perawatan" method="GET">
                    @csrf
                        <div class="form-control mb-2">
                            <div class="input-group ">
                            <input type="text" name="search" placeholder="Search…" class="input input-bordered" value="{{ request("search") }}" autocomplete="off"/>
                            <button class="btn btn-square" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                            </div>
                        </div>
                </form>
                <a href="/perawatan/pilihBarang">
                    <button type="submit" class="btn btn-success gap-2" >
                        Tambah Perawatan
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                </a>
            </div>
            <div class="">
                <div class="overflow-x-auto overflow-y-auto">
                    <table class="table w-full ">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Barang</th>
                                <th>Tanggal Perawatan</th>
                                <th>Nama Pelaksana</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php $no=1;?>
                        @forelse($data as $key)
                        <tr>
                        <th>{{ $no++ }}</th>
                        <th>
                            <div class="flex items-center space-x-3">
                                <div>
                                    <div class="font-bold text-lg">{{ $key->nama_barang }}</div>
                                    <div class="text-sm opacity-50">{{ $key->kode_barang }}</div>
                                </div>
                            </div>
                        </th>
                        <td>{{ $key->tgl_perawatan }}</td>
                        <td>{{ $key->nama_pelaksana }}</td>
                        <td>
                            <label for="detailperawatan{{ $key->id_perawatan }}" class="btn btn-sm  btn-info btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </label>
                            <label for="delete{{ $key->id_perawatan }}" class="btn btn-sm btn-error btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </label>
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
            <div class="lg:flex flex-row-reverse">
                <div >
                    {{ $data->links() }}
                </div>
            </div>
        </div>

    </div>
    <br>
</div>



@endsection




@section('modal')

{{-- DETAIL --}}
@foreach($data as $key)
<input type="checkbox" id="detailperawatan{{ $key->id_perawatan }}" class="modal-toggle" />
<label for="detailperawatan{{ $key->id_perawatan }}" class="modal cursor-pointer">
  <label class="modal-box relative" for="">
    <div >
        <p class="btn btn-sm btn-outline mb-3">{{ $key->kode_barang }}</p>
        <p class="text-2xl font-semibold">{{ $key->nama_barang }}</p>
        <div class="pb-3">
            <p class="text-md ">diajukan {{ $key->tgl_perawatan }}</p>
        </div>
        <div class="pb-3">
            <p class="font-light">Dari Ruangan <span class="font-medium">{{ $key->nama_ruangan }}</span> </p>
        </div>
        <div class="pb-3">
            <p class="font-light">Nama Pelaksana</p>
            <p class="font-medium ">{{ $key->nama_pelaksana }} </p>
        </div>
        <div class="pb-3">
            <p class="font-light">Keterangan Perawatan</p>
            <p class="font-medium ">{{ $key->ket_perawatan }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit perspiciatis consequuntur unde neque eaque laboriosam, corporis labore at inventore debitis, fuga autem dolor ut illum tempore iusto dignissimos corrupti doloremque!</p>
        </div>
        <div class="py-5 flex flex-row-reverse gap-3">
                <label for="editperawatan{{$key->kode_barang}}" for="detailperawatan{{ $key->id_perawatan }}" class="btn btn-sm btn-outline btn-warning">
                    Edit
                </label>
        </div>
    </div>
  </label>
</label>
@endforeach


{{-- EDIT --}}
@foreach ( $data as  $key)
<input type="checkbox" id="editperawatan{{ $key->kode_barang }}" class="modal-toggle" />
<label for="editperawatan{{ $key->kode_barang }}" class="modal cursor-pointer">
  <label class="modal-box relative" for="">
    <form action="/perawatan/edit/editsimpan" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="text-2xl font-bold">Edit Perawatan</h2>
        <br>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Nama Pelaksana</span>
            </label>
            <input type="text" name="nama_pelaksana" class="input input-bordered"
            value="{{ old('nama_pelaksana', $key->nama_pelaksana) }}" required/>
            <input type="hidden"  name="id_perawatan" value="{{$key->id_perawatan}}" />
        </div>
        <div class="form-control">
            <label class="label">
            <span class="label-text">Keterangan Perawatan</span>
            </label>
            <input type="text" name="ket_perawatan" class="input input-bordered"
            value="{{ old('ket_perawatan', $key->ket_perawatan) }}" required/>
            {{-- <input type="hidden"  name="id_barang" value="{{$key->id_barang}}" /> --}}
        </div>

            <div class="form-control mt-6">
            <button type="submit" value="simpan" class="btn btn-primary">Simpan</button>
            </div>
    </form>
  </label>
</label>
@endforeach


{{-- HAPUS --}}
@foreach($data as $key)
<input type="checkbox" id="delete{{ $key->id_perawatan }}" class="modal-toggle" />
<label for="delete{{ $key->id_perawatan }}" class="modal cursor-pointer">
  <div class="modal-box border-t-2 border-error">
    <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
    </svg>
    <div class="text-center">
        <h3 class="font-bold text-2xl">Anda yakin ?</h3>
        {{-- <p class="py-4 text-md">Menghapus pengguna <b>permanen</b> membuat pengguna tersebut tidak bisa lagi login</p> --}}
    </div>
    <div class="flex justify-center pt-4 gap-3">
        <label for="delete{{ $key->id_perawatan }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
        <label class="btn btn-sm btn-error btn-outline">
            <a href="/perawatan/hapus/{{$key->id_perawatan}}">
                Delete
            </a>
        </label>
    </div>
  </div>
</label>
@endforeach
@endsection
