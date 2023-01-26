<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
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
        $active_tasks = Task::where('user_id', $user->id)->where('is_active', true)->count();
        $month_tasks = Task::where('user_id', $user->id)->whereMonth('created_at', '=', date('m'))->count();
        $latest_task = Task::where('user_id', $user->id)->orderBy('updated_at', 'desc')->first();
        $latest_task_days = Carbon::now()->diffInDays(date(
                (Task::where('user_id', $user->id)
                    ->where('is_active', false)
                    ->orderBy('updated_at', 'desc')
                    ->first()->updated_at ?? '1970-01-01'
                )));
        $tasks_to_finish = Task::where('user_id', $user->id)->where('is_active', true)->where('final_date', '>', Carbon::now())->count();
        $first_date_task = date('d/m/Y - D', strtotime(
                Task::where('user_id', $user->id)
                    ->where('is_active', true)
                    ->where('final_date', '>', Carbon::now())
                    ->orderBy('final_date', 'asc')
                    ->first()->final_date ?? '1970-01-01'));
        $over_50_importance_task = Task::where('user_id', $user->id)->where('is_active', true)->where('importance', '>=', 50)->count();
        $over_75_importance_task = Task::where('user_id', $user->id)->where('is_active', true)->where('importance', '>=', 75)->count();

//        [
//            $active_tasks,
//            $month_tasks,
//            $latest_task,
//            $latest_task_days,
//            $tasks_to_finish,
//            $first_date_task,
//            $over_50_importance_task,
//            $over_75_importance_task
//        ] = Octane::concurrently([
//            fn () => Task::where('user_id', $user->id)->where('is_active', true)->count(),
//            fn () => Task::where('user_id', $user->id)->whereMonth('created_at', '=', date('m'))->count(),
//            fn () => Task::where('user_id', $user->id)->orderBy('updated_at', 'desc')->first(),
//            fn () => Carbon::now()->diffInDays(date(
//                (Task::where('user_id', $user->id)
//                    ->where('is_active', false)
//                    ->orderBy('updated_at', 'desc')
//                    ->first()->updated_at ?? '1970-01-01'
//                ))),
//            fn () => Task::where('user_id', $user->id)->where('is_active', true)->where('final_date', '>', Carbon::now())->count(),
//            fn () => date('d/m/Y - D', strtotime(
//                Task::where('user_id', $user->id)
//                    ->where('is_active', true)
//                    ->where('final_date', '>', Carbon::now())
//                    ->orderBy('final_date', 'asc')
//                    ->first()->final_date ?? '1970-01-01')
//            ),
//            fn () => Task::where('user_id', $user->id)->where('is_active', true)->where('importance', '>=', 50)->count(),
//            fn () => Task::where('user_id', $user->id)->where('is_active', true)->where('importance', '>=', 75)->count()
//        ]);

        return view('home', [
            'name'              => $user->name,
            'member_since'      => $user->created_at,
            'active_tasks'      => $active_tasks,
            'month_tasks'       => $month_tasks,
            'latest_task'       => $latest_task['name'] ?? 'Não há registros',
            'first_date_task'   => $first_date_task === '01/01/1970 - Thu' ? 'Não há registros' : $first_date_task,
            'tasks_to_finish'   => $tasks_to_finish,
            'latest_task_days'  => $latest_task_days,
            'over_50_importance_task' => $over_50_importance_task,
            'over_75_importance_task' => $over_75_importance_task,
        ]);
    }
}
