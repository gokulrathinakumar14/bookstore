<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $genres = ['Fiction', 'Non-Fiction','Sci-Fi','Other'];
        foreach($genres as $genre){
            Genre::create(['name' => $genre]);        
        }
    }
}
