<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ConfigBiayaModel extends Model
{
    use HasFactory;

    protected $table = 'config_biayas';
    
    // Menggunakan UUID sebagai primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id',
        'kode_biaya',
        'nama_biaya',
        'nominal',
        'jalur_id',
        'status',
        'created_by',
        'updated_by',
    ];

    // Membuat UUID secara otomatis saat model dibuat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
