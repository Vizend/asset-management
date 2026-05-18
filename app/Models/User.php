<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


// #[Fillable(['name', 'email', 'password'])]
// #[Hidden(['password', 'remember_token'])]
// class User extends Authenticatable
// {
//     /** @use HasFactory<UserFactory> */
//     use HasFactory, Notifiable;

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }
// }

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'phone',
        'department',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
   */

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(Approval::class, 'approved_by');
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'performed_by');
    }

    public function damageReports(): HasMany
    {
        return $this->hasMany(DamageHistory::class, 'reported_by');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->role?->name === 'Admin IT';
    }

    public function isManager(): bool
    {
        return $this->role?->name === 'Manager';
    }

    public function isStaff(): bool
    {
        return $this->role?->name === 'Staff';
    }
}
