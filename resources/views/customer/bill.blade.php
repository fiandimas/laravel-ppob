@extends('customer/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar Tagihan</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            @if (session('fail') || $errors->has('photo'))
              <div class="alert alert-danger">
                {{ session('fail') }} {{ $errors->first('photo') }}
              </div>
            @elseif (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <table class="table table-striped table-bordered">
              <tr>
                <th>ID</th>
                <th>Bulan</th>
                <th>Grandtotal</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              @foreach ($bill as $data)
                <tr>
                  <td>{{ $data->id }}</td>
                  <td>{{ $month[$data->month].' '.$data->year }}</td>
                  <td>Rp. {{ $data->cost * $data->total_meter + 10000 }}</td>
                  <td>
                    @if ($data->bukti)
                    <img src="{{ asset('images/customer/bill').'/'.$data->bukti }}" height="50px">
                    @else

                    @endif
                    
                  </td>
                  <td>{{ $status[$data->status]}}</td>
                  <td>
                    @if ($data->status == 'n' || $data->status == 'p' || $data->status == 'r' || $data->status == '')
                      <a href="#edit" class="btn btn-warning" data-toggle="modal" onclick="get({{ $data->id }},{{ $data->cost * $data->total_meter }})">Upload</a>
                    @else
                      {{ $status[$data->status]}}
                    @endif
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
        <h4 class="modal-title">Upload bukti pembayaran</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('bill/confirm') }}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="id_bill">
          <input type="hidden" name="total" id="total">
          <input type="file" class="form-control" name="photo">
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
  function get(id_tagihan,total){
		$("#id_bill").val(id_tagihan);
    $("#total").val(total);
	}

</script>
@endsection