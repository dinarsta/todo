<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="mb-4">Daftar Task</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Tambah Task</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
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
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $task->judul_task }}</td>
                <td>{{ $task->deskripsi }}</td>
                <td class="text-center">{{ $task->prioritas }}</td>
                <td>{{ $task->user->name ?? 'Tidak Diketahui' }}</td>
                <td class="text-center">{{ $task->status }}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($task->tanggal_mulai)) }}</td>
                <td class="text-center" data-date="{{ date('Y-m-d', strtotime($task->tanggal_selesai)) }}">
                    {{ date('d-m-Y', strtotime($task->tanggal_selesai)) }}
                </td>
                <td class="text-center">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">Hapus</button>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-success btn-sm">Show</a>
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
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                const tanggalSelesaiElement = row.children[7]; // Kolom tanggal selesai
                const tanggalSelesaiText = tanggalSelesaiElement ? tanggalSelesaiElement.getAttribute("data-date") : null;

                if (tanggalSelesaiText) {
                    const deadline = new Date(tanggalSelesaiText + "T00:00:00"); // Format tanggal yang benar
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    const threeDaysLater = new Date(today);
                    threeDaysLater.setDate(today.getDate() + 3);

                    console.log(`Deadline: ${deadline}, Today: ${today}, Three Days Later: ${threeDaysLater}`); // Debugging

                    if (deadline <= threeDaysLater && deadline >= today) {
                        row.classList.add("table-danger"); // Memberikan warna merah
                    }
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
