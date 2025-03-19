<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn-sm i {
            margin-right: 5px;
        }
    </style>
</head>
<body class="container mt-4">
    <h1 class="mb-4 text-center text-primary">Daftar Task</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Task</a>

    <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul Task</th>
                <th>Deskripsi</th>
                <th>Prioritas</th>
                <th>Dikerjakan Oleh</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->judul_task }}</td>
                <td>{{ $task->deskripsi }}</td>
                <td>{{ $task->prioritas }}</td>
                <td>{{ $task->user->name ?? 'Tidak Diketahui' }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ date('d-m-Y', strtotime($task->tanggal_mulai)) }}</td>
                <td data-date="{{ date('Y-m-d', strtotime($task->tanggal_selesai)) }}">
                    {{ date('d-m-Y', strtotime($task->tanggal_selesai)) }}
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</a>
                </td>
            </tr>

            <!-- Modal Hapus -->
            <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus task "{{ $task->judul_task }}"?
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("tbody tr").forEach(row => {
                const deadlineElement = row.children[7];
                if (deadlineElement) {
                    const deadline = new Date(deadlineElement.getAttribute("data-date"));
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const threeDaysLater = new Date(today);
                    threeDaysLater.setDate(today.getDate() + 3);

                    if (deadline <= threeDaysLater && deadline >= today) {
                        row.classList.add("table-danger");
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
