@extends('layouts.main')
@section('container')

<div class="pt-6 px-4">
    <div class="bg-base-100 shadow-xl rounded-2xl p-4 sm:p-4 xl:p-6 ">
        {{-- <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Ruangan</h1> --}}
        <div class="lg:flex justify-between mb-2">
            {{-- <form action="/ruangan" method="GET">
                @csrf
                <div class="form-control mb-2">
                    <div class="input-group ">
                    <input type="text" name="search" placeholder="Search…" class="input input-bordered" value="{{ request("search") }}" autocomplete="off" />
                    <button class="btn btn-square" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                    </div>
                </div>
            </form> --}}
        <h1 class="text-xl pb-3 font-semibold leading-loose">Daftar Ruangan</h1>

            <a href="/ruangan/tambah">
                <button class="btn btn-success btn-outline gap-2">
                    Tambah Ruangan <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </a>
        </div>
        <div class="">
            <div class="overflow-x-auto overflow-y-auto">
                <table class="table table-compact w-full ">
                        <tr class="font-medium opacity-80">
                            <td>Nama Ruangan</td>
                            <td>Penanggung Jawab</td>
                            <td>Ket</td>
                            <td>Aksi</td>
                        </tr>
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
                                <svg class="mx-auto fill-base-content opacity-50" width="214" height="160" xmlns="http://www.w3.org/2000/svg"><path d="M72.086 143.993V97.367l-10.679 6.165a1 1 0 0 1-1-1.732l11.679-6.742v-18.43l-18.8 10.854a1 1 0 0 1-1-1.732l19.8-11.431V48.153l-45.104 26.04a1.844 1.844 0 0 0-.675 2.52L65.963 145.4a1.844 1.844 0 0 0 2.52.675l3.603-2.08zm.149 2.224l-2.753 1.589a3.844 3.844 0 0 1-5.251-1.407L24.575 77.713a3.844 3.844 0 0 1 1.407-5.251l46.104-26.618V33a5 5 0 0 1 5-5h82a5 5 0 0 1 5 5v112a5 5 0 0 1-5 5h-82a5.002 5.002 0 0 1-4.851-3.783zM182.085 5V0a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0V7h-5a1 1 0 1 1 0-2h5zm14 27v-5a1 1 0 1 1 2 0v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5h-5a1 1 0 1 1 0-2h5zm-20 1a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-67.581 38.893c-.504.241-1.125.06-1.388-.403-.262-.464-.066-1.036.438-1.278l.382-.184c.167-.08.305-.146.447-.211a16.54 16.54 0 0 1 1.11-.466c2.316-.87 5.261-1.351 9.504-1.351 3.242 0 5.882.288 7.967.805 1.638.405 2.855.934 3.642 1.502.447.323.525.918.175 1.33-.35.412-.997.484-1.444.16-.555-.4-1.523-.82-2.907-1.163-1.9-.47-4.363-.74-7.433-.74-3.988 0-6.67.438-8.727 1.212-.33.124-.64.255-.968.406-.129.059-.256.12-.413.195l-.385.186zM87.086 109h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0 20h62a1 1 0 1 1 0 2h-62a1 1 0 1 1 0-2zm0-40h62a1 1 0 1 1 0 2h-62a1 1 0 0 1 0-2zm-10-59a3 3 0 0 0-3 3v112a3 3 0 0 0 3 3h82a3 3 0 0 0 3-3V33a3 3 0 0 0-3-3h-82zm18.466 18.846a1 1 0 0 1 1.068-1.692l10 6.314a1 1 0 0 1 .022 1.677l-10 6.686a1 1 0 0 1-1.112-1.662l8.72-5.831-8.698-5.492zm45.048.047l-8.842 5.3 8.864 5.628a1 1 0 1 1-1.072 1.689l-10.232-6.497a1 1 0 0 1 .022-1.701l10.231-6.135a1 1 0 0 1 1.029 1.716zM9.034 75.966a1 1 0 0 1 1.225-.707l7.727 2.07a1 1 0 1 1-.517 1.932l-7.728-2.07a1 1 0 0 1-.707-1.225zm15.707-16.707a1 1 0 0 1 1.225.707l2.07 7.727a1 1 0 0 1-1.931.518l-2.07-7.727a1 1 0 0 1 .706-1.225zm-12.258 3.448a1 1 0 0 1 1.414 0l7.07 7.071a1 1 0 0 1-1.413 1.414l-7.071-7.07a1 1 0 0 1 0-1.415z"/></svg>
                                <p class="font-semibold text-2xl opacity-50">Data Kosong</p>
                            </div>
                        </td>
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
    <br><br>
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
