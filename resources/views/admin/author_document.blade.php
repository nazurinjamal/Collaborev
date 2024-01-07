@extends('admin.admin_document')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Author | Documents</h4>                  
                    <div class="page-title-right">                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/author/dashboard">Collaborev</a></li>
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
                        <!-- Add Project Button -->
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#addreq">
                                            <i class="ri-add-line align-middle me-2"></i>Add Project</button>
                        <!-- Upload Document Button -->
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="ri-add-line align-middle me-2"></i>Upload Document</button>                                                                      
                        <br><br>
                        @php
                        $author = Auth::user()->id;
                        $documents = App\Models\Document::where('user_id', $author)->get();                  
                            $reviewLeaders = App\Models\User::where('role', 'Review Leader')
                            ->get();
                            
                        @endphp   

                        <!-- Table of Documents -->
                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light"> 
                                    <tr>
                                        <th><h6 class="mb-0">No.</h6></th>
                                        <th><h6 class="mb-0">Name</h6></th>
                                        <th><h6 class="mb-0">No. of Requirements</h6></th>
                                        <th><h6 class="mb-0">Assigned Review Leader</h6></th>
                                        <th></th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($documents as $index => $document)
                                    <tr>
                                        <td><h6 class="mb-0">{{ $index + 1 }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->docname }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->requirements->count() }}</h6></td>
                                        <td><h6 class="mb-0">{{ $document->reviewLeader->name }}</h6></td>  
                                        <td>
                                        <button type="button" class="btn btn-primary " 
                                        data-bs-toggle="modal" data-bs-target="#myLargeModalLabel{{ $document->id }}"
                                        data-document-id="{{ $document->id }}"
                                        data-document-name="{{ $document->docname }}">
                                            <i class="ri-file-list-line align-middle me-2"></i>View Document
                                        </button>      
                                        </td>                                                                             
                                    </tr>
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
                                                                        @foreach ($document->requirements as $requirement)
                                                                        <ul>
                                                                        <li>
                                                                        <h6><b style="color:brown;">Tag : </b>{{ $requirement->tag }}</h6>
                                                                        <h6><b style="color:brown;">Type : </b>{{ $requirement->type }}</h6>
                                                                        <h6><b style="color:brown;">Module : </b>{{ $requirement->module }}</h6>
                                                                        <h6><b style="color:brown;">Description : </b>{{ $requirement->description }}</h6>
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
                                    @endforeach 
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div><!-- end table-responsive -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
@push('scripts')
<script>
    const modals = document.querySelectorAll('.modal');

    modals.forEach(function (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const documentId = button.getAttribute('data-document-id');
            const documentName = button.getAttribute('data-document-name');
            const modalTitle = modal.querySelector('.modal-title');
            const tableBody = modal.querySelector('.table tbody');
            const requirementsTable = document.querySelector(`#requirementsTable${documentId} tbody`);

            // Set the selected document information in the modal
            modalTitle.textContent = documentName;

            // Clear the table body
            tableBody.innerHTML = '';

            // Generate HTML for requirements and append to the table body
            
            // Set the selected document information in the form
            const documentIdInput = modal.querySelector('.document_id_input');
            if (documentIdInput) {
                documentIdInput.value = documentId;
            }
        });
    });
</script>
@endpush
            </div> <!-- col -->
         </div> <!-- row -->
    </div> <!-- end container-fluid -->
</div> <!-- end page-content-->
@endsection


<!-- New Requirement Form -->
<div class="modal fade" id="addreq" tabindex="-1" role="dialog" aria-labelledby="composemodalsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="composemodalsTitle">New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form method="post" action="/author/document">
                        @csrf
                        <!-- Document Name -->      
                        <div class="row">
                            <div class="col-xl-8">             
                                <x-input-label for="docname" :value="__('Project Name')" />
                                <x-text-input id="docname" class="form-control mt-1 w-full" type="text" name="docname" required />
                            </div>

                            <div class="col-xl-4">             
                                    <x-input-label for="review_leader" :value="__('Review Leader')" />    
                                    <select id="review_leader" class="form-control mt-1 w-full" type="text" name="review_leader"  required>
                                    <option>Choose Review Leader</option>
                                        @foreach ($reviewLeaders as $leader)
                                        <option value="{{ $leader->name }}">{{ $leader->name }}</option>
                                        @endforeach
                                    </select>     
                            </div>
                        </div>

                        <div id="requirements-container">
                            <div class="form-group">
                                <!-- Type -->
                                <div class="mt-4">
                                    <x-input-label for="type" :value="__('Type')" />    
                                    <select id="type" class="form-control mt-1 w-full 
                                    " type="text" name="requirements[0][type]" required autofocus/>
                                    <option value="Functional Requirement">Functional Requirement</option>        
                                    <option value="Non-Functional Requirement">Non-Functional Requirement</option>
                                    <option value="Business Requirement">Business Requirement</option>                
                                    </select>
                                </div>                               
                                <!-- Tag -->
                                <div class="mt-4">
                                    <x-input-label for="tag" :value="__('Tag')" />
                                    <x-text-input id="tag" class="form-control mt-1 w-full" type="text" name="requirements[0][tag]" placeholder="e.g. AUT-01" required />
                                </div>
                                <!-- Module -->
                                <div class="mt-4">
                                    <x-input-label for="module" :value="__('Module')" />
                                    <x-text-input id="module" class="form-control mt-1 w-full" type="text" name="requirements[0][module]" placeholder="e.g. Author's Module" required />
                                </div>
                                <!-- Description -->
                                <div class="mt-4">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" class="form-control mt-1 w-full" type="text" name="requirements[0][description]" placeholder="e.g. The system shall allow authors to add documents." required/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect waves-light" id="add-req">
                                    <i class="ri-add-line align-middle me-2"></i>Add Requirement
                            </button>
                            <x-primary-button class="btn btn-success">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let requirementsContainer = document.getElementById('requirements-container');
