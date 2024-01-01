<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Models\Document;
use Illuminate\Foundation\Auth\User;

class DocumentController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function storeDocument (Request $request)
     {
        $selectedReviewLeaderName = $request->review_leader;
        $reviewLeaderId = User::where('name', $selectedReviewLeaderName)->first()->id;

         $request->validate([
             'docname' => ['required', 'string', 'max:255'],
             'review_leader_id' => ['required|exists:users,id'],
         ]);
     
         $document = new Document([
             'docname' => $request->docname,
             'review_leader_id' => $reviewLeaderId,
             'status' => 'Unvalidated',
         ]);
         
         $user = Auth::user()->id;
         $document->user_id = $user;

         $document->save();
     
         foreach ($request->input('requirements') as $requirementData) {
             $requirement = new Requirement([
                 'tag' => $requirementData['tag'],
                 'type' => $requirementData['type'],
                 'module' => $requirementData['module'],
                 'description' => $requirementData['description'],
             ]);
             
             $user = Auth::user()->id;
             $requirement->user_id = $user;
             $document->requirements()->save($requirement);
         }
     
         return redirect()->back();
     }

        public function index()
        {
            $documents = Document::with('reviewLeader')->get();

            return view('documents', compact('documents'));
        }

        public function showDocuments()
        {
            $documents = Document::all();

            return view('your.view', compact('documents'));
        }


        

}