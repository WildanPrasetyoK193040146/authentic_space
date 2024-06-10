@extends('admin.admin_master')
@section('admin')

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
                                <th>Status Pesanan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    ($i=1)
                                @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-success sm" title="Accept"><i class="fa fa-check"></i></a>
                                    <a href="" class="btn btn-danger sm" title="Cancel"><i class="fa fa-times"></i></a>
                                    <a href="{{ route('detail.pesanan') }}" class="btn btn-info sm" title="Detail Data"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
@endsection
