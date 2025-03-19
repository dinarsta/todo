<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .shadow-box {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            background: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4 col-8">
        <div class="shadow-box">
            <h1 class="mb-4 text-center">Detail Task</h1>
            <p><strong>ID:</strong> {{ $task->id }}</p>
            <p><strong>Judul Task:</strong> {{ $task->judul_task }}</p>
            <p><strong>Deskripsi:</strong> {{ $task->deskripsi }}</p>
            <p><strong>Prioritas:</strong> {{ $task->prioritas }}</p>
            <p><strong>Dikerjakan Oleh:</strong> {{ $task->user->name ?? 'Tidak ada' }}</p>
            <p><strong>Status:</strong> {{ $task->status }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $task->tanggal_mulai ? date('d-m-Y', strtotime($task->tanggal_mulai)) : '-' }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $task->tanggal_selesai ? date('d-m-Y', strtotime($task->tanggal_selesai)) : '-' }}</p>

            @if($task->lampiran)
            @php
                $extension = pathinfo($task->lampiran, PATHINFO_EXTENSION);
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $documentExtensions = ['pdf', 'docx', 'xlsx', 'pptx'];
                $fileUrl = asset('storage/lampiran/' . basename($task->lampiran));
            @endphp

            <div class="text-center mt-3">
                @if(in_array($extension, $imageExtensions))
                    <img src="{{ $fileUrl }}" alt="Lampiran Task" class="img-fluid rounded shadow">
                @elseif($extension === 'pdf')
                    <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
                @elseif(in_array($extension, $documentExtensions))
                    <a href="{{ $fileUrl }}" target="_blank" class="btn btn-primary">Lihat Dokumen</a>
                @else
                    <p>Format file tidak didukung. <a href="{{ $fileUrl }}" class="btn btn-secondary">Unduh Lampiran</a></p>
                @endif
            </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali ke Daftar Task</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
