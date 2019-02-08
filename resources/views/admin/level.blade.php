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
                <th>Aksi</th>
              </tr>
              @foreach ($level as $data)
                <tr>
                  <th>{{ $no++ }}</th>
                  <th>{{ $data->id }}</th>
                  <th>{{ $data->name }}</th>
                  <th>
                    <a href="#edit" class="btn btn-warning" data-toggle="modal" onclick="get(1)">Edit</a>
                    <a href="{{ url('admin/level/delete').'/'.$data->id }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this level ?')">Delete</a>
                  </th>
                </tr>
              @endforeach
            </table>
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