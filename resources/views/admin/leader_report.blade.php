@extends('admin.admin_document_leader')
@section('admin')

  <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Review Leader | Reports</h4>                  
                    <div class="page-title-right">                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/reviewleader/dashboard/">Collaborev</a></li>
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
    
                        @php
                        $reviewLeader = Auth::user()->id;
                        $documents = App\Models\Document::where('review_leader_id', $reviewLeader)->get();
                        @endphp   

                        <!-- Table of Documents Added -->
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>No. of Requirements</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($documents as $index => $document)
                            
                                    <tr>
                                        <td><h6 class="mb-0">{{ $index + 1 }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->docname }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->requirements->count() }} </h6></td>
                                        <td>
                                        @php
                                            $status = $document->status;
                                            
                                            @endphp
                                            @if ($status === 'Validated')
                                            <h6 name="status" class="mb-0" style="color:green;">
                                                Validated</h6>

                                            @elseif ($status === 'Unvalidated')
                                            <h6 name="status" class="mb-0" style="color:red;">
                                                Unvalidated</h6>

                                            @else
                                            <h6 name="status" class="mb-0" style="color:orange;">
                                                In Progress</h6>
                                            @endif
                                        </td>

                                        @php
                                        $reviewedCount = App\Models\Reviewer::where('document_id', $document->id)
                                                ->where('review_status', 'Reviewed')
                                                ->count();
                                        @endphp
                                        <td>
                                            <form action="{{ route('validate', ['document' => $document->id]) }}" method="GET" id="validateForm">

                                            @if ($document->reviewer1_id == NULL)
                                            <center><button type="button" class="btn btn-secondary" disabled>
                                                No Reviewers Assigned</button></center>     
                                                
                                            @elseif ($status === 'Validated')
                                                <center><button type="button" class="btn btn-success" disabled>
                                                Validated</button></center>
                                          

                                            @elseif ($reviewedCount === 3 && $document->reviewer1_id != NULL)
                                            <center><button type="submit" class="btn btn-success" 
                                                data-document-id="{{ $document->id }}"
                                                data-document-name="{{ $document->docname }}"
                                                ><i class="ri-task-line align-middle"></i> Validate</button></center>
                                            
                                            @else
                                            <center><button type="button" class="btn btn-warning">
                                                Review Ongoing</button></center>
                                                
                                            @endif


                                                
                                            </form>
                                        </td>
                                                                                                                   
                                    </tr> 

                                    <!-- end -->
                                    @endforeach
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div><!-- end table-responsive -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

  @endsection