<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrowing extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'asset_id',
        'user_id',
        'borrow_date',
        'expected_return',
        'actual_return',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'borrow_date' => 'datetime',
            'expected_return' => 'datetime',
            'actual_return' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approval(): HasOne
    {
        return $this->hasOne(Approval::class);
    }
}
