<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Octane\Facades\Octane;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        [
            $active_tasks,
            $month_tasks,
            $latest_task,
            $tasks_to_finish,
            $first_date_task,
            $over_50_importance_task,
            $over_75_importance_task
        ] = Octane::concurrently([
            fn () => Task::where('user_id', $user->id)->where('is_active', true)->count(),
            fn () => Task::whereMonth('created_at', '=', date('m'))->count(),
            fn () => Task::where('user_id', $user->id)->orderBy('updated_at', 'desc')->first(),
            fn () => Task::where('final_date', '>', Carbon::now())->count(),
            fn () => Task::where('final_date', '>', Carbon::now())->orderBy('final_date', 'asc')->first(),
            fn () => Task::where('importance', '>=', 50)->count(),
            fn () => Task::where('importance', '>=', 75)->count(),
        ]);

        $today = Carbon::now();
        $latest_task_days = $today->diffInDays(date($latest_task['updated_at']));

        $data = [
            'name'              => $user->name,
            'active_tasks'      => $active_tasks,
            'month_tasks'       => $month_tasks,
            'latest_task'       => $latest_task,
            'first_date_task'   => date('d/m/Y - D', strtotime($first_date_task['final_date'])),
            'tasks_to_finish'   => $tasks_to_finish,
            'latest_task_days'  => $latest_task_days,
            'over_50_importance_task' => $over_50_importance_task,
            'over_75_importance_task' => $over_75_importance_task,
        ];

        unset($today, $active_tasks, $month_tasks, $latest_task);

        return view('home', $data);
    }
}
