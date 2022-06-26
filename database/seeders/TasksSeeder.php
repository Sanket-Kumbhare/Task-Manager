<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task1_start = Carbon::createFromTime(11, 30, 10, 'asia/kolkata');
        $task1_end = Carbon::createFromTime(12, 30, 10, 'asia/kolkata');
        $task2_start = Carbon::createFromTime(12, 30, 10, 'asia/kolkata');
        $task2_end = Carbon::createFromTime(14, 30, 10, 'asia/kolkata');
        $task3_start = Carbon::createFromTime(15, 30, 10, 'asia/kolkata');
        $task3_end = Carbon::createFromTime(16, 30, 10, 'asia/kolkata');
        $task4_start = Carbon::createFromTime(17, 0, 56, 'asia/kolkata');
        $task4_end = Carbon::createFromTime(18, 45, 10, 'asia/kolkata');
        $task5_start = Carbon::createFromTime(19, 45, 15, 'asia/kolkata');
        $task5_end = Carbon::createFromTime(21, 0, 58, 'asia/kolkata');
        
        $task = [
            [
                'task_name' => 'Task one',
                'start_time' => $task1_start,
                'end_time' => $task1_end,
                'total_time' =>  gmdate('H:i:s', $task1_end->diffInSeconds($task1_start))
            ], [
                'task_name' => 'Task two',
                'start_time' => $task2_start,
                'end_time' => $task2_end,
                'total_time' =>  gmdate('H:i:s', $task2_end->diffInSeconds($task2_start))
            ], [
                'task_name' => 'Task three',
                'start_time' => $task3_start,
                'end_time' => $task3_end,
                'total_time' =>  gmdate('H:i:s', $task3_end->diffInSeconds($task3_start))
            ], [
                'task_name' => 'Task four',
                'start_time' => $task4_start,
                'end_time' => $task4_end,
                'total_time' =>  gmdate('H:i:s', $task4_end->diffInSeconds($task4_start))
            ], [
                'task_name' => 'Task five',
                'start_time' => $task5_start,
                'end_time' => $task5_end,
                'total_time' =>  gmdate('H:i:s',$task5_end->diffInSeconds($task5_start))
            ],
        ];

        Task::insert($task);
    }
}
