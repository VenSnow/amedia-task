<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    private $dateMessage = 'Вы можете создавать заявку не более чем 1 раз за 24 часа';

    private function isManager()
    {
        return auth()->user()->role === 'MANAGER';
    }

    /*
     * Вернуть количество часов с момента последней заявки
     */
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

    /*
     * Вернуть главную страницу если у пользователя роль USER
     */
    public function index()
    {
        if ($this->isManager()) {
            return redirect()->route('manager'); // Сделать редирект, если роль MANAGER
        }
        // $message = $this->getHoursOfLastTaskDate() < 24 ? $this->dateMessage : '';
        return view('dashboard');
    }

    /*
     * Показать все свои заявки для USER
     */
    public function tasks()
    {
        $tasks = auth()->user()->tasks()->latest()->paginate(10);
        return view('task.index', compact('tasks'));
    }

    /*
     * Показать все заявки для MANAGER
     */
    public function manager()
    {
        $tasks = Task::latest()->paginate(10);
        return view('manager', compact('tasks'));
    }

    /*
     *  Изменить статус у заявки с OPEN на ANSWERED
     */
    public function taskChange(Task $task)
    {
        $task->status = "ANSWERED";
        $task->save();
        return redirect()->route('manager')->with('status', 'Вы ответили на заявку');
    }

    /*
     * Сохранить заявку пользователя
     */
    public function store(StoreTaskRequest $request)
    {
        if ($this->getHoursOfLastTaskDate() < 24 ) {
            // Сделать редирект обратно, если не прошло 24 часа с прошлой заявки
            return redirect()->route('index', ['message' => $this->dateMessage]);
        }
        $file = $request->file('file');
        $data = $request->validated(); // Валидация данных
        $destinationPath = 'uploads/tasks';
        $fileName = date('YmdHis') . rand(1, 13) . "." . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);
        $data = array_merge($data, ['file' => $destinationPath . $fileName]); // Изменить значение ключа file
        auth()->user()->tasks()->create($data);
        return redirect()->route('index')->with('status', 'Заявка успешно отправлена');
    }
}
