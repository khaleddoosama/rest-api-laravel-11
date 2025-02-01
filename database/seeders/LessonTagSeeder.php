<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LessonTag::factory(10)->create(); 
    }
}