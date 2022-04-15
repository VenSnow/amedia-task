<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $dateMessage = 'Вы можете создавать заявку не более чем 1 раз за 24 часа';

    private function isManager()
    {
        return auth()->user()->role === 'MANAGER';
    }

    private function getHoursOfLastTaskDate()
    {
        $lastTask = auth()->user()->tasks()->latest()->first();
        if ($lastTask) {
            $current = Carbon::now();
            $lastTaskDate = Carbon::parse($lastTask->created_at);
            return $current->diffInHours($lastTaskDate);
        }
        return true;
    }

    public function index()
    {
        if ($this->isManager()) {
            return redirect()->route('manager');
        }
        // $message = $this->getHoursOfLastTaskDate() < 24 ? $this->dateMessage : '';
        return view('dashboard');
    }

    public function tasks()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(10);
        return view('task.index', compact('tasks'));
    }

    public function manager()
    {
        return view('manager');
    }

    public function taskChange(Task $task)
    {

    }

    public function store(StoreTaskRequest $request)
    {
        if ($this->getHoursOfLastTaskDate() < 24 ) {
            return redirect()->route('index', ['message' => $this->dateMessage]);
        }
        $file = $request->file('file');
        $data = $request->validated();
        $destinationPath = 'uploads/tasks';
        $fileName = date('YmdHis') . rand(1, 13) . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        $data = array_merge($data, ['file' => $destinationPath . $fileName]);
        auth()->user()->tasks()->create($data);
        return redirect()->route('index')->with('status', 'Заявка успешно отправлена');
    }
}
