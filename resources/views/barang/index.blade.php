@extends('layouts.main')
@section('container')
<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Seluruh Barang</h1>
        <form action="/barang" method="GET">
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
        <div class="overflow-x-auto w-full">

            <table class="table-primary">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Total Barang</th>
                    <th>Barang Rusak</th>
                    <th>Barang Non Aktif</th>
                    <th>Kontrol</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $key => $item)
                <tr>
                    <th>{{ $data->firstItem() + $key }}</th>
                    <td>
                      <div class="flex items-center space-x-3">

                        <div>
                          <div class="font-bold">{{ $item->nama_barang }}</div>
                          <div class="text-sm opacity-50">{{ $item->nama_jenis }}</div>
                        </div>
                      </div>
                    </td>
                    <td>{{ number_format($item->jml_barang, 0, '.', '.') }}</td>
                    <td>
                        @if($item->barang_rusak == 0)
                        <p class=" badge badge-outline w-20 badge-info">{{ number_format($item->barang_rusak, 0, '.', '.') }}</p>
                        @else
                        <p class=" badge badge-outline w-20 badge-warning">{{ number_format($item->barang_rusak, 0, '.', '.') }}</p>
                        @endif
                    </td>
                    <td>
                        @if($item->barang_nonaktif == 0)
                        <p class=" badge badge-outline w-20 badge-success">{{ number_format($item->barang_nonaktif, 0, '.', '.') }}</p>
                        @else
                        <p class=" badge badge-outline w-20 badge-error">{{ number_format($item->barang_nonaktif, 0, '.', '.') }}</p>
                        @endif
                    </td>
                    <th>
                        <a href="/barang/detail/{{ $item->id_barang }}">
                            <button class="btn btn-sm btn-outline btn-info">Detail</button>
                        </a>
                    </th>
                  </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="text-center">
                                <img src="{{ asset('image/empty.png') }}" class="mx-auto w-40"> 
                            </div>
                        </td>
                    </tr>
                @endforelse
              </tbody>


            </table> 
            <br>
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
