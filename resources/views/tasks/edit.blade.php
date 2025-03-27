@extends('layouts.app')

@section('content')
<div class="container mt-5 col-md-8">
    <div class="card shadow-lg p-4">
        <h2 class="mb-4 text-center fw-bold">Edit Task</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul Task:</label>
                <input type="text" name="judul_task" value="{{ old('judul_task', $task->judul_task) }}" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control rounded-3" required>{{ old('deskripsi', $task->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Diinput Oleh:</label>
                <input type="text" class="form-control rounded-3" value="{{ $task->user->name }}" disabled>
                <input type="hidden" name="dikerjakan_oleh" value="{{ $task->dikerjakan_oleh }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Status:</label>
                <select name="status" class="form-select rounded-3">
                    <option value="Baru" {{ old('status', $task->status) == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Proses" {{ old('status', $task->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Selesai" {{ old('status', $task->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal Input:</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $task->tanggal_mulai ? date('Y-m-d', strtotime($task->tanggal_mulai)) : '') }}" class="form-control rounded-3">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Target Selesai:</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $task->tanggal_selesai ? date('Y-m-d', strtotime($task->tanggal_selesai)) : '') }}" class="form-control rounded-3">
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-3 fw-semibold">Update Task</button>
        </form>
    </div>
</div>
@endsection
