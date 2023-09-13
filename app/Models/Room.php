<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'name', 'size'];

    protected $casts = ['size' => 'float'];


    // relationships

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
