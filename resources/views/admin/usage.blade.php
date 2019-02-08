@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar Penggunaan</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            <center>
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif
            </center>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>No. KWH</th>
                <th>Power</th>
                <th>Aksi</th>
              </tr>
              @foreach ($customer as $data)
                <tr>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->kwh_number }}</td>
                  <td>{{ $data->power }}</td>
                  <td>
                    <a href="{{ url('admin/usage/add').'/'.$data->id }}" class="btn btn-success" data-toggle="modal" onclick="get(1)">Tambah Penggunaan</a>
                    <a href="{{ url('admin/usage/detail').'/'.$data->id }}" class="btn btn-primary">Detail Penggunaan</a>
                    <a href="{{ url('admin/usage/bill').'/'.$data->id }}" class="btn btn-info" data-toggle="modal" onclick="get(1)">Detail Tagihan</a>
                  </td>
                </tr>
                  @endforeach
                </table>
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
            <?php $arr_level=array("direktur","Manager","Receptionist");?>
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