<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama', 'email', 'no_hp', 'alamat', 'tanggal_lahir',
        'jenis_kelamin', 'level_member', 'status', 'tanggal_bergabung',
    ];
}