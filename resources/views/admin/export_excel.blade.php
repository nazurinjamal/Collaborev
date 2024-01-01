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

                        <h4 class="card-title">{{ $document_name }} Report</h4>

                        <table id="datatable-buttons" iclass="table table-responsive table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                    
                            <tr>
                                <th style="width: 50%;">Question</th>
                                <th  style="width: 10%;">Comply</th>
                                <th>Feedback</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($feedbacks as $feedback)
                            <tr>
                                
                                <td>{{ $feedback->question }}</td>
                                <td style="text-align: center;">{{ $feedback->comply }}</td>
                                <td>{{ $feedback->feedback }}</td>
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