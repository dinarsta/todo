@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 p-4">
        <div class="card-body">
            <h2 class="text-center text-primary mb-4">Tambah Task</h2>

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Task:</label>
                    <input type="text" name="judul_task" value="{{ old('judul_task') }}" class="form-control rounded-3"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control rounded-3" rows="3"
                        required>{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Diinput Oleh:</label>
                    <select name="dikerjakan_oleh" class="form-select rounded-3">
                        <option value="{{ $user->id }}" selected>{{ $user->name }} ({{ ucfirst($user->role) }})</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status:</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="Baru" {{ old('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <!-- Input Hidden untuk Tanggal Mulai -->
                <input type="hidden" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}">

                <div class="mb-3">
                    <label class="form-label fw-bold">Tanggal Selesai:</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                        class="form-control rounded-3">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Lampiran:</label>
                    <input type="file" name="lampiran" class="form-control rounded-3" accept="image/*"
                        capture="environment">
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm rounded-pill">
                    <i class="fa fa-save"></i> Simpan Task
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
