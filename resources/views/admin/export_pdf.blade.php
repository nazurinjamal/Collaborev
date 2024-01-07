<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document_name }} Report</title>

    <style>
        table {
            border: solid black 1px;
            padding: 10px;
            width: 100%;
            page-break-inside: avoid;
        }

        th, td {
        padding: 10px;
        border: solid black 1px;
        page-break-inside: avoid;
        page-break-before: always;

        }
                
        body {
        font-family: 'Arial';
        font-size: 14px;

        #footer {
        height: 50px; /* Set a fixed height for the footer */
        /* Add other styling properties as needed */
        text-align: right;
    }

    }
    </style>

     <body>

            <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <h4 style="text-align:right;">Collaborev.</h4>
                            <h4>Author : {{ $document->author->name }} </h4>     
                            <h4>Review Leader : {{ $document->reviewLeader->name }} </h4>                         
                            <h4>Reviewers : 
                                <ol>
                                    <li> {{ $document->reviewer1->name }} </li>
                                    <li> {{ $document->reviewer2->name }} </li>
                                    <li> {{ $document->reviewer3->name }} </li>
                                </ol>
                            </h4>
                            <h4 style="text-align:right;">Created at : {{ $document->created_at->format('d-m-Y') }}</h4>
                            <h4 style="text-align:right;">Validated at : {{ $document->updated_at->format('d-m-Y') }}</h4>
                            <br><hr style="border: 1px solid black;"><br>
                            <h1><center>{{ $document_name }} Report</center></h1>
                            <table id="datatable-buttons" iclass="table table-responsive table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                    
                            <tr>
                                <th style="width: 50%;">Question</th>
                                <th  style="width: 10%;">Comply</th>
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
</body>
</html>