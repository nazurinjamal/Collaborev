<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Requirement;
use App\Models\Feedback;
use App\Models\Reviewer;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class Document extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'docname',
        'status',
        'review_leader_id',
        'reviewer1_id',
        'reviewer2_id',
        'reviewer3_id',
    ];

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function reviewers()
    {
        return $this->hasMany(Reviewer::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            $document->user_id = Auth::user()->id;
        });
    }

    public function reviewLeader()
    {
        return $this->belongsTo(User::class, 'review_leader_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusAttribute()
    {
        return $this->attributes['status'] ?? 'Unvalidated';
    }

    public function reviewer1()
    {
        return $this->belongsTo(User::class, 'reviewer1_id');
    }

    public function reviewer2()
    {
        return $this->belongsTo(User::class, 'reviewer2_id');
    }

    public function reviewer3()
    {
        return $this->belongsTo(User::class, 'reviewer3_id');
    }

}
