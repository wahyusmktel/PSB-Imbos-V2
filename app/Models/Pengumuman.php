<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'jenjang_id',
        'jalur_id',
        'judul_pengumuman',
        'isi_pengumuman',
        'photo',
        'status',
        'created_by',
        'updated_by'
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

    // Relasi ke model ConfigJenjangModel
    public function jenjang()
    {
        return $this->belongsTo(ConfigJenjangModel::class, 'jenjang_id');
    }

    // Relasi ke model ConfigJalurModel
    public function jalur()
    {
        return $this->belongsTo(ConfigJalurModel::class, 'jalur_id');
    }

    // Scope untuk hanya mengambil pengumuman yang aktif (status true)
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
