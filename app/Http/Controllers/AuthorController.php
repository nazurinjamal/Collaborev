<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\Feedback;

class AuthorController extends Controller
{
    
    public function showReportPage(Request $request,  Document $document)
    {
        $document_id = $document->id;
        // Retrieve the document requirements

        $document = Document::find($document_id);

        
        $feedbacks = Feedback::where('document_id', $document->id)->get();
        
        $groupedFeedbacks = $feedbacks->groupBy('question');

        $reviewer1Feedbacks = $document->reviewer1 ? $document->reviewer1->feedbacks : [];
        $reviewer2Feedbacks = $document->reviewer2 ? $document->reviewer2->feedbacks : [];
        $reviewer3Feedbacks = $document->reviewer3 ? $document->reviewer3->feedbacks : [];

        return view('admin.report', [
            'document_id' => $document_id,
            'document_name' => $document->docname,
            'feedbacks' => $feedbacks,
            'reviewer1Feedbacks' => $reviewer1Feedbacks,
            'reviewer2Feedbacks' => $reviewer2Feedbacks,
            'reviewer3Feedbacks' => $reviewer3Feedbacks,
            'document' => $document,
            'groupedFeedbacks' => $groupedFeedbacks,
            // Other variables...
        ]);
    }
    
}

