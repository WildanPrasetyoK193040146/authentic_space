@extends('admin.admin_master')
@section('admin')
{{-- Jquery CDN --}}
<script src="{{ asset('backend/assets/js/pages/jquery-3.7.1.min.js') }}"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    }
</style>

@php
use Carbon\Carbon;
@endphp

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Kelola Pesanan</h4>
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ $transaction->customer_name }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">No Meja</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ $transaction->table_number }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal Pesanan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ Carbon::parse($transaction->created_at)->format('d/m/Y H:i:s') }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Total Tagihan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ format_rupiah($transaction->total) }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status Pembayaran</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ $transaction->status }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status Pesanan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ $transaction->status_pesanan }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Menu</label>
                                    </div>
                                    <div class="col-10">
                                        <table border="3" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Menu</th>
                                                    <th>Jumlah</th>
                                                    <th>Catatan</th>
                                                </tr>
                                                </thead>
                                            <tbody>
                                                @php
                                                ($i=1)
                                                @endphp

                                                @foreach($transaction->transaction_menu as $menu)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $menu->menu->name }}</td>
                                                    <td>{{ $menu->quantity }}</td>
                                                    <td>{{ $menu->note }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                           </table>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Total Pesanan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">{{ $transaction->quantity }}</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <a class="btn btn-info waves-effect waves-light" href="{{ url('/pesanan/all') }}">Selesai</a>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
    </div>
</div>

@endsection

  {{-- Format Rupiah --}}
  @php
  function format_rupiah($number){
      return 'Rp. ' . number_format($number, 2, ',', '.');
  }
  @endphp
