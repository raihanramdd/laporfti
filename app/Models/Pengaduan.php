<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'tgl_pengaduan',
        'npm',
        'isi_laporan',
        'foto',
        'status',
    ];

    protected $dates = ['tgl_pengaduan'];

    public function masyarakat(): BelongsTo
    {
        return $this->belongsTo(Masyarakat::class, 'npm', 'npm');
    }

    public function tanggapan(): HasOne
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
