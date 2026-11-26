<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_code',
        'item_name',
        'category',
        'unit',
        'minimum_stock',
        'description',
        'is_active',
    ];

    protected $casts = [
        'minimum_stock' => 'integer',
        'is_active' => 'boolean',
    ];

    public function batches(): HasMany
    {
        return $this->hasMany(InventoryBatch::class, 'item_id', 'item_id');
    }
}
