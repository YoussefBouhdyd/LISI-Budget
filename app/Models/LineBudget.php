<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\LineBudgetProposal;


class LineBudget extends Model
{
    use HasFactory;
    protected $table = 'budget_lines';

    protected $fillable = [
        'name',
        'amount',
        'code',
    ];

    public function budgetLineProposals()
    {   
        return $this->hasMany(LineBudgetProposal::class , 'budget_line_id');
    }
}
