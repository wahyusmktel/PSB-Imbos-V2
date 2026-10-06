<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BiodataPenyakitModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_penyakits';
    
    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'pendaftar_id',
        'nama_penyakit',
        'sejak_kapan',
        'status_kesembuhan',
        'penanganan',
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
     * Setiap catatan penyakit akan berhubungan dengan satu pendaftar
     */
    public function pendaftar()
    {
        return $this->belongsTo(AkunPendaftar::class, 'pendaftar_id');
    }
}
