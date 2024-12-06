<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
        'book_title',
        'author_id',
        'genre_id',
        'price_id',
        'isbn',
    ];

    public function author(){
        return $this->hasOne(Author::class,'id','author_id');
    }

    public function genre(){
        return $this->hasOne(Genre::class,'id','genre_id');
    }

    public function price(){
        return $this->hasOne(PriceRange::class,'id','price_id');
    }

    public function inventory(){
        return $this->hasMany(InventoryDetail::class,'book_id','id');
    }
}
