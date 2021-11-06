<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Article::class, 25)->create(); //factory take 2 arguments #1 is the class/model you want to create #2 number of data rows wanted in DB

    }
}
