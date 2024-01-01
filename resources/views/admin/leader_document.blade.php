@extends('admin.admin_document_leader')
@section('admin')

  <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Review Leader | Documents</h4>                  
                    <div class="page-title-right">                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/reviewleader/dashboard">Collaborev</a></li>
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
                        $reviewLeader = Auth::user()->id;
                        $documents = App\Models\Document::where('review_leader_id', $reviewLeader)->get();

                        $reviewers = App\Models\User::where('role', 'Reviewer')->get();

                        $documentAssigned = App\Models\Document::where('review_leader_id', $reviewLeader)
                        ->whereNotNull('reviewer1_id')
                        ->whereNotNull('reviewer2_id')
                        ->whereNotNull('reviewer3_id')
                        ->count();

                        @endphp   

                        <!-- Table of Documents Added -->
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Author</th>
                                        <th>Name</th>
                                        <th>No. of Requirements</th>
                                        <th></th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($documents as $document)

                                    @php
                                    $documentAssigned = App\Models\Document::where('review_leader_id', $reviewLeader)
                                    ->whereNotNull('reviewer1_id')
                                    ->whereNotNull('reviewer2_id')
                                    ->whereNotNull('reviewer3_id')
                                    ->count();

                                    @endphp
                            
                                    <tr>
                                        <td><h6 class="mb-0">{{ $document->user->name }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->docname }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->requirements->count() }} </h6></td>
                                        <td>
                                        @if ($document->reviewer1_id != NULL)
                                            <button type="button" class="btn btn-secondary" disabled>
                                            <i class="ri-team-line align-middle "></i> Assigned </button>

                                            @else
                                            <button type="button" class="btn btn-primary" 
                                                data-bs-toggle="modal" data-bs-target="#exampleModal{{ $document->id }}"
                                                data-document-id="{{ $document->id }}"
                                                data-document-name="{{ $document->docname }}"
                                                ><i class="ri-team-line align-middle "></i> Assign Reviewers</button>
                                                
                                        @endif
                                        
                                        </td>
                                                                                                                   
                                    </tr> 

                                    <form action="/reviewleader/storeReviewer/{{ $document->id }}" method="POST" enctype="multipart/form-data">                        
                                    <div class="modal fade"id="exampleModal{{ $document->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                <input type="hidden" id="document_id_input" name="document_id" value="{{ $document->id }}">
                                                <h5 class="modal-title" id="exampleModalLabel">For <i>{{ $document->docname }}</i><span
                                                        id="document_id{{ $document->id }}"></span></h5>
                                        
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        @csrf
                                                    <div class="row">
                                                        <div class="col-l">
                                                            <div class="input-group mb-3">
                                                                <select id="reviewer1" class="form-control mt-1 w-full" type="text" name="reviewer1">
                                                                    <option>Choose Reviewer 1</option>
                                                                    @foreach ($reviewers as $reviewer)                                   
                                                                        <option value="{{ $reviewer->id }}">{{ $reviewer->name }}</option>                                  
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-3">                            
                                                                <select id="reviewer2" class="form-control mt-1 w-full" type="text" name="reviewer2">
                                                                    <option>Choose Reviewer 2</option>
                                                                    @foreach ($reviewers as $reviewer)                                
                                                                        <option value="{{ $reviewer->id }}">{{ $reviewer->name }}</option>                             
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <select id="reviewer3" class="form-control mt-1 w-full " type="text" name="reviewer3">
                                                                    <option>Choose Reviewer 3</option>
                                                                    @foreach ($reviewers as $reviewer)                                
                                                                        <option value="{{ $reviewer->id }}">{{ $reviewer->name }}</option>                         
                                                                        @endforeach
                                                                </select>
                                                            </div>

                                                            <button class="btn btn-success mt-1 w-full" style="float: right;" type="submit">Assign</button>
                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end modal -->
                                    </form>
                                    <!-- end -->
                                    @endforeach
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div><!-- end table-responsive -->
                    </div><!-- end card-body -->
                </div><!-- end card -->

@push('scripts')
<script>
    const modals = document.querySelectorAll('.modal');

    modals.forEach(function (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const documentId = button.getAttribute('data-document-id');
            const documentName = button.getAttribute('data-document-name');

            // Set the selected document information in the modal
            document.getElementById('document_id' + documentId).textContent = documentName;

            // Set the selected document information in the form
            document.getElementById('document_id_input').value = documentId;
        });
    });
</script>
@endpush

            </div><!-- end col -->
        </div><!-- end row -->

  @endsection