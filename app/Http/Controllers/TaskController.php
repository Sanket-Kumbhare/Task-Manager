<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showTasks()
    {
        return view('task', ['tasks' => Task::all()]);
    }

    public function rescheduleTasks(Request $req)
    {
        $tasks = Task::all()->toArray();
        if (Carbon::parse($req->start)->lt(Carbon::parse($req->end))) {
            if (Carbon::parse($req->end)->ne(Carbon::parse($tasks[$req->id - 1]['end_time']))) {
                $tasks[$req->id - 1]['end_time'] = Carbon::parse($req->end);

                $tasks[$req->id - 1]['total_time'] = gmdate('h:i:s', Carbon::parse($tasks[$req->id - 1]['start_time'])->diffInSeconds(Carbon::parse($tasks[$req->id - 1]['end_time'])));


                for ($i = $req->id - 1; $i < count($tasks) - 1; $i++) {
                    if (Carbon::parse($tasks[$i]['end_time'])->gt(Carbon::parse($tasks[$i + 1]['start_time']))) {
                        $time_gap = Carbon::parse($tasks[$i + 1]['start_time'])->diffInSeconds(Carbon::parse($tasks[$i]['end_time']));

                        $tasks[$i + 1]['start_time'] = Carbon::parse($tasks[$i + 1]['start_time'])->addSeconds($time_gap);

                        $tasks[$i + 1]['end_time'] = Carbon::parse($tasks[$i + 1]['end_time'])->addSeconds($time_gap);
                    } else {
                        break;
                    }
                }
                Task::truncate();
                Task::insert($tasks);
            }

            if (Carbon::parse($req->start)->ne(Carbon::parse($tasks[$req->id - 1]['start_time']))) {
                $tasks[$req->id - 1]['start_time'] = Carbon::parse($req->start);

                $tasks[$req->id - 1]['total_time'] = gmdate('h:i:s', Carbon::parse($tasks[$req->id - 1]['start_time'])->diffInSeconds(Carbon::parse($tasks[$req->id - 1]['end_time'])));


                for ($i = $req->id - 1; $i > 0; $i--) {
                    if (Carbon::parse($tasks[$i]['start_time'])->lt(Carbon::parse($tasks[$i - 1]['end_time']))) {
                        $time_gap = Carbon::parse($tasks[$i - 1]['end_time'])->diffInSeconds(Carbon::parse($tasks[$i]['start_time']));

                        $tasks[$i - 1]['start_time'] = Carbon::parse($tasks[$i - 1]['start_time'])->subSeconds($time_gap);

                        $tasks[$i - 1]['end_time'] = Carbon::parse($tasks[$i - 1]['end_time'])->subSeconds($time_gap);
                    } else {
                        break;
                    }
                }

                Task::truncate();
                Task::insert($tasks);
            }
        }
        // Task::whereIn('id', [1,2,3,4,5])->update($tasks);
        return redirect('/');
        // $arr = [
        //     ['hello' => 'world'],
        //     ["hello" => "world"],
        // ];
        // var_dump($arr);
    }
}
