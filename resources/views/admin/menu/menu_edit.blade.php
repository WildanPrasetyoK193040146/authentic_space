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
                            <h4 class="card-title">Ubah Menu</h4>
                            <form action="{{ route('update.menu') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $menu->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Menu</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text" value="{{ $menu->name }}"  id="example-text-input">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                    <select name="category" class="form-select" aria-label="Default select example">
                                        <option value="Makanan Berat" {{ $menu->category == 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                                        <option value="Makanan Ringan" {{ $menu->category == 'Makanan Ringan' ? 'selected' : '' }}>Makanan Ringan</option>
                                        <option value="Minuman Kopi" {{ $menu->category == 'Minuman Kopi' ? 'selected' : '' }}>Minuman Kopi</option>
                                        <option value="Minuman Non Kopi" {{ $menu->category == 'Minuman Non Kopi' ? 'selected' : '' }}>Minuman Non Kopi</option>
                                    </select>
                                    @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                   </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Harga</label>
                                    <div class="col-sm-10">
                                        <input name="price" class="form-control" type="text" value="{{ $menu->price }}" id="example-text-input">
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Gambar</label>
                                    <div class="col-sm-10">
                                        <input name="image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg mt-3" src="{{ (!empty($menu->image)) ? url($menu->image):url('upload/no_image.jpg') }}" alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" value="Ubah Menu" class="btn btn-info waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
    </div>
</div>

{{-- Javascript --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            e.preventDefault();
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
    </script>

@endsection
