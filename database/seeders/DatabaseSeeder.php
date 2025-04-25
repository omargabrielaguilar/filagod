<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::create([
      'name' => 'Omar',
      'email' => 'omareegab@gmail.com',
      'password' => bcrypt('password')
    ]);
    // User::factory(10)->create();
  }
}
