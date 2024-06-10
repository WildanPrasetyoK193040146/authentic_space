@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ubah Password Admin</h4>

                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                                @endforeach
                            @endif

                            <form action="{{ route('admin.update.password') }}" method="post" class="mt-4">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Password Lama</label>
                                    <div class="col-sm-10">
                                        <input name="oldpassword" class="form-control" type="password"  id="oldpassword">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Password Baru</label>
                                    <div class="col-sm-10">
                                        <input name="newpassword" class="form-control" type="password"  id="newpassword">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                    <div class="col-sm-10">
                                        <input name="confirmpassword" class="form-control" type="password"  id="confirmpassword">
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" value="Ubah Password" class="btn btn-info waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
    </div>
</div>


@endsection
