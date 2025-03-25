@extends('layouts.app')

@section('content')
<div class="container mt-4 col-8">
    <div class="shadow-box">
        <h1 class="mb-4 text-center">Detail Task</h1>
        <p><strong>ID:</strong> {{ $task->id }}</p>
        <p><strong>Judul Task:</strong> {{ $task->judul_task }}</p>
        <p><strong>Deskripsi:</strong> {{ $task->deskripsi }}</p>
        <p><strong>DiInput Oleh:</strong> {{ $task->user->name ?? 'Tidak ada' }}</p>
        <p><strong>Status:</strong> {{ $task->status }}</p>
        <p><strong>Tanggal Input:</strong> {{ $task->tanggal_mulai ? date('d-m-Y', strtotime($task->tanggal_mulai)) : '-' }}</p>
        <p><strong>Target Selesai:</strong> {{ $task->tanggal_selesai ? date('d-m-Y', strtotime($task->tanggal_selesai)) : '-' }}</p>

        {{-- Menampilkan Lampiran Jika Ada --}}
        @if($task->lampiran)
            @php
                $fileUrl = asset('storage/' . $task->lampiran);
                $extension = strtolower(pathinfo($task->lampiran, PATHINFO_EXTENSION));
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $documentExtensions = ['pdf', 'docx', 'xlsx', 'pptx'];
            @endphp

            <div class="text-center mt-3">
                @if(in_array($extension, $imageExtensions))
                    <img src="{{ $fileUrl }}" alt="Lampiran Task" class="img-fluid rounded shadow">
                @elseif($extension === 'pdf')
                    <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
                @elseif(in_array($extension, ['docx', 'xlsx', 'pptx']))
                    <iframe src="https://docs.google.com/gview?url={{ $fileUrl }}&embedded=true" width="100%" height="500px"></iframe>
                @else
                    <p>Format file tidak didukung.</p>
                    <a href="{{ $fileUrl }}" class="btn btn-secondary">Unduh Lampiran</a>
                @endif
            </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali ke Daftar Task</a>
        </div>
    </div>
</div>
@endsection
