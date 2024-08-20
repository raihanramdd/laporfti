@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data Pengaduan')

@section('content')

<table id="masyarakatTable" class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Telp </th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masyarakat as $k => $v)
            <tr>
                <td>{{ $k += 1 }}</td>
                <td>{{ $v->npm }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->username }}</td>
                <td>{{ $v->telp }}</td>
                <td><a class="btn btn-sm btn-info" href="{{ route('masyarakat.show', $v->npm) }}" >Lihat</a>
                <a class="btn btn-sm btn-danger" href="deleteMasyarakat/{{ $v->npm }}" >Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#masyarakatTable').DataTable();
    });
</script>
@endsection