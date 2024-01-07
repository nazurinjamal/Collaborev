@extends('admin.admin_document')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Author | Reports</h4>
                    
                    <div class="page-title-right">
                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Collaborev</a></li>
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        @php
        $userId = Auth::user()->id;
        $user = App\Models\User::with(['documents' => function ($query) {
            $query->withCount('requirements')
            ->with('requirements');
        }])->find($userId);                         
        $reviewLeaders = App\Models\User::where('role', 'Review Leader')
        ->get();
        
    

        @endphp   
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table of Documents Added -->
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>No. of Requirements</th>
                                        <th>Review Leader</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($user->documents as $index => $document)
                                    <tr>
                                        <td><h6 class="mb-0">{{ $index + 1 }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->docname }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->requirements_count }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->reviewLeader->name }}</h6></td>     
                                        <td>
                                            @if($document->status === 'Validated')
                                                    <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> {{ $document->status }}
                                            @else
        
                                                    <i class="ri-checkbox-blank-circle-fill font-size-10 text-danger align-middle me-2"></i> {{ $document->status }}
                                            @endif                            
                                        </td>     

                                        @php
                                            $reviewedCount = App\Models\Reviewer::where('document_id', $document->id)
                                                ->where('review_status', 'Reviewed')
                                                ->count();
                                        @endphp

                                        <td>
                                        @if($reviewedCount === 3 && $document->status === 'Validated') 
                                            <div class="progress mb-4">
                                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" 
                                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            @elseif($reviewedCount === 3) 
                                            <div class="progress mb-4">
                                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" 
                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        
                                            @elseif($reviewedCount === 2)
                                            <div class="progress mb-4">
                                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" 
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            @elseif($reviewedCount === 1)
                                            <div class="progress mb-4">
                                                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" 
                                                style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            @else
                                            <div class="progress mb-4">
                                                <div class="progress-bar progress-bar-striped" role="progressbar" 
                                                style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @endif
                                    
                                        <form action="{{ route('report', ['document' => $document->id]) }}" method="GET" id="reviewForm">
                                            @csrf
                                            <input type="hidden" name="document_id" id="document_id_input" value="">
                                            <input type="hidden" name="document_name" id="document_name_input" value="">
                                            
                                            @if ($document->status === 'Validated')
                                            <center><button type="submit" class="btn btn-success review-button"
                                            data-document-id="{{ $document->id }}"
                                            data-document-name="{{ $document->docname }}"
                                            ><i class="   ri-file-list-2-line align-middle"></i> View Report</button></center>

                                            @else
                                                <!-- The button will not be shown or disabled if the status is Complete -->
                                                <center><button type="button" class="btn btn-secondary" disabled>
                                                <i class="   ri-file-list-2-line align-middle"></i> View Report</button></center>
                                            @endif
                                        </form>
                                        </td>                                                                                                            
                                    </tr>
                                    @endforeach 
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div><!-- end table-responsive -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
            
        </div>
        <!-- end row -->
    </div>

</div>

@endsection