let addRequirementButton = document.getElementById('add-req');
let nextRequirementIndex = 1; // Initialize index for new requirements
addRequirementButton.addEventListener (
    
    'click', function() 
    {
        // Create a new requirement container
        let newRequirement = document.createElement('div');
        newRequirement.className = 'form-group';
        newRequirement.id = 'requirement-' + nextRequirementIndex;

        // Create input fields for tag, type, module, and description

        // Type
        let typeLabel = document.createElement('label');
        typeLabel.for = 'requirement-type';
        typeLabel.textContent = 'Type';
        
        let typeSelect = document.createElement('select');
        typeSelect.className = 'form-control  mt-1 w-full';
        typeSelect.name = 'requirements[' + nextRequirementIndex + '][type]';
        
        let typeOptions = ['Functional Requirement', 'Non-Functional Requirement', 'Business Requirement'];
        for (let typeOption of typeOptions) {
        let option = document.createElement('option');
        option.value = typeOption;
        option.textContent = typeOption;
        typeSelect.appendChild(option);
        }

        // Tag 
        let tagLabel = document.createElement('label');
        tagLabel.for = 'requirement-tag';
        tagLabel.textContent = 'Tag';
        
        let tagInput = document.createElement('input');
        tagInput.type = 'text';
        tagInput.className = 'form-control mt-1 w-full';
        tagInput.name = 'requirements[' + nextRequirementIndex + '][tag]';
        tagInput.placeholder = 'e.g. AUT-01';
        tagInput.required = true;

        // Module
        let moduleLabel = document.createElement('label');
        moduleLabel.for = 'requirement-module';
        moduleLabel.textContent = 'Module';
        
        let moduleInput = document.createElement('input');
        moduleInput.type = 'text';
        moduleInput.className = 'form-control mt-1 w-full';
        moduleInput.name = 'requirements[' + nextRequirementIndex + '][module]';
        moduleInput.placeholder = "e.g. Author's Module";
        moduleInput.required = true;

        // Description
        let descriptionLabel = document.createElement('label');
        descriptionLabel.for = 'requirement-description';
        descriptionLabel.textContent = 'Description';
        
        let descriptionInput = document.createElement('input');
        descriptionInput.type = 'text';
        descriptionInput.className = 'form-control mt-1 w-full';
        descriptionInput.name = 'requirements[' + nextRequirementIndex + '][description]';
        descriptionInput.placeholder = 'e.g. The system shall allow authors to add documents.';
        descriptionInput.required = true;

        // Create newline and black horizontal line
        let hr = document.createElement('hr');
        hr.style.border = '1px solid grey';

        // Add newline and line to the new requirement container
        newRequirement.appendChild(document.createElement('br'));
        newRequirement.appendChild(hr);

        // Add input fields to the new requirement container
        newRequirement.appendChild(typeLabel);
        newRequirement.appendChild(typeSelect);
        newRequirement.appendChild(document.createElement('br'));
        newRequirement.appendChild(tagLabel);
        newRequirement.appendChild(tagInput);
        newRequirement.appendChild(document.createElement('br'));
        newRequirement.appendChild(moduleLabel);
        newRequirement.appendChild(moduleInput);
        newRequirement.appendChild(document.createElement('br'));
        newRequirement.appendChild(descriptionLabel);
        newRequirement.appendChild(descriptionInput);

        // Create a remove button for the new requirement
        let removeButton = document.createElement('button');
        removeButton.className = 'btn btn-sm btn-danger';
        removeButton.textContent = 'Remove';

        removeButton.addEventListener('click', function() {
            newRequirement.parentNode.removeChild(newRequirement);
        });

        // Add remove button and the new requirement to the container
        newRequirement.appendChild(document.createElement('br'));
        newRequirement.appendChild(removeButton);
        requirementsContainer.appendChild(newRequirement);

        nextRequirementIndex++; // Increment index for the next requirement
    }
);
</script>

<!-- Import CSV form -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>               
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>              
            </div>
            
            <button type="button" style="margin:10px;" class="btn btn-dark waves-effect waves-light" 
            data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
            <i class="ri-information-line align-middle me-2"></i>Read Me First</button>
            
            <div class="modal-body">
                <form action="/author/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="file" name="req" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-l">
                            <div class="input-group mb-3">
                                <select id="review_leader" class="form-control mt-1 w-full" type="text" name="review_leader" required>
                                    <option>Choose Review Leader</option>
                                        @foreach ($reviewLeaders as $leader)
                                        <option value="{{ $leader->name }}">{{ $leader->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="docname" class="form-control" type="text" name="docname" placeholder="Save as" required />
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">CSV File Format</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:black;">
                                <p><img src="{{ asset('backend/assets/images/csv.png') }}"></p>
                                <li>This is the accepted format for the CSV file.</li>
                                <li>Make sure the delimiter is the comma ( , )</li>
                                <li>If your description has comma(s), make sure to enclose your description with quotation marks (" ... ")</li>
                                <br>
                                <p><b>If you plan to write your requirements in the Excel Spreadsheet first, this would be the format :</b></p>
                                <p><img src="{{ asset('backend/assets/images/excel.png') }}"></p>
                                <p>Once you have done, simply export/download the file as a CSV file.</p>
                                <p><center>Hope that helps!</center></p>
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="width:100%;">OK</button>
                            </div>
                            
                            
                            
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->