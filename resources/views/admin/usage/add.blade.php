@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Tambah Penggunaan</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          @if (session('fail'))
            <div class="alert alert-danger">
              {{ session('fail') }}
            </div>
          @endif
          <div class="col-md-10">
            <form action="{{ url('admin/usage/add').'/'.$customer->id }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="table table-hover table-striped">
              <tr>
                <td>Nama Pelanggan</td>
                <td><input type="text" name="name" class="form-control" value="{{ $customer->name }}" readonly></td>
              </tr>
              <tr>
                <td>Bulan</td>
                <td>
                  <select name="month" class="form-control">
                    @foreach ($month as $data)
                      <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td>Tahun</td>
                <td>
                  <select name="year" class="form-control">
                    @for ($i=2019;$i<=2022;$i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </td>
              </tr>
              <tr>
                <td>Meter Awal</td>
                <td>
                  <input type="text" name="start_meter" class="form-control">
                  <p>{{ $errors->first('start_meter') }}</p>
                </td>
              </tr>
              <tr>
                <td>Meter Akhir</td>
                <td>
                  <input type="text" name="finish_meter" class="form-control">
                  <p>{{ $errors->first('finish_meter') }}</p>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <a href="{{ url('admin/usage') }}" class="btn btn-warning">Kembali</a>
                  <input type="submit" value="Tambah" class="btn btn-success">
                </td>
              </tr>
            </table>
            </form>
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