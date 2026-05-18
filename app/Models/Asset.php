<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'asset_code',
        'name',
        'brand',
        'model',
        'serial_no',
        'purchase_date',
        'purchase_price',
        'condition',
        'status',
        'location',
        'qr_code',
        'photo',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'purchase_date' => 'date',
            'purchase_price' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(AssetImage::class);
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    public function damageHistories(): HasMany
    {
        return $this->hasMany(DamageHistory::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR
    |--------------------------------------------------------------------------
   */

    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->photo) {
            return null; // Implement your logic to return the full URL of the photo
        }

        return asset('storage/', $this->photo);
    }

}
