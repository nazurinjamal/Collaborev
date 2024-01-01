@extends('admin.admin_document_leader')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
    
                        @php
                        $reviewLeader = Auth::user()->id;
                        $documents = App\Models\Document::where('review_leader_id', $reviewLeader)->get();
                        $feedbacks = App\Models\Feedback::where('document_id', $document_id)->get();

                        $feedbackReviewer1 = $feedbacks->where('user_id', $document->reviewer1_id)->all();
                        $feedbackReviewer2 = $feedbacks->where('user_id', $document->reviewer2_id)->all();
                        $feedbackReviewer3 = $feedbacks->where('user_id', $document->reviewer3_id)->all();
                        @endphp   

                        <!-- Table of Documents Added -->
                        <div class="table-responsive">
                            <h6><center>Report for {{ $document_name }}</center></h6><br>
                            <form action="/validate-feedback/ {{ $document_id }}" method="POST">
                                @csrf
                                <input type="hidden" name="document_id" value="{{ $document_id }}">
                                <center><button type="submit" class="btn btn-success waves-effect waves-light">
                                    Validate Feedback
                                </button></center>
                            </form>
                                <hr>
                    
                            <table id="datatable"  class="table table-centered mb-0 align-middle table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="3" style="background:#0a1832;color:white;"><center>Feedback from {{ $document->reviewer1->name }}</center></th>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;">Question</th>
                                        <th style="width:10%;text-align:center;">Comply</th>
                                        <th>Feedback</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                   @foreach ($feedbackReviewer1 as $feedback)
                                    <tr>
                                        <td>{{ $feedback->question }}</td>
                                        <td style="text-align:center;">{{ $feedback->comply }}</td>
                                        <td>{{ $feedback->feedback ?? 'No feedback provided' }}</td>                                                                                                 
                                    </tr> 
                                    @endforeach
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->

                            <br><hr>
                            
                            <table  id="complex-header-datatable"  class="table table-centered mb-0 align-middle table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="3" style="background:#0a1832;color:white;"><center>Feedback from {{ $document->reviewer2->name }}</center></th>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;">Question</th>
                                        <th style="width:10%;text-align:center;">Comply</th>
                                        <th>Feedback</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                   @foreach ($feedbackReviewer2 as $feedback)
                                    <tr>
                                        <td>{{ $feedback->question }}</td>
                                        <td style="text-align:center;">{{ $feedback->comply }}</td>
                                        <td>{{ $feedback->feedback ?? 'No feedback provided' }}</td>                                                                                                 
                                    </tr> 
                                    @endforeach
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->

                            <br><hr>
                            
                            <table id="state-saving-datatable"  class="table table-centered mb-0 align-middle table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="3" style="background:#0a1832;color:white;"><center>Feedback from {{ $document->reviewer3->name }}</center></th>
                                    </tr>
                                    <tr>
                                        <th style="width:50%;">Question</th>
                                        <th style="width:10%;text-align:center;">Comply</th>
                                        <th>Feedback</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                   @foreach ($feedbackReviewer3 as $feedback)
                                    <tr>
                                        <td>{{ $feedback->question }}</td>
                                        <td style="text-align:center;">{{ $feedback->comply }}</td>
                                        <td>{{ $feedback->feedback ?? 'No feedback provided' }}</td>                                                                                                 
                                    </tr> 
                                    @endforeach
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->

                        </div><!-- end table-responsive -->
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

  @endsection