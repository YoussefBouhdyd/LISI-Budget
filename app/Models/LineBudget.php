<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LineBudget extends Model
{
    use HasFactory;
    protected $table = 'budget_lines';

    protected $fillable = [
        'name',
        'amount',
    ];
}
