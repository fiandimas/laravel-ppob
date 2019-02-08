@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar Tarif</h2>
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
                <th>Power</th>
                <th>Cost</th>
                <th>Aksi</th>
              </tr>
              @foreach ($cost as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->id }}</td>
                  <td>{{ $data->power }}</td>
                  <td>{{ $data->cost }}</td>
                  <td>
                    <a href="#edit" class="btn btn-warning" data-toggle="modal" onclick="get({{ $data->id }},{{ $data->power}}, {{ $data->cost }})">Edit</a>
                    <a href="{{ url('admin/cost/delete').'/'.$data->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this level ?')">Delete</a>
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
          <div class="col-md-5">
            <form id="sign_in" method="POST" action="{{ url('admin/cost/add') }}">
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
              <input type="text" class="form-control" name="power" placeholder="Daya">
              <p>{{ $errors->first('power') }}</p>
              <input type="text" class="form-control" name="cost" placeholder="Tarif/KWH">
              <p>{{ $errors->first('cost') }}</p>          
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
        <form action="{{ url('admin/cost/update') }}" method="post">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          Daya
          <input type="number" class="form-control" name="power" id="power" required>
          <br>
          Tarif
          <input type="number" class="form-control" name="cost" id="cost" required>
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
  function get(id,power,cost){
    $("#id").val(id);
    $("#power").val(power);
    $("#cost").val(cost);
  }  
</script>
@endsection