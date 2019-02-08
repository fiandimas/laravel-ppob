@extends('admin/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar Pembayaran</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <table class="table table-striped table-bordered">
              <tr>
                <th>No. KWH</th>
                <th>Nama Pelanggan</th>
                <th>Tgl. Pembayaran</th>
                <th>Bulan Bayar</th>
                <th>Biaya Admin</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
              </tr>
              @foreach ($payment as $data)
              <tr>
                <td>{{ $data->name }}</th>
                <td>{{ $data->kwh_number }}</th>
                <td>{{ $data->date }}</th>
                <td>{{ $month[$data->id_month] }} - {{ $data->year }}</th>
                <td>{{ $data->admin_cost }}</th>
                <td>{{ $data->total }}</th>
                <td>{{ $status[$data->status] }}</th>
                <td>
                  @if ($data->bukti)
                    <img src="{{ asset('images/customer/bill').'/'.$data->bukti }}" height="50px">
                  @endif
                </th>
                <td>
                  <a href="{{ url('admin/payment/accept').'/'.$data->id.'/'.$data->id_bill }}" class="btn btn-success" onclick="return confirm('Are you sure to accept this item?')">Lunas</a>
                  <a href="{{ url('admin/payment/reject').'/'.$data->id.'/'.$data->id_bill }}" class="btn btn-danger" onclick="return confirm('Are you sure to reject this item?')">Tolak</a>
                </th>
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