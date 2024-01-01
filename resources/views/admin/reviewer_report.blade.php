@extends('admin.admin_document_reviewer')
@section('admin')

  <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Reviewer | Reports</h4>                  
                    <div class="page-title-right">                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Collaborev</a></li>
                            <li class="breadcrumb-item active">Document</li>
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
                        $reviewer = Auth::user()->id;
                        $documents = App\Models\Document::where(function ($query) use ($reviewer) {
                            $query->where('reviewer1_id', $reviewer)
                                ->orWhere('reviewer2_id', $reviewer)
                                ->orWhere('reviewer3_id', $reviewer);
                        })
                        ->get();

                        @endphp   

                        <!-- Table of Documents Added -->
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Document Name</th>
                                        <th>No. of Requirements</th>
                                        <th>Created By</th>
                                        <th>Assigned By</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>


                                @forelse ($documents as $document)
                                    <tr>

                                            @php
                                                $reviewerStatus = $document->reviewers()->where('reviewer_id', auth()->id())->value('review_status');
                                                $reviewerFeedback = $document->feedbacks()->where('user_id', auth()->id())->get();
                                            @endphp

                                        <td><h6 class="mb-0">{{ $document->docname }}</h6></td>
                                        <td><h6 class="mb-0"><center>{{ $document->requirements->count() }}</center> </h6></td>
                                        <td><h6 class="mb-0">{{ $document->author->name }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->reviewLeader->name }}</h6></td>
                                        @if ($reviewerStatus === 'Reviewed')
                                            <td><h6 class="mb-0 text-success">Reviewed</h6></td>
                                        @else
                                            <td><h6 class="mb-0 text-danger">Unreviewed</h6></td>
                                        @endif
                                        
                                            <td >
                                        @if ($reviewerStatus === 'Reviewed')
                                        <button type="button" class="btn btn-outline-dark "
                                        data-bs-toggle="modal" data-bs-target="#myLargeModalLabel{{ $document->id }}"
                                        data-document-id="{{ $document->id }}"
                                        data-document-name="{{ $document->docname }}">
                                            <i class="ri-file-list-line align-middle me-2"></i>View Feedback
                                        </button>  
                                        @else
                                        <button type="button" class="btn btn-outline-dark " disabled>
                                            <i class="ri-file-list-line align-middle me-2"></i>View Feedback
                                        </button>  

                                        @endif

                                        </td>
                                        <!-- View Document form -->
                                    <div class="modal fade" id="myLargeModalLabel{{ $document->id }}" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <input type="hidden" id="document_id_input{{ $document->id }}" name="document_id" value="{{ $document->id }}">
                                                    <h5 class="modal-title" id="myLargeModalLabel{{ $document->id }}"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                    
                                                                    <h4 class="card-title"><center>{{ $document->docname }}</center></h4> <hr>
                                                                        
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                        @foreach ($reviewerFeedback as $feedback)
                                                                        <ul>
                                                                        <li>
                                                                        <h6><b style="color:brown;">Question : </b>{{ $feedback->question }}</h6>
                                                                        <h6><b style="color:brown;">Comply : </b>{{ $feedback->comply }}</h6>
                                                                        <h6><b style="color:brown;">Feedback : </b>{{ $feedback->feedback ?? 'No feedback provided' }}</h6>
                                                                        
                                                                        </li>
                                                                        </ul>
                                                                        <hr>
                                                                        @endforeach
                                                                        </div>
                                                                    </div>                                                                   
                                                            </div><!-- end card-body -->
                                                        </div><!-- end card -->
                                                    </div><!-- end col -->            
                                                </div><!-- end row -->
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div>
                                    </div>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No completed documents found.</td>
                                    </tr>
                                @endforelse
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div><!-- end table-responsive -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

  @endsection