@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <center>
                        <img class="rounded-circle avatar-xl mt-3" src="{{ (!empty($adminData->profile_image)) ? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                    </center>
                    <div class="card-body">
                       <table width="300px">
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                {{ $adminData->name }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                :
                            </td>
                            <td>
                                {{ $adminData->email }}
                            </td>
                        </tr>

                       </table>

                       <center class="mt-3">
                        <a href="{{ route('admin.profile.edit') }}">
                            <button class="btn btn-primary btn-rounded waves-effect waves-light">
                             Edit Profile
                            </button>
                         </a>
                       </center>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
