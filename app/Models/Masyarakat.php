<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use HasFactory;

    protected $table = 'masyarakat';

    protected $primaryKey = 'npm';

    protected $fillable = [
        'npm',
        'nama',
        'username',
        'password',
        'telp',
    ];

    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'npm', 'npm');
    }
}
