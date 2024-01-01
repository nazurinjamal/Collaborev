@extends('admin.leader_master')
@section('admin')

@php

$id = Auth::user()->id;
$adminData = App\Models\User::find($id);

@endphp

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{$adminData->role}} Dashboard</h4>


                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Collaborev</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <h6>Hi, {{$adminData->name}}. Welcome to Collaborev!</h6>
        </div>
        <!-- end page title -->

        @php
        $reviewLeader = Auth::user()->id;
        $documents = App\Models\Document::where('review_leader_id', $reviewLeader)->get();

        $documentAssigned = App\Models\Document::where('review_leader_id', $reviewLeader)
        ->whereNotNull('reviewer1_id')
        ->whereNotNull('reviewer2_id')
        ->whereNotNull('reviewer3_id')
        ->get();

        $documentValidate = App\Models\Document::where('review_leader_id', $reviewLeader)
        ->where('status','Unvalidated')->get();

        $reviewers = App\Models\User::where('role', 'Reviewer')->get();

        @endphp   

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Documents</p>
                                <h4 class="mb-2">{{ $documents->count() }}</h4>
                                <p class="text-muted mb-0"><span class="text-primary fw-bold font-size-13 me-2">Total number of documents.</span></p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-white text-primary rounded-3">
                                    <i class=" ri-file-copy-2-line font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Assigned Documents</p>
                                <h4 class="mb-2">{{ $documentAssigned->count() }}</h4>
                                <p class="text-muted mb-0"><span class="text-pink fw-bold font-size-13 me-2">Total number of assigned documents</span></p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-white text-pink rounded-3">
                                    <i class="ri-team-line font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <br><br>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Validation Needed</p>
                                <h4 class="mb-2">{{ $documentValidate->count() }}</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-13 me-2">Total number of documents need to be validated.</span></p>
                               
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-white text-success rounded-3">
                                    <i class="ri-checkbox-multiple-line font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            
            <div class="col-xl-3 col-md-6"">
                <div class="text-center" dir="ltr">
                    <h5 class="font-size-14 mb-3">Today's Energy</h5>
                    <input class="knob" data-width="150" data-angleoffset="90" data-linecap="round" data-fgcolor="#FFA000" value="69">
                </div>
            </div>
            
        </div><!-- end row -->
                        
        <div class="row mb-4">
            <div class="col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <button type="button" class="btn font-16 btn-primary waves-effect waves-light w-100"
                            id="btn-new-event" data-bs-toggle="modal" data-bs-target="#event-modal">
                            Create New Event
                        </button>

                        <div id="external-events">
                            <br>
                            <p class="text-muted">Drag and drop your event or click in the calendar</p>
                            <div class="external-event fc-event bg-success" data-class="bg-success" style="border: none;">
                                <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Check Report
                            </div>
                            <div class="external-event fc-event bg-info" data-class="bg-info" style="border: none;">
                                <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                            </div>
                            <div class="external-event fc-event bg-warning" data-class="bg-warning" style="border: none;">
                                <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Assign Reviewers
                            </div>
                            <div class="external-event fc-event bg-danger" data-class="bg-danger" style="border: none;">
                                <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Validate Document
                            </div>
                            <div class="external-event fc-event bg-pink" data-class="bg-pink" style="border: none;">
                                <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Company Lunch 
                            </div>
                            <div class="external-event fc-event bg-dark" data-class="bg-dark" style="border: none;">
                                <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Call Author 
                            </div>
                        
                        </div>
                        
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-xl-9">
                <div class="card mb-0">
                    <div class="card-body" >
                        <div id="calendar" style="border: none;"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row-->
        <div style='clear:both'></div>
            
        <!-- Add New Event MODAL -->
        <div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-3 px-4">
                        <h5 class="modal-title" id="modal-title">Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Event Name</label>
                                        <input class="form-control" placeholder="Insert Event Name" type="text"
                                            name="title" id="event-title" required value="">
                                        <div class="invalid-feedback">Please provide a valid event name
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" name="category" id="event-category">
                                            <option  selected> --Select-- </option>
                                            <option value="bg-danger">Danger</option>
                                            <option value="bg-success">Success</option>
                                            <option value="bg-primary">Primary</option>
                                            <option value="bg-info">Info</option>
                                            <option value="bg-dark">Dark</option>
                                            <option value="bg-warning">Warning</option>
                                            <option value="bg-pink">Pink</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a valid event
                                            category</div>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row-->
                            <div class="row mt-2">
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger"
                                        id="btn-delete-event">Delete</button>
                                </div> <!-- end col-->
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-light me-1"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                </div> <!-- end col-->
                            </div> <!-- end row-->
                        </form>
                    </div>
                </div>
                <!-- end modal-content-->
            </div>
            <!-- end modal dialog-->
        </div>
        <!-- end modal-->

            
    </div>
</div>

@endsection