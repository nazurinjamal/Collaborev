<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\User;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\Feedback;
use App\Models\Reviewer;

class ReviewerController extends Controller
{
 
    public function StoreReviewer(Request $request,Document $document) 
    {
        $document_id =  $document->id;
        $data = Document::find($document_id);
    
        $data->reviewer1_id = $request->reviewer1;
        $data->reviewer2_id = $request->reviewer2;
        $data->reviewer3_id = $request->reviewer3;
        $data->save();

        return redirect()->back();  
    }

    public function showReviewPage(Request $request,  Document $document)
    {
        $document_id = $document->id;
        // Retrieve the document requirements
        $requirements = Requirement::where('document_id', $document->id)->get();

        return view('admin.review', [
            'document_id' => $document_id,
            'document_name' => $document->docname,
            'requirements' => $requirements,
            // Other variables...
        ]);
    }

    public function storeFeedback(Request $request, Document $document)
    {
        $document_id = $request->input('document_id');
        // Extract data from the request
        $comply_1_1 = $request->input('comply_1_1');
        $feedback_1_1 = $request->input('feedback_1_1');
        
        $comply_1_2 = $request->input('comply_1_2');
        $feedback_1_2 = $request->input('feedback_1_2');
        
        $comply_1_3 = $request->input('comply_1_3');
        $feedback_1_3 = $request->input('feedback_1_3');
        
        $comply_2_1 = $request->input('comply_2_1');
        $feedback_2_1 = $request->input('feedback_2_1');
        
        $comply_2_2 = $request->input('comply_2_2');
        $feedback_2_2 = $request->input('feedback_2_2');
        
        $comply_3_1 = $request->input('comply_3_1');
        $feedback_3_1 = $request->input('feedback_3_1');
        
        $comply_3_2 = $request->input('comply_3_2');
        $feedback_3_2 = $request->input('feedback_3_2');
        
        $comply_4_1 = $request->input('comply_4_1');
        $feedback_4_1 = $request->input('feedback_4_1');
        
        $comply_4_2 = $request->input('comply_4_2');
        $feedback_4_2 = $request->input('feedback_4_2');
        
        $comply_4_3 = $request->input('comply_4_3');
        $feedback_4_3 = $request->input('feedback_4_3');
        
        $comply_4_4 = $request->input('comply_4_4');
        $feedback_4_4 = $request->input('feedback_4_4');
        
        $comply_4_5 = $request->input('comply_4_5');
        $feedback_4_5 = $request->input('feedback_4_5');
        
        $comply_4_6 = $request->input('comply_4_6');
        $feedback_4_6 = $request->input('feedback_4_6');
        
        $comply_4_7 = $request->input('comply_4_7');
        $feedback_4_7 = $request->input('feedback_4_7');
        
        $comply_4_8 = $request->input('comply_4_8');
        $feedback_4_8 = $request->input('feedback_4_8');
        
        $comply_5_1 = $request->input('comply_5_1');
        $feedback_5_1 = $request->input('feedback_5_1');

        $comply_5_2 = $request->input('comply_5_2');
        $feedback_5_2 = $request->input('feedback_5_2');
        
        $comply_6_1 = $request->input('comply_6_1');
        $feedback_6_1 = $request->input('feedback_6_1');

        $comply_7_1 = $request->input('comply_7_1');
        $feedback_7_1 = $request->input('feedback_7_1');

        $comply_7_2 = $request->input('comply_7_2');
        $feedback_7_2 = $request->input('feedback_7_2');

        $comply_8_1 = $request->input('comply_8_1');
        $feedback_8_1 = $request->input('feedback_8_1');

        $feedback_9 = $request->input('feedback_9');



        // Extract other data similarly...

        // Store the feedback in the database
        Feedback::create([
            'question' => '1.1 Are all acronyms, abbreviations, terms and units of measure defined?', // Adjust accordingly
            'comply' => $comply_1_1,
            'feedback' => $feedback_1_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document->id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '1.2 Are all requirements written at a consistent and appropriate level of detail?', // Adjust accordingly
            'comply' => $comply_1_2,
            'feedback' => $feedback_1_2,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '1.3 Are assumptions that affect the requirements documented?', // Adjust accordingly
            'comply' => $comply_1_3,
            'feedback' => $feedback_1_3,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '2.1  Is each requirement uniquely and correctly identified?', // Adjust accordingly
            'comply' => $comply_2_1,
            'feedback' => $feedback_2_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '2.2 Is each requirement traceable to its source (including derived requirements)? (Eg: When referring to the appendix or other dependent requirements)', // Adjust accordingly
            'comply' => $comply_2_2,
            'feedback' => $feedback_2_2,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '3.1 Are all requirements free from content and grammatical errors?', // Adjust accordingly
            'comply' => $comply_3_1,
            'feedback' => $feedback_3_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '3.2 Are all internal cross-references to other requirements correct?', // Adjust accordingly
            'comply' => $comply_3_2,
            'feedback' => $feedback_3_2,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);
        
        Feedback::create([
            'question' => '4.1 Are all classes of users included?', // Adjust accordingly
            'comply' => $comply_4_1,
            'feedback' => $feedback_4_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.2 Do the requirements include all known customer or system needs?', // Adjust accordingly
            'comply' => $comply_4_2,
            'feedback' => $feedback_4_2,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.3 Does each functional requirement specify input and output, as well as function, as appropriate?', // Adjust accordingly
            'comply' => $comply_4_3,
            'feedback' => $feedback_4_3,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.4 Is any relevant information missing from a requirement? If so, is it identified as To Be Determined (TBD)?', // Adjust accordingly
            'comply' => $comply_4_4,
            'feedback' => $feedback_4_4,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.5 Have all the relevant quality attributes (characteristics) been properly specified using measurable metrics?', // Adjust accordingly
            'comply' => $comply_4_5,
            'feedback' => $feedback_4_5,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.6 Are all requirements actually requirements, not design or implementation solutions? Are all requirements organized in the relevant category (functional, quality, constraints, business rules)', // Adjust accordingly
            'comply' => $comply_4_6,
            'feedback' => $feedback_4_6,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.7 Any significant functional or quality requirements are missing from the list?', // Adjust accordingly
            'comply' => $comply_4_7,
            'feedback' => $feedback_4_7,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '4.8 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)', // Adjust accordingly
            'comply' => $comply_4_8,
            'feedback' => $feedback_4_8,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '5.1 Are the requirements free of duplication with other requirements?', // Adjust accordingly
            'comply' => $comply_5_1,
            'feedback' => $feedback_5_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '5.2  Are the requirements free of conflict with other requirements?', // Adjust accordingly
            'comply' => $comply_5_2,
            'feedback' => $feedback_5_2,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '6.1 Is each requirement written in clear and concise language?', // Adjust accordingly
            'comply' => $comply_6_1,
            'feedback' => $feedback_6_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '7.1 Does each requirement have only one interpretation?', // Adjust accordingly
            'comply' => $comply_7_1,
            'feedback' => $feedback_7_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '7.2 If a term could have multiple meanings, is it defined?', // Adjust accordingly
            'comply' => $comply_7_2,
            'feedback' => $feedback_7_2,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => '8.1 Are all requirements actually requirements, not design or implementation solutions?', // Adjust accordingly
            'comply' => $comply_8_1,
            'feedback' => $feedback_8_1,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Feedback::create([
            'question' => 'Additional Feedback', // Adjust accordingly
            'feedback' => $feedback_9,
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        Reviewer::create([
            'review_status' => 'Reviewed', // Adjust accordingly
            'reviewer_id' => auth()->id(), // Assuming you are using authentication
            'document_id' => $document_id, // Retrieve this from your existing logic
        ]);

        // Redirect or return a response as needed
        return redirect('/reviewer/document');
    }



}

