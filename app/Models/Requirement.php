<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class Requirement extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'tag',
        'module',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($requirement) {
            $requirement->user_id = Auth::user()->id;
        });
    }
}
