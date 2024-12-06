<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{
    protected $fillable = [
        'book_id',
        'format_id',
        'num_of_copies',
        'price_id',
    ];

    public function inventoryType(){
        return $this->hasOne(InventoryType::class,'id','format_id');
    }
}
