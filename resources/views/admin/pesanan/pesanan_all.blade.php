@extends('admin.admin_master')
@section('admin')

@php
use Carbon\Carbon;
@endphp

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Semua Pesanan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Jumlah Pesanan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Total</th>
                                <th>No Meja</th>
                                <th>Status Pembayaran</th>
                                <th>Status Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    ($i=1)
                                @endphp
                                 @foreach ($allTransaction as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ Carbon::parse($item->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>{{ format_rupiah($item->total) }}</td>
                                <td>{{ $item->table_number }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->status_pesanan }}</td>
                                <td>
                                    @if ($item->status === 'pending')
                                    <form action="{{ route('update.success') }}" method="POST" class="form-update-status" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-success sm" title="Accept"><i class="fa fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('update.reject') }}" method="POST" class="form-update-status" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger sm" title="Cancel"><i class="fa fa-times"></i></button>
                                    </form>
                                    <a href="{{ route('detail.pesanan', $item->id) }}" class="btn btn-info sm" title="Detail Data"><i class="fa fa-eye"></i></a>
                                @elseif ($item->status === 'success')
                                @if ($item->status_pesanan === 'belum diterima')
                                <form action="{{ route('update.diterima') }}" method="POST" class="form-update-status" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success sm">Diterima</button>
                                </form>
                                @endif
                                <a href="{{ route('detail.pesanan', $item->id) }}" class="btn btn-info sm" title="Detail Data"><i class="fa fa-eye"></i></a>
                                @elseif ($item->status === 'reject')
                                <a href="{{ route('detail.pesanan', $item->id) }}" class="btn btn-info sm" title="Detail Data"><i class="fa fa-eye"></i></a>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
@endsection

  {{-- Format Rupiah --}}
  @php
  function format_rupiah($number){
      return 'Rp. ' . number_format($number, 2, ',', '.');
  }
  @endphp
