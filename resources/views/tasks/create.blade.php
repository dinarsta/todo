<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="mb-4">Tambah Task</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow">
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
            <label class="form-label">Prioritas:</label>
            <select name="prioritas" class="form-select" required>
                <option value="Rendah" {{ old('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                <option value="Sedang" {{ old('prioritas') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Dikerjakan Oleh:</label>
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
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="form-control">
        </div>


        <div class="mb-3">
            <label class="form-label">Lampiran:</label>
            <input type="file" name="lampiran" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Task</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
