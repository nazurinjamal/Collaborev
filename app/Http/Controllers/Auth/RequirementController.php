<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class RequirementController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function storeRequirement(Request $request) : RedirectResponse
    {

        if ($request->isMethod('post')) 
        {
            // Retrieve the submitted form data
            $type = $request->input('type');
            $tag = $request->input('tag');
            $module = $request->input('module');
            $description = $request->input('description');


            // Validate data
            $request->validate([
                'type' => ['required', 'string', 'max:255'],
                'tag' => ['required', 'string', 'max:255','unique:'.Requirement::class],
                'module' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
            ]);
        
            
            $requirement =new Requirement([
                'tag' => $request->tag,
                'type' => $request->type,
                'module' => $request->module,
                'description' => $request->description,
            ]);
        
            $user = Auth::user()->id;
            $requirement->user_id = $user;
            
            $requirement->save();
        
            return redirect()->back();
        }
    }
}