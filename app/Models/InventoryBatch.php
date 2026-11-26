<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryBatch extends Model
{
    use HasFactory;

    protected $primaryKey = 'batch_id';

    protected $fillable = [
        'item_id',
        'batch_number',
        'expiration_date',
        'quantity_available',
        'received_date',
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'quantity_available' => 'integer',
        'received_date' => 'date',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'item_id', 'item_id');
    }

    public function inventoryTransactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class, 'batch_id', 'batch_id');
    }
}
