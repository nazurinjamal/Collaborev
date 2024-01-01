@extends('admin.admin_document')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $document_name }} Report</h4>
                        <p class="card-title-desc">This report can be downloaded in a PDF or an Excel file. Simply click the button below.
                        </p>
                            <div style="display: flex; gap: 10px;">
                                <form action="/export-pdf/ {{ $document_id }}" method="GET">
                                <input type="hidden" name="document_id" value="{{ $document_id }}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-file-pdf-line align-middle"></i> PDF
                                </button>
                                </form>

                                <form action="/export-excel/ {{ $document_id }}" method="GET">
                                <input type="hidden" name="document_id" value="{{ $document_id }}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <i class="ri-file-excel-2-line align-middle"></i> Excel
                                </button>
                                </form>
                            </div>                       
                        <br>
                        <table  id="datatable"  class="table table-responsive table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                            <tr>
                                <th  colspan="3" class="table-dark"><center>{{ $document_name }}</center></th>
                            </tr>
                            <tr>
                                <th style="width:50%;">Question</th>
                                <th style="width:10%;">Comply</th>
                                <th>Feedback</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($groupedFeedbacks as $question => $feedbacks)
                                <tr>
                                    <td rowspan="{{ count($feedbacks) }}">{{ $question }}</td>
                                    @foreach ($feedbacks as $index => $feedback)
                                        @if ($index > 0)
                                            <tr>
                                        @endif
                                        <td style="text-align:center;">{{ $feedback->comply }}</td>
                                        <td>{{ $feedback->feedback ?? 'No feedback provided' }}</td>
                                        @if ($index > 0)
                                            </tr>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach                         
                            </tbody>
                        </table>                      
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>

@endsection