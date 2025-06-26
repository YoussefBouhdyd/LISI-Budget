<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'description',
        'quantity',
        'engagement_id',
        'nature',
        'estimated_amount'
    ];

    public function engagement()
    {
        return $this->belongsTo(Engagement::class);
    }
}
