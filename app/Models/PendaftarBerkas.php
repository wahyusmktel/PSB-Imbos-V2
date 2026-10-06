<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendaftarBerkas extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pendaftar_berkas';

    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang bisa diisi
    protected $fillable = [
        'id',
        'pendaftar_id',
        'berkas_id',
        'file',
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
     */
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }

    /**
     * Relasi ke model ConfigBerkas
     */
    public function configBerkas()
    {
        return $this->belongsTo(ConfigBerkasModel::class, 'berkas_id');
    }
}
