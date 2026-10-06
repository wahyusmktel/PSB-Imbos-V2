<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InfoSeleksiModel extends Model
{
    use HasFactory;

    protected $table = 'info_seleksis';
    
    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'jenjang_id',
        'jalur_id',
        'tempat',
        'waktu',
        'komponen_test_potensi',
        'komponen_test_membaca',
        'komponen_wawancara',
        'tgl_pengumuman',
        'tgl_mulai_du',
        'tgl_akhir_ud',
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

    // Relasi ke model ConfigJenjangModel (jika ada)
    public function jenjang()
    {
        return $this->belongsTo(ConfigJenjangModel::class, 'jenjang_id');
    }

    // Relasi ke model ConfigJalurModel (jika ada)
    public function jalur()
    {
        return $this->belongsTo(ConfigJalurModel::class, 'jalur_id');
    }
}
