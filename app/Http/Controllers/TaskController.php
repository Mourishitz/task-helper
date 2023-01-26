<?php

namespace App\Http\Controllers;

use App\Mail\NewTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->where('is_active', true)->paginate(4);
        return view('task.index', ['tasks' => $tasks, 'type' => 'active']);
    }

    /**
     * Display a listing of the inactive resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function finished_index()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->where('is_active', false)->paginate(4);
        return view('task.index', ['tasks' => $tasks, 'type' => 'finished']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $task = Task::create($data);
        Mail::to(auth()->user()->email)->send(new NewTaskMail($task));
        return redirect()->route('task.show', ['task'=> $task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(Request $request, Task $task)
    {
        if(auth()->user()->id == $task['user_id']){
            $request['color'] = $task['color'];
            $task->update($request->all());
            return view('task.show', ['task'=>$task]);
        }
        dd('nao');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function destroy(Task $task)
    {
        $user = auth()->user();
        if($user->id == $task['user_id']){
            $task->update(['is_active' => !$task['is_active']]);
            $tasks = Task::where('user_id', $user->id)->where('is_active', $task['is_active'])->paginate(4);
            return view('task.index', ['tasks' => $tasks, 'type' => $task['is_active'] ? 'active' : 'finished']);
        }
        return view('unauthorized');
    }
}
