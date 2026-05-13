<?php

namespace Database\Seeders;

use App\Models\Gold;
use Illuminate\Database\Seeder;

class GoldSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            ['name' => 'Emas Antam 1 gram', 'price' => 1250000, 'stock' => 50],
            ['name' => 'Emas Antam 5 gram', 'price' => 6150000, 'stock' => 20],
            ['name' => 'Emas UBS 1 gram', 'price' => 1230000, 'stock' => 30],
        ];

        foreach ($samples as $row) {
            Gold::query()->firstOrCreate(
                ['name' => $row['name']],
                ['price' => $row['price'], 'stock' => $row['stock']]
            );
        }
    }
}
