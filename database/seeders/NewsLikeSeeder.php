<?php

namespace Database\Seeders;

use App\Models\NewsLike;
use Illuminate\Database\Seeder;

class NewsLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsLike::factory()
            ->count(30)
            ->create();
    }
}
