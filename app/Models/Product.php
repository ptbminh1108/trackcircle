<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trade_name',
        'generic_name',
        'dosage_form',
        'sku',
        'strength',
        'quantity',
        'manufacturer_id',
        'marketing_holder',
        'country_id',
        'coa',
        'biostudy',
        'sale_price',
        'sale_currency',
        'sale_description',
        'purchase_price',
        'purchase_currency',
        'purchase_description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'

    ];

    public function manufacturer(): BelongsTo
    {
        return $this->BelongsTo(Manufacturer::class,'manufacturer_id');
    }
}
