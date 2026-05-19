<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DamageHistory extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'asset_id',
        'reported_by',
        'damage_date',
        'description',
        'severity',
        'repair_status',
        'photo',
    ];

    protected function casts(): array
    {
        return [
            'damage_date' => 'datetime',
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

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
