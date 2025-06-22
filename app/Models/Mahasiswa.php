<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Mahasiswa extends Model
{
    //
    protected $table = 'mahasiswa';
    protected $primaryKey = 'Nim';
    protected $keyType = 'string';

    protected $fillable = [
        'Nim',
        'Nama',
        'Tanggallahir',
        'Telp',
        'Email',
        'password',
        'foto',
        'Id_prodi'
    ];

    public function Prodi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'Id_prodi');
    }
}
