@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar Pelanggan</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-8">
            <table class="table table-striped table-bordered">
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No.KWH</th>
                <th>Power</th>
                <th>Aksi</th>
              </tr>
              @foreach ($customer as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->id }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->username }}</td>
                  <td>{{ $data->address }}</td>
                  <td>{{ $data->kwh_number }}</td>
                  <td>{{ $data->power }}</td>
                  <td>
                    <a href="#edit" class="btn btn-warning" data-toggle="modal" onclick="get({{ $data->id }},'{{ $data->name}}','{{ $data->address }}',{{ $data->kwh_number }})">Edit</a>
                    <a href="{{ url('admin/customer/delete').'/'.$data->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this level ?')">Delete</a>
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
          <div class="col-md-4">
            <form id="sign_in" method="POST" action="{{ url('admin/customer/add') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @if (session('fail'))
                <div class="alert alert-danger" style="margin-top:-20px;">
                  {{ session('fail') }}
                </div>
              @endif
              @if (session('success'))
                <div class="alert alert-success" style="margin-top:-20px;">
                  {{ session('success') }}
                </div>
              @endif
              <input type="text" class="form-control" name="name" placeholder="Nama Pelanggan">
              <p>{{ $errors->first('name') }}</p>
              <input type="text" class="form-control" name="username" placeholder="Username">
              <p>{{ $errors->first('username') }}</p>
              <input type="password" class="form-control" name="password" placeholder="Password">  
              <p>{{ $errors->first('password') }}</p>  
              <input type="text" class="form-control" name="address" placeholder="Alamat">
              <p>{{ $errors->first('address') }}</p>
              <input type="text" class="form-control" name="kwh_number" placeholder="No. KWH">
              <p>{{ $errors->first('kwh_number') }}</p>
              <select class="form-control" name="power">
                @foreach ($power as $data)
                  <option value="{{ $data->id }}">{{ $data->power }}</option>
                @endforeach
              </select>     
              <p></p>
              <input type="submit" name="simpan" value="Tambah" class="btn btn-success">
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
        <form action="{{ url('admin/customer/update') }}" method="post">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          Nama Pelanggan
          <input type="text" class="form-control" name="name" id="name_customer" required>
          <br>
          Alamat
          <input type="text" class="form-control" name="address" id="address" required>
          <br>
          Nomor KWH
          <input type="number" class="form-control" name="kwh_number" id="kwh_number" required>
          <br>
          Daya
          <select class="form-control" name="power">
            @foreach ($power as $data)
              <option value="{{ $data->id }}">{{ $data->power }}</option>
            @endforeach
          </select>     
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
<script>
  function get(id,name,address,kwh){
    $('#id').val(id);
    $('#name_customer').val(name);
    $('#address').val(address);
    $('#kwh_number').val(kwh);
  }  
  </script>
@endsection