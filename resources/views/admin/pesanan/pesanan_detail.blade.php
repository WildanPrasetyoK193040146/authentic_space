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
                                       <label for="" class="col-sm-2 col-form-label form-control">Fahri Muzakki</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">No Meja</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">001</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal Pesanan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">1</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Total Tagihan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">Rp.57.000</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Status Pembayaran</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">Sudah Dibayar</label>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Menu</label>
                                    <div class="col form-control">
                                       <table>
                                        <tr>
                                            <td>Es batu</td>
                                        </tr>
                                        <tr>
                                            <td>Es buah</td>
                                        </tr>
                                       </table>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Pesanan</label>
                                    <div class="col-sm-10">
                                       <label for="" class="col-sm-2 col-form-label form-control">1</label>
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
