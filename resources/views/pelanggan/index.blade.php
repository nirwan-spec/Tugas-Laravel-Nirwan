<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pelanggan & Member</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>

    <div class="page-header">
        <p class="breadcrumb">Sistem Venues / Lapangan Olahraga</p>
        <h1>Pelanggan & Member</h1>
        <p>Kelola data pelanggan, level keanggotaan, dan status profil pengguna venue.</p>
    </div>

    <a href="{{ route('pelanggan.create') }}">+ Tambah Pelanggan</a>
    <br><br>

    <form method="GET" action="{{ route('pelanggan.index') }}">
        <div class="filter-box">
            <input type="text" name="cari" placeholder="Cari nama, email, atau no. HP..." value="{{ $cari }}">

            <select name="level">
                <option value="">Semua Level Member</option>
                <option value="basic" @selected($level == 'basic')>Basic</option>
                <option value="gold" @selected($level == 'gold')>Gold</option>
                <option value="vip" @selected($level == 'vip')>VIP</option>
            </select>

            <select name="status">
                <option value="">Semua Status</option>
                <option value="aktif" @selected($status == 'aktif')>Aktif</option>
                <option value="nonaktif" @selected($status == 'nonaktif')>Nonaktif</option>
            </select>

            <button type="submit">Cari</button>
            <a href="{{ route('pelanggan.index') }}">Reset</a>
        </div>
    </form>
    <br>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>No. HP</th>
            <th>Level Member</th>
            <th>Tanggal Bergabung</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($pelanggan as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->no_hp }}</td>
            <td><span class="{{ $p->level_member }}">{{ ucfirst($p->level_member) }}</span></td>
            <td>{{ $p->tanggal_bergabung }}</td>
            <td><span class="{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
            <td>
                <a href="{{ route('pelanggan.edit', $p) }}">Ubah</a> |
                <form action="{{ route('pelanggan.destroy', $p) }}" method="POST" style="display:inline"
                      onsubmit="return confirm('Yakin mau menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;padding:0;font:inherit;color:inherit;text-decoration:underline;cursor:pointer;">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Data tidak ditemukan.</td>
        </tr>
        @endforelse
    </table>

</body>
</html>