<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
      'query_name', 'query_text'
    ];

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
