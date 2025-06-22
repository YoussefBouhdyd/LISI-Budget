<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\LineBudget;
use App\Models\LineBudgetProposal;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'budget',
        'profession',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            // Get all budget lines using Eloquent
            $budgetLines = LineBudget::all();

            // Prepare proposals to insert
            $proposals = $budgetLines->map(function ($line) use ($user) {
                return [
                    'user_id' => $user->id,
                    'budget_line_id' => $line->id,
                    'proposed_amount' => 0,
                    'spend' => 0,
                    'is_validated' => false,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

            // Insert all proposals for the user using Eloquent
            LineBudgetProposal::insert($proposals->toArray());
        });
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function budgetProposals()
    {
        return $this->hasMany(LineBudgetProposal::class);
    }
}
