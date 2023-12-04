<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JenisBuku;
use App\Models\TipeBuku;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SekolahSeeder::class,
            UserSeeder::class,
            TipeSeeder::class,
            JenisSeeder::class,
            LokasiSeeder::class,
            BukuSeeder::class,
        ]);
    }
    
}
