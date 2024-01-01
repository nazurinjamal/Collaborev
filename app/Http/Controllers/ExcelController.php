<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TableExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Feedback;
use App\Models\Document;

class ExcelController extends Controller
{
    //
    public function export(Request $request, Document $document)
    {
        $document_id = $document->id;
    // Retrieve the document requirements
        $feedbacks = Feedback::where('document_id', $document->id)->get();
    // Retrieve data needed for the PDF, such as document name
        $documentName = $document->docname;
        $groupedFeedbacks = $feedbacks->groupBy('question');


        
    $data = [
        'document_name' => $documentName,
        'feedbacks' => $feedbacks,
        'groupedFeedbacks' => $groupedFeedbacks,
    ];

    // Flash data to the session
    $request->session()->flash('export_data', $data);

    return Excel::download(new TableExport, 'document.xlsx');
    }
}
