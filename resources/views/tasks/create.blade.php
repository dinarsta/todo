@extends('layouts.app')

@section('content')
<div class="container mt-4 col-8">
    <div class="shadow-box">
        <h1 class="mb-4 text-center">Tambah Task</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Task:</label>
                <input type="text" name="judul_task" value="{{ old('judul_task') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diinput Oleh:</label>
                <select name="dikerjakan_oleh" class="form-select">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('dikerjakan_oleh') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select">
                    <option value="Baru" {{ old('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Lampiran:</label>
                <input type="file" name="lampiran" class="form-control" accept="image/*" capture="environment">
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Task</button>
        </form>

    </div>
</div>
@endsection
