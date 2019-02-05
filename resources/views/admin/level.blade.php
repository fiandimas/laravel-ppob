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
                <th>Aksi</th>
              </tr>
              @foreach ($level as $data)
                <tr>
                  <th>{{ $no++ }}</th>
                  <th>{{ $data->id }}</th>
                  <th>{{ $data->name }}</th>
                  <th>
                    <a href="" class="btn btn-warning">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                  </th>
                </tr>
              @endforeach
            </table>
          </div>
          <div class="col-md-5">
              <form id="sign_in" method="POST" action="{{ url('admin/level') }}">
                @if (session('fail'))
                  <div class="alert alert-danger" style="margin-top:-20px;">
                    {{ session('fail') }}
                  </div>
                @endif
                <div class="input-group">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    
                    <div class="form-line">
                      <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('username') }}" autofocus>
                    </div>
                    @if ($errors->has('name'))
                      <p>{{ $errors->first('name') }}</p>
                    @endif  
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">Tambah</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection