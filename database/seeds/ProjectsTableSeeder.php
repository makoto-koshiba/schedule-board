<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 15; $i++) {
            DB::table('projects')->insert([
                'title' => 'test title ' . $i,
                'content' => 'test content ' . $i,
                
            ]);
        }
    }
}
