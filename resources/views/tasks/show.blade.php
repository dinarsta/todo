<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }

        .task-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
        }

        p {
            text-align: left;
            font-size: 16px;
            margin: 5px 0;
        }

        strong {
            color: #555;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="task-container">
        <h1>Detail Task</h1>
        <p><strong>ID:</strong> {{ $task->id }}</p>
        <p><strong>Judul Task:</strong> {{ $task->judul_task }}</p>
        <p><strong>Deskripsi:</strong> {{ $task->deskripsi }}</p>
        <p><strong>Prioritas:</strong> {{ $task->prioritas }}</p>
        <p><strong>Dikerjakan Oleh:</strong> {{ $task->user->name ?? 'Tidak ada' }}</p>
        <p><strong>Status:</strong> {{ $task->status }}</p>
        <p><strong>Tanggal Mulai:</strong>
            {{ $task->tanggal_mulai ? date('d-m-Y', strtotime($task->tanggal_mulai)) : '-' }}</p>
        <p><strong>Tanggal Selesai:</strong>
            {{ $task->tanggal_selesai ? date('d-m-Y', strtotime($task->tanggal_selesai)) : '-' }}</p>

            @if($task->lampiran)
            @php
                $extension = pathinfo($task->lampiran, PATHINFO_EXTENSION);
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $documentExtensions = ['pdf', 'docx', 'xlsx', 'pptx'];
                $fileUrl = asset('storage/lampiran/' . basename($task->lampiran));
            @endphp

            @if(in_array($extension, $imageExtensions))
                <img src="{{ $fileUrl }}" alt="Lampiran Task" class="w-full max-w-md rounded shadow">
            @elseif($extension === 'pdf')
                <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
            @elseif(in_array($extension, $documentExtensions))
                <a href="{{ $fileUrl }}" target="_blank" class="text-blue-500 underline">Lihat Dokumen</a>
            @else
                <p class="text-gray-600">Format file tidak didukung. <a href="{{ $fileUrl }}" class="text-blue-500">Unduh Lampiran</a></p>
            @endif
        @endif

        <br>
        <a href="{{ route('tasks.index') }}" class="btn">Kembali ke Daftar Task</a>
    </div>
</body>

</html>
