<?php

namespace Database\Seeders;

use App\Models\InventoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $inventory_types = ['Hardcover','Paperback','E-book'];
        foreach($inventory_types as $inventory_type) {
            InventoryType::create(['name' => $inventory_type]);  
        }
    }
}
