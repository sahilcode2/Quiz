<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionSeeder extends Seeder
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
                'category_id' => 3,
                'title' => 'Q in SQL stands for',
                'content' => '1.Query 2.Quote 3.Questions 4.Quite',
                'answer' => 'Query'
            ],
            [
                'category_id' => 2,
                'title' => 'Goa is in which side of India',
                'content' => '1.East 2.West 3.North 4.South',
                'answer' => 'West'
            ],
            [
                'category_id' => 3,
                'title' => 'Q in MySQL stands for',
                'content' => '1.Query 2.Quote 3.Questions 4.Quite',
                'answer' => 'Query'
            ],
            [         
                'category_id' => 1,
                'title' => 'M in HTML stands for',
                'content' => '1.MarkUp 2.Mark 3.Model 4.Make',
                'answer' => 'MarkUp'
            ],
        ];
        Question::insert($data);
    }
}