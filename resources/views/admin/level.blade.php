@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar Level</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped table-bordered">
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Name</th>
              </tr>
              @foreach ($level as $data)
                <tr>
                  <th>{{ $no++ }}</th>
                  <th>{{ $data->id }}</th>
                  <th>{{ $data->name }}</th>
                </tr>
              @endforeach
            </table>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection