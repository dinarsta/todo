<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
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
}
