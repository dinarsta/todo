<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_task' => 'required|max:255',
            'deskripsi' => 'required',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'dikerjakan_oleh' => 'required|integer|exists:users,id',
            'status' => 'required|in:Baru,Proses,Pending,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,png,docx|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('public/lampiran');
            $data['lampiran'] = str_replace('public/', 'storage/', $path);
        }

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dibuat.');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::where('role', 'user')->get();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'judul_task' => 'required|max:255',
            'deskripsi' => 'required',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'dikerjakan_oleh' => 'required|integer|exists:users,id',
            'status' => 'required|in:Baru,Proses,Pending,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,png,docx|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('lampiran')) {
            if ($task->lampiran && Storage::exists(str_replace('storage/', 'public/', $task->lampiran))) {
                Storage::delete(str_replace('storage/', 'public/', $task->lampiran));
            }
            $path = $request->file('lampiran')->store('public/lampiran');
            $data['lampiran'] = str_replace('public/', 'storage/', $path);
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->lampiran && Storage::exists(str_replace('storage/', 'public/', $task->lampiran))) {
            Storage::delete(str_replace('storage/', 'public/', $task->lampiran));
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }
}
