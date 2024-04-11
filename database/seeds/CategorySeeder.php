<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [         
                'title' => 'Technical',
                'is_active' => 1,
            ],
            [
                'title' => 'General',
                'is_active' => 1,
            ],
            [
                'title' => 'Database',
                'is_active' => 1,
            ]
        ];
        Category::insert($data);
    }
}
