<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'kaprodi',
        'Jurusan',
    ];

    public function Mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
