@extends('layouts.app')

@section('content')
<div class="container mt-4 col-8">
    <div class="shadow-box">
        <h1 class="mb-4 text-center">Edit Task</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Task:</label>
                <input type="text" name="judul_task" value="{{ old('judul_task', $task->judul_task) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $task->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diinput Oleh:</label>
                <select name="dikerjakan_oleh" class="form-select">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('dikerjakan_oleh', $task->dikerjakan_oleh) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="Baru" {{ old('status', $task->status) == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Proses" {{ old('status', $task->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Selesai" {{ old('status', $task->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Input:</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $task->tanggal_mulai ? date('Y-m-d', strtotime($task->tanggal_mulai)) : '') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Target Selesai:</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $task->tanggal_selesai ? date('Y-m-d', strtotime($task->tanggal_selesai)) : '') }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Task</button>
        </form>
    </div>
</div>
@endsection
