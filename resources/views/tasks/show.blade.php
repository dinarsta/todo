<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Task</title>
</head>
<body>
    <h1>Detail Task</h1>
    <p><strong>ID:</strong> {{ $task->id }}</p>
    <p><strong>Judul Task:</strong> {{ $task->judul_task }}</p>
    <p><strong>Deskripsi:</strong> {{ $task->deskripsi }}</p>
    <p><strong>Prioritas:</strong> {{ $task->prioritas }}</p>
    <p><strong>Dikerjakan Oleh:</strong> {{ $task->user->name ?? 'Tidak ada' }}</p>
    <p><strong>Status:</strong> {{ $task->status }}</p>
    <p><strong>Tanggal Mulai:</strong> {{ $task->tanggal_mulai ? date('d-m-Y H:i', strtotime($task->tanggal_mulai)) : '-' }}</p>
    <p><strong>Tanggal Selesai:</strong> {{ $task->tanggal_selesai ? date('d-m-Y H:i', strtotime($task->tanggal_selesai)) : '-' }}</p>
    @if($task->lampiran)
        <p><strong>Lampiran:</strong> <a href="{{ Storage::url($task->lampiran) }}" target="_blank">Lihat Lampiran</a></p>
    @endif
    <a href="{{ route('tasks.index') }}">Kembali ke Daftar Task</a>
</body>
</html>
