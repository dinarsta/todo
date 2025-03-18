<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Task</title>
</head>
<body>
    <h1>Tambah Task</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Judul Task:</label>
        <input type="text" name="judul_task" value="{{ old('judul_task') }}" required><br>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea><br>

        <label>Prioritas:</label>
        <select name="prioritas" required>
            <option value="Rendah" {{ old('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
            <option value="Sedang" {{ old('prioritas') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
            <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
        </select><br>

        <label>Dikerjakan Oleh:</label>
        <select name="dikerjakan_oleh">
            <option value="">-- Pilih User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('dikerjakan_oleh') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select><br>


        <label>Status:</label>
        <select name="status">
            <option value="Baru" {{ old('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
            <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select><br>

        <label>Tanggal Mulai:</label>
        <input type="datetime-local" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"><br>

        <label>Tanggal Selesai:</label>
        <input type="datetime-local" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"><br>

        <label>Lampiran:</label>
        <input type="file" name="lampiran"><br>

        <button type="submit">Simpan Task</button>
    </form>
</body>
</html>
