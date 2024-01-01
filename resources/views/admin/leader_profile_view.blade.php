@extends('admin.leader_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Review Leader | Profile</h4>
                    
                    <div class="page-title-right">
                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Collaborev</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

<div class="row">
    <center>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <center>
                <img class="rounded-circle avatar-xl" src="{{ (!empty($adminData->profile_picture))? url('upload/admin_images/'.$adminData->profile_picture): url('upload/no_image.jpg') }}" alt="Card image cap">
                </center>
                <div class="card-body">
                    <h4 class="card-title">Name : {{$adminData->name}}</h4>
                    <hr>
                    <h4 class="card-title">Email : {{$adminData->email}}</h4>
                    <hr>
                    <h4 class="card-title">Username : {{$adminData->username}}</h4>
                    <hr>
                    <center><a href="{{route('edit.profile')}}" class="btn btn-info waves-effect waves-light"> Edit Profile</a></center>            
                </div>
            </div>
        </div>
    </div>
    </center>
</div>



</div>
</div>

@endsection
