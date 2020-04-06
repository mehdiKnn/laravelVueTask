<?php

use App\Task;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *
     * @param Task $task
     * @return void
     */
    public function run(Task $task)
    {
        $faker = Faker::create();
        for ($i = 1; $i< 10; $i++){
            $task = new Task();
            $task->content = $faker->paragraph(5);
            $task->save();
        }
    }
}
