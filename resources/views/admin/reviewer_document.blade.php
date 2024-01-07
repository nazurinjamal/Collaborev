@extends('admin.admin_document_reviewer')
@section('admin')

  <div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Reviewer | Documents</h4>                  
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
                        })->get();

                        @endphp   

                        <!-- Table of Documents Added -->
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Document Name</th>
                                        <th>No. of Requirements</th>
                                        <th>Assigned By</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($documents as $index => $document)
                            
                                    <tr>
                                        <td><h6 class="mb-0">{{ $index + 1 }}</h6></td>
                                        
                                    
                                        <td><h6 class="mb-0">{{ $document->docname }}</h6></td>
                                        <td><h6 class="mb-0"><center>{{ $document->requirements->count() }} </center></h6></td>
                                        <td><h6 class="mb-0">{{ $document->reviewLeader->name }}</h6></td>
                                        <td>
                                            @php
                                                $reviewerStatus = $document->reviewers()->where('reviewer_id', auth()->id())->value('review_status');
                                            @endphp
                                            @if ($reviewerStatus === 'Reviewed')
                                            <h6 name="status" class="mb-0" style="color:green;">
                                                Reviewed</h6>

                                            @else
                                            <h6 name="status" class="mb-0" style="color:red;">
                                                Unreviewed</h6>
                                                
                                            @endif
                                        
                                        </td>
                                        <td>
                                        <form action="{{ route('review', ['document' => $document->id]) }}" method="GET" id="reviewForm">
                                            @csrf
                                            <input type="hidden" name="document_id" id="document_id_input">
                                            <input type="hidden" name="document_name" id="document_name_input">
                                            
                                

                                            @if ($reviewerStatus === 'Reviewed')
                                            <button type="button" class="btn btn-secondary" disabled>
                                                <i class="ri-edit-2-line align-middle"></i> Review</button>

                                            @else
                                                <button type="submit" class="btn btn-success review-button"
                                                 data-document-id="{{ $document->id }}"
                                                data-document-name="{{ $document->docname }}">
                                                <i class="ri-edit-2-line align-middle"></i> Review</button>
                                                
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
    </div><!-- end container-fluid -->
</div><!-- end page-content -->

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const reviewButtons = document.querySelectorAll('.review-button');
    const documentIdInput = document.getElementById('document_id_input');
    const documentNameInput = document.getElementById('document_name_input');

    reviewButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const documentId = this.getAttribute('data-document-id');
            const documentName = this.getAttribute('data-document-name');

            // Set the values in the form inputs
            documentIdInput.value = documentId;
            documentNameInput.value = documentName;

            // Submit the form
            document.getElementById('reviewForm').submit();
        });
    });
});
    </script>
@endpush




@endsection
