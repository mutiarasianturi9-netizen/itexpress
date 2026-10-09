<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    DB::table('services')->insert([
        ['name' => 'Teknisi Air', 'description' => 'Perbaikan air'],
        ['name' => 'Teknisi Bangunan', 'description' => 'Bangunan & renovasi'],
        ['name' => 'Teknisi Elektronik', 'description' => 'Service elektronik'],
        ['name' => 'Teknisi Kunci', 'description' => 'Kunci & security'],
        ['name' => 'Teknisi Listrik', 'description' => 'Instalasi listrik'],
    ]);

    $this->call(RoleUserSeeder::class);
}
        // User::factory(10)->create();

       
}
