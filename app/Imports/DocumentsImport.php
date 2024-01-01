<?php

namespace App\Imports;

use App\Models\Document;
use App\Models\Requirement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Maatwebsite\Excel\Facades\Excel;


class DocumentsImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ','
        ];
    }

    private $request;
    private $document;

    public function __construct(Request $request)
    {
        $this->request = $request;        
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $selectedReviewLeaderName = $this->request->review_leader;
        $reviewLeaderId = User::where('name', $selectedReviewLeaderName)->first()->id;
     
        $user = Auth::user(); 

        if (!$this->document) {
            // Create a new document and save it to the database
            $this->document = new Document([
                'docname' => $this->request->docname,
                'review_leader_id' => $reviewLeaderId,
                'user_id' => $user->id,
                'status' => 'Unvalidated',
            ]);

            $this->document->save();
        }

        //dump($row);
        $requirement = new Requirement([
            'tag' => $row[0],
            'type' => $row[1],
            'module' => $row[2],
            'description' => $row[3],
            'document_id' => $this->document->id,
            'user_id' => $user->id,
        ]);

        $this->document->requirements()->save($requirement);
    }
}