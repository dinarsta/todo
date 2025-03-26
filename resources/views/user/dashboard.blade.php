@extends('layouts.app')

@section('content')

<h1 class="mb-4 text-center text-primary">Daftar Task</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">
    <i class="fa fa-plus"></i>
</a>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center" style="background-color: #f8f9fa;">
        <thead style="background-color: #007bff; color: white;">
            <tr>
                <th>No</th>
                <th>Judul Task</th>
                <th>Deskripsi</th>
                <th>Diinput Oleh</th>
                <th>Status</th>
                <th>Tanggal Input</th>
                <th>Target Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr class="task-row" data-date="{{ date('Y-m-d', strtotime($task->tanggal_selesai)) }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->judul_task }}</td>
                <td>{{ $task->deskripsi }}</td>
                <td>{{ $task->user->name ?? 'Tidak Diketahui' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ date('d-m-Y', strtotime($task->tanggal_mulai)) }}</td>
                <td>{{ date('d-m-Y', strtotime($task->tanggal_selesai)) }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal Hapus -->
            <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus task "<b>{{ $task->judul_task }}</b>"?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".task-row").forEach(row => {
            const deadline = new Date(row.getAttribute("data-date"));
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const threeDaysLater = new Date(today);
            threeDaysLater.setDate(today.getDate() + 3);

            if (deadline <= threeDaysLater && deadline >= today) {
                row.classList.add("table-danger");
            }
        });
    });
</script>

@endsection
