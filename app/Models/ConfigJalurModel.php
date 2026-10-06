<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ConfigJalurModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'config_jalurs';

    // Gunakan UUID untuk primary key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom-kolom yang dapat diisi
    protected $guarded = ['id'];

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

    // Relasi atau fungsi lain bisa ditambahkan sesuai kebutuhan
}
