@extends('teller/template')
@section('content')
<div class="row clearfix">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="header">
        <div class="row clearfix">
          <div class="col-xs-12 col-sm-6">
            <h2>Daftar History</h2>
          </div>
        </div>
      </div>
      <div class="body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped table-bordered">
              <tr>
                <th>No. KWH</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Bayar</th>
                <th>Bulan Bayar</th>
                <th>Ongkos Admin</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Admin</th>
              </tr>
              @foreach ($history as $data)
                <tr>
                  <td>{{ $data->kwh_number }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->date }}</td>
                  <td>{{ $month[$data->id_month].' '.$data->year }}</td>
                  <td>{{ $data->admin_cost }}</td>
                  <td>{{ $data->total }}</td>
                  <td>{{ $status[$data->status] }}</td>
                  <td><img src="{{ asset('images/customer/bill').'/'.$data->bukti }}" height="50px"></td>
                  <td>{{ $data->aname }}</td>
                </tr>
              @endforeach
            </table>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection