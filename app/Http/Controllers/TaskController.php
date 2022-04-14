<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    private function isManager()
    {
        return auth()->user()->role === 'MANAGER';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if ($this->isManager()) {
            abort(403);
        }
        return view('dashboard');
    }

    public function manager()
    {
        return view('manager');
    }

    public function store(StoreTaskRequest $request)
    {
        dd($request);
    }

}
