@extends('layouts.main')


@section('container')
<div class="p-5">
  <div class="overflow-x-auto overflow-y-auto">
    <table class="table w-full ">
      <tr>
        <th></th>
        <th>nip</th>
        <th>nama</th>
        <th>kontak</th>
        <th>Username</th>
      </tr>
      <?php $no=1;?>
      @foreach($Kaprog as $key)
      <tr>
        <th>{{ $no++ }}</th>
        <td>{{ $key->nip }}</td>
        <td>{{ $key->nama }}</td>
        <td>{{ $key->kontak }}</td>
        <td><p class="font-semibold">{{ $key->username }}</p></td>

      </tr>
      @endforeach

    </table>
  </div>
   <div class="flex flex-row-reverse">
        <a href="User/kaprog"><button class="btn btn-success my-5">Tambah Kaprog</button></a>
    </div>
</div>
@endsection
