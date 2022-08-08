<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        'Спорт', 'Политика', 'Музыка', 'Бизнес',
        'Срочные', 'В мире', 'Животные'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $categories[] = [
                'title' => $category,
                'createdAt' => fake()->dateTime()
            ];
        }

        Category::upsert($categories, ['title']);
    }
}
