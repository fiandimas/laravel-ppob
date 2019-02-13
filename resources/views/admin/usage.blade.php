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
                    <a href="{{ url('admin/usage/add').'/'.$data->id }}" class="btn btn-success">Tambah Penggunaan</a>
                    <a href="{{ url('admin/usage/detail').'/'.$data->id }}" class="btn btn-primary">Detail Penggunaan</a>
                    <a href="{{ url('admin/usage/bill').'/'.$data->id }}" class="btn btn-info">Detail Tagihan</a>
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
@endsection