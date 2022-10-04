<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            [
                'title' => 'Task 01',
                'sort'=>1,
                'status'=>'initial'
            ],
            [
                'title' => 'Task 02',
                'sort'=>2,
                'status'=>'initial'
            ],
            [
                'title' => 'Task 03',
                'sort'=>3,
                'status'=>'initial'
            ],
            [
                'title' => 'Task 04',
                'sort'=>1,
                'status'=>'in_progress'
            ],
            [
                'title' => 'Task 05',
                'sort'=>2,
                'status'=>'in_progress'
            ],
            [
                'title' => 'Task 06',
                'sort'=>1,
                'status'=>'done'
            ],
        ]);
    }
}
