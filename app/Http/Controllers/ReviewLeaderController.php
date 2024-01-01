<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\Feedback;
use App\Models\Reviewer;

class ReviewLeaderController extends Controller
{
    public function showValidatePage(Request $request,  Document $document)
    {
        $document_id = $document->id;
        
        $document = Document::find($document_id);

        // Make sure the document exists
        if (!$document) {
            abort(404); // Or handle the case when the document is not found
        }

        $feedbacks = Feedback::where('document_id', $document->id)->get();

        $reviewers = Reviewer::where('document_id', $document_id)->get();

        $reviewer1Feedbacks = $document->reviewer1 ? $document->reviewer1->feedbacks : [];
        $reviewer2Feedbacks = $document->reviewer2 ? $document->reviewer2->feedbacks : [];
        $reviewer3Feedbacks = $document->reviewer3 ? $document->reviewer3->feedbacks : [];

        return view('admin.validate', [
            'document_id' => $document_id,
            'document_name' => $document->docname,
            'feedbacks' => $feedbacks,
            'reviewers' => $reviewers,
            'reviewer1Feedbacks' => $reviewer1Feedbacks,
            'reviewer2Feedbacks' => $reviewer2Feedbacks,
            'reviewer3Feedbacks' => $reviewer3Feedbacks,
            'document' => $document,
        ]);
    }

    public function validateFeedback(Request $request,  Document $document)
    {
        $document_id =  $document->id;
        $data = Document::find($document_id);
    
        $document_id = $request->input('document_id');

        $document->status = 'Validated';
        $document->save();

        return redirect('/reviewleader/report');
    }

}

