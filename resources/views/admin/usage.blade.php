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
                    <a href="#edit" class="btn btn-warning" data-toggle="modal" onclick="get(1)">Edit</a>
                    <a href="{{ url('admin/customer/delete').'/'.$data->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this level ?')">Delete</a>
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