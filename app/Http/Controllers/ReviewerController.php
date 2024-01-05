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

        $request->validate([
            'reviewers' => 'required|array|size:3',
        ]);
    
        $selectedReviewers = $request->input('reviewers');
    
        $data->reviewer1_id = $selectedReviewers[0];
        $data->reviewer2_id = $selectedReviewers[1];
        $data->reviewer3_id = $selectedReviewers[2];
        $data->save();

        return redirect()->back();  
    }
    

    public function showReviewPage(Request $request,  Document $document)
    {
        $document_id = $document->id;
        $reviewer_id = auth()->id();

        $requirements = Requirement::where('document_id', $document->id)->get();

        $feedback1_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','1.1 Are all acronyms, abbreviations, terms and units of measure defined?')
        ->first();

        $feedback1_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','1.2 Are all requirements written at a consistent and appropriate level of detail?')
        ->first();

        $feedback1_3 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','1.3 Are assumptions that affect the requirements documented?')
        ->first();

        $feedback2_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','2.1  Is each requirement uniquely and correctly identified?')
        ->first();

        $feedback2_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','2.2 Is each requirement traceable to its source (including derived requirements)? (Eg: When referring to the appendix or other dependent requirements)')
        ->first();

        $feedback3_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','3.1 Are all requirements free from content and grammatical errors?')
        ->first();

        $feedback3_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','3.2 Are all internal cross-references to other requirements correct?')
        ->first();

        $feedback4_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.1 Are all classes of users included?')
        ->first();

        $feedback4_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.2 Do the requirements include all known customer or system needs?')
        ->first();

        $feedback4_3 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.3 Does each functional requirement specify input and output, as well as function, as appropriate?')
        ->first();

        $feedback4_4 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.4 Is any relevant information missing from a requirement? If so, is it identified as To Be Determined (TBD)?')
        ->first();

        $feedback4_5 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.5 Have all the relevant quality attributes (characteristics) been properly specified using measurable metrics?')
        ->first();

        $feedback4_6 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.6 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)')
        ->first();

        $feedback4_7 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.7 Any significant functional or quality requirements are missing from the list?')
        ->first();

        $feedback4_8 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.8 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)')
        ->first();

        $feedback5_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','5.1 Are the requirements free of duplication with other requirements?')
        ->first();

        $feedback5_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','5.2  Are the requirements free of conflict with other requirements?')
        ->first();

        $feedback6_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','6.1 Is each requirement written in clear and concise language?')
        ->first();

        $feedback7_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','7.1 Does each requirement have only one interpretation?')
        ->first();

        $feedback7_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','7.2 If a term could have multiple meanings, is it defined?')
        ->first();

        $feedback8_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','8.1 Are all requirements actually requirements, not design or implementation solutions?')
        ->first();

        $feedback9 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','Additional Feedback')
        ->first();

        return view('admin.review', [
            'document_id' => $document_id,
            'document_name' => $document->docname,
            'requirements' => $requirements,
            'feedback1_1' => $feedback1_1,
            'feedback1_2' => $feedback1_2,
            'feedback1_3' => $feedback1_3,
            'feedback2_1' => $feedback2_1,
            'feedback2_2' => $feedback2_2,
            'feedback3_1' => $feedback3_1,
            'feedback3_2' => $feedback3_2,
            'feedback4_1' => $feedback4_1,
            'feedback4_2' => $feedback4_2,
            'feedback4_3' => $feedback4_3,
            'feedback4_4' => $feedback4_4,
            'feedback4_5' => $feedback4_5,
            'feedback4_6' => $feedback4_6,
            'feedback4_7' => $feedback4_7,
            'feedback4_8' => $feedback4_8,
            'feedback5_1' => $feedback5_1,
            'feedback5_2' => $feedback5_2,
            'feedback6_1' => $feedback6_1,
            'feedback7_1' => $feedback7_1,
            'feedback7_2' => $feedback7_2,
            'feedback8_1' => $feedback8_1,
            'feedback9' => $feedback9,

        ]);
    }

    public function storeFeedback(Request $request, Document $document)
    {
        $document_id = $request->input('document_id');
        $reviewer_id = auth()->id();

        $data1_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','1.1 Are all acronyms, abbreviations, terms and units of measure defined?')
        ->first();

        $data1_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','1.2 Are all requirements written at a consistent and appropriate level of detail?')
        ->first();

        $data1_3 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','1.3 Are assumptions that affect the requirements documented?')
        ->first();

        $data2_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','2.1  Is each requirement uniquely and correctly identified?')
        ->first();

        $data2_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','2.2 Is each requirement traceable to its source (including derived requirements)? (Eg: When referring to the appendix or other dependent requirements)')
        ->first();

        $data3_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','3.1 Are all requirements free from content and grammatical errors?')
        ->first();

        $data3_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','3.2 Are all internal cross-references to other requirements correct?')
        ->first();

        $data4_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.1 Are all classes of users included?')
        ->first();

        $data4_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.2 Do the requirements include all known customer or system needs?')
        ->first();

        $data4_3 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.3 Does each functional requirement specify input and output, as well as function, as appropriate?')
        ->first();

        $data4_4 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.4 Is any relevant information missing from a requirement? If so, is it identified as To Be Determined (TBD)?')
        ->first();

        $data4_5 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.5 Have all the relevant quality attributes (characteristics) been properly specified using measurable metrics?')
        ->first();

        $data4_6 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.6 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)')
        ->first();

        $data4_7 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.7 Any significant functional or quality requirements are missing from the list?')
        ->first();

        $data4_8 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','4.8 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)')
        ->first();

        $data5_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','5.1 Are the requirements free of duplication with other requirements?')
        ->first();

        $data5_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','5.2  Are the requirements free of conflict with other requirements?')
        ->first();

        $data6_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','6.1 Is each requirement written in clear and concise language?')
        ->first();

        $data7_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','7.1 Does each requirement have only one interpretation?')
        ->first();

        $data7_2 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','7.2 If a term could have multiple meanings, is it defined?')
        ->first();

        $data8_1 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','8.1 Are all requirements actually requirements, not design or implementation solutions?')
        ->first();

        $data9 = Feedback::where('document_id', $document_id)
        ->where('user_id', $reviewer_id)
        ->where('question','Additional Feedback')
        ->first();

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


        if ($request->has('save_progress')) {
            if ($data1_1) {
            $data1_1->comply = $comply_1_1;
            $data1_1->feedback = $feedback_1_1;
            $data1_1->save();
            }
            else {
            Feedback::create([
                'question' => '1.1 Are all acronyms, abbreviations, terms and units of measure defined?',
                'comply' => $comply_1_1,
                'feedback' => $feedback_1_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document->id, 
            ]); }

            if ($data1_2) {
            $data1_2->comply = $comply_1_2;
            $data1_2->feedback = $feedback_1_2;
            $data1_2->save();
            }
            else {
            Feedback::create([
                'question' => '1.2 Are all requirements written at a consistent and appropriate level of detail?', 
                'comply' => $comply_1_2,
                'feedback' => $feedback_1_2,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id,
            ]); }

            if ($data1_3) {
                // Update existing feedback record
            $data1_3->comply = $comply_1_3;
            $data1_3->feedback = $feedback_1_3;
            $data1_3->save();
            }
            else {
            Feedback::create([
                'question' => '1.3 Are assumptions that affect the requirements documented?', 
                'feedback' => $feedback_1_3,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data2_1) {
                // Update existing feedback record
            $data2_1->comply = $comply_2_1;
            $data2_1->feedback = $feedback_2_1;
            $data2_1->save();
            }
            else {
            Feedback::create([
                'question' => '2.1  Is each requirement uniquely and correctly identified?', 
                'comply' => $comply_2_1,
                'feedback' => $feedback_2_1,
                'reviewer_id' => auth()->id(),
                'document_id' => $document_id, 
            ]); }

            if ($data2_2) {
                // Update existing feedback record
            $data2_2->comply = $comply_2_2;
            $data2_2->feedback = $feedback_2_2;
            $data2_2->save();
            }
            else {
            Feedback::create([
                'question' => '2.2 Is each requirement traceable to its source (including derived requirements)? (Eg: When referring to the appendix or other dependent requirements)',
                'comply' => $comply_2_2,
                'feedback' => $feedback_2_2,
                'reviewer_id' => auth()->id(),
                'document_id' => $document_id, 
            ]); }

            if ($data3_1) {
                // Update existing feedback record
            $data3_1->comply = $comply_3_1;
            $data3_1->feedback = $feedback_3_1;
            $data3_1->save();
            }
            else {
            Feedback::create([
                'question' => '3.1 Are all requirements free from content and grammatical errors?',
                'comply' => $comply_3_1,
                'feedback' => $feedback_3_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data3_2) {
                // Update existing feedback record
            $data3_2->comply = $comply_3_2;
            $data3_2->feedback = $feedback_3_2;
            $data3_2->save();
            }
            else {
            Feedback::create([
                'question' => '3.2 Are all internal cross-references to other requirements correct?',
                'comply' => $comply_3_2,
                'feedback' => $feedback_3_2,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }
            
            if ($data4_1) {
                // Update existing feedback record
            $data4_1->comply = $comply_4_1;
            $data4_1->feedback = $feedback_4_1;
            $data4_1->save();
            }
            else {
            Feedback::create([
                'question' => '4.1 Are all classes of users included?', 
                'comply' => $comply_4_1,
                'feedback' => $feedback_4_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data4_2) {
            $data4_2->comply = $comply_4_2;
            $data4_2->feedback = $feedback_4_2;
            $data4_2->save();
            }
            else {
            Feedback::create([
                'question' => '4.2 Do the requirements include all known customer or system needs?',
                'comply' => $comply_4_2,
                'feedback' => $feedback_4_2,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data4_3) {
                $data4_3->comply = $comply_4_3;
                $data4_3->feedback = $feedback_4_3;
                $data4_3->save();
                }
            else {
            Feedback::create([
                'question' => '4.3 Does each functional requirement specify input and output, as well as function, as appropriate?', 
                'comply' => $comply_4_3,
                'feedback' => $feedback_4_3,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data4_4) {
                $data4_4->comply = $comply_4_4;
                $data4_4->feedback = $feedback_4_4;
                $data4_4->save();
                }
            else {
            Feedback::create([
                'question' => '4.4 Is any relevant information missing from a requirement? If so, is it identified as To Be Determined (TBD)?', 
                'comply' => $comply_4_4,
                'feedback' => $feedback_4_4,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data4_5) {
                $data4_5->comply = $comply_4_5;
                $data4_5->feedback = $feedback_4_5;
                $data4_5->save();
                }
            else {
            Feedback::create([
                'question' => '4.5 Have all the relevant quality attributes (characteristics) been properly specified using measurable metrics?',
                'comply' => $comply_4_5,
                'feedback' => $feedback_4_5,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data4_6) {
                $data4_6->comply = $comply_4_6;
                $data4_6->feedback = $feedback_4_6;
                $data4_6->save();
                }
            else {
            Feedback::create([
                'question' => '4.6 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)', 
                'comply' => $comply_4_6,
                'feedback' => $feedback_4_6,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id,
            ]); }

            if ($data4_7) {
                $data4_7->comply = $comply_4_7;
                $data4_7->feedback = $feedback_4_7;
                $data4_7->save();
                }
            else {
            Feedback::create([
                'question' => '4.7 Any significant functional or quality requirements are missing from the list?', 
                'comply' => $comply_4_7,
                'feedback' => $feedback_4_7,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data4_8) {
                $data4_8->comply = $comply_4_8;
                $data4_8->feedback = $feedback_4_8;
                $data4_8->save();
                }
            else {
            Feedback::create([
                'question' => '4.8 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)', 
                'comply' => $comply_4_8,
                'feedback' => $feedback_4_8,
                'reviewer_id' => auth()->id(),
                'document_id' => $document_id, 
            ]); }

            if ($data5_1) {
                $data5_1->comply = $comply_5_1;
                $data5_1->feedback = $feedback_5_1;
                $data5_1->save();
                }
                else {
            Feedback::create([
                'question' => '5.1 Are the requirements free of duplication with other requirements?',
                'comply' => $comply_5_1,
                'feedback' => $feedback_5_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data5_2) {
                $data5_2->comply = $comply_5_2;
                $data5_2->feedback = $feedback_5_2;
                $data5_2->save();
                }
                else {
            Feedback::create([
                'question' => '5.2  Are the requirements free of conflict with other requirements?', 
                'comply' => $comply_5_2,
                'feedback' => $feedback_5_2,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data6_1) {
                $data6_1->comply = $comply_6_1;
                $data6_1->feedback = $feedback_6_1;
                $data6_1->save();
                }
                else {
            Feedback::create([
                'question' => '6.1 Is each requirement written in clear and concise language?',
                'comply' => $comply_6_1,
                'feedback' => $feedback_6_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data7_1) {
                $data7_1->comply = $comply_7_1;
                $data7_1->feedback = $feedback_7_1;
                $data7_1->save();
                }
                else {
            Feedback::create([
                'question' => '7.1 Does each requirement have only one interpretation?',
                'comply' => $comply_7_1,
                'feedback' => $feedback_7_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data7_2) {
                $data7_2->comply = $comply_7_2;
                $data7_2->feedback = $feedback_7_2;
                $data7_2->save();
                }
                else {
            Feedback::create([
                'question' => '7.2 If a term could have multiple meanings, is it defined?', 
                'comply' => $comply_7_2,
                'feedback' => $feedback_7_2,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data8_1) {
                $data8_1->comply = $comply_8_1;
                $data8_1->feedback = $feedback_8_1;
                $data8_1->save();
                }
                else {
            Feedback::create([
                'question' => '8.1 Are all requirements actually requirements, not design or implementation solutions?',
                'comply' => $comply_8_1,
                'feedback' => $feedback_8_1,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id, 
            ]); }

            if ($data9) {
                $data9->feedback = $feedback_9;
                $data9->save();
            }
            else {
            Feedback::create([
                'question' => 'Additional Feedback', 
                'feedback' => $feedback_9,
                'reviewer_id' => auth()->id(), 
                'document_id' => $document_id,
            ]); }    



        } elseif ($request->has('submit_review')) {
            if ($data1_1) {
                $data1_1->comply = $comply_1_1;
                $data1_1->feedback = $feedback_1_1;
                $data1_1->save();
                }
                else {
                Feedback::create([
                    'question' => '1.1 Are all acronyms, abbreviations, terms and units of measure defined?',
                    'comply' => $comply_1_1,
                    'feedback' => $feedback_1_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document->id, 
                ]); }
    
                if ($data1_2) {
                $data1_2->comply = $comply_1_2;
                $data1_2->feedback = $feedback_1_2;
                $data1_2->save();
                }
                else {
                Feedback::create([
                    'question' => '1.2 Are all requirements written at a consistent and appropriate level of detail?', 
                    'comply' => $comply_1_2,
                    'feedback' => $feedback_1_2,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id,
                ]); }
    
                if ($data1_3) {                
                $data1_3->comply = $comply_1_3;
                $data1_3->feedback = $feedback_1_3;
                $data1_3->save();
                }
                else {
                Feedback::create([
                    'question' => '1.3 Are assumptions that affect the requirements documented?', 
                    'feedback' => $feedback_1_3,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data2_1) {
                $data2_1->comply = $comply_2_1;
                $data2_1->feedback = $feedback_2_1;
                $data2_1->save();
                }
                else {
                Feedback::create([
                    'question' => '2.1  Is each requirement uniquely and correctly identified?', 
                    'comply' => $comply_2_1,
                    'feedback' => $feedback_2_1,
                    'reviewer_id' => auth()->id(),
                    'document_id' => $document_id, 
                ]); }
    
                if ($data2_2) {
                    // Update existing feedback record
                $data2_2->comply = $comply_2_2;
                $data2_2->feedback = $feedback_2_2;
                $data2_2->save();
                }
                else {
                Feedback::create([
                    'question' => '2.2 Is each requirement traceable to its source (including derived requirements)? (Eg: When referring to the appendix or other dependent requirements)',
                    'comply' => $comply_2_2,
                    'feedback' => $feedback_2_2,
                    'reviewer_id' => auth()->id(),
                    'document_id' => $document_id, 
                ]); }
    
                if ($data3_1) {
                    // Update existing feedback record
                $data3_1->comply = $comply_3_1;
                $data3_1->feedback = $feedback_3_1;
                $data3_1->save();
                }
                else {
                Feedback::create([
                    'question' => '3.1 Are all requirements free from content and grammatical errors?',
                    'comply' => $comply_3_1,
                    'feedback' => $feedback_3_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data3_2) {
                    // Update existing feedback record
                $data3_2->comply = $comply_3_2;
                $data3_2->feedback = $feedback_3_2;
                $data3_2->save();
                }
                else {
                Feedback::create([
                    'question' => '3.2 Are all internal cross-references to other requirements correct?',
                    'comply' => $comply_3_2,
                    'feedback' => $feedback_3_2,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
                
                if ($data4_1) {
                    // Update existing feedback record
                $data4_1->comply = $comply_4_1;
                $data4_1->feedback = $feedback_4_1;
                $data4_1->save();
                }
                else {
                Feedback::create([
                    'question' => '4.1 Are all classes of users included?', 
                    'comply' => $comply_4_1,
                    'feedback' => $feedback_4_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data4_2) {
                $data4_2->comply = $comply_4_2;
                $data4_2->feedback = $feedback_4_2;
                $data4_2->save();
                }
                else {
                Feedback::create([
                    'question' => '4.2 Do the requirements include all known customer or system needs?',
                    'comply' => $comply_4_2,
                    'feedback' => $feedback_4_2,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data4_3) {
                    $data4_3->comply = $comply_4_3;
                    $data4_3->feedback = $feedback_4_3;
                    $data4_3->save();
                    }
                else {
                Feedback::create([
                    'question' => '4.3 Does each functional requirement specify input and output, as well as function, as appropriate?', 
                    'comply' => $comply_4_3,
                    'feedback' => $feedback_4_3,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data4_4) {
                    $data4_4->comply = $comply_4_4;
                    $data4_4->feedback = $feedback_4_4;
                    $data4_4->save();
                    }
                else {
                Feedback::create([
                    'question' => '4.4 Is any relevant information missing from a requirement? If so, is it identified as To Be Determined (TBD)?', 
                    'comply' => $comply_4_4,
                    'feedback' => $feedback_4_4,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data4_5) {
                    $data4_5->comply = $comply_4_5;
                    $data4_5->feedback = $feedback_4_5;
                    $data4_5->save();
                    }
                else {
                Feedback::create([
                    'question' => '4.5 Have all the relevant quality attributes (characteristics) been properly specified using measurable metrics?',
                    'comply' => $comply_4_5,
                    'feedback' => $feedback_4_5,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data4_6) {
                    $data4_6->comply = $comply_4_6;
                    $data4_6->feedback = $feedback_4_6;
                    $data4_6->save();
                    }
                else {
                Feedback::create([
                    'question' => '4.6 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)', 
                    'comply' => $comply_4_6,
                    'feedback' => $feedback_4_6,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id,
                ]); }
    
                if ($data4_7) {
                    $data4_7->comply = $comply_4_7;
                    $data4_7->feedback = $feedback_4_7;
                    $data4_7->save();
                    }
                else {
                Feedback::create([
                    'question' => '4.7 Any significant functional or quality requirements are missing from the list?', 
                    'comply' => $comply_4_7,
                    'feedback' => $feedback_4_7,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data4_8) {
                    $data4_8->comply = $comply_4_8;
                    $data4_8->feedback = $feedback_4_8;
                    $data4_8->save();
                    }
                else {
                Feedback::create([
                    'question' => '4.8 Are all requirements organized in the relevant category (functional, quality, constraints, business rules)', 
                    'comply' => $comply_4_8,
                    'feedback' => $feedback_4_8,
                    'reviewer_id' => auth()->id(),
                    'document_id' => $document_id, 
                ]); }
    
                if ($data5_1) {
                    $data5_1->comply = $comply_5_1;
                    $data5_1->feedback = $feedback_5_1;
                    $data5_1->save();
                    }
                    else {
                Feedback::create([
                    'question' => '5.1 Are the requirements free of duplication with other requirements?',
                    'comply' => $comply_5_1,
                    'feedback' => $feedback_5_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data5_2) {
                    $data5_2->comply = $comply_5_2;
                    $data5_2->feedback = $feedback_5_2;
                    $data5_2->save();
                    }
                    else {
                Feedback::create([
                    'question' => '5.2  Are the requirements free of conflict with other requirements?', 
                    'comply' => $comply_5_2,
                    'feedback' => $feedback_5_2,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data6_1) {
                    $data6_1->comply = $comply_6_1;
                    $data6_1->feedback = $feedback_6_1;
                    $data6_1->save();
                    }
                    else {
                Feedback::create([
                    'question' => '6.1 Is each requirement written in clear and concise language?',
                    'comply' => $comply_6_1,
                    'feedback' => $feedback_6_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data7_1) {
                    $data7_1->comply = $comply_7_1;
                    $data7_1->feedback = $feedback_7_1;
                    $data7_1->save();
                    }
                    else {
                Feedback::create([
                    'question' => '7.1 Does each requirement have only one interpretation?',
                    'comply' => $comply_7_1,
                    'feedback' => $feedback_7_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data7_2) {
                    $data7_2->comply = $comply_7_2;
                    $data7_2->feedback = $feedback_7_2;
                    $data7_2->save();
                    }
                    else {
                Feedback::create([
                    'question' => '7.2 If a term could have multiple meanings, is it defined?', 
                    'comply' => $comply_7_2,
                    'feedback' => $feedback_7_2,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data8_1) {
                    $data8_1->comply = $comply_8_1;
                    $data8_1->feedback = $feedback_8_1;
                    $data8_1->save();
                    }
                    else {
                Feedback::create([
                    'question' => '8.1 Are all requirements actually requirements, not design or implementation solutions?',
                    'comply' => $comply_8_1,
                    'feedback' => $feedback_8_1,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id, 
                ]); }
    
                if ($data9) {
                    $data9->feedback = $feedback_9;
                    $data9->save();
                }
                else {
                Feedback::create([
                    'question' => 'Additional Feedback', 
                    'feedback' => $feedback_9,
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id,
                ]); 
            
                 }    
                 
                 Reviewer::create([
                    'review_status' => 'Reviewed',
                    'reviewer_id' => auth()->id(), 
                    'document_id' => $document_id,
                ]);
            }

    return redirect('/reviewer/document');
    }





}

