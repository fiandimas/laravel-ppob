@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Level</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-7">
            <table class="table table-striped table-bordered">
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Admin</th>
                <th>Aksi</th>
              </tr>
              @foreach ($admin as $data)
                <tr>
                  <th>{{ $no++ }}</th>
                  <th>{{ $data->id }}</th>
                  <th>{{ $data->name }}</th>
                  <th>{{ $data->username }}</th>
                  <th>{{ $data->lname }}</th>
                  <th>
                    <a href="#edit" class="btn btn-warning" data-toggle="modal" onclick="get(1)">Edit</a>
                    <a href="{{ url('admin/admin/delete').'/'.$data->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this level ?')">Delete</a>
                  </th>
                </tr>
              @endforeach
            </table>
          </div>
          <div class="col-md-5">
            <form id="sign_in" method="POST" action="{{ url('admin/admin/add') }}">
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
              <input type="text" class="form-control" name="name" placeholder="Nama Admin">
              <p>{{ $errors->first('name') }}</p>
              <input type="text" class="form-control" name="username" placeholder="Username">
              <p>{{ $errors->first('username') }}</p>
              <input type="password" class="form-control" name="password" placeholder="Password">  
              <p>{{ $errors->first('password') }}</p>            
              <select name="level" class="form-control">
                @foreach ($level as $data)
                  <option value="{{ $data->id }}">{{ $data->name }}</option>
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