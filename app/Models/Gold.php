<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Gold extends Model
{
    protected $table = 'gold';

    protected $fillable = [
        'name',
        'image',
        'price',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::deleting(function (Gold $gold) {
            if ($gold->image) {
                Storage::disk('public')->delete($gold->image);
            }
        });
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
