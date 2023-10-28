<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Companies;
use App\Models\Company;
use App\Models\Employes;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@admin.admin',
             'password' => '$2y$10$mzgXrt0xn5Eu3vW6/Rdp5eFWQ/hKSKbRFH4hnbq62Ujg.xjcoRjpG',
             'admin' => '1',
         ]);

        Companies::factory(20)->create();
        Employes::factory(100)->create();
    }
}
