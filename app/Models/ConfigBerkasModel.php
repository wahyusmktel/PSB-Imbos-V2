<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ConfigBerkasModel extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'config_berkas';

    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'jalur_id',
        'nama_berkas',
        'deskripsi_berkas',
        'ekstensi_berkas',
        'ukuran_maksimum',
        'status',
        'created_by',
        'updated_by',
    ];

    // Event untuk membuat UUID secara otomatis saat membuat model baru
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
     * Relasi ke tabel `config_jalurs`
     * Setiap berkas berhubungan dengan satu jalur.
     */
    public function jalur()
    {
        return $this->belongsTo(ConfigJalurModel::class, 'jalur_id');
    }
}
