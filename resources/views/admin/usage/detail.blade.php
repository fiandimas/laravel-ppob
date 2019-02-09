@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Detail Penggunaan</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            @if (session('fail'))
              <div class="alert alert-danger">
                {{ session('fail') }}
              </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
            <table class="table table-striped table-bordered">
              <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Total</th>
                <th>Aksi</th>
              </tr>
              @foreach ($usage as $data)
              <tr>
                <td>{{ $month[$data->month] }}</td>
                <td>{{ $data->year }}</td>
                <td>{{ $data->start_meter }}</td>
                <td>{{ $data->finish_meter }}</td>
                <td>{{ $data->start_meter + $data->finish_meter }}</td>
                <td>
                  <a href="{{ url('admin/usage/delete/').'/'.$data->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this item ?')">Hapus</a>
                </td>
              </tr>
              @endforeach
            </table>
            <a href="{{ url('admin/usage') }}" class="btn btn-warning">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Tambah level</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          Nama level 
          <input type="text" class="form-control" name="nama_level">
          <br>
          <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection