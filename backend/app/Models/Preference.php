<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Preference extends Model
{
    use HasFactory;
    protected $fillable = ['preferred_authors', 'preferred_sources','preferred_categories', 'user_id'];

    protected $casts = [
        'preferred_authors' => 'array',
        'preferred_sources' => 'array',
        'preferred_categories' => 'array',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
