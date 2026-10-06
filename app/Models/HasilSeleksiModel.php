<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HasilSeleksiModel extends Model
{
    use HasFactory;

    protected $table = 'hasil_seleksis';

    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'pendaftar_id',
        'hasil_kelulusan',
        'status',
        'created_by',
        'updated_by',
    ];

    // Event untuk membuat UUID otomatis saat membuat data baru
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
     * Setiap hasil seleksi terkait dengan satu pendaftar
     */
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }
}
