<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => "Sport", 'fa_class' => "fas fa-futbol"]);
        DB::table('categories')->insert(['name' => "Jeux Vidéo", 'fa_class' => "fas fa-futbol"]);
        DB::table('categories')->insert(['name' => "Sciences", 'fa_class' => "fas fa-atom"]);
        DB::table('categories')->insert(['name' => "Musique", 'fa_class' => "fas fa-music"]);
        DB::table('categories')->insert(['name' => "Animé"]);
        DB::table('categories')->insert(['name' => "Actualités", 'fa_class' => "fas fa-newspaper"]);
    }
}
