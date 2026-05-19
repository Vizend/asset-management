<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    //
    use SoftDeletes;
    
    protected $fillable = [
        'asset_id',
        'performed_by',
        'maintenance_date',
        'next_maintenance',
        'costs',
        'vendor',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'maintenance_date' => 'date',
            'next_maintenance' => 'date',
            'costs' => 'decimal:2',
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

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
