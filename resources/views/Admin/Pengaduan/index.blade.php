@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data Pengaduan')

@section('content')

<table id="pengaduanTable" class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Isi Laporan</th>
            <th>Status</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengaduan as $k => $v)
            <tr>
                <td>{{ $k += 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-M-Y') }}</td>
                <td>{{ $v->isi_laporan }}</td>
                <td>
                    @if ($v->status == '0')
                        <a href="#" class="badge badge-danger">Pending</a>
                    @elseif($v->status == 'proses')
                        <a href="#" class="badge badge-warning text-white">Proses</a>
                    @else
                        <a href="#" class="badge badge-success">Selesai</a>
                    @endif
                </td>
                <td><a class="btn btn-sm btn-info" href="{{ route('pengaduan.show', $v->id_pengaduan) }}" >Lihat</a>
                <a class="btn btn-sm btn-danger" href="deletePengaduan/{{ $v->id_pengaduan }}" >Hapus</a>
                
                
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
        $('#pengaduanTable').DataTable();
    });
</script>
@endsection