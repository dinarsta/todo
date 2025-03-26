@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="text-center text-primary mb-4">Detail Task</h2>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $task->id }}</p>
                    <p><strong>Judul Task:</strong> {{ $task->judul_task }}</p>
                    <p><strong>Deskripsi:</strong> {{ $task->deskripsi }}</p>
                    <p><strong>Diinput Oleh:</strong> {{ $task->user->name ?? 'Tidak ada' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong>
                        <span class="badge {{ $task->status == 'Selesai' ? 'bg-success' : 'bg-warning' }}">
                            {{ $task->status }}
                        </span>
                    </p>
                    <p><strong>Tanggal Input:</strong> {{ $task->tanggal_mulai ? date('d-m-Y', strtotime($task->tanggal_mulai)) : '-' }}</p>
                    <p><strong>Target Selesai:</strong> {{ $task->tanggal_selesai ? date('d-m-Y', strtotime($task->tanggal_selesai)) : '-' }}</p>
                </div>
            </div>

            @if($task->lampiran)
                @php
                    $fileUrl = asset('storage/' . $task->lampiran);
                    $extension = strtolower(pathinfo($task->lampiran, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                @endphp

                <div class="mt-4 text-center">
                    <h5 class="text-secondary">Lampiran</h5>
                    @if(in_array($extension, $imageExtensions))
                        <img src="{{ $fileUrl }}" alt="Lampiran Task" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
                    @elseif($extension === 'pdf')
                        <iframe src="{{ $fileUrl }}" width="100%" height="400px" class="border rounded shadow-sm"></iframe>
                    @else
                        <p class="text-danger">Format file tidak didukung.</p>
                        <a href="{{ $fileUrl }}" class="btn btn-outline-secondary">Unduh Lampiran</a>
                    @endif
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar Task
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
