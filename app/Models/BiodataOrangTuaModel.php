<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BiodataOrangTuaModel extends Model
{
    use HasFactory;

    protected $table = 'biodata_orang_tuas';

    // Menggunakan UUID sebagai primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id',
        'pendaftar_id',
        'nama_ayah',
        'tempat_lahir_ayah',
        'agama_ayah',
        'tgl_lahir_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'range_gaji_ayah',
        'alamat_lengkap_ayah',
        'telp_ayah',
        'email_ayah',
        'nama_ibu',
        'tempat_lahir_ibu',
        'tgl_lahir_ibu',
        'agama_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'range_gaji_ibu',
        'alamat_ibu',
        'telp_ibu',
        'email_ibu',
        'hubungan_santri',
        'status',
        'created_by',
        'updated_by',
    ];

    // Event untuk membuat UUID otomatis saat record dibuat
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
     * Relasi ke model AkunPendaftar.
     * Setiap biodata orang tua terkait dengan satu pendaftar.
     */
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }
}
