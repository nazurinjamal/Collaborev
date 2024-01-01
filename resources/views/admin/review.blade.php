@extends('admin.admin_document_reviewer')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
<div class="card">
<div class="card-body">
    <div class="row mb-3">
        <div class="col">
            <label class="col">Document Name</label>
            <label class="form-control"> {{ $document_name }}</label>
            
        </div>
        <div class="col">
            <label class="col">Reading Technique</label>
            <label class="form-control">Checklist-Based</label>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
        <div class="card">
        <div class="card-body">
        <table id="scroll-vertical-datatable" class="table table-responsive w-100 " >
            <thead>
            <h6><i>List of Requirements  </i></h6>
                <tr>
                    <th style="width: 60px;">Tag</th>
                    <th>Type</th>
                    <th>Module</th>
                    <th style="width: 500px;">Description</th>
                </tr>
            </thead>      
            <tbody>
                @foreach ($requirements as $requirement)
                <tr>
                    <td>{{ $requirement->tag }}</td>
                    <td>{{ $requirement->type }}</td>
                    <td>{{ $requirement->module }}</td>
                    <td>{{ $requirement->description }}</td>
                </tr>
                @endforeach                                                                         
            </tbody>
        </table>
    </div> <!-- end card-body -->
    </div> <!-- end card -->
    </div> <!-- end col-12 -->
    </div> <!-- end row -->
    <div class="row mb-3">
        <div class="col">
        <h6 style="color: grey"><center><i>View the list of requirements above to give your feedback based on the respective defect categories.</i></center></h6>         
        </div>
    </div>

    <!-- progress wizard -->
    <form action="/feedback/store/{{ $document_id }}" method="post">
    @csrf
    <input type="hidden" name="document_id" value="{{ $document_id }}">
    <div class="row mb-3">
        <div class="col">
            <div id="progrss-wizard" class="twitter-bs-wizard">
                <ul class="twitter-bs-wizard-nav nav-justified nav nav-pills">
                    <li class="nav-item">
                        <a href="#progress-generic" class="nav-link active" data-toggle="tab">
                            <span class="step-number">01</span>
                            <span class="step-title">Generic</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#progress-identifiable" class="nav-link" data-toggle="tab">
                            <span class="step-number">02</span>
                            <span class="step-title">Identifiable</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#progress-correctness" class="nav-link" data-toggle="tab">
                            <span class="step-number">03</span>
                            <span class="step-title">Correctness</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#progress-completeness" class="nav-link" data-toggle="tab">
                            <span class="step-number">04</span>
                            <span class="step-title">Completeness</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#progress-consistent" class="nav-link" data-toggle="tab">
                            <span class="step-number">05</span>
                            <span class="step-title">Consistent</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#progress-concise" class="nav-link" data-toggle="tab">
                            <span class="step-number">06</span>
                            <span class="step-title">Concise</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#progress-unambiguous" class="nav-link" data-toggle="tab">
                            <span class="step-number">07</span>
                            <span class="step-title">Unambiguous</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#progress-design" class="nav-link" data-toggle="tab">
                            <span class="step-number">08</span>
                            <span class="step-title">Design</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#progress-considerations" class="nav-link" data-toggle="tab">
                            <span class="step-number">09</span>
                            <span class="step-title">Considerations</span>
                        </a>
                    </li>
                </ul>

                <div id="bar" class="progress mt-4">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 25%;"></div>               
                </div>

                <div class="tab-content twitter-bs-wizard-tab-content">
                    <div class="tab-pane active" id="progress-generic">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">1.1 Are all acronyms, abbreviations, terms and units of measure defined?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_1_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_1_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">1.2 Are all requirements written at a consistent and appropriate level of detail?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_1_2">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_1_2" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">1.3 Are assumptions that affect the requirements documented?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_1_3">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_1_3" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="progress-identifiable">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">2.1  Is each requirement uniquely and correctly identified?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_2_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_2_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">2.2 Is each requirement traceable to its source (including derived requirements)? (Eg: When referring to the appendix or other dependent requirements)</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_2_2">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_2_2" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="progress-correctness">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">3.1 Are all requirements free from content and grammatical errors?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_3_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_3_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">3.2 Are all internal cross-references to other requirements correct?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_3_2">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_3_2" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="progress-completeness">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">4.1 Are all classes of users included?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.2 Do the requirements include all known customer or system needs?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_2">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_2" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.3 Does each functional requirement specify input and output, as well as function, as appropriate?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_3">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_3" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.4 Is any relevant information missing from a requirement? If so, is it identified as To Be Determined (TBD)?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_4">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_4" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.5 Have all the relevant quality attributes (characteristics) been properly specified using measurable metrics?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_5">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_5" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.6 Are all requirements actually requirements, not design or implementation solutions? Are all requirements organized in the relevant category (functional, quality, constraints, business rules)</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_6">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_6" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.7 Any significant functional or quality requirements are missing from the list?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_7">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_7" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">4.8 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_4_8">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_4_8" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="progress-consistent">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">5.1 Are the requirements free of duplication with other requirements?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_5_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_5_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">5.2  Are the requirements free of conflict with other requirements?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_5_2">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_5_2" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="progress-concise">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">6.1 Is each requirement written in clear and concise language?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_6_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_6_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="progress-unambiguous">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">7.1 Does each requirement have only one interpretation?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_7_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_7_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark table-bordered">7.2 If a term could have multiple meanings, is it defined?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_7_2">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_7_2" class="form-control" rows="1"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="progress-design">
                        <div class="row mb-3">
                            <div class="col">
                                <table class="table table-centered mb-0 align-middle ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="table-dark table-bordered"><center>Comply</center></th>
                                            <th class="table-dark table-bordered"><center>Comment/Feedback</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark table-bordered">8.1 Are all requirements actually requirements, not design or implementation solutions?</td>
                                            <td class="table-bordered"> 
                                            <select class="form-select" name="comply_8_1">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            </td>
                                            <td class="table-bordered col-4"><textarea id="feedback" name="feedback_8_1" class="form-control" rows="1" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="progress-considerations">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                    </div>
                                    <div>
                                        <h5>Additional Feedback</h5>
                                        <p class="text-muted">If you detect additional feedback but cannot be listed in any of the defect categories, write here.</p>
                                        <div>
                                            <textarea required="" class="form-control" rows="5" name="feedback_9" placeholder="e.g. AUT-01 - Acronym is not defined."></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <br>
                                    <button class="btn btn-success form-control" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <ul class="pager wizard twitter-bs-wizard-pager-link">
                    <li class="previous disabled"><a href="javascript: void(0);">Previous</a></li>
                    <li class="next"><a href="javascript: void(0);">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
    </form>
    <!-- end progress wizard -->
    <!-- end row -->
    </div> <!-- end card-body -->
    </div> <!-- end card -->
    </div><!-- end container-fluid -->
</div><!-- end page-content -->

  @endsection