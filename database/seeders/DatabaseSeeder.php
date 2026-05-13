<?php

namespace Database\Seeders;

use App\Models\Gold;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      AdminSeeder::class,
      CustomerSeeder::class,
      GoldSeeder::class,
    ]);
  }
}