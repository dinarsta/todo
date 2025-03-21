<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
            'dikerjakan_oleh' => 'required|integer|exists:users,id',
            'status' => 'required|in:Baru,Proses,Pending,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx',
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
            'dikerjakan_oleh' => 'required|integer|exists:users,id',
            'status' => 'required|in:Baru,Proses,Pending,Selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx',
        ]);

        $data = $request->all();

        if ($request->hasFile('lampiran')) {
            if ($task->lampiran && Storage::exists(str_replace('storage/', 'public/', $task->lampiran))) {
                Storage::delete(str_replace('storage/', 'public/', $task->lampiran));
            }
            $path = $request->file('lampiran')->store('public/lampiran');
            $data['lampiran'] = str_replace('public/', 'storage/', $path);
        }

        // Jika status diubah menjadi "Selesai", pindahkan ke deleted_tasks
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

            // Hapus dari tabel tasks
            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Task selesai dan dipindahkan ke arsip.');
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        // Simpan data ke tabel deleted_tasks sebelum dihapus
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

        // Hapus lampiran jika ada
        if ($task->lampiran && Storage::exists(str_replace('storage/', 'public/', $task->lampiran))) {
            Storage::delete(str_replace('storage/', 'public/', $task->lampiran));
        }

        // Hapus task dari database
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus dan dipindahkan ke arsip.');
    }
}
