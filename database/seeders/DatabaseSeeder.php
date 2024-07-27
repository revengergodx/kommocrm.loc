<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Stage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('stages')->insert([
            ['title' => 'Qualification'],
            ['title' => 'Needs Analysis'],
            ['title' => 'Value Proposition'],
            ['title' => 'Identify Decision Makers'],
            ['title' => 'Proposal/Price Quote'],
            ['title' => 'Negotiation/Review'],
            ['title' => 'Closed Won'],
            ['title' => 'Closed Lost'],
            ['title' => 'Closed-Lost to Competition'],
        ]);
    }
}
