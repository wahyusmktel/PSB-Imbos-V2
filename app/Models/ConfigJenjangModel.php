<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ConfigJenjangModel extends Model
{
    use HasFactory;

    protected $table = 'config_jenjangs';
    
    // Use UUID for primary key
    protected $keyType = 'string';
    public $incrementing = false;

    // Columns that can be filled
    protected $fillable = [
        'id',
        'nama_jenjang',
        'tingkat_jenjang',
        'photo_cover',
        'deskripsi_jenjang',
        'poin_keunggulan',
        'tag_lokasi',
        'status',
        'created_by',
        'updated_by'
    ];

    // Boot function to auto-generate UUID for 'id'
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Optional: Add any relationship methods if required in the future
}
