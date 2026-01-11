<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::insert([
            ['slug' => 'about',    'title' => 'من نحن',      'content' => ''],
            ['slug' => 'vision',   'title' => 'رؤيتنا',      'content' => ''],
            ['slug' => 'strategy', 'title' => 'استراتيجيتنا','content' => ''],
        ]);
        
    }
}
