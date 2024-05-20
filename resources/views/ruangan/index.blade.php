@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow rounded-md p-4 sm:p-5 ">
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Ruangan</h1> 
        <div class="lg:flex justify-between mb-2">
            <form action="/ruangan" method="GET">
                @csrf
                <div class="form-control mb-2">
                    <div class="flex gap-2 items-center  ">
                    <input type="text" name="search" placeholder="Search…" class="input input-sm input-bordered" value="{{ request("search") }}" autocomplete="off" />
                    <button class="btn btn-sm btn-square" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                    </div>
                </div>
            </form>
            <a href="/ruangan/tambah">
                <button class="btn btn-sm btn-success gap-2">
                    Tambah <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </a>
        </div>
        <div class="">
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table-primary">
                    <thead class="bg-base-200">
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Penanggung Jawab</th>
                            <th>Ket</th>
                            <th>Kontrol</th>
                        </tr>
                    </thead>
                    @forelse($data as $key)
                    <tr>
                        <th>{{ $key->nama_ruangan }}</th>
                        <td>{{ $key->penanggung_jawab }}</td>
                        <td>{{ $key->ket }}</td>
                        <td>
                            <a href="/ruangan/edit/{{ $key->id_ruangan }}">
                                <button class="btn btn-sm btn-warning btn-square btn-outline">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                            </a>
                            <label for="delete{{ $key->id_ruangan }}" class="btn btn-sm btn-error btn-square btn-outline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </label>
                        </td>
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

                </table>
            </div>

        </div>
        <br>
        <div class="lg:flex flex-row-reverse">
            <div >
                {{ $data->links() }}
            </div>
        </div>
    </div>
    <br>
    {{-- <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
          data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                type: 'line',
                label: '# of Votes',
                data: [{{ $no }}, 19, 3, 5, 2, 3],
                fill: true,
                tension: 0.3,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)'
            },{
                type: 'line',
                label: 'Line Dataset',
                data: [{{ $no }}, 50, 3, 10, 2, 3],
                fill: true,
                tension: 0.3,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)'
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    </script> --}}
</div>

@endsection

@section('modal')
{{-- HAPUS --}}
@foreach($data as $key)
<input type="checkbox" id="delete{{ $key->id_ruangan }}" class="modal-toggle" />
<label for="delete{{ $key->id_ruangan }}" class="modal cursor-pointer">
  <div class="modal-box border-t-2 border-error">
    <svg fill="none" class="text-error w-1/4 mx-auto" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
    </svg>
    <div class="text-center">
        <h3 class="font-bold text-2xl">Anda yakin ?</h3>
        <p class="py-4 text-md">Menghapus ruangan <b>permanen</b> akan berpengaruh ke data yang lain</p>
    </div>
    <div class="flex justify-center gap-3">
        <label for="delete{{ $key->id_ruangan }}" class="btn btn-sm btn-outline btn-info">Cancel</label>
        <label class="btn btn-sm btn-error btn-outline">
            <a href="/ruangan/hapus/{{$key->id_ruangan}}">
                Delete
            </a>
        </label>
    </div>
  </div>
</label>
@endforeach

@endsection
