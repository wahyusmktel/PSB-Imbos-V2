<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendaftarAlamatModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_alamats';

    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'pendaftar_id',
        'alamat_tempat_tinggal',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'rt',
        'rw',
        'status',
        'created_by',
        'updated_by',
    ];

    // Event untuk membuat UUID otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Relasi ke model AkunPendaftar
     * Setiap alamat akan berhubungan dengan satu pendaftar
     */
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id', 'id');
    }

    // Relasi ke model Province
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi_id');
    }

    // Relasi ke model Regency (kabupaten)
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id');
    }

    // Relasi ke model District (kecamatan)
    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan_id');
    }

    // Relasi ke model Village (desa)
    public function village()
    {
        return $this->belongsTo(Village::class, 'desa_id');
    }
}
