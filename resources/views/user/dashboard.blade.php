@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard User</h1>

    <div class="card">
        <div class="card-header">
            <h3>Task Saya</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Task</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->judul_task }}</td>
                        <td>{{ $task->deskripsi }}</td>
                        <td><span class="badge bg-info">{{ $task->status }}</span></td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            @if ($task->status !== 'Selesai')
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
