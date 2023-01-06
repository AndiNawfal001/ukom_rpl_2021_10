@extends('layouts.main')
@section('container')
<div class="p-5">
  <div class="overflow-x-auto overflow-y-auto">
    <table class="table w-full ">
      <tr>
        <th></th>
        <th>Level User</th>
        <th>Keterangan</th>
      </tr>
      <?php $no=1;?>
      @foreach($levelUser as $key)
      <tr>
        <th>{{ $no++ }}</th>
        <td>{{ $key->nama_level }}</td>
        <td>{{ $key->ket }}</td>

      </tr>
      @endforeach

    </table>
  </div>
 
   <div class="flex flex-row-reverse">
        <a href="levelUser/tambah"><button class="btn btn-success my-5">Tambah level user</button></a>
    </div>
   
</div>
@endsection
