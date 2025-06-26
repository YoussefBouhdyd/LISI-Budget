<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Need;

class Engagement extends Model
{
    public function needs()
    {
        return $this->hasMany(Need::class);
    }

    public function lineBudgetProposal()
    {
        return $this->belongsTo(LineBudgetProposal::class);
    }
}
