<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua tasks
        $tasks = Task::all();

        // Ambil semua pengguna
        $users = User::all();

        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('tasks', 'users'));
        } else {
            return view('user.dashboard', compact('tasks', 'users'));
        }
    }

    private function adminDashboard()
    {
        $tasks = Task::all(); // Admin bisa melihat semua task
        return view('admin.dashboard', compact('tasks'));
    }

    private function userDashboard()
    {
        $tasks = Task::where('dikerjakan_oleh', Auth::id())->get(); // User hanya melihat task miliknya
        return view('user.dashboard', compact('tasks'));
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
            'dikerjakan_oleh' => 'required|integer|exists:users,id',
            'status' => 'required|in:Baru,Proses,Pending,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('lampiran', $filename, 'public');
            $data['lampiran'] = $path;
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
            'dikerjakan_oleh' => 'required|integer|exists:users,id',
            'status' => 'required|in:Baru,Proses,Pending,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('lampiran')) {
            // Hapus file lama jika ada
            if ($task->lampiran && Storage::disk('public')->exists($task->lampiran)) {
                Storage::disk('public')->delete($task->lampiran);
            }

            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('lampiran', $filename, 'public');
            $data['lampiran'] = $path;
        }

        if ($data['status'] === 'Selesai') {
            DB::table('deleted_tasks')->insert([
                'id' => $task->id,
                'judul_task' => $task->judul_task,
                'deskripsi' => $task->deskripsi,
                'dikerjakan_oleh' => $task->dikerjakan_oleh,
                'status' => $task->status,
                'tanggal_mulai' => $task->tanggal_mulai,
                'tanggal_selesai' => $task->tanggal_selesai,
                'lampiran' => $task->lampiran,
                'deleted_at' => now(),
            ]);

            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Task selesai dan dipindahkan ke arsip.');
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        DB::table('deleted_tasks')->insert([
            'id' => $task->id,
            'judul_task' => $task->judul_task,
            'deskripsi' => $task->deskripsi,
            'dikerjakan_oleh' => $task->dikerjakan_oleh,
            'status' => $task->status,
            'tanggal_mulai' => $task->tanggal_mulai,
            'tanggal_selesai' => $task->tanggal_selesai,
            'lampiran' => $task->lampiran,
            'deleted_at' => now(),
        ]);

        if ($task->lampiran && Storage::disk('public')->exists($task->lampiran)) {
            Storage::disk('public')->delete($task->lampiran);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus dan dipindahkan ke arsip.');
    }
}
