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
        $feedbacks = Feedback::where('document_id', $document->id)->get();
        $documentName = $document->docname;
        $document = Document::find($document_id);
        $feedbackByReviewer = Feedback::with('user')->get()->groupBy('user_id');

     
    $data = [
        'document_name' => $documentName,
        'feedbacks' => $feedbacks,
        'document' => $document,
    ];

    $request->session()->flash('export_data', $data);

    return Excel::download(new TableExport, 'report.xlsx');

    
    }
}
