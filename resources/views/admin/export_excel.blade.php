<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <style>
        table {
            border: solid black 1px;
            padding: 8px;
            width: 100%;
        }

        th, td {
        padding: 10px;
        border: solid black 1px;
        }
                
        body {
        font-family: 'Arial';
        font-size: 14px;
    }
    </style>

     <body>

            <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{ $document_name }} Report</h2>
                        by Collaborev.
                        <h2></h2>

                        <table>
                        <tr>
                            <td>Author</td>
                            <td>{{ ($document->author)->name }}</td>
                        </tr>
                            
                        <tr>
                            <td>Review Leader</td>
                            <td>{{ $document->reviewLeader->name }}</td>
                        </tr>
                        
                        <tr>
                            <td>Created at</td>
                            <td>{{ $document->created_at->format('d-m-Y') }}</td>
                        </tr>

                        <tr>
                            <td>Validated at</td>                           
                            <td>{{ $document->updated_at->format('d-m-Y') }}</td>
                        </tr>
                        </table>

                        <table>
                            <thead>
                            <tr>
                                <th>Reviewer</th>
                                <th>Question</th>
                                <th>Comply</th>
                                <th>Feedback</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($feedbacks as $feedback)
                            <tr>
                                <td>{{ optional($feedback->reviewer)->name }}</td>
                                <td>{{ $feedback->question }}</td>
                                <td style="text-align: center;">{{ $feedback->comply }}</td>
                                <td>{{ $feedback->feedback ?? 'No feedback provided' }}</td>
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