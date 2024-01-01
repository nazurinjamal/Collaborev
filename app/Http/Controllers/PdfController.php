<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Feedback;
use App\Models\Document;

class PdfController extends Controller
{
    //
    public function exportPdfWithTable(Request $request, Document $document)
    {
        $document_id = $document->id;
        // Retrieve the document requirements
        $feedbacks = Feedback::where('document_id', $document->id)->get();
       // Retrieve data needed for the PDF, such as document name
       $documentName = $document->docname;
       $groupedFeedbacks = $feedbacks->groupBy('question');
       $document = Document::find($document_id);

       $data = [
           'document_name' => $documentName,
           'feedbacks' => $feedbacks,
           'groupedFeedbacks' => $groupedFeedbacks,
           'document' => $document,
       ];

       $pdf = PDF::loadView('admin.export_pdf', $data);

       $options = [
        'margin-top' => 5,
        'margin-right' => 5,
        'margin-bottom' => 5,
        'margin-left' => 5,
        // Add more options as needed
        ];

        return $pdf->setOptions($options)->stream('document.pdf');
    }
}
