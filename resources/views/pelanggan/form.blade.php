<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>

    <div class="form-card">
        <h2 class="form-title">
            {{ isset($pelanggan) ? 'Ubah Data Pelanggan' : 'Tambah Pelanggan Baru' }}
        </h2>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan) : route('pelanggan.store') }}" method="POST">
            @csrf
            @if (isset($pelanggan))
                @method('PUT')
            @endif

            <label>Nama Lengkap:</label>
            <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama ?? '') }}" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $pelanggan->email ?? '') }}">

            <label>No. HP / WhatsApp:</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}">

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pelanggan->tanggal_lahir ?? '') }}">

            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin">
                <option value="">-- Pilih --</option>
                <option value="laki-laki" @selected(old('jenis_kelamin', $pelanggan->jenis_kelamin ?? '') == 'laki-laki')>Laki-laki</option>
                <option value="perempuan" @selected(old('jenis_kelamin', $pelanggan->jenis_kelamin ?? '') == 'perempuan')>Perempuan</option>
            </select>

            <label>Level Member:</label>
            <select name="level_member">
                <option value="basic" @selected(old('level_member', $pelanggan->level_member ?? 'basic') == 'basic')>Basic</option>
                <option value="gold" @selected(old('level_member', $pelanggan->level_member ?? 'basic') == 'gold')>Gold</option>
                <option value="vip" @selected(old('level_member', $pelanggan->level_member ?? 'basic') == 'vip')>VIP</option>
            </select>

            <label>Status Keanggotaan:</label>
            <select name="status">
                <option value="aktif" @selected(old('status', $pelanggan->status ?? 'aktif') == 'aktif')>Aktif</option>
                <option value="nonaktif" @selected(old('status', $pelanggan->status ?? 'aktif') == 'nonaktif')>Nonaktif</option>
            </select>

            <label>Alamat:</label>
            <textarea name="alamat" rows="3">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>

            <div class="form-button">
                <button type="submit">Simpan Data</button>
                <a href="{{ route('pelanggan.index') }}" style="margin-left: 10px;">Kembali ke Pelanggan & Member</a>
            </div>

        </form>
    </div>

</body>
</html>