<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">Edit Task</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">Judul Task:</label>
                <input type="text" name="judul_task" value="{{ old('judul_task', $task->judul_task) }}" required
                    class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700">Deskripsi:</label>
                <textarea name="deskripsi" required class="w-full p-2 border rounded">{{ old('deskripsi', $task->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700">Prioritas:</label>
                <select name="prioritas" required class="w-full p-2 border rounded">
                    <option value="Rendah" {{ old('prioritas', $task->prioritas) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="Sedang" {{ old('prioritas', $task->prioritas) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Tinggi" {{ old('prioritas', $task->prioritas) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Dikerjakan Oleh:</label>
                <select name="dikerjakan_oleh" class="w-full p-2 border rounded">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('dikerjakan_oleh', $task->dikerjakan_oleh) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Status:</label>
                <select name="status" class="w-full p-2 border rounded">
                    <option value="Baru" {{ old('status', $task->status) == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Proses" {{ old('status', $task->status) == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Selesai" {{ old('status', $task->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $task->tanggal_mulai ? date('Y-m-d', strtotime($task->tanggal_mulai)) : '') }}"
                    class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $task->tanggal_selesai ? date('Y-m-d', strtotime($task->tanggal_selesai)) : '') }}"
                    class="w-full p-2 border rounded">
            </div>


            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Update Task</button>
        </form>
    </div>
</body>
</html>
