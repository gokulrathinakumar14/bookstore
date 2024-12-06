<?php

namespace Database\Seeders;

use App\Models\PriceRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $price_ranges = ['< $10' ,'$10 - $20', '$20 - $30', '> $30'];
        foreach($price_ranges as $price_range){
            PriceRange::create(['price_range' => $price_range]);
        }
    }
}
