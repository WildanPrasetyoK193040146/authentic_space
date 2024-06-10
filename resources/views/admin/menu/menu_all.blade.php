@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Semua Menu</h4>
                </div>
                <div>
                    <a href="{{ url('/menu/add') }}"><button class="btn btn-success sm">Tambah Menu</button></a>
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
                                <th>Gambar</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    ($i=1)
                                @endphp
                                  @foreach ($allMenu as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><img src="{{ asset($item->image) }}" alt="" style="width: 60px; height:60px;"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ format_rupiah($item->price) }}</td>
                                <td>{{ $item->category }}</td>
                                <td>
                                    <a href="{{ route('edit.menu',$item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('delete.menu', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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